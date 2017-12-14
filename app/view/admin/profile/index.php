<div class="gap"> </div> 
<div class="patron_details">

 <?php require 'inc/adminmenu.php'; ?>
</div>
    <div class="" style="width: 731px;float: left;margin-top: 2px; margin-left:7px;">
    <form enctype="multipart/form-data" id="templateform" action="/admin/profile/update" method="post">

        <?php
        $onlinePaymentIsActive = FALSE;
        if (isset($this->account['account_no'])) {
            $onlinePaymentIsActive = TRUE;
        }

        if (!$onlinePaymentIsActive) {
            ?>
        <div class="mandatory personal_details personal_details2 sadow" style="width:731px;">
            <div class="mandatory add_particulars" style="width:731px;">
                <div class="mandatory topbg" style="width:731px;">
                        <div class="mandatory row_one" style="width:731px;"><strong>Bank details</strong></div>
                    </div>
                </div>
                <div class="mandatory profile-row2" style="width:700px; margin: 10px 0 15px 20px;">
                    <h5> <img src="/images/inf.gif" width="24" height="25" /> &nbsp;Your account details will be displayed as soon as the legal paperwork is complete. If you need any assistance with this <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; please <a href="/helpdesk" class="example5"  >contact us</a>
                    </h5>
                </div>
            </div>
           <div class="gap" style="width:731px;"></div>

            <?php
        }
        ?>
        <div class="mandatory personal_details personal_details2 sadow" style="width:731px;">
            <div class="mandatory add_particulars" style="width:731px;">
                <div class="mandatory topbg" style="width:731px;">
                    <div class="mandatory row_one" style="width:731px;"><strong>Profile details</strong></div>
                </div>
            </div> <div class="gap"style="width:731px;"></div>
            <div class="mandatory profile-row"><h1>Email ID </h1><input type="text" name="email" class="field1" value="<?php echo $this->personal['email_id']; ?>" readonly="readonly" tabindex="1" /></div>
            <div class="profile-row"><h1>First Name </h1><input type="text" name="first_name" class="field2" value="<?php echo $this->personal['first_name']; ?>"  <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.name"); ?> tabindex="2"/></div>
            <div class="profile-row"><h1>Last Name </h1><input type="text" name="last_name" class="field2" value="<?php echo $this->personal['last_name']; ?>" <?php echo $this->HTMLValidatorPrinter->fetch("htmlvalname"); ?> tabindex="3"/></div>
            <div class="profile-row"><h1>DOB </h1>
                <select name="day" class="field3" <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.dropdown"); ?>  tabindex="4">
                    <?php
                    for ($i = 1; $i < 32; $i++) {
                        if (date("d", strtotime($this->personal['dob'])) == $i) {
                            echo '<option value="' . $i . '" selected="selected">' . $i . '</option>';
                        } else {
                            echo '<option value="' . $i . '">' . $i . '</option>';
                        }
                    }
                    ?>
                </select>

                <select name="month" class="field3" <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.dropdown"); ?> tabindex="5">

                    <?php
                    $month_names = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
                    for ($i = 1; $i < 13; $i++) {

                        if (date("m", strtotime($this->personal['dob'])) == $i) {
                            echo '<option value="' . $i . '" selected="selected">' . $month_names[$i - 1] . '</option>';
                        } else {

                            echo '<option value="' . $i . '">' . $month_names[$i - 1] . '</option>';
                        }
                    }
                    ?>
                </select>

                <select name="year" class="field3" <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.dropdown"); ?> tabindex="6">
                    <?php
                    for ($i = 1950; $i < 2000; $i++) {
                        if (date("Y", strtotime($this->personal['dob'])) == $i) {
                            echo '<option value="' . $i . '" selected="selected">' . $i . '</option>';
                        } else {
                            echo '<option value="' . $i . '">' . $i . '</option>';
                        }
                    }
                    ?>
                </select>



            </div>

            <div class="profile-row"><h1>Mobile </h1><input type="text" class="field4" name="mob_country_code" value="<?php echo $this->personal['mob_country_code']; ?>" <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.mobilecode"); ?> tabindex="7" /><input type="text" class="field5" name="mobile" value="<?php echo $this->personal['mobile_no']; ?>"  <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.mobile"); ?>  tabindex="8" /></div>

            <div class="profile-row"><h1>Landline (Optional)</h1><input type="text" class="field4" name="ll_country_code" value="<?php echo $this->personal['ll_country_code']; ?>" <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.landlinecode"); ?> tabindex="9" /><input type="text" class="field5" name="landline" value="<?php
                if ($this->personal['landline_no'] > 0) {
                    echo $this->personal['landline_no'];
                }
                ?>"  <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.landline"); ?>  tabindex="10" /></div>



        </div>
        <div class="gap" style="width:731px;"></div>
        <div class="mandatory personal_details personal_details2 sadow" style="width:731px;">
            <div class="mandatory add_particulars" style="width:731px;">
                <div class="mandatory topbg" style="width:731px;">
                    <div class="mandatory row_one" style="width:731px;"><strong>Company details</strong></div>
                </div>
            </div> <div class="gap" style="width:731px;"></div>
            <div class="profile-row"><h1>Entity Type </h1><select name="type" class="field6" <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.dropdown"); ?> tabindex="11">
                    <?php
                    foreach ($this->entitytype as $row) {
                        if ($this->admin['entity_type'] == $row['config_key']) {
                            echo '<option value="' . $row['config_key'] . '" selected="selected">' . $row['config_value'] . '</option>';
                        } else {
                            echo '<option value="' . $row['config_key'] . '">' . $row['config_value'] . '</option>';
                        }
                    }
                    ?>
                </select></div>

            <div class="profile-row"><h1>Industry Type </h1><select name="industry_type" class="field6" <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.dropdown"); ?> tabindex="12">
                    <?php
                    foreach ($this->industrytype as $row) {
                        if ($this->admin['industry_type'] == $row['config_key']) {
                            echo '<option value="' . $row['config_key'] . '" selected="selected">' . $row['config_value'] . '</option>';
                        } else {
                            echo '<option value="' . $row['config_key'] . '">' . $row['config_value'] . '</option>';
                        }
                    }
                    ?>
                </select></div>
            <div class="profile-row"><h1>Registered Company Name </h1><input name="company_name" type="text" class="field1" readonly="readonly" class="field2" value="<?php echo $this->admin['company_name']; ?>" <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.company_name"); ?>  tabindex="13"/></div>
            <div class="profile-row"><h1>Company Registration Number </h1><input name="registration_no" type="text" class="field2" value="<?php echo $this->admin['company_registration_number']; ?>"  <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.resg_no"); ?> tabindex="14" /></div>
            <div class="profile-row">
                <h1>Company PAN </h1>
                <input name="pan" type="text" class="field2" value="<?php echo $this->admin['pan']; ?>" <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.pan"); ?>  tabindex="15" />
            </div>
            <div class="profile-row">
                <h1>Registered Company Address </h1>
                <input type="text" name="address" class="field2" value="<?php echo $this->personal['address1']; ?>" <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.addr1"); ?> tabindex="16" />
            </div>
            <div class="profile-row">
                <h1>&nbsp; </h1>
                <input type="text" name="address2" class="field2" value="<?php echo $this->personal['address2']; ?>" <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.addr2"); ?> tabindex="17" />
            </div>
            <div class="profile-row">
                <h1>City </h1>
                <input type="text" name="city" class="field2" value="<?php echo $this->personal['city']; ?>" <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.city"); ?> tabindex="18" />
            </div>
            <div class="profile-row">
                <h1>Zipcode </h1>
                <input type="text" name="zip" class="field2" value="<?php echo $this->personal['zipcode']; ?>" <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.zipcode"); ?> tabindex="19" />
            </div>
            <div class="profile-row">
                <h1>State </h1>
                <input type="text" name="state" class="field2" value="<?php echo $this->personal['state']; ?>" <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.state"); ?> tabindex="20" />
            </div>
            <div class="profile-row">
                <h1>Country </h1>
                <input type="text" name="country" class="field2" value="<?php echo $this->personal['country']; ?>" <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.country"); ?> tabindex="21" />
            </div>

            

            <div class="line-prof"></div>

            <div class="profile-row">
                <h1>Business Address </h1>
                <input type="text" name="current_address" class="field2" value="<?php echo $this->admin['address1']; ?>" <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.addr1"); ?> tabindex="24" />
            </div>
            <div class="profile-row">
                <h1>&nbsp; </h1>
                <input type="text" name="current_address2" class="field2" value="<?php echo $this->admin['address2']; ?>" <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.addr2"); ?> tabindex="25" />
            </div>
            <div class="profile-row">
                <h1>City </h1>
                <input type="text" name="current_city" class="field2" value="<?php echo $this->admin['city']; ?>" <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.city"); ?> tabindex="26" />
            </div>
            <div class="profile-row">
                <h1>Zipcode </h1>
                <input type="text" name="current_zip" class="field2" value="<?php echo $this->admin['zipcode']; ?>" <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.zipcode"); ?> tabindex="25" />
            </div>
            <div class="profile-row">
                <h1>State </h1>
                <input type="text" name="current_state" class="field2" value="<?php echo $this->admin['state']; ?>" <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.state"); ?> tabindex="26" />
            </div>
            <div class="profile-row">
                <h1>Country </h1>
                <input type="text" name="current_country" class="field2" value="<?php echo $this->admin['country']; ?>" <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.country"); ?> tabindex="27" />
            </div>
            <div class="profile-row">
                <h1>Business Email </h1>
                <input type="text" name="business_email" class="field2" value="<?php echo $this->admin['business_email']; ?>" <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.email"); ?> tabindex="28" /> <div class=" radio_thing"> </div>
            </div>

            <div class="profile-row">
                <h1>Business contact </h1>
                <input type="text" name="country_code" class="field4" value="<?php echo $this->admin['country_code']; ?>" tabindex="29" <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.busi_code"); ?>/>
                <input type="text" name="business_contact" class="field5" value="<?php echo $this->admin['business_phone']; ?>" <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.busi_contact"); ?> tabindex="30" />   <div class=" radio_thing"  >  </div>
            </div>



        </div>
        <input type="submit" value="Update >" class="submit1" style="margin: 20px 0 0 340px;"/> 

          <div class="gap" style="width: 600px;"></div>
        <?php if ($onlinePaymentIsActive) { ?>
        <div class="mandatory personal_details personal_details2 sadow" style="width:731px;">
            <div class="mandatory add_particulars" style="width:731px;">
                <div class="mandatory topbg" style="width:731px;">
                        <div class="mandatory row_one" style="width:731px;"><strong>Bank details</strong></div>
                    </div>
                </div>
                <div class="profile-row2" style="width:650px;">
                    <h5> <img src="/images/inf.gif" width="24" height="25" /> &nbsp;If you would like to update your bank account details. Please send an email to <a href="/helpdesk" class="example5" style="color:#2700FF" >contact us</a></h5>
                </div>
                <div class="profile-row">
                    <h1>Account Number </h1>
                    <input type="text" class="field1" value="<?php echo $this->account['account_no']; ?>" readonly="readonly" tabindex="31" />
                </div>
                <div class="profile-row">
                    <h1>IFSC Code </h1>
                    <input type="text" class="field1" value="<?php echo $this->account['ifsc_code']; ?>" readonly="readonly"  tabindex="32" />
                </div>
                <div class="profile-row">
                    <h1>Account Type </h1>
                    <input type="text" class="field1" value="<?php
                    if ($this->account['account_type'] == 1) {
                        echo 'Current';
                    }
                    ?>" readonly="readonly" tabindex="33" />
                </div>
                <div class="profile-row">
                    <h1>Bank Name </h1>
                    <input type="text" class="field1" value="<?php echo $this->account['bank_name']; ?>" readonly="readonly" tabindex="34" />
                </div>
            
            
            
            <div class="profile-row">
                     <h1>Min transaction value </h1>
                    <input type="text" class="field1" value="<?php echo $this->admin['min_transaction']; ?>" readonly="readonly" tabindex="34" />
                </div>
            
            <div class="profile-row">
                     <h1>Max transaction value </h1>
                    <input type="text" class="field1" value="<?php echo $this->admin['max_transaction']; ?>" readonly="readonly" tabindex="34" />
                </div>

            
            
            </div>
          <div class="gap" style="width: 600px;"></div>
        <?php }
        ?>



        <?php if (!empty($this->PG)) { ?>

        <div class="mandatory personal_details personal_details2 sadow" style="width:731px;">
            <div class="mandatory add_particulars" style="width:731px;">
                <div class="mandatory topbg" style="width:731px;">
                        <div class="mandatory row_one" style="width:731px;"><strong>Transaction fee</strong></div>
                    </div>
                </div>
                <div class="profile-row2" style="width:650px;">
                    <h5> <img src="/images/inf.gif" width="24" height="25" /> &nbsp;If you would like to update your transaction fee details. Please send an email to <a href="/helpdesk" class="example5" style="color:#2700FF" >contact us</a></h5>
                </div>
                <div class="profile-row">
                    <h1>PGYBT fee type </h1>
                    <input type="text" class="field1" value="<?php echo ($this->PG['pgybt_fee_type'] == 'F') ? 'Fixed' : 'Percentage'; ?>" readonly="readonly" tabindex="31" />
                </div>
                <div class="profile-row">
                    <h1>PGYBT fee value </h1>
                    <input type="text" class="field1" value="<?php echo $this->PG['pgybt_fee_val']; ?>" readonly="readonly"  tabindex="32" />
                </div>

                <div class="profile-row">
                    <h1>PG fee type </h1>
                    <input type="text" class="field1" value="<?php echo ($this->PG['pg_fee_type'] == 'F') ? 'Fixed' : 'Percentage'; ?>" readonly="readonly" tabindex="34" />
                </div>

                <div class="profile-row">
                    <h1>PG fee value </h1>
                    <input type="text" class="field1" value="<?php echo $this->PG['pg_fee_val']; ?>" readonly="readonly"  tabindex="32" />
                </div>

                <div class="profile-row">
                    <h1>PG tax type </h1>
                    <input type="text" class="field1" value="<?php echo $this->PG['pg_tax_type']; ?>" readonly="readonly"  tabindex="32" />
                </div>

                <div class="profile-row">
                    <h1>PG tax value </h1>
                    <input type="text" class="field1" value="<?php echo $this->PG['pg_tax_val']; ?>" readonly="readonly"  tabindex="32" />
                </div>

                <div class="profile-row">
                    <h1>Surcharge enable </h1>
                    <input type="text" class="field1" value="<?php echo ($this->PG['surcharge_enabled'] == '1') ? 'TRUE' : 'FALSE'; ?>" readonly="readonly"  tabindex="32" />
                </div>

            </div>
          <div class="gap" style="width: 600px;"></div>
        <?php } ?>

          
        <div class="mandatory personal_details personal_details2 sadow" style="width:731px;">
            <div class="mandatory add_particulars" style="width:731px;">
                <div class="mandatory topbg" style="width:731px;">
                        <div class="mandatory row_one" style="width:731px;"><strong>Bulk upload details</strong></div>
                    </div>
                </div>
                <div class="profile-row2" style="width:650px;">
                    <h5> <img src="/images/inf.gif" width="24" height="25" /> &nbsp;If you would like to update your bulk upload details. Please send an email to <a href="/helpdesk" class="example5" style="color:#2700FF" >contact us</a></h5>
                </div>
                <div class="profile-row">
                    <h1>Bulk upload status </h1>
                    <input type="text" class="field1" value="<?php echo ($this->admin['bulk_upload_limit'] > 0) ? 'Enabled' : 'Disabled'; ?>" readonly="readonly" tabindex="31" />
                </div>
                <div class="profile-row">
                    <h1>Bulk upload limit </h1>
                    <input type="text" class="field1" value="<?php echo $this->admin['bulk_upload_limit']; ?>" readonly="readonly"  tabindex="32" />
                </div>

            </div>


          <div class="gap" style="width: 600px;"></div>
        <!--End -->
    </form>
</div><!--main-->

</div></div>