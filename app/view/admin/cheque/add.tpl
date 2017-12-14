
<div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">Cheque Master</h3>
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
                    <form action="/admin/cheque/save" method="post" id="submit_form" class="form-horizontal form-row-sepe">
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
                                                <label class="control-label col-md-4">Customer name <span class="required">
                                                    </span></label>
                                                <div class="col-md-4">
                                                    <select name="customer_id" required class="form-control select2me" data-placeholder="Select...">
                                                        <option value=""></option>
                                                        {foreach from=$customer_list item=v}
                                                            <option value="{$v.customer_id}">{$v.name}</option>
                                                        {/foreach}
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4">Date <span class="required">
                                                    </span></label>
                                                <div class="col-md-4">
                                                    <input type="text" required="" autocomplete="off" name="date" value="{$current_date}" class="form-control date-picker" data-date-format="dd M yyyy">
                                                </div>
                                            </div>
                                            <div class="form-group" id="bank_name">
                                                <label class="control-label col-md-4">Bank name<span class="required">
                                                    </span></label>
                                                <div class="col-md-4">
                                                    <select class="form-control select2me" name="bank_id" data-placeholder="Select Bank">
                                                        <option value=""></option>
                                                        {foreach from=$bank_list item=v}
                                                            <option value="{$v.config_key}">{$v.config_value}</option>
                                                        {/foreach}

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Note <span class="required">
                                                    </span></label>
                                                <div class="col-md-4">
                                                    <textarea  name="note" class="form-control" ></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-2"></div>
                                                <div class="col-md-7">
                                                    <h3 class="form-section">Add Cheque
                                                        <a href="javascript:;" onclick="AddCheque();" class="btn btn-sm blue-madison pull-right"> <i class="fa fa-plus"> </i> Add</a></h3>

                                                    <div class="table-scrollable">
                                                        <table class="table table-bordered table-hover" id="particular_table">
                                                            <thead>
                                                                <tr>
                                                                    <th class="td-c">
                                                                        Cheque Number
                                                                    </th>
                                                                    <th class="td-c">
                                                                        Amount
                                                                    </th>
                                                                    <th class="td-c">
                                                                        Cheque Date
                                                                    </th>
                                                                    <th class="td-c">
                                                                        Action
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="new_cheque">
                                                            <td>
                                                                <div class="input-icon right">
                                                                    <input type="text" name="cheque_number[]" required class="form-control input-sm" placeholder="Cheque Number">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-icon right">
                                                                    <input type="text" name="amount[]" required class="form-control input-sm" placeholder="Cheque Amount">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-icon right">
                                                                    <input type="text" name="cheque_date[]"  required class="form-control input-sm " placeholder="Cheque date dd-mm-yyyy">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:;" onClick="$(this).closest('tr').remove();" class="btn btn-sm red"> <i class="fa fa-times"> </i></a>
                                                            </td>
                                                            </tbody>
                                                        </table>
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