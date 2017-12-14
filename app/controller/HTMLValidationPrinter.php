<?php

/*
 * Stores list of HTML pattern validaton of all forms. this validations are called into the files from here.
 */

/**
 * Description of HTMLValidationPrinter
 *
 * @author Shuhaid
 */
class HTMLValidationPrinter {

    public $_messageList = array();

    function __construct() {

/* --- login username ---  */
$str = <<<EOD
required aria-required="true" pattern="[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})" title="This field is required. Please enter a valid email address " 
EOD;
        $this->_messageList["lusername"] = $str;

/* --- login password --- */
$str = <<<EOD
required aria-required="true" title="Enter correct password OR Select Forget Password to reset password" required pattern="(?=.*[0-9])(?=.*[a-zA-Z]).{8,20}" maxlength="20" 
EOD;
        $this->_messageList["lpassword"] = $str;

/* --- email addresses : registration process both admin and patron --- */
$str = <<<EOD
  pattern="[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})" title="This field is required. Please enter a valid email address " maxlength="254" 
EOD;
        $this->_messageList["email"] = $str;

/* ---    --- */
$str = <<<EOD
required aria-required="true" id="password" title="Make a strong password of 8 charecters. Enter a combination containing letters, numerics & special characters" pattern="(?=.*[0-9])(?=.*[a-zA-Z]).{8,20}" maxlength="20" 
EOD;
        $this->_messageList["password"] = $str;

/* ---    --- */
$str = <<<EOD
id="verifypassword" oninput="validatePass(document.getElementById('password'), this);" onfocus="validatePass(document.getElementById('password'), this);"  required aria-required="true" maxlength="20" 
EOD;
        $this->_messageList["verifypassword"] = $str;

/* ---  fname , lname  --- */
$str = <<<EOD
required pattern="[a-zA-Z]+(([\'\,\.\s\-\][a-zA-Z])?[a-zA-Z]*)*" aria-required="true" title="This field is required. Use letters.  Numbers or special charecters are not allowed"  maxlength="40"
EOD;
        $this->_messageList["name"] = $str;

/* ---  dropdown lists: day , month , year , template , industry type , entity type , bill date , due date , --- */ 
$str = <<<EOD
required aria-required="true" 
EOD;
        $this->_messageList["dropdown"] = $str;

/* ---  mobile code  --- */
$str = <<<EOD
required aria-required=”true” title="This field is required. Enter  your  Country code" maxlength="6"    
pattern="([+|\0[0-9]{1,6})?([0-9]{2,6})" 
EOD;
        $this->_messageList["mobilecode"] = $str;

/* --- mobile   --- */
$str = <<<EOD
 aria-required=”true” title="This field is required. Enter  your  mobile number" maxlength="12" pattern="([0-9]{10,12})"
EOD;
        $this->_messageList["mobile"] = $str;
        
        /* ---  Number  --- */
$str = <<<EOD
required aria-required=”true” title="This field is required. Enter  only digit." maxlength="6"    
pattern="\d{1,6}" 
EOD;
        $this->_messageList["number"] = $str;

/* --- mobile   --- */
$str = <<<EOD
required aria-required=”true” title="This field is required. Enter  your  mobile number" maxlength="12" pattern="([0-9]{10,12})"
EOD;
        $this->_messageList["mobile"] = $str;

/* ---  std code  --- */
$str = <<<EOD
title="This field is required. Enter  your  STD  code" maxlength="6" pattern="([+|\0[0-9]{1,6})?([0-9]{2,6})"
EOD;
        $this->_messageList["landlinecode"] = $str;

/* ---  landline  --- */
$str = <<<EOD
title="Enter your Landline number" maxlength="12" pattern="([0-9]{0,12})"
EOD;
        $this->_messageList["landline"] = $str;

/* ---  address line : patron  --- */
$str = <<<EOD
required aria-required="true" title="This field is required. Please Enter your valid mailing address"  maxlength="200"
EOD;
        $this->_messageList["paddr"] = $str;

/* ---  address line 1 :   --- */
$str = <<<EOD
required aria-required="true" title="This field is required. Please Enter your valid mailing address" maxlength="100"
EOD;
        $this->_messageList["addr1"] = $str;

/* ---  address line 2 :   --- */
$str = <<<EOD
 title="Please Enter your valid mailing address" maxlength="100"
EOD;
        $this->_messageList["addr2"] = $str;

/* ---  city  --- */
$str = <<<EOD
required aria-required="true" pattern="[\sa-zA-Z]*" title="This field is required. City name can't have numerics or special charecters" maxlength="25"
EOD;
        $this->_messageList["city"] = $str;

/* ---  state  --- */
$str = <<<EOD
required aria-required="true" pattern="[\sa-zA-Z]*" title="This field is required. State name can't have numerics or special charecters" maxlength="25"
EOD;
        $this->_messageList["state"] = $str;

/* ---  country  --- */
$str = <<<EOD
required aria-required="true" pattern="[\sa-zA-Z]*" title="This field is required. Country name can't have numerics or special charecters" maxlength="25"
EOD;
        $this->_messageList["country"] = $str;

/* --- patron zip (alphnumeric)   --- */
$str = <<<EOD
required aria-required="true" title="This field is required. Zip code is combination of alphabets and numbers & at least 5 numbers." pattern="[\sa-zA-Z0-9]{5,10}" maxlength="10" 
EOD;
        $this->_messageList["pzipcode"] = $str;

/* ---  capcha  --- */                                                
$str = <<<EOD
required aria-required="true" pattern="[\sa-z\d]{6,6}" title="This field is required. Please enter the values from the image" maxlength="6" 
EOD;
        $this->_messageList["capcha"] = $str;

/* ---  checkbox : terms and condition  --- */
$str = <<<EOD
required aria-required="true"
EOD;
        $this->_messageList["checkbox"] = $str;

/* ---  form_invoice: customer-id  --- */
$str = <<<EOD
title="Maximum Combination of 12 characters containing letters, numbers and special characters" pattern="[\s([A-Z][a-z][0-9]*)([-][A-Z][a-z][0-9]*)*\s]" maxlength="12"  

EOD;
        $this->_messageList["custid"] = $str;

/* --- form_invoice: invoice number  --- */
$str = <<<EOD
title="Maximum Combination of 12 characters containing letters, numbers and special characters" maxlength="12"
EOD;
        $this->_messageList["invoice_no"] = $str;

/* ---  form_invoice: bill_period  --- */
$str = <<<EOD
pattern="[\s([A-Z][a-z][0-9]*)([-][A-Z][a-z][0-9]*)*\s]" maxlength="20"
EOD;
        $this->_messageList["bill_period"] = $str;

/*-- money/amount: previous_dues , previous_payment , amount fields , absolute cost , tax value , Unit price , quantity , applicable on rs. , 
     offline payment->amount field --*/
$str = <<<EOD
title="Accepts only numeric characters. Value not exceeding ₹ 1,00,000.00" 
pattern="((?=.*[0-9])\d{1,5}(?:\.\d{1,2})?|100000.00|100000)" maxlength="9" 
EOD;
        $this->_messageList["amount"] = $str;
 
$str = <<<EOD
title="Accepts only numeric characters. Value not exceeding ₹ 1,00,000.00" 
pattern="((?=.*[0-9])\d{1,5}(?:\.\d{1,2})?|100000.00|100000)" maxlength="9" 
EOD;
        $this->_messageList["money"] = $str;        

/* --- previous dues with minus sign ---*/
$str = <<<EOD
title="Accepts only numeric characters. Value not exceeding ₹ 1,00,000.00" 
pattern="([-]?(?=.*[0-9])\d{1,5}(?:\.\d{1,2})?|100000.00|100000)" maxlength="9" 
EOD;
        $this->_messageList["previousamt"] = $str;
        

/* --- offline respond amount --- */
$str = <<<EOD
required aria-required="true" title="Accepts only numeric characters. Value not exceeding ₹ 1,00,000.00" pattern="((?=.*[0-9])\d{1,5}(?:\.\d{1,2})?|100000.00|100000)" maxlength="9" 
EOD;
        $this->_messageList["offamount"] = $str;        

/* --- Quantity ---*/
$str = <<<EOD
title="Accepts only numeric characters" 
pattern="([\s0-9\s]{0,12})" maxlength="10" 
EOD;
        $this->_messageList["quantity"] = $str;
        
/* ---  form invoice: bill cycle name  --- */
$str = <<<EOD
required aria-required="true" title="This field is required.Enter your Bill Cycle name" pattern="[\s([A-Z][a-z][0-9]*)([-][A-Z][a-z][0-9]*)*\s]"  maxlength="40"
EOD;
        $this->_messageList["bill_cycle"] = $str;

/* ---  Bill value   --- */
$str = <<<EOD
title="Bill value must not exceed ₹ 1,00,000.00"   pattern="((?=.*[0-9])\d{1,5}(?:\.\d{1,2})?|100000.00|100000)" maxlength="9" 
EOD;
        $this->_messageList["bill_value"] = $str;

/* ---  grand total  --- */
$str = <<<EOD
pattern="(0*([1-9]\d{2,4}|[2-9]\d)(?:\.\d{1,2})?|100000.00|100000)" title="Zero value invoices are not allowed.   Minimun invoice value  ₹ 20 and value not exceeding ₹ 1,00,000.00"  maxlength="9" 
EOD;
        $this->_messageList["grand_total"] = $str;


/* ---  Particular label and tax    --- */
$str = <<<EOD
required aria-required="true" maxlength="40" pattern="[a-zA-Z0-9]+(([\!\'\,\.\s\-\@\#\$\%\^\&\*\(\)\_\+\|\\\/\=\{\}\[\]\][a-zA-Z0-9])?[a-zA-Z0-9]*)*" title="Does not accepts ` and ~ characters"
EOD;
        $this->_messageList["particular"] = $str;

/* ---  header label    --- */
$str = <<<EOD
required aria-required="true" maxlength="20" pattern="[a-zA-Z0-9]+(([\!\'\,\.\s\-\@\#\$\%\^\&\*\(\)\_\+\|\\\/\=\{\}\[\]\][a-zA-Z0-9])?[a-zA-Z0-9]*)*" title="Does not accepts ` and ~ characters"
EOD;
        $this->_messageList["header"] = $str;        

/* ---  duration label    --- */
$str = <<<EOD
 maxlength="15" pattern="[a-zA-Z0-9]+(([\!\'\,\.\s\-\@\#\$\%\^\&\*\(\)\_\+\|\\\/\=\{\}\[\]\][a-zA-Z0-9])?[a-zA-Z0-9]*)*" title="Does not accepts ` and ~ characters"
EOD;
        $this->_messageList["duration"] = $str;        

        
/* ---  template create and form_invoice: tax in percentage  --- */
$str = <<<EOD
maxlength="5" pattern="[0-9]+([\,|\.][0-9]+)?" title="Accepts only numeric characters. Value less than 100"  
EOD;
        $this->_messageList["ptax"] = $str;

/* --- password reset : old password  --- */
$str = <<<EOD
required aria-required="true" title="You cannot leave this field empty. Please enter your password" pattern="(?=.*[0-9])(?=.*[a-zA-Z]).{8,20}" maxlength="20" 
EOD;
        $this->_messageList["oldpassword"] = $str;

/* ---  entity : company name  --- */
$str = <<<EOD
required aria-required="true" title="Maximum Combination of 50 characters containing letters, numbers and special characters" maxlength="50"
EOD;
        $this->_messageList["company_name"] = $str;

/* ---  entity : pan number  --- */
$str = <<<EOD
title="Enter Valid PAN Number" pattern="(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{10,10}" maxlength="10"  

EOD;
        $this->_messageList["pan"] = $str;

/* ---  entity : resgistration number  --- */
$str = <<<EOD
maxlength="40"  title="Maximum Combination of 40 characters containing letters, numbers and special characters"

EOD;
        $this->_messageList["resg_no"] = $str;

/* --- entity : zipcode --- */
$str = <<<EOD
required aria-required="true"  maxlength="6" title="This field is required. Zip code is numeric & at least 5 numbers." pattern="[0-9]{5,6}" 
EOD;
        $this->_messageList["zipcode"] = $str;

/* ---  entity : business-contact-code  --- */
$str = <<<EOD
required aria-required=”true” title="This field is required. Enter  your  Country code or STD code as applicable" maxlength="6" pattern="([+|\0[0-9]{1,6})?([0-9]{2,6})" 

EOD;
        $this->_messageList["busi_code"] = $str;    

/* --- entity : business contact --- */
$str = <<<EOD
required aria-required=”true” title="This field is required. Enter  your  business contact number" maxlength="12" pattern="([0-9]{10,12})"
EOD;
        $this->_messageList["busi_contact"] = $str;                 

/* ---  entity : transaction money range  --- */
$str = <<<EOD
required aria-required="true" pattern="(0*([1-9]\d{2,4}|[2-9]\d)(?:\.\d{1,2})?|100000.00|100000)" title="Accepts only numeric characters. Minimum value ₹ 20 and Value not exceeding ₹ 1,00,000.00" maxlength="9" 
EOD;
        $this->_messageList["amt_range"] = $str;

/* ---  template create : template name  --- */
$str = <<<EOD
required aria-required="true" required pattern="[\sa-zA-Z0-9]+(([\.\&\+\_\\\/\s\-\][\sa-zA-Z0-9])?[\sa-zA-Z0-9]*)*" maxlength="40" title="Maximum Combination of 40 characters containing letters, numbers and accepts special characters /-+.\&_ only"
EOD;
        $this->_messageList["temp_name"] = $str;

/* --- respond offline : cheque   --- */
$str = <<<EOD
 title="Accepts only numeric characters." maxlength="8" pattern="([0-9]{0,8})"
EOD;
        $this->_messageList["cheque"] = $str;

/* --- cashpaidto , narrative ,   --- */
$str = <<<EOD
maxlength="45" pattern="[a-zA-Z0-9]+(([\!\'\,\.\s\-\@\#\$\%\^\&\*\(\)\_\+\|\\\/\=\{\}\[\]\][a-zA-Z0-9])?[a-zA-Z0-9]*)*" title="Does not accepts ` and ~ characters"
EOD;
        $this->_messageList["narrative"] = $str;

/* --- header text ---*/
$str = <<<EOD
maxlength="45" pattern="[a-zA-Z0-9]+(([\!\'\,\.\s\-\@\#\$\%\^\&\*\(\)\_\+\|\\\/\=\{\}\[\]\][a-zA-Z0-9])?[a-zA-Z0-9]*)*" title="Does not accepts ` and ~ characters"
EOD;
        $this->_messageList["text"] = $str;        

/* --- header textarea ---*/
$str = <<<EOD
 pattern="[a-zA-Z0-9]+(([\!\'\,\.\s\-\@\#\$\%\^\&\*\(\)\_\+\|\\\/\=\{\}\[\]\][a-zA-Z0-9])?[a-zA-Z0-9]*)*" title="Does not accepts ` and ~ characters"
EOD;
        $this->_messageList["textarea"] = $str; 
        
        
/* ---  bank refernce  --- */
$str = <<<EOD
maxlength="20" title="Accepts atmax 20 characters."
EOD;
        $this->_messageList["bankref"] = $str;

/* ---   help desk : name  --- */
$str = <<<EOD
required pattern="[a-zA-Z]+(([\'\,\.\s\-\][a-zA-Z])?[a-zA-Z]*)*" aria-required="true" title="This field is required. Use letters.  Numbers or special charecters are not allowed"  maxlength="100"
EOD;
        $this->_messageList["contact_name"] = $str;

/* ---   help desk : message field  --- */
$str = <<<EOD
required aria-required="true" title="This field is required." maxlength="500" 
EOD;
        $this->_messageList["contact_msg"] = $str;

/* ---   help desk : subject field  --- */
$str = <<<EOD
required  aria-required="true" title="Please enter the subject" maxlength="40"
EOD;
        $this->_messageList["contact_sub"] = $str;

/* ---  admin suggest : email , name , nature , number --- */
$str = <<<EOD
required  aria-required="true" title="This field is required." maxlength="255"
EOD;
        $this->_messageList["sugg_extra"] = $str;
        
$str = <<<EOD
 pattern="[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})" title="Please enter a valid email address " maxlength="255"
EOD;
        $this->_messageList["sugg_extraemail"] = $str;
        
$str = <<<EOD
 title="Please enter valid contact details" maxlength="20" pattern="([0-9]{10,20})"
EOD;
        $this->_messageList["sugg_extrano"] = $str;   
        
$str = <<<EOD
required pattern="[a-zA-Z]+(([\'\,\.\s\-\][a-zA-Z])?[a-zA-Z]*)*" aria-required="true" title="This field is required. Use letters.  Numbers or special charecters are not allowed"  maxlength="70"
EOD;
        $this->_messageList["supplier_name"] = $str;        

/* number in events */
        
$str = <<<EOD
title="Accepts only numeric characters" pattern="([\s0-9\s]{0,6})" maxlength="6" required
EOD;
        $this->_messageList["number"] = $str;
        
$str = <<<EOD
aria-required=”true” title="This field is required. Enter your number of occurences" maxlength="4" pattern="([0-9]{0,4})"
EOD;
        $this->_messageList["subscription"] = $str;        

                                                                
                    }

    function fetch($key_) {
        $value = isset($this->_messageList[$key_]) ? $this->_messageList[$key_] : NULL;
        return $value;
    }
}

?>