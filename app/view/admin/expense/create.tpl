
<div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">Expense create</h3>
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
                    <form action="/admin/expense/save" method="post" id="submit_form" class="form-horizontal form-row-sepe">
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
                                                <label class="control-label col-md-6">Select Category <span class="required">
                                                    </span></label>
                                                <div class="col-md-6">
                                                    <select class="form-control" id="category_" required="" name="select_category" onchange="change_category(this.value);">
                                                        <option value=""></option>
                                                        {foreach from=$category_list item=v}
                                                            <option value="{$v.category}">{$v.category}</option>
                                                        {/foreach}
                                                        <option value="0">New category</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div id="category" style="display: none;" class="form-group">
                                                <label class="control-label col-md-6">New Category <span class="required">
                                                    </span></label>
                                                <div class="col-md-6">
                                                    <input type="text" id="category_text" required="" name="category" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-6">Expense name <span class="required">
                                                    </span></label>
                                                <div class="col-md-6">
                                                    <input type="text" required="" name="name" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-6">Amount</label>
                                                <div class="col-md-4">
                                                    <div class="input-icon right">
                                                        <input type="number" min="0"  name="amount" class="form-control" >
                                                    </div>	
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
                                                <label class="control-label col-md-6">Date <span class="required">
                                                    </span></label>
                                                <div class="col-md-6">
                                                    <input type="text" required="" autocomplete="off" id="date" name="date" value="{$current_date}" class="form-control date-picker" data-date-format="dd M yyyy">
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

<script>
                                                        function change_category(val)
                                                        {
                                                            if (val == '0')
                                                            {
                                                                document.getElementById('category').style.display = 'block';
                                                                document.getElementById('category_text').value = '';
                                                            } else
                                                            {
                                                                document.getElementById('category').style.display = 'none';
                                                                document.getElementById('category_text').value = val;
                                                            }
                                                        }
</script>