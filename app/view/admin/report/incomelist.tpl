
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
                            Income list
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
                                        Category
                                    </th>
                                    <th class="td-c">
                                        Amount
                                    </th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            <form action="" method="">
                                {foreach from=$list item=v}
                                    <tr>
                                        <td class="td-c">
                                            {$v.income_id}
                                        </td>
                                        <td class="td-c">
                                            {{$v.created_date}|date_format:"%Y-%m-%d"}
                                        </td>

                                        <td class="td-c">
                                            {$v.type}
                                        </td>
                                        <td class="td-c">
                                            {$v.amount}
                                        </td>
                                        
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