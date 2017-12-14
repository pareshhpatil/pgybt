
<div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">Cheque Deposite</h3>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">
            {if isset($success)}
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert"></button>
                    <strong>Success!</strong>{$success}
                </div> {/if}

                <div class="portlet light bordered">
                    <div class="portlet-body form">
                        <!--<h3 class="form-section">Profile details</h3>-->
                        <form action="/admin/cheque/depositesave" method="post" id="submit_form" class="form-horizontal form-row-sepe">
                            <div class="form-body">
                                <!-- Start profile details -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-danger display-none">
                                            <button class="close" data-dismiss="alert"></button>
                                            You have some form errors. Please check below.
                                        </div>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Cheque <span class="required">
                                                        </span></label>
                                                    <div class="col-md-8">
                                                        <select name="cheque_id" required class="form-control select2me" data-placeholder="Select...">
                                                            <option value=""></option>
                                                            {foreach from=$cheque_list item=v}
                                                                <option value="{$v.cheque_id}">{$v.cheque_number} | {$v.amount} | {$v.bank_name} | {$v.customer_name}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="form-group" id="bank_name">
                                                    <label class="control-label col-md-4">Bank name<span class="required">
                                                        </span></label>
                                                    <div class="col-md-4">
                                                        <select class="form-control select2me" name="account_id" data-placeholder="Select Bank">
                                                            <option value=""></option>
                                                            {foreach from=$account_list item=v}
                                                                <option value="{$v.account_id}">{$v.name}</option>
                                                            {/foreach}

                                                        </select>
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
                                    <div class="col-md-offset-5 col-md-5">
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