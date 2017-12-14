
<div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">{$display_type} Maturity</h3>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">
            {if isset($haserrors)}
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert"></button>
                    <strong>Error!</strong>
                    <div class="media">
                        {foreach from=$haserrors item=v}

                            <p class="media-heading">{$v.0} - {$v.1}.</p>
                        {/foreach}
                    </div>

                </div>
            {/if}

            <div class="portlet light bordered">
                <div class="portlet-body form">
                    <!--<h3 class="form-section">Profile details</h3>-->
                    <form action="/admin/rd/maturitysave" method="post" id="submit_form" class="form-horizontal form-row-sepe">
                        <div class="form-body">
                            <!-- Start profile details -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-danger display-none">
                                        <button class="close" data-dismiss="alert"></button>
                                        You have some form errors. Please check below.
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label class="control-label col-md-6">{$display_type} Policy <span class="required">
                                                    </span></label>
                                                <div class="col-md-6">
                                                    <select name="policy_id" required onchange="getmaturitydetails('{$type}', this.value);" class="form-control select2me" data-placeholder="Select...">
                                                        <option value=""></option>
                                                        {foreach from=$List item=v}
                                                            <option value="{$v.$type_id}">{$v.name}</option>
                                                        {/foreach}
                                                    </select>
                                                </div>
                                            </div>

                                            <div id="cheque_list">
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-6">Maturity Date <span class="required">
                                                    </span></label>
                                                <div class="col-md-4">
                                                    <input type="text" readonly autocomplete="off"  id="maturity_date" name="maturity_date" class="form-control date-picker" data-date-format="dd M yyyy">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-6">Maturity Amount</label>
                                                <div class="col-md-4">
                                                    <div class="input-icon right">
                                                        <input type="number" readonly="" id="maturity_amount" min="0" step="0.01"   name="maturity_amount" class="form-control" >
                                                    </div>	
                                                </div> 
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-6">Paid Amount</label>
                                                <div class="col-md-4">
                                                    <div class="input-icon right">
                                                        <input type="number"  min="0" step="0.01" required name="amount" class="form-control" >
                                                    </div>	
                                                </div> 
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-6">Date <span class="required">
                                                    </span></label>
                                                <div class="col-md-4">
                                                    <input type="text" required="" autocomplete="off" id="date" name="date" value="{$current_date}" class="form-control date-picker" data-date-format="dd M yyyy">
                                                </div>
                                            </div>
                                                <div class="form-group">
                                                <label class="control-label col-md-6">Receiver name</label>
                                                <div class="col-md-4">
                                                    <div class="input-icon right">
                                                        <input type="text" name="receiver_name" class="form-control" >
                                                    </div>	
                                                </div> 
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-6">Payment Mode<span class="required">
                                                    </span></label>
                                                <div class="col-md-4">
                                                    <select class="form-control" id="payment_mode" name="payment_mode" onchange="responseType(this.value);">
                                                        <option value="0">Select Payment</option>
                                                        <option value="1">CHEQUE</option>
                                                        <option value="2">CASH</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-6">Account<span class="required">
                                                    </span></label>
                                                <div class="col-md-4">
                                                    <select class="form-control select2me" required id="bank_id" name="bank_id" data-placeholder="Select Account">
                                                        <option value=""></option>
                                                        {foreach from=$bank_list item=v}
                                                            <option value="{$v.account_id}">{$v.name}</option>
                                                        {/foreach}

                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group" id="cheque_no" style="display: none;">
                                                <label id="bank_name" class="control-label col-md-6">Cheque number<span class="required">
                                                    </span></label>
                                                <div class="col-md-4">
                                                    <input class="form-control" id="cheque_number" name="cheque_number"   type="text" value="" placeholder="Cheque no"/>
                                                </div>
                                            </div>
                                            <div class="form-group" id="cheque_dat" style="display: none;">
                                                <label class="control-label col-md-6">Cheque Date <span class="required">
                                                    </span></label>
                                                <div class="col-md-4">
                                                    <input type="text" required="" autocomplete="off"  id="cheque_date" name="cheque_date" value="{$current_date}" class="form-control date-picker" data-date-format="dd M yyyy">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-6">Note</label>
                                                <div class="col-md-6">
                                                    <div class="input-icon right">
                                                        <textarea name="note" class="form-control" ></textarea>
                                                    </div>	
                                                </div> 
                                            </div>
                                        </div>

                                    </div>
                                </div>


                            </div>
                        </div>					
                        <!-- End profile details -->

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-6 col-md-5">
                                    <input type="hidden" name="type" value="{$type}">
                                    <input type="hidden" id="policy_number" name="policy_number">
                                    <input type="submit" value="Submit" class="btn blue"/>
                                    <button type="reset" class="btn default">Cancel</button>
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