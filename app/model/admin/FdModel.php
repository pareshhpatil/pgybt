<?php

class FdModel extends Model {

    function __construct() {
        parent::__construct();
    }

    public function saveFD($login_id, $user_id, $year_id, $customer_id, $fd_number, $date, $fd_amount, $intrest, $terms, $maturity_amount, $note, $payment_mode, $cheque_id) {
        try {
            $mterms = $terms;
            $sql = "INSERT INTO `fd`(`fd_number`,`customer_id`,`user_id`,`fd_amount`,`maturity_amount`,`terms`,`intrest`,`date`,`maturity_date`,`note`,`year_id`,`created_by`,`created_date`,`last_update_by`,`last_update_date`)
                VALUES(:fd_number,:customer_id,:user_id,:fd_amount,:maturity_amount,:terms,:intrest,:date,DATE_ADD('" . $date . "',INTERVAL " . $mterms . " MONTH),:note,:year_id,:login_id,CURRENT_TIMESTAMP(),:login_id,CURRENT_TIMESTAMP());";
            $params = array(':fd_number' => $fd_number, ':customer_id' => $customer_id, ':user_id' => $user_id, ':fd_amount' => $fd_amount, ':maturity_amount' => $maturity_amount,
                ':terms' => $terms, ':intrest' => $intrest, ':date' => $date, ':note' => $note, ':year_id' => $year_id, ':login_id' => $login_id);
            $this->db->exec($sql, $params);

            $sql = "select LAST_INSERT_ID() as fd_id;";
            $params = array();
            $this->db->exec($sql, $params);
            $row = $this->db->single();

            $sql = "INSERT INTO `installment`(`type`,`plan_id`,`customer_id`,`user_id`,`amount`,`late_fee`,`date`,`payment_type`,`cheque_id`,`year_id`,`note`,`created_date`,`created_by`,`updated_date`,`updated_by`)
                VALUES(:type,:rd_id,:customer_id,:user_id,:amount,:late_fee,:date,:payment_type,:cheque_id,:year_id,:note,CURRENT_TIMESTAMP(),:login_id,CURRENT_TIMESTAMP(),:login_id);";
            $params = array(':type' => 3, ':rd_id' => $row['fd_id'], ':customer_id' => $customer_id, ':user_id' => $user_id, ':amount' => $fd_amount, ':late_fee' => 0, ':date' => $date, ':payment_type' => $payment_mode, ':cheque_id' => $cheque_id, ':login_id' => $login_id, ':year_id' => $year_id, ':note' => $note, ':login_id' => $login_id);
            $this->db->exec($sql, $params);
            return $row;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E295]Error while creating supplier Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getFDList($f_fromdate, $f_todate, $user_id) {
        try {
            $sql = "call get_fdList(:from_date,:to_date,:user_id);";
            $params = array(':from_date' => $f_fromdate, ':to_date' => $f_todate, ':user_id' => $user_id);
            $this->db->exec($sql, $params);
            $list = $this->db->resultset();
            return $list;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E109]Error while getting payment request list Error:  for user id[' . $user_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getFDDetails($fd_id) {
        try {
            $sql = "Select * from fd where fd_id=:fd_id;";
            $params = array(':fd_id' => $fd_id);
            $this->db->exec($sql, $params);
            $row = $this->db->single();
            return $row;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E109]Error while getting payment request list Error:  for user id[' . $user_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getFD_Number() {
        try {
            $sql = "select max(fd_id) as max_id from fd";
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
            return 'FD' . $id_name . $max_id;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E105--5]Error FD number Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

}

?>
