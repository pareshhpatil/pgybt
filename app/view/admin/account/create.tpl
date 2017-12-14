
<div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">Saving Accounts</h3>
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
                    <form action="/admin/account/save" method="post" id="submit_form" class="form-horizontal form-row-sepe">
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
                                                    <select class="form-control" required="" name="category" onchange="change_category(this.value);">
                                                        <option value="">Select category</option>
                                                        <option value="1">Counter</option>
                                                        <option value="2">Bank</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-6">Account name <span class="required">
                                                    </span></label>
                                                <div class="col-md-6">
                                                    <input type="text" required="" name="name" class="form-control" >
                                                </div>
                                            </div>
                                            <div id="category" style="display: none;">
                                                <div class="form-group">
                                                    <label class="control-label col-md-6">Account Number <span class="required">
                                                        </span></label>
                                                    <div class="col-md-6">
                                                        <input type="text"  name="account_number" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-6">IFSC Code <span class="required">
                                                        </span></label>
                                                    <div class="col-md-6">
                                                        <input type="text"  name="ifsc" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-6">Branch <span class="required">
                                                        </span></label>
                                                    <div class="col-md-6">
                                                        <input type="text" name="branch" class="form-control" >
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-6">Current Balance</label>
                                                <div class="col-md-4">
                                                    <div class="input-icon right">
                                                        <input type="number" min="0"  name="balance" class="form-control" >
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
                                                                if (val == '2')
                                                            {
                                                                        document.getElementById('category').style.display = 'block';
                                                                    } else
                                                            {
                                                                        document.getElementById('category').style.display = 'none';
                                                                    }
                                                                }
</script>