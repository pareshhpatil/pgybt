
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->

        <!-- /.modal -->
        <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
        <!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">
            <strong>Customer Policy</strong>   
        </h3>

        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                {if isset($success)}
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert"></button>
                        <strong>Success!</strong>{$success}
                    </div>
                {/if}
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
                                <select class="form-control select2me" style="width: 450px;" name="customer_id" data-placeholder="Select Customer">
                                    <option value=""></option>

                                    {foreach from=$customer_list item=v}
                                        {if $customer_selected==$v.customer_id}
                                            <option selected value="{$v.customer_id}">{$v.name}</option>
                                        {else}
                                            <option value="{$v.customer_id}">{$v.name}</option>
                                        {/if}
                                    {/foreach}

                                </select>
                            </div>
                            <button type="submit" class="btn sm blue">Search</button>
                        </form>

                    </div>
                </div>






                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box blue-hoki">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-globe"></i>View Customer Policy
                        </div>
                        <div class="tools">
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                                <tr>
                                    <th date>
                                        Date
                                    </th>
                                    <th date>
                                        Policy Number
                                    </th>
                                    <th >
                                        Customer Name
                                    </th>
                                    <th>
                                        Policy Type</th>
                                    <th >
                                        Amount</th>
                                    <th>
                                        Terms</th>

                                    <th>
                                        Intrest</th>

                                </tr>
                            </thead>
                            <tbody>
                                {foreach from=$list item=v}
                                    <tr>
                                        <td>
                                            {{$v.date}|date_format:"%Y-%m-%d"}
                                        </td>

                                        <td>
                                            {$v.policy_number}
                                        </td>
                                        <td>
                                            {$v.name}
                                        </td>
                                        <td>
                                            {$v.type}
                                        </td>
                                        <td>
                                            {$v.amount}
                                        </td>
                                        <td>
                                            {$v.terms}
                                        </td>
                                        <td>
                                            {$v.intrest}
                                        </td>

                                    </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
                </form>
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>
