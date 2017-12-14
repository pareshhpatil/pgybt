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
class Uploadvalidator extends Validator {

    function __construct($model_) {
        parent::__construct($model_);
    }

    function validateExcelUpload() {
        $this->file('fileupload')
                ->val('isValidExcelsize', 'Invalid size', 5000000)
                ->val('isValidExcelExt', 'Invalid file');
    }

    function validateBulkInvoice() {

        $this->post('narrative')
                ->val('maxlength', 'Payment Towards', 250)
                ->post('previous_dues')
                ->val('isamount', 'Previous dues')
                ->post('amount')
                ->val('isamount', 'Amount')
                ->post('mobile')
                ->val('digit', 'Mobile')
                ->val('minlength', 'Mobile', 10)
                ->val('maxlength', 'Mobile', 13)
                ->post('email_id')
                ->val('maxlength', 'Email id', 254)
                ->val('validEmail', 'Email id')
                ->post('due_date')
                ->val('validateDate', 'Due date')
                ->post('bill_date')
                ->val('validateDate', 'Bill date')
                ->compairtwopost('compairBillDate', 'bill_date', 'due_date', 'Bill date & Due date')
                ->post('bill_cycle_name')
                ->val('required', 'Billing cycle name')
                ->val('maxlength', 'Billing cycle name', 40)
                ->post('tax')
                ->val('isamount', 'Tax Amount')
                ->post('grand_total')
                ->val('isMoney', 'Grand Total')
                ->post('totalcost')
                ->val('isMoney', 'Particular Total')
                ->val('isamount', 'Particular Total')
                ->compairthreepost('valuesWithdatatype', 'values', 'datatypes', 'column_name', 'Invoice values');
    }

    /**
     * val - Compair two post values
     * 
     * @param string $typeOfValidator A method from the Form/Val class
     * @param string $arg A property to validate against
     */
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

    public function compairthreepost($typeOfValidator, $firstpost_, $second_post, $third_post, $fieldname_) {
        $int = 0;
        while ($_POST[$second_post][$int] != '') {
            $error = $this->_val->{$typeOfValidator}($_POST[$firstpost_][$int], $_POST[$second_post][$int]);
            if ($error) {
                if (isset($this->_error[$_POST[$second_post][$int]])) {
                    $existingError = $this->_error[$_POST[$second_post][$int]];
                    $count = count($existingError);
                    $existingError[$count] = $error;
                    $this->_error[$_POST[$second_post][$int]] = $existingError;
                } else {
                    $existingError[0] = $_POST[$third_post][$int];
                    $existingError[1] = $error;
                    $this->_error[$_POST[$second_post][$int]] = $existingError;
                }
            }
            $int++;
        }
        return $this;
    }

}
