<?php

/**
 * Invoice controller class to handle create and update invoice for patron
 */
class Expense extends Controller {

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
            $this->smarty->assign("title", "Expense");
            $this->view->selectedMenu = 'expense_add';
            $category_list = $this->model->getCategoryList();
            $this->smarty->assign("category_list", $category_list);
            $bank_list = $this->common->getAccountList();
            $this->smarty->assign("bank_list", $bank_list);
            $customerList = $this->common->getCustomerList();
            $this->smarty->assign("customer_list", $customerList);
            $this->view->render('header/create_invoice');
            $this->smarty->display(VIEW . 'admin/expense/create.tpl');
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

            $this->smarty->assign("from_date", $from_date);
            $this->smarty->assign("to_date", $to_date);
            $this->smarty->assign("title", "Expense list");
            $this->view->selectedMenu = 'expense_list';

            $fromdate = new DateTime($from_date);
            $todate = new DateTime($to_date);
            $expense_list = $this->model->getExpenseList($fromdate->format('Y-m-d'), $todate->format('Y-m-d'));
            $int = 0;
            foreach ($expense_list as $item) {
                $expense_list[$int]['paylink'] = $this->encrypt->encode($item['expense_id']);
                $int++;
            }

            $this->smarty->assign("expense_list", $expense_list);
            $this->view->render('header/list');
            $this->smarty->display(VIEW . 'admin/expense/list.tpl');
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
            if (!isset($_POST['amount'])) {
                header("Location:/admin/expense/create");
            }
            $hasErrors = FALSE;
            $year_id = $this->common->getyear_id();
            $user_id = $this->session->get('userid');
            if ($hasErrors == false) {
                $customer_id = 0;
                $cheque_id = 0;
                $cheque_date = new DateTime($_POST['cheque_date']);
                if ($_POST['payment_mode'] == 1) {
                    $cheque_id = $this->common->saveCheque($this->session->get('userid'), $customer_id, $_POST['cheque_number'], $_POST['bank_id'], $_POST['amount'], $cheque_date->format('Y-m-d'), 1);
                }

                $date = new DateTime($_POST['date']);
                $cheque_date = new DateTime($_POST['cheque_date']);
                $result = $this->model->saveExpense($user_id, $year_id, $_POST['category'], $_POST['name'], $_POST['amount'], $_POST['receiver_name'], $date->format('Y-m-d'), $_POST['payment_mode'], $cheque_id, $_POST['note'], $_POST['bank_id']);
                $this->common->addMoney_account($_POST['amount'], $_POST['bank_id']);
                $this->session->set('successMessage', 'Expense saved successfully.');
                header("Location:/admin/expense/viewlist");
            } else {
                
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E005]Error while sending payment request Error: for admin [' . $admin_id . '] and for template id [' . $template_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

}
