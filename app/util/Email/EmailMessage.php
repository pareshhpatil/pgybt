<?php

/**
 * Stores list of email messages. This is hard coded in this class as a hash array
 * at the moment. This should eventually replaced by a caching solution.
 *
 * @author Shuhaid
 */
class EmailMessage {

    private $_messageList = array();

    function __construct() {
        $this->_messageList["cashreceipt"] = array(VIEW . 'mailer/cash_receipt.html', 'PGYBT- Cash receipt');
        $this->_messageList["chequereceipt"] = array(VIEW . 'mailer/cheque_receipt.html', 'PGYBT- Cheque receipt');
    }

    function fetch($key_) {

        $value = isset($this->_messageList[$key_]) ? $this->_messageList[$key_] : NULL;

        if (!isset($value[0]) || $value[0] == NULL) {
            SwipezLogger::warn("Requested key $key_ not found in email message hash");
            throw new Exception("Requested key $key_ not found in email message hash");
        }
        if (!isset($value[1]) || $value[1] == NULL) {
            SwipezLogger::warn("Requested key $key_ not found in email message hash");
            throw new Exception("Requested key $key_ not found in email message hash");
        }

        $filecontents = @file_get_contents($value[0]);

        if ($filecontents == FALSE) {
            SwipezLogger::warn("Unable to read email template file : $filename");
            return NULL;
        }
        $mailcontents[0] = $filecontents;
        $mailcontents[1] = $value[1];

        return $mailcontents;
    }

}
