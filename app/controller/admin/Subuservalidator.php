<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Registervalidator
 *
 * @author Shuhaid
 */
class Subuservalidator extends Validator {

    function __construct($model_) {
        parent::__construct($model_);
    }

    function validateRoleSave($user_id) {

        $this->post('role_name')
                ->val('required', 'Role name')
                ->val('maxlength', 'Role name', 50)
                ->val('isValidTemplatename', 'Role name', $user_id);
    }

    function validateSubadminSave() {
        $this->post('email')
                ->val('required', 'Email id')
                ->val('maxlength', 'Email id', 254)
                ->val('isValidEmail', 'Email id')
                ->post('name')
                ->val('required', 'Name')
                ->val('maxlength', 'Name', 50)
                ->post('mobile')
                ->val('maxlength', 'Mobile no', 12)
                ->val('digit', 'Mobile no')
                ->post('password', 'rpassword')
                ->val('required', 'Password')
                ->val('maxlength', 'Password', 40)
                ->valpasswd('isValidPassword', 'password', 'rpassword');
    }

    function validateSimpleTemplateUpdate($user_id) {

        $this->post('template_name')
                ->val('required', 'Template name')
                ->val('maxlength', 'Template name', 45)
                ->file('uploaded_file')
                ->val('isValidImagesize', 'Upload Logo', 500000)
                ->val('isValidImageExt', 'Upload Logo');
    }

    public function compairtwopost($typeOfValidator, $firstpost_, $second_post, $fieldname_) {
        $error = $this->_val->{$typeOfValidator}($_POST[$firstpost_], $_POST[$second_post]);
        if ($error) {
            if (isset($this->_error[$this->_currentItem])) {
                $existingError = $this->_error[$this->_currentItem];
                $count = count($existingError);
                $existingError[$count] = $error;
                $this->_error[$this->_currentItem] = $existingError;
            } else {
                $existingError[0] = $fieldname_;
                $existingError[1] = $error;
                $this->_error[$this->_currentItem] = $existingError;
            }
        }

        return $this;
    }

    public function valpasswd($typeOfValidator, $password_, $verifypassword_) {
        $error = $this->_val->{$typeOfValidator}($this->_postData[$password_], $this->_postData[$verifypassword_]);

        if ($error) {
            if (isset($this->_error[$this->_currentItem])) {
                $existingError = $this->_error[$this->_currentItem];
                $count = count($existingError);
                $existingError[$count] = $error;
                $this->_error[$this->_currentItem] = $existingError;
            } else {
                $existingError[0] = 'Password';
                $existingError[1] = $error;
                $this->_error[$this->_currentItem] = $existingError;
            }
        }

        return $this;
    }

}
