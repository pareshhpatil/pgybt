<?php

class ValidateValue {

    public function __construct($model_) {
        $this->_model = $model_;
    }

    public function required($data) {
        if (empty($data)) {
            return "Field is empty.";
        }
    }

    public function grequired($data) {
        if (empty($data)) {
            return "Zero value invoices are not allowed.";
        }
    }

    public function prequired($data) {
        if (empty($data)) {
            return "Atleast one particular should be included";
        }
    }

    public function requiredArray($data) {
        if (empty($data)) {
            return "Please include atleast 1 Particular label field";
        }
    }

    public function compareReqArray($exist, $new) {

        if (empty($exist) && empty($new)) {
            return "Please include atleast 1 Particular label field";
        }
    }

    public function checkname($name) {
        $emptyarray = array();
        if (!preg_match_all('$[a-zA-Z]+(([\'\,\.\-\][a-zA-Z])?[a-zA-Z]*)*$', $name, $emptyarray))
            return "Please enter a valid name";
    }

    public function minlength($data, $arg) {
        if ($data != '') {
            if (strlen($data) < $arg) {
                return "Please enter minimum $arg characters.";
            }
        }
    }

    public function maxlength($data, $arg) {
        if (strlen($data) > $arg) {
            return "Please enter text lesser than $arg characters.";
        }
    }

    public function compairBillDate($billdate, $duedate) {
        if (strtotime($billdate) > strtotime($duedate)) {
            return "Bill date should not be greater than due date";
        }
    }

    public function validateDate($data) {
        if (strtotime($data) > strtotime('1990-02-15') && strtotime($data) < strtotime('2031-02-15')) {
            
        } else {
            return "Please enter valid date format (dd/mm/yyyy)";
        }
    }

    public function digit($data) {
        if (isset($data) && trim($data) != '') {
            if (ctype_digit($data) == false) {
                return "Please enter only digits.";
            }
        }
    }

    public function __call($name, $arguments) {
        throw new Exception("$name does not exist inside of: " . __CLASS__);
    }

    public function validEmail($data_) {
        if (filter_var($data_, FILTER_VALIDATE_EMAIL) == false && $data_ != '') {
            return "Please enter a valid email address format";
        }
    }

    public function isValidEmail($data_) {
        if (filter_var($data_, FILTER_VALIDATE_EMAIL) == false && $data_ != '') {
            return "Please enter a valid email address format";
        } else {
            $emailExists = $this->_model->emailAlreadyExists($data_);

            if ($emailExists) {
                return "Email already exists. If this email address belong to you then"
                        . " please use the forgot password option OR try registering with a new email address.";
            }
        }
    }

    public function isValidUrl($data_, $admin_id) {
        $urlExists = $this->_model->UrlExists($data_, $admin_id);
        if ($urlExists) {
            return "URL already exists.";
        }
    }

    public function isValidTemplatename($data_, $userid) {
        $templateExists = $this->_model->isExistTemplate($data_, $userid);
        if ($templateExists == TRUE) {
            return "Name already exists.";
        }
    }

    public function isValidLogin($username, $password) {
        $session = new Session();
        $disable_email = $session->get('disable_email');
        if ($disable_email == $username) {
            return 'Your id has been disabled. It will be enabled once you have reset your password.If you have any queries related to this please use the <a href="/helpdesk" class="iframe"> contact us </a> option to get in touch.';
        } else {
            $data = $this->_model->queryLoginInfo($username, $password);
            if ($data['isValid'] == 0) {
                SwipezLogger::info("Login", $username . " login failed login attempt " . $data['loginattempt']);
                if ($data['loginattempt'] > 4) {
                    $session->set('show_captcha', TRUE);
                }
                if ($data['loginattempt'] == 10) {
                    $session->set('forgot_email', TRUE);
                    $session->set('is_disable', TRUE);
                    $session->set('disable_email', $username);
                    return 'Forgot password request has been sent to your registered email address. Please use the link within the forgot password email to reset your password. Till then your id has been disabled for security reasons. It will be enabled once you have reset your password. If you have any queries related to this please use the <a href="/helpdesk" class="iframe"> contact us</a> option to get in touch.';
                } else if ($data['status'] == 18) {
                    return 'Your id has been disabled. It will be enabled once you have reset your password. If you have any queries related to this please use the <a href="/helpdesk" class="iframe"> contact us</a> option to get in touch.';
                } else {
                    if ($data['status'] == 1 || $data['status'] == 11) {
                        return 'Your email verification is pending please verify your email and try again. If you have any queries related to this please use the <a href="/helpdesk" class="iframe"> contact us</a> option to get in touch.';
                    } else {
                        return "There was an error with your E-Mail/Password combination. Please try again.";
                    }
                }
            } else {
                SwipezLogger::info("Login", "User " . $username . " loggedin");
                $session->remove('show_captcha');
                $session->remove('is_disable');
                $session->remove('disable_email');
            }
        }
    }

    public function isPasswordExist($data_, $userid) {

        $Exists = $this->_model->isExistPassword($data_, $userid);
        if ($Exists == FALSE) {
            return "Current password is incorrect. Please try again.";
        }
    }

    public function isOldPassword($exist, $new) {
        if ($exist == $new) {
            return "The new password you have entered is the same as your current password. Please use a different password to reset.";
        }
    }

    public function nodigit($data_) {
        if (ctype_alpha($data_) == false && !empty($data_)) {
            return "Numeric values not allowed";
        }
    }

    public function isRequireCountrycode($llCountryCode, $landline) {

        if ($landline != '' && $llCountryCode == '') {
            return "Field is empty.";
        }
    }

