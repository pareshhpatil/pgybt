
<div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">FD create</h3>
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
                    <form action="/admin/fd/save" method="post" id="submit_form" class="form-horizontal form-row-sepe">
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
                                                <label class="control-label col-md-6">FD number</label>
                                                <div class="col-md-6">
                                                    <div class="input-icon right">
                                                        <input type="text" required name="fd_number" readonly value="{$fd_number}" class="form-control" >
                                                    </div>	
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-6">Customer name <span class="required">
                                                    </span></label>
                                                <div class="col-md-6">
                                                    <select name="customer_id" required class="form-control select2me" data-placeholder="Select...">
                                                        <option value=""></option>
                                                        {foreach from=$customer_list item=v}
                                                            <option value="{$v.customer_id}">{$v.name}</option>
                                                        {/foreach}
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-6">Date <span class="required">
                                                    </span></label>
                                                <div class="col-md-6">
                                                    <input type="text" required="" autocomplete="off" name="date" value="{$current_date}" class="form-control date-picker" data-date-format="dd M yyyy">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-6">FD Amount</label>
                                                <div class="col-md-3">
                                                    <div class="input-icon right">
                                                        <input type="number" min="0" required="" onblur="calculatefdmaturity();" id="fd_amount" name="fd_amount" class="form-control" >
                                                    </div>	
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-6">Intrest</label>
                                                <div class="col-md-3">
                                                    <div class="input-icon right">
                                                        <input type="number" min="0" max="100" required="" onblur="calculatefdmaturity();" id="intrest" name="intrest" class="form-control" > 
                                                    </div>	
                                                </div> % 
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-6">Terms</label>
                                                <div class="col-md-3">
                                                    <div class="input-icon right">
                                                        <input type="number" min="0" required="" onblur="calculatefdmaturity();" id="terms" name="terms" class="form-control" >
                                                    </div>	
                                                </div> / Months
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-6">Maturity Amount <span class="required">
                                                    </span></label>
                                                <div class="col-md-3">
                                                    <input type="text" readonly name="maturity_amount" id="maturity_amount" class="form-control">
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
                                            <div class="form-group" id="bank_name" style="display: none;">
                                                <label class="control-label col-md-6">Bank name<span class="required">
                                                    </span></label>
                                                <div class="col-md-4">
                                                    <select class="form-control select2me" id="bank_id" name="bank_id" data-placeholder="Select Bank">
                                                        <option value=""></option>
                                                        {foreach from=$bank_list item=v}
                                                            <option value="{$v.config_key}">{$v.config_value}</option>
                                                        {/foreach}

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group" id="bank_transaction_no" style="display: none;">
                                                <label class="control-label col-md-6">Bank ref number<span class="required">
                                                    </span></label>
                                                <div class="col-md-4">
                                                    <input class="form-control " name="bank_transaction_no" type="text" value="" placeholder="Bank ref number"/>
                                                </div>
                                            </div>
                                            <div class="form-group" id="cheque_no" style="display: none;">
                                                <label class="control-label col-md-6">Cheque number<span class="required">
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
                                                <label class="control-label col-md-6">Note <span class="required">
                                                    </span></label>
                                                <div class="col-md-6">
                                                    <textarea name="note" class="form-control" >{$post.note}</textarea>
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