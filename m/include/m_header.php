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
	<title>Welcome to Jumblr</title>
	<link rel="icon" href="<?php echo SITE_URL; ?>jfavicon.ico">

	<link rel="stylesheet" href="css/base.css" type="text/css" media="all">
	<link href="css/getdeals_style.css" rel="stylesheet" type="text/css" />
	<link href="css/jumblr_style.css" rel="stylesheet" type="text/css" />

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="css/tipsy.css" type="text/css" />
	<script type="text/javascript" src="js/jquery.tipsy.js"></script>
	<!--<link href="css/base.css" rel="stylesheet" type="text/css" />

	<link href="css/nav.css" rel="stylesheet" type="text/css" />
     <script type="text/javascript" src="js/city.js"></script>

		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/jquery.dd.js"></script>
		<script type="text/javascript" src="js/jquery.bxSlider.js"></script>
		 <script src="js/overlib.js"></script>

		<link rel="stylesheet" type="text/css" href="css/dd.css" />-->
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

<!-- <link rel="stylesheet" type="text/css" href="css/nav/pro_dropdown_2.css" />
<script src="jss/nav/stuHover.js" type="text/javascript"></script> -->

<!-- Tabs links include -->
<link href="css/tabs/jquery.ui.all.css" rel="stylesheet" type="text/css"/>
<!--<script type="text/javascript" src="js/tabs/jquery-1.5.1.js"></script>-->
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
$(function() {
	$( "#tab4s" ).tabs();
});

</script>

<!-- --------------------- -->
<!--  Nav Menu -->
<!--	<link href="css/nav/layout.css" rel="stylesheet" type="text/css" />
	<link href="css/nav/style.css" rel="stylesheet" type="text/css" />

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

	<link rel="stylesheet" href="css/nav/MenuMatic.css" type="text/css" media="all" />-->


<!-- -------------------------------------------- -->


</head>

<body>
<!-- <script src="http://connect.facebook.net/en_US/all.js"></script>
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
		/*	function get_facebook_cookie($app_id, $app_secret)
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
			*/

?> -->

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

<header>
 <div class="header">
  <div class="header_left">
       <a href="<?= SITE_URL ?>"><img src="images/logo.png" alt="" border="0"/></a>
  </div>
  <div class="header_middle">

   	<div class="styled_select3 left" style="border: 0px solid #000;">
        <select style="width:170px;" name="user_type" onchange="javascript: window.location.href = (this.options[selectedIndex].id);" >
        	<!-- <option value=""><?php if ($_GET['nd'] || $ndpage == 'national_deals.php') {echo 'NATIONAL DEALS';} else {echo strtoupper($show_city["city_name"]);} ?></option> -->
        	<?php
					while($row_city = mysql_fetch_array($result_city))
					{
						?>
						<option value="<?php echo $row_city['city_id']; ?>" id="<?php echo SITE_URL."?city=".$row_city["city_id"]; ?>" > <?php echo $row_city['city_name']; ?> </option>
						<?php
					}
				?>
        </select>
    </div>

    <div class="styled_select3 right" style="border: 0px solid #000;">
        <select style="width:170px;" name="user_type">

        <?php
	    	$sqlCat = "select * from ".TABLE_CATEGORIES." where parent_id=0";
	    	$catRes = mysql_query($sqlCat);
	    	while ($catRow = mysql_fetch_array($catRes)) {
    	?>
          <option value="consumer" id="<?php echo $catRow['cat_id']; ?>"><?php echo $catRow['cat_name']; ?></option>
        <?php } ?>
        </select>
    </div>

  </div>
  <div class="header_right">
    <nav>
        <ul>
            <li><a href="<?php echo SITE_URL; ?>"><span><img src="images/icon_01.png" alt=""></span> <br>Home</a></li>
          <li><a href="javascript: void(0);" id="openDateSearch"><span><img src="images/icon_02.png" alt=""></span> <br>Search</a>
		  </li>
		  <div style="display:none; position: absolute; z-index: 1000; margin: 60px 0 0 90px; height:auto; background-color:#343535; border: 1px solid #575757; width: 274px;" id="search_date" class="debug">
				<form name="search_dt" action="<?php echo SITE_URL; ?>list.php?srch=search_date" method="post">
				<span style="padding:0 8px; margin: 0; color:#b6b6b6;">Start Time</span>
				<input type="text" name="date_srch" id="date_srch"  value=""  style="width: 168px; height: 19px; background: #39393a; border: 1px solid #5d5d5d; margin: 10px 9px;" onclick='fPopCalendar("date_srch")' /><br />
				<span style="padding:0 10px; margin: 0; color:#b6b6b6;">End Time</span>
				<input type="text" name="date_srch1" id="date_srch1" value=""  style="width: 168px; height: 19px; background: #39393a; border: 1px solid #5d5d5d; margin: 4px 9px;" onclick='fPopCalendar("date_srch1")' /><br />
				<!--<input type="hidden" name="srch" id="srch" value="search_date" />-->
				<input type="submit" name="submit" value="Submit" style="width: auto; color: #FFFFFF; height: 21px; background: #ff8d12; border: 1px solid #e27600; font: normal 12px/20px Arial, Helvetica, sans-serif; padding: 0 10px 4px 10px; margin: 6px 0 6px 85px;"/></form>
			</div>
          <li><a href="#"><span><img src="images/icon_03.png" alt=""></span> <br>Help</a></li>
          <?php if(isset($_SESSION["user_id"])) { ?>
          <li><a href="<?= SITE_URL ?>customer-account.php"><span><img src="images/icon_04.png" alt=""></span> <br>My Account</a></li>
          <?php } else { ?>
          <li><a href="<?= SITE_URL ?>customer-login.php"><span><img src="images/icon_04.png" alt=""></span> <br>My Account</a></li>
          <?php } ?>
      </ul>
    </nav>
  </div>
 <div class="clear"></div>
 </div>
