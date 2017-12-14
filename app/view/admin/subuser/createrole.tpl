
<div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">Role create</h3>
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
                    <form action="/admin/subuser/saverole" method="post" id="submit_form" class="form-horizontal form-row-sepe">
                        <div class="form-body">
                            <!-- Start profile details -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-danger display-none">
                                        <button class="close" data-dismiss="alert"></button>
                                        You have some form errors. Please check below.
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Role name <span class="required">
                                            </span></label>
                                        <div class="col-md-4">
                                            <input type="text" required name="role_name" class="form-control" value="{$post.role_name}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-4">Role<span class="required">
                                            </span></label>
                                        <div class="col-md-4">

                                            <table class="table table-bordered table-hover" id="">
                                                <thead>
                                                    <tr>
                                                        <th class="td-c">
                                                            ID
                                                        </th>
                                                        <th class="td-c">
                                                            Controller
                                                        </th>
                                                        <th class="td-c">
                                                            Action?
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {foreach from=$list item=v}
                                                        <tr>
                                                            <td class="td-c">
                                                                {$v.controller_id}
                                                            </td>
                                                            <td class="td-c">
                                                                {$v.display_name}
                                                            </td>

                                                            <td class="td-c">
                                                                {if $v.is_default==1} 
                                                                    <input  checked="" disabled value="{$v.controller_id}" type="checkbox">
                                                                    <input  checked name="controllers[]" value="{$v.controller_id}"  type="hidden">
                                                                {else}
                                                                    <input   name="controllers[]" value="{$v.controller_id}" type="checkbox">
                                                                {/if}

                                                            </td>
                                                        </tr>

                                                    {/foreach}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>


                            </div>
                        </div>					
                        <!-- End profile details -->

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-6 col-md-5">
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