<?php
ob_start();
session_start();
date_default_timezone_set('Europe/London');
require("config.inc.php");
require("class/Database.class.php");
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();
header("Content-Type: text/html; charset=iso-8859-1");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta property="og:title" content="title" />
	<meta property="og:description" content="description" />
	<meta property="og:image" content="thumbnail_image" />
	<meta name="medium" content="image" />

	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta http-equiv="imagestoolbar" content="no" />
	<title>Welcome to GeeLaza</title>
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
$j = jQuery.noConflict();

			$j(document).ready(function() {

			/*
			*   Examples - various
			*/

			$j("#various1").fancybox({
				'titlePosition'		: 'inside',
				'speedIn':      300,
			    'speedOut':     300,
			    'transitionIn': 'elastic',
			    'transitionOut': 'elastic',
			    'easingIn':     'swing',
			    'easingOut':    'swing',
			    'hideOnOverlayClick' : false
			});
			$j("#invite").fancybox({
				'titlePosition'		: 'inside',
				'speedIn':      300,
			    'speedOut':     300,
			    'transitionIn': 'elastic',
			    'transitionOut': 'elastic',
			    'easingIn':     'swing',
			    'easingOut':    'swing',
			    'hideOnOverlayClick' : false
			});
			$j("#various2").fancybox({
				'titlePosition'		: 'inside',
				'speedIn':      300,
			    'speedOut':     300,
			    'transitionIn': 'elastic',
			    'transitionOut': 'elastic',
			    'easingIn':     'swing',
			    'easingOut':    'swing',
			    'hideOnOverlayClick' : false
			});
			$j("#various3").fancybox({
				'titlePosition'		: 'inside',
				'speedIn':      300,
			    'speedOut':     300,
			    'transitionIn': 'elastic',
			    'transitionOut': 'elastic',
			    'easingIn':     'swing',
			    'easingOut':    'swing',
			    'hideOnOverlayClick' : false
			});
			$j("#gift").fancybox({
			//alert("dsfdsfdsf");
				'titlePosition'		: 'inside',
				'transitionIn'		: 'fade',
				'transitionOut'		: 'fade'
			});

			$j("#contact").fancybox({
				//alert("dsfdsfdsf");
					'titlePosition'		: 'inside',
					'transitionIn'		: 'fade',
					'transitionOut'		: 'fade'
				});

			$j("#various4").fancybox({
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
			    'autoDimensions': 'true',
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
	$q = jQuery.noConflict();

	function recomEmailGet() {
		$q(document).ready(function() {
			$q("#various1").fancybox({
					'titlePosition'		: 'inside',
					'transitionIn'		: 'none',
					'transitionOut'		: 'none',
					'hideOnOverlayClick' : false
				}).trigger('click');
	       });
    	 }

	function NewsSucc() {
		$q(document).ready(function() {
					$q("#various3").fancybox({
							'titlePosition'		: 'inside',
							'transitionIn'		: 'none',
							'autoDimensions': 'true',
							'transitionOut'		: 'none',
							'hideOnOverlayClick' : false
						}).trigger('click');
			       });
	}
	   </script>

<!-- Fancy box script end -->


    <!-- <script type="text/javascript" src="js/form.js"></script> -->

	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
  	 <!-- --><script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
  	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>


</head>

<body <?php if ($_GET['recommend'] == "import") { echo 'onload="recomEmailGet();"';}?> <?php if ($_GET['newssucc']) { echo 'onload="NewsSucc();"';}?> <?php if (!isset($_COOKIE["subscribe"])) echo 'onload="ShowLightBox(\'email-form\'); return false;"' ?>  >


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
		header('location:'.SITE_URL.'city_cookie.php?city='.$_GET['city'].'&newssucc='.$_SESSION['newssucc'] );

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
<div class="header_main">
<div id="header">

	<div class="header_left"><a href="<?= SITE_URL ?>"><img src="images/logo.gif" alt="" width="171" height="107" border="0"/></a></div>

				<div class="city">Select your city:<br/>
				<!--<select name="websites2" id="websites1" style="width:177px;" class="styled" tabindex="1">
				<option name="one" value="msDropDown1" selected="selected" class="img_none"> <?php echo strtoupper($row_city_1["city_name"]); ?> </option>
				<?php
					/*while($row_city = mysql_fetch_array($result_city))
					{*/
						?>
						<option  name="two" value="PrototypeCombobox1"  class="img_none"> <?php echo $show_city['city_name']; ?> </option>
						<?php
					/*}*/
				?>
				</select>
				-->

				<?php
					$base = basename($_SERVER['REQUEST_URI']);
					$ndpage = explode("?", $base);
					$ndpage = $ndpage[0];
				?>

				<div class="select" id="click"><?php if ($_GET['nd'] || $ndpage == 'national_deals.php') {echo 'NATIONAL DEALS';} else {echo strtoupper($show_city["city_name"]);} ?><div style="float: right; margin:0 0 0 20px; width:39px; height:38px;"><img src="images/drop_r.png" alt="" width="39" height="38" border="0"/></div></div>
				</div>

				<div class="header_right">
				<div class="registration">
				<span style="display:inline-block; padding-left:8px;line-height:21px;">Receive amazing deals by email<br /></span>
				<div class="txt_box">

				<?php


				if ($_POST['email_subs_btn'] && $_POST['email_subs_btn'] == "SUBSCRIBE") {
						$subs_email = $_POST['email_subs'];
						$date = date("Y-m-d");

						if (!empty($_GET['nd'])) {
							$buttonlink = SITE_URL.'national_deals.php?nd=National%20deals';
						}
						else {
							$buttonlink = SITE_URL.'index.php?city='.$city;
						}

					$subscribe_sql = "INSERT INTO ".TABLE_NEWSLETTER." (ns_id, email, city, status, date_added) VALUES (NULL, '$subs_email', '$city', 1, '$date')";
					mysql_query($subscribe_sql);

			// News letter subscription email starts

					$deal_sql = "SELECT * FROM ".TABLE_DEALS." WHERE status >= 1 AND deal_end_time LIKE '".date("Y-m-d")."%' AND city = $city  LIMIT 0, 1";
					//$deal_sql = "SELECT * FROM ".TABLE_DEALS." WHERE status >= 1 AND deal_end_time LIKE '".date("Y-m-d")."%' LIMIT 0, 1";
					$deal_sql_details = mysql_fetch_array(mysql_query($deal_sql));

					$sql_deal_image = "SELECT * FROM ".TABLE_DEAL_IMAGES." WHERE deal_id = ".$deal_sql_details['deal_id'];
					$deal_image = mysql_fetch_array(mysql_query($sql_deal_image));

				//	echo $deal_image['file'];

					//var_dump($deal_sql_details);

				$imagePath = SITE_URL."images/newsletter_succ_images/";

				$template = '


				<tr>
					<td>
					<table border="0" cellspacing="0" cellpadding="0" width="616" style="vertical-align:top; width:616px; margin:0 auto 0 auto;">
					<tr>
    <td valign="top" height="83" background="'.$imagePath.'box1_top.png" style=" background-repeat: no-repeat;">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="50"><img src="'.$imagePath.'spacer.gif" alt="" width="1" height="50" /></td>
        </tr>
        <tr>
          <td><p style="text-align:right; height:10px; font-family: Arial, Helvetica, sans-serif; font-size:10px; line-height:10px; padding:0; margin:0; width:600px;">14/03/2012</p></td>
        </tr>
      </table>    </td>
  </tr>
								   <tr>
								   <td style="vertical-align:text-top; margin:0;">
								   <table style="border: solid 2px #70a200; border-bottom: none;" width="100%" border="0" cellspacing="0" cellpadding="0">
								   <tr>
									<td valign="top" bgcolor="#fff" align="center">
									<table width="580" border="0" cellspacing="0" cellpadding="0" style="width:580px; margin:0 auto;">
									  <tr>
										<td style="vertical-align:top; color:#353535; font-family:Arial, Helvetica, sans-serif; line-height:15px; font-size:14px; padding:10px 0 10px 0;">Thanks for signing up to receive incredible discount deals straight to your email address.</td>
									  </tr>
									  <tr>
										<td style="vertical-align:top; color:#353535; font-family:Arial, Helvetica, sans-serif; line-height:15px; font-size:14px; padding:10px 0 10px 0;">Right now we’re in the process of expanding to cover the whole country so if your area doesn’t get a deal immediately don’t worry, we’ll have deals there soon.</td>
									  </tr>
									  <tr>
										<td style="vertical-align:top; color:#353535; font-family:Arial, Helvetica, sans-serif; line-height:15px; font-size:14px; padding:10px 0 20px 0;">Check your inbox each day to discover GeeLaza deals with huge discounts on restaurants, relaxing spa days, cinemas, gyms, events and more.</td>
									  </tr>
									  <tr>
										<td align="center" valign="top" style="text-align:center;"><a href="'.$buttonlink.'"><img src="'.$imagePath.'check_out.png" width="266" height="42" alt="" border="0"/></a></td>
									  </tr>
									  <tr>
										<td align="center" valign="top" style="text-align:center;"><img src="'.$imagePath.'shade.png" width="583" height="46" alt="" /></td>
									  </tr>
									  <tr>
									   <td align="left" valign="top">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
										  <tr>
											<td width="185" valign="top">
											<table width="100%" border="0" cellspacing="0" cellpadding="0">
											  <tr>
												<td><img src="'.$imagePath.'img_01.png" width="185" height="111" alt="" style="border:1px solid #c4c4c4;"/></td>
											  </tr>
											  <tr>
												<td style="vertical-align:top; font-weight:bold; color:#333; font-family:Arial, Helvetica, sans-serif; line-height:15px; font-size:14px; padding:5px 0 0 0;">Big Discounts Everyday</td>
											  </tr>
											  <tr>
												<td style="vertical-align:top; color:#353535; font-family:Arial, Helvetica, sans-serif; line-height:17px; font-size:14px; padding:5px 0 10px 0;">Enjoy big discounts on big brands everyday. We always provide you with Top Quality deals daily.</td>
											  </tr>
											</table>            </td>
											<td width="12"><img src="'.$imagePath.'spacer.gif" width="12" height="1" alt="" /></td>
											<td width="185" valign="top">
											<table width="100%" border="0" cellspacing="0" cellpadding="0">
											  <tr>
												<td><img src="'.$imagePath.'img_02.png" width="185" height="111" alt="" style="border:1px solid #c4c4c4;"/></td>
											  </tr>
											  <tr>
												<td style="vertical-align:top; font-weight:bold; color:#333; font-family:Arial, Helvetica, sans-serif; line-height:15px; font-size:14px; padding:5px 0 0 0;">The GeeLaza Promise</td>
											  </tr>
											  <tr>
												<td style="vertical-align:top; color:#353535; font-family:Arial, Helvetica, sans-serif; line-height:17px; font-size:14px; padding:5px 0 10px 0;">If the experience using our service is ever bad then we’ll make it right or give you full refund.</td>
											  </tr>
											</table>            </td>
											<td width="12"><img src="'.$imagePath.'spacer.gif" width="12" height="1" alt="" /></td>
											<td width="185" valign="top">
											<table width="100%" border="0" cellspacing="0" cellpadding="0">
											  <tr>
												<td><img src="'.$imagePath.'img_03.png" width="185" height="111" alt="" style="border:1px solid #c4c4c4;"/></td>
											  </tr>
											  <tr>
												<td style="vertical-align:top; font-weight:bold; color:#333; font-family:Arial, Helvetica, sans-serif; line-height:15px; font-size:14px; padding:5px 0 0 0;">Find us on Facebook</td>
											  </tr>
											  <tr>
												<td style="vertical-align:top; color:#353535; font-family:Arial, Helvetica, sans-serif; line-height:17px; font-size:14px; padding:5px 0 10px 0;">Be our friend on Facebook and be the first to hear about our great deals in your city.</td>
											  </tr>
											</table>            </td>
										  </tr>
										</table>        </td>
									  </tr>

									   <tr>
										<td>&nbsp;</td>
									  </tr>
									</table>
									</td>
									</tr>
									<tr>
									  <td align="center" valign="top" style="text-align:center;"><img src="'.$imagePath.'shade2.png" width="616" height="22" alt="" /></td>
								   </tr>
								  <tr>
									<td bgcolor="#FFFFFF" align="center" style="vertical-align:top; color:#353535; text-align:center; font-family:Arial, Helvetica, sans-serif; line-height:15px; font-size:14px; padding:10px 0 10px 0;">Ready to see what it’s all about? Click here to check out <a href="'.SITE_URL.'index.php?city='.$city.'" style="color:#00a2e8; text-decoration:none;">today’s daily deals!</a></td>
								  </tr>
								   <tr>
									  <td align="center" valign="top" style="text-align:center;"><img src="'.$imagePath.'shade2.png" width="616" height="22" alt="" /></td>
								   </tr>
								   <tr>
									<td bgcolor="#FFFFFF" align="left" style="vertical-align:top; color:#353535; text-align:left; font-family:Arial, Helvetica, sans-serif; line-height:15px; font-size:14px; padding:10px 0 20px 15px;">
										<b>Thanks<br />
										The GeeLaza Team<br />
									   <a href="#"  style="color:#00a2e8; text-decoration:none;">www.GeeLaza.com</a>   </b></td>
								  </tr>
								   </table>
								   </td>
								   </tr>
								   
								   <tr>
    <td valign="top" height="62" background="'.$imagePath.'box1_bottom.png" style="text-align:center; font-size:12px; color:#333231; font-family:Verdana, Arial, Helvetica, sans-serif;">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="'.$imagePath.'spacer.gif" alt="" width="1" height="15" /></td>
        </tr>
        <tr>
          <td><p style="text-align:center;">Do You Need Help? Feel Free to <a href="'.SITE_URL.'page.php?page=Contact us" style="color:#00a2e8; text-decoration: none;">Contact Geelaza</a></p></td>
        </tr>
      </table></td>
  </tr>
  
								  
								  <tr>
									<td valign="top" height="5" style="height:5px; line-height:0px;"><img src="'.$imagePath.'spacer.gif" width="1" height="5" alt="" /></td>
								  </tr>
								  <tr>
									<td valign="top" height="70" background="'.$imagePath.'footer_bg.png" style="line-height:15px; background-repeat: no-repeat; text-align:left; padding:15px 0 15px 12px;font-size:11px;color:#333231; font-family:Verdana, Arial, Helvetica, sans-serif;">You are receiving this email because you signed up for the Daily GeeLaza alerts. If you prefer not to receive the daily GeeLaza email, you can always <a href="'.SITE_URL.'unsubscribe_newsletter.php?unsub_email='.$subs_email.'" style="color:#2d92ba;">unsubscribe</a> with one click. Be sure to add us to your address book or safe sender list so our emails get to your inbox <a href="'.SITE_URL.'white_list.php" style="color:#2d92ba;">Learn how</a> </td>
								  </tr>
								</table>
					</td>
				  </tr>



				';


				/** Old Newsletter Template
				 *
				 * $template = '<table border="0" cellspacing="0" cellpadding="0" width="620" style="vertical-align:top; width:620px; margin:0 auto;">
				  <tr>
				    <td background="'.$imagePath.'box1_top.png"><img src="'.$imagePath.'spacer.gif" width="620" height="10" alt="" /></td>
				  </tr>
				   <tr>
				    <td valign="top" align="left" background="'.$imagePath.'bg_p.gif">
				     <table width="100%" border="0" cellspacing="0" cellpadding="0">
				      <tr>
				        <td valign="top" align="left">
				        	<table border="0" cellspacing="0" cellpadding="0" width="620" style="vertical-align:top; width:620px;">
				          <tr>
				            <td width="10" valign="top" style="vertical-align:top; width:10px;"><img src="'.$imagePath.'spacer.gif" width="10" height="1" alt="" /></td>
				            <td width="171" height="76" align="left" valign="top" style="vertical-align:top; text-align:left; width:171px; height:76px; line-height:0px;">
				            	<img src="'.$imagePath.'logo.png" width="164" height="72" alt="" />
				            </td>
							<td width="350" valign="top" style="vertical-align: middle; text-align: center; width:350px; color:#fff; font-family:Times New Roman, Arial, Helvetica, sans-serif; line-height:26px; font-size:40px; font-weight:normal; padding:12px 10px 0 6px;">Welcome to GeeLaza</td>
				          </tr>
				      </table>
				        </td>
				      </tr>
				      <tr>
				         <td height="15" valign="top" style="vertical-align:top; height:15px; line-height:0px;"><img src="'.$imagePath.'spacer.gif" width="1" height="15" alt="" /></td>
				     </tr>
				      <tr>
				         <td height="15" valign="top" style="vertical-align:top; height:15px; line-height:0px;"><img src="'.$imagePath.'box2_top.png" width="620" height="15" alt="" /></td>
				     </tr>
				      <tr>
				        <td valign="top" background="'.$imagePath.'box2_middle.png"><table width="620" border="0" align="center" cellpadding="0" cellspacing="0">
				          <tr>
				            <td><table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
				              <tr>
				                <td valign="top" style="color:#14131b; font-family:Arial, Helvetica, sans-serif; line-height:20px; font-size:13px; font-weight:normal; padding:0 0 0 6px;"><p>Thanks for subscribing to GeeLaza to receive incredible discount deals straight to your inbox.</p>
				                    <p>Here\'s todays deal for your city.</p>
				                  <p>Right now we\'re in the process of expanding to cover the whole country so if your area<br />
				                    doesn\'t get deal immediately don\'t worry, we\'ll have deals there soon.</p>
				                  <p>Please add <a href="#">deals@geelaza.com</a> to your address book or safe sender list so our emails get to your inbox</p>
				                  <p>We hope you enjoy your daily deals.</p>
				                  <p>The GeeLaza Team, </p></td>
				              </tr>
				              <tr>
				                <td valign="top" style="color:#14131b; font-family:Arial, Helvetica, sans-serif; line-height:26px; font-size:15px; font-weight:normal; padding:0 0 0 6px;">&nbsp;</td>
				              </tr>
				              <tr>
				                <td height="8"><img src="'.$imagePath.'spacer.gif" alt="" width="1" height="8" /></td>
				              </tr>
				              <tr>
				                <td style="background: #ddedcc; color:#14131b; font-family: Arial, Helvetica, sans-serif; line-height:26px; font-size:12px; font-weight:bold;  padding:0 8px;">Today\'s Deal in '.$show_city['city_name'].'</td>
				              </tr>
				              <tr>
				                <td valign="top">&nbsp;</td>
				              </tr>
				              <tr>
				                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
				                    <tr>
				                      <td width="10" valign="top"><img src="'.$imagePath.'spacer.gif" alt="" width="10" height="1" /></td>
				                      <td width="231" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
				                          <tr>
				                            <td height="90" valign="top" background="'.$imagePath.'price_bg.png"><table width="100%" border="0" cellspacing="0" cellpadding="0">
				                                <tr>
				                                  <td valign="top" align="center" style="padding:8px 0 10px 15px; color:#00cb46; font-family:Arial, Helvetica, sans-serif; line-height:24px; font-size:26px; font-weight: bold; text-align:center;">&pound;'.$deal_sql_details['discounted_price'].'</td>
				                                </tr>
				                                <tr>
				                                  <td valign="top" align="center" style="padding:8px 0 10px 15px; color:#fff; font-family:Arial, Helvetica, sans-serif; line-height:24px; font-size:24px; font-weight:bold; text-align:center;"><a href="'.SITE_URL.'index.php?action=view&id='.$deal_sql_details['deal_id'].'" style="color:#fff;">View Now !</a></td>
				                                </tr>
				                            </table></td>
				                          </tr>
				                          <tr>
				                            <td height="5"><img src="'.$imagePath.'spacer.gif" alt="" width="1" height="5" /></td>
				                          </tr>
				                          <tr>
				                            <td valign="top" height="67" background="'.$imagePath.'timer_bg.png"><table width="100%" border="0" cellspacing="0" cellpadding="0">
				                                <tr>
				                                  <td valign="top" align="center" width="76" style="padding:8px 0 5px 0; color:#000; font-family:Arial, Helvetica, sans-serif; line-height:24px; font-size:12px; font-weight:bold; text-align:center;">Value</td>
				                                  <td valign="top" align="center" width="75" style="padding:8px 0 5px 2px; color:#000; font-family:Arial, Helvetica, sans-serif; line-height:24px; font-size:12px; font-weight:bold; text-align:center;">Discount</td>
				                                  <td valign="top" align="center" width="78" style="padding:8px 4px 5px 0; color:#000; font-family:Arial, Helvetica, sans-serif; line-height:24px; font-size:12px; font-weight:bold; text-align:center;">Your Save</td>
				                                </tr>
				                                <tr>
				                                  <td valign="top" align="center" style="padding:0 0 0 0; color:#000; font-family:Arial, Helvetica, sans-serif; line-height:16px; font-size:16px; font-weight:bold; text-align:center;">&pound;'.strip_tags($deal_sql_details['full_price']).'</td>
				                                  <td valign="top" align="center" style="padding:0 0 0 2px; color:#000; font-family:Arial, Helvetica, sans-serif; line-height:16px; font-size:16px; font-weight:bold; text-align:center;">'.intval($deal_sql_details['discounted_price']*100/$deal_sql_details['full_price']).'%</td>
				                                  <td valign="top" align="center" style="padding:0 4px 0 0; color:#000; font-family:Arial, Helvetica, sans-serif; line-height:16px; font-size:16px; font-weight:bold; text-align:center;">&pound;'.strip_tags($deal_sql_details['full_price'] - $deal_sql_details['discounted_price']).'</td>
				                                </tr>
				                            </table></td>
				                          </tr>
				                          <tr>
				                            <td height="5"><img src="'.$imagePath.'spacer.gif" alt="" width="1" height="5" /></td>
				                          </tr>
				                      </table></td>
				                      <td width="42" valign="top"><img src="'.$imagePath.'spacer.gif" alt="" width="8" height="1" /></td>
				                      <td width="305" valign="top"><img src="'.UPLOAD_PATH.$deal_image['file'].'" alt="" width="288" height="189" vspace="8" /></td>
				                      <td width="12" valign="top"><img src="'.$imagePath.'spacer.gif" alt="" width="10" height="1" /></td>
				                    </tr>
				                </table></td>
				              </tr>
				            </table></td>
				          </tr>
				          <tr>
				            <td style="padding-top:10px 0 0 0;"><table width="608" border="0" align="center" cellpadding="0" cellspacing="0">
				              <tr>
				                <td bgcolor="#d1d1d1" style="padding:0 4px 0 10px; color:#000; font-family:Arial, Helvetica, sans-serif; line-height:16px; font-size:12px; font-weight: normal; border-top: 3px solid #000000;"><p>This message was sent by GeeLaza UK.</p>
				                  <p>You are receiving this email because you have an existing relationship with <a href="#" style="color:#2d92ba; text-decoration: none;">http://www.geelaza.com/.</a> If you no<br />
				                    longer wish to receive emails from us. you can <a href="'.SITE_URL.'unsubscribe_newsletter.php?unsub_email='.$subs_email.'" style="color:#2d92ba; text-decoration:none;">unsubscribe</a></p></td>
				              </tr>
				            </table></td>
				          </tr>
				        </table></td>
				        </tr>
				         <tr>
				         <td height="15" valign="top" style="vertical-align:top; height:15px; line-height:0px;"><img src="'.$imagePath.'box2_bottom.png" width="620" height="16" alt="" /></td>
				     </tr>
				    </table>
				    </td>
				   </tr>
				   <tr>
				    <td><img src="'.$imagePath.'box1_bottom.png" /></td>
				  </tr>
				</table>';
				 *
				 */

				//News letter subscription email starts

					$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$headers .= "From: GeeLaza<info@geelaza.com>";
					$sub = "You're All Signed Up - It's about time to enjoy yourself";

					@mail($subs_email, $sub, $template, $headers);
					$_SESSION['newssucc'] = "You have successfully subscribed to GeeLaza newsletter.";
					header('location:'.SITE_URL.'national_deals.php?nd=National deals&newssucc=You have successfully subscribed to GeeLaza newsletter.');
					//header('location:'.SITE_URL.'city_cookie.php?newssucc=You have successfully subscribed to GeeLaza newsletter.' );
				} ?>

				<form name="frm_email_subs" method="post" onsubmit="javascript: return chk_email_subs();">
					<input type="text" name="email_subs" class="text_field_ani" id="email_subs" value="Enter your email address" onclick="this.value=''" />
					<input type="submit" class="submit_btn" name="email_subs_btn" id="email_subs_btn" value="SUBSCRIBE" />
				</form>
				<div id="email_subs_error_loc" class="error"></div>
				<script type="text/javascript">
					function chk_email_subs() {
						var email = document.getElementById('email_subs').value;
						//alert(email);
						if (email == "" || email == "Enter your email address") {
							document.getElementById('email_subs_error_loc').innerHTML = "Enter your email address";
							return false;
						}
					}
				</script>


				</div>

				<script type="text/javascript">
				$(document).ready(function() {
				var toggle = function(direction, display) {
				 return function() {
				   var self = this;
				   var ul = $("ul", this);
				   if( ul.css("display") == display && !self["block" + direction] ) {
					 self["block" + direction] = true;
					 ul["slide" + direction]("slow", function() {
					   self["block" + direction] = false;
					 });
				   }
				 };
				}
				$("li.menu").hover(toggle("Down", "none"), toggle("Up", "block"));
				$("li.menu ul").hide();
				});

				</script>


				<?php
				if ($cookie || $_SESSION['fbuser'] == TRUE) {
				?>
				<div><a href="<?= SITE_URL ?>customer-account.php">My Account</a> |

					<!--<?php if ($cookie) { ?>
					<fb:login-button perms="email" autologoutlink="true" onlogin="window.location.reload()"></fb:login-button>
					<?php unset($_SESSION['fbuser']); ?>
					<?php } else { ?>
					<fb:login-button perms="email" autologoutlink="true">Login with facebook</fb:login-button>
					<?php //header("location:".SITE_URL."customer-account.php"); ?>
					<?php } ?>-->

				</div>

				<?php
				}
				elseif(!isset($_SESSION["user_id"]))
				{
				?>
				<div style="text-align:right;"><a href="<?= SITE_URL ?>customer-login.php">Login</a>|<a href="<?= SITE_URL ?>customer-register.php">Register</a></div>


				<?php
				}

				else
				{
				?>
				<div><a href="<?php echo SITE_URL ?>clogout.php">Logout</a> | <a href="javascript: void(0);"><span id="myacc">My Account</span></a>


				</div>

				<div id="menu" style="display: none;">
				<div class="menubox">
				<div><img src="images/drop_top.png" alt="" width="141" height="12" border="0"/></div>
				<div class="drop_menu">
				<ul>
				<li><a href="<?php echo SITE_URL ?>customer-account.php?tab=vouchers">My Vouchers</a></li>
				<li><a href="<?php echo SITE_URL; ?>customer-account.php?tab=purchase">Purchase History</a></li>
				<li><a href="<?php echo SITE_URL; ?>customer-account.php?tab=credit">Credits</a></li>
				<li><a href="<?php echo SITE_URL; ?>customer-account.php?tab=royal">Royal Points</a></li>
				<li><a href="<?php echo SITE_URL; ?>customer-account.php?tab=subscriptions">Subscriptions</a></li>
				<li><a href="<?php echo SITE_URL; ?>customer-account.php?tab=account">Account</a></li>
				<li><a href="<?php echo SITE_URL ?>clogout.php">Logout</a></li>
				</ul>
                <div class="clear"><img src="images/spacer.gif" alt="" width="1" height="1"/></div>
				</div>
                <!--<div><img src="images/drop_bottom.png" alt="" width="141" height="5" border="0"/></div>-->
				</div>
				</div>
				<?php
				}

			?>
			  	</div>
			<?php
			$base = basename($_SERVER['REQUEST_URI']);
			$page = explode("?city", $base);
			$page = $page[0];
			?>

			 <div class="clear"><img src="images/spacer.gif" alt="" width="1" height="1"/></div>
          <div id="navigation">
           <ul>
            <li class="<?php if ($page == 'getdeals' || $page == 'index.php') { echo 'selected '; }?>link" style="width:117px;"><a href="<?php echo SITE_URL; ?>"><span>Today's Deals</span></a></li>
			<li ><img src="images/devider.gif" alt="" width="2" height="28"/></li>
            <li class="<?php if ($page == 'previous_deals.php') { echo 'selected '; }?>link" style="width:118px;"><a href="<?php echo SITE_URL; ?>previous_deals.php"><span>Previous Deals</span></a></li>
			<li><img src="images/devider.gif" alt="" width="2" height="28"/></li>
            <li class="<?php if ($page == 'howitworks.php') { echo 'selected '; }?>link" style="width:122px;"><a href="<?php echo SITE_URL; ?>howitworks.php"><span>How it works</span></a></li>
			<li><img src="images/devider.gif" alt="" width="2" height="28"/></li>
			<li style="padding: 4px 6px;"><img src="images/icon.png" alt="" width="21" height="20"/></li>
            <li class="link" style="width:122px;"><a href="<?php echo SITE_URL; ?>recomendation.php"><span>Invite Friends</span></a></li>
          </ul>
        </div>
    </div>





</div>
</div>
<div class="clear"></div>

<?php if ($_GET['action'] == "sold") { ?>
<div class="register_Main">
<div style="float:left; width:9px; height:49px; margin:0 0 0 -5px;"><img src="images/g_left.png" alt="" width="9" height="49" border="0"/></div>
<div style="width: 928px;" class="register_bg">


	<?php
		if ($_POST['Submit_ticker'] && $_POST['Submit_ticker'] == "Register") {
			//echo "Hi";
			echo $subs_email = $_POST['email_subs_ticker'];
			$date = date("Y-m-d");
		echo $subscribe_sql = "INSERT INTO ".TABLE_NEWSLETTERS." (ns_id, full_name, email, city, status, date_added) VALUES (NULL, NULL, $subs_email, NULL, 1, $date)";
		mysql_query($subscribe_sql);
		//header('location:'.SITE_URL.'?acsucc=You have successfully subscribed to GeeLaza newsletter.');

	} ?>

				<div id="email_subs_ticker_error_loc" class="error"></div>


<form action="<?php echo $_SERVER['PHP_SELF']; ?>" name="frm_email_subs_ticker" method="post" onsubmit="javascript: return chk_email_subs_ticker();">
<ul>
<li><a href="#"><img src="images/late_btn.png" alt="" width="159" height="39" border="0"/></a></li>
<!--<li><a href="#"><img src="images/finished.png" alt="" width="131" height="32" border="0"/></a></li>-->
<li style="font-size: 12px; color:#000; font-weight: bold; font-family:"Times New Roman", Times, serif;">Sign up to our daily deals and you will never miss another deal again.</li>
<!--<li style="font-size: 11px; color:#000; line-height:42px;"><img src="images/signuptext.gif" alt="" width="363" height="17" border="0"/></li>-->
<li>
	<input style="width: 220px; font-size: 12px; color:#ccc; font-weight: bold; font-family:"Times New Roman", Times, serif;" type="text" name="email_subs_ticker" id="email_subs_ticker" class="white_box_ani" value="Enter your email address here" onclick="this.value= ''"/>
</li>
<li>
	<input type="submit" name="Submit_ticker" class="Sign_up" value="Register"/>
</li>
</ul>
</form>
	<script type="text/javascript">
		function chk_email_subs_ticker() {
			var email = document.getElementById('email_subs_ticker').value;
			//alert(email); die();
			if (email == "" || email == "Enter your email address here") {
				document.getElementById('email_subs_ticker_error_loc').innerHTML = "Enter your email address";
				return false;
			}
		}
	</script>
</div>
<div style="float:left; width:9px; height:49px; margin:0 0 0 0;"><img src="images/g_right.png" alt="" width="9" height="49" border="0"/></div>
</div>
<?php } ?>

<?php if ($_GET['bye'] != "" || $_GET['newssucc']) { ?>
<div class="register_Main">
<div style="float:left; width:9px; height:49px; margin:0 0 0 -5px;"><img src="images/g_left.png" alt="" width="9" height="49" border="0"/></div>
<div class="register_bg">
<h6 style="font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; padding: 10px; color: #333333; font-size: 14px;">
<span  id="close"><img src="images/closed.gif" width="15" height="13" align="right" style=" margin:0 -10px 0 0;" border="0"/></span>
<?php echo $_GET['bye']; echo $_GET['newssucc']; ?>
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


<div class="register_Main">
<div style="float:left; width:9px; height:49px; margin:0 0 0 0px;"><img src="images/g_left.png" alt="" width="9" height="49" border="0"></div>
<div class="register_bg">
<h6 style="font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; padding: 10px; color: #333333; font-size: 14px;">
<span id="close"><img src="images/closed.gif" width="15" height="13" align="right" style=" margin:0 -10px 0 0;" border="0"></span>
You have been subscribed to receive daily deals alert.</h6>
</div>
<div style="float:left; width:9px; height:49px; margin:0 0 0 0;"><img src="images/g_right.png" alt="" width="9" height="49" border="0"></div>
</div>
<!--
<div id="subscribe" class="register_bg" style="height:14px; width: 680px; padding: 10px; font-family: Helvetica; font-size: 10.5px; color: gray;" >

You have been subscribed to receive daily deals alert.
<span id="subscribe_close" style="float: right; margin-right: 10px; height:auto; width: 30px; cursor: pointer">Close</span>

</div>
 -->
<?php } ?>

<?php if ($_GET['acsucc']) { ?>
<div id="subscribe_succ" class="register_bg" style="height:14px; width: 680px; padding: 10px; font-family: Helvetica; font-size: 10.5px; color: gray;" >

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
	$("div#subscribe_succ").slideUp(300);

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
