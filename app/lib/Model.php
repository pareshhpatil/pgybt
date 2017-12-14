<?php

class Model {

    protected $session = NULL;

    function __construct() {
        $this->db = new DBWrapper();
$this->session = new Session();
        $this->SMSHelper = new SMSSender();
        $this->SMSMessage = new SMSMessage();
$env=  getenv('ENV');
            $this->host = ($env == 'LOCAL') ? 'http' : 'https';
        
    }

    function closeConnection() {
        $this->db = NULL;
    }

    function getpreferences($user_id = null) {
        $sql = "SELECT send_sms,send_email FROM preferences where user_id=:user_id";
        $params = array(':user_id' => $user_id);
        $this->db->exec($sql, $params);
        $row = $this->db->single();
        return $row;
    }

    public function sendSMS($user_id = null, $message, $mobileNo) {
        $result = $this->getpreferences($user_id);
        if (!empty($result)) {
            if ($result['send_sms'] == 0) {
                return;
            }
        }
        $responseArr = $this->SMSHelper->send($message, $mobileNo);
    }

    public function fetchContactMessage($type) {
        return $this->ContactMessage->fetch($type);
    }

    public function fetchMessage($type) {
        return $this->SMSMessage->fetch($type);
    }

    public function setError($title, $message) {
        $this->session->set('errorTitle', $title);
        $this->session->set('errorMessage', $message);
    }

    public function setGenericError() {
        $title = "Error occurred during your last operation";
        $message = "There seems to have been an error while processing your last operation. Please try again in sometime.";
        $this->session->set('errorTitle', $title);
        $this->session->set('errorMessage', $message);
        header('Location:/error');
    }

    function _isvalidLandingUrl($url) {
        $sql = "SELECT admin_id FROM admin where display_url=:url";
        $params = array(':url' => $url);
        $this->db->exec($sql, $params);
        $row = $this->db->single();
        if (isset($row['admin_id'])) {
            $this->session->set('landing_admin_id', $row['admin_id']);
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
