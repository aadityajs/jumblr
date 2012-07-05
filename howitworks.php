<?php include("include/header.php");?>
<?php
error_reporting(E_ERROR && E_STRICT);
?>
<?php
	if(!isset($_COOKIE["subscribe"]))
	header("location:".SITE_URL);
?>
<?php
$page_id = 2;
$sql_page = "SELECT * FROM ".TABLE_PAGES." WHERE status = 1 AND page_id = '".$page_id."' LIMIT 0, 1";
$qr = mysql_query($sql_page);
$page_res = mysql_fetch_array(mysql_query($sql_page));


?>

<div class="howitwork">
<div class="how_top">
<p>How GeeLaza works</p>
</div>
<div class="clear"></div>
<div class="how_mid">
<p><strong>GeeLaza offers customers with quality and amazing deals everyday with huge discount up to 90% in your city at your local cinemas, gyms, spas, restaurants, events and many more. Our deals are handpicked by the GeeLaza on-field team to give you the best deals on the best brands. With GeeLaza you can get great deals everyday no matter where you live.</strong></p>
</div>
<div class="clear"></div>
<div class="how_bot">
<div class="how_left">


<?php echo $page_res['desc']; ?>


<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="1"/></div>
<div class="bottombg" style="width: 540px;">
<ul>
<li style="padding-left: 25px;"><p style="font-weight: normal; color:#666666">You can recommend deals in number of ways :</p></li>
<li><img src="images/email.png" alt="" width="19" height="18" /></li>
<li><a <?php if (isset($_SESSION['user_id'])) { ?>href="#inline1" id="various1" <?php } else { ?>href="<?php echo SITE_URL; ?>recomendation.php"<?php } ?>>Email</a></li>
<!-- <li><img src="images/facebook.png" alt="" width="19" height="18" /></li> -->
<li><a name="fb_share" type="icon_link">Facebook</a>
	<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share"
	        type="text/javascript">
	</script>
</li>
<!-- <li><img src="images/twitter.png" alt="" width="19" height="18" /></li> -->
<li>
	<div id="custom-tweet-button">
	<a href="javascript: void(0);"  data-text="Twitter" data-via="unifiedinfotech" data-count="none" onclick="window.open('https://twitter.com/share','Twitter','width=500,height=500');">Twitter</a>
	</div>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</li>
</ul>
</div>




<div class="clear"></div>
<!--<div style="width: 145px; float: left; margin: 0 0 0 150px;"><a href="#"><img src="images/back_top.gif" alt="" width="145" height="39" border="0" /></a></div>-->
</div>
<div class="how_right">
<div class="right_grey">

<?php echo $page_res['desc_sidebar']; ?>

<div><img src="images/spacer.gif" alt="" width="1" height="18"/></div>
</div>
<div class="right_grey">
<div><img src="images/red_gift.gif" alt="" width="26" height="40" class="wrap"/><span>Did you know? Deals make great gifts,</span></div>
<br/>
  <div style="text-align:center;"><a style="text-align:center; margin-left: 28px; color: #1e2b93; font-size:14px; margin: 0 0 0 -5px;" href="<?php echo SITE_URL; ?>">Send one now</a></div>
<div><img src="images/spacer.gif" alt="" width="1" height="10"/></div>
</div>
<div class="see_deals"><a href="<?php echo SITE_URL; ?>"><!--<img src="images/today_deal.gif" alt="" width="171" height="34" border="0"/>--> See today's deals</a></div>
</div>
<!--<div class="how_right1">
<div style="float: none; margin: 10px auto; width: 139px; background:#fff;"><a href="<?php echo SITE_URL; ?>"><img src="images/today_deal.gif" alt="" width="171" height="34" border="0"/></a></div>
</div>-->
</div>
</div>







</div>
</div>
</div>
</div>
<?php include 'recommendation_popup.php';?>
<?php include ('include/footer.php'); ?>