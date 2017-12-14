<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<title>PGYBT - Online Payment Services | Generate Invoices</title>
<meta id="Meta Keywords" name="KEYWORDS" content="billing software, generate invoices, payment gateway, pgybt"/>
<meta id="Meta Description" name="DESCRIPTION" content="PGYBT provides billing software facilities for small and medium businesses. With a fast, safe and user friendly online payment gateway."/>  

 <link rel="canonical" href="https://www.pgybt.in"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PGYBT</title>
<link rel="icon" type="image/png" href="/images/pgybtico.ico" />
<link rel="stylesheet" type="text/css" href="/css/homecombine.css"/>
<script type="text/javascript" src="/js/abetterbrowser.js"></script>
<script type="text/javascript" src="/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.8.2.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js"></script>
<script>
			$(document).ready(function(){
				$('body').sessionTimeoutHandler({
					warnWhenLeft: 30000
				});
			});
</script>

<script type="text/javascript" src="/js/jquery.themepunch.plugins.min.js"></script>
<script type="text/javascript" src="/js/jquery.themepunch.revolution.min.js"></script>
<link href="/css/notify.css" rel="stylesheet" type="text/css"></link>
<script type="text/javascript" src="/js/main.js"></script>
   <?php if($this->env == 'PROD'){include_once("inc/gatracking.php");} ?>
</head>
    	
<body>
    
    <a name="top"></a><a name="a">
