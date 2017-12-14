<?php

/**
 * Login model works for patron and admin login
 *
 * @author Paresh
 */
class LoginModel extends Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * Queries database and fetches user id and status from user table
     * 
     * @param type $email
     * @param type $password
     * @param type $usertype
     * @return type associate array of user_id and user_status values if fetched from DB
     * 
     */
    public function queryLoginInfo($email, $password) {
        try {
            $sql = "call loginCheck(:email_id,:password)";
            $params = array(':email_id' => $email, ':password' => $password);
            $this->db->exec($sql, $params);
            $data = $this->db->single();
            return $data;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E175]Error while checking login Error:  for email [' . $email.'] ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function forgotPasswordRequest($email) {
        try {
            $sql = "call forgotPassword(:email_id);";
            $params = array(':email_id' => $email);
            $this->db->exec($sql, $params);
            $data = $this->db->single();
            return $data['@string'];
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E176]Error while forgot password request Error: for email [' . $email.']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function isValidforgotpasswordlink($link) {
        try {
            $converter = new Encryption;
            $link = $converter->decode($link);
            $sql = "SELECT email_id FROM forgot_password where concat(last_update_date,'',email_id)=:link";
            $params = array(':link' => $link);
            $this->db->exec($sql, $params);
            $data = $this->db->single();
            if (!empty($data)) {
                $link = $converter->encode($data['email_id']);
            }
            return !empty($data) ? $link : 'failed';
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E177]Error while validating forgot password link Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    /**
     * Method is used to sending email
     * 
     * @param type $str
     */
    public function sendMail($concatStr_, $toEmail_) {
        try {
            $converter = new Encryption;
            $encoded = $converter->encode($concatStr_);
            $baseurl = $this->host.'://' . $_SERVER['SERVER_NAME'];
            $forgotpasswdurl = $baseurl . '/login/forgotpassword/' . $encoded . '';

            $emailWrapper = new EmailWrapper();
            $mailcontents = $emailWrapper->fetchMailBody("user.forgotpassword");

            if (isset($mailcontents[0]) && isset($mailcontents[1])) {
                $message = $mailcontents[0];
                $message = str_replace('__EMAILID__', $toEmail_, $message);
                $message = str_replace('__LINK__', $forgotpasswdurl, $message);
                $message = str_replace('__BASEURL__', $baseurl, $message);

                #($toEmail_, $toName_, $subject_, $messageHTML_, $messageText_ = NULL)
                $emailWrapper->sendMail($toEmail_, "", $mailcontents[1], $message);
            } else {
                SwipezLogger::warn("Mail could not be sent with forgot password link to : " . $toEmail_);
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E178]Error while sending mail Error: for email [' . $toEmail_ .']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function resetPassword($password, $email_id) {
        try {
            $converter = new Encryption;
            $email_id = $converter->decode($email_id);
            $sql = "select user_id from user where email_id=:email_id ";
            $params = array(':email_id' => $email_id);
            $this->db->exec($sql, $params);
            $row = $this->db->single();
            $user_id = $row['user_id'];

            $sql = "update user_cred set password=:password , last_update_by=:user_id,last_update_date=CURRENT_TIMESTAMP() where user_id=:user_id";
            $params = array(':password' => $password, ':user_id' => $user_id);
            $this->db->exec($sql, $params);
            $this->db->closeStmt();
            
            $sql = "update user set user_status = prev_status where user_id=:user_id and user_status=18";
            $params = array(':user_id' => $user_id);
            $this->db->exec($sql, $params);
            $this->db->closeStmt();

            $sql = "update forgot_password set is_active=0 , last_update_date=CURRENT_TIMESTAMP() where email_id=:email_id";
            $params = array(':email_id' => $email_id);
            $this->db->exec($sql, $params);
            $this->db->closeStmt();
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E179]Error while resetting password Error: for email [' . $email_id.']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getUserTimeStamp($userid) {
        try {
            $sql = "select  CONCAT(user_id, last_updated_date) as username from user where user_id=:user_id";
            $params = array(':user_id' => $userid);
            $this->db->exec($sql, $params);
            $row = $this->db->single();
            return $row['username'];
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E180]Error while getting user timespam Error:  for user id[' . $userid.']' . $e->getMessage());
        }
    }

}
