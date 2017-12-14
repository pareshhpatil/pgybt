<?php

/**
 * Register patron model works on tables required for Patron registration
 *
 * @author Shuhaid
 */
class RegisterModel extends Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * Method saves a new patron to the database
     * 
     * @param type $email
     * @param type $fname
     * @param type $lname
     * @param type $mobile
     * @param type $landline
     * @param type $password
     * @param type $dob
     * @param type $address
     * @param type $city
     * @param type $state
     * @param type $zip
     * @return string
     */
    public function createAdmin($email, $fname, $lname, $mob_country_code, $mobile, $ll_country_code, $landline, $password, $dob, $addressfull, $city, $state, $country, $zip, $type, $industrytype, $company, $registration_no, $pan, $current_addressfull, $current_city, $current_state, $current_country, $current_zip, $business_email, $business_contact_code, $business_contact) {
        try {
            $address = substr($addressfull, 0, 250);
            $address2 = substr($addressfull, 250);
            $current_address = substr($current_addressfull, 0, 250);
            $current_address2 = substr($current_addressfull, 250);


            $sql = "call `admin_register`(:email,:fname,:lname,:mob_country_code,:mobile,:ll_country_code,:landline,:password,:dob,:address,:address2,:city,:state,:country,:zip,:type,:industry_type,:company,:company_registration_number,:pan,:current_address,:current_address2,:current_city,:current_state,:current_country,:current_zip,:business_email,:business_contact_code,:business_contact);";
            $params = array(':email' => $email, ':fname' => ucfirst($fname), ':lname' => ucfirst($lname), ':mob_country_code' => $mob_country_code, ':mobile' => $mobile,
                ':ll_country_code' => $ll_country_code, ':landline' => $landline, ':password' => $password, ':dob' => $dob, ':address' => $address, ':address2' => $address2, ':city' => $city, ':state' => $state, ':country' => $country, ':zip' => $zip, ':type' => $type, ':industry_type' => $industrytype, ':company' => $company, ':company_registration_number' => $registration_no, ':pan' => $pan, ':current_address' => $current_address, ':current_address2' => $current_address2, ':current_city' => $current_city, ':current_state' => $current_state, ':current_country' => $current_country, ':current_zip' => $current_zip, ':business_email' => $business_email, ':business_contact_code' => $business_contact_code, ':business_contact' => $business_contact);
            $this->db->exec($sql, $params);
            $row = $this->db->single();
            $this->db->closeStmt();

            if (isset($row['email_id']) && $row['email_id'] != '') {
                $row['Message'] = 'success';
            } else {
                $sql = "show errors";
                $params = array();
                $this->db->exec($sql, $params);
                $row = $this->db->single();
            }
            return $row;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E122]Error while creating admin Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function createAdminEntity($admin_id, $address, $address2, $city, $state, $country, $zip, $type, $industrytype, $company, $registration_no, $pan, $current_address, $current_address2, $current_city, $current_state, $current_country, $current_zip, $business_email, $business_contact_code, $business_contact) {
        try {
            $zero = 0;
            $empty = '';
            $sql = "call `entity_save`(:username,:address,:address2,:city,:state,:country,:zip,:type,:industry_type,:company,:company_registration_number,:pan,:current_address,:current_address2,:current_city,:current_state,:current_country,:current_zip,:business_email,:business_contact_code,:business_contact);";
            $params = array(':username' => $admin_id, ':address' => $address, ':address2' => $address2, ':city' => $city, ':state' => $state, ':country' => $country, ':zip' => $zip, ':type' => $type, ':industry_type' => $industrytype, ':company' => $company, ':company_registration_number' => $registration_no, ':pan' => $pan, ':current_address' => $current_address, ':current_address2' => $current_address2, ':current_city' => $current_city, ':current_state' => $current_state, ':current_country' => $current_country, ':current_zip' => $current_zip, ':business_email' => $business_email, ':business_contact_code' => $business_contact_code, ':business_contact' => $business_contact);
            $this->db->exec($sql, $params);
            $row = $this->db->single();
            if (isset($row['email_id']) && $row['email_id'] != '') {
                $row['Message'] = 'success';
            } else {
                $sql = "show errors";
                $params = array();
                $this->db->exec($sql, $params);
                $row = $this->db->single();
            }
            return $row;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E123]Error while saving entity details Error: for admin id[' . $admin_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    /**
     * Method is used to sending email
     * 
     * @param type $str
     */
    public function sendMail($concatStr_, $toEmail_, $type, $company_name = NULL, $first_name = NULL, $last_name = NULL, $contact = NULL) {
        try {
            $emailWrapper = new EmailWrapper();
            if ($type == 'verify') {
                $converter = new Encryption;
                $encoded = $converter->encode($concatStr_);
                $baseurl = $this->host . '://' . $_SERVER['SERVER_NAME'];
                $verifyemailurl = $baseurl . '/admin/register/verifyemail/' . $encoded . '';
                $mailcontents = $emailWrapper->fetchMailBody("user.verifyemail");
                if (isset($mailcontents[0]) && isset($mailcontents[1])) {
                    $message = $mailcontents[0];
                    $message = str_replace('__EMAILID__', $toEmail_, $message);
                    $message = str_replace('__LINK__', $verifyemailurl, $message);
                    $message = str_replace('__BASEURL__', $baseurl, $message);

                    #($toEmail_, $toName_, $subject_, $messageHTML_, $messageText_ = NULL)
                    $emailWrapper->sendMail($toEmail_, "", $mailcontents[1], $message);
                } else {
                    SwipezLogger::warn("Mail could not be sent with verify email link to : " . $toEmail_);
                }
            } else {
                $mailcontents = $emailWrapper->fetchMailBody("admin.welcomemail");
                if (isset($mailcontents[0]) && isset($mailcontents[1])) {
                    $message = $mailcontents[0];
                    $message = str_replace('__BASEURL__', $baseurl, $message);

                    #($toEmail_, $toName_, $subject_, $messageHTML_, $messageText_ = NULL)
                    $emailWrapper->sendMail($toEmail_, "", $mailcontents[1], $message);
                } else {
                    SwipezLogger::warn("Mail could not be sent with verify email link to : " . $toEmail_);
                }
                /*
                 * Mail to support@pgybt.in after new admin signup
                 */
                $mode = getenv('ENV');
                if ($mode == "PROD") {
                    $adminemail = $toEmail_;
                    $toEmail_ = "support@pgybt.in";
                    $body_message = "New Admin has signed-up with PGYBT,having Email-id :" . $adminemail . "<br>First name :" . $first_name . "<br>Last name :" . $last_name . "<br>Company name :" . $company_name . "<br>Contact :" . $contact;
                    $subject = "New Admin Signup";
                    $emailWrapper->sendMail($toEmail_, "", $subject, $body_message, $body_message, $adminemail);
                } else {
                    SwipezLogger::warn("Mail could not be sent to : " . $toEmail_);
                }
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E124]Error while sending mail Error: ' . $e->getMessage());
        }
    }

    /**
     * Method is used to fetch concatenated userid and created_date from DB 
     * 
     * @param type $userid
     * @return userid in string format 
     */
    public function getUserTimeStamp($userid) {
        try {
            $sql = "select  CONCAT(user_id, created_date) as username from user where user_id=:user_id";
            $params = array(':user_id' => $userid);
            $this->db->exec($sql, $params);
            $row = $this->db->single();
            return $row['username'];
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E125]Error while getting user timespam Error: for user id[' . $userid . ']' . $e->getMessage());
        }
    }

    /*
     * Checks patrons user id and created date against the link clicked by the user
     * 
     * @param type $url
     * @return userid in string format
     */

    public function validateEmailVerificationLink($link) {
        try {
            $converter = new Encryption;
            $url = $converter->decode($link);
            $user = substr($url, 0, 10);
            $credate = substr($url, 10);

            $sql = "SELECT `user_id`,user_status FROM `user` where user_id=:user_id and created_date=:credate and user_status in(11,19)";
            $params = array(':user_id' => $user, ':credate' => $credate);
            $this->db->exec($sql, $params);
            $row = $this->db->single();
            if ($row['user_id'] != '') {
                if ($row['user_status'] == 11) {
                    $this->updateAdminUserStatus(15, $row['user_id']);
                    $this->changeOnboardingStatus($row['user_id'], 2);
                    $row['type'] = 1;
                } else {
                    $this->updateAdminUserStatus(20, $row['user_id']);
                    $row['type'] = 2;
                }
                return $row;
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E126]Error while validate email verification link Error: ' . $e->getMessage());
        }
    }

    /**
     * method is used to update user status 
     * 
     * @param type $status int
     * @param type $username string
     */
    public function updateAdminUserStatus($status, $username) {
        try {
            $sql = 'UPDATE `user` SET `prev_status`=user_status,`user_status`=:status,last_updated_by=`user_id`'
                    . ', last_updated_date=CURRENT_TIMESTAMP() WHERE user_id=:user_id';

            $params = array(':status' => $status, ':user_id' => $username);
            $this->db->exec($sql, $params);
            $this->db->closeStmt();
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E127]Error while updating admin user status Error: ' . $e->getMessage());
        }
    }

    public function changeOnboardingStatus($user_id, $status) {
        try {
            $sql = "update admin set admin_status=:status where user_id=:user_id";
            $params = array(':user_id' => $user_id, ':status' => $status);
            $this->db->exec($sql, $params);
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E212]Error while getting package details Error:  for user id[' . $user_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function emailAlreadyExists($emailId_) {
        try {
            $sql = "SELECT `user_id` FROM `user` where email_id=:email";
            $params = array(':email' => $emailId_);

            $this->db->exec($sql, $params);
            $row = $this->db->single();

            if (isset($row['user_id'])) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E128]Error while checking email exist Error: ' . $e->getMessage());
        }
    }

    public function getEntityType() {
        try {
            $sql = "select config_key, config_value from config where config_type='user_type'";
            $params = array();
            $this->db->exec($sql, $params);
            return $this->db->resultset();
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E129]Error while fetching entity type list Error: ' . $e->getMessage());
        }
    }

    public function getIndustryType() {
        try {
            $sql = "select config_key, config_value from config where config_type='industry_type'";
            $params = array();
            $this->db->exec($sql, $params);
            return $this->db->resultset();
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E130]Error while fetching entity type list Error: ' . $e->getMessage());
        }
    }

    public function getUserList($user_id) {
        try {
            $sql = "select email_id,mob_country_code,mobile_no from user inner join user_addr on user.user_id=user_addr.user_id where user.user_id=:user_id";
            $params = array(':user_id' => $user_id);
            $this->db->exec($sql, $params);
            return $this->db->single();
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E131]Error while fetching user list data Error: for user id[' . $user_id . ']' . $e->getMessage());
        }
    }

}
