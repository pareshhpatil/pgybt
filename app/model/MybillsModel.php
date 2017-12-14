<?php

/**
 * This class calls necessary db objects to handle payment requests and requests to payment gateway
 *
 * @author Paresh
 */
class MybillsModel extends Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * Fetch list of patron bills
     * 
     * @return type
     */
    public function getMybills($user_id,$type) {
        try {
            $sql = "call get_mybills(:user_id,:type);";
            $params = array(':user_id' => $user_id, ':type' => $type);
            $this->db->exec($sql, $params);
            $rows= $this->db->resultset();
            return $rows;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E601]Error while checking password exist Error: for user id[' . $user_id . '] ' . $e->getMessage());
        }
    }

}
