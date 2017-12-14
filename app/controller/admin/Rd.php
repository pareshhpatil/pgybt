<?php

/**
 * Invoice controller class to handle create and update invoice for patron
 */
class Rd extends Controller {

    function __construct() {
        parent::__construct();

        //TODO : Check if using static function is causing any problems!
        $this->validateSession('admin');
    }

    /**
     * Create invoice initiate
     */
    function create() {
        try {
            $user_id = $this->session->get('userid');
            $rd_number = $this->model->getRD_Number();
            $this->smarty->assign("rd_number", $rd_number);
            $this->smarty->assign("title", "RD");
            $this->view->selectedMenu = 'rd_create';
            $customerList = $this->common->getCustomerList();
            $this->smarty->assign("customer_list", $customerList);
            $this->view->render('header/create_invoice');
            $this->smarty->display(VIEW . 'admin/rd/create.tpl');
            $this->view->render('footer/create_invoice');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E00f1]Error while admin invoice create initiate Error: for admin [' . $user_id . '] ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    function installment() {
        try {
            $user_id = $this->session->get('userid');
            $this->smarty->assign("title", "RD");
            $this->view->selectedMenu = 'rd_installment';
            $rdList = $this->common->getRDCustomerList();

            $bank_list = $this->common->getConfiglist('bank_name');

            $this->smarty->assign("bank_list", $bank_list);
            $this->smarty->assign("rdList", $rdList);
            $this->view->render('header/create_invoice');
            $this->smarty->display(VIEW . 'admin/rd/installment.tpl');
            $this->view->render('footer/create_invoice');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E00f1]Error while admin invoice create initiate Error: for admin [' . $user_id . '] ' . $e->getMessage());
            $this->setGenericError();
        }
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
            $this->smarty->assign("title", "RD list");
            $this->view->selectedMenu = 'rd_list';

            $fromdate = new DateTime($from_date);
            $todate = new DateTime($to_date);
            $loan_list = $this->model->getRDList($fromdate->format('Y-m-d'), $todate->format('Y-m-d'), $user_selected);
            $int = 0;
            foreach ($loan_list as $item) {
                $loan_list[$int]['paylink'] = $this->encrypt->encode($item['rd_id']);
                $int++;
            }

            $this->smarty->assign("loan_list", $loan_list);
            $this->view->title = 'View requests';
            $this->view->render('header/list');
            $this->smarty->display(VIEW . 'admin/rd/list.tpl');
            $this->view->render('footer/list');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E007]Error while payment request list initiate Error: for admin [' . $admin_id . '] ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function installmentlist() {
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
            $this->smarty->assign("title", "RD Installment List");
            $this->smarty->assign("type", "RD");
            $this->view->selectedMenu = 'rd_installmentlist';

            $fromdate = new DateTime($from_date);
            $todate = new DateTime($to_date);
            $installment_list = $this->model->getRDInstallmentList($fromdate->format('Y-m-d'), $todate->format('Y-m-d'), $user_selected);
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
     * create invoice saved
     */
    function save() {
        try {
            if (!isset($_POST['rd_amount'])) {
                header("Location:/admin/rd/create");
            }

            $hasErrors = FALSE;
            $year_id = $this->common->getyear_id();
            $user_id = $this->common->getuser_id($_POST['customer_id']);
            if ($hasErrors == false) {
                $date = new DateTime($_POST['date']);
                $rd_number = $this->model->getRD_Number();
                $result = $this->model->saveRD($this->session->get('userid'), $user_id, $year_id, $_POST['customer_id'], $rd_number, $date->format('Y-m-d'), $_POST['rd_amount'], $_POST['intrest'], $_POST['terms'], $_POST['maturity_amount'], $_POST['note']);
                $this->session->set('successMessage', 'RD saved successfully.');
                header("Location:/admin/rd/viewlist");
            } else {
                
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E005]Error while sending payment request Error: for admin [' . $admin_id . '] and for template id [' . $template_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    function installmentsave() {
        try {
            if (!isset($_POST['amount'])) {
                header("Location:/admin/rd/installment");
            }

            $hasErrors = FALSE;
            $year_id = $this->common->getyear_id();
            $result = $this->model->getRDDetails($_POST['rd_id']);
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
                $installment_id = $this->model->saveRDInstallment($this->session->get('userid'), $user_id, $year_id, $customer_id, $_POST['rd_id'], $date->format('Y-m-d'), $_POST['amount'], $_POST['penalty'], $_POST['payment_mode'], $cheque_id, $_POST['note']);

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

    function getrdamount($rd_id) {
        try {
            $list = $this->model->getRDDetails($rd_id);
            $cheque_list = $this->common->getCustomerCheque($list['customer_id']);
            $cheque = '<div class="form-group"> <label class="control-label col-md-6">Cheque List<span class="required"></span></label><div class="col-md-6"><select class="form-control" name="cheque_id" onchange="getchequeDetails(this.value);"><option value="">Select Cheque</option>';
            foreach ($cheque_list as $ch) {
                $cheque.= '<option value="' . $ch['cheque_id'] . '">' . $ch['cheque_number'] . ' | ' . $ch['amount'] . ' | ' . $ch['cheque_date'] . '</option>';
            }
            $cheque.='</select></div></div>';

            // echo '{"installment":"' . $list['installment'] . '","cheque_list":"' .$cheque . '"}';
            $json['installment'] = $list['installment'];
            if (empty($cheque_list)) {
                $cheque = '';
            }
            $json['cheque_list'] = $cheque;
            echo json_encode($json);
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E007]Error while payment request list initiate Error: for admin [' . $admin_id . '] ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function calculator() {
        try {
            $this->view->selectedMenu = 'rd_calculator';
            $this->view->render('header/list');
            $this->smarty->display(VIEW . 'admin/rd/calculator.tpl');
            $this->view->render('footer/list');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E007]Error while payment request list initiate Error: for admin [' . $admin_id . '] ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    function getcalculation($post = NULL) {
        if ($post == NULL) {
            $term = $_POST['terms'];
            $intrest = $_POST['intrest'];
            $intallmnet = $_POST['rd_amount'];
            $date = $_POST['date'];
        } else {
            $post = json_decode($post);
            $term = $post->terms;
            $intrest = $post->intrest;
            $intallmnet = $post->rd_amount;
            $date = $post->date;
        }
        $date = strtotime(date("d-M-Y", strtotime($date)) . " +0 month");
        $date = date("d-M-Y", $date);
        $schedule = $this->getSchedule($intallmnet, $term, $intrest, $date);

        $echo.= '<table class="table table-bordered table-hover">
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
                                    Total
                                </th>
                                <th class="td-c">
                                    Date
                                </th>
                            </tr>
                        </thead>
                        <tbody>';
        foreach ($schedule as $v) {
            $echo.= '<tr>
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
        $echo.= ' </tbody>
                    </table>';

        $json['table'] = $echo;
        $json['maturity'] = $schedule[$term]['balance'];
        $json['total'] = $schedule[$term]['principle'];
        echo json_encode($json);
    }

    public function schedule($link) {
        try {
            $rd_id = $this->encrypt->decode($link);
            $detail = $this->model->getRDDetails($rd_id);
            $paidInstallment = $this->model->getPaidInstallment($rd_id);
            $term = $detail['terms'];
            $intallmnet = $detail['installment'];
            $intrest = $detail['intrest'];
            $date = $detail['date'];
            $date = strtotime(date("d-M-Y", strtotime($date)) . " +0 month");
            $date = date("d-M-Y", $date);
            $schedule = $this->getSchedule($intallmnet, $term, $intrest, $date, $paidInstallment);
            $this->view->selectedMenu = 'rd_list';
            $this->smarty->assign("schedule", $schedule);
            $this->view->title = 'View requests';
            $this->view->render('header/list');
            $this->smarty->display(VIEW . 'admin/rd/schedule.tpl');
            $this->view->render('footer/list');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E007]Error while payment request list initiate Error: for admin [' . $admin_id . '] ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    function getSchedule($intallmnet, $term, $intrest, $date, $paidInstallment = NULL) {
        $schedule = array();
        $cum_intrest = 0;
        $int = 0;
        $amount = 0;

        foreach ($paidInstallment as $inst) {
            $intallmnet = $inst['amount'];
            if ($term == $int) {
                $intallmnet = 0;
            }
            $intrestamt = ($princi * $intrest / 100) / 12;
            $intrestamt = round($intrestamt, 2);
            $princi = $princi + $intallmnet;
            $cum_intrest = $cum_intrest + $intrestamt;
            $endbalance = $endbalance + $intallmnet + $intrestamt;
            $schedule[$int]['sr'] = $int + 1;
            $schedule[$int]['begining_balance'] = round($amount, 2);
            $schedule[$int]['installment'] = round($intallmnet, 2);
            $schedule[$int]['principle'] = round($princi, 2);
            $schedule[$int]['intrest'] = round($intrestamt, 2);
            $schedule[$int]['cum_intrest'] = round($cum_intrest, 2);
            $schedule[$int]['balance'] = round($endbalance, 2);
            $schedule[$int]['is_paid'] = 1;
            $date = new DateTime($inst['date']);
            $schedule[$int]['date'] = $date->format('d-M-Y');
            $date = $date->format('d-M-Y');
            $date = strtotime(date("d-M-Y", strtotime($date)) . " +1 month");
            $date = date("d-M-Y", $date);
            $amount = $amount + $intallmnet + $intrestamt;

            $int++;
        }

        while ($term + 1 > $int) {
            if ($term == $int) {
                $intallmnet = 0;
            }
            $intrestamt = ($princi * $intrest / 100) / 12;
            $intrestamt = round($intrestamt, 2);
            $princi = $princi + $intallmnet;
            $cum_intrest = $cum_intrest + $intrestamt;
            $endbalance = $endbalance + $intallmnet + $intrestamt;
            $schedule[$int]['sr'] = $int + 1;
            $schedule[$int]['begining_balance'] = round($amount, 2);
            $schedule[$int]['installment'] = round($intallmnet, 2);
            $schedule[$int]['principle'] = round($princi, 2);
            $schedule[$int]['intrest'] = round($intrestamt, 2);
            $schedule[$int]['cum_intrest'] = round($cum_intrest, 2);
            $schedule[$int]['balance'] = round($endbalance, 2);
            $schedule[$int]['is_paid'] = 0;
            $schedule[$int]['date'] = $date;
            $date = strtotime(date("d-M-Y", strtotime($date)) . " +1 month");
            $date = date("d-M-Y", $date);

            $amount = $amount + $intallmnet + $intrestamt;

            $int++;
        }

        return $schedule;
    }

    function certificate($link) {
        try {
            $rd_id = $this->encrypt->decode($link);
            $detail = $this->model->getRDDetails($rd_id);
            $customer = $this->common->getCustomerDetails($detail['customer_id']);
            $money_word = $this->word_money($detail['installment']);
            $this->smarty->assign("money_word", $money_word);
            $this->smarty->assign("cust", $customer);
            $this->smarty->assign("det", $detail);
            $this->smarty->display(VIEW . 'admin/rd/certificate.tpl');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E003]Error while admin invoice create initiate Error: for admin [' . $admin_id . '] and for template [' . $this->view->templateselected . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    function maturity() {
        try {
            $user_id = $this->session->get('userid');
            $this->smarty->assign("title", "RD Matured");
            $this->smarty->assign("type", "rd");
            $this->smarty->assign("display_type", "RD");
            $this->smarty->assign("type_id", "rd_id");
            $this->view->selectedMenu = 'rd_maturity';
            $rdList = $this->common->getRDCustomerList();
            $bank_list = $this->common->getAccountList();

            $this->smarty->assign("bank_list", $bank_list);
            $this->smarty->assign("List", $rdList);
            $this->view->render('header/create_invoice');
            $this->smarty->display(VIEW . 'admin/maturity.tpl');
            $this->view->render('footer/create_invoice');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E003]Error while admin invoice create initiate Error: for admin [' . $admin_id . '] and for template [' . $this->view->templateselected . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    function getmaturity($rd_id) {
        try {
            $row = $this->model->getRDDetails($rd_id);

            $date = new DateTime($row['maturity_date']);
            $json['maturity_date'] = $date->format('d M Y');
            $json['maturity_amount'] = $row['maturity_amount'];
            $json['policy_number'] = $row['rd_number'];

            echo json_encode($json);
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E007]Error while payment request list initiate Error: for admin [' . $admin_id . '] ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    function maturitysave() {
        try {
            if (!isset($_POST['type'])) {
                header("Location:/admin/rd/installment");
            }

            $type = $_POST['type'];


            $hasErrors = FALSE;
            $year_id = $this->common->getyear_id();

            if ($type == 'rd') {
                $type = 1;
                $result = $this->model->getRDDetails($_POST['policy_id']);
                $tt = 'RD';
            } else {
                $type = 2;
                require_once MODEL . 'admin/FdModel.php';
                $fd_model = new FdModel();
                $result = $fd_model->getFDDetails($_POST['policy_id']);
                $tt = 'FD';
            }
            $customer_id = $result['customer_id'];
            $user_id = $this->common->getuser_id($customer_id);
            if ($hasErrors == false) {
                $cheque_id = 0;
                $date = new DateTime($_POST['date']);
                $cheque_date = new DateTime($_POST['cheque_date']);
                $mat_date = new DateTime($_POST['maturity_date']);
                if ($_POST['payment_mode'] == 1) {
                    if ($_POST['cheque_id'] > 0) {
                        $cheque_id = $_POST['cheque_id'];
                        $this->common->cheque_used($cheque_id);
                    } else {
                        $cheque_id = $this->common->saveCheque($this->session->get('userid'), $customer_id, $_POST['cheque_number'], $_POST['bank_id'], $_POST['amount'], $cheque_date->format('Y-m-d'), 1);
                    }
                }
                $maturity_id = $this->model->saveMaturity($this->session->get('userid'), $user_id, $year_id, $customer_id, $type, $_POST['policy_id'], $date->format('Y-m-d'), $mat_date->format('Y-m-d'), $_POST['amount'], $_POST['maturity_amount'], $_POST['receiver_name'], $_POST['payment_mode'], $cheque_id, $_POST['note'], $_POST['bank_id']);

                require_once MODEL . 'admin/ExpenseModel.php';
                $expense_model = new ExpenseModel();
                $result = $expense_model->saveExpense($user_id, $year_id, $tt . ' Maturity', $tt . ' Maturity Against ' . $_POST['policy_number'], $_POST['amount'], $_POST['receiver_name'], $date->format('Y-m-d'), $_POST['payment_mode'], $cheque_id, $_POST['note'], $_POST['bank_id'], $maturity_id);
                $this->common->addMoney_account($_POST['amount'], $_POST['bank_id']);
                header("Location:/admin/report/maturitylist");
            } else {
                
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E005]Error while sending payment request Error: for admin [' . $admin_id . '] and for template id [' . $template_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    function mailtest() {
        $emailWrapper = new EmailWrapper();
        $emailWrapper->sendMail('pareshhpatil@gmail.com', "", 'test', 'Test Message');
    }

}
