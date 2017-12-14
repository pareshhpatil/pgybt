<?php

/**
 * Report controller class to handle reports for admin
 */
class Chart extends Controller {

    function __construct() {
        parent::__construct();
        $this->validateSession('admin');
        $title = 'Chart';
        $this->view->userName = $this->session->get('display_name');
    }

    function billingstatus($is_iframe) {
        try {
            $user_id = $this->session->get('userid');
            $current_date = date("d M Y");
            $date = strtotime($current_date . ' -1 months');
            $last_date = date('d M Y', $date);

            if (isset($_POST['from_date'])) {
                $this->view->from_date = $_POST['from_date'];
                $this->view->to_date = $_POST['to_date'];
                $customer_name = $_POST['customer_name'];
            } else {
                $this->view->from_date = $last_date;
                $this->view->to_date = $current_date;
                $customer_name = '';
            }
            $fromdate = new DateTime($this->view->from_date);
            $todate = new DateTime($this->view->to_date);
            
            $this->view->reportlist = $this->model->get_ChartInvoiceStatus($fromdate->format('Y-m-d'), $todate->format('Y-m-d'));
            $this->view->chartJS = 'https://www.amcharts.com/lib/3/pie.js';
            $title = "User status";

            $this->smarty->assign("from_date", $this->view->from_date);
            $this->smarty->assign("to_date", $this->view->to_date);
            $this->smarty->assign("list", $this->view->reportlist);

            $this->smarty->assign("title", $title);
            if ($is_iframe == 1) {
                $this->view->render('admin/chart/iframe_header');
                $this->view->render('admin/chart/iframe_pie');
            } else {
                $this->view->render('header/chart');
                $this->smarty->display(VIEW . 'admin/chart/pie.tpl');
                $this->view->render('footer/chart');
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E001-R]Error while admin balance report Error: for admin [' . $user_id . '] ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    function paymentreceived($is_iframe) {
        try {
            $user_id = $this->session->get('userid');
            $current_date = date("d M Y");
            $date = strtotime($current_date . ' -15 days');
            $last_date = date('d M Y', $date);

            if (isset($_POST['from_date'])) {
                $this->view->from_date = $_POST['from_date'];
                $this->view->to_date = $_POST['to_date'];
                $customer_name = $_POST['customer_name'];
            } else {
                $this->view->from_date = $last_date;
                $this->view->to_date = $current_date;
                $customer_name = '';
            }


            $fromdate = new DateTime($this->view->from_date);
            $todate = new DateTime($this->view->to_date);
            $fromdate = $fromdate->format('Y-m-d');
            $todate = $todate->format('Y-m-d');
            $date = array();
            $start_date = $fromdate;
            while ($start_date <= $todate) {
                $date['date'][] = $start_date;
                $date['value'][] = 0;

                $start_date = strtotime($start_date . ' 1 days');
                $start_date = date('Y-m-d', $start_date);
            }

            $this->view->reportlist = $this->model->get_ChartPaymentReceived($fromdate, $todate);

            foreach ($this->view->reportlist as $value) {
                $key = array_search($value['name'], $date['date']);
                $date['value'][$key] = $value['value'];
            }
            $this->smarty->assign("from_date", $this->view->from_date);
            $this->smarty->assign("to_date", $this->view->to_date);
            $this->view->list = $date;
            $this->smarty->assign("list", $date);

            $this->view->chartJS = 'https://www.amcharts.com/lib/3/serial.js';
            $title = "Payment received";
            $this->smarty->assign("title", $title);
            if ($is_iframe == 1) {
                $this->view->render('admin/chart/iframe_header');
                $this->view->render('admin/chart/iframe_serial');
            } else {
                $this->view->render('header/chart');
                $this->smarty->display(VIEW . 'admin/chart/serial.tpl');
                $this->view->render('footer/chart');
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E001-R]Error while admin balance report Error: for admin [' . $user_id . '] ' . $e->getMessage());
            $this->setGenericError();
        }
    }

}
