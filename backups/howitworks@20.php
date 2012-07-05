<?php include("include/header.php");?>
<?php
error_reporting(E_ERROR && E_STRICT);
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
<p><strong>GeeLaza offers its customers quality and simply amazing deals everyday with huge discount to up 90% in your cinema at your local cinemas, gyms, restaurants and more. Our deals are handpicked by the Geelaza team to give you the best deals no matter where you live.</strong></p>
</div>
<div class="clear"></div>
<div class="how_bot">
<div class="how_left">


<?php echo $page_res['desc']; ?>


<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="1"/></div>
<div class="bottombg">
<ul>
<li style="padding-left: 25px;"><p style="font-weight: normal; color:#666666">You can recommend deals in number og ways:</p></li>
<li><img src="images/email.png" alt="" width="19" height="18" /></li>
<li><a href="#">Email</a></li>
<li><img src="images/facebook.png" alt="" width="19" height="18" /></li>
<li><a href="#">Facebook</a></li>
<li><img src="images/twitter.png" alt="" width="19" height="18" /></li>
<li><a href="#">Twitter</a></li>
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
<div><img src="images/red_gift.gif" alt="" width="26" height="40" class="wrap"/><span>Old you know? Deats make great gifts,<br/>
  <a style="text-align:center; margin-left: 28px; color: #1e2b93;" href="#">Send one now</a> </span></div>
<div><img src="images/spacer.gif" alt="" width="1" height="10"/></div>
</div>
<div style="float: none; margin: 10px auto; width: 139px;"><a href="<?php echo SITE_URL; ?>"><img src="images/today_deal.gif" alt="" width="139" height="33" border="0"/></a></div>
</div>
</div>
</div>







</div>
</div>
</div>
</div>
<?php include ('include/footer.php'); ?>