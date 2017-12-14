<?php

class SecureModel extends Model {

    function __construct() {
        parent::__construct();
    }

    public function handlePaymentGatewayResponse($link, $user_id, $pg_type, $pg_transaction_id) {
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


            if ($res['AdminRefNo'][0] == "F") {
                $this->validatePackageResponse($res, $user_id);
                $result = $this->savePackageResponse($res, $user_id);
                $res['status'] = $result['status'];
                $res['payment_mode'] = $result['payment_mode'];
                $res['type'] = 'package';
                return $res;
            } else if ($res['AdminRefNo'][0] == "T") {
                $this->validatePaymentRequestResponse($res, $user_id, $pg_type);
                $result = $this->savePaymentRequestResponse($res, $user_id);
                $result['type'] = 'request';
                return $result;
            } else {
                SwipezLogger::error(__CLASS__, '[E193]Error while handeling payment gateway response Error: for user id[' . $user_id . '] ');
                header('Location:/error');
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E194]Error while handeling payment gateway response Error: for user id[' . $user_id . '] and payment transaction id [' . $pg_transaction_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function handlePaytmGatewayResponse($mid = NULL, $order_id = NULL, $amount = 0, $currency = NULL, $txn_id = NULL, $banktxn_id = NULL, $status = NULL, $resp_code = NULL, $resp_message = NULL, $txn_date = NULL, $gateway_name = NULL, $bank_name = NULL, $payment_mode = NULL, $checksum = NULL, $user_id = NULL, $pg_type = NULL, $pg_transaction_id = NULL) {
        try {
            $res = array();
            $res['AdminRefNo'] = $order_id;
            $res['Amount'] = $amount;
            $this->validatePaymentRequestResponse($res, $user_id, $pg_type);
            $pg_type = 'payment_request';
            $result = $this->savePaytmResponse($mid, $order_id, $amount, $currency, $txn_id, $banktxn_id, $status, $resp_code, $resp_message, $txn_date, $gateway_name, $bank_name, $payment_mode, $checksum, $pg_type, $user_id);
            $result['type'] = 'request';
            return $result;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E194]Error while handeling payment gateway response Error: for user id[' . $user_id . '] and payment transaction id [' . $pg_transaction_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function savePaymentRequestResponse($response, $user_id) {
        try {
            $sql = "call insert_payment_response(:type,:PaymentID,:AdminRefNo,:TransactionID,:IsFlagged,:ResponseCode, :ResponseMessage,:DateCreated,:Amount,:payment_method,:Mode,:BillingName,:BillingAddress, :BillingCity,:BillingState,:BillingPostalCode,:BillingCountry,:BillingPhone,:BillingEmail, :DeliveryName,:DeliveryAddress,:DeliveryCity,:DeliveryState,:DeliveryPostalCode,:DeliveryCountry,:DeliveryPhone,:user_id)";
            $params = array(':type' => 'payment_request', ':PaymentID' => $response['PaymentID'], ':AdminRefNo' => $response['AdminRefNo'], ':TransactionID' => $response['TransactionID'], ':IsFlagged' => $response['IsFlagged'], ':ResponseCode' => $response['ResponseCode'], ':ResponseMessage' => $response['ResponseMessage'], ':DateCreated' => $response['DateCreated'], ':Amount' => $response['Amount'], ':payment_method' => $response['PaymentMethod'], ':Mode' => $response['Mode'], ':BillingName' => $response['BillingName'], ':BillingAddress' => $response['BillingAddress'], ':BillingCity' => $response['BillingCity'], ':BillingState' => $response['BillingState'], ':BillingPostalCode' => $response['BillingPostalCode'], ':BillingCountry' => $response['BillingCountry'], ':BillingPhone' => $response['BillingPhone'], ':BillingEmail' => $response['BillingEmail'], ':DeliveryName' => $response['DeliveryName'], ':DeliveryAddress' => $response['DeliveryAddress'], ':DeliveryCity' => $response['DeliveryCity'], ':DeliveryState' => $response['DeliveryState'], ':DeliveryPostalCode' => $response['DeliveryPostalCode'], ':DeliveryCountry' => $response['DeliveryCountry'], ':DeliveryPhone' => $response['DeliveryPhone'], ':user_id' => $user_id);
            $this->db->exec($sql, $params);
            $row = $this->db->single();
            $response['admin_name'] = $row['company_name'];
            $response['suppliers'] = $row['suppliers'];
            $response['payment_request_id'] = $row['payment_request_id'];
            $response['transaction_id'] = $response['AdminRefNo'];
            $response['mobile_no'] = $row['admin_mobile_no'];
            $response['admin_email'] = $row['admin_email_id'];
            $response['payment_mode'] = $row['payment_mode'];
            $response['image'] = $row['image'];
            if ($response['ResponseCode'] == 0) {
                $response['status'] = 'success';
            } else {
                $response['status'] = 'failed';
            }
            return $response;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E195]Error while saving payment request response from EBS Error: for user id[' . $user_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function savePackageResponse($response, $user_id) {
        try {
            $sql = "call insert_payment_response(:type,:PaymentID,:AdminRefNo,:TransactionID,:IsFlagged,:ResponseCode, :ResponseMessage,:DateCreated,:Amount,:payment_method,:Mode,:BillingName,:BillingAddress, :BillingCity,:BillingState,:BillingPostalCode,:BillingCountry,:BillingPhone,:BillingEmail, :DeliveryName,:DeliveryAddress,:DeliveryCity,:DeliveryState,:DeliveryPostalCode, :DeliveryCountry,:DeliveryPhone,:user_id)";
            $params = array(':type' => 'Package', ':PaymentID' => $response['PaymentID'], ':AdminRefNo' => $response['AdminRefNo'], ':TransactionID' => $response['TransactionID'], ':IsFlagged' => $response['IsFlagged'], ':ResponseCode' => $response['ResponseCode'], ':ResponseMessage' => $response['ResponseMessage'], ':DateCreated' => $response['DateCreated'], ':Amount' => $response['Amount'], ':payment_method' => $response['PaymentMethod'], ':Mode' => $response['Mode'], ':BillingName' => $response['BillingName'], ':BillingAddress' => $response['BillingAddress'], ':BillingCity' => $response['BillingCity'], ':BillingState' => $response['BillingState'], ':BillingPostalCode' => $response['BillingPostalCode'], ':BillingCountry' => $response['BillingCountry'], ':BillingPhone' => $response['BillingPhone'], ':BillingEmail' => $response['BillingEmail'], ':DeliveryName' => $response['DeliveryName'], ':DeliveryAddress' => $response['DeliveryAddress'], ':DeliveryCity' => $response['DeliveryCity'], ':DeliveryState' => $response['DeliveryState'], ':DeliveryPostalCode' => $response['DeliveryPostalCode'], ':DeliveryCountry' => $response['DeliveryCountry'], ':DeliveryPhone' => $response['DeliveryPhone'], ':user_id' => $user_id);
            $this->db->exec($sql, $params);
            $row = $this->db->single();
            $this->db->closeStmt();
            if ($response['ResponseCode'] == 0) {
                $row['status'] = 'success';
                return $row;
            } else {
                $row['status'] = 'failed';
                return $row;
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E196]Error while saving package response from EBS list Error: for user id[' . $user_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function savePaytmResponse($mid, $order_id, $amount, $currency, $txn_id, $banktxn_id, $status, $resp_code, $resp_message, $txn_date, $gateway_name, $bank_name, $payment_mode, $checksum, $pg_type, $user_id) {
        try {
            $sql = "call insert_Paytm_response(:type,:MID,:ORDERID,:TXNAMOUNT,:CURRENCY,:TXNID, :BANKTXNID,:STATUS,:RESPCODE,:RESPMSG,:TXNDATE,:GATEWAYNAME,:BANKNAME, :PAYMENTMODE,:CHECKSUMHASH,:user_id)";
            $params = array(':type' => $pg_type, ':MID' => $mid, ':ORDERID' => $order_id, ':TXNAMOUNT' => $amount, ':CURRENCY' => $currency, ':TXNID' => $txn_id, ':BANKTXNID' => $banktxn_id, ':STATUS' => $status, ':RESPCODE' => $resp_code, ':RESPMSG' => $resp_message, ':TXNDATE' => $txn_date, ':GATEWAYNAME' => $gateway_name, ':BANKNAME' => $bank_name, ':PAYMENTMODE' => $payment_mode, ':CHECKSUMHASH' => $checksum, ':user_id' => $user_id);
            $this->db->exec($sql, $params);
            $row = $this->db->single();
            $this->db->closeStmt();
            $response['admin_name'] = $row['company_name'];
            $response['suppliers'] = $row['suppliers'];
            $response['payment_request_id'] = $row['payment_request_id'];
            $response['transaction_id'] = $response['AdminRefNo'];
            $response['mobile_no'] = $row['admin_mobile_no'];
            $response['admin_email'] = $row['admin_email_id'];
            $response['payment_mode'] = $row['payment_mode'];
            $response['BillingName'] = $row['patron_name'];
            $response['BillingEmail'] = $row['patron_email'];
            $response['TransactionID'] = $txn_id;
            $response['AdminRefNo'] = $order_id;
            $response['DateCreated'] = $txn_date;
            $response['Amount'] = $amount;

            if ($status == 'TXN_SUCCESS') {
                $response['status'] = 'success';
            } else {
                $response['status'] = 'failed';
            }
            return $response;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E509]Error while saving Paytm response from EBS list Error: for user id[' . $user_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function validatePackageResponse($response, $user_id) {
        try {
            $sql = "select p.package_cost,f.user_id,f.payment_transaction_status from fee_transaction as f inner join package as p on f.package_id=p.package_id where f.fee_transaction_id=:feeTransactionId";
            $params = array(':feeTransactionId' => $response['AdminRefNo']);
            $this->db->exec($sql, $params);
            $row = $this->db->single();
            $validAmount = $row['package_cost'];
            $admin_id = $row['user_id'];
            $status = $row['payment_transaction_status'];
            if ($validAmount != $response['Amount']) {
                //TODO Logger
                header('Location:/error');
            }
            if ($admin_id != $user_id) {
                //TODO Logger
                header('Location:/error');
            }
            if ($status != 0) {
                //TODO Logger
                header('Location:/error');
            }

            return;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E197]Error while validating package response Error: for user id[' . $user_id . '] ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function validatePaymentRequestResponse($response, $user_id, $pg_type) {
        try {
            $sql = "select r.patron_id,r.absolute_cost,t.amount,r.payment_request_status,t.payment_transaction_status from payment_transaction "
                    . "as t inner join payment_request as r on r.payment_request_id=t.payment_request_id where t.pay_transaction_id=:payment_transaction_id";
            $params = array(':payment_transaction_id' => $response['AdminRefNo']);
            $this->db->exec($sql, $params);
            $row = $this->db->single();
            $request_amount = $row['absolute_cost'];
            $transaction_amount = $row['amount'];
            $patron_id = $row['patron_id'];
            $request_status = $row['payment_request_status'];
            $transaction_status = $row['payment_transaction_status'];
            if ($request_amount != $response['Amount']) {
                //TODO Logger
                SwipezLogger::error(__CLASS__, '[E198]Error while validating payment gateway response Error: Request amount does not match. user id: ' . $user_id . '');
            }
            if ($pg_type != 'event') {
                if ($patron_id != $user_id) {
                    SwipezLogger::error(__CLASS__, '[E199]Error while validating payment gateway response Error: Request user does not match for user id[' . $user_id . ']');
                    //TODO Logger
                    $this->setGenericError();
                }
            }
            if ($transaction_status != 0) {
                SwipezLogger::error(__CLASS__, '[E200]Error while validating payment gateway response Error: transaction status does not match for user id[' . $user_id . ']');
                $this->setGenericError();
            }
            if ($request_status != 0 && $request_status != 4) {
                SwipezLogger::error(__CLASS__, '[E201]Error while validating payment gateway response Error: Request status does not match for user id[' . $user_id . ']');
                $this->setGenericError();
            }

            return;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E202]Error while validating payment gateway response Error:for user id[' . $user_id . '] ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getPaymentGatewayDetails($pg_type, $pg_transaction_id) {
        try {
            if ($pg_type == 'package') {
                $sql = "select pg_id,pg_val1,pg_val2,pg_val4,pg_val3,req_url,pg_val5,pg_val6,pg_val7 from payment_gateway where pg_id=0";
                $params = array();
                $this->db->exec($sql, $params);
                return $this->db->single();
            } else if ($pg_type == 'payment' || $pg_type == 'event') {
                $sql = "select admin.admin_id from payment_transaction  inner join admin on payment_transaction.admin_user_id=admin.user_id where payment_transaction.pay_transaction_id=:transaction_id";
                $params = array(':transaction_id' => $pg_transaction_id);
                $this->db->exec($sql, $params);
                $row = $this->db->single();
                $sql = "select pg.pg_id,pg.pg_val1,pg.pg_val2,pg.pg_val4,pg.pg_val3,pg.req_url,pg.pg_val5,pg_val6,pg_val7 from payment_gateway as pg inner join admin_fee_detail as fd on fd.pg_id=pg.pg_id where fd.admin_id=:admin_id";
                $params = array(':admin_id' => $row['admin_id']);
                $this->db->exec($sql, $params);
                return $this->db->single();
            } else {
                SwipezLogger::error(__CLASS__, '[E203]Error while getting payment gateway details Error: for payment transaction id[' . $pg_transaction_id . ']');
                $this->setGenericError();
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E204]Error while getting payment gateway details Error: for payment transaction id[' . $pg_transaction_id . '] ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function updateAdminStatus($user_id) {
        try {
            $sql = "update admin set admin_type=2 , admin_status=4 where user_id=:user_id";
            $params = array(':user_id' => $user_id);
            $this->db->exec($sql, $params);
            $this->db->closeStmt();
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E205]Error while updating admin status Error: for user id[' . $user_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function getMobileNo($user_id) {
        try {
            $sql = "select mobile_no from user_addr where user_id=:user_id";
            $params = array(':user_id' => $user_id);
            $this->db->exec($sql, $params);
            $result = $this->db->single();
            return $result['mobile_no'];
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E206]Error while getting mobile number Error: for user id[' . $user_id . ']' . $e->getMessage());
        }
    }

    public function sendMailPackageReceipt($admin_name, $admin_email, $receipt_no, $transaction_no, $payment_date, $payment_amount, $payment_mode) {
        try {
            $emailWrapper = new EmailWrapper();
            $mailcontents = $emailWrapper->fetchMailBody("admin.package_receipt");
            if (isset($mailcontents[0]) && isset($mailcontents[1])) {
                $message = $mailcontents[0];
                $message = str_replace('__ADMIN_NAME__', $admin_name, $message);
                $message = str_replace('__ADMIN_EMAIL__', $admin_email, $message);
                $message = str_replace('__RECEIPT_NO__', $receipt_no, $message);
                $message = str_replace('__TRANSACTION_NO__', $transaction_no, $message);
                $message = str_replace('__PAYMENT_DATE__', $payment_date, $message);
                $message = str_replace('__PAYMENT_AMOUNT__', $payment_amount, $message);
                $message = str_replace('__PAYMENT_MODE__', $payment_mode, $message);

                #($toEmail_, $toName_, $subject_, $messageHTML_, $messageText_ = NULL)
                $emailWrapper->sendMail($admin_email, "", $mailcontents[1], $message);
            } else {
                SwipezLogger::warn("Mail could not be sent with verify email link to : " . $toEmail_);
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E2012]Error while sending mail Error: email link to : ' . $toEmail_ . $e->getMessage());
        }
    }

    public function sendMailPaymentReceipt($patron_name, $admin_email, $patron_email, $payment_towards, $receipt_no, $transaction_no, $payment_date, $payment_amount, $payment_mode, $logo) {
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
                if ($logo != '') {
                    $message = str_replace('https://www.pgybt.in/images/logo.png', $logo, $message);
                }

                #($toEmail_, $toName_, $subject_, $messageHTML_, $messageText_ = NULL)
                $emailWrapper->sendMail($patron_email, "", $mailcontents[1], $message);
                $emailWrapper->sendMail($admin_email, "", $mailcontents[1], $message);
            } else {
                SwipezLogger::warn("Mail could not be sent with verify email link to : " . $toEmail_);
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E2013]Error while sending mail Error: email link to : ' . $toEmail_ . $e->getMessage());
        }
    }

    function set_PaytmDetail($admin_id) {
        require_once MODEL . 'CommonModel.php';
        $commonmodel = new CommonModel();
        $row = $commonmodel->getPaymentGatewayDetails($admin_id, 2);
        define('PAYTM_ENVIRONMENT', $row['pg_val3']); // PROD
        define('PAYTM_ADMIN_KEY', $row['pg_val1']); //Change this constant's value with Admin key downloaded from portal
        define('PAYTM_ADMIN_MID', $row['pg_val2']); //Change this constant's value with MID (Admin ID) received from Paytm
        define('PAYTM_ADMIN_WEBSITE', $row['pg_val4']); //Change this constant's value with Website name received from Paytm
        define('PAYTM_TXN_URL', $row['req_url']);
    }

}
