<?php

/**
 * Invoice controller class to handle create and update invoice for patron
 */
class Account extends Controller {

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
            $this->smarty->assign("title", "Account");
            $this->view->selectedMenu = 'account_add';
            $this->view->render('header/create_invoice');
            $this->smarty->display(VIEW . 'admin/account/create.tpl');
            $this->view->render('footer/create_invoice');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E00f1]Error while admin invoice create initiate Error: for admin [' . $user_id . '] ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    function transfer() {
        try {
            $account_list = $this->model->getAccountList();
            $this->smarty->assign("account_list", $account_list);


            $transfer_list = $this->model->getTransferList();
            $int = 0;
            foreach ($transfer_list as $item) {
                $transfer_list[$int]['from_account'] = $this->model->getAccountname($item['from_account']);
                $transfer_list[$int]['to_account'] = $this->model->getAccountname($item['to_account']);
                $int++;
            }

            $this->smarty->assign("transfer_list", $transfer_list);
            $user_id = $this->session->get('userid');
            $this->smarty->assign("title", "Transfer Amount");
            $this->view->selectedMenu = 'transfer';
            $this->view->render('header/create_invoice');
            $this->smarty->display(VIEW . 'admin/account/transfer.tpl');
            $this->view->render('footer/create_invoice');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E00f1]Error while admin invoice create initiate Error: for admin [' . $user_id . '] ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function viewlist() {
        try {
            $account_list = $this->model->getAccountList();
            $int = 0;
            foreach ($account_list as $item) {
                $account_list[$int]['paylink'] = $this->encrypt->encode($item['account_id']);
                $int++;
            }
            $this->view->selectedMenu = 'account_list';
            $this->smarty->assign("title", "Account List");
            $this->smarty->assign("account_list", $account_list);
            $this->view->render('header/list');
            $this->smarty->display(VIEW . 'admin/account/list.tpl');
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
            if (!isset($_POST['balance'])) {
                header("Location:/admin/account/create");
            }
            $hasErrors = FALSE;
            if ($hasErrors == false) {
                $result = $this->model->saveAccount($_POST['category'], $_POST['name'], $_POST['account_number'], $_POST['ifsc'], $_POST['branch'], $_POST['balance']);
                $this->session->set('successMessage', 'Account saved successfully.');
                header("Location:/admin/account/viewlist");
            } else {
                
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E005]Error while sending payment request Error: for admin [' . $admin_id . '] and for template id [' . $template_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    function transfersave() {
        try {
            if (!isset($_POST['amount'])) {
                header("Location:/admin/account/transfer");
            }
            $hasErrors = FALSE;
            if ($hasErrors == false) {
                $result = $this->model->saveTransfer($_POST['from_id'], $_POST['to_id'], $_POST['amount'], $_POST['note'], $this->session->get('userid'));
                $this->session->set('successMessage', 'Amount Transfered successfully.');
                header("Location:/admin/account/transfer");
            } else {
                
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E005]Error while sending payment request Error: for admin [' . $admin_id . '] and for template id [' . $template_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

}
