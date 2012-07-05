<?php
ob_start();
session_start();

require("config.inc.php");
require("class/Database.class.php");
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();
header("Content-Type: text/html; charset=iso-8859-1");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta http-equiv="imagestoolbar" content="no" />
	<title>Welcome to Jumblr</title>
	<link href="css/getdeals_style.css" rel="stylesheet" type="text/css" />


	<!--<link href="css/base.css" rel="stylesheet" type="text/css" />-->

	<link href="css/nav.css" rel="stylesheet" type="text/css" />
     <script type="text/javascript" src="js/city.js"></script>



		<script type="text/javascript" src="js/jquery.js"></script>

		<script type="text/javascript" src="js/jquery.dd.js"></script>
		<script type="text/javascript" src="js/jquery.bxSlider.js"></script>
		 <script src="js/overlib.js"></script>

		<link rel="stylesheet" type="text/css" href="css/dd.css" />
		<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>

		--><!--<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css"/>-->
	<script type="text/javascript">

/*	$(function(){
	  $('#mainDealBox').bxSlider({
		mode: 'fade',
		captions: true,
		auto: true,
		controls: false
	  });
	}); */



	</script>


<!-- Fancy box script start -->

<!--	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>-->

	<script type="text/javascript" src="js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />


<script type="text/javascript">
		$(document).ready(function() {

			/*
			*   Examples - various
			*/

			$("#various1").fancybox({
				'titlePosition'		: 'inside',
				'speedIn':      300,
			    'speedOut':     300,
			    'transitionIn': 'elastic',
			    'transitionOut': 'elastic',
			    'easingIn':     'swing',
			    'easingOut':    'swing',
			    'hideOnOverlayClick' : false
			});
			$("#various2").fancybox({
				'titlePosition'		: 'inside',
				'speedIn':      300,
			    'speedOut':     300,
			    'transitionIn': 'elastic',
			    'transitionOut': 'elastic',
			    'easingIn':     'swing',
			    'easingOut':    'swing',
			    'hideOnOverlayClick' : false
			});
			$("#gift").fancybox({
			//alert("dsfdsfdsf");
				'titlePosition'		: 'inside',
				'transitionIn'		: 'fade',
				'transitionOut'		: 'fade'
			});

			$("#various3").fancybox({
				'width'				: '75%',
				'height'			: '75%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe'
			});

			$("#various4").fancybox({
				'padding':          0,
			    'cyclic':       true,
			    'width':        625,
			    'height':       350,
			    'padding':      0,
			    'margin':      0,
			    'speedIn':      300,
			    'speedOut':     300,
			    'transitionIn': 'elastic',
			    'transitionOut': 'elastic',
			    'easingIn':     'swing',
			    'easingOut':    'swing',
			    'scrolling' : 'no',
	            'hideOnContentClick' : true,
	            'onCleanup' : gohome,
			    'titleShow' : false,
			    'hideOnOverlayClick' : false

			});
		});
	</script>

	<script type="text/javascript">
		function recomEmailGet() {
    	 $(document).ready(function() {
	    	   $("#various1").fancybox({
					'titlePosition'		: 'inside',
					'transitionIn'		: 'none',
					'transitionOut'		: 'none',
					'hideOnOverlayClick' : false
				}).trigger('click');
	       });
    	 }
	   </script>

<!-- Fancy box script end -->


    <!-- <script type="text/javascript" src="js/form.js"></script> -->

	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
  	 <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>  -->
  	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>


</head>

<body <?php if ($_GET['recommend'] == "import") { echo 'onload="recomEmailGet();"';}?> <?php if (!isset($_COOKIE["subscribe"])) echo 'onload="ShowLightBox(\'email-form\'); return false;"' ?>  >


<script src="http://connect.facebook.net/en_US/all.js"></script>
<div id="fb-root"></div>
<script type="text/javascript">
		FB.init
		(
			{
				appId: '192309027517422',
				status: true,
				cookie: true, xfbml: true
			}
		);

		FB.Event.subscribe('auth.login', function(response)
		{
			window.location.reload();
		});
</script>
<?php
			function get_facebook_cookie($app_id, $app_secret)
			{
			$args = array();
			parse_str(trim($_COOKIE['fbs_' . $app_id], '\\"'), $args);
			ksort($args);
			$payload = '';
			foreach ($args as $key => $value)
			{
				if ($key != 'sig')
				{
					$payload .= $key . '=' . $value;
				}
			}

			if (md5($payload . $app_secret) != $args['sig'])
			{
				return null;
			}

			return $args;
			}

?>

