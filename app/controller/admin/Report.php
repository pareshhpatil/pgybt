<?php

/**
 * Supplier controller class to handle Merchants supplier
 */
class Report extends Controller {

    protected $text = '';

    function __construct() {
        parent::__construct();
        $this->validateSession('admin');
    }

    function customerpolicy() {
        try {

            $customer_selected = ($_POST['customer_id'] > 0) ? $_POST['customer_id'] : 0;
            $customer_list = $this->common->getCustomerList();

            $this->smarty->assign("customer_selected", $customer_selected);
            $this->smarty->assign("customer_list", $customer_list);
            $this->smarty->assign("title", "RD Installment List");
            $this->view->selectedMenu = 'r1';

            $policy_list = $this->model->getCustomerPolicyList($customer_selected);
            $this->smarty->assign("list", $policy_list);
            $this->view->render('header/list');
            $this->smarty->display(VIEW . 'admin/report/customerpolicy.tpl');
            $this->view->render('footer/list');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E00989]Error while payment request list initiate Error: for admin [' . $admin_id . '] ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    function userpolicy() {
        try {

            $user_selected = ($_POST['user_id'] > 0) ? $_POST['user_id'] : 0;
            $user_list = $this->common->getUserList();

            $this->smarty->assign("user_selected", $user_selected);
            $this->smarty->assign("user_list", $user_list);
            $this->smarty->assign("title", "RD Installment List");
            $this->view->selectedMenu = 'r2';

            $policy_list = $this->model->getUserPolicyList($user_selected);
            $this->smarty->assign("list", $policy_list);
            $this->view->render('header/list');
            $this->smarty->display(VIEW . 'admin/report/userpolicy.tpl');
            $this->view->render('footer/list');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E00989]Error while payment request list initiate Error: for admin [' . $admin_id . '] ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    function maturitylist() {
        try {
            $type = ($_POST['type'] > 0) ? $_POST['type'] : 0;

            $this->smarty->assign("type", $type);
            $this->smarty->assign("title", "Maturity List");
            $this->view->selectedMenu = 'r4';

            $maturity_list = $this->model->getMaturityList($type);
            $this->smarty->assign("list", $maturity_list);
            $this->view->render('header/list');
            $this->smarty->display(VIEW . 'admin/report/maturitylist.tpl');
            $this->view->render('footer/list');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E00989]Error while payment request list initiate Error: for admin [' . $admin_id . '] ' . $e->getMessage());
            $this->setGenericError();
        }
    }
    
    function incomelist() {
        try {
            $this->smarty->assign("title", "Income List");
            $this->view->selectedMenu = 'r5';

            $income_list = $this->model->getIncomeList();
            $this->smarty->assign("list", $income_list);
            $this->view->render('header/list');
            $this->smarty->display(VIEW . 'admin/report/incomelist.tpl');
            $this->view->render('footer/list');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E00989]Error while payment request list initiate Error: for admin [' . $admin_id . '] ' . $e->getMessage());
            $this->setGenericError();
        }
    }

}

?>
