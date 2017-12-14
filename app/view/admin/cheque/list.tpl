
<div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">Cheque master</h3>
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
                            Cheque Master 
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
                                        Customer name
                                    </th>
                                    <th class="td-c">
                                        User name
                                    </th>
                                    <th class="td-c">
                                        Bank name
                                    </th>
                                    <th class="td-c">
                                        Note
                                    </th>
                                    <th class="td-c">
                                        Action?
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            <form action="" method="">
                                {foreach from=$cheque_list item=v}
                                    <tr>
                                        <td class="td-c">
                                            {{$v.date}|date_format:"%Y-%m-%d"}
                                        </td>
                                        <td class="td-c">
                                            {$v.customer_name}
                                        </td>
                                        <td class="td-c">
                                            {$v.user_name}
                                        </td>
                                        <td class="td-c">
                                            {$v.bank_name}
                                        </td>
                                        <td class="td-c">
                                            {$v.note}
                                        </td>
                                        <td class="td-c">
                                            <a href="/admin/cheque/viewcheck/{$v.link}" class="btn btn-xs blue iframe"><i class="fa fa-tasks"></i> View list</a>
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