<div id="notify">
</div>
<script>/*<![CDATA[*/var browser="";var browserVersion=0;if(/Opera[\/\s](\d+\.\d+)/.test(navigator.userAgent)){browser="Opera"}else{if(/MSIE (\d+\.\d+);/.test(navigator.userAgent)){browser="MSIE"}else{if(/Navigator[\/\s](\d+\.\d+)/.test(navigator.userAgent)){browser="Netscape"}else{if(/Chrome[\/\s](\d+\.\d+)/.test(navigator.userAgent)){browser="Chrome"}else{if(/Safari[\/\s](\d+\.\d+)/.test(navigator.userAgent)){browser="Safari";/Version[\/\s](\d+\.\d+)/.test(navigator.userAgent);browserVersion=new Number(RegExp.$1)}else{if(/Firefox[\/\s](\d+\.\d+)/.test(navigator.userAgent)){browser="Firefox"}}}}}}if(browserVersion===0){browserVersion=parseFloat(new Number(RegExp.$1))}if(browser=="MSIE"&&browserVersion<9){document.getElementById("notify").innerHTML='<div id="notification" class="notify notify-top-center" style="z-index: 10400; height:50px; left: 15%;margin-top: 37%;"><div class="alert notify-message alert-info" style="opacity: 1; margin-top: 0px; margin-bottom: 20px;background-color: #f2dede; color:#a94442;border-color:#ebccd1; "><div style="height: 50px;"><p style=" padding-top: 15px;">&nbsp;&nbsp;&nbsp; This site is best viewed in chrome, mozilla or IE 9 and above.&nbsp;&nbsp;&nbsp;&nbsp;<span onclick="hidenotification();"><i class="fa fa-close">&#xf00d;</i></span></p></div></div></div>'}function hidenotification(){document.getElementById("notification").style.display="none"}/*]]>*/</script>
<div class="header">
<div class="wrapper">
<div class="floatLeft logo"><img src="/images/logo.png" width="189" height="53" alt="Swipz" /></div>
<div class="floatRight">
<?php if ($this->isLoggedIn == TRUE) { ?>
<div class="menu">
<ul class="floatLeft">
<li><a href="<?php echo "/" . $this->usertype . '/dashboard'; ?>" >Dashboard</a></li>
<!--<?php if ($this->showWhygopaid == TRUE) { ?><li><a href="/payment-gateways/package">Why go paid?</a></li><?php } ?>-->
</ul>
<ul class="floatRight menuRight">
<li><a href="/logout" class="Logout">Logout</a></li>
</ul>
</div>
<?php } else { ?>
<div class="menu">
<ul class="floatLeft">
<li><a href="/" class="select">Home</a></li>
<li><a href="/home/howitworks">How it works?</a></li>
<li><a href="http://support.pgybt.in">FAQs</a></li>
</ul>
<ul class="floatRight menuRight">
<li><a href="/home/register" class="border greentxt">Register</a></li>
<li><a href="/login" class="bluetxt">Sign In</a></li>
</ul>
</div>
<?php } ?>
</div>
</div>
</div>
<div class="clear">&nbsp;</div>
<div class="banner">
<div class="bannercontainer banner-fullscreen" style="padding:0;margin:0 0 30px 0">
<div id="sliderlayer1332664901" class="rev_slider fullscreenbanner" style="width:100%;height:550px">
<ul>
<li data-masterspeed="900" data-transition="fade" data-slotamount="7" data-thumb="/image/data/Slider/slide1.jpg">
<img src="/images/banner1.jpg" alt="Image 0"/>
<div class="caption main_font randomrotate easeOutBack" data-x="450" data-y="145" data-speed="800" data-start="500" data-easing="easeOutBack">
</div>
<?php if ($this->isLoggedIn == FALSE) { ?>
<div class="caption contrast_font_heading sfb easeOutBack" data-x="80" data-y="280" data-speed="700" data-start="1300" data-easing="easeOutBack">
<a href="/home/register"> <img src="/images/get.png" width="141" height="37"></a>
</div>
<?php } ?>
<div class="caption sft easeOutBack" data-x="73" data-y="120" data-speed="700" data-start="1100" data-easing="easeOutBack">
<img src="/images/collect.png" width="385" height="159"/> </div>
<div class="caption contrast_font sft easeOutBack" data-x="240" data-y="83" data-speed="700" data-start="1600" data-easing="easeOutBack">
</div>
<div class="caption contrast_font_sub_heading sft easeOutBack" data-x="234" data-y="90" data-speed="700" data-start="1600" data-easing="easeOutBack">
</div>
</li>
<li data-masterspeed="900" data-transition="fade" data-slotamount="7" data-thumb="/image/data/Slider/slide1.jpg">
<div style="width:100%;margin:auto;position:absolute;z-index:9999999;height:auto">
<div style="height:auto;width:1000px;margin:auto">
<a href="society.html" class="example5"><div style="height:50px;width:60px;float:right;margin-right:300px;clear:right;margin-top:30px"></div></a>
<a href="school.html" class="example5"><div style="height:50px;width:60px;float:left;margin-left:178px;clear:right;margin-top:265px"></div></a>
</div>
</div>
<img src="/images/banner2.jpg" alt="Image 0"/>
<div class="caption main_font randomrotate easeOutBack" data-x="450" data-y="145" data-speed="800" data-start="500" data-easing="easeOutBack">
</div>
<div class="caption contrast_font_heading sfb easeOutBack" data-x="100" data-y="215" data-speed="700" data-start="1300" data-easing="easeOutBack">
<img src="/images/is2.png" width="313" height="55"/>
</div>
<div class="caption sft easeOutBack" data-x="100" data-y="140" data-speed="700" data-start="1100" data-easing="easeOutBack">
<img src="/images/is.png" width="238" height="59"/> </div>
<div class="caption contrast_font sft easeOutBack" data-x="240" data-y="83" data-speed="700" data-start="1600" data-easing="easeOutBack">
</div>
<div class="caption contrast_font_sub_heading sft easeOutBack" data-x="234" data-y="90" data-speed="700" data-start="1600" data-easing="easeOutBack">
</div>
</li>
<li data-masterspeed="900" data-transition="fade" data-slotamount="7">
<img src="/images/banner3.jpg" alt="Image 0"/>
<div class="caption contrast_font_heading sfl easeOutBack" data-x="72" data-y="45" data-speed="600" data-start="1200" data-easing="easeOutBack">
<img src="/images/benifit.png" width="337" height="304"> </div>
<div class="caption contrast_font_heading sfl easeOutBack" data-x="702" data-y="45" data-speed="600" data-start="1600" data-easing="easeOutBack">
    <img src="/images/benifit2.png"  width="371" height="255"/> </div>
