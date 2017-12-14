
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

            <div class="col-md-6">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            Document list
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_5">
                            <thead>
                                <tr>
                                    <th class="td-c">
                                        Doc id
                                    </th>
                                    <th class="td-c">
                                        Name
                                    </th>
                                    <th class="td-c">
                                        Action?
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            <form action="" method="">
                                {foreach from=$doclist item=v}
                                    <tr>
                                        <td class="td-c">
                                            {$v.id}
                                        </td>
                                        <td class="td-c">
                                            {$v.name}
                                        </td>

                                        <td class="td-c">
                                            <a href="/uploads/images/customer_document/{$v.path}" target="_BLANK" class="btn btn-xs green"><i class="fa fa-edit"></i> View </a>
                                        </td>
                                    </tr>

                                {/foreach}
                            </form>
                            </tbody>
                        </table>
                    </div>
                </div>
                <form action="/admin/customer/documentsave/{$link}" method="post" id="submit_form" enctype="multipart/form-data" class="form-horizontal form-row-sepe">
                    <h3> Add new Document</h3>
                    <div  class="form-group">
                        <label class="control-label col-md-3">Document Name <span class="required">
                            </span></label>
                        <div class="col-md-6">
                            <input type="text"  required="" name="name" class="form-control" >
                        </div>
                    </div>
                    <div  class="form-group">
                        <label class="control-label col-md-3">Upload Doc<span class="required">
                            </span></label>
                        <div class="col-md-6">
                            <input type="file"  required="" name="uploaded_file" class="form-control" >
                        </div>
                    </div>
                    <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-6 col-md-5">
                                    <input type="submit" value="Submit" class="btn blue"/>
                                    <input type="hidden" name="customer_id" value="{$customer_id}" />
                                </div>
                            </div>
                        </div>
                </form>
            </div>

            <!-- END PAYMENT TRANSACTION TABLE -->
        </div>
    </div>
    <!-- END PAGE CONTENT-->
</div>
</div>
<!-- END CONTENT -->
