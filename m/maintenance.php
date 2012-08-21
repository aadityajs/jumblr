<?php
ob_start();
session_start();
date_default_timezone_set('Europe/London');
require("config.inc.php");
require("class/Database.class.php");
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();

	// Maintenance mode checking
	$mModeSelectSql = "SELECT * FROM ".TABLE_SETTING." WHERE `name` = 'm_mode';";
	$mModeSelectRes = mysql_fetch_array(mysql_query($mModeSelectSql));
	if($mModeSelectRes[value] == 0) {
		header("location:".SITE_URL);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Welcome to our site</title>
</head>
<body style="background:url(images/mainbg.gif) left top repeat-x; margin: 0;">
<div style="background:#FFFFFF; width: 700px; margin: 0 auto; float: none;">
<div style="background:#FFFFFF;">
<div style="width: 700px;">
<div style="margin: 0 auto;">
<div style="width: 700px; float: none; margin: 1px auto; background:#1f1f1f;"><a href="#"><img src="images/logo.gif" alt="" width="207" height="108" border="0" /></a></div>
<div class="clear"></div>
<div>
<div>
<div style="background: none; width: 704px; height: auto; float: left; margin: 9px auto 0 auto;"><div style="font: bold 34px/34px Arial, Helvetica, sans-serif; color: #1c95d4;	padding: 6px 0 0 116px; margin: 0; text-align: center; vertical-align: middle;">Jumblr is unavailable</div>
</div>
<div class="clear"></div>
<div style="background: none; width: 704px; height: auto; float: left; margin: 6px auto 0 auto;">
<div style="font: normal 14px/16px Arial, Helvetica, sans-serif; color: #414141; padding: 0 20px 0 220px;
	margin: 0; text-align: left; vertical-align: top;">Jumblr is currently unavailable. We apologize for the inconvenience and are working to bring the site back up soon as possinle.</div>
</div>
<div class="clear"></div>
<div style="background: none; width: 704px; height: auto; float: left; margin: 8px auto 0 auto;">
<div style="font: normal 14px/18px Arial, Helvetica, sans-serif; color: #414141; padding: 8px 20px 0 320px; margin: 0; text-align: left; vertical-align: top;"><strong>While You Wait</strong><br/><br/>
<ul style="padding:0 0 0 14px; margin: 0;">
<li>Join us on facebook by <a href="#" style="font: bold 14px/15px Arial, Helvetica, sans-serif; color: #0fa3f1;"> becoming a fan of Jumblr </a>and share your comments, insights, and testimonials with others.</li>
<li style="padding: 8px 0 0 0;">Are you on Twitter? Tweet with us at <a href="#" style="font: bold 14px/15px Arial, Helvetica, sans-serif; color: #0fa3f1;"> @Jumblr</a> to get the latest updates from the Jumblr Team.</li>
</ul>
</div>
</div>
<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="1"/></div>
<div><img src="images/under-maintenance.png" alt="" width="500" height="280"/></div>
</div>
</div>
</div>
</div>
</div>
</div>
</body>
</html>
