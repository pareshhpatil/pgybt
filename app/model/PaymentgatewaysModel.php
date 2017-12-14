<?php

/**
 * This class calls necessary db objects to handle payment requests and requests to payment gateway
 *
 * @author Paresh
 */
class PaymentgatewaysModel extends Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * Fetch list of admin associated with a user id
     * 
     * @return type
     */
    public function getPackage() {
        try {
            require MODEL . 'CommonModel.php';
            $commonmodel = new CommonModel();
            $package = $commonmodel->getPackage();
            return $package;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E181]Error while package list Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getPackageDetail($package_id) {
        try {
            $sql = "select package_name,package_description,package_id, package_cost from package where package_id=:package_id";
            $params = array(':package_id' => $package_id);
            $this->db->exec($sql, $params);
            $rows = $this->db->single();
            return $rows;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E182]Error while getting package details Error: for package id[' . $package_id.']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getUserDetail($user_id) {
        try {
            $sql = "select user.email_id,user.first_name,user.last_name,user_addr.mobile_no,user.user_id,user_addr.address1,user_addr.address2,user_addr.city,
	user_addr.zipcode,user_addr.state from user  inner join user_addr on user_addr.user_id = user.user_id where user.user_id=:user_id";
            $params = array(':user_id' => $user_id);
            $this->db->exec($sql, $params);
            return $this->db->single();
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E183]Error while getting user details Error: for user id[' . $user_id.']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getPaymentGatewayDetails() {
        try {
            $sql = "select pg_id,pg_val1,pg_val2,pg_val4,pg_val3,req_url,pg_val5 from payment_gateway where pg_id=0";
            $params = array();
            $this->db->exec($sql, $params);
            return $this->db->single();
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E184]Error while getting payment gateway details Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function invokePaymentGateway($package_id, $user_id) {
        try {
            $pg = $this->getPaymentGatewayDetails();
            $account_id = isset($pg['pg_val1']) ? $pg['pg_val1'] : '';
            $return_url = isset($pg['pg_val4']) ? $pg['pg_val4'] : '';
            $request_url = isset($pg['req_url']) ? $pg['req_url'] : '';
            $post_url = isset($pg['pg_val5']) ? $pg['pg_val5'] : '';
            $mode = isset($pg['pg_val3']) ? $pg['pg_val3'] : '';
            $ebskey = isset($pg['pg_val2']) ? $pg['pg_val2'] : '';
            $pg_id = isset($pg['pg_id']) ? $pg['pg_id'] : 0;

            $package = $this->getPackageDetail($package_id);

            $user_detail = $this->getUserDetail($user_id);
            if (!empty($user_detail) && !empty($pg)) {
                $transaction_id = $this->intiateFeeTransaction($package_id, $package['package_cost'], $pg_id, $user_id);
                $_SESSION['transaction_type'] = 'package';
                $_SESSION['transaction_id'] = $transaction_id;
                $hash = $ebskey . "|" . $account_id . "|" . $package['package_cost'] . "|" . $transaction_id . "|" . $return_url . "|" . $mode;
                $secure_hash = md5($hash);
                //create array of data to be posted
                $post_data['req_url'] = $request_url;
                $post_data['return_url'] = $return_url;
                $post_data['mode'] = $mode;
                $post_data['reference_no'] = $transaction_id;
                $post_data['amount'] = $package['package_cost'];
                $post_data['description'] = $package['package_description'];
                $post_data['name'] = $user_detail['first_name'] . ' ' . $user_detail['last_name'];
                $post_data['address'] = $user_detail['address1'];
                $post_data['city'] = $user_detail['city'];
                $post_data['state'] = $user_detail['state'];
                $post_data['account_id'] = $account_id;
                $post_data['postal_code'] = $user_detail['zipcode'];
                $post_data['country'] = 'IND';
                $post_data['phone'] = $user_detail['mobile_no'];
                $post_data['email'] = $user_detail['email_id'];
                $post_data['ship_name'] = $user_detail['first_name'] . ' ' . $user_detail['last_name'];
                $post_data['ship_address'] = $user_detail['address1'];
                $post_data['ship_city'] = $user_detail['city'];
                $post_data['ship_state'] = $user_detail['state'];
                $post_data['ship_postal_code'] = $user_detail['zipcode'];
                $post_data['ship_country'] = 'IND';
                $post_data['ship_phone'] = $user_detail['mobile_no'];
                $post_data['hash'] = $secure_hash;
                //traverse array and prepare data for posting (key1=value1)
                foreach ($post_data as $key => $value) {
                    $post_items[] = $key . '=' . $value;
                }
                //create the final string to be posted using implode()
                $post_string = implode('&', $post_items);
                /**
                 * curl function start here
                 */
                $ch = curl_init() or die(curl_error());
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
                curl_setopt($ch, CURLOPT_PORT, 443); // port 443
                curl_setopt($ch, CURLOPT_URL, $post_url); // here the request is sent to payment gateway 
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); //create a SSL connection object server-to-server
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                if ($this->host == 'https') {
                    curl_setopt($ch, CURLOPT_SSL_CIPHER_LIST, 'ecdhe_ecdsa_aes_128_sha');
                }
                $data1 = curl_exec($ch) or die(curl_error($ch));

                curl_close($ch);
                $response = $data1;
                echo $response;
            } else {
                SwipezLogger::error(__CLASS__, '[E185]Error while invoking payment gateway Error: Invalid request for user id[' . $user_id.'] and for package id ['.$package_id .']');
                $this->setGenericError();
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E186]Error while invoke payment gateway Error:for user id[' . $user_id.'] and for package id ['.$package_id .'] ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function intiateFeeTransaction($package_id, $absolute_cost, $PG_id, $user_id) {
        try {
            $sql = "SELECT generate_sequence('Fee_transaction_id') as uid";
            $params = array();
            $this->db->exec($sql, $params);
            $row = $this->db->single();
            $fee_id = isset($row['uid']) ? $row['uid'] : '';
            $status = 0;
            $empty = NULL;
            $zero = 0;
            $sql = "INSERT INTO `fee_transaction`(`fee_transaction_id`, `user_id`, `payment_transaction_status`,`package_id`, `amount`, `bank_status`, `narrative`, `pg_id`, `pg_ref_no`, `pg_ref_1`, `pg_ref_2`, `created_by`, `created_date`, `last_update_by`, `last_update_date`) VALUES 
	(:fee_transaction_id,:user_id,:payment_transaction_status,:package_id,:amount,:bank_status,:narrative,:pg_id,:pg_ref_no,:pg_ref_1,:pg_ref_2,:user_id,CURRENT_TIMESTAMP(),:user_id2,CURRENT_TIMESTAMP())";

            $params = array(':fee_transaction_id' => $fee_id, ':user_id' => $user_id, ':payment_transaction_status' => $status, ':package_id' => $package_id, ':amount' => $absolute_cost, ':bank_status' => $empty, ':narrative' => $empty, ':pg_id' => $PG_id, ':pg_ref_no' => $empty, ':pg_ref_1' => $empty, ':pg_ref_2' => $empty, ':user_id' => $user_id, ':user_id2' => $user_id);
            $this->db->exec($sql, $params);
            $this->db->closeStmt();
            return $fee_id;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E187]Error while initiate free transaction Error: for user id[' . $user_id.'] and for package id ['.$package_id .']' . $e->getMessage());
            $this->setGenericError();
        }
    }
    
    public function changeOnboardingStatus($user_id,$status) {
        try {
            $sql = "update admin set admin_status=:status where user_id=:user_id";
            $params = array(':user_id' => $user_id,':status' => $status);
            $this->db->exec($sql, $params);
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E208]Error while getting package details Error: for user id[' . $user_id.']' . $e->getMessage());
            $this->setGenericError();
        }
    }

}
