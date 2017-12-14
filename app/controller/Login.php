<?php

class Login extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->js = array('validation.js');
    }

    function index($type = NULL) {
        try {
            if ($this->session->get('logged_in') == TRUE) {
                $usertype = ($this->session->get('user_status') != ACTIVE_PATRON) ? 'admin' : 'patron';
                header("Location:/" . $usertype . "/dashboard");
            }
            $this->view->isPatron = ($type == 'patron') ? TRUE : FALSE;
            $this->view->showCaptcha = $this->session->get('show_captcha');
            $this->view->title = 'Sign in';
            $this->view->canonical = 'login';
            $this->view->type = "login";
            $this->HTMLValidationPrinter();
            $this->view->render('login/login');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E066]Error while login initiate Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    function forgot() {
        try {
            $user_id = $this->session->get('userid');
            $this->view->canonical = 'login/forgot';
            $this->view->title = 'Forgot password';
            $this->view->type = "forgot";
            $this->HTMLValidationPrinter();
            $this->view->render('login/login');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E067]Error while forgot initiate Error:  for user id [' . $user_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    function success() {
        try {
            $user_id = $this->session->get('userid');
            $this->view->title = 'Password reset success';
            $this->view->canonical = 'login/success';
            $this->HTMLValidationPrinter();
            $this->view->render('header/nonloggedinheader');
            $this->view->render('login/message');
            $this->view->render('footer/footer');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E068]Error while password reset success initiate Error:  for user id [' . $user_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    function forgotrequestsuccess() {
        try {
            $user_id = $this->session->get('userid');
            $this->view->title = 'Forgot password link sent';
            $this->view->canonical = 'login/forgotrequestsuccess';
            $this->HTMLValidationPrinter();
            $this->view->render('header/nonloggedinheader');
            $this->view->render('login/forgotrequestsave');
            $this->view->render('footer/footer');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E069]Error while forgot request success Error:  for user id [' . $user_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    function forgotrequest() {
        try {
            if (isset($_POST['email'])) {

                $result = $this->validateCaptcha($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
                if ($result) {
                    require CONTROLLER . 'Profilevalidator.php';
                    $validator = new Profilevalidator($this->model);
                    $validator->validateForgotPasswordRequest();
                    $hasErrors = $validator->fetchErrors();
                } else {
                    $hasErrors[0][0] = "Captcha";
                    $hasErrors[0][1] = "Invalid captcha please click on captcha box";
                }
                if ($hasErrors == false) {
                    $result = $this->model->forgotPasswordRequest($_POST['email']);
                    if ($result != 'error') {
                        $data = $this->model->sendMail($result, $_POST['email']);
                        header('Location:/login/forgotrequestsuccess');
                    } else {
                        $this->setError('Invalid email id', 'This email id is not registered with PGYBT. Please click <a href="/home/register"> here </a> if you would like to start using PGYBT with this email id');
                        header("Location:/error");
                    }
                } else {
                    $this->view->setError($hasErrors);
                    $this->forgot();
                }
            } else {
                header('Location:/error');
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E070]Error while forgot email send Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    function forgotpassword($link) {
        try {

            $result = $this->model->isValidforgotpasswordlink($link);
            if ($result != 'failed') {
                $this->session->remove('show_captcha');
                $this->session->remove('is_disable');
                $this->session->remove('disable_email');
                $this->view->link = $link;
                $this->view->email = $result;
                $this->view->title = 'Forgot password reset';
                $this->view->canonical = 'login/forgotrequest';
                $this->HTMLValidationPrinter();
                $this->view->render('header/nonloggedinheader');
                $this->view->render('login/forgotpassword');
                $this->view->render('footer/footer');
            } else {
                $this->setError('Link is not valid anymore', 'This link is not valid anymore as it was already used once OR has expired.');
                header("Location:/error");
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E071]Error while listing patron transaction Error:  ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    function resetpassword($link) {
        try {

            require CONTROLLER . 'Profilevalidator.php';
            $validator = new Profilevalidator($this->model);
            $validator->validateForgotResetPassword();
            $hasErrors = $validator->fetchErrors();
            if ($hasErrors == false) {
                $result = $this->model->resetPassword($_POST['password'], $_POST['email']);
                header('Location: /login/success');
            } else {
                $this->view->setError($hasErrors);
                $this->forgotpassword($link);
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E072]Error while reset password Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    function failed($returnurl = NULL) {
        try {
            if (empty($_POST)) {
                header('Location:/login');
            }
            $data = $this->model->queryLoginInfo($_POST['username'], $_POST['password']);
            if (isset($data['message'])) {
                $this->view->setError('There was an error with your E-Mail/Password combination. Please try again.');
                $this->index();
            } else {
                $this->session->set('user_name', $data['name']);
                $this->session->set('logged_in', TRUE);
                $this->session->set('userid', $data['user_id']);
                header('Location:/admin/dashboard');
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E073]Error while login check Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function keepalive() {
        $_SESSION['last_action'] = time();
    }

}
