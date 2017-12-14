<?php

class ExpenseModel extends Model {

    function __construct() {
        parent::__construct();
    }

    public function saveExpense($user_id, $year_id, $category, $name, $amount, $receiver_name, $date, $payment_mode, $cheque_id, $note,$account_id, $against = '') {
        try {
            $sql = "INSERT INTO `expense`(`name`,`category`,`against`,`receiver_name`,`amount`,`pay_type`,`cheque_id`,`date`,`narrative`,`year_id`,`created_by`,`created_date`,`last_update_by`
                ,last_update_date)VALUES
                (:name,:category,:against,:receiver_name,:amount,:pay_type,:cheque_id,:date,:narrative,:year_id,:user_id,CURRENT_TIMESTAMP(),:user_id,CURRENT_TIMESTAMP());";
            $params = array(':name' => $name, ':category' => $category, ':against' => $against, ':receiver_name' => $receiver_name, ':amount' => $amount, ':pay_type' => $payment_mode,
                ':cheque_id' => $cheque_id, ':date' => $date, ':narrative' => $note, ':year_id' => $year_id, ':user_id' => $user_id);
            $this->db->exec($sql, $params);


        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E295]Error while creating Expense Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getExpenseList($f_fromdate, $f_todate) {
        try {
            $sql = "select * from expense where DATE_FORMAT(date,'%Y-%m-%d') >= :from_date and DATE_FORMAT(date,'%Y-%m-%d') <= :to_date";
            $params = array(':from_date' => $f_fromdate, ':to_date' => $f_todate);
            $this->db->exec($sql, $params);
            $list = $this->db->resultset();
            return $list;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E109]Error while getting payment request list Error:  for user id[' . $user_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getCategoryList() {
        try {
            $sql = "select distinct category from expense";
            $params = array();
            $this->db->exec($sql, $params);
            $list = $this->db->resultset();
            return $list;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E109]Error while getting payment request list Error:  for user id[' . $user_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

}

?>
