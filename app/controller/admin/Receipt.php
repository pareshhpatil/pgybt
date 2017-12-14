<?php

/**
 * Invoice controller class to handle create and update invoice for patron
 */
class Receipt extends Controller {

    function __construct() {
        parent::__construct();

        //TODO : Check if using static function is causing any problems!
        $this->validateSession('admin');
    }

    public function view($link) {
        try {
            $installment_id = $this->encrypt->decode($link);
            $details = $this->common->getReceiptDetails($installment_id);
            $money_word = $this->word_money($details['amount']);
            $this->smarty->assign("money_word", $money_word);
            $this->smarty->assign("details", $details);
            $this->smarty->assign("details", $details);
            $this->view->render('header/list');
            $this->smarty->display(VIEW . 'admin/receipt.tpl');
            $this->view->render('footer/list');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E007]Error while payment request list initiate Error: for admin [' . $admin_id . '] ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function viewlist() {
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
            $this->smarty->assign("title", "Receipt List");
            $this->smarty->assign("type", "Receipt");
            $this->view->selectedMenu = 'r3';

            $fromdate = new DateTime($from_date);
            $todate = new DateTime($to_date);
            $installment_list = $this->common->getReceiptList($fromdate->format('Y-m-d'), $todate->format('Y-m-d'), $user_selected, 0);
            $int = 0;
            foreach ($installment_list as $item) {
                $installment_list[$int]['link'] = $this->encrypt->encode($item['emi_id']);
                $int++;
            }

            $this->smarty->assign("installment_list", $installment_list);
            $this->view->render('header/list');
            $this->smarty->display(VIEW . 'admin/receipt_list.tpl');
            $this->view->render('footer/list');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E007]Error while payment request list initiate Error: for admin [' . $admin_id . '] ' . $e->getMessage());
            $this->setGenericError();
        }
    }

}
