<?php

class AccountModel extends Model {

    function __construct() {
        parent::__construct();
    }

    public function saveAccount($category, $name, $account_number, $ifsc, $branch, $balance) {
        try {
            $sql = "INSERT INTO `saving_accounts`(`type`,`name`,`current_balance`,`account_number`,`ifsc_code`,`branch`,`created_date`)VALUES(:type,:name,:current_balance,:account_number,:ifsc_code,:branch,CURRENT_TIMESTAMP());";
            $params = array(':type' => $category, ':name' => $name, ':current_balance' => $balance, ':account_number' => $account_number, ':ifsc_code' => $ifsc, ':branch' => $branch);
            $this->db->exec($sql, $params);
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E295]Error while creating Expense Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getAccountList() {
        try {
            $sql = "select * from saving_accounts where is_active=1";
            $params = array();
            $this->db->exec($sql, $params);
            $list = $this->db->resultset();
            return $list;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E109]Error while getting payment request list Error:  for user id[' . $user_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getTransferList() {
        try {
            $sql = "select * from amount_transfer;";
            $params = array();
            $this->db->exec($sql, $params);
            $list = $this->db->resultset();
            return $list;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E109]Error while getting payment request list Error:  for user id[' . $user_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getAccountname($id) {
        try {
            $sql = "select name from saving_accounts where account_id=:id";
            $params = array(':id' => $id);
            $this->db->exec($sql, $params);
            $row = $this->db->single();
            return $row['name'];
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E109]Error while getting payment request list Error:  for user id[' . $user_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function saveTransfer($from_account, $to_account, $amount, $note, $user_id) {
        try {
            $sql = "INSERT INTO `amount_transfer`(`from_account`,`to_account`,`amount`,`note`,`created_by`)VALUES(:from_account,:to_account,:amount,:note,:user_id);";
            $params = array(':from_account' => $from_account, ':to_account' => $to_account, ':amount' => $amount, ':note' => $note, ':user_id' => $user_id);
            $this->db->exec($sql, $params);

            $sql = "update saving_accounts set current_balance= current_balance - " . $amount . " where account_id=:account_id;";
            $params = array(':account_id' => $from_account);
            $this->db->exec($sql, $params);

            $sql = "update saving_accounts set current_balance=current_balance + " . $amount . " where account_id=:account_id;";
            $params = array(':account_id' => $to_account);
            $this->db->exec($sql, $params);
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E295]Error while creating Expense Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

}

?>
