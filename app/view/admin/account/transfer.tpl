
<div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">Transfer Amount</h3>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">
            {if isset($success)}
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert"></button>
                    <strong>Success!</strong>{$success}
                </div> 
            {/if}

            <div class="portlet light bordered">
                <div class="portlet-body form">
                    <!--<h3 class="form-section">Profile details</h3>-->
                    <form action="/admin/account/transfersave" method="post" id="submit_form" class="form-horizontal form-row-sepe">
                        <div class="form-body">
                            <!-- Start profile details -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-danger display-none">
                                        <button class="close" data-dismiss="alert"></button>
                                        You have some form errors. Please check below.
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-3">
                                                    <select class="form-control select2me" required id="bank_id" name="from_id" data-placeholder="From Account">
                                                        <option value=""></option>
                                                        {foreach from=$account_list item=v}
                                                            <option value="{$v.account_id}">{$v.name}</option>
                                                        {/foreach}

                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <select class="form-control select2me" required id="bank_id" name="to_id" data-placeholder="To Account">
                                                        <option value=""></option>
                                                        {foreach from=$account_list item=v}
                                                            <option value="{$v.account_id}">{$v.name}</option>
                                                        {/foreach}

                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="input-icon right">
                                                        <input type="text" placeholder="Amount"  name="amount" class="form-control" >
                                                    </div>	
                                                </div> 
                                                <div class="col-md-3">
                                                    <div class="input-icon right">
                                                        <input type="text" placeholder="Note"  name="note" class="form-control" >
                                                    </div>	
                                                </div> 
                                                <div class="col-md-1">
                                                    <input type="submit" value="Submit" class="btn blue"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- BEGIN PAYMENT TRANSACTION TABLE -->

                                            <div class="portlet box blue">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        Transfer List
                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                                                        <thead>
                                                            <tr>

                                                                <th class="td-c">
                                                                    ID
                                                                </th>
                                                                <th class="td-c">
                                                                    Date
                                                                </th>

                                                                <th class="td-c">
                                                                    From Account
                                                                </th>
                                                                <th class="td-c">
                                                                    To Account
                                                                </th>
                                                                <th class="td-c">
                                                                    Amount
                                                                </th>
                                                                <th class="td-c">
                                                                    Note
                                                                </th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <form action="" method="">
                                                            {foreach from=$transfer_list item=v}
                                                                <tr>
                                                                    <td class="td-c">
                                                                        {$v.id}
                                                                    </td>
                                                                    <td class="td-c">
                                                                        {{$v.created_date}|date_format:"%Y-%m-%d"}
                                                                    </td>
                                                                    <td class="td-c">
                                                                        {$v.from_account}
                                                                    </td>
                                                                    <td class="td-c">
                                                                        {$v.to_account}
                                                                    </td>
                                                                    <td class="td-c">
                                                                        {$v.amount}
                                                                    </td>
                                                                    <td class="td-c">
                                                                        {$v.note}
                                                                    </td>
                                                                </tr>
                                                            {/foreach}
                                                        </form>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>					
                        <!-- End profile details -->
                    </form>
                </div>
            </div>
        </div>	
        <!-- END PAGE CONTENT-->
    </div>
</div>
<!-- END CONTENT -->
</div>
