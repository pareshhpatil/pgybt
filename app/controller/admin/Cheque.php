<?php

/**
 * Invoice controller class to handle create and update invoice for patron
 */
class Cheque extends Controller {

    function __construct() {
        parent::__construct();

        //TODO : Check if using static function is causing any problems!
        $this->validateSession('admin');
    }

    /**
     * Create invoice initiate
     */
    function add() {
        try {
            $user_id = $this->session->get('userid');
            $this->smarty->assign("title", "FD");
            $this->view->selectedMenu = 'cheque_add';
            $bank_list = $this->common->getConfiglist('bank_name');
            $this->smarty->assign("bank_list", $bank_list);
            $customerList = $this->common->getCustomerList();
            $this->smarty->assign("customer_list", $customerList);
            $this->view->render('header/create_invoice');
            $this->smarty->display(VIEW . 'admin/cheque/add.tpl');
            $this->view->render('footer/create_invoice');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E00f1]Error while admin invoice create initiate Error: for admin [' . $user_id . '] ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function viewlist() {
        try {

            $this->view->selectedMenu = 'cheque_list';

            $list = $this->model->getChequeMaster();
            $int = 0;
            foreach ($list as $item) {
                $list[$int]['link'] = $this->encrypt->encode($item['cheque_master_id']);
                $int++;
            }
            $this->smarty->assign("cheque_list", $list);
            $this->view->title = 'View requests';
            $this->view->render('header/list');
            $this->smarty->display(VIEW . 'admin/cheque/list.tpl');
            $this->view->render('footer/list');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E007]Error while payment request list initiate Error: for admin [' . $admin_id . '] ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function deposite() {
        try {
            $this->view->selectedMenu = 'deposite';
            $list = $this->model->getPendingCheque();
            $account_list=  $this->common->getAccountList();
            $this->smarty->assign("account_list", $account_list);
            $this->smarty->assign("cheque_list", $list);
            $this->view->render('header/create_invoice');
            $this->smarty->display(VIEW . 'admin/cheque/deposite.tpl');
            $this->view->render('footer/create_invoice');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E007]Error while payment request list initiate Error: for admin [' . $admin_id . '] ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function viewcheck($id) {
        $id = $this->encrypt->decode($id);
        $list = $this->model->getChequelist($id);
        $this->smarty->assign("cheque_list", $list);
        $this->view->render('nonlogoheader');
        $this->smarty->display(VIEW . 'admin/cheque/checks.tpl');
        $this->view->render('nonfooter');
    }

    public function getchequedetails($id) {
        $list = $this->model->getchequedetails($id);
        $date = new DateTime($list['cheque_date']);
        $list['cheque_date'] = $date->format('d M Y');
        echo json_encode($list);
    }

    function depositesave() {
        try {
            if (empty($_POST)) {
                header("Location:/admin/cheque/deposite");
            }
            $hasErrors = FALSE;
            if ($hasErrors == false) {
                $this->model->saveDeposite($_POST['cheque_id'], $_POST['account_id']);
                $this->session->set('successMessage', 'Deposite saved successfully.');
                header("Location:/admin/cheque/deposite");
            } else {
                
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E005]Error while sending payment request Error: for admin [' . $admin_id . '] and for template id [' . $template_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }
    
    /**
     * create invoice saved
     */
    function save() {
        try {
            if (empty($_POST)) {
                header("Location:/admin/cheque/add");
            }
            $hasErrors = FALSE;
            if ($hasErrors == false) {
                $int = 0;
                foreach ($_POST['cheque_date'] as $chq_date) {
                    $date = new DateTime($chq_date);
                    $cheque_date[] = $date->format('Y-m-d');
                }

                $date = new DateTime($_POST['date']);
                $result = $this->model->saveCheque($this->session->get('userid'), $_POST['customer_id'], $_POST['bank_id'], $date->format('Y-m-d'), $_POST['note'], $_POST['cheque_number'], $_POST['amount'], $cheque_date);
                $this->session->set('successMessage', 'Cheques saved successfully.');
                header("Location:/admin/cheque/viewlist");
            } else {
                
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E005]Error while sending payment request Error: for admin [' . $admin_id . '] and for template id [' . $template_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

}
