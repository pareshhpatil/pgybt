<?php

/**
 * This class calls necessary db objects to handle payment requests and requests to payment gateway
 *
 * @author Paresh
 */
class CommonModel extends Model {

    function __construct() {
        parent::__construct();
    }

    public function getCustomerList() {
        try {
            $sql = "select customer_id,name from customer where is_active=1";
            $params = array();
            $this->db->exec($sql, $params);
            $rows = $this->db->resultset();
            return $rows;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E105]Error while package list Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getCustomerDetails($customer_id) {
        try {
            $sql = "select * from customer where customer_id=:customer_id";
            $params = array(':customer_id' => $customer_id);
            $this->db->exec($sql, $params);
            $rows = $this->db->single();
            return $rows;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E105]Error while package list Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getRDCustomerList() {
        try {
            $sql = "select rd_id,concat(c.name,' | ',rd_number,' | ',installment) as name from customer c inner join rd on c.customer_id=rd.customer_id where c.is_active=1 and rd.is_matured=0;";
            $params = array();
            $this->db->exec($sql, $params);
            $rows = $this->db->resultset();
            return $rows;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E105]Error while package list Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getFDCustomerList() {
        try {
            $sql = "select fd_id,concat(c.name,' | ',fd_number,' | ',fd_amount) as name from customer c inner join fd on c.customer_id=fd.customer_id where c.is_active=1 and fd.is_matured=0;";
            $params = array();
            $this->db->exec($sql, $params);
            $rows = $this->db->resultset();
            return $rows;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E105]Error while package list Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getLoanCustomerList() {
        try {
            $sql = "select loan_id,concat(c.name,' | ',loan_number,' | ',emi) as name from customer c inner join loan on c.customer_id=loan.customer_id where c.is_active=1";
            $params = array();
            $this->db->exec($sql, $params);
            $rows = $this->db->resultset();
            return $rows;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E105]Error while package list Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getUserList() {
        try {
            $sql = "select user_id,name from user where is_active=1";
            $params = array();
            $this->db->exec($sql, $params);
            $rows = $this->db->resultset();
            return $rows;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E105]Error while package list Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getyear_id() {
        try {
            $sql = "select year_id from financial_year where is_active=1";
            $params = array();
            $this->db->exec($sql, $params);
            $rows = $this->db->single();
            return $rows['year_id'];
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E105]Error while package list Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getuser_id($customer_id) {
        try {
            $sql = "select user_id from customer where customer_id=:customer_id";
            $params = array(':customer_id' => $customer_id);
            $this->db->exec($sql, $params);
            $rows = $this->db->single();
            return $rows['user_id'];
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E105]Error while package list Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getConfiglist($type) {
        try {
            $sql = "select config_key,config_value from config where config_type=:type";
            $params = array(':type' => $type);
            $this->db->exec($sql, $params);
            $data = $this->db->resultset();
            return $data;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E114]Error while checking login Error:  for email [' . $email . '] ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getCustomerCheque($customer_id) {
        try {
            $sql = "select * from cheque_details where customer_id=:customer_id and is_used=0 and is_active=1";
            $params = array(':customer_id' => $customer_id);
            $this->db->exec($sql, $params);
            $rows = $this->db->resultset();
            return $rows;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E111]Error while update agent_tree[' . $child_id . '] ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function cheque_used($cheque_id) {
        try {
            $sql = "update cheque_details set is_used=1 where cheque_id=:cheque_id";
            $params = array(':cheque_id' => $cheque_id);
            $this->db->exec($sql, $params);
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E111]Error while update agent_tree[' . $child_id . '] ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function saveCheque($login_id, $customer_id, $cheque_number, $bank_id, $amount, $cheque_date, $is_debit = 0) {
        try {
            $bank_id = ($bank_id > 0) ? $bank_id : 0;
            $sql = "INSERT INTO `cheque_details`(`customer_id`,`is_debit`,`cheque_number`,`cheque_date`,`amount`,`is_used`,`bank_id`,`created_by`,`created_date`,`last_update_by`,`last_update_date`)
                    VALUES(:customer_id,:is_debit,:cheque_number,:cheque_date,:amount,:is_used,:bank_id,:login_id,CURRENT_TIMESTAMP(),:login_id,CURRENT_TIMESTAMP());";
            $params = array(':customer_id' => $customer_id, ':is_debit' => $is_debit, ':cheque_number' => $cheque_number, ':cheque_date' => $cheque_date, ':amount' => $amount
                , ':is_used' => 1, ':bank_id' => $bank_id, ':login_id' => $login_id);
            $this->db->exec($sql, $params);

            $sql = "select LAST_INSERT_ID() as id;";
            $params = array();
            $this->db->exec($sql, $params);
            $row = $this->db->single();
            return $row['id'];
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E111]Error while update agent_tree[' . $child_id . '] ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getReceiptDetails($installment_id) {
        try {
            $sql = "call get_cheque_details(:installment_id)";
            $params = array(':installment_id' => $installment_id);
            $this->db->exec($sql, $params);
            $rows = $this->db->single();
            return $rows;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E105]Error while package list Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getReceiptList($f_fromdate, $f_todate, $user_id, $type) {
        try {
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

    public function getChequeDetails($cheque_id) {
        try {
            $sql = "select * from cheque_details where cheque_id=:cheque_id";
            $params = array(':cheque_id' => $cheque_id);
            $this->db->exec($sql, $params);
            $row = $this->db->single();
            if ($row['is_debit'] == 1) {
                $sql = "select name from saving_accounts where account_id=:account_id";
                $params = array(':account_id' => $row['bank_id']);
                $this->db->exec($sql, $params);
            } else {
                $sql = "select config_value as name from config where config_key=:bank_id";
                $params = array(':bank_id' => $row['bank_id']);
                $this->db->exec($sql, $params);
            }
            $det = $this->db->single();
            $row['bank_name'] = $det['name'];
            return $row;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E109]Error while getting payment request list Error:  for user id[' . $user_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function addMoney_account($amount, $account_id) {
        $sql = "update saving_accounts set current_balance=current_balance - :amount where account_id=:account_id";
        $params = array(':amount' => $amount, ':account_id' => $account_id);
        $this->db->exec($sql, $params);
    }

}
