<?php
ob_start();
session_start();
date_default_timezone_set('Europe/London');
header("Content-Type: text/html; charset=iso-8859-1");
/*	echo '<pre>'.print_r($_SESSION,true).'</pre>';
	exit;
*/
if(!isset($_SESSION["muser_id"]))
{
	header('location:merchant.php');
}

require("config.inc.php");
include("fckeditor/fckeditor.php");
require("class/Database.class.php");
require("class/pagination.class.php");
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta http-equiv="imagestoolbar" content="no" />
	<title>Welcome to our site</title>
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

<link rel="stylesheet" type="text/css" href="css/nav/pro_dropdown_2.css" />
<script src="jss/nav/stuHover.js" type="text/javascript"></script>

<!-- Tabs links include -->
<link href="css/tabs/jquery.ui.all.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="js/tabs/jquery-1.5.1.js"></script>
<script type="text/javascript" src="js/tabs/jquery.ui.core.js"></script>
<script type="text/javascript" src="js/tabs/jquery.ui.widget.js"></script>
<script type="text/javascript" src="js/tabs/jquery.ui.tabs.js"></script>
<script type="text/javascript" src="js/thickbox.js"></script>
<link href="css/tabs/demos.css" rel="stylesheet" type="text/css"/>
<link href="css/thickbox.css" rel="stylesheet" type="text/css"/>
<script>
$(function() {
	$( "#tabs" ).tabs();
});
$(function() {
	$( "#tab1s" ).tabs();
});
$(function() {
	$( "#tab2s" ).tabs();
});
$(function() {
	$( "#tab3s" ).tabs();
});

</script>

<!-- --------------------- -->
<!--  Nav Menu --------------------------------- -->
	<link href="css/nav/layout.css" rel="stylesheet" type="text/css" />
<!--	<link href="css/nav/style.css" rel="stylesheet" type="text/css" />
-->
	<script type="text/javascript" src="js/nav/textresizedetector.js"></script>

	<script type="text/javascript">
	function init() {
		var iBase = TextResizeDetector.addEventListener(onFontResize, null);
		if (iBase <= 13) {
			document.body.style.fontSize = iBase*1.15;
		}
	}
	//id of element to check for and insert control
	TextResizeDetector.TARGET_ELEMENT_ID = 'index';
	//function to call once TextResizeDetector has init'd
	TextResizeDetector.USER_INIT_FUNC = init;
	function onFontResize(e, args) {
	//            document.write = ((args[0].iSize) >= 20) ? ('<link href="includes/style.css" rel="stylesheet" type="text/css" />') : ('<link href="includes/styleLarger.css" rel="stylesheet" type="text/css" />');
	}
	</script>

	<link rel="stylesheet" href="css/nav/MenuMatic.css" type="text/css" media="all" />


<!-- -------------------------------------------- -->


</head>

