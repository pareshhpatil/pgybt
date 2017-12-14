
<div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">{$title}</h3>
    <!-- END PAGE HEADER-->

    <!-- BEGIN SEARCH CONTENT-->
    <div class="row">
        <div class="col-md-12">

            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        Choose loan type
                    </div>
                </div>
                <div class="portlet-body form">
                    <form action="" method="post" id="template_create" class="form-horizontal form-row-sepe">
                        <div class="form-body">
                            <div class="form-group">
                                <div class="col-md-7">
                                    <div class="col-md-3"><label class="control-label">Select Loan type<span class="required">* </span></label></div>
                                    <div class="col-md-7">
                                        <select name="loan_type" required class="form-control select2me" data-placeholder="Select...">
                                            <option value=""></option>
                                            {foreach from=$loan_type item=v}
                                                {if {{$loan_type_selected}=={$v.config_key}}}
                                                    <option selected value="{$v.config_key}" selected>{$v.config_value}</option>
                                                {else}
                                                    <option value="{$v.config_key}">{$v.config_value}</option>
                                                {/if}
                                            {/foreach}
                                        </select>
                                    </div>
                                    <button type="submit" class="btn blue"><i class="fa fa-check"></i> Select</button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- BEGIN SEARCH CONTENT-->


