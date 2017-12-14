
<div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">{$title}</h3>
    <!-- END PAGE HEADER-->

    <!-- BEGIN SEARCH CONTENT-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PORTLET-->



            <!-- END PORTLET-->
        </div>
    </div>
    <!-- BEGIN SEARCH CONTENT-->

    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PAYMENT TRANSACTION TABLE -->

            <div class="">
                <div class="portlet-title">
                    <div class="caption">
                       <h3 class="page-title">RD Schedule</h3> 
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="td-c">
                                        Pay no.
                                    </th>
                                    <th class="td-c">
                                        Begining balance
                                    </th>
                                    <th class="td-c">
                                        Installment
                                    </th>
                                    <th class="td-c">
                                        Principle
                                    </th>
                                    <th class="td-c">
                                        Intrest
                                    </th>
                                    
                                    <th class="td-c">
                                        Cumulative Intrest
                                    </th>
                                    <th class="td-c">
                                        Total
                                    </th>
                                    <th class="td-c">
                                        Date
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach from=$schedule item=v}
                                <tr {if $v.is_paid==1}class="bg-green-sharp"{/if}>
                                    <td class="td-c">
                                        {$v.sr}
                                    </td>
                                    <td class="td-c">
                                        {$v.begining_balance}
                                    </td>
                                    <td class="td-c">
                                        {$v.installment}
                                    </td>
                                    <td class="td-c">
                                        {$v.principle}
                                    </td>
                                    <td class="td-c">
                                        {$v.intrest}
                                    </td>
                                    <td class="td-c">
                                        {$v.cum_intrest}
                                    </td>
                                    <td class="td-c">
                                        {$v.balance}
                                    </td>
                                    <td class="td-c">
                                        {$v.date}
                                    </td>
                                </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>
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