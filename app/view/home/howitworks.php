<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
    <head>
        <title>How payment gateway works | Payment gateway integration | PGYBT</title>
        <meta id="Meta Keywords" name="KEYWORDS" content="how payment gateway works, payment gateway integration"/>
        <meta id="Meta Description" name="DESCRIPTION" content="Learn more about how funds are transferred using the PGYBT billing software and payment gateway."/>
        <link rel="canonical" href="https://pgybt.in/home/howpgybtworks"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>SWIPEZ</title>
        <link rel="icon" type="image/png" href="/images/pgybtico.ico" />
        <link rel="stylesheet" type="text/css" href="/css/howitworkscombine.css"/>
        <script type="text/javascript" src="/js/abetterbrowser.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
        <script src="httpss://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function() {

                $("ul.sidenav li").hover(function() {
                    $(this).find("div").stop()
                            .animate({top: "15", opacity: 1}, "fast")
                            .css("display", "block")

                }, function() {
                    $(this).find("div").stop()
                            .animate({top: "2", opacity: 0}, "slow")
                });

            });
        </script>


        <script type="text/javascript">
            function MM_swapImgRestore() { //v3.0
                var i, x, a = document.MM_sr;
                for (i = 0; a && i < a.length && (x = a[i]) && x.oSrc; i++)
                    x.src = x.oSrc;
            }
            function MM_preloadImages() { //v3.0
                var d = document;
                if (d.images) {
                    if (!d.MM_p)
                        d.MM_p = new Array();
                    var i, j = d.MM_p.length, a = MM_preloadImages.arguments;
                    for (i = 0; i < a.length; i++)
                        if (a[i].indexOf("#") != 0) {
                            d.MM_p[j] = new Image;
                            d.MM_p[j++].src = a[i];
                        }
                }
            }

            function MM_findObj(n, d) { //v4.01
                var p, i, x;
                if (!d)
                    d = document;
                if ((p = n.indexOf("?")) > 0 && parent.frames.length) {
                    d = parent.frames[n.substring(p + 1)].document;
                    n = n.substring(0, p);
                }
                if (!(x = d[n]) && d.all)
                    x = d.all[n];
                for (i = 0; !x && i < d.forms.length; i++)
                    x = d.forms[i][n];
                for (i = 0; !x && d.layers && i < d.layers.length; i++)
                    x = MM_findObj(n, d.layers[i].document);
                if (!x && d.getElementById)
                    x = d.getElementById(n);
                return x;
            }

            function MM_swapImage() { //v3.0
                var i, j = 0, x, a = MM_swapImage.arguments;
                document.MM_sr = new Array;
                for (i = 0; i < (a.length - 2); i += 3)
                    if ((x = MM_findObj(a[i])) != null) {
                        document.MM_sr[j++] = x;
                        if (!x.oSrc)
                            x.oSrc = x.src;
                        x.src = a[i + 2];
                    }
            }
        </script>
        <script src="/js/jquery.colorbox.js"></script>
        <script>
            $(document).ready(function() {
                //Examples of how to assign the ColorBox event to elements
                $(".example5").colorbox({iframe: true, innerWidth: 700, innerHeight: 530});

            });
        </script>
        <?php if ($this->env == 'PROD') {
            include_once("inc/gatracking.php");
        } ?>

    </head>

    <body onload="MM_preloadImages('/images/business2.png', '/images/regis2.png', '/images/upload2.png', '/images/send1.png', '/images/patron2.png', '/images/stand2.png', '/images/pgybt2.png', '/images/use2.png', '/images/lnit1.png')">  <div class="header border1">
            <div class="wrapper">
                <div class="floatLeft logo"><a href="/"><img src="/images/logo.png" width="189" height="53" alt="Swipz" /></a></div>
                <div class="floatRight">
                    <div class="menu">
                        <ul class="floatLeft">
                            <li><a href="/" title="Home" >Home</a></li>
                            <li><a href="/home/howitworks" title="How it works" >How it works?</a></li>
                            <li><a href="http://support.pgybt.in">FAQs</a></li>
                        </ul>
                        <ul class="floatRight menuRight">
                            <li><a href="/home/register" title="Register" class="border greentxt">Register</a></li>
                            <li><a href="/login" title="Sign In" class="bluetxt">Sign In</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <div class="top_band"> 
            <div class="details"> 
                <div class="left"> <h1>How PGYBT works</h1>
                </div>


            </div>
        </div>


        <div class="howitworks">


            <div class="story-thumb1"> 
                <ul class="sidenav">
                    <li>  <a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image2', '', '/images/business2.png', 1)" ><img src="/images/business1.png" width="95" height="95" id="Image2"  class="business1"/></a>
                        <div class="roll-one">
                            <div class="roll_pop"> 
                                Wanting to collect payments online. Need not have a website</div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="story-thumb1"> 
                <ul class="sidenav">
                    <li>   <a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image3', '', '/images/regis2.png', 1)"><img src="/images/regis1.png" width="95" height="95" id="Image3" class="regis1" /></a>
                        <div class="roll-two">
                            <div class="roll_pop">  
                                Signs up with PGYBT & completes documentation</div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="story-thumb1"> 
                <ul class="sidenav">
                    <li>   <a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image4', '', '/images/upload2.png', 1)"><img src="/images/upload1.png" width="95" height="95" id="Image4" class="uplo1" /></a>
                        <div class="roll-two">
                            <div class="roll_pop"> Create a custom template of your bills. 

                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="story-thumb1"> 
                <ul class="sidenav">
                    <li>    <a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image5', '', '/images/send2.png', 1)"><img src="/images/send1.png" width="95" height="95" id="Image5" class="sendpay" /></a>
                        <div class="roll-two">
                            <div class="roll_pop"> 
                                Add a list of customers you want the bills mailed to</div>
                        </div>
                    </li>
                </ul>
            </div>


            <div class="story-thumb1"> 
                <ul class="sidenav">
                    <li>     <a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image6', '', '/images/patron2.png', 1)"><img src="/images/patron1.png" width="95" height="95" id="Image6" class="patron1" /></a>
                        <div class="roll-two-">
                            <div class="roll_pop"> 
                                Patron receives Pay Link On registered email ID along with notification on PGYBT dashboard
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="story-thumb1"> 
                <ul class="sidenav">
                    <li>     <a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image7', '', '/images/stand2.png', 1)"><img src="/images/stand1.png" width="95" height="95" id="Image7"class="stand1" /></a>
                        <div class="roll-three">
                            <div class="roll_pop"> 
                                Same as standard banking processes
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="story-thumb1"> 
                <ul class="sidenav">
                    <li>     <a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image8', '', '/images/pgybt2.png', 1)"><img src="/images/pgybt1.png" width="95" height="95" id="Image8" class="swip1" /></a>
                        <div class="roll-four">
                            <div class="roll_pop"> 
                                Actual transaction processing takes place
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="story-thumb1"> 
                <ul class="sidenav">
                    <li>     <a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image9', '', '/images/use1.png', 1)"><img src="/images/use2.png" width="95" height="95" id="Image9" class="uses1" /></a>
                        <div class="roll-four">
                            <div class="roll_pop"> 
                                Change to multiple Payment options</div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="story-thumb1"> 
                <ul class="sidenav">
                    <li>      <a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image10', '', '/images/lnit1.png', 1)"><img src="/images/lnit.png" width="95" height="95" id="Image10" class="lni1" /></a>
                        <div class="roll-five ">
                            <div class="roll_pop"> 
                                Payment amount and other details are pre-populated
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="footer">
            <div class="wrapper">
                <div class="footerMargin">
                    <ul class="icon" style="display:none">
                        <li><a href="#" title="Facebook" class="facebook">&nbsp;</a></li>
                        <li><a href="#" title="Twitter" class="twitter">&nbsp;</a></li>
                        <li><a href="#" title="YouTube" class="youTube">&nbsp;</a></li>
                        <li><a href="#" title="LinkedIN" class="LinkedIN">&nbsp;</a></li>
                        <li><a href="#" title="Google Plus" class="googlePlus">&nbsp;</a></li>
                    </ul>
                    <ul>
                        <li><a href="/home/privacy">Privacy Policy</a></li>
                        <li><a href="/home/returnpolicy">Cancellation &amp; Refund Policy Policy</a></li>
                        <li><a href="/home/terms">Disclaimer</a></li>
                        <li><a href="/home/aboutus">About Us</a></li>
                        <li><a href="/home/contactus">Contact Us</a></li>
                        <li><a href="/helpdesk" class="example5" style="border-right:0"> Help Desk</a></li>
                    </ul>
                    <p>Copyright 2015 PGYBT. All rights reserved.</p>
                </div>
            </div>
        </div>


