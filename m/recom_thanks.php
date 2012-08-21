<?php include("include/header.php");?>
<?php
error_reporting(E_ERROR && E_STRICT);
?>

<?php
if ($_GET['page']) {
	$page_name = $_GET['page'];
$sql_page = "SELECT * FROM ".TABLE_PAGES." WHERE status = 1 AND title = '".$page_name."' LIMIT 0, 1";
$qr = mysql_query($sql_page);
$page_res = mysql_fetch_array(mysql_query($sql_page));
}

?>

<style type="text/css" media="screen">

</style>

<div class="deal_recomm">
<div class="top_recomm">
<p>Thank you for your recommendation.</p>
</div>
<div class="clear"></div>
<div style="border-bottom: 3px solid #7fd7fb;"></div>
<div class="clear"></div>
<div class="recomm_mid">
<div class="invita_deal">
<div><p class="black">You have recommended this deal to 1 friend successfully.</p></div>
<div><p class="black1">Now what?</p></div>
<div class="clear"></div>
<div class="massage">
<div class="massage_left"><p style="font-family:sans-serif; font-size: 14px; line-height: 20px;">The person that you recommended this deal “to” will have to create an account with us for the first time and buy something via your link within 48 hours and then we will add £5.00 credit to your account</p></div>
<div class="massage_right">
<div style="padding: 0 0 0 20px;"><img src="images/dollar01.gif" alt="" width="122" height="105" /></div>
</div>
</div>
</div>
<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
<div style="border-bottom: 3px solid #7fd7fb;"></div>
<div class="clear"></div>
<div class="invita_deal">
<div>
<p class="red1">You can invite more friends to increase your account credit:</p></div>
<div class="clear"></div>
<div class="massage">
<div style="float:left; width: 170px; margin: 30px auto;">
<p><a id="various2" href="#inline1" ><img src="images/email_btn.gif" alt="" width="163" height="59" border="0"/></a></p>

<p>
<a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo SITE_URL.'index.php' ?>"
onclick="pageTracker._trackEvent('outbound_share','facebook.com','/fbtest/fbshare.html');"
title="Share this webpage on Facebook"><img src="images/facebook_btn.gif" alt="" width="163" height="58" border="0"/></a>

<!-- 	<a name="fb_share" type="icon_link">
		<img src="images/facebook_btn.gif" alt="" width="163" height="58" border="0"/>
	</a>
	<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script> -->
</p>
<p>
<a href="https://twitter.com/share"  data-text="Twitter" data-via="unifiedinfotech" data-count="none"><img src="images/twitter_btn.gif" alt="" width="163" height="58" border="0"/></a>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</p>
</div>
<div style="float:right; width: 444px; margin: 10px auto;"><img src="images/gift_banner.jpg" alt="" width="441" height="240"/></div>
</div>
</div>
<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
<div style="border-bottom: 3px solid #7fd7fb;"></div>
</div>
<div class="recomm_bot"></div>
</div>

<!--

<div class="deal_info">
<div class="top_about">

<p>FAQ</p>

</div>
<div class="clear"></div>
<div class="midbg">
<div class="today_deal">

<h1>You are not Authorised to come here.</h1>


<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="40" /></div>
<div style="width: 702px; float: none; margin: 0 auto; background:#1f1f1f;"><img src="images/logo_bot.gif" alt="" width="207" height="108" /></div>
</div>
</div>
<div class="bot_about"></div>
</div>

 -->

</div>
</div>
<?php include ('include/sidebar.php');?>
<?php include 'recommendation_popup.php';?>
<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
<?php include ('include/footer.php'); ?>