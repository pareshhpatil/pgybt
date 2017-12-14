
<div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">Admin profile</h3>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        {if isset($haserrors)}
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <strong>Error!</strong>
                <div class="media">
                    {foreach from=$haserrors key=k item=v}
                        <p class="media-heading">{$k} - {$v.1}</p>
                    {/foreach}
                </div>

            </div>
        {/if}
        {if isset($success)}
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert"></button>
                <strong>Success!</strong>{$success}
            </div>
        {/if}

        <div class="col-md-12">

            <div class="portlet light bordered">
                <div class="portlet-body form">
                    <h3 class="form-section">Profile details</h3>
                    <form action="/admin/profile/update" method="post" id="submit_form"  class="form-horizontal form-row-sepe">
                        <div class="form-body">
                            <!-- Start profile details -->
                            <div class="alert alert-danger display-none">
                                <button class="close" data-dismiss="alert"></button>
                                You have some form errors. Please check below.
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Email<span class="required">* </span></label>
                                        <div class="col-md-8">
                                            <input type="text" name="email" readonly value="{$personal.email_id}" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">First name<span class="required">* </span></label>
                                        <div class="col-md-8">
                                            <input type="text" name="first_name" required value="{$personal.first_name}" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Last name<span class="required">* </span></label>
                                        <div class="col-md-8">
                                            <input type="text" required name="last_name" required value="{$personal.last_name}" class="form-control" >
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Birth date<span class="required">* </span></label>
                                        <div class="col-md-8">
                                            <input type="text" name="dob" value="{$personal.dob}" required class="form-control form-control-inline date-picker" data-date-format="yyyy-mm-dd" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Mobile<span class="required">* </span></label>
                                        <div class="col-md-2">
                                            <input type="text" name="mob_country_code" value="{$personal.mob_country_code}" class="form-control" >
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="mobile" required value="{$personal.mobile_no}" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Landline<span >&nbsp; </span></label>
                                        <div class="col-md-2">
                                            <input type="text" name="ll_country_code" value="{$personal.ll_country_code}" class="form-control" >
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="landline" value="{if $personal.landline_no!=0}{$personal.landline_no}{/if}" class="form-control" >
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- End profile details -->
                            <h3 class="form-section">Company details</h3>
                            <!-- Start company details -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Company type<span class="required">* </span></label>
                                        <div class="col-md-8">
                                            <select name="industry_type" class="form-control select2me" data-placeholder="Select...">
                                                {foreach from=$industrytype key=k item=v}
                                                    {if {{$admin.industry_type}=={$v.config_key}}}
                                                        <option selected value="{$v.config_key}" selected>{$v.config_value}</option>
                                                    {else}
                                                        <option value="{$v.config_key}">{$v.config_value}</option>
                                                    {/if}

                                                {/foreach}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Entity type<span class="required">* </span></label>
                                        <div class="col-md-8">
                                            <select name="type" class="form-control select2me" data-placeholder="Select...">
                                                {foreach from=$entitytype key=k item=v}
                                                    {if {{$admin.entity_type}=={$v.config_key}}}
                                                        <option selected value="{$v.config_key}" selected>{$v.config_value}</option>
                                                    {else}
                                                        <option value="{$v.config_key}">{$v.config_value}</option>
                                                    {/if}

                                                {/foreach}

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Registered Company Name<span >&nbsp; </span></label>
                                        <div class="col-md-8">
                                            <input type="text" name="company_name" required value="{$admin.company_name}"  class="form-control" readonly value="Opusnet">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Company Registration Number<span >&nbsp; </span></label>
                                        <div class="col-md-8">
                                            <input type="text" name="registration_no" value="{$admin.company_registration_number}" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Registered company address<span class="required">* </span></label>
                                        <div class="col-md-8">
                                            <textarea name="address"  required class="form-control" >{$personal.address1}{$personal.address2}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">City<span class="required">* </span></label>
                                        <div class="col-md-8">
                                            <input type="text" name="city" required value="{$personal.city}" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Zipcode<span class="required">* </span></label>
                                        <div class="col-md-8">
                                            <input type="text" name="zip" required value="{$personal.zipcode}" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">State<span class="required">* </span></label>
                                        <div class="col-md-8">
                                            <input type="text" name="state" required value="{$personal.state}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Country<span class="required">* </span></label>
                                        <div class="col-md-8">
                                            <input type="text" name="country" required value="{$personal.country}" class="form-control" >
                                        </div>
                                    </div>


                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Company pan<span >&nbsp; </span></label>
                                        <div class="col-md-8">
                                            <input type="text" name="pan" value="{$admin.pan}" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Business email<span class="required">* </span></label>
                                        <div class="col-md-8">
                                            <input type="text" name="business_email" required value="{$admin.business_email}" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Business contact<span class="required">* </span></label>
                                        <div class="col-md-2">
                                            <input type="text" name="country_code" required value="{$admin.country_code}" class="form-control" >
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="business_contact" required  value="{$admin.business_phone}" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Business address<span class="required">* </span></label>
                                        <div class="col-md-8">
                                            <textarea name="current_address" required class="form-control" >{$admin.address1}{$admin.address2}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">City<span class="required">* </span></label>
                                        <div class="col-md-8">
                                            <input type="text" name="current_city" required value="{$admin.city}" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Zipcode<span class="required">* </span></label>
                                        <div class="col-md-8">
                                            <input type="text" name="current_zip" required value="{$admin.zipcode}" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">State<span class="required">* </span></label>
                                        <div class="col-md-8">
                                            <input type="text" name="current_state" required value="{$admin.state}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Country<span class="required">* </span></label>
                                        <div class="col-md-8">
                                            <input type="text" name="current_country" required value="{$admin.country}" class="form-control" >
                                        </div>
                                    </div>


                                </div>
                            </div>


                            <!-- End company details -->
                            <h3 class="form-section">Transaction fee details</h3>
                            <!-- Start Transaction details -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">PGYBT fee type</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" readonly value="{if $pg.pgybt_fee_type=="F"}Fixed{else}Percentage{/if}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">PGYBT fee value</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" readonly value="{$pg.pgybt_fee_val}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">PG fee type</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" readonly value="{if $pg.pg_fee_type=="F"}Fixed{else}Percentage{/if}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">PG fee value</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" readonly value="{$pg.pg_fee_val}">
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">PG tax type</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" readonly value="{$pg.pg_fee_val}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">PG tax value</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" readonly value="{$pg.pg_tax_val}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Surcharge enable</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" readonly value="{if $pg.surcharge_enabled=="1"}True{else}False{/if}">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            {if $account.account_no!=''}
                                <!-- End transaction details -->
                                <h3 class="form-section">Bank details</h3>
                                <!-- Start bank details -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Account number</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" readonly value="{$account.account_no}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">IFSC code</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" readonly value="{$account.ifsc_code}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Account type</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" readonly value="{if $account.account_type=="1"}Current{else}Saving{/if}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Bank Name</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" readonly value="{$account.bank_name}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Min transaction value</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" readonly value="20">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Max transaction value</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" readonly value="100000.00">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {/if}
                            <!-- End Bank details -->
                            <h3 class="form-section">Bulk upload details</h3>
                            <!-- Start Bulk upload details -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Bulk upload status</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" readonly value="{if $admin.bulk_upload_limit>0}Enable{else}Disable{/if}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Bulk upload limit</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" readonly value="{$admin.bulk_upload_limit}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>						
                        <!-- End Bulk upload details -->
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-5">
                                    <input type="submit" class="btn blue" value="Update"/>
                                </div>
                            </div>
                        </div>
                    </form>						

                </div>
            </div>
        </div>	
        <!-- END PAGE CONTENT-->
    </div>
</div>
<!-- END CONTENT -->
</div>