<?php

class Customervalidator extends Validator {

    function __construct($model_) {
        parent::__construct($model_);
    }

    function validateCustomerSave() {

        $this->post('email')
                ->val('required', 'Email id')
                ->val('maxlength', 'Email id', 254)
                ->post('mobile')
                ->val('required', 'Mobile no 1')
                ->val('maxlength', 'Mobile no 1', 12)
                ->val('digit', 'Mobile no 1')
                ->post('mobile2')
                ->val('maxlength', 'Mobile no 2', 12)
                ->val('digit', 'Mobile no 2');
    }

    function validateSupplierUpdate() {

        $this->post('email1')
                ->val('required', 'Email id1')
                ->val('maxlength', 'Email id1', 254)
                ->post('email2')
                ->val('maxlength', 'Email id2', 254)
                ->post('mob_country_code1')
                ->val('maxlength', 'Mobile country code', 6)
                ->post('mobile1')
                ->val('required', 'Mobile no')
                ->val('maxlength', 'Mobile no', 12)
                ->val('digit', 'Mobile no')
                ->post('mob_country_code2')
                ->val('maxlength', 'Landline country code', 6)
                ->post('mobile2')
                ->val('maxlength', 'Mobile2', 12)
                ->val('digit', 'Landline no')
                ->post('contact_person_name')
                ->val('required', 'Contact person name')
                ->val('maxlength', 'Contact person name', 100)
                ->post('contact_person_name2')
                ->val('required', 'Contact person name2')
                ->val('maxlength', 'Contact person name2', 100)
                ->post('supplier_company_name')
                ->val('required', 'Supplier company name')
                ->val('maxlength', 'Supplier company name', 100)
                ->post('industry_type')
                ->val('required', 'Industry type')
                ->val('digit', 'Industry type')
                ->val('maxlength', 'Industry type', 4);
    }

}

?>
