<?php

/**
 * This class calls necessary db objects to handle payment requests and requests to payment gateway
 *
 * @author Paresh
 */
class LoanModel extends Model {

    function __construct() {
        parent::__construct();
    }

    public function getLoanList($f_fromdate, $f_todate, $user_id) {
        try {
            $sql = "call get_LoanList(:from_date,:to_date,:user_id);";
            $params = array(':from_date' => $f_fromdate, ':to_date' => $f_todate, ':user_id' => $user_id);
            $this->db->exec($sql, $params);
            $list = $this->db->resultset();
            return $list;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E109]Error while getting payment request list Error:  for user id[' . $user_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getLoanInstallmentList($f_fromdate, $f_todate, $user_id) {
        try {
            $type = 1;
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

    public function getLoanDetails($loan_id) {
        try {
            $sql = "select * from loan where loan_id=:loan_id;";
            $params = array(':loan_id' => $loan_id);
            $this->db->exec($sql, $params);
            $row = $this->db->single();
            return $row;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E109]Error while getting payment request list Error:  for user id[' . $user_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getPaidInstallment($loan_id) {
        try {
            $sql = "select * from installment where plan_id=:loan_id and type=1;";
            $params = array(':loan_id' => $loan_id);
            $this->db->exec($sql, $params);
            $row = $this->db->resultset();
            return $row;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E109]Error while getting payment request list Error:  for user id[' . $user_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function saveLoan($user_id, $loan_type, $customer_id, $loan_number, $date, $loan_amt, $procs_amt, $terms, $intrest, $first_emi, $emi, $payment_mode, $cheque_id) {
        try {
            $procs_amt = ($procs_amt > 0) ? $procs_amt : 0;
            $first_emi = ($first_emi > 0) ? $first_emi : 0;
            $sql = "call `loan_save`(:loan_number,:customer_id,:user_id,:loan_type,:loan_amount,:procs_charge,:terms,:intrest,:first_emi,:emi,:date,:payment_mode,:cheque_id);";
            $params = array(':loan_number' => $loan_number, ':customer_id' => $customer_id, ':user_id' => $user_id, ':loan_type' => $loan_type, ':loan_amount' => $loan_amt, ':procs_charge' => $procs_amt, ':terms' => $terms, ':intrest' => $intrest, ':first_emi' => $first_emi, ':emi' => $emi, ':date' => $date, ':payment_mode' => $payment_mode, ':cheque_id' => $cheque_id);
            $this->db->exec($sql, $params);
            $row = $this->db->single();
            if ($row['message'] == 'success') {
                
            } else {
                $sql = "show errors";
                $params = array();
                $this->db->exec($sql, $params);
                $row = $this->db->single();
            }
            return $row;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E101]Error while saving invoice Error:  for user id[' . $userid . '] and loan number [' . $loan_number . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function saveGolddetail($loan_id, $info1, $info2, $info3, $mrp, $testing_charge, $max_loan_amt, $narrative) {
        try {
            $testing_charge = ($testing_charge > 0) ? $testing_charge : 0;
            $mrp = ($mrp > 0) ? $mrp : 0;
            $info2 = isset($info2) ? $info2 : '';
            $info3 = isset($info3) ? $info3 : '';
            $info1 = isset($info1) ? $info1 : '';
            $sql = "INSERT INTO `loan_detail`(`loan_id`,`info1`,`info2`,`mrp`,`testing_charge`,`max_loan_amt`,`info3`,`narrative`) VALUES (:loan_id,:info1,:info2,:mrp,:testing_charge,:max_loan_amt,:info3,:narrative);";
            $params = array(':loan_id' => $loan_id, ':info1' => $info1, ':info2' => $info2, ':mrp' => $mrp, ':testing_charge' => $testing_charge, ':max_loan_amt' => $max_loan_amt, ':info3' => $info3, ':narrative' => $narrative);
            $this->db->exec($sql, $params);
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E101-6]Error while saving invoice Error:  for user id[' . $userid . '] and loan id [' . $loan_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function saveInstallmentIncome($installment_id, $princi, $intrest, $loan_id, $user_id) {
        try {
            $sql = "update installment set principal=:principal, intrest=:intrest where emi_id=:installment_id;";
            $params = array(':principal' => $princi, ':intrest' => $intrest, ':installment_id' => $installment_id);
            $this->db->exec($sql, $params);

            $sql = "update loan set balance=balance-:principal where loan_id=:loan_id;";
            $params = array(':principal' => $princi, ':loan_id' => $loan_id);
            $this->db->exec($sql, $params);

            $this->saveIncome('Loan Installment', $installment_id, $intrest, $user_id);
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E101]Error while saveInstallmentIncome Error:  for user id[' . $user_id . '] and installment_id [' . $installment_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function saveIncome($type, $installment_id, $amount, $user_id) {
        try {
            $sql = "INSERT INTO `income`(`type`,`installment_id`,`amount`,`user_id`,`created_date`)VALUES(:type,:installment_id,:amount,:user_id,CURRENT_TIMESTAMP());";
            $params = array(':type' => $type, ':installment_id' => $installment_id, ':amount' => $amount, ':user_id' => $user_id);
            $this->db->exec($sql, $params);
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E101]Error while saveIncome Error:  for user id[' . $user_id . '] and installment_id [' . $installment_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function saveLoanInstallment($login_id, $user_id, $year_id, $customer_id, $rd_id, $date, $installment, $penalty, $payment_mode, $cheque_id, $note) {
        try {
            $penalty = ($penalty > 0) ? $penalty : 0;
            $type = 1;
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
            SwipezLogger::error(__CLASS__, '[E295]Error while creating supplier Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getLoan_Number() {
        try {
            $sql = "select max(loan_id) as max_id from loan";
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
            return 'Loan' . $id_name . $max_id;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E105--6]Error RD number Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

}
