<!-- BEGIN CONTAINER -->

<!-- BEGIN CONTENT -->
<div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">&nbsp</h3>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="col-md-1"></div>
    <div class="col-md-10">

        <?php
        if ($this->hasError()) {
            ?> <div class="alert alert-danger display-none" style="display: block;">
                <button class="close" data-dismiss="alert"></button>
                <?php
                foreach ($this->_error as $error_name) {
                   
                    echo '<b>' . $error_name[0] . '</b> -' . $error_name[1];
                    echo '<br>';
                }
                ?>
            </div>
        <?php } ?>


        <div class="row">
            <div class="col-md-12">
                <div class="portlet box blue" id="form_wizard_1">
                    <div class="portlet-title">
                        <div class="caption">
                            Admin register
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form action="/admin/register/saved" class="form-horizontal" id="submit_form" method="POST">
                            <div class="form-wizard">
                                <div class="form-body">
                                    <ul class="nav nav-pills nav-justified steps">
                                        <li>
                                            <a href="#tab1" data-toggle="tab" class="step">
                                                <span class="number">
                                                    1 </span>
                                                <span class="desc">
                                                    <i class="fa fa-check"></i> Personal </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#tab2" data-toggle="tab" class="step">
                                                <span class="number">
                                                    2 </span>
                                                <span class="desc">
                                                    <i class="fa fa-check"></i> Company </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#tab3" data-toggle="tab" class="step active">
                                                <span class="number">
                                                    3 </span>
                                                <span class="desc">
                                                    <i class="fa fa-check"></i> Contact </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#tab4" data-toggle="tab" class="step">
                                                <span class="number">
                                                    4 </span>
                                                <span class="desc">
                                                    <i class="fa fa-check"></i> Confirm </span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div id="bar" class="progress progress-striped" role="progressbar">
                                        <div class="progress-bar progress-bar-success">
                                        </div>
                                    </div>
                                    <div class="tab-content">
                                        <div class="alert alert-danger display-none">
                                            <button class="close" data-dismiss="alert"></button>
                                            You have some form errors. Please check below.
                                        </div>
                                        <div class="alert alert-success display-none">
                                            <button class="close" data-dismiss="alert"></button>
                                            Your form validation is successful!
                                        </div>
                                        <div class="tab-pane active" id="tab1">
                                            <h3 class="block">Provide your personal details</h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-5">Email id <span class="required">
                                                            </span>
                                                        </label>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" value="<?php echo $_REQUEST['email']; ?>" id="email"  name="email" <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.email"); ?>/>
                                                            <span class="help-block"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-5">Password <span class="required">
                                                            </span>
                                                        </label>
                                                        <div class="col-md-7">
                                                            <input type="password" class="form-control" name="password"  id="submit_form_password" <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.password"); ?>/>
                                                            <span class="help-block"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-5">Confirm Password <span class="required">
                                                            </span>
                                                        </label>
                                                        <div class="col-md-7">
                                                            <input type="password" class="form-control" name="rpassword" />
                                                            <span class="help-block"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-5">First name <span class="required">
                                                            </span>
                                                        </label>
                                                        <div class="col-md-7">
                                                            <input type="text" required value="<?php echo $_REQUEST['f_name']; ?>" name="f_name" <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.f_name"); ?> class="form-control"/>
                                                            <span class="help-block"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-5">Last name <span class="required">
                                                            </span>
                                                        </label>
                                                        <div class="col-md-7">
                                                            <input type="text"  required class="form-control" value="<?php echo $_REQUEST['l_name']; ?>" name="l_name" <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.l_name"); ?>/>
                                                            <span class="help-block"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">   
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">Date of birth <span class="required">
                                                            </span>
                                                        </label>
                                                        <div class="col-md-7">
                                                            <input type="text" name="dob" required value="<?php echo $_REQUEST['dob']; ?>" class="form-control date-picker" data-date-format="dd M yyyy" >
                                                            <span class="help-block"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">Mobile no <span class="required">
                                                            </span>
                                                        </label>
                                                        <div class="col-md-2">
                                                            <input type="text" class="form-control" value="+91" name="mob_country_code" <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.mobilecode"); ?>/>
                                                            <span class="help-block"></span>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input type="text" required class="form-control" value="<?php echo $_REQUEST['mobile']; ?>" name="mobile" id="mobile" <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.mobile"); ?>/>
                                                            <span class="help-block"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">Landline <span class="required">
                                                            </span>
                                                        </label>
                                                        <div class="col-md-2">
                                                            <input type="text" class="form-control" placeholder="022" value="<?php echo $_REQUEST['ll_country_code']; ?>" name="ll_country_code" <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.landlinecode"); ?>/>
                                                            <span class="help-block"></span>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input type="text" class="form-control" value="<?php echo $_REQUEST['landline']; ?>" name="landline" <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.landline"); ?>/>
                                                            <span class="help-block"></span>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab2">
                                            <h3 class="block">Provide your company details</h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-5">Entity type <span class="required">
                                                            </span>
                                                        </label>
                                                        <div class="col-md-6">
                                                            <select name="type" required class="form-control select2me" data-placeholder="Select...">
                                                                <option value=""></option>
                                                                <?php
                                                                foreach ($this->entitytype as $row) {
                                                                    if ($this->entityselected == $row['config_key']) {
                                                                        echo '<option value="' . $row['config_key'] . '" selected="selected">' . $row['config_value'] . '</option>';
                                                                    } else {
                                                                        echo '<option value="' . $row['config_key'] . '">' . $row['config_value'] . '</option>';
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                            <span class="help-block"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-5">Company Name <span class="required">
                                                            </span>
                                                        </label>
                                                        <div class="col-md-6">
                                                            <input type="text" required value="<?php echo $_REQUEST['company_name']; ?>" name="company_name" class="form-control" <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.company_name"); ?>/>
                                                            <span class="help-block"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-5">Industry type <span class="required">
                                                            </span>
                                                        </label>
                                                        <div class="col-md-6">
                                                            <select name="industry_type" required class="form-control select2me" data-placeholder="Select...">
                                                                <option value=""></option>
                                                                <?php
                                                                foreach ($this->industrytype as $row) {
                                                                    if ($this->industryselected == $row['config_key']) {
                                                                        echo '<option value="' . $row['config_key'] . '" selected="selected">' . $row['config_value'] . '</option>';
                                                                    } else {
                                                                        echo '<option value="' . $row['config_key'] . '">' . $row['config_value'] . '</option>';
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                            <span class="help-block"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-5">Company registration no <span class="required">
                                                            </span>
                                                        </label>
                                                        <div class="col-md-6">
                                                            <input required type="text" value="<?php echo $_REQUEST['registration_no']; ?>" name="registration_no" class="form-control" <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.resg_no"); ?> />
                                                            <span class="help-block"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-5">Company PAN <span class="required">
                                                            </span>
                                                        </label>
                                                        <div class="col-md-6">
                                                            <input required type="text" value="<?php echo $_REQUEST['pan']; ?>" name="pan" class="form-control" <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.pan"); ?>/>
                                                            <span class="help-block"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab3">
                                            <h3 class="block">Provide your contact details</h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">Registered Company Address <span class="required">
                                                            </span>
                                                        </label>
                                                        <div class="col-md-7">
                                                            <textarea class="form-control"  name="address" id="address" required <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.addr1"); ?>><?php echo $_REQUEST['address']; ?></textarea>
                                                            <span class="help-block"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">City <span class="required" >
                                                            </span>
                                                        </label>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" value="<?php echo $_REQUEST['city']; ?>" name="city" id="city" required <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.city"); ?>/>
                                                            <span class="help-block"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">Zip code<span class="required">
                                                            </span>
                                                        </label>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" value="<?php echo $_REQUEST['zip']; ?>" name="zip" id="zip" required <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.zip"); ?>/>
                                                            <span class="help-block"></span>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">State <span class="required">
                                                            </span>
                                                        </label>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" value="<?php echo $_REQUEST['state']; ?>" name="state" id="state" required <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.state"); ?>/>
                                                            <span class="help-block"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">Country <span class="required">
                                                            </span>
                                                        </label>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" value="India" name="country" id="country" required <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.country"); ?>/>
                                                            <span class="help-block"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <h3>Business address <label><input  type="checkbox" onchange="sameaddress();"></span> Same as registered address </label></h3>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">Business Address <span class="required">
                                                            </span>
                                                        </label>
                                                        <div class="col-md-7">
                                                            <textarea class="form-control" name="current_address" id="current_address" required <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.addr1"); ?>><?php echo $_REQUEST['current_address']; ?></textarea>
                                                            <span class="help-block"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">City <span class="required">
                                                            </span>
                                                        </label>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" value="<?php echo $_REQUEST['current_city']; ?>" name="current_city" id="current_city" required <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.city"); ?>/>
                                                            <span class="help-block"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">Zip code<span class="required">
                                                            </span>
                                                        </label>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" value="<?php echo $_REQUEST['current_zip']; ?>" name="current_zip"  id="current_zip" required <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.zip"); ?>/>
                                                            <span class="help-block"></span>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">State <span class="required">
                                                            </span>
                                                        </label>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" value="<?php echo $_REQUEST['current_state']; ?>" name="current_state" id="current_state" required <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.state"); ?>/>
                                                            <span class="help-block"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">Country <span class="required">
                                                            </span>
                                                        </label>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" value="<?php echo $_REQUEST['current_country']; ?>" name="current_country" id="current_country" required <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.country"); ?>/>
                                                            <span class="help-block"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <h3>Business contact </h3>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">Business email <span class="required">
                                                            </span><label><input onchange="document.getElementById('business_email').value = document.getElementById('email').value;" type="checkbox">Same as personal </label>
                                                        </label>
                                                        <div class="col-md-7">
                                                            <input type="text" value="<?php echo $_REQUEST['business_email']; ?>" name="business_email" required id="business_email" class="form-control" <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.email"); ?>/>
                                                            <span class="help-block"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">Business contact <span class="required">
                                                            </span><label><input onchange="document.getElementById('business_contact').value = document.getElementById('mobile').value;" type="checkbox">Same as personal </label>
                                                        </label>
                                                        <div class="col-md-2">
                                                            <input type="text" name="business_contact_code" value="+91" class="form-control" />
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input type="text" value="<?php echo $_REQUEST['business_contact']; ?>" required name="business_contact" id="business_contact" class="form-control" <?php echo $this->HTMLValidatorPrinter->fetch("htmlval.mobile"); ?>/>
                                                            <span class="help-block"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="col-md-2"></div>
                                                        <div class="col-md-9">  <label><input type="checkbox" required name="confirm"/></span>  I accept the <a href="/home/terms/popup" class="iframe"> Terms and conditions</a> & <a href="/home/privacy/popup" class="iframe">Privacy policy</a> <span class="required">
                                                                </span>
                                                            </label>
                                                            <div id="form_payment_error"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">Captcha <span class="required">
                                                            </span>
                                                        </label>

                                                        <div class="col-md-7">
                                                            <form id="comment_form" action="form.php" method="post">
                                                                <div class="g-recaptcha" required data-sitekey="6LeIQAkTAAAAAJI3z5e5whFYyKslyENkXXvft3Of"></div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="tab-pane" id="tab4">
                                            <h3 class="block">Please confirm the details entered before creating your account</h3>
                                            <h4 class="form-section">Personal details</h4>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-md-5">Email id :
                                                    </label>
                                                    <div class="col-md-7">
                                                        <p class="form-control-static" data-display="email"></p>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-5">First name :</label>
                                                    <div class="col-md-7">
                                                        <p class="form-control-static" data-display="f_name"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-5">Last name :</label>
                                                    <div class="col-md-7">
                                                        <p class="form-control-static" data-display="l_name"></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">   
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Date of birth :</label>
                                                    <div class="col-md-7">
                                                        <p class="form-control-static" data-display="dob"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Mobile no :</label>
                                                    <div class="col-md-7">
                                                        <p class="form-control-static" data-display="mob_country_code"></p><p class="form-control-static" data-display="mobile"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Landline :</label>
                                                    <div class="col-md-7">
                                                        <p class="form-control-static" data-display="ll_country_code"></p><p class="form-control-static" data-display="landline"></p>
                                                    </div>
                                                </div>

                                            </div>



                                            <div class="row no-margin">
                                                <h4 class="form-section">Company details</h4>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-5">Entity type :</label>
                                                        <div class="col-md-6">
                                                            <p class="form-control-static" data-display="type"></p>
                                                            <span class="help-block"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-5">Company Name :</label>
                                                        <div class="col-md-6">
                                                            <p class="form-control-static" data-display="company_name"></p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-5">Industry type :</label>
                                                        <div class="col-md-6">
                                                            <p class="form-control-static" data-display="industry_type"></p>
                                                            <span class="help-block"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-5">Company registration no :</label>
                                                        <div class="col-md-6">
                                                            <p class="form-control-static" data-display="registration_no"></p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-5">Company PAN :</label>
                                                        <div class="col-md-6">
                                                            <p class="form-control-static" data-display="pan"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>







                                            <div class="row no-margin">
                                                <h4 class="form-section">Contact details</h4>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-5">Registered Company Address</label>
                                                        <div class="col-md-7">
                                                            <p class="form-control-static" data-display="address"></p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-5">City :</label>
                                                        <div class="col-md-7">
                                                            <p class="form-control-static" data-display="city"></p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-5">Zip code :</label>
                                                        <div class="col-md-7">
                                                            <p class="form-control-static" data-display="zip"></p>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-5">State :</label>
                                                        <div class="col-md-7">
                                                            <p class="form-control-static" data-display="state"></p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-5">Country :</label>
                                                        <div class="col-md-7">
                                                            <p class="form-control-static" data-display="country"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row no-margin">
                                                <h4 class="form-section">Business address</h4>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-5">Business Address :</label>
                                                        <div class="col-md-7">
                                                            <p class="form-control-static" data-display="current_address"></p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-5">City :</label>
                                                        <div class="col-md-7">
                                                            <p class="form-control-static" data-display="current_city"></p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-5">Zip code :</label>
                                                        <div class="col-md-7">
                                                            <p class="form-control-static" data-display="current_zip"></p>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-5">State :</label>
                                                        <div class="col-md-7">
                                                            <p class="form-control-static" data-display="current_city"></p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-5">Country :</label>
                                                        <div class="col-md-7">
                                                            <p class="form-control-static" data-display="current_country"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row no-margin">
                                                <h4 class="form-section">Business contact</h4>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-5">Business email :</label>
                                                        <div class="col-md-7">
                                                            <p class="form-control-static" data-display="business_email"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-5">Business contact :</label>
                                                        <div class="col-md-7">
                                                            <p class="form-control-static" data-display="business_contact_code"></p><p class="form-control-static" data-display="business_contact"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-9 col-md-3">
                                            <a href="javascript:;" class="btn default button-previous">
                                                <i class="m-icon-swapleft"></i> Back </a>
                                            <a href="javascript:;" class="btn blue button-next">
                                                Continue <i class="m-icon-swapright m-icon-white"></i>
                                            </a>
                                            <a href="javascript:;" class="btn blue button-submit">
                                                Submit <i class="m-icon-swapright m-icon-white"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix">
    </div>
    <!-- END PAGE CONTENT-->
</div>
<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->