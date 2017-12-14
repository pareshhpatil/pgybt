<?php

/*
 * Class helps in sending SMS out using mGage integration
 */

/**
 * Description of SMSHelper
 *
 * @author Shuhaid
 */
class SMSSender {

    private $_mode = NULL;

    function __construct($mode_ = NULL) {
        if ($mode_ == NULL) {
            $this->_mode = getenv('ENV');
        } else {
            $this->_mode = $mode_;
        }
    }

    function send($message_, $number_) {
        $message_ = str_replace(" ", "%20", $message_);
        $invokeURL = MGAGE_URL;

        $invokeURL = str_replace("__AID__", MGAGE_AID, $invokeURL);
        $invokeURL = str_replace("__PIN__", MGAGE_PIN, $invokeURL);
        $invokeURL = str_replace("__MESSAGE__", $message_, $invokeURL);
        $invokeURL = str_replace("__NUM__", $number_, $invokeURL);

        $response = "";

        //Send SMS only if the mode is set to LIVE or DEV
        if ($this->_mode == "PROD") {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $invokeURL); // here the request is sent to payment gateway 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, MGAGE_TIMEOUT);
            $response = curl_exec($ch);
            #$response = "Message Accepted for Request ID=70414170921368011248849~code=API000 & info=Air2web accepted & Time =2014/11/27/18/12";
            #$response="Message Rejected for Request ID= ~code=API-3& info=REJECTED: Empty mnumber& Time = 2014/11/27/19/47";
            #$response = NULL;

            $error = curl_error($ch);
            if ($error != "") {
                $responseArr["response_id"] = -1;
                $responseArr["response_code"] = -1;
                $responseArr["response_msg"] = -1;
                $responseArr["response_datetime"] = -1;
                $responseArr['response_error'] = $error;
                return $responseArr;
            }
            curl_close($ch);
            $responseArr = $this->handleResponse($response);
        	return $responseArr;
        } else {
            //$response = "Message Accepted for Request ID=70414170921368011248849~code=API000 & info=Air2web accepted & Time =2014/11/27/18/12";
        }
        
    }

    function handleResponse($response_) {

        $match = NULL;
        preg_match("/(.*?ID=)(.*?)~code=(.*?)[\s|\&].*?info=(.*?)\&.*?=(.*)/", $response_, $match);
        #preg_match("/(.*?ID=)(.*?)~code=(.*?)\s.*?info=(.*?)\&.*?=(.*)/", $response_, $match);

        $responseArr["response"] = $response_;
        if (is_array($match)) {
            $responseArr["response_id"] = isset($match[2]) ? $match[2] : "NA";
            $responseArr["response_code"] = isset($match[3]) ? $match[3] : "NA";
            $responseArr["response_msg"] = isset($match[4]) ? $match[4] : "NA";
            $responseArr["response_datetime"] = isset($match[5]) ? $match[5] : "NA";
        } else {
            $responseArr["response_id"] = -1;
            $responseArr["response_code"] = -1;
            $responseArr["response_msg"] = -1;
            $responseArr["response_datetime"] = -1;
        }
        return $responseArr['response_msg'];
    }

}