<body>
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
	$row_city_1 = mysql_fetch_array($result_city);
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
	<div class="header_left"><a href="<?= SITE_URL ?>"><img src="images/logo.gif" alt="" width="181" height="107" border="0"/></a></div>

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

				<div class="txt_box">
				<form action="" name="frm_email_subs" method="post" onSubmit="javascript: return frm_email_subs(this.value);">
					<input type="text" name="email_subs" class="text_field_ani" id="email_subs" value="Get deals by email" onclick="this.value=''" onblur="this.value='Get deals by email'" />
					<input class="submit_btn" type="submit" name="email_subs_btn" id="email_subs_btn" value="SUBSCRIBE" />
					<div id="email_subs_error_loc" class="error"></div>
				</form>

				<script type="text/javascript">
					function frm_email_subs (email) {
						//var email = document.getElementById('email_subs').value;
						//alert(email); die();
						if (email == "" || email == "Get deals by email") {
							document.getElementById('email_subs_error_loc').innerHTML = "Enter your email address";
							return false;
						}
						//return true;
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
				<div ><a href="<?= SITE_URL ?>customer-account.php">My Account</a></div>

				<div id="menu" >
				<div class="menubox">
				<div><img src="images/drop_top.png" alt="" width="141" height="16" border="0"/></div>
				<div class="drop_menu">
				<ul>
				<li><a href="#">My Order</a></li>
				<li><a href="#">My Credit</a></li>
				<li><a href="#">General</a></li>
				<li><a href="#">Security</a></li>
				</ul>
				</div>
				</div>
				</div>


				<?php
				}
				elseif(!isset($_SESSION["muser_id"]))
				{
				?>
				<div><a href="<?= SITE_URL ?>customer-login.php">Login</a>|<a href="<?= SITE_URL ?>customer-register.php">Register</a></div>


				<?php
				}

				else
				{
				?>
				<div style="white-space:nowrap;"><a href="<?php echo SITE_URL ?>merchant_home.php"><span id="myacc">My Account</span></a> |

				<a href="<?php echo SITE_URL ?>mlogout.php">Logout</a>


				</div>
				<!--<div id="menu">
				<div class="menubox">
				<div><img src="images/drop_top.png" alt="" width="141" height="16" border="0"/></div>
				<div class="drop_menu">
				<ul>
				<li><a href="#">My Order</a></li>
				<li><a href="#">My Credit</a></li>
				<li><a href="#">General</a></li>
				<li><a href="#">Security</a></li>
				</ul>
				</div>
				</div>
				</div>-->
				<?php
				}

			?>
			  	</div>


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
            <li class="link" style="width:122px;"><a href="#"><span>Invite Friends</span></a></li>
          </ul>
        </div>

			<!--<div style="width:518px; margin:25px 0 0 0;z-index:1000; position:absolute; text-align:right;">
             <ul style="z-index:1001;">

                <li class="dc" style="z-index:1001;">
                <a href="#" class="menu">Toady's Deals</a>
                </li>

                <li class="dc" style="z-index:1001;">
                <a href="#" class="menu">Past Deals</a>
                </li>

                <li class="dc" style="z-index:1001;">
                <a href="#" class="menu">How it works</a>
                </li>

                <li class="dc" style="z-index:1001;">
                <a href="#" class="menu">My Account</a>
                <ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Receive Payment</a></li>
                <li><a href="#">Merchant Account</a></li>
				<li><a href="#">Daily Deals</a></li>
				<li><a href="#">My Earnings</a></li>
				<li><a href="#">Redeem Values</a></li>
                </ul>
                </li>
            </ul>
            </div>-->



    </div>





</div>
</div>
<div class="clear"></div>

<?php if ($_GET['action'] != "") { ?>
<div class="register_bg">
<ul>
<li><a href="#"><img src="images/late_btn.gif" alt="" width="159" height="39" border="0"/></a></li>
<li>Sign up today for our email deals and you will never miss another deal !</li>
<li><input type="text" name="textfield2" class="white_box" value="Enter your email address"/></li>
<li><input type="submit" name="Submit" class="blue_btn" value="Register"/></li>
</ul>
</div>
<?php } ?>
<?php if ($_GET['bye'] != "") { ?>
<div class="register_bg">
<h6 style="font-family: Arial; font-weight: bold; padding-left: 20px; color: #333333; font-size: 24px;">
<?php echo $_GET['bye']; ?>
</h6>
</div>
<?php } ?>

<div id="container">

<?php
	$base = basename($_SERVER['REQUEST_URI']);
	$page = explode("?", $base);
	$page = $page[0];


if ($page == "index.php") { ?>
<div id="subscribe" class="register_bg" style="height:14px; width: 680px; padding: 10px; font-family: Helvetica; font-size: 10.5px; color: gray;" >

You have been subscribed to receive daily deals alert.
<span id="subscribe_close" style="float: right; margin-right: 10px; height:auto; width: 30px; cursor: pointer">Close</span>

</div>
<?php } ?>
<script>
$("div#click").click(function () {
$("div#locations").slideToggle(300);
});

$("div#locations").ready(function() {
	$("div#locations").hide(0);
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
 });*/
</script>

<script type="text/javascript">

$("span#myacc").click(function () {
	$("div#menu").slideToggle("slow");			// slideToggle() / toggle()
});

$("div#menu").ready(function() {
	$("div#menu").hide();
});
</script>
<div id="leftcol">
<div class="deal_info">
		<!--end head-->
