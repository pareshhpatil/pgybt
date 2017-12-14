<?php

/**
 * This class calls necessary db objects to handle Merchant reports
 *
 * @author Paresh
 */
class ChartModel extends Model {

    function __construct() {
        parent::__construct();
    }

    function get_ChartInvoiceStatus($fromdate, $todate) {
        try {
            $sql = "call chart_user_status(:from_date,:to_date)";
            $params = array(':from_date' => $fromdate, ':to_date' => $todate);
            $this->db->exec($sql, $params);
            $rows = $this->db->resultset();
            return $rows;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E601]Error while fetching customer list Error:  for user id[' . $userid . ']' . $e->getMessage());
        }
    }

    function get_ChartPaymentMode($user_id, $fromdate, $todate) {
        try {
            $sql = "call chart_payment_mode(:user_id,:from_date,:to_date)";
            $params = array(':user_id' => $user_id, ':from_date' => $fromdate, ':to_date' => $todate);
            $this->db->exec($sql, $params);
            return $this->db->resultset();
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E601]Error while fetching customer list Error:  for user id[' . $userid . ']' . $e->getMessage());
        }
    }

    function get_ChartTax($user_id, $fromdate, $todate) {
        try {
            $sql = "call chart_tax_summary(:user_id,:from_date,:to_date)";
            $params = array(':user_id' => $user_id, ':from_date' => $fromdate, ':to_date' => $todate);
            $this->db->exec($sql, $params);
            return $this->db->resultset();
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E601]Error while fetching customer list Error:  for user id[' . $userid . ']' . $e->getMessage());
        }
    }

    function get_ChartParticular($user_id, $fromdate, $todate) {
        try {
            $sql = "call chart_particular_summary(:user_id,:from_date,:to_date)";
            $params = array(':user_id' => $user_id, ':from_date' => $fromdate, ':to_date' => $todate);
            $this->db->exec($sql, $params);
            return $this->db->resultset();
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E601]Error while fetching customer list Error:  for user id[' . $userid . ']' . $e->getMessage());
        }
    }

    function get_ChartPaymentReceived($fromdate, $todate) {
        try {
            $sql = "call chart_payment_received(:from_date,:to_date)";
            $params = array(':from_date' => $fromdate, ':to_date' => $todate);
            $this->db->exec($sql, $params);
            return $this->db->resultset();
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E601]Error while fetching customer list Error:  for user id[' . $userid . ']' . $e->getMessage());
        }
    }

}
