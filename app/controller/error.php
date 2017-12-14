<?php

class Error extends Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $title = $this->session->get('errorTitle');
        $errorMessage = $this->session->get('errorMessage');

        if (!isset($errorMessage)) {
            $title = 'Error';
            $link = 'error/index.tpl';
        } else {
            $this->smarty->assign("title", $title);
            $this->smarty->assign("message", $errorMessage);
            $link = 'error/message.tpl';
        }
        $this->session->remove('errorMessage');
        $this->session->remove('errorTitle');
        if ($this->usertype != '') {
            $this->view->render('header/profile');
        } else {
            $this->view->render('header/nonloggedinheader');
        }
        $this->smarty->display(VIEW . $link);
        $this->view->render('footer');
    }

    function oops() {
        $this->view->render('error/oops');
    }

    function forbidden() {
        $this->view->render('header/nonloggedinheader');
        $this->view->render('error/accessdenied');
        $this->view->render('footer/footer');
    }

}
