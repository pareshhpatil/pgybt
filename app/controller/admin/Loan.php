<?php

/**
 * Invoice controller class to handle create and update invoice for patron
 */
class Loan extends Controller {

    function __construct() {
        parent::__construct();

        //TODO : Check if using static function is causing any problems!
        $this->validateSession('admin');
    }

    public function viewlist() {
        try {
            $user_id = $this->session->get('userid');

            $current_date = date("d M Y");
            $date = strtotime($current_date . ' -1 months');
            $last_date = date('d M Y', $date);
            $current_date = strtotime($current_date . ' 1 months');
            $current_date = date('d M Y', $current_date);

            if (isset($_POST['from_date'])) {
                $from_date = $_POST['from_date'];
                $to_date = $_POST['to_date'];
            } else {
                $from_date = $last_date;
                $to_date = $current_date;
            }

            $user_selected = ($_POST['user_id'] > 0) ? $_POST['user_id'] : 0;
            $user_list = $this->common->getUserList();

            $this->smarty->assign("from_date", $from_date);
            $this->smarty->assign("to_date", $to_date);
            $this->smarty->assign("user_selected", $user_selected);
            $this->smarty->assign("user_list", $user_list);
            $this->smarty->assign("title", "Loan list");
            $this->view->selectedMenu = 'loan_list';

            $fromdate = new DateTime($from_date);
            $todate = new DateTime($to_date);
            $loan_list = $this->model->getLoanList($fromdate->format('Y-m-d'), $todate->format('Y-m-d'), $user_selected);
            $int = 0;
            foreach ($loan_list as $item) {
                $loan_list[$int]['paylink'] = $this->encrypt->encode($item['loan_id']);
                $int++;
            }

            $this->smarty->assign("loan_list", $loan_list);
            $this->view->title = 'View requests';
            $this->view->render('header/list');
            $this->smarty->display(VIEW . 'admin/loan/list.tpl');
            $this->view->render('footer/list');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E007]Error while payment request list initiate Error: for admin [' . $admin_id . '] ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function emilist() {
        try {
            $current_date = date("d M Y");
            $date = strtotime($current_date . ' -1 months');
            $last_date = date('d M Y', $date);
            $current_date = strtotime($current_date . ' 1 months');
            $current_date = date('d M Y', $current_date);

            if (isset($_POST['from_date'])) {
                $from_date = $_POST['from_date'];
                $to_date = $_POST['to_date'];
            } else {
                $from_date = $last_date;
                $to_date = $current_date;
            }

            $user_selected = ($_POST['user_id'] > 0) ? $_POST['user_id'] : 0;
            $user_list = $this->common->getUserList();

            $this->smarty->assign("from_date", $from_date);
            $this->smarty->assign("to_date", $to_date);
            $this->smarty->assign("user_selected", $user_selected);
            $this->smarty->assign("user_list", $user_list);
            $this->smarty->assign("title", "Loan EMI List");
            $this->smarty->assign("type", "Loan");
            $this->view->selectedMenu = 'emilist';

            $fromdate = new DateTime($from_date);
            $todate = new DateTime($to_date);
            $installment_list = $this->model->getLoanInstallmentList($fromdate->format('Y-m-d'), $todate->format('Y-m-d'), $user_selected);
            $int = 0;
            foreach ($installment_list as $item) {
                $installment_list[$int]['link'] = $this->encrypt->encode($item['emi_id']);
                $int++;
            }

            $this->smarty->assign("installment_list", $installment_list);
            $this->view->render('header/list');
            $this->smarty->display(VIEW . 'admin/rd/installmentlist.tpl');
            $this->view->render('footer/list');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E007]Error while payment request list initiate Error: for admin [' . $admin_id . '] ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    /**
     * Create invoice initiate
     */
    function create() {
        try {
            $user_id = $this->session->get('userid');
            $loan_type = $this->common->getConfiglist('loan_type');
            $this->smarty->assign("loan_type", $loan_type);
            $this->smarty->assign("title", "Loan");
            $this->view->canonical = 'admin/invoice/create';
            $this->view->selectedMenu = 'loan_create';
            $this->view->render('header/create_invoice');
            $this->smarty->assign("loan_type_selected", (isset($_POST['loan_type'])) ? $_POST['loan_type'] : '');
            $this->smarty->display(VIEW . 'admin/loan/select.tpl');
            if (isset($_POST['loan_type'])) {
                $bank_list = $this->common->getAccountList();
                $this->smarty->assign("bank_list", $bank_list);
                $loan_number = $this->model->getLoan_Number();
                $this->smarty->assign("loan_number", $loan_number);
                $this->smarty->assign("loan_type_selected", $_POST['loan_type']);
                $this->smarty->assign("type", $_POST['loan_type']);
                $customerList = $this->common->getCustomerList();
                $this->smarty->assign("customer_list", $customerList);
                $this->smarty->display(VIEW . 'admin/loan/gold.tpl');
                $this->smarty->display(VIEW . 'admin/loan/loan_footer.tpl');
            }
            $this->smarty->display(VIEW . 'admin/loan/footer.tpl');
            $this->view->render('footer/create_invoice');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E003]Error while admin invoice create initiate Error: for admin [' . $admin_id . '] and for template [' . $this->view->templateselected . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    /**
     * create invoice saved
     */
    function save() {
        try {

            if (!isset($_POST['loan_type'])) {
                header("Location:/admin/loan/create");
            }

            // require CONTROLLER . 'Paymentvalidator.php';
            //   $validator = new Paymentvalidator($this->model);
            // $validator->validateInvoice();
            // $hasErrors = $validator->fetchErrors();
            $hasErrors = FALSE;
            if ($hasErrors == false) {
                $year_id = $this->common->getyear_id();
                $date = new DateTime($_POST['date']);
                $loan_number = $this->model->getLoan_Number();
                $procs_amt = ($_POST['procs_amt'] > 0) ? $_POST['procs_amt'] : 0;
                $testing_charge = ($_POST['testing_charge'] > 0) ? $_POST['testing_charge'] : 0;
                $cheque_amount = $_POST['paid_amount'];
                $cheque_id = 0;
                $cheque_date = new DateTime($_POST['cheque_date']);
                if ($_POST['payment_mode'] == 1) {

                    $cheque_id = $this->common->saveCheque($this->session->get('userid'), $_POST['customer_id'], $_POST['cheque_number'], $_POST['bank_id'], $cheque_amount, $cheque_date->format('Y-m-d'), 1);
                }

                $result = $this->model->saveLoan($this->session->get('userid'), $_POST['loan_type'], $_POST['customer_id'], $loan_number, $date->format('Y-m-d'), $_POST['loan_amt'], $procs_amt, $_POST['terms'], $_POST['intrest'], $_POST['paid_amount'], $_POST['emi'], $_POST['payment_mode'], $cheque_id);
                if ($result['message'] == 'success') {
                    $this->model->saveIncome('Loan Processing', $result['loan_id'], $procs_amt, $this->session->get('userid'));
                    if ($_POST['loan_amt'] == $cheque_amount) {
                        $this->common->addMoney_account('-' . $procs_amt, 1);
                    }
                    $this->model->saveGolddetail($result['loan_id'], $_POST['info1'], $_POST['info2'], $_POST['info3'], $_POST['mrp'], $_POST['testing_charge'], $_POST['max_loan_amt'], $_POST['remark']);
                    if ($testing_charge > 0) {
                        $this->model->saveIncome('Loan Testing Charge', $result['loan_id'], $testing_charge, $this->session->get('userid'));
                        $this->common->addMoney_account('-' . $testing_charge, 1);
                    }

                    require_once MODEL . 'admin/ExpenseModel.php';
                    $expense_model = new ExpenseModel();
                    $result = $expense_model->saveExpense($this->session->get('userid'), $year_id, 'Loan', 'Loan Against ' . $loan_number, $_POST['loan_amt'], $result['name'], $date->format('Y-m-d'), $_POST['payment_mode'], $cheque_id, $_POST['remark'], $_POST['bank_id'], $result['loan_id']);
                    $this->common->addMoney_account($cheque_amount, $_POST['bank_id']);

                    $this->session->set('successMessage', 'Loan saved successfully.');
                    header("Location:/admin/loan/viewlist");
                } else {
                    SwipezLogger::error(__CLASS__, '[E004]Error while sending payment request to patron Error: from  admin [' . $admin_id . ']' . $result['Message']);
                    $this->setGenericError();
                }
            } else {
                $_POST['selecttemplate'] = $this->encrypt->decode($_POST['template_id']);
                $template_id = $_POST['selecttemplate'];
                $this->smarty->assign("haserrors", $hasErrors);
                $this->create();
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E005]Error while sending payment request Error: for admin [' . $admin_id . '] and for template id [' . $template_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    function emi() {
        try {
            $user_id = $this->session->get('userid');
            $this->smarty->assign("title", "RD");
            $this->view->selectedMenu = 'emi';
            $loanCustList = $this->common->getLoanCustomerList();

            $bank_list = $this->common->getConfiglist('bank_name');

            $this->smarty->assign("bank_list", $bank_list);
            $this->smarty->assign("loanCustList", $loanCustList);
            $this->view->render('header/create_invoice');
            $this->smarty->display(VIEW . 'admin/loan/installment.tpl');
            $this->view->render('footer/create_invoice');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E00f1]Error while admin invoice create initiate Error: for admin [' . $user_id . '] ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function schedule($link) {
        try {
            $loan_id = $this->encrypt->decode($link);

            $detail = $this->model->getLoanDetails($loan_id);
            $paidEmi = $this->model->getPaidInstallment($loan_id);
            $term = $detail['terms'];
            $amount = $detail['loan_amount'];
            $intallmnet = $detail['emi'];
            $intrest = $detail['intrest'];

            $date = $detail['date'];
            $date = strtotime(date("d-M-Y", strtotime($date)) . " +0 month");
            $date = date("d-M-Y", $date);
            $schedule = $this->getSchedule($amount, $term, $intrest, $intallmnet, $date, $paidEmi);
            $this->view->selectedMenu = 'loan_list';
            $this->smarty->assign("schedule", $schedule);
            $this->view->title = 'View requests';
            $this->view->render('header/list');
            $this->smarty->display(VIEW . 'admin/loan/schedule.tpl');
            $this->view->render('footer/list');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E007]Error while payment request list initiate Error: for admin [' . $admin_id . '] ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function calculator() {
        try {
            $this->view->selectedMenu = 'loan_calculator';
            $this->view->render('header/list');
            $this->smarty->display(VIEW . 'admin/loan/calculator.tpl');
            $this->view->render('footer/list');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E007]Error while payment request list initiate Error: for admin [' . $admin_id . '] ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    function getcalculation() {
        $term = $_POST['terms'];
        $amount = $_POST['loan_amount'];
        // $intallmnet = $_POST['emi'];
        $intrest = $_POST['intrest'];
        $intallmnet = $_POST['installment'];

        $date = $_POST['date'];
        $date = strtotime(date("d-M-Y", strtotime($date)) . " +0 month");
        $date = date("d-M-Y", $date);
        $schedule = $this->getSchedule($amount, $term, $intrest, $intallmnet, $date);

        echo '<table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="td-c">
                                    Pay no.
                                </th>
                                <th class="td-c">
                                    Begining balance
                                </th>
                                <th class="td-c">
                                    Installment
                                </th>
                                <th class="td-c">
                                    Principle
                                </th>
                                <th class="td-c">
                                    Intrest
                                </th>

                                <th class="td-c">
                                    Cumulative Intrest
                                </th>
                                <th class="td-c">
                                    Balance
                                </th>
                                <th class="td-c">
                                    Date
                                </th>
                            </tr>
                        </thead>
                        <tbody>';
        foreach ($schedule as $v) {
            echo '<tr>
                                    <td class="td-c">
                                        ' . $v['sr'] . '
                                    </td>
                                    <td class="td-c">
                                        ' . $v['begining_balance'] . '
                                    </td>
                                    <td class="td-c">
                                        ' . $v['installment'] . '
                                    </td>
                                    <td class="td-c">
                                        ' . $v['principle'] . '
                                    </td>
                                    <td class="td-c">
                                        ' . $v['intrest'] . '
                                    </td>
                                    <td class="td-c">
                                        ' . $v['cum_intrest'] . '
                                    </td>
                                    <td class="td-c">
                                        ' . $v['balance'] . '
                                    </td>
                                    <td class="td-c">
                                        ' . $v['date'] . '
                                    </td>
                                </tr>';
        }
        echo ' </tbody>
                    </table>';
    }

    function installmentsave() {
        try {
            if (!isset($_POST['amount'])) {
                header("Location:/admin/loan/emi");
            }

            $hasErrors = FALSE;
            $year_id = $this->common->getyear_id();
            $result = $this->model->getLoanDetails($_POST['loan_id']);
            $customer_id = $result['customer_id'];
            $user_id = $this->common->getuser_id($customer_id);
            if ($hasErrors == false) {
                $cheque_id = 0;
                $date = new DateTime($_POST['date']);
                $cheque_date = new DateTime($_POST['cheque_date']);
                if ($_POST['payment_mode'] == 1) {
                    if ($_POST['cheque_id'] > 0) {
                        $cheque_id = $_POST['cheque_id'];
                        $this->common->cheque_used($cheque_id);
                    } else {
                        $cheque_id = $this->common->saveCheque($this->session->get('userid'), $customer_id, $_POST['cheque_number'], $_POST['bank_id'], $_POST['amount'], $cheque_date->format('Y-m-d'));
                    }
                }
                $installment_id = $this->model->saveLoanInstallment($this->session->get('userid'), $user_id, $year_id, $customer_id, $_POST['loan_id'], $date->format('Y-m-d'), $_POST['amount'], $_POST['penalty'], $_POST['payment_mode'], $cheque_id, $_POST['note']);

                $intrest_princi = $this->get_principalIntrest($_POST['loan_id']);

                $this->model->saveInstallmentIncome($installment_id, $intrest_princi['principal'], $intrest_princi['intrest'], $_POST['loan_id'], $user_id);


                $result = $this->common->getReceiptDetails($installment_id);
                if ($result['email'] != '') {
                    $emailWrapper = new EmailWrapper();
                    if ($result['payment_type'] == 1) {
                        $mailcontents = $emailWrapper->fetchMailBody("chequereceipt");
                    } else {
                        $mailcontents = $emailWrapper->fetchMailBody("cashreceipt");
                    }

                    $message = $mailcontents[0];
                    $subject = $mailcontents[1];

                    $message = str_replace('__NUMBER__', $result['number'], $message);
                    $message = str_replace('__DATE__', $result['date'], $message);
                    $message = str_replace('__CUSTOMER_NAME__', $result['customer_name'], $message);
                    $message = str_replace('__MONEY_WORD__', '', $message);
                    $message = str_replace('__TYPE__', $result['type'], $message);
                    $message = str_replace('__POLICY_NUMBER__', $result['policy_number'], $message);
                    $message = str_replace('__AMOUNT__', $result['amount'], $message);
                    $message = str_replace('__CHEQUE_NUMBER__', $result['cheque_number'], $message);
                    $message = str_replace('__CHEQUE_DATE__', $result['cheque_date'], $message);

                    // $emailWrapper->sendMail($result['email'], "", $subject, $message);
                }

                $link = $this->encrypt->encode($installment_id);
                header("Location:/admin/receipt/view/" . $link);
            } else {
                
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E005]Error while sending payment request Error: for admin [' . $admin_id . '] and for template id [' . $template_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    function getrdamount($loan_id) {
        $list = $this->model->getLoanDetails($loan_id);
        $cheque_list = $this->common->getCustomerCheque($list['customer_id']);
        $cheque = '<div class="form-group"> <label class="control-label col-md-6">Cheque List<span class="required"></span></label><div class="col-md-6"><select class="form-control" name="cheque_id" onchange="getchequeDetails(this.value);"><option value="">Select Cheque</option>';
        foreach ($cheque_list as $ch) {
            $cheque.= '<option value="' . $ch['cheque_id'] . '">' . $ch['cheque_number'] . ' | ' . $ch['amount'] . ' | ' . $ch['cheque_date'] . '</option>';
        }
        $cheque.='</select></div></div>';

        // echo '{"installment":"' . $list['installment'] . '","cheque_list":"' .$cheque . '"}';
        $json['installment'] = $list['emi'];
        if (empty($cheque_list)) {
            $cheque = '';
        }
        $json['cheque_list'] = $cheque;
        echo json_encode($json);
    }

    function get_principalIntrest($loan_id) {
        $detail = $this->model->getLoanDetails($loan_id);
        $paidEmi = $this->model->getPaidInstallment($loan_id);
        $term = $detail['terms'];
        $amount = $detail['loan_amount'];
        $intallmnet = $detail['emi'];
        $intrest = $detail['intrest'];

        $date = $detail['date'];
        $date = strtotime(date("d-M-Y", strtotime($date)) . " +0 month");
        $date = date("d-M-Y", $date);
        $schedule = $this->getSchedule_intrest($amount, $term, $intrest, $intallmnet, $date, $paidEmi);
        return $schedule;
    }

    function getSchedule_intrest($amount, $term, $intrest, $intallmnet_, $date, $paidEmi = NULL) {
        $schedule = array();
        $cum_intrest = 0;
        $int = 0;
        $exit = 0;
        foreach ($paidEmi as $emi) {
            $intallmnet = $emi['amount'];
            $intrestamt = ($amount * $intrest / 100) / 12;
            $princi = $intallmnet - $intrestamt;
            $cum_intrest = $cum_intrest + $intrestamt;
            if ($exit == 1) {
                $princi = $amount;
            }
            $endbalance = $amount - $princi;
            $schedule[$int]['sr'] = $int + 1;
            $schedule[$int]['begining_balance'] = round($amount, 2);
            $schedule[$int]['installment'] = round($intallmnet, 2);
            $schedule[$int]['principle'] = round($princi, 2);
            $schedule[$int]['intrest'] = round($intrestamt, 2);
            $schedule[$int]['cum_intrest'] = round($cum_intrest, 2);
            $schedule[$int]['balance'] = round($endbalance, 2);
            $schedule[$int]['is_paid'] = 1;
            $date = new DateTime($emi['date']);
            $schedule[$int]['date'] = $date->format('d-M-Y');
            $date = $date->format('d-M-Y');
            $date = strtotime(date("d-M-Y", strtotime($date)) . " +1 month");
            $date = date("d-M-Y", $date);
            $amount = $endbalance;
            if ($exit == 1) {
                break;
            }
            if ($amount < $intallmnet) {
                $intallmnet = $amount;
                $exit = 1;
            }
            $int++;
        }
        return array('principal' => round($princi, 2), 'intrest' => round($intrestamt, 2));
    }

    /**
     * Create invoice initiate
     */
    function promissory($link) {
        try {
            $loan_id = $this->encrypt->decode($link);
            $detail = $this->model->getLoanDetails($loan_id);
            $customer = $this->common->getCustomerDetails($detail['customer_id']);
            $money_word = $this->word_money($detail['loan_amount']);
            $this->smarty->assign("money_word", $money_word);
            $this->smarty->assign("cust", $customer);
            $this->smarty->assign("det", $detail);
            $this->smarty->display(VIEW . 'admin/loan/promissory.tpl');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E003]Error while admin invoice create initiate Error: for admin [' . $admin_id . '] and for template [' . $this->view->templateselected . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    function receipt($link) {
        try {
            $loan_id = $this->encrypt->decode($link);
            $detail = $this->model->getLoanDetails($loan_id);
            if ($detail['cheque_id'] > 0) {
                $cheque = $this->common->getChequeDetails($detail['cheque_id']);
            }
            $customer = $this->common->getCustomerDetails($detail['customer_id']);
            $money_word = $this->word_money($detail['loan_amount']);
            $this->smarty->assign("money_word", $money_word);
            $this->smarty->assign("cust", $customer);
            $this->smarty->assign("det", $detail);
            $this->smarty->assign("cheque", $cheque);
            $this->smarty->display(VIEW . 'admin/loan/receipt.tpl');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E003]Error while admin invoice create initiate Error: for admin [' . $admin_id . '] and for template [' . $this->view->templateselected . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

}
