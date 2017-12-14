<?php

class RdModel extends Model {

    function __construct() {
        parent::__construct();
    }

    public function saveRD($login_id, $user_id, $year_id, $customer_id, $rd_number, $date, $installment, $intrest, $terms, $maturity_amount, $note) {
        try {
            $gtem = $terms + 1;
            $sql = "INSERT INTO `rd`(`rd_number`,`customer_id`,`user_id`,`installment`,`total_amount`,`maturity_amount`,`terms`,`intrest`,`date`,`maturity_date`,`note`,`year_id`,`created_by`,`created_date`,`last_update_by`,`last_update_date`)
                VALUES(:rd_number,:customer_id,:user_id,:installment,:total_amount,:maturity_amount,:terms,:intrest,:date,DATE_ADD( '" . $date . "', INTERVAL " . $gtem . " month ),:note,:year_id,:login_id,CURRENT_TIMESTAMP(),:login_id,CURRENT_TIMESTAMP());";
            $params = array(':rd_number' => $rd_number, ':customer_id' => $customer_id, ':user_id' => $user_id, ':installment' => $installment, ':total_amount' => $installment * $terms, ':maturity_amount' => $maturity_amount, ':terms' => $terms, ':intrest' => $intrest, ':date' => $date, ':note' => $note, ':year_id' => $year_id, ':login_id' => $login_id);
            $this->db->exec($sql, $params);
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E295]Error while creating supplier Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function saveRDInstallment($login_id, $user_id, $year_id, $customer_id, $rd_id, $date, $installment, $penalty, $payment_mode, $cheque_id, $note) {
        try {
            $penalty = ($penalty > 0) ? $penalty : 0;

            $type = 2;
            $sql = "INSERT INTO `installment`(`type`,`plan_id`,`customer_id`,`user_id`,`amount`,`late_fee`,`date`,`payment_type`,`cheque_id`,`year_id`,`note`,`created_date`,`created_by`,`updated_date`,`updated_by`)
                VALUES(:type,:rd_id,:customer_id,:user_id,:amount,:late_fee,:date,:payment_type,:cheque_id,:year_id,:note,CURRENT_TIMESTAMP(),:login_id,CURRENT_TIMESTAMP(),:login_id);";

            $params = array(':type' => $type, ':rd_id' => $rd_id, ':customer_id' => $customer_id, ':user_id' => $user_id, ':amount' => $installment, ':late_fee' => $penalty, ':date' => $date, ':payment_type' => $payment_mode, ':cheque_id' => $cheque_id, ':login_id' => $login_id, ':year_id' => $year_id, ':note' => $note, ':login_id' => $login_id);
            $this->db->exec($sql, $params);

            $sql = "select LAST_INSERT_ID() as id;";
            $params = array();
            $this->db->exec($sql, $params);
            $row = $this->db->single();
            return $row['id'];
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E295-1]Error while creating supplier Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getRDList($f_fromdate, $f_todate, $user_id) {
        try {
            $sql = "call get_rdList(:from_date,:to_date,:user_id);";
            $params = array(':from_date' => $f_fromdate, ':to_date' => $f_todate, ':user_id' => $user_id);
            $this->db->exec($sql, $params);
            $list = $this->db->resultset();
            return $list;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E109]Error while getting payment request list Error:  for user id[' . $user_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getRDInstallmentList($f_fromdate, $f_todate, $user_id) {
        try {
            $type = 2;
            $sql = "call get_EMIList(:type,:from_date,:to_date,:user_id);";
            $params = array(':type' => $type, ':from_date' => $f_fromdate, ':to_date' => $f_todate, ':user_id' => $user_id);
            $this->db->exec($sql, $params);
            $list = $this->db->resultset();
            return $list;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E109]Error while getting payment request list Error:  for user id[' . $user_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getRDDetails($rd_id) {
        try {
            $sql = "select * from rd where rd_id=:rd_id;";
            $params = array(':rd_id' => $rd_id);
            $this->db->exec($sql, $params);
            $list = $this->db->single();
            return $list;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E109]Error while getting payment request list Error:  for user id[' . $user_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getPaidInstallment($rd_id) {
        try {
            $sql = "select * from installment where plan_id=:rd_id and type=2;";
            $params = array(':rd_id' => $rd_id);
            $this->db->exec($sql, $params);
            $row = $this->db->resultset();
            return $row;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E109]Error while getting payment request list Error:  for user id[' . $user_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getRD_Number() {
        try {
            $sql = "select max(rd_id) as max_id from rd";
            $params = array();
            $this->db->exec($sql, $params);
            $rows = $this->db->single();
            $max_id = $rows['max_id'] + 1;

            $sql = "select id_name from financial_year where is_active=1";
            $params = array();
            $this->db->exec($sql, $params);
            $row = $this->db->single();
            $id_name = $row['id_name'];
            if ($max_id < 10) {
                $max_id = '00' . $max_id;
            } elseif ($max_id < 100) {
                $max_id = '0' . $max_id;
            }
            return 'RD' . $id_name . $max_id;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E105--6]Error RD number Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function saveMaturity($login_id, $user_id, $year_id, $customer_id, $type, $policy_id, $date, $maturity_date, $amount, $maturity_amount, $receiver_name, $payment_mode, $cheque_id, $note, $account_id) {
        try {
            $sql = "INSERT INTO `maturity`(`maturity_type`,`policy_id`,`customer_id`,`user_id`,`amount`,`maturity_amount`,`date`,`maturity_date`,`receiver_name`,`payment_type`,`cheque_id`,`year_id`,`note`,`created_date`,`created_by`,`updated_date`,`updated_by`)
                VALUES(:type,:policy_id,:customer_id,:user_id,:amount,:maturity_amount,:date,:maturity_date,:receiver_name,:payment_type,:cheque_id,:year_id,:note,CURRENT_TIMESTAMP(),:login_id,CURRENT_TIMESTAMP(),:login_id);";

            $params = array(':type' => $type, ':policy_id' => $policy_id, ':customer_id' => $customer_id, ':user_id' => $user_id, ':amount' => $amount, ':maturity_amount' => $maturity_amount, ':date' => $date, ':maturity_date' => $maturity_date, ':receiver_name' => $receiver_name, ':payment_type' => $payment_mode, ':cheque_id' => $cheque_id, ':login_id' => $login_id, ':year_id' => $year_id, ':note' => $note, ':login_id' => $login_id);

            $this->db->exec($sql, $params);

            $sql = "select LAST_INSERT_ID() as id;";
            $params = array();
            $this->db->exec($sql, $params);
            $row = $this->db->single();
            $maturity_id = $row['id'];

            if ($type == 1) {
                $type = 'rd';
            } else {
                $type = 'fd';
            }

            $sql = "update " . $type . " set is_matured=1 where " . $type . "_id=:policy_id";
            $params = array(':policy_id' => $maturity_id);
            $this->db->exec($sql, $params);

            return $maturity_id;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E295]Error while creating supplier Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

}

?>