<!--start maincontainer-->
<!--start head-->
<?php

	$city = end(explode('|', $_COOKIE['subscribe']));
	$sql_show_city = "SELECT * FROM ".TABLE_CITIES." WHERE city_id = $city";
	$show_city = mysql_fetch_array(mysql_query($sql_show_city));

	if ($_GET['city'] != "") {
		header('location:'.SITE_URL.'city_cookie.php?city='.$_GET['city'] );

	}
?>

<?php

	$country = 225;

	$sql_city = "SELECT * FROM ".TABLE_CITIES."  WHERE country_id = $country GROUP BY city_name ASC";
	$result_city = mysql_query($sql_city);
?>
<div id="locations" class="locations" style="display: none;">
 	<div id="citySelectBox" style=" ">


 		<ul style="margin: 0 0 0 0px;" id="jCitiesSelectBox">

				<?php
					$c = 0;
					while($row_city = mysql_fetch_array($result_city)) {
						$c++;
				?>
					<li <?php //if ($c == 5) { echo 'style="border-right: none;"'; } ?>>
						<span>
							<a href="<?php echo SITE_URL."?city=".$row_city["city_id"]; ?>"> <?php echo $row_city["city_name"]; ?> </a>
						</span>
					</li>
				<?php } ?>

	    </ul>

	  <!-- 		<li><span>Aberdeen</span></li>
	            <li><span>Bath</span></li>
	            <li><span>Belfast</span></li>
	            <li><span>Birmingham</span></li>
	            <li><span>Blackpool</span></li>
				<li style="border-right: none;"><span>Aberdeen</span></li>

				<li><span>Aberdeen</span></li>
	            <li><span>Bath</span></li>
	            <li><span>Belfast</span></li>
	            <li><span>Birmingham</span></li>
	            <li><span>Blackpool</span></li>
				<li style="border-right: none;"><span>Aberdeen</span></li>

				<li><span>Aberdeen</span></li>
	            <li><span>Bath</span></li>
	            <li><span>Belfast</span></li>
	            <li><span>Birmingham</span></li>
	            <li><span>Blackpool</span></li>
				<li style="border-right: none;"><span>Aberdeen</span></li>

				<li><span>Aberdeen</span></li>
	            <li><span>Bath</span></li>
	            <li><span>Belfast</span></li>
	            <li><span>Birmingham</span></li>
	            <li><span>Blackpool</span></li>
				<li style="border-right: none;"><span>Aberdeen</span></li> -->


  </div>
	  <div class="clear"></div>
	  <div class="natioanl_D"><a href="<?php echo SITE_URL."national_deals.php?nd=National deals"; ?>">National deals</a></div>
</div>
<div id="maindiv">

<div class="main_box" style="width:960px; margin:0 auto 0 auto; padding:30px 0 0 0; height:80px;">
    <span class="float_left" style="margin:-12px 0 0 0;"><a href="<?php echo SITE_URL; ?>"><img src="images/logo_email2.png" alt="" /></a> </span>
    <span class="float_right"><a href="<?php echo SITE_URL; ?>merchant.php" class="apply_arrow1" style="margin-top:-2px;"></a></span>
    <span class="float_right" style="font:normal 16px/40px Arial, Helvetica, sans-serif; margin-right:8px; color:#ffc90e;">Do you want to elevate your business?</span>
 <div class="clear"></div>
</div>


<div class="clear"></div>

<?php if ($_GET['action'] != "") { ?>
<div class="register_Main">
<div style="float:left; width:9px; height:49px; margin:0 0 0 -5px;"><img src="images/g_left.png" alt="" width="9" height="49" border="0"/></div>
<div style="width: 928px;" class="register_bg">
<ul>
<li><a href="#"><img src="images/late_btn.png" alt="" width="159" height="39" border="0"/></a></li>
<!--<li><a href="#"><img src="images/finished.png" alt="" width="131" height="32" border="0"/></a></li>-->
<li style="font-size: 12px; color:#000; font-weight: bold; font-family:"Times New Roman", Times, serif;">Sign up to our daily deals and you will never miss another deal again.</li>
<!--<li style="font-size: 11px; color:#000; line-height:42px;"><img src="images/signuptext.gif" alt="" width="363" height="17" border="0"/></li>-->
<li><input style="width: 220px; font-size: 12px; color:#ccc; font-weight: bold; font-family:"Times New Roman", Times, serif;" type="text" name="textfield2" class="white_box_ani" value="Enter your email address here" onclick="this.value= ''"/></li>
<li><input type="submit" name="Submit" class="Sign_up" value="Register"/></li>
</ul>
</div>
<div style="float:left; width:9px; height:49px; margin:0 0 0 0;"><img src="images/g_right.png" alt="" width="9" height="49" border="0"/></div>
</div>
<?php } ?>

