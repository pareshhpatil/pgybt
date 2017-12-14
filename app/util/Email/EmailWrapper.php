<?php

/**
 * Wrapper class around PHP Mailer library
 *
 * @author Shuhaid
 */
class EmailWrapper {

    private $_cre1 = NULL;
    private $_cre2 = NULL;
   
        
    function __construct() {
        $this->_cre1 = 'AKIAJTZPL6Q62PSFAIDQ';
        $this->_cre2 = 'Ajo6OlnKRPdXTlCfe8PZv/2+bRdVSlZyyzVWbTMw2K3e';
        
    }

    function sendMail($toEmail_, $toName_, $subject_, $messageHTML_ = NULL, $messageText_ = NULL, $replyTo_ = NULL) {
        try {
            require_once 'PHPMailer/PHPMailerAutoload.php';
            $mail = new PHPMailer;
            #$mail->SMTPDebug = 3;                                // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'email-smtp.us-east-1.amazonaws.com';   // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = $this->_cre1;                       // SMTP username
            $mail->Password = $this->_cre2;                       // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            $mail->From = 'pareshhpatil@gmail.com';
            $mail->FromName = 'PGYBT';
            $mail->addAddress($toEmail_, $toName_);     // Adds a recipient
            $mail->Subject = $subject_;
          
            if (isset($messageHTML_)) {
                // Set email format to HTML
                $mail->Body = $messageHTML_;
                $mail->isHTML(true);
            }

            if (isset($messageText_)) {
                $mail->AltBody = $messageText_;
            }

            if (isset($replyTo_)) {
                $mail->addReplyTo($replyTo_);
            } else {
                $mail->addReplyTo('support@ceyonemtl.in', 'PGYBT FINANCE');
            }
           
            if (!$mail->send()) {
                SwipezLogger::error(get_class($this), 'Email could not be sent to ' . $toEmail_ . ' ' . $mail->ErrorInfo);
            } else {
                SwipezLogger::info(get_class($this), 'Email sent to ' . $toEmail_);
            }
        } catch (Exception $e) {
            SwipezLogger::error(get_class($this), 'Email could not be sent to ' . $toEmail_ . ' ' . $e->getMessage());
        }
    }
    
    

    function fetchMailBody($key_) {
        $emailMessage = new EmailMessage();

        try {
            $mailcontents = $emailMessage->fetch($key_);
            if (!isset($mailcontents)) {
                SwipezLogger::warn("File contents found to be NULL for mail key : " . $key_);
                return NULL;
            }
            return $mailcontents;
        } catch (Exception $e_) {
            SwipezLogger::warn("Error occured while fetching mail file contents for " . $key_ . " " . $e_->getMessage());
        }
    }
    
    
    

}
