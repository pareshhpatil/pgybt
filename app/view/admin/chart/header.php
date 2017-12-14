<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
    <head>
        <link rel="canonical" href="https://pgybt.in/<?php echo $this->canonical; ?>"/>
        <?php
        if (isset($this->metadata)) {
            echo $this->metadata;
        } else {
            ?>
            <title>PGYBT</title>

        <?php }
        ?>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/ui-lightness/jquery-ui.css"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <link rel="icon" type="image/png" href="/images/pgybtico.ico" />
        <link rel="stylesheet" type="text/css" href="/css/loggedincombine.css"/>
        <script type="text/javascript" src="/js/modernizr.custom.79639.js"></script>
        <script type="text/javascript" src="/js/abetterbrowser.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.8.2.js"></script>
        <script type="text/javascript" src="/inc/js/invoicecalculation.js"></script>

        <script type="text/javascript" src="/assets/global/plugins/chart/amcharts.js" ></script>
        <script type="text/javascript" src="/assets/global/plugins/amcharts/amcharts/pie.js"></script>
        <script type="text/javascript" src="/assets/global/plugins/amcharts/amcharts/serial.js"></script>
        <script>
            var keepalive = 'none';
            function keepalivesession() {
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                }
                keepalive = 'keep';
                xmlhttp.open("GET", "/login/keepalive", true);
                xmlhttp.send();
                document.getElementById('sessiontime_pop').style.display = 'none';
            }
        </script>                 
        <script type="text/javascript" >
            function sessionTimeout() {
                var timeout = 4.5;
                timeout = timeout * 60 * 1000;
                setInterval(function() {
                    document.getElementById('sessiontime_pop').style.display = 'block';
                    keepalive = 'none';
                    countdown();
                }, timeout);
            }
            sessionTimeout();
        </script>
        <script type="text/javascript">
            function countdown() {
                var seconds = 30;
                var myvar = setInterval(function() {
                    if (keepalive == 'none')
                    {
                        seconds--;
                        document.getElementById('countdown2').innerHTML = seconds;
                        if (seconds < 1 && keepalive == 'none') {
                            document.getElementById('logoutlink').click();
                            clearInterval(myvar);
                            return;
                        }
                    }
                    else
                    {
                        document.getElementById('countdown2').innerHTML = '30';
                        clearInterval(myvar);
                    }

                }, 1000);
            }
        </script>      



        <?php
        if ($this->env == 'PROD') {
            include_once("inc/gatracking.php");
        }
        ?>

    </head>

    <body><a name="top"></a><a name="a">
            <!-- Header Area Start -->	

            <script>

                var NumOfRow = 1;
                var NumOftaxRow = 1;
            </script>
            <?php
            if (isset($this->js)) {
                foreach ($this->js as $js) {
                    echo '<script type="text/javascript" src="/inc/js/' . $js . '"></script>';
                }
            }
            ?>


            <link href="/css/datepicker/jquery-ui.css" rel="stylesheet"/>   
            <script type="text/javascript" src="/inc/js/datepicker.js"></script>
         <!-- <script src="/css/datepicker/external/jquery/jquery.js"></script> -->
            <script src="/css/datepicker/jquery-ui.js"></script>


            </head>

            <body>

                <!-- Header Area Start -->	
                <div class="header">
                    <div class="wrapper">
                        <div class="floatLeft logo"><a href="/"><img src="/images/logo.png" width="189" height="53" alt="Swipz" /></a></div>
                        <div class="floatRight">
                            <div class="menu">
                                <ul class="floatLeft">
                                    <li><a href="/" >Home</a></li>

                                    <li><a href="/merchant/dashboard" >Dashboard</a></li>
                                    <!--<?php if ($this->showWhygopaid == TRUE) { ?><li><a href="/payment-gateways/package" >Why go paid?</a></li><?php } ?>-->


                                </ul>
                                <ul class="floatRight menuRight">
                                    <!--      <li><a href="#" class="border greentxt">Help</a></li>  -->

                                    <li><a href="/logout"  class="Logout">Logout</a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="sessiontime_pop" style="z-index:10;" >
                    <div class="repons-close"><a   href = "javascript:void(0)" onclick = "document.getElementById('sessiontime_pop').style.display = 'none'"></a></div>
                    <div class="repons-pop" style="width:300px; height: 110px;border: 8px solid #8d9bb4;">
                        <div class="row" style="width:300px; height:30px;">Session Timeout  </div>
                        <div id="timer" style="text-align: center; line-height: 30px;">Your Session Expires in &nbsp;
                            <span id="countdown2" >30</span>  &nbsp; seconds    
                        </div>

                        <!--<div style="text-align: center; line-height: 30px;"> Your Session expires in 30 seconds </div>-->

                        <div class="row-two" style="width:300px; height: auto;">
                            <form action="" method="post">
                                <input type="hidden" value="" id="sessiontimeout"  name="sessiontimeout"/>

                                <div class="search" style="width:155px; height: auto;margin-left: 10px;"><input type="button" class="browse1"  name="restartsession"  value="Keep me logged-in" onclick="keepalivesession();" /> </div>
                                <div class="search" style="width:70px; height: auto;"><a style="height: 29px;"  href="/logout" class="browse1" id="logoutlink">Logout</a> </div>
                            </form>

                        </div>

                    </div>
                </div> 


                <script src="/js/jquery.colorbox.js"></script>
                <script>
                $(document).ready(function() {
                    //Examples of how to assign the ColorBox event to elements
                    $(".example5").colorbox({iframe: true, innerWidth: 700, innerHeight: 500});

                });
                </script>
                
                <div class="billgen"> 

    <div class="top_band"> 
        <div class="details"> 
            <div class="left"> <h1><?php echo $this->title; ?></h1></div>

            <div class="tranpopup">
                <div class="transname"><span class="arialwhit">Welcome, &nbsp;</span> <span class="arialwhitbld"><?php echo ($this->userName!='')?$this->userName : 'Guest'; ?></span></div>
                <div class="settingfld">
                    <?php if($this->userName!='') {?>
                    <div id="dd" class="wrapper-dropdown-3" tabindex="1" > <img src="/images/setting.jpg" width="19" height="18" border="0"  /></span>
                        <ul class="dropdown">
                            <div class="profilebox">
                                <div class="profile"><a   onClick="window.location = '<?php echo "/".$this->usertype; ?>/profile';"  class="navtxt">Profile</a></div>
                                 <div class="addteam"><a   onClick="window.location = '/profile/preferences';"  class="navtxt">Preferences </a></div>
                                <div class="addteam"><a   onClick="window.location = '/profile/reset';"  class="navtxt">Password reset </a></div>
                                
                                <div class="addteam"><a   onClick="window.location = '/logout';"  class="navtxt">Logout </a></div>
                            </div>
                        </ul>
                    </div>
                    <?php } ?>
                    
                    <!-- jQuery if needed -->
                  
                    <script type="text/javascript">

                                    function DropDown(el) {
                                        this.dd = el;
                                        this.placeholder = this.dd.children('span');
                                        this.opts = this.dd.find('ul.dropdown > li');
                                        this.val = '';
                                        this.index = -1;
                                        this.initEvents();
                                    }
                                    DropDown.prototype = {
                                        initEvents: function() {
                                            var obj = this;

                                            obj.dd.on('click', function(event) {
                                                $(this).toggleClass('active');
                                                return false;
                                            });

                                            obj.opts.on('click', function() {
                                                var opt = $(this);
                                                obj.val = opt.text();
                                                obj.index = opt.index();
                                                obj.placeholder.text(obj.val);
                                            });
                                        },
                                        getValue: function() {
                                            return this.val;
                                        },
                                        getIndex: function() {
                                            return this.index;
                                        }
                                    }

                                    $(function() {

                                        var dd = new DropDown($('#dd'));

                                        $(document).click(function() {
                                            // all dropdowns
                                            $('.wrapper-dropdown-3').removeClass('active');
                                        });

                                    });

                    </script>
                </div>
            </div>
        </div>
    </div>
       
    <?php
    if (isset($this->successMessage)) {
        ?> 
    <div class="gap"></div> 
    <div class="personal_details sadow" style="padding: 0 0 10px;">
<div class="suc">
<img src="/images/inf.gif" class="sucimg" /><p style="margin-left: 35px;"><?php echo $this->successMessage; ?></p>
</div>
    </div>
    <?php } ?>
    
       <?php
    if ($this->hasError()) {
        ?>  <div class="errormsg-box"> <img src="/images/erroor_msg.png" class="err-img" /> 

            <?php
            echo '<div class="right"> <ul>';
            foreach ($this->_error as $error_name) {
                ?> 
                <?php
                echo '<li style="padding-left: 15px;"><i class="icon-chevron-right"></i>' . $error_name[0] . ' -';
                $int = 1;
                while (isset($error_name[$int])) {
                    echo ' ' . $error_name[$int];
                    $int++;
                }
                echo '</li>';
            }
            ?>
            </ul></div></div>

<?php }
?>
 




