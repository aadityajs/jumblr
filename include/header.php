<?php
ob_start();
session_start();
date_default_timezone_set('Europe/London');
require("config.inc.php");
// Include MapBuilder class.
require_once 'class/class.MapBuilder.php';
require("class/Database.class.php");
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();
error_reporting(E_ERROR || E_WARNING || E_STRICT);

	// Maintenance mode checking
	$mModeSelectSql = "SELECT * FROM ".TABLE_SETTING." WHERE `name` = 'm_mode';";
	$mModeSelectRes = mysql_fetch_array(mysql_query($mModeSelectSql));
	if($mModeSelectRes[value] == 1) {
		header("location:".SITE_URL."maintenance.php");
	}

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
	<title>Welcome to Jumblr</title>
	<link rel="stylesheet" href="css/base.css" type="text/css" media="all">
	<link href="css/getdeals_style.css" rel="stylesheet" type="text/css" />
	<link href="css/jumblr_style.css" rel="stylesheet" type="text/css" />

	<!--
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>

	<link rel="stylesheet" href="css/tipsy.css" type="text/css" />
	<script type="text/javascript" src="js/jquery.tipsy.js"></script>


	<!--[if lt IE 9]>
        <script type="text/javascript" src="http://info.template-help.com/files/ie6_warning/ie6_script_other.js"></script>
        <script type="text/javascript" src="js/html5.js"></script>
    <![endif]-->


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


<!-- Fancy box script start -->

<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
	<script type="text/javascript" src="js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>-->
	<script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />


