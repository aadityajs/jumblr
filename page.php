<?php include("include/header.php");?>
<?php
error_reporting(E_ERROR && E_STRICT);
?>
<?php
	if(!isset($_COOKIE["subscribe"]))
	header("location:".SITE_URL);
?>
<?php
if ($_GET['page']) {
	$page_name = $_GET['page'];
$sql_page = "SELECT * FROM ".TABLE_PAGES." WHERE status = 1 AND title = '".$page_name."' LIMIT 0, 1";
$qr = mysql_query($sql_page);
$page_res = mysql_fetch_array(mysql_query($sql_page));
}

?>


<div class="deal_info">
<div class="top_about2">
<?php if ($qr <= 0) { ?>
<p>Oops!</p>
<?php } else { ?>
<p><?php echo $page_res['title']; ?></p>
<?php } ?>
</div>
<div class="clear"></div>
<div class="midbg" style="width:940px;">
<div class="today_deal" style="width:900px; margin-left:20px;">
<style>
	.today_deal .cms{
		width:100%;
		padding: 0px;
	}
</style>
<?php if ($qr <= 0) { ?>
<h1>You are not Authorised to come here.</h1>
<?php } else { ?>
<?php echo $page_res['desc']; ?>
<?php } ?>
<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="40" /></div>
<!--<div style="width: 702px; float: none; margin: 0 auto; background:#1f1f1f;"><img src="images/logo_bot.gif" alt="" width="207" height="108" /></div>
--></div>
</div>
<?php //include ('include/sidebar.php');?>
</div></div>
<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
<?php include ('include/footer.php'); ?>