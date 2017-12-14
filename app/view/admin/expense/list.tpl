
<div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">{$title}</h3>
    <!-- END PAGE HEADER-->

    <!-- BEGIN SEARCH CONTENT-->
    <div class="row">
        <div class="col-md-12">
            {if isset($success)}
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert"></button>
                    <strong>Success!</strong>{$success}
                </div> {/if}

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


                <!-- BEGIN PORTLET-->

                <div class="portlet">
                    <div class="portlet-title">
                        <div class="caption">
                            Change search criteria
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse" data-original-title="" title="">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body" >

                        <form class="form-inline" role="form" action="" method="post">
                            <div class="form-group">
                                <input class="form-control form-control-inline input-sm date-picker" type="text" required  value="{$from_date}" name="from_date" data-date-format="dd M yyyy" placeholder="From date"/>
                            </div>

                            <div class="form-group">
                                <input class="form-control form-control-inline input-sm date-picker" type="text" required value="{$to_date}" name="to_date" data-date-format="dd M yyyy" placeholder="To date"/>
                            </div>


                            <input type="submit" class="btn btn-sm blue" value="Search">
                        </form>

                    </div>
                </div>

                <!-- END PORTLET-->
            </div>
        </div>
        <!-- BEGIN SEARCH CONTENT-->

        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAYMENT TRANSACTION TABLE -->

                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            Expense list
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                                <tr>

                                    <th class="td-c">
                                        Date
                                    </th>

                                    <th class="td-c">
                                        Category
                                    </th>
                                    <th class="td-c">
                                        Expense name
                                    </th>
                                    <th class="td-c">
                                        Payment mode
                                    </th>
                                    <th class="td-c">
                                        Amount
                                    </th>
                                    <th class="td-c">
                                        Receiver name
                                    </th>

                                    <th class="td-c">
                                        Action?
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            <form action="" method="">
                                {foreach from=$expense_list item=v}
                                    <tr>

                                        <td class="td-c">
                                            {{$v.date}|date_format:"%Y-%m-%d"}
                                        </td>

                                        <td class="td-c">
                                            {$v.category}
                                        </td>
                                        <td class="td-c">
                                            {$v.name}
                                        </td>
                                        <td class="td-c">
                                            {if $v.pay_type==1}
                                                Cheque
                                            {else}
                                                Cash 
                                            {/if}
                                        </td>
                                        <td class="td-c">
                                            {$v.amount}
                                        </td>
                                        <td class="td-c">
                                            {$v.receiver_name}
                                        </td>

                                        <td class="td-c">
                                            <a href="#" class="btn btn-xs blue"><i class="fa fa-table"></i> View </a>
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