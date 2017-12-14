<?php

/**
 * Invoice controller class to handle create and update invoice for patron
 */
class Fd extends Controller {

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
            $fd_number = $this->model->getFD_Number();
            $this->smarty->assign("fd_number", $fd_number);
            $this->smarty->assign("title", "FD");
            $bank_list = $this->common->getConfiglist('bank_name');
            $this->smarty->assign("bank_list", $bank_list);
            $this->view->selectedMenu = 'fd_create';
            $customerList = $this->common->getCustomerList();
            $this->smarty->assign("customer_list", $customerList);
            $this->view->render('header/create_invoice');
            $this->smarty->display(VIEW . 'admin/fd/create.tpl');
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
            $this->smarty->assign("title", "FD list");
            $this->view->selectedMenu = 'fd_list';

            $fromdate = new DateTime($from_date);
            $todate = new DateTime($to_date);
            $loan_list = $this->model->getFDList($fromdate->format('Y-m-d'), $todate->format('Y-m-d'), $user_selected);
            $int = 0;
            foreach ($loan_list as $item) {
                $loan_list[$int]['paylink'] = $this->encrypt->encode($item['fd_id']);
                $loan_list[$int]['receipt_id'] = $this->encrypt->encode($item['receipt_id']);
                $int++;
            }

            $this->smarty->assign("loan_list", $loan_list);
            $this->view->title = 'View requests';
            $this->view->render('header/list');
            $this->smarty->display(VIEW . 'admin/fd/list.tpl');
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
            if (!isset($_POST['fd_amount'])) {
                header("Location:/admin/fd/create");
            }

            $hasErrors = FALSE;
            $year_id = $this->common->getyear_id();
            $user_id = $this->common->getuser_id($_POST['customer_id']);
            if ($hasErrors == false) {
                $date = new DateTime($_POST['date']);
                $fd_number = $this->model->getFD_Number();

                $cheque_date = new DateTime($_POST['cheque_date']);
                if ($_POST['payment_mode'] == 1) {
                    if ($_POST['cheque_id'] > 0) {
                        $cheque_id = $_POST['cheque_id'];
                        $this->common->cheque_used($cheque_id);
                    } else {
                        $cheque_id = $this->common->saveCheque($this->session->get('userid'), $_POST['customer_id'], $_POST['cheque_number'], $_POST['bank_id'], $_POST['fd_amount'], $cheque_date->format('Y-m-d'));
                    }
                }

                $result = $this->model->saveFD($this->session->get('userid'), $user_id, $year_id, $_POST['customer_id'], $fd_number, $date->format('Y-m-d'), $_POST['fd_amount'], $_POST['intrest'], $_POST['terms'], $_POST['maturity_amount'], $_POST['note'], $_POST['payment_mode'], $cheque_id);
                $this->session->set('successMessage', 'FD saved successfully.');
                header("Location:/admin/fd/viewlist");
            } else {
                
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E005]Error while sending payment request Error: for admin [' . $admin_id . '] and for template id [' . $template_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    function certificate($link) {
        try {
            $fd_id = $this->encrypt->decode($link);
            $detail = $this->model->getFDDetails($fd_id);
            $customer = $this->common->getCustomerDetails($detail['customer_id']);
            $money_word = $this->word_money($detail['fd_amount']);
            $this->smarty->assign("money_word", $money_word);
            $this->smarty->assign("cust", $customer);
            $this->smarty->assign("det", $detail);
            $this->smarty->display(VIEW . 'admin/fd/certificate.tpl');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E003]Error while admin invoice create initiate Error: for admin [' . $admin_id . '] and for template [' . $this->view->templateselected . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    function maturity() {
        try {
            $this->smarty->assign("title", "FD Matured");
            $this->smarty->assign("type", "fd");
            $this->smarty->assign("display_type", "FD");
            $this->smarty->assign("type_id", "fd_id");
            $this->view->selectedMenu = 'fd_maturity';
            $rdList = $this->common->getFDCustomerList();
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
            $row = $this->model->getFDDetails($rd_id);

            $date = new DateTime($row['maturity_date']);
            $json['maturity_date'] = $date->format('d M Y');
            $json['maturity_amount'] = $row['maturity_amount'];
            $json['policy_number'] = $row['fd_number'];

            echo json_encode($json);
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E007]Error while payment request list initiate Error: for admin [' . $admin_id . '] ' . $e->getMessage());
            $this->setGenericError();
        }
    }

}
