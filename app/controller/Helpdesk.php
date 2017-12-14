<?php

class Helpdesk extends Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        if ($this->session->get('logged_in') == TRUE) {
            $this->view->isloggedin = TRUE;
        } else {
            $this->view->isloggedin = FALSE;
        }
        $this->HTMLValidationPrinter();
        $this->view->render('helpdesk/index');
    }

    function send() {
        try {
            if (empty($_POST)) {
                header("Location:/helpdesk");
            }
            require CONTROLLER . 'Profilevalidator.php';
            $validator = new Profilevalidator($this->model);
            if ($this->session->get('logged_in') == TRUE) {
                $isloggedin = TRUE;
                $validator->validatehelpdeskwithlogin();
                $user_name = $this->session->get('user_name');
                $email = $this->session->get('email_id');
            } else {
                $isloggedin = FALSE;
                $validator->validatehelpdesknonlogin();
                $user_name = $_POST['name'];
                $email = $_POST['email'];
            }
            $hasErrors = $validator->fetchErrors();

            if ($hasErrors == false) {
                $this->model->sendMail($user_name, $email, $_POST['subject'],$_POST['message'], $isloggedin);
                $this->view->render('helpdesk/success');
            } else {
                $this->view->setError($hasErrors);
                $this->index();
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E059]Error while saving helpdesk Error: ' . $e->getMessage());
        }
    }

}
