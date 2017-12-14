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
                <form action="/admin/loan/save" method="post" class="form-horizontal form-row-sepe">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Loan number</label>
                                    <div class="col-md-8">
                                        <div class="input-icon right">
                                            <input type="text" required name="loan_number" readonly value="{$loan_number}" class="form-control" >
                                        </div>	
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Customer name</label>
                                    <div class="col-md-8">
                                        <select name="customer_id" required class="form-control select2me" data-placeholder="Select...">
                                            <option value=""></option>
                                            {foreach from=$customer_list item=v}
                                                <option value="{$v.customer_id}">{$v.name}</option>
                                            {/foreach}
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-4">Date</label>
                                    <div class="col-md-8">
                                        <div class="input-icon right">
                                            <input type="text"  name="date" value="{$current_date}" class="form-control date-picker" data-date-format="dd M yyyy">
                                        </div>	
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Gold weight</label>
                                    <div class="col-md-6">
                                        <div class="input-icon right">
                                            <input type="text" required=""  name="gold_weight"  class="form-control" aria-required="true">
                                        </div>
                                    </div>
                                    <label class="control-label col-md-2">Grams</label>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Gold purity</label>
                                    <div class="col-md-8">
                                        <select name="gold_purity" required class="form-control select2me" data-placeholder="Select...">
                                            <option value="22">22 ct</option>
                                            <option value="24">24 ct</option>
                                            <option value="25">25 ct</option>
                                            <option value="26">26 ct</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Gold MRP</label>
                                    <div class="col-md-8">
                                        <div class="input-icon right">
                                            <input type="text" onblur="calculatemaxamount();" id="gold_mrp" name="gold_mrp" class="form-control" >
                                        </div>	
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Testing Charge</label>
                                    <div class="col-md-8">
                                        <div class="input-icon right">
                                            <input type="text"   name="testing_charge" class="form-control" >
                                        </div>	
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Max loan amt</label>
                                    <div class="col-md-6">
                                        <div class="input-icon right">
                                            <input type="text" id="max_loan_amt"  name="max_loan_amt" class="form-control" >
                                        </div>	
                                    </div>
                                    <label class="control-label col-md-2">80 %</label>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Gold info</label>
                                    <div class="col-md-8">
                                        <div class="input-icon right">
                                            <input type="text"  name="gold_info" class="form-control" >
                                        </div>	
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Loan Amount</label>
                                    <div class="col-md-8">
                                        <div class="input-icon right">
                                            <input type="text" required=""  name="loan_amt"  class="form-control" aria-required="true">

                                        </div>	
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Procs. amount</label>
                                    <div class="col-md-8">
                                        <div class="input-icon right">
                                            <input type="text" required=""  name="procs_amt"  class="form-control" aria-required="true">

                                        </div>	
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Terms</label>
                                    <div class="col-md-6">
                                        <div class="input-icon right">
                                            <input type="number" required=""  name="terms"  class="form-control" aria-required="true">
                                        </div>
                                    </div>
                                    <label class="control-label col-md-2">Month</label>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Intrest</label>
                                    <div class="col-md-8">
                                        <div class="input-icon right">
                                            <input type="number" required=""  name="intrest"  class="form-control" aria-required="true">

                                        </div>	
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">First EMI</label>
                                    <div class="col-md-8">
                                        <div class="input-icon right">
                                            <input type="text" required=""  name="first_emi"  class="form-control" aria-required="true">

                                        </div>	
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">EMI</label>
                                    <div class="col-md-8">
                                        <div class="input-icon right">
                                            <input type="text" required=""  name="emi"  class="form-control" aria-required="true">

                                        </div>	
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Remark</label>
                                    <div class="col-md-8">
                                        <div class="input-icon right">
                                            <textarea name="remark" class="form-control"></textarea>

                                        </div>	
                                    </div>
                                </div>
                            </div>
                        </div>


