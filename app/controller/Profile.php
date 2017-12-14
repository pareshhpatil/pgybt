<?php

class Profile extends Controller {

    private $user_id = NUll;

    function __construct() {
        parent::__construct();
        $this->isLoggedIn();
        $this->view->js = array('validation.js');
        $group_id = $this->session->get('group_type');
        if ($group_id == 2) {
            $this->user_id = $this->session->get('sub_user_id');
        } else {
            $this->user_id = $this->session->get('userid');
        }
    }

    function reset() {
        try {
            $this->view->title = 'Reset password';
            $this->view->canonical = 'profile/reset';
            $this->HTMLValidationPrinter();
            $this->view->render('header/profile');
            $this->smarty->display(VIEW . 'profile/reset.tpl');
            $this->view->render('footer');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E083]Error while reset password initiate Error:  for user id [' . $this->user_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    function savepreferences() {
        try {
            $user_id = $this->user_id;
            $sms = isset($_POST['sms']) ? 1 : 0;
            $email = isset($_POST['email']) ? 1 : 0;
            $result = $this->model->updatepreferences($this->user_id, $sms, $email);
            header('Location: /profile/preferencesaved');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E084]Error while preference save Error:  for user id [' . $user_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    function preferences() {
        try {
            $user_id = $this->user_id;
            $result = $this->model->getpreferences($user_id);
            if (empty($result)) {
                SwipezLogger::error(__CLASS__, '[E085]Error while fetching user preferences. user id  ' . $user_id);
                $this->setGenericError();
            } else {
                $smschecked = '';
                $emailchecked = '';
                if ($result['send_sms'] == '1') {
                    $smschecked = 'checked';
                }
                if ($result['send_email'] == '1') {
                    $emailchecked = 'checked';
                }


                $this->smarty->assign("sms", $smschecked);
                $this->smarty->assign("email", $emailchecked);
                $this->view->canonical = 'profile/preferences';
                $this->HTMLValidationPrinter();
                $this->view->render('header/profile');
                $this->smarty->assign("user_type", $this->view->usertype);
                $this->view->title = ucfirst($this->view->usertype) . ' preferences';
                $this->smarty->display(VIEW . 'profile/preferences.tpl');
                $this->view->render('footer/profile');
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E086]Error while preferences initiate Error:  for user id [' . $user_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    function passwordsaved() {
        try {
            $user_id = $this->user_id;
            $message = 'Your password has been reset. Please remember to use your new password the next time you login to PGYBT.';
            $this->HTMLValidationPrinter();
            $this->view->render('header/profile');
            $this->smarty->assign("title", "Password reset successful");
            $this->smarty->assign("message", $message);
            $this->smarty->assign("user_type", $this->view->usertype);
            $this->smarty->display(VIEW . 'profile/success.tpl');
            $this->view->render('footer/profile');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E087]Error while reset password save Error:  for user id [' . $user_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    function preferencesaved() {
        try {
            $user_id = $this->user_id;
            $message = 'Your preferences has been stored successfully.';
            $this->HTMLValidationPrinter();
            $this->view->render('header/profile');
            $this->smarty->assign("message", $message);
            $this->smarty->assign("title", "Preference set successful");
            $this->smarty->assign("user_type", $this->view->usertype);
            $this->smarty->display(VIEW . 'profile/success.tpl');
            $this->view->render('footer/profile');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E088]Error while preferences save Error:  for user id [' . $user_id . '] ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function resetpassword() {
        try {
            if (empty($_POST)) {
                header('Location: /profile/reset');
            }
            $userid = $this->user_id;
            require CONTROLLER . 'Profilevalidator.php';
            $validator = new Profilevalidator($this->model);
            $validator->validateResetPassword($userid);
            $hasErrors = $validator->fetchErrors();

            if ($hasErrors == false) {
                $result = $this->model->resetPassword($_POST['password'], $userid);
                if (isset($result['email_id']) && isset($result['mobile_no'])) {
                    $mailid = $result['email_id'];
                    SwipezLogger::info(__CLASS__, "Sending email to : " . $mailid);
                    $this->model->sendMail($mailid, $this->session->get('user_name'));
                    //sending sms
                    $mobileNo = $result['mobile_no'];
                    $message = $this->model->fetchMessage('p6');
                    $this->model->sendSMS($message, $mobileNo);
                    header('Location: /profile/passwordsaved');
                } else {
                    SwipezLogger::error(__CLASS__, "[E089]Error while resetting password for user email id and mobile number not found from db for : " . $userid);
                    $errormessage = "There was an error while resetting your password. Please contact " . '<a href="/helpdesk" class="example5"> contact us</a>' . "  for help";
                    $this->setError("Password reset failed", $errormessage);
                    header('Location:/error');
                }
            } else {
                $this->smarty->assign("errors", $hasErrors);
                $this->reset();
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E090]Error while reset password Error:  for user id [' . $user_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

}