    public function isValidPassword($password_, $verifyPassword_) {
        /*
          Explaining $\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$
          $ = beginning of string
          \S* = any set of characters
          (?=\S{8,}) = of at least length 8
          (?=\S*[\d]) = and at least one number
          $ = end of the string
         */
        $emptyarray = array();
        if (!preg_match_all('$\S*(?=\S{8,})(?=\S*[\d])\S*$', $password_, $emptyarray))
            return "Password needs to be atleast 8 characters long and should contain atleast 1 numeric value.";

        if ($password_ != $verifyPassword_)
            return "Passwords do not match. Please make sure both password are the same.";
    }

    public function isMoney($data_) {
        if ($data_ != '') {
            if (!preg_match("/^-?[0-9]+(?:\.[0-9]{1,2})?$/", $data_)) {
                return "Entered amount is not valid";
            } else {
                if (round($data_) > 100000) {
                    return "Amount should not exceed 100000.00";
                }
            }
        }
    }

    public function isamount($data_) {
        if ($data_ != '') {
            if (!preg_match("/^-?[0-9]+(?:\.[0-9]{1,2})?$/", $data_)) {
                return "Entered amount is not valid";
            }
        }
    }

    public function minAmt($data, $arg) {
        if ($data != '') {
            if (!preg_match("/^-?[0-9]+(?:\.[0-9]{1,2})?$/", $data)) {
                
            } else {
                if ($data < $arg) {
                    return "Please enter value greater than " . $arg;
                }
            }
        }
    }

    public function maxAmt($data, $arg) {
        if ($data != '') {
            if (!preg_match("/^-?[0-9]+(?:\.[0-9]{1,2})?$/", $data)) {
                return "Entered value is not valid";
            } else {
                if ($data > $arg) {
                    return "Please enter value lesser than " . $arg;
                }
            }
        }
    }

    public function compairminmax($min, $max) {
        if ($min != '' && $max != '') {
            if ($min > $max) {
                return "Min transaction should be lesser than max transaction";
            }
        }
    }

    public function isValidParticularTax($data_) {
        foreach ($data_ as $key => $value) {
            $result = $this->maxlength($value, 45);
            if (isset($result)) {
                return $result;
            }
        }
    }

    public function isValidImageExt($data_) {
        if ($data_['tmp_name'] != '') {
            $finfo = finfo_open(FILEINFO_MIME);
            $filename = basename($data_['name']);
            $allowed_ext = array('gif', 'png', 'jpeg', 'jpg', 'GIF', 'PNG', 'JPEG', 'JPG');
            $allowed_mimetype = array('image/jpeg', 'image/gif', 'image/png', 'image/jpg');
            $mimetype = mime_content_type($data_['tmp_name']);
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            finfo_close($finfo);
            if (!in_array($ext, $allowed_ext)) {
                SwipezLogger::error(__CLASS__, '[E281]Error while upload image Error: Invalid extension-' . $ext);
                return "Supported image formats for logo uploads are .png , .jpeg , .gif";
            } else {
                if (!in_array($mimetype, $allowed_mimetype)) {
                    SwipezLogger::error(__CLASS__, '[E279]Error while upload image Error: Invalid mimetype-' . $mimetype);
                    return "Logos can only uploaded be gif, png, jpeg, jpg Format";
                }
            }
        }
    }

    public function isValidExcelExt($data_) {
        if ($data_['tmp_name'] != '') {
            $finfo = finfo_open(FILEINFO_MIME);
            $filename = basename($data_['name']);
            $allowed_ext = array('xlsx', 'xls');
            $allowed_mimetype = array('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'
                , 'application/msexcel', 'application/x-msexcel', 'application/x-ms-excel', 'application/x-excel', 'application/x-dos_ms_excel',
                'application/xls', 'application/x-xls', 'application/vnd.ms-office');
            $mimetype = mime_content_type($data_['tmp_name']);
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            finfo_close($finfo);
            if (!in_array($ext, $allowed_ext)) {
                SwipezLogger::error(__CLASS__, '[E280]Error while upload excel Error: Invalid extension-' . $ext);
                return "Allowed extensions are .xls & .xlsx";
            } else {
                if (!in_array($mimetype, $allowed_mimetype)) {
                    SwipezLogger::error(__CLASS__, '[E278]Error while upload excel Error: Invalid mimetype-' . $mimetype);
                    return "Uploaded file is not recognized as a valid excel file.";
                }
            }
        }
    }

    public function isValidExcelsize($data_, $maxsize) {
        if ($data_['size'] > $maxsize || $data_['error'] == 1) {
            return "Excel size cannot be greater than " . $maxsize / 1000 . "kb";
        }
    }

    public function isValidImagesize($data_, $maxsize) {
        if ($data_['size'] > $maxsize || $data_['error'] == 1) {
            return "Logo size cannot be greater than " . $maxsize / 1000 . "kb";
        }
    }

    public function captcha($data_) {
        @session_start();
        if (empty($_SESSION['6_letters_code']) || strcasecmp($_SESSION['6_letters_code'], $data_) != 0) {
            return "Code entered in captcha does not match the one shown in the image. Please re-enter.";
        }
    }

    public function isPercentage($data_) {
        if ($data_ != '') {
            if (!preg_match("/^-?[0-9]+(?:\.[0-9]{1,2})?$/", $data_)) {
                return "Entered percentage is not valid";
            } else {
                if ($data_ > 100) {
                    return "percentage should not exceed 100%";
                }
            }
        }
    }

    function valuesWithdatatype($values_, $datatypes_) {
        if ($datatypes_ == 'integer') {
            $return = $this->digit((string) $values_);
        } else if ($datatypes_ == 'money') {
            $return = $this->isamount($values_);
        } else if ($datatypes_ == 'percentage') {
            $return = $this->isPercentage($values_);
        }
        if ($return != '') {
            return $return;
        }
    }

}
