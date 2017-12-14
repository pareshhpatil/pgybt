
<div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">Create sub admin</h3>
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
                    <form action="/admin/subuser/saved" method="post" id="submit_form" class="form-horizontal form-row-sepe">
                        <div class="form-body">
                            <!-- Start profile details -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-danger display-none">
                                        <button class="close" data-dismiss="alert"></button>
                                        You have some form errors. Please check below.
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Name <span class="required">
                                            </span></label>
                                        <div class="col-md-4">
                                            <input type="text" required name="name" class="form-control" value="{$post.name}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Email <span class="required">
                                            </span></label>
                                        <div class="col-md-4">
                                            <input type="email" required  name="email" class="form-control" value="{$post.email}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">User name <span class="required">
                                            </span></label>
                                        <div class="col-md-4">
                                            <input type="text" name="user_name" class="form-control" value="{$post.user_name}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Password <span class="required">
                                            </span></label>
                                        <div class="col-md-4">
                                            <input type="password" required id="submit_form_password" name="password" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Confirm Password <span class="required">
                                            </span></label>
                                        <div class="col-md-4">
                                            <input type="password" required  name="rpassword" class="form-control">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="control-label col-md-4">Mobile <span class="required">
                                            </span></label>
                                        <div class="col-md-4">
                                            <input type="text" name="mobile" class="form-control" value="{$post.mobile}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Role<span class="required">
                                            </span></label>
                                        <div class="col-md-4">
                                            <select required class="form-control select2me" name="role" >
                                                {foreach from=$roles key=k item=v}
                                                    <option value="{$v.role_id}">{$v.name}</option>
                                                {/foreach}
                                            </select>
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