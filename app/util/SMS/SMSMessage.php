<?php

/*
 * Stores list of SMS messages. This is hard coded in this class as a hash array
 * at the moment. This should eventually replaced by a caching solution.
 */

/**
 * Description of SMSMessage
 *
 * @author Shuhaid
 */
class SMSMessage {
    private $_messageList = array();
    
    function __construct() {
        $this->_messageList["m1"]="Thank you for registering on PGYBT. Please check your email Inbox OR Spam folder to verify your email address and complete the registration process.";
        $this->_messageList["m2"]="We have received your papers and are processing them at our end. Please allow x business days to enable your account for online payment collections.";
        $this->_messageList["m3"]="Thank you for subscribing to the paid version of PGYBT. Login to www.pgybt.in to start collecting payments online.";
        $this->_messageList["m4"]="Your payment attempt to PGYBT has failed due to <reason text>. Please re-try this again on www.pgybt.in.";
        $this->_messageList["m5"]="Your PGYBT account is now enabled for online payments. Please login to www.pgybt.in to start collecting payments online.";
        $this->_messageList["m6"]="Payment request has been sent to <Patron Name>. You will receive an SMS and E-Mail once the patron has settled this payment.";
        $this->_messageList["m7"]="You have received xxxx amount from <Patron Name>. Amount will be credited your account in 2-3 business days, subject to clearing.";
        $this->_messageList["m8"]="You have requested for a password reset on www.pgybt.in. Please check your registered email id to reset password.";
        $this->_messageList["m9"]="You have successfully changed your password on PGYBT. Please contact support@pgybt.in in case of any queries.";
        $this->_messageList["p1"]="Thank you for registering on PGYBT. Please check your email Inbox OR Spam folder to verify your email address and complete the registration process.";
        $this->_messageList["p2"]="You have received a payment request from <Admin Name> for amount xxxx. To make an online payment, access your bill via www.pgybt.in/mybills";
        $this->_messageList["p3"]="You have made a payment to <Admin Name> for an amount of xxxx/-. Transaction ref id is <Transaction id>. Admin credits subject to clearing";
        $this->_messageList["p4"]="Payment to <Admin Name> failed for an amount of xxxx due to <reason text>. Please login to www.pgybt.in to re-try this transaction.";
        $this->_messageList["p5"]="You have requested for a password reset on www.pgybt.in. Please check your registered email id to reset your password.";
        $this->_messageList["p6"]="You have successfully changed your password on PGYBT. Please contact support@pgybt.in in case of any queries.";
    }
    
    function fetch($key_) {
        $value = isset($this->_messageList[$key_])? $this->_messageList[$key_] : NULL;
        
        return $value;
    }
}
