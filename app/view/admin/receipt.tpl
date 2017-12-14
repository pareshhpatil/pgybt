<div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <!-- END PAGE HEADER-->


    <div class="row no-margin">

        <div class="col-md-1"></div>
        <div class="col-md-10" style="text-align: -webkit-center;text-align: -moz-center;">
            <br>
            <div class="portlet light bordered" style="max-width: 900px;">

                <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->

                <!-- /.modal -->
                <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
                <!-- BEGIN PAGE CONTENT-->
                <div class="invoice" style="text-align: left;">
                    <div class="row">
                        <div class="col-xs-12 center">
                            <p style="font-size: 15px;font-weight: bold;"class="center"><bold>"JAI MATA DI"</bold></p>
                            <p style="font-size: 30px;font-weight: bold;" class="center"><bold>PGYBT FINANCE</bold></p>
                            <p class="center">Shop No.6,Behind Ayyappa Temple, Technical Area, Marol Pipe Line, Andheri (E), Mumbai - 400 059.</p>

                            <p style="font-size: 20px;font-weight: bold;" class="center">{$details.header}</p>

                            <div class="row no-margin"><p class="pull-right" style="font-size: 15px;margin-bottom: 5px;">Sr.No : <b>{$details.number}</b></p>
                            </div>
                            <div class="row no-margin">
                                <p class="pull-right " style="font-size: 15px;margin-bottom: 0px;">Date : <b>{$details.date}</b></p>
                            </div>
                        </div>
                    </div>
                    <hr/>

                    <div class="row">
                        <div class="col-xs-12 invoice-payment">
                            <ul class="list-unstyled">
                                <li style="font-size: 15px;">Received with thanks from <b>{$details.customer_name}</b></li> 
                                <li style="font-size: 15px;">The sum of Rupees <b>{$money_word}</b></li> 
                                <li style="font-size: 15px;">Towards <b>{$details.policy_type}</b> Account Number <b>{$details.policy_number}</b> Amount of <b>{$details.amount}/-</b></li> 
                               
                                <li style="font-size: 15px;"> {if $details.policy_type=='LOAN'}Principal Refund <b>{$details.principal_amount}</b> Intrest received <b>{$details.intrest_amount} </b>{/if}
                                {if $details.payment_type==1}By Cheque No <b>{$details.cheque_number}</b> {/if}Dated <b>{$details.cheque_date}</b></li> 
                            {if $details.policy_type=='LOAN'}<li style="font-size: 15px;">Balance loan amount <b>{$details.balance}</b></li> {/if}

                        </ul>
                        <hr>
                        <div class="row no-margin">
                            <p class="pull-right " style="font-size: 20px;font-weight: bold;">For PGYBT FINANCE</p>
                        </div>
                        <br>
                        <br>
                        <div class="row no-margin">
                            <p class="pull-left " style="font-size: 18px;">Rs. <b>{$details.amount}</b>/-</p>
                            <p class="pull-right " style="font-size: 18px;">Cashier/Accountant</p>
                        </div>
                    </div>
                    <div class="col-xs-1">
                    </div>
                </div>
            </div>

            <!-- END PAGE CONTENT-->
        </div>





    </div>
    <div class="col-md-1"></div>
</div>
<div class="row">
    <div class="col-xs-12 invoice-block text-center">
        <a class="btn btn-lg blue hidden-print margin-bottom-5 text-center" onclick="javascript:window.print();">Print <i class="fa fa-print"></i></a>
    </div>
</div>
<!-- END PAGE CONTENT-->
</div>
</div>
<!-- END CONTENT -->


