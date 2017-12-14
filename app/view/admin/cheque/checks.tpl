
<div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <br>
    <h3 class="page-title">Cheque List</h3>
    <!-- END PAGE HEADER-->

    <!-- BEGIN SEARCH CONTENT-->

    <!-- BEGIN SEARCH CONTENT-->

    <!-- BEGIN PAGE CONTENT-->
    <div class="row no-margin">
        <div class="col-md-12">
            <!-- BEGIN PAYMENT TRANSACTION TABLE -->

            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        Cheque List 
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
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
                                    Is used?
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                        <form action="" method="">
                            {foreach from=$cheque_list item=v}
                                <tr>

                                    <td class="td-c">
                                        {$v.cheque_number}
                                    </td>
                                    <td class="td-c">
                                        {$v.amount}
                                    </td>
                                    <td class="td-c">
                                        {{$v.cheque_date}|date_format:"%Y-%m-%d"}
                                    </td>
                                    <td class="td-c">
                                        {if $v.is_used==1}
                                            Yes
                                        {else}
                                            No
                                        {/if}
                                    </td>
                                    
                                </tr>
                            {/foreach}
                        </form>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- END PAYMENT TRANSACTION TABLE -->
        </div>
    </div>
    <!-- END PAGE CONTENT-->
</div>
</div>
<!-- END CONTENT -->
<!-- /.modal -->

<!-- /.modal-dialog -->
</div>
<!-- /.modal -->