</li>
</ul>
</div>
</div>
<script type="text/javascript">var tpj=jQuery;if(tpj.fn.cssOriginal!=undefined){tpj.fn.css=tpj.fn.cssOriginal}tpj("#sliderlayer1332664901").revolution({delay:10000,startheight:488,startwidth:1140,hideThumbs:0,thumbWidth:50,thumbHeight:50,thumbAmount:1,navigationType:"bullet",navigationArrows:"verticalcentered",navigationStyle:"square-old",navOffsetHorizontal:100,navOffsetVertical:10,touchenabled:"on",onHoverStop:"on",shuffle:"off",stopAtSlide:-1,stopAfterLoops:-1,hideCaptionAtLimit:0,hideAllCaptionAtLilmit:0,hideSliderAtLimit:0,fullWidth:"on",shadow:0});</script>
</div>
<div class="content" style="margin-top:-25px">
<div class="wrapper">
<h1>What is PGYBT ?</h1>
<h2>India's First Plug and Play Ecommerce Platform</h2>
<p>PGYBT is a secure, ready to use billing and payments platform. Using PGYBT, businesses with
or without their own website can manage, collect and report payments made electronically or offline. </p>
</div>
</div>
<div class="content BG_brown">
<div class="wrapper" style="margin-top:29px">
<h1 class="whitetxt">Who can use PGYBT ?</h1>
<p class="whitetxt">PGYBT was built around the premise that many businesses have little or no technology expertise at
their disposal. Any business irrespective of their size or technology infrastructure can use PGYBT to
provide e-payment facilities to their customers.Watch our videos to see how schools & societies are
already using PGYBT to their advantage.</p>
<div class="floatLeft video"><a href="school.html" class="example5"><img src="images/swipzVideo.jpg" width="462" height="264" alt="Image" border="0"/></a></div>
<div class="floatRight video"><a href="society.html" class="example5"><img src="images/swipzVideo01.jpg" width="462" height="264"alt="Image" border="0"/></a></div>
</div>
</div>
<div class="content BG_green">
<div class="wrapper">
<div class="floatLeft securePayment">
<h2 class="whitetxt">Secure Payments</h2>
<p class="whitetxt">A trusted platform is our top priority, so you and your customers can be assured of a safe
environment while transacting.</p>
</div>
<div class="floatRight"><img src="/images/paymentSecure_icon.png" width="341" height="401" alt="" /></div>
</div>
</div>
<div class="content BG_wood">
<div class="wrapper">
<div class="floatRight multiplePayment">
<h2 class="greennetxt">Multiple Payment Options</h2>
<p class="whitetxt">Offer your customers a variety of options across Credit/ Debit cards as well as Net Banking.</p>
</div>
</div>
</div>
<div class="content BG_grey">
<div class="wrapper">
<div class="floatLeft userFriendly">
<h2 class="bluetxt">Fast and User Friendly</h2>
<p>PGYBT is designed to set up fast so that you can facilitate online payments in no time. Transactions are settled within a couple of days so you get your money ASAP. You get notified the moment your customer pays so you can manage cash flow better. PGYBT makes every effort to add efficiency to your business.</p>
</div>
<div class="floatRight IMG"><img src="/images/UserFrendlyRightIcon.png" width="572" height="394" alt=""/></div>
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
<li><a  href="/home/returnpolicy">Cancellation & Refund Policy Policy</a></li>
<li><a href="/home/terms">Disclaimer</a></li>
<li><a href="/home/aboutus">About Us</a></li>
<li><a href="/home/contactus">Contact Us</a></li>
<li><a href="/helpdesk" class="example5" style="border-right:0"> Help Desk</a></li>
</ul>
<p>Copyright 2015 PGYBT. All rights reserved.</p>
</div>
</div>
</div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript">$(".ppt li:gt(0)").hide();$(".ppt li:last").addClass("last");var cur=$(".ppt li:first");function animate(){cur.fadeOut(1000);if(cur.attr("class")=="last"){cur=$(".ppt li:first")}else{cur=cur.next()}cur.fadeIn(1000)}$(function(){setInterval("animate()",6500)});</script>
<script src="js/1.js"></script>
<script src="js/jquery.colorbox.js"></script>
<script>$(document).ready(function(){$(".example5").colorbox({iframe:true,innerWidth:655,innerHeight:530})});</script>
<a href="#0" class="cd-top">Top</a>
<script src="/js/main.js"></script>
</body>
</html>