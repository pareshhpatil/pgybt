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




                                {if $type=='1'}        
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Gold weight</label>
                                        <div class="col-md-6">
                                            <div class="input-icon right">
                                                <input type="text" required=""  name="info1"  class="form-control" aria-required="true">
                                            </div>
                                        </div>
                                        <label class="control-label col-md-2">Grams</label>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Gold purity</label>
                                        <div class="col-md-8">
                                            <select name="info2" required class="form-control select2me" data-placeholder="Select...">
                                                <option value="22 ct">22 ct</option>
                                                <option value="24 ct">24 ct</option>
                                                <option value="25 ct">25 ct</option>
                                                <option value="26 ct">26 ct</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Gold info</label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">
                                                <input type="text"  name="info3" class="form-control" >
                                            </div>	
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Gold MRP</label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">
                                                <input type="text" onblur="calculatemaxamount();" id="gold_mrp" name="mrp" class="form-control" >
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
                                {elseif $type=='2'}
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Vehicle Brand</label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">
                                                <input type="text" required=""  name="info1"  class="form-control" aria-required="true">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">RC Book Number</label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">
                                                <input type="text" required=""  name="info2"  class="form-control" aria-required="true">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Registration Number</label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">
                                                <input type="text" required=""  name="info3"  class="form-control" aria-required="true">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Vehicle MRP</label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">
                                                <input type="text" onblur="calculatemaxamount();" id="gold_mrp" name="mrp" class="form-control" >
                                            </div>	
                                        </div>
                                    </div>
                                {elseif $type=='3'}

                                    <div class="form-group">
                                        <label class="control-label col-md-4">Registration Number</label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">
                                                <input type="text" required=""  name="info1"  class="form-control" aria-required="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-4">Property Address</label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">
                                                <textarea required=""  name="info3"  class="form-control" aria-required="true"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Property Value</label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">
                                                <input type="text" onblur="calculatemaxamount();" id="gold_mrp" name="mrp" class="form-control" >
                                            </div>	
                                        </div>
                                    </div>

                                {elseif $type=='4'}

                                    <div class="form-group">
                                        <label class="control-label col-md-4">Against By</label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">
                                                <input type="text" required=""  name="info1"  class="form-control" aria-required="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-4">Stuff Info</label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">
                                                <textarea required=""  name="info3"  class="form-control" aria-required="true"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Stuff Value</label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">
                                                <input type="text" onblur="calculatemaxamount();" id="gold_mrp" name="mrp" class="form-control" >
                                            </div>	
                                        </div>
                                    </div>
                                {elseif $type=='5'}

                                    <div class="form-group">
                                        <label class="control-label col-md-4">RD/FD Number</label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">
                                                <input type="text" required=""  name="info1"  class="form-control" aria-required="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-4">Info</label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">
                                                <textarea required=""  name="info3"  class="form-control" aria-required="true"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">RD/FD Value</label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">
                                                <input type="text" onblur="calculatemaxamount();" id="gold_mrp" name="mrp" class="form-control" >
                                            </div>	
                                        </div>
                                    </div>
                                {elseif $type=='6'}

                                    <div class="form-group">
                                        <label class="control-label col-md-4">Policy Type</label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">
                                                <input type="text" required=""  name="info1"  class="form-control" aria-required="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-4">Policy Numbers</label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">
                                                <textarea required=""  name="info3"  class="form-control" aria-required="true"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Policy Value</label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">
                                                <input type="text" onblur="calculatemaxamount();" id="gold_mrp" name="mrp" class="form-control" >
                                            </div>	
                                        </div>
                                    </div>
                                {/if}





                                <div class="form-group">
                                    <label class="control-label col-md-4">Max loan amt</label>
                                    <div class="col-md-6">
                                        <div class="input-icon right">
                                            <input type="text" id="max_loan_amt"  name="max_loan_amt" class="form-control" >
                                        </div>	
                                    </div>
                                    <label class="control-label col-md-2">80 %</label>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Loan Amount</label>
                                    <div class="col-md-8">
                                        <div class="input-icon right">
                                            <input type="text" required="" id="loan_amount" onblur="calculateLoan();" name="loan_amt"  class="form-control" aria-required="true">

                                        </div>	
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Procs. amount</label>
                                    <div class="col-md-8">
                                        <div class="input-icon right">
                                            <input type="text" required="" id="proc"  name="procs_amt"  class="form-control" aria-required="true">

                                        </div>	
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Terms</label>
                                    <div class="col-md-6">
                                        <div class="input-icon right">
                                            <input type="number" required="" id="term" onblur="calculateLoan();" name="terms"  class="form-control" aria-required="true">
                                        </div>
                                    </div>
                                    <label class="control-label col-md-2">Month</label>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Intrest</label>
                                    <div class="col-md-8">
                                        <div class="input-icon right">
                                            <input type="number" required="" id="intrest" onblur="calculateLoan();" name="intrest"  class="form-control" aria-required="true">

                                        </div>	
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-4">EMI</label>
                                    <div class="col-md-8">
                                        <div class="input-icon right">
                                            <input type="text" required="" id="installment"  name="emi" onblur="calculateLoanTerms();" class="form-control" aria-required="true">

                                        </div>	
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-4">Paid Amount</label>
                                    <div class="col-md-8">
                                        <div class="input-icon right">
                                            <input type="text" required="" name="paid_amount"  class="form-control" aria-required="true">

                                        </div>	
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Payment Mode<span class="required">
                                        </span></label>
                                    <div class="col-md-8">
                                        <select class="form-control" id="payment_mode" name="payment_mode" onchange="responseType(this.value);">
                                            <option value="0">Select Payment</option>
                                            <option value="1">CHEQUE</option>
                                            <option value="2">CASH</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Account<span class="required">
                                        </span></label>
                                    <div class="col-md-8">
                                        <select class="form-control select2me" required id="bank_id" name="bank_id" data-placeholder="Select Account">
                                            <option value=""></option>
                                            {foreach from=$bank_list item=v}
                                                <option value="{$v.account_id}">{$v.name}</option>
                                            {/foreach}

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group" id="cheque_no" style="display: none;">
                                    <label id="bank_name" class="control-label col-md-4">Cheque number<span class="required">
                                        </span></label>
                                    <div class="col-md-8">
                                        <input class="form-control" id="cheque_number" name="cheque_number"   type="text" value="" placeholder="Cheque no"/>
                                    </div>
                                </div>
                                <div class="form-group" id="cheque_dat" style="display: none;">
                                    <label class="control-label col-md-4">Cheque Date <span class="required">
                                        </span></label>
                                    <div class="col-md-8">
                                        <input type="text" required="" autocomplete="off"  id="cheque_date" name="cheque_date" value="{$current_date}" class="form-control date-picker" data-date-format="dd M yyyy">
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


