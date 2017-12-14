<?php

class Home extends Controller {

    function __construct() {
        parent::__construct();
    }

    function home() {
        try {
            header('Location:/admin/dashboard');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E060]Error while home page initiate Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    function aboutus() {
        try {
            $this->view->title = 'About us';
            $this->view->canonical = 'home/aboutus';
            $this->view->metadata = '<title>PGYBT - Online Payment Services | Generate Invoices</title>
	<meta id="Meta Keywords" name="KEYWORDS" content="billing software, generate invoices, payment gateway, pgybt"/>
	<meta id="Meta Description" name="DESCRIPTION" content="PGYBT provides billing software facilities for small and medium businesses. With a fast, safe and user friendly online payment gateway."/>';
            $this->view->render('header/nonloggedinheader');
            $this->smarty->display(VIEW . 'home/aboutus.tpl');
            $this->view->render('footer/footer');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E061]Error while about us initiate Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    function contactus() {
        try {
            $this->view->title = 'Contact Us';
            $this->view->canonical = 'home/contactus';
//            $this->view->metadata = '';
            $this->view->render('header/nonloggedinheader');
            $this->smarty->display(VIEW . 'home/contactus.tpl');
            $this->view->render('footer/footer');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E284]Error while  help desk initiate Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    function returnpolicy() {
        try {
            $this->view->title = 'Cancellation & Refund Policy Policy';
            $this->view->canonical = 'home/returnpolicy';
            $this->view->render('header/nonloggedinheader');
            $this->smarty->display(VIEW . 'home/returnpolicy.tpl');
            $this->view->render('footer/footer');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E061]Error while returnpolicy initiate Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    function privacy($type = Null) {
        try {
            $this->view->title = 'Privacy policy';
            $this->view->canonical = 'home/privacy';
            $this->view->metadata = '<title>Privacy Policy | PGYBT</title>
	<meta id="Meta Keywords" name="KEYWORDS" content="privacy policy, pgybt privacy policy"/>
	<meta id="Meta Description" name="DESCRIPTION" content="PGYBT privacy policy which is as per the Indian Information Technology Act, 2000 and the Information Technology Rules, 2011."/>';
            if (substr($type, 0, 5) == 'popup') {
                $invoice_id = substr($type, 5);
                if ($invoice_id != '') {
                    require_once MODEL . 'CommonModel.php';
                    $commonmodel = new CommonModel();
                    $privacy = $commonmodel->getinvoicevalue($invoice_id);
                    $this->smarty->assign("privacy", $privacy);
                }
                $this->view->render('nonlogoheader');
                $this->smarty->display(VIEW . 'home/privacy.tpl');
                $this->view->render('nonfooter');
            } else {
                $this->view->render('header/nonloggedinheader');
                $this->smarty->display(VIEW . 'home/privacy.tpl');
                $this->view->render('footer/footer');
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E062]Error while privacy initiate Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    function terms($type = Null) {
        try {
            $this->view->title = 'Terms and conditions';
            $this->view->canonical = 'home/terms';
            $this->view->metadata = '<title>Terms of Use | PGYBT</title>
	<meta id="Meta Keywords" name="KEYWORDS" content="terms of use, pgybt terms of use"/>
	<meta id="Meta Description" name="DESCRIPTION" content="Know the admin acceptable use policy which is applicable to admins using PGYBT to manage or collect payments or both."/>';
            if (substr($type, 0, 5) == 'popup') {
                $invoice_id = substr($type, 5);
                if ($invoice_id != '') {
                    require_once MODEL . 'CommonModel.php';
                    $commonmodel = new CommonModel();
                    $terms = $commonmodel->getinvoicevalue($invoice_id);
                    $this->smarty->assign("terms", $terms);
                }
                $this->view->render('nonlogoheader');
                $this->smarty->display(VIEW . 'home/terms.tpl');
                $this->view->render('nonfooter');
            } else {
                $this->view->render('header/nonloggedinheader');
                $this->smarty->display(VIEW . 'home/terms.tpl');
                $this->view->render('footer/footer');
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E063]Error while terms initate Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    function register() {
        try {
            $this->view->title = 'Register';
            $this->view->canonical = 'home/register';
            $this->view->render('header/nonloggedinheader');
            $this->view->render('home/register');
            $this->view->render('footer/footer');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E064]Error while selecting register initiate Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    function howitworks() {
        try {
            $this->view->render('home/howitworks');
            $this->view->render('footer/nonfooter');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E065]Error while how it works initiate Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

}