<?php if ($_GET['bye'] != "") { ?>
<div class="register_Main">
<div style="float:left; width:9px; height:49px; margin:0 0 0 -5px;"><img src="images/g_left.png" alt="" width="9" height="49" border="0"/></div>
<div class="register_bg">
<h6 style="font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; padding: 10px; color: #333333; font-size: 14px;">
<span  id="close"><img src="images/closed.gif" width="15" height="13" align="right" style=" margin:0 -10px 0 0;" border="0"/></span>
<?php echo $_GET['bye']; ?>
</h6>
</div>
<div style="float:left; width:9px; height:49px; margin:0 0 0 0;"><img src="images/g_right.png" alt="" width="9" height="49" border="0"/></div>
</div>
<?php } ?>

<?php if ($_GET['prs'] != "") { ?>
<div class="register_Main">
<div style="float:left; width:9px; height:49px; margin:0 0 0 -5px;"><img src="images/g_left.png" alt="" width="9" height="49" border="0"/></div>
<div class="register_bg">
<h6 style="font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; padding: 10px; color: #333333; font-size: 14px;">
<span  id="close"><img src="images/closed.gif" width="15" height="13" align="right" style=" margin:0 -10px 0 0;" border="0"/></span>
<?php echo $_GET['prs']; ?>
</h6>
</div>
<div style="float:left; width:9px; height:49px; margin:0 0 0 0;"><img src="images/g_right.png" alt="" width="9" height="49" border="0"/></div>
</div>

<!--<div class="prsBox_main">
<div class="prsBox">
<div class="prs_top">&nbsp;</div>
<div class="prs_mid">
<h6 style="font-family: Arial; font-weight: bold; padding: 10px; color: #333333; font-size: 24px; line-height:16px;">
<?php echo $_GET['prs']; ?>
</h6>
</div>
<div class="prs_bottom"></div>
</div>
</div>-->
<?php } ?>

<div id="container">

<?php
	$base = basename($_SERVER['REQUEST_URI']);
	$page = explode("?city", $base);
	$page = $page[0];



if ($page == "index.php") { ?>
<div id="subscribe" class="register_bg" style="height:14px; width: 680px; padding: 10px; font-family: Helvetica; font-size: 10.5px; color: gray;" >

You have been subscribed to receive daily deals alert.
<span id="subscribe_close" style="float: right; margin-right: 10px; height:auto; width: 30px; cursor: pointer">Close</span>

</div>
<?php } ?>

<?php if ($_GET['acsucc']) { ?>
<div id="subscribe" class="register_bg" style="height:14px; width: 680px; padding: 10px; font-family: Helvetica; font-size: 10.5px; color: gray;" >

<?php echo $_GET['acsucc'];

?>
<span id="subscribe_close" style="float: right; margin-right: 10px; height:auto; width: 30px; cursor: pointer">Close</span>

</div>
<?php
	}
?>

<script>
$("div#click").click(function () {
$("div#locations").slideToggle(300);
});

$(document).ready(function(){
$("div#locations").ready(function() {
	$("div#locations").hide(0);
});
});
</script>

<script>
$("span#subscribe_close").click(function() {
	$("div#subscribe").slideUp(300);

});
</script>

<script>
$("span#close").click(function() {
	$("div.register_Main").slideUp(300);

});
</script>

<script type="text/javascript" >
/* $(document).ready(function(){
  setTimeout(function(){
  $("div#subscribe").fadeOut("slow", function () {
  $("div#subscribe").remove();
      }); }, 5000);
 }); */
</script>

<script type="text/javascript">
$("span#myacc").click(function () {

	$("div#menu").slideToggle("fast");			// slideToggle() / toggle()
});

$("div#menu").ready(function() {
	$("div#menu").hide();
});



/*$("span#myacc").mouseenter(function () {
	$("div#menu").slideDown("slow");			// slideToggle() / toggle()
}).mouseleave(function () {
	$("div#menu").slideUp("slow");
	$("div#menu").hide();		// slideToggle() / toggle()
});

$("div#menu").ready(function() {
	$("div#menu").hide();

});*/
</script>

<script type="text/javascript">
			var curr_lb_div;
			var is_modal = false;
			function ShowLightBox(lb_div, isModal)

			{
				document.getElementById(lb_div).style.display='block';
				document.getElementById('fade').style.display='block';
				curr_lb_div = lb_div;

				if (isModal)
					is_modal = true;
				else is_modal = false;
			}
			function HideLightBox()
			{
				if (document.getElementById(curr_lb_div))

				{
					document.getElementById(curr_lb_div).style.display='none';
					document.getElementById('fade').style.display='none';
					curr_lb_div = '';
				}
			}
</script>
<div id="leftcol">
<div class="deal_info">
		<!--end head-->
