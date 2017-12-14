
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
                                <select class="form-control input-sm select2me" name="type" data-placeholder="Select type">
                                    <option value=""></option>
                                    <option  value="1" {if $type=='1'} selected {/if}>RD</option>
                                    <option  value="2" {if $type=='2'} selected {/if}>FD</option>
                                </select>
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
                            {$title}
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                                <tr>
                                    <th class="td-c">
                                        Maturity ID
                                    </th>
                                    <th class="td-c">
                                        Date
                                    </th>
                                    <th class="td-c">
                                        Type
                                    </th>
                                    <th class="td-c">
                                        Policy number
                                    </th>

                                    <th class="td-c">
                                        Customer name
                                    </th>
                                    <th class="td-c">
                                        Amount
                                    </th>

                                    <th class="td-c">
                                        Payment Mode
                                    </th>
                                    <th class="td-c">
                                        User name
                                    </th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            <form action="" method="">
                                {foreach from=$list item=v}
                                    <tr>

                                        <td class="td-c">
                                            {$v.maturity_id}
                                        </td>
                                        <td class="td-c">
                                            {{$v.date}|date_format:"%Y-%m-%d"}
                                        </td>

                                        <td class="td-c">
                                    {if $v.type==1}RD{else}FD{/if}
                                </td>
                                <td class="td-c">
                                    {$v.policy_number}
                                </td>
                                <td class="td-c">
                                    {$v.customer_name}
                                </td>

                                <td class="td-c">
                                    {$v.amount}
                                </td>

                                <td class="td-c">
                                    {$v.payment_type}
                                </td>
                                <td class="td-c">
                                    {$v.user_name}
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