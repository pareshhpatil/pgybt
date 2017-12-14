
<div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">Customer create</h3>
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
                    <form action="/admin/customer/save" method="post" id="submit_form" enctype="multipart/form-data" class="form-horizontal form-row-sepe">
                        <div class="form-body">
                            <!-- Start profile details -->
                            <div class="row">
                                <div class="col-md-11">
                                    <div class="alert alert-danger display-none">
                                        <button class="close" data-dismiss="alert"></button>
                                        You have some form errors. Please check below.
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-9"></div>
                                        <div class="col-md-3 fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 130px;">
                                                <img src="/assets/admin/layout/img/nologo.gif" class="img-responsive templatelogo" alt=""/>
                                            </div>
                                            <div  class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                            </div>
                                            <div>
                                                <span class="btn btn-sm default btn-file">
                                                    <span class="fileinput-new">
                                                        Select photo </span>
                                                    <span class="fileinput-exists">
                                                        Change </span>
                                                    <input type="file" accept="image/*"  name="uploaded_file">
                                                </span>
                                                <a href="javascript:;" class="btn-sm btn default fileinput-exists" data-dismiss="fileinput">
                                                    Remove </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-6">Customer name <span class="required">
                                                    </span></label>
                                                <div class="col-md-6">
                                                    <input type="text" required name="name" class="form-control" value="{$post.name}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-6">Email <span class="required">
                                                    </span></label>
                                                <div class="col-md-6">
                                                    <input type="email" name="email" class="form-control" value="{$post.email}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-6">Contact #1 mobile <span class="required">
                                                    </span></label>
                                                <div class="col-md-6">
                                                    <input type="text" required name="mobile" class="form-control" value="{$post.mobile}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-6">Contact #2 mobile <span class="required">
                                                    </span></label>
                                                <div class="col-md-6">
                                                    <input type="text" required name="mobile2" class="form-control" value="{$post.mobile2}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-6">Current address <span class="required">
                                                    </span></label>
                                                <div class="col-md-6">
                                                    <textarea name="current_address" class="form-control" >{$post.current_address}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-6">Permanent address <span class="required">
                                                    </span></label>
                                                <div class="col-md-6">
                                                    <textarea name="permanent_address" class="form-control" >{$post.permanent_address}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-6">Reff by <span class="required">
                                                    </span></label>
                                                <div class="col-md-6">
                                                    <select class="form-control select2me" name="reff_by" >
                                                        {foreach from=$userlist key=k item=v}
                                                            {if {{$selected}=={$v.user_id}}}
                                                                <option selected value="{$v.user_id}" selected>{$v.name}</option>
                                                            {else}
                                                                <option value="{$v.user_id}">{$v.name}</option>
                                                            {/if}

                                                        {/foreach}
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-6">Join date <span class="required">
                                                    </span></label>
                                                <div class="col-md-6">
                                                    <input type="text" required="" autocomplete="off" name="join_date" value="{$post.join_date}" class="form-control date-picker" data-date-format="dd M yyyy">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-6">Birth date <span class="required">
                                                    </span></label>
                                                <div class="col-md-6">
                                                    <input type="text" required="" autocomplete="off" name="birth_date" value="{$post.birth_date}" class="form-control date-picker" data-date-format="dd M yyyy">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-6">Anniversary <span class="required">
                                                    </span></label>
                                                <div class="col-md-6">
                                                    <input type="text" required="" autocomplete="off" name="anniversary" value="{$post.anniversary}" class="form-control date-picker" data-date-format="dd M yyyy">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-6">Note <span class="required">
                                                    </span></label>
                                                <div class="col-md-6">
                                                    <textarea name="note" class="form-control" >{$post.note}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-6">Pan no <span class="required">
                                                    </span></label>
                                                <div class="col-md-6">
                                                    <input type="text" name="pan" class="form-control" value="{$post.pan}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-6">Voter no <span class="required">
                                                    </span></label>
                                                <div class="col-md-6">
                                                    <input type="text" name="voter_no" class="form-control" value="{$post.voter_no}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-6">UID no <span class="required">
                                                    </span></label>
                                                <div class="col-md-6">
                                                    <input type="text"  name="uid" class="form-control" value="{$post.uid}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-6">Nom #1 name <span class="required">
                                                    </span></label>
                                                <div class="col-md-6">
                                                    <input type="text" name="nom1_name" class="form-control" value="{$post.nom1_name}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-6">Nom #1 phone <span class="required">
                                                    </span></label>
                                                <div class="col-md-6">
                                                    <input type="text" name="nom1_phone" class="form-control" value="{$post.nom1_phone}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-6">Nom #1 address <span class="required">
                                                    </span></label>
                                                <div class="col-md-6">
                                                    <textarea name="nom1_address" class="form-control" >{$post.nom1_address}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-6">Nom #2 name <span class="required">
                                                    </span></label>
                                                <div class="col-md-6">
                                                    <input type="text" name="nom2_name" class="form-control" value="{$post.nom2_name}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-6">Nom #2 phone <span class="required">
                                                    </span></label>
                                                <div class="col-md-6">
                                                    <input type="text" name="nom2_phone" class="form-control" value="{$post.nom2_phone}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-6">Nom #2 address <span class="required">
                                                    </span></label>
                                                <div class="col-md-6">
                                                    <textarea name="nom2_address" class="form-control" >{$post.nom2_address}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-6">Vitnase name <span class="required">
                                                    </span></label>
                                                <div class="col-md-6">
                                                    <input type="text" name="vitnase_name" class="form-control" value="{$post.vitnase_name}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-6">Vitnase phone <span class="required">
                                                    </span></label>
                                                <div class="col-md-6">
                                                    <input type="text" name="vitnase_phone" class="form-control" value="{$post.vitnase_phone}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-6">Vitnase address <span class="required">
                                                    </span></label>
                                                <div class="col-md-6">
                                                    <textarea name="vitnase_address" class="form-control" >{$post.vitnase_address}</textarea>
                                                </div>
                                            </div>
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