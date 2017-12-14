<?php

class ProfileModel extends Model {

    function __construct() {
        parent::__construct();
    }

    public function getPersonalDetails($userid) {
        try {
            $sql = "select first_name,last_name,email_id,mob_country_code,mobile_no,ll_country_code,landline_no,dob,city,state,country,zipcode,address1,address2 from user inner join user_addr on user.user_id=user_addr.user_id inner join user_cred on user.user_id=user_cred.user_id where user.user_id=:user_id";
            $params = array(':user_id' => $userid);
            $this->db->exec($sql, $params);
            $rows = $this->db->single();
            return $rows;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E115]Error while fetching personal details Error: for user id[' . $userid . ']' . $e->getMessage());
        }
    }

    public function getAdminDetails($userid) {
        try {
            $sql = "select admin.admin_id,admin.bulk_upload_limit,entity_type,industry_type,company_name,company_registration_number,pan,min_transaction,max_transaction,city,state,country,zipcode,address1,address2,business_email,business_phone,country_code from admin inner join admin_addr on admin.admin_id=admin_addr.admin_id where admin.user_id=:user_id";
            $params = array(':user_id' => $userid);
            $this->db->exec($sql, $params);
            $rows = $this->db->single();
            return $rows;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E116]Error while fetching admin details Error: for user id[' . $userid . ']' . $e->getMessage());
        }
    }

    public function getEntityType() {
        try {
            $sql = "select config_key, config_value from config where config_type='user_type'";
            $params = array();
            $this->db->exec($sql, $params);
            return $this->db->resultset();
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E117]Error while fetching entity type list Error: ' . $e->getMessage());
        }
    }

    public function getIndustryType() {
        try {
            $sql = "select config_key, config_value from config where config_type='industry_type'";
            $params = array();
            $this->db->exec($sql, $params);
            return $this->db->resultset();
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E118]Error while fetching entity type list Error: ' . $e->getMessage());
        }
    }

    public function getBankDetails($admin_id) {
        try {
            $sql = "select account_no,ifsc_code,account_type,config_value as bank_name from admin_bank_detail as b inner join config on b.bank_name=config.config_key where b.admin_id=:admin_id and config.config_type='bank_name'";
            $params = array(':admin_id' => $admin_id);
            $this->db->exec($sql, $params);
            $rows = $this->db->single();
            return $rows;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E119]Error while fetching personal details Error:for admin id[' . $admin_id . ']' . $e->getMessage());
        }
    }

    public function getPGDetails($admin_id) {
        try {
            $sql = "select * from admin_fee_detail where admin_id=:admin_id and is_active=1";
            $params = array(':admin_id' => $admin_id);
            $this->db->exec($sql, $params);
            $rows = $this->db->single();
            return $rows;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E120]Error while fetching personal details Error:for admin id[' . $admin_id . '] ' . $e->getMessage());
        }
    }

    public function pesonalUpdate($user_id, $email, $firstName, $lastName, $mobcountryCode, $mobile, $llCountryCode, $landline, $dob, $address, $address2
    , $city, $state, $country, $zip, $type, $industry_type, $company, $company_registration_number, $pan, $current_address, $current_address2, $current_city, $current_state, $current_country, $current_zip, $business_email, $country_code, $business_contact) {
        try {
            $sql = "call adminProfileUpdate(:user_id,:firstName,:lastName,:mobcountryCode,:mobile,:llCountryCode,:landline,:dob,:address,:address2,"
                    . ":city,:state,:country,:zip,:type,:industry_type,:company,:company_registration_number,:pan,:current_address,:current_address2,:current_city,:current_state,:current_country"
                    . ",:current_zip,:business_email,:country_code,:business_contact)";
            $params = array(':user_id' => $user_id, ':firstName' => ucfirst($firstName), ':lastName' => ucfirst($lastName), ':mobcountryCode' => $mobcountryCode,
                ':mobile' => $mobile, ':llCountryCode' => $llCountryCode, ':landline' => $landline,
                ':dob' => $dob, ':address' => $address, ':address2' => $address2, ':city' => $city, ':state' => $state,
                ':country' => $country, ':zip' => $zip, ':type' => $type, ':industry_type' => $industry_type, ':company' => $company, ':company_registration_number' => $company_registration_number, ':pan' => $pan,
                ':current_address' => $current_address, ':current_address2' => $current_address2, ':current_city' => $current_city, ':current_state' => $current_state,
                ':current_country' => $current_country, ':current_zip' => $current_zip, ':business_email' => $business_email, ':country_code' => $country_code, ':business_contact' => $business_contact);
            $this->db->exec($sql, $params);
            $row = $this->db->single();
            if ($row['message'] == 'success') {
                return $row['message'];
            } else {
                $sql = "show errors";
                $params = array();
                $this->db->exec($sql, $params);
                $row = $this->db->single();
                return $row['Message'];
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E121]Error while Updating personal details Error: for user id[' . $user_id . ']' . $e->getMessage());
        }
    }

}