</header>

<!--start maincontainer-->
	<div id="maincontainer">
	 	<div class="login" style="float: right;">
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

</div>	<!-- login end -->
<div class="clear"></div>

<?php if ($_GET['action'] == "sold") { ?>
<div style="margin: 0 20px 0 0;">
<div class="register_Main1"><img src="images/cross.png" alt="" width="9" height="9" border="0" style="float: right; margin: 10px; cursor: pointer;" id="close"/>
<div style="width:160px; margin: 86px 18px 0 auto; float: right;"><a href="<?php echo SITE_URL; ?>"><img src="images/view_today.png" alt="" width="177" height="33" border="0"/></a></div>
</div>
</div>


<?php } ?>

<?php if ($_GET['bye'] != "" || $_GET['newssucc']) { ?>
<div class="register_Main" style="margin: 0 10px 20px 0;">
<div style="float:left; width:9px; height:49px; margin:0 0 0 0px;"><img src="images/g_left.png" alt="" width="9" height="49" border="0"/></div>
<div class="register_bg" style="float: left; width: 920px;">
<h6 style="font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; <?php echo ($_GET['newssucc'] != ''? 'padding: 15px;' : 'padding: 15px 15px 0 0;;')?> color: #333333; font-size: 12px; line-height: 14px;">
<span  id="close"><img src="images/closed.gif" width="15" height="13" align="right" style=" margin:0 -10px 0 0;" border="0"/></span>
<?php echo '<span style="font-size: 16px;">'.$_GET['bye'].'</span>'; echo $_GET['newssucc']; ?>
</h6>
</div>
<img src="images/g_right.png" alt="" width="9" height="49" border="0"/>
</div>
<?php } ?>

<?php if ($_GET['errnewssucc'] != "") { ?>
<div class="register_Main">
<div style="float:left; width:9px; height:49px; margin:0 0 0 -5px;"><img src="images/g_left.png" alt="" width="9" height="49" border="0"/></div>
<div class="register_bg">
<h6 style="font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; padding: 10px; color: #333333; font-size: 12px; line-height: 14px;">
<span  id="close"><img src="images/closed.gif" width="15" height="13" align="right" style=" margin:0 -10px 0 0;" border="0"/></span>
<img src="images/blue_big_cross.png" align="left" style="margin-right: 10px;"/>
<?php echo $_GET['errnewssucc']; ?>
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

<?php } ?>



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

	<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-timepicker-addon.js"></script>
	<link rel="stylesheet" media="all" type="text/css" href="css/custom-timer.css" />




	<link rel="stylesheet" href="css/lat-long-drag_1.css" type="text/css" media="screen" />
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<script type="text/javascript" src="js/lat-long-drag_1.js"></script>
	<script type="text/javascript" src="js/lat-long-drag_all.js"></script>








<!--start body-->
		<section id="body">
