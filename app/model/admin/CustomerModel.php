<?php

class CustomerModel extends Model {

    function __construct() {
        parent::__construct();
    }

    public function getUserlist() {
        try {
            $sql = "select user_id,name from user where is_active=1";
            $params = array();
            $this->db->exec($sql, $params);
            return $this->db->resultset();
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E294]Error while fetching industry type list Error: ' . $e->getMessage());
        }
    }

    public function getCustomerDocument($customer_id) {
        try {
            $sql = "select * from document where customer_id=:customer_id;";
            $params = array(':customer_id' => $customer_id);
            $this->db->exec($sql, $params);
            return $this->db->resultset();
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E294]Error while fetching industry type list Error: ' . $e->getMessage());
        }
    }

    public function saveCustomer($name, $email, $mobile1, $mobile2, $current_address, $permanent_address, $reff_by, $join_date, $birth_date, $anniversary, $note, $file, $user_id
    , $pan, $voter_no, $uid, $nom1_name, $nom1_phone, $nom1_address, $nom2_name, $nom2_phone, $nom2_address, $vitnase_name, $vitnase_phone, $vitnase_address) {
        try {
            $photo = $this->uploadImage($file, 'customer_photo');
            $sql = "call `customer_save`(:name,:email,:mobile1,:mobile2,:current_address, :permanent_address,:reff_by ,:join_date , :birth_date,:anniversary,:note,:photo,:user_id,:pan,:voter_no,:uid,:nom1_name,:nom1_phone,:nom1_address,:nom2_name,:nom2_phone,:nom2_address,:vitnase_name,:vitnase_phone,:vitnase_address);";
            $params = array(':name' => $name, ':email' => $email, ':mobile1' => $mobile1, ':mobile2' => $mobile2, ':current_address' => $current_address,
                ':permanent_address' => $permanent_address, ':reff_by' => $reff_by, ':join_date' => $join_date, ':birth_date' => $birth_date, ':anniversary' => $anniversary, ':note' => $note, ':photo' => $photo, ':user_id' => $user_id
                , ':pan' => $pan, ':voter_no' => $voter_no, ':uid' => $uid, ':nom1_name' => $nom1_name, ':nom1_phone' => $nom1_phone, ':nom1_address' => $nom1_address, ':nom2_name' => $nom2_name, ':nom2_phone' => $nom2_phone, ':nom2_address' => $nom2_address
                , ':vitnase_name' => $vitnase_name, ':vitnase_phone' => $vitnase_phone, ':vitnase_address' => $vitnase_address);
            $this->db->exec($sql, $params);
            $row = $this->db->single();
            return $row;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E295]Error while creating supplier Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function updateCustomer($customer_id, $name, $email, $mobile1, $mobile2, $current_address, $permanent_address, $reff_by, $join_date, $birth_date, $anniversary, $note, $file, $user_id
    , $pan, $voter_no, $uid, $nom1_name, $nom1_phone, $nom1_address, $nom2_name, $nom2_phone, $nom2_address, $vitnase_name, $vitnase_phone, $vitnase_address) {
        try {
            $photo = $this->uploadImage($file, 'customer_photo');
            $sql = "call `customer_update`(:customer_id,:name,:email,:mobile1,:mobile2,:current_address, :permanent_address,:reff_by ,:join_date , :birth_date,:anniversary,:note,:photo,:user_id,:pan,:voter_no,:uid,:nom1_name,:nom1_phone,:nom1_address,:nom2_name,:nom2_phone,:nom2_address,:vitnase_name,:vitnase_phone,:vitnase_address);";
            $params = array(':customer_id' => $customer_id, ':name' => $name, ':email' => $email, ':mobile1' => $mobile1, ':mobile2' => $mobile2, ':current_address' => $current_address,
                ':permanent_address' => $permanent_address, ':reff_by' => $reff_by, ':join_date' => $join_date, ':birth_date' => $birth_date, ':anniversary' => $anniversary, ':note' => $note, ':photo' => $photo, ':user_id' => $user_id
                , ':pan' => $pan, ':voter_no' => $voter_no, ':uid' => $uid, ':nom1_name' => $nom1_name, ':nom1_phone' => $nom1_phone, ':nom1_address' => $nom1_address, ':nom2_name' => $nom2_name, ':nom2_phone' => $nom2_phone, ':nom2_address' => $nom2_address
                , ':vitnase_name' => $vitnase_name, ':vitnase_phone' => $vitnase_phone, ':vitnase_address' => $vitnase_address);
            $this->db->exec($sql, $params);
            $row = $this->db->single();
            return $row;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E295]Error while creating supplier Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function uploadImage($image_file, $folder) {
        try {
            if ($image_file['name'] != '') {
                $filename = basename($image_file['name']);
                $newname = 'uploads/images/' . $folder . '/' . $filename;
                //Check if the file with the same name is already exists on the server
                while (file_exists($newname)) {
                    $filename = '1' . $filename;
                    $newname = 'uploads/images/' . $folder . '/' . $filename;
                }
                //Attempt to move the uploaded file to it's new place
                if ((move_uploaded_file($image_file['tmp_name'], $newname))) {
                    return $filename;
                }
            }
            return '';
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E136]Error while uploading template logo Error: ' . $e->getMessage());
        }
    }

    public function getCustomerList() {
        try {
            $sql = "select c.customer_id,c.name as customer_name,u.name as reff_by,c.email,c.mobile1 from customer c inner join user u on u.user_id=c.user_id where c.is_active=1;";
            $params = array();
            $this->db->exec($sql, $params);
            $list = $this->db->resultset();
            return $list;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E296]Error while fetching supplier list Error: for user id[' . $userid . ']' . $e->getMessage());
        }
    }

    function deleteCustomer($customer_id, $user_id) {
        try {
            $sql = "UPDATE `customer` SET `is_active` = 0 , last_updated_by=`user_id` , last_updated_date=CURRENT_TIMESTAMP() WHERE customer_id=:customer_id";
            $params = array(':customer_id' => $customer_id, ':user_id' => $user_id);

            $this->db->exec($sql, $params);
            $this->db->closeStmt();
            return true;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E297]Error while update bulk upload status Error: for bulk id [' . $bulk_id . '] ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function updatesupplier($supplier_id, $user_id, $email1, $email2, $mob_country_code1, $mobile1, $mob_country_code2, $mobile2, $industrytype, $supplier_company_name, $contact_person_name, $contact_person_name2, $company_website) {
        try {

            $sql = "call `supplier_update`(:supplier_id,:user_id,:email1,:email2,:mob_country_code1,:mobile1,:mob_country_code2,:mobile2,:industrytype, :supplier_company_name ,:contact_person_name ,:contact_person_name2 , :company_website);";
            $params = array(':supplier_id' => $supplier_id, ':user_id' => $user_id, ':email1' => $email1, ':email2' => $email2, ':mob_country_code1' => $mob_country_code1, ':mobile1' => $mobile1,
                ':mob_country_code2' => $mob_country_code2,
                ':mobile2' => $mobile2, ':industrytype' => $industrytype, ':supplier_company_name' => ucfirst($supplier_company_name), ':contact_person_name' => ucfirst($contact_person_name), ':contact_person_name2' => ucfirst($contact_person_name2), ':company_website' => $company_website);
            $this->db->exec($sql, $params);
            $row = $this->db->single();
            return $row['message'];
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E298]Error while creating supplier Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getCustomerDetails($customer_id) {
        try {
            $sql = "SELECT `c`.`customer_id`,`c`.`user_id`,`c`.`name`,`c`.`email`,`c`.`mobile1`,`c`.`mobile2`,`c`.`dob`,`c`.`join_date`,`c`.`anniversary`,`c`.`narrative`,`c`.`address`,`c`.`permanent_address`,`c`.`photo`,`d`.`pan_no`,`d`.`voter_no`,`d`.`uid_no`,`d`.`nom1_name`,`d`.`nom2_name`,`d`.`nom1_address`,`d`.`nom2_address`,`d`.`nom1_phone`,`d`.`nom2_phone`,`d`.`vitnase_name`,`d`.`vitnase_phone`,`d`.`vitnase_address` FROM customer c inner join customer_detail d on c.customer_id=d.customer_id where c.customer_id=:customer_id;";
            $params = array(':customer_id' => $customer_id);
            $this->db->exec($sql, $params);
            $row = $this->db->single();
            //print_r($row);
            return $row;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E299]Error while fetching supplier details Error: for user id[' . $userid . ']' . $e->getMessage());
        }
    }

    public function saveDocument($customer_id, $name, $file, $user_id) {
        try {
            $doc = $this->uploadImage($file, 'customer_document');
            $sql = "INSERT INTO `document`(`name`,`customer_id`,`path`,`created_by`,`created_date`,`last_update_by`,`last_update_date`)VALUES(:name,:customer_id,:path,:user_id,CURRENT_TIMESTAMP(),:user_id,CURRENT_TIMESTAMP());";
            $params = array(':name' => $name, ':customer_id' => $customer_id, ':path' => $doc, ':user_id' => $user_id);
            $this->db->exec($sql, $params);
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E295-55]Error while creating supplier Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

}

?>
