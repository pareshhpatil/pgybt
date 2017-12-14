<script type="text/javascript">
    function savere()
    {
            var data = $("#calculate").serialize();
            $.ajax({
                type: 'POST',
                url: '/admin/loan/getcalculation',
                data: data,
                success: function(data)
       {
                       document.getElementById('schedule').innerHTML = data;
                       showterms();
                   }
               });
               return false;
           }



</script>
<div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">Loan Calculator</h3>
    <!-- END PAGE HEADER-->

    <!-- BEGIN SEARCH CONTENT-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PORTLET-->



            <!-- END PORTLET-->
        </div>
    </div>
    <!-- BEGIN SEARCH CONTENT-->

    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PAYMENT TRANSACTION TABLE -->

            <div class="row no-margin">
                <form method="POST" onsubmit="return savere();"  id="calculate" >
                    <div class="col-md-5" style="background-color: #fcf8e3;">

                        <div class="form-group" style="margin-top: 5px;">
                            <label class="control-label col-md-4">Loan amount :</label>
                            <div class="col-md-6">
                                <div class="input-icon right">
                                    <input type="text" required=""  name="loan_amount" id="loan_amount"  class="form-control input-sm" aria-required="true">
                                </div>
                                <span class="help-block"> </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Terms :</label>
                            <div class="col-md-6">
                                <div class="input-icon right">
                                    <input type="text"   name="terms" id="term" onblur="showemi();" class="form-control input-sm" aria-required="true">
                                </div>
                                <span class="help-block"> </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Intrest :</label>
                            <div class="col-md-6">
                                <div class="input-icon right">
                                    <input type="text" required=""  name="intrest" onblur="showemi();" id="intrest" class="form-control input-sm" aria-required="true">
                                </div>
                                <span class="help-block"> </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Start Date :</label>
                            <div class="col-md-6">
                                <div class="input-icon right">
                                    <input type="text"  name="date" id="start_date" value="{$current_date}" class="form-control date-picker  input-sm" data-date-format="dd M yyyy">
                                </div>
                                <span class="help-block"> </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">

                    </div>
                    <div class="col-md-5" style="background-color: #fcf8e3;">
                        <div class="form-group" style="margin-top: 5px;">
                            <label class="control-label col-md-4">Installment :</label>
                            <div class="col-md-6">
                                <div class="input-icon right">
                                    <input type="text"  name="installment" onblur="showterms();" id="installment"  class="form-control input-sm" aria-required="true">
                                </div>
                                <span class="help-block"> </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4">Total Intrest :</label>
                            <div class="col-md-6">
                                <div class="input-icon right">
                                    <input type="text"  name="total_intrest" id="total_intrest" class="form-control input-sm" aria-required="true">
                                </div>
                                <span class="help-block"> </span>
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Applicant name :</label>
                            <div class="col-md-6">
                                <div class="input-icon right">
                                    <input type="text"  name="appicant_name" value="" class="form-control input-sm">
                                </div>
                                <span class="help-block"> </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4"></label>
                            <div class="col-md-6">
                                <div class="input-icon right">
                                    <button type="submit" class="btn blue btn-sm pull-right">Claculate</button>
                                </div>
                                <span class="help-block"> </span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <br>

            <div class="portlet-body">
                <div id="schedule" class="table-scrollable">

                </div>
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