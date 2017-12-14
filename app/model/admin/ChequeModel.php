<?php

class ChequeModel extends Model {

    function __construct() {
        parent::__construct();
    }

    public function saveCheque($login_id, $customer_id, $bank_id, $date, $note, $cheque_number, $amount, $cheque_date) {
        try {
            $bank_id = ($bank_id > 0) ? $bank_id : 0;
            $cheque_number = implode('~', $cheque_number);
            $amount = implode('~', $amount);
            $cheque_date = implode('~', $cheque_date);
            $sql = "call cheque_save(:customer_id,:user_id,:date,:note,:bank_id,:cheque_number,:amount,:cheque_date)";
            $params = array(':customer_id' => $customer_id, ':user_id' => $login_id, ':date' => $date, ':note' => $note, ':bank_id' => $bank_id, ':cheque_number' => $cheque_number, ':amount' => $amount, ':cheque_date' => $cheque_date);
            $this->db->exec($sql, $params);
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E295-c]Error while saving cheque Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function saveDeposite($cheque_id, $account_id) {
        try {

            $sql = "select amount from cheque_details where cheque_id=:cheque_id";
            $params = array(':cheque_id' => $cheque_id);
            $this->db->exec($sql, $params);
            $list = $this->db->single();
            $amount = $list['amount'];
            
            $sql = "update cheque_details set is_deposited=1 where cheque_id=:cheque_id";
            $params = array(':cheque_id' => $cheque_id);
            $this->db->exec($sql, $params);

            $sql = "update saving_accounts set current_balance = current_balance + " . $amount . " where account_id=:account_id;";
            $params = array(':account_id' => $account_id);
            $this->db->exec($sql, $params);
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E295-c]Error while saving cheque Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getChequeMaster() {
        try {
            $sql = "call get_cheque_master();";
            $params = array();
            $this->db->exec($sql, $params);
            $list = $this->db->resultset();
            return $list;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E109-1]Error while getting payment request list Error:  for user id[' . $user_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getPendingCheque() {
        try {
            $sql = "call getPendingCheque();";
            $params = array();
            $this->db->exec($sql, $params);
            $list = $this->db->resultset();
            return $list;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E109-2]Error while getting payment request list Error:  for user id[' . $user_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getChequelist($id) {
        try {
            $sql = "select * from cheque_details where cheque_master=:id;";
            $params = array(':id' => $id);
            $this->db->exec($sql, $params);
            $list = $this->db->resultset();
            return $list;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E109-3]Error while getting payment request list Error:  for user id[' . $user_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getchequedetails($id) {
        try {
            $sql = "select * from cheque_details where cheque_id=:id;";
            $params = array(':id' => $id);
            $this->db->exec($sql, $params);
            $list = $this->db->single();
            return $list;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E109-4]Error while getting payment request list Error:  for user id[' . $id . ']' . $e->getMessage());
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
