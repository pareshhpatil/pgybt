<?php

class XwayModel extends Model {

    function __construct() {
        parent::__construct();
    }

    public function handlePaymentGatewayResponse($link, $pg_type, $pg_transaction_id) {
        try {
            $row = $this->getPaymentGatewayDetails($pg_type, $pg_transaction_id);
            $secret_key = $row['pg_val2'];
            require(UTIL . 'Rc43.php');
            $DR = preg_replace("/\s/", "+", $link);
            $rc4 = new Crypt_RC4($secret_key);
            $QueryString = base64_decode($DR);
            $rc4->decrypt($QueryString);
            $QueryString = explode('&', $QueryString);
            $response = array();
            foreach ($QueryString as $param) {
                $param = explode('=', $param);
                $response[$param[0]] = urldecode($param[1]);
            }
            $res = array();
            foreach ($response as $key => $value) {
                $res[$key] = $value;
            }
            $admin_id = $this->validateXwayTransactionResponse($res);
            $result = $this->saveXwayTransactionResponse($link, $res, $admin_id);
            return $result;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E194]Error while handeling payment gateway response Error: for payment transaction id ['.$pg_transaction_id.']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function saveXwayTransactionResponse($link, $response, $user_id) {
        try {
            $sql = "call save_xway_payment_response(:PaymentID,:AdminRefNo,:TransactionID,:IsFlagged,:ResponseCode, :ResponseMessage,:DateCreated,:Amount,:payment_method,:Mode,:BillingName,:BillingAddress, :BillingCity,:BillingState,:BillingPostalCode,:BillingCountry,:BillingPhone,:BillingEmail, :DeliveryName,:DeliveryAddress,:DeliveryCity,:DeliveryState,:DeliveryPostalCode, :DeliveryCountry,:DeliveryPhone,:user_id)";
            $params = array(':PaymentID' => $response['PaymentID'], ':AdminRefNo' => $response['AdminRefNo'], ':TransactionID' => $response['TransactionID'], ':IsFlagged' => $response['IsFlagged'], ':ResponseCode' => $response['ResponseCode'], ':ResponseMessage' => $response['ResponseMessage'], ':DateCreated' => $response['DateCreated'], ':Amount' => $response['Amount'], ':payment_method' => $response['PaymentMethod'], ':Mode' => $response['Mode'], ':BillingName' => $response['BillingName'], ':BillingAddress' => $response['BillingAddress'], ':BillingCity' => $response['BillingCity'], ':BillingState' => $response['BillingState'], ':BillingPostalCode' => $response['BillingPostalCode'], ':BillingCountry' => $response['BillingCountry'], ':BillingPhone' => $response['BillingPhone'], ':BillingEmail' => $response['BillingEmail'], ':DeliveryName' => $response['DeliveryName'], ':DeliveryAddress' => $response['DeliveryAddress'], ':DeliveryCity' => $response['DeliveryCity'], ':DeliveryState' => $response['DeliveryState'], ':DeliveryPostalCode' => $response['DeliveryPostalCode'], ':DeliveryCountry' => $response['DeliveryCountry'], ':DeliveryPhone' => $response['DeliveryPhone'], ':user_id' => $user_id);
            $this->db->exec($sql, $params);
            $row = $this->db->single();
            //send payment receipt to admin 
            $this->sendMailPaymentReceipt($response['BillingName'], $row['admin_email'], $response['BillingEmail'], $row['company_name'], $response['TransactionID'], $response['AdminRefNo'], $response['DateCreated'], $response['Amount'], $row['transaction_mode']);

            $post_url = str_replace('{DR}', $link, $row['returnurl']);
            $post_url = str_replace(' ', '+', $post_url);
            header('Location:' . $post_url);
            exit();
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E231]Error while saving xway response from EBS list Error:  for user id[' . $user_id.']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function validateXwayTransactionResponse($response) {
        try {
            $sql = "select absolute_cost,xway_transaction_status,admin_id from xway_transaction where xway_transaction_id=:xway_transaction_id";
            $params = array(':xway_transaction_id' => $response['AdminRefNo']);
            $this->db->exec($sql, $params);
            $row = $this->db->single();
            $request_amount = $row['absolute_cost'];
            $admin_id = $row['admin_id'];
            $transaction_status = $row['xway_transaction_status'];
            if ($request_amount != $response['Amount']) {
                //TODO Logger
                SwipezLogger::error(__CLASS__, '[E228]Error while validating payment gateway xwaypaymentresponse Error: Request amount does not match. xway_transaction_id: ' . $response['AdminRefNo'] . '');
            }
            if ($transaction_status != 0) {
                SwipezLogger::error(__CLASS__, '[E229]Error while validating payment gateway xwaypaymentresponse Error: transaction status does not match');
                //$this->setGenericError();
            }
            return $admin_id;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E230]Error while validating payment gateway xwaypaymentresponse Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getPaymentGatewayDetails($pg_type, $pg_transaction_id) {
        try {
            $sql = "select admin_id from xway_transaction where xway_transaction.xway_transaction_id=:transaction_id";
            $params = array(':transaction_id' => $pg_transaction_id);
            $this->db->exec($sql, $params);
            $row = $this->db->single();
            $sql = "select pg.pg_id,pg.pg_val1,pg.pg_val2,pg.pg_val4,pg.pg_val3,pg.req_url,pg.pg_val5 from payment_gateway as pg inner join admin_fee_detail as fd on fd.pg_id=pg.pg_id where fd.admin_id=:admin_id";
            $params = array(':admin_id' => $row['admin_id']);
            $this->db->exec($sql, $params);
            return $this->db->single();
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E204]Error while getting payment gateway details Error:  for payment transaction id[' . $pg_transaction_id.']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function sendMailPaymentReceipt($patron_name, $admin_email, $patron_email, $payment_towards, $receipt_no, $transaction_no, $payment_date, $payment_amount, $payment_mode) {
        try {
            $emailWrapper = new EmailWrapper();
            $mailcontents = $emailWrapper->fetchMailBody("patron.payment_receipt");
            if (isset($mailcontents[0]) && isset($mailcontents[1])) {
                $message = $mailcontents[0];
                $message = str_replace('__PATRON_NAME__', $patron_name, $message);
                $message = str_replace('__PATRON_EMAIL__', $patron_email, $message);
                $message = str_replace('__PAYMENT_TOWARDS__', $payment_towards, $message);
                $message = str_replace('__RECEIPT_NO__', $receipt_no, $message);
                $message = str_replace('__TRANSACTION_NO__', $transaction_no, $message);
                $message = str_replace('__PAYMENT_DATE__', $payment_date, $message);
                $message = str_replace('__PAYMENT_AMOUNT__', $payment_amount, $message);
                $message = str_replace('__PAYMENT_MODE__', $payment_mode, $message);

                #($toEmail_, $toName_, $subject_, $messageHTML_, $messageText_ = NULL)
                // $emailWrapper->sendMail($patron_email, "", $mailcontents[1], $message);
                $emailWrapper->sendMail($admin_email, "", $mailcontents[1], $message);
            } else {
                SwipezLogger::warn("Mail could not be sent with verify email link to : " . $toEmail_);
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E2013]Error while sending mail Error: ' . $e->getMessage());
        }
    }

    public function validatexway($mode, $account_id, $admin_id, $amount, $referrer, $return_url) {
        try {
            $sql = "call validate_xwayrequest(:mode,:account_id,:admin_id,:amount,:referrer,:return_url)";
            $params = array(':mode' => $mode, ':account_id' => $account_id, ':admin_id' => $admin_id, ':amount' => $amount, ':referrer' => $referrer, ':return_url' => $return_url);
            $this->db->exec($sql, $params);
            $result = $this->db->single();
            return $result;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E225]Error while validate xway Error:  for admin id[' . $admin_id.']' . $e->getMessage());
        }
    }

    public function invokeXwayPaymentGateway($absolute_cost, $ebs_fee, $admin_id, $requrl, $returnurl, $mode, $reference_no, $amount, $description, $name, $address, $city, $state, $account_id, $postal_code, $country, $phone, $email, $ship_name, $ship_address, $ship_city, $ship_state, $ship_postal_code, $ship_country, $ship_phone, $xwayhash) {
        try {

            $sql = "select pg.pg_id,pg.pg_val1,pg.pg_val2,pg.pg_val4,pg.pg_val3,pg.req_url,pg.pg_val5 from payment_gateway as pg inner join admin_fee_detail as fd on fd.pg_id=pg.pg_id where fd.admin_id=:admin_id";
            $params = array(':admin_id' => $admin_id);
            $this->db->exec($sql, $params);
            $row = $this->db->single();

            $request_url = $row['req_url'];
            $post_url = $row['pg_val5'];
            $return_url = $row['pg_val4'];
            $ebskey = $row['pg_val2'];

            $transaction_id = $this->savexwaytransaction($absolute_cost, $ebs_fee, $admin_id, $requrl, $returnurl, $mode, $reference_no, $amount, $description, $name, $address, $city, $state, $account_id, $postal_code, $country, $phone, $email, $ship_name, $ship_address, $ship_city, $ship_state, $ship_postal_code, $ship_country, $ship_phone, $xwayhash);
            $_SESSION['transaction_type'] = 'xway';
            $_SESSION['transaction_id'] = $transaction_id;
            $transaction_amount = $absolute_cost - $ebs_fee;

            $hash = $ebskey . "|" . $account_id . "|" . $amount . "|" . $reference_no . "|" . $returnurl . "|" . $mode;
            $secure_hash = md5($hash);
            if ($xwayhash != $secure_hash) {
                SwipezLogger::error(__CLASS__, '[E233]Error while invoking xway payment gateway Error: secure hash does not match admin id :' . $admin_id);
                return 'invalid secure';
            }

            $hash = $ebskey . "|" . $account_id . "|" . $transaction_amount . "|" . $transaction_id . "|" . $return_url . "|" . $mode;
            $secure_hash = md5($hash);
            //create array of data to be posted             
            $post_data['req_url'] = $request_url;
            $post_data['return_url'] = $return_url;
            $post_data['mode'] = $mode;
            $post_data['reference_no'] = $transaction_id;
            $post_data['amount'] = $transaction_amount;
            $post_data['description'] = $description;
            $post_data['name'] = $name;
            $post_data['address'] = $address;
            $post_data['city'] = $city;
            $post_data['state'] = $state;
            $post_data['account_id'] = $account_id;
            $post_data['postal_code'] = $postal_code;
            $post_data['country'] = 'IND';
            $post_data['phone'] = $phone;
            $post_data['email'] = $email;

            $post_data['ship_name'] = $ship_name;
            $post_data['ship_address'] = $ship_address;
            $post_data['ship_city'] = $ship_city;
            $post_data['ship_state'] = $ship_state;
            $post_data['ship_postal_code'] = $ship_postal_code;
            $post_data['ship_country'] = 'IND';
            $post_data['ship_phone'] = $ship_phone;
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
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E226]Error while invoking xway payment gateway Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function savexwaytransaction($absolute_cost, $ebs_fee, $admin_id, $req_url, $return_url, $mode, $reference_no, $amount, $description, $name, $address, $city, $state, $account_id, $postal_code, $country, $phone, $email, $ship_name, $ship_address, $ship_city, $ship_state, $ship_postal_code, $ship_country, $ship_phone, $hash) {
        try {
            $sql = "call save_xwaytransaction(:admin_id,:referrer_url,:account_id,:secure_hash,
    :return_url,:mode,:reference_no,:amount,:absolute_cost,:ebs_fee,:description,:name,:address,:city,:state,:postal_code,:country,:phone,:email,:ship_name,:ship_address,:ship_city,:ship_state,:ship_postal_code,:ship_country,:ship_phone);";
            $params = array(':admin_id' => $admin_id, ':referrer_url' => $return_url, ':account_id' => $account_id, ':secure_hash' => $hash, ':return_url' => $return_url, ':mode' => $mode, ':reference_no' => $reference_no, ':amount' => $amount, ':absolute_cost' => $absolute_cost, ':ebs_fee' => $ebs_fee, ':description' => $description, ':name' => $name, ':address' => $address, ':city' => $city, ':state' => $state, ':postal_code' => $postal_code, ':country' => $country, ':phone' => $phone, ':email' => $email, ':ship_name' => $ship_name, ':ship_address' => $ship_address, ':ship_city' => $ship_city, ':ship_state' => $ship_state, ':ship_postal_code' => $ship_postal_code, ':ship_country' => $ship_country, ':ship_phone' => $ship_phone);
            $this->db->exec($sql, $params);
            $row = $this->db->single();
            return $row['xtransaction_id'];
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E227]Error while save xway transaction Error:  for admin id[' . $admin_id.']' . $e->getMessage());
            $this->setGenericError();
        }
    }

}
