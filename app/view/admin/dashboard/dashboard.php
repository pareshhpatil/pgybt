<div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">Admin dashboard</h3>

   
    <!-- END PAGE HEADER-->
<?php if ($this->chart_display == TRUE) { ?>
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <!-- BEGIN PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <a class="caption-subject font-green-sharp bold uppercase" href="/admin/chart/paymentreceived">Payment received</a>
                        </div>
                        <div class="pull-right"> <a href="/admin/chart/paymentreceived"><i class="fa  fa-arrow-circle-o-right fa-lg"></i></a></div>
                    </div>
                    <div class="portlet-body">
                        <iframe style="width: 100%;height: 310px;" src="/admin/chart/paymentreceived/1"></iframe>
                    </div>
                </div>
                <!-- END PORTLET-->
            </div>
            <div class="col-md-6 col-sm-6">
                <!-- BEGIN PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-share font-red-sunglo hide"></i>
                            <a class="caption-subject font-red-sunglo bold uppercase" href="/admin/chart/billingstatus">User status</a>

                        </div>
                        <div class="pull-right"> <a href="/admin/chart/billingstatus"><i class="fa  fa-arrow-circle-o-right fa-lg"></i></a></div>
                    </div>
                    <div class="portlet-body">
                        <iframe style="width: 100%;height: 310px;" src="/admin/chart/billingstatus/1"></iframe>
                    </div>
                </div>
                <!-- END PORTLET-->
            </div>
        </div>

<?php } ?>

    
</div>
</div>

