<?php

class ReportModel extends Model {

    function __construct() {
        parent::__construct();
    }

    public function getCustomerPolicyList($customer_id) {
        try {
            $sql = "call report_customer_policy(:customer_id);";
            $params = array(':customer_id' => $customer_id);
            $this->db->exec($sql, $params);
            $list = $this->db->resultset();
            return $list;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E109]Error while getting installment request list Error:  for Customer id[' . $customer_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getUserPolicyList($user_id) {
        try {
            $sql = "call report_user_policy(:user_id);";
            $params = array(':user_id' => $user_id);
            $this->db->exec($sql, $params);
            $list = $this->db->resultset();
            return $list;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E109]Error while getting installment request list Error:  for user id[' . $user_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getMaturityList($type) {
        try {
            $sql = "call get_MaturityList(:type);";
            $params = array(':type' => $type);
            $this->db->exec($sql, $params);
            $list = $this->db->resultset();
            return $list;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E109]Error while getting installment request list Error:  for user id[' . $user_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getIncomeList() {
        try {
            $sql = "select * from income;";
            $params = array();
            $this->db->exec($sql, $params);
            $list = $this->db->resultset();
            return $list;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E109]Error while getting installment request list Error:  for user id[' . $user_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

}

?>