<!--
<script type="text/javascript">
$j = jQuery.noConflict(true);

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
			$j("#various4").fancybox({
				'titlePosition'		: 'inside',
				'speedIn':      300,
			    'speedOut':     300,
			    'easingIn':     'swing',
			    'easingOut':    'swing',
			    'hideOnOverlayClick' : false
			});
			$j("#various5").fancybox({
				'titlePosition'		: 'inside',
				'speedIn':      300,
			    'speedOut':     300,
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


			$j("#nodeal_info").fancybox({
				'titlePosition'		: 'inside',
				'speedIn':      300,
			    'speedOut':     300,
			    'transitionIn': 'elastic',
			    'transitionOut': 'elastic',
			    'easingIn':     'swing',
			    'easingOut':    'swing',
			    'hideOnOverlayClick' : false
			});

			$j("#nodeal_info_btn").fancybox({
				'titlePosition'		: 'inside',
				'speedIn':      300,
			    'speedOut':     300,
			    'transitionIn': 'elastic',
			    'transitionOut': 'elastic',
			    'easingIn':     'swing',
			    'easingOut':    'swing',
			    'hideOnOverlayClick' : false
			});


			$j("#variousall").fancybox({
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
			$q("#gift").fancybox({
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

	function Gift() {
		$q(document).ready(function() {
					$q("#gift").fancybox({
						//alert("dsfdsfdsf");
						'titlePosition'		: 'inside',
						'transitionIn'		: 'fade',
						'transitionOut'		: 'fade'
						}).trigger('click');
			       });
	}
	   </script> -->

<!-- Fancy box script end -->


    <!-- <script type="text/javascript" src="js/form.js"></script> -->

<!--	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
  	  	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
  		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
-->

<!-- Gallery js and css
	<link rel="stylesheet" type="text/css" href="css/jquery.ad-gallery.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery.ad-gallery.js"></script>
	  <script type="text/javascript">
	  $(function() {
	   /*
	    $('img.image1').data('ad-desc', 'Whoa! This description is set through elm.data("ad-desc") instead of using the longdesc attribute.<br>And it contains <strong>H</strong>ow <strong>T</strong>o <strong>M</strong>eet <strong>L</strong>adies... <em>What?</em> That aint what HTML stands for? Man...');
	    $('img.image1').data('ad-title', 'Title through $.data');
	    $('img.image4').data('ad-desc', 'This image is wider than the wrapper, so it has been scaled down');
	    $('img.image5').data('ad-desc', 'This image is higher than the wrapper, so it has been scaled down');
	    */
	    var galleries = $('.ad-gallery').adGallery();

	    galleries[0].settings.effect = 'fade';	//'slide-hori', 'slide-vert', 'fade', or 'resize', 'none'

	    $('#toggle-slideshow').click(
	      function() {
	        galleries[0].slideshow.toggle();
	        return false;
	      }
	    );
	  });
	  </script>-->

		<style type="text/css">
		  #gallery {
		   /* padding: 30px;
		     background: #e1eef5; */
		  }
		  .ad-gallery {
		  	width: 439px;
		  }
		  .ad-gallery .ad-image-wrapper {
		  	height: 293px;
		  }
		  </style>


<!-- Customize Twitter button -->

<style type="text/css">
#widget, .btn, .twitter-share-button, .btn-o a{
	background-image: none;
	background-color: transparent;
	border: 0px;
}
  #custom-tweet-button a {
    /* display: block; */
    padding: 2px 5px 2px 20px;
    background: url('http://a4.twimg.com/images/favicon.ico') 1px center no-repeat;
    border: 0px solid #ccc;
    width: 40px;
    height: 12px;
    color: inherit;
    text-decoration: none;
  }
</style>

</head>

<body <?php if ($_GET['gift'] == 'gifting') { echo 'onload="Gift();"'; }?> <?php if ($_GET['recommend'] == "import") { echo 'onload="recomEmailGet();"';}?> <?php if ($_GET['newssucc']) { echo 'onload="NewsSucc();"';}?> <?php if (!isset($_COOKIE["subscribe"])) echo 'onload="ShowLightBox(\'email-form\'); return false;"' ?>  >


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

function get_facebook_cookie_new($app_id, $app_secret)
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
		header('location:'.SITE_URL.'city_cookie.php?city='.$_GET['city'].'&newssucc='.$_SESSION['newssucc']);

	}
?>

<?php

	$country = 225;		// Country code

	$sql_city = "SELECT * FROM ".TABLE_CITIES."  WHERE country_id = $country GROUP BY city_name ASC";
	$result_city = mysql_query($sql_city);
?>







<header>
 <div class="header">
  <div class="header_left">
       <a href="<?= SITE_URL ?>"><img src="images/logo.png" alt="" border="0"/></a>
  </div>
  <div class="header_middle">

   	<div class="styled_select3 left" style="border: 0px solid #000;">
        <select style="width:170px;" name="user_type" onchange="javascript: window.location.href = (this.options[selectedIndex].id);" >
        	<option value=""><?php if ($_GET['nd'] || $ndpage == 'national_deals.php') {echo 'NATIONAL DEALS';} else {echo strtoupper($show_city["city_name"]);} ?></option>
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
        <select style="width:170px;" name="user_type" onchange="javascript: window.location.href = (this.options[selectedIndex].id); ">
        <?php
	    	$sqlCat = "select * from ".TABLE_CATEGORIES." where parent_id=0";
	    	$catRes = mysql_query($sqlCat);
	    	while ($catRow = mysql_fetch_array($catRes)) {
    	?>
          <option value="consumer" id="<?php echo SITE_URL."list.php?cat=".$catRow['cat_id']; ?>" <?php echo ($_GET['cat'] == $catRow['cat_id'] ? 'selected' : '');?>><?php echo $catRow['cat_name']; ?></option>
        <?php } ?>
        </select>
    </div>

  </div>
  <div class="header_right">
    <nav>
        <ul>
            <li><a href="<?php echo SITE_URL; ?>"><span><img src="images/icon_01.png" alt=""></span> <br>Home</a></li>
          <li><a href="#"><span><img src="images/icon_02.png" alt=""></span> <br>Map</a></li>
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

				<div style="text-align:right;">
					<a href="<?= SITE_URL ?>customer-login.php">Login</a>  <!-- |  <a href="<?= SITE_URL ?>customer-register.php">Register</a>

					<a href="<?php echo $loginUrl; ?>"><img src="http://www.realestatenewport.com/assets/facebook-login-button-5c5750b27cc8759f735f49a5ad2a4263.png" alt="" /></a>-->

					<!--<span><?php if ($cookie) { ?>
                    <fb:login-button scope="email,publish_actions,user_about_me,user_activities,user_birthday,user_checkins,user_education_history,user_events,user_games_activity,user_groups,user_hometown,user_interests,user_likes,user_location,user_notes,user_photos,user_questions,user_relationship_details,user_relationships,user_religion_politics,user_status,user_subscriptions,user_videos,user_website,user_work_history,friends_about_me,friends_activities,friends_birthday,friends_checkins,friends_education_history,friends_events,friends_games_activity,friends_groups,friends_hometown,friends_interests,friends_likes,friends_location,friends_notes,friends_photos,friends_questions,friends_relationship_details,friends_relationships,friends_religion_politics,friends_status,friends_subscriptions,friends_videos,friends_website,friends_work_history,ads_management,create_event,create_note,export_stream,friends_online_presence,manage_friendlists,manage_notifications,manage_pages,offline_access,photo_upload,publish_checkins,publish_stream,read_friendlists,read_insights,read_mailbox,read_requests,rsvp_event,share_item,sms,status_update,user_online_presence,video_upload,xmpp_login" autologoutlink="true" onlogin="window.location.reload()"></fb:login-button>
                    <?php unset($_SESSION['fbuser']); ?>
                    <?php } else { ?><br />
                    <span><fb:login-button scope="email,publish_actions,user_about_me,user_activities,user_birthday,user_checkins,user_education_history,user_events,user_games_activity,user_groups,user_hometown,user_interests,user_likes,user_location,user_notes,user_photos,user_questions,user_relationship_details,user_relationships,user_religion_politics,user_status,user_subscriptions,user_videos,user_website,user_work_history,friends_about_me,friends_activities,friends_birthday,friends_checkins,friends_education_history,friends_events,friends_games_activity,friends_groups,friends_hometown,friends_interests,friends_likes,friends_location,friends_notes,friends_photos,friends_questions,friends_relationship_details,friends_relationships,friends_religion_politics,friends_status,friends_subscriptions,friends_videos,friends_website,friends_work_history,ads_management,create_event,create_note,export_stream,friends_online_presence,manage_friendlists,manage_notifications,manage_pages,offline_access,photo_upload,publish_checkins,publish_stream,read_friendlists,read_insights,read_mailbox,read_requests,rsvp_event,share_item,sms,status_update,user_online_presence,video_upload,xmpp_login" autologoutlink="true">Connect</fb:login-button></span>
                    <?php } ?></span>
                     -->
				</div>


				<?php
				}

				else
				{
				?>
				<div style="float: right;"><a href="<?php echo SITE_URL ?>clogout.php">Logout</a>  |  <a href="javascript: void(0);"><span id="myacc">My Account</span></a>


				</div>


				<div id="menu" style="display: none; position: static; right: -200; z-index: 1000; margin: 20px 0 0 0px;">
				<div class="menubox" style="margin: 0;">
				<div><img src="images/drop_top.png" alt="" width="141" height="12" border="0"/></div>
				<div class="drop_menu">
				<ul>
				<li><a href="<?php echo SITE_URL ?>customer-account.php?tab=vouchers">My Vouchers</a></li>
				<li><a href="<?php echo SITE_URL; ?>customer-account.php?tab=purchase">Purchase History</a></li>
				<li><a href="<?php echo SITE_URL; ?>customer-account.php?tab=jumble">Add Jumble!</a></li>
				<!-- <li><a href="<?php echo SITE_URL; ?>customer-account.php?tab=credit">Credits</a></li>
				<li><a href="<?php echo SITE_URL; ?>customer-account.php?tab=royal">Royal Points</a></li>
				<li><a href="<?php echo SITE_URL; ?>customer-account.php?tab=subscriptions">Subscriptions</a></li>
				<li><a href="<?php echo SITE_URL; ?>customer-account.php?tab=account">Account</a></li> -->
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






<!--start body-->
		<section id="body">
