
<div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">{$title}</h3>
    <!-- END PAGE HEADER-->

    <!-- BEGIN SEARCH CONTENT-->
    <!-- BEGIN SEARCH CONTENT-->

    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">
            {if $success!=''}
                <div class="alert alert-block alert-success fade in">
                    <button type="button" class="close" data-dismiss="alert"></button>
                    <p>Success! {$success}</p>
                </div>
            {/if}
            <!-- BEGIN PAYMENT TRANSACTION TABLE -->

            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        Customer list
                    </div>
                    <a href="/admin/customer/create" class="btn blue pull-right"> Create Customer</a>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_5">
                        <thead>
                            <tr>
                                <th class="td-c">
                                    Customer id
                                </th>
                                <th class="td-c">
                                    Customer name
                                </th>
                                <th class="td-c">
                                    Email
                                </th>
                                <th class="td-c">
                                    Mobile
                                </th>
                                <th class="td-c">
                                    Reff by
                                </th>
                                <th class="td-c">
                                    Action?
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        <form action="" method="">
                            {foreach from=$list item=v}
                                <tr>
                                    <td class="td-c">
                                        {$v.customer_id}
                                    </td>
                                    <td class="td-c">
                                        {$v.customer_name}
                                    </td>
                                    <td class="td-c">
                                        {$v.email}
                                    </td>
                                    <td class="td-c">
                                        {$v.mobile1}
                                    </td>
                                    <td class="td-c">
                                        {$v.reff_by}
                                    </td>
                                    <td class="td-c">

                                        <a href="/admin/customer/update/{$v.encrypted_id}" class="btn btn-xs green"><i class="fa fa-edit"></i> Edit </a>
                                        <a href="/admin/customer/document/{$v.encrypted_id}" class="btn btn-xs blue"><i class="fa fa-fax"></i> Document </a>
                                        <a href="/admin/customer/delete/{$v.encrypted_id}" class="btn btn-xs red"><i class="fa fa-remove"></i> Delete </a>
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
