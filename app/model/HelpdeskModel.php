<?php

/**
 * Login model works for patron and admin login
 *
 * @author Paresh
 */
class HelpdeskModel extends Model {

    function __construct() {
        parent::__construct();
    }

    public function sendMail($user_name, $user_email,$subject, $user_message) {
        try {
            $emailWrapper = new EmailWrapper();
            $toEmail_="support@pgybt.in";
            #($toEmail_, $toName_, $subject_, $messageHTML_, $messageText_ = NULL)
            $body_message = "Name: " . $user_name. " <br>Email: ".$user_email."<br>" . "Message: <br>" . $user_message;
            $emailWrapper->sendMail($toEmail_, "",$subject,$body_message,$body_message,$user_email);
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E174]Error while sending mail Error:  for user email [' . $user_email .'] ' . $e->getMessage());
            $this->setGenericError();
        }
    }

        public function fetchMessage($type) {
        return $this->SMSMessage->fetch($type);
    }
}
