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

<div id="container">
<div id="leftcol">
<div class="deal_info">
<div class="top_about">
<?php if ($qr <= 0) { ?>
<p>Oops!</p>
<?php } else { ?>
<p><?php echo $page_res['title']; ?></p>
<?php } ?>
</div>
<div class="clear"></div>
<div class="midbg">
<div class="today_deal">
<?php if ($qr <= 0) { ?>
<h1>You are not Authorised to come here.</h1>
<?php } else { ?>
<?php echo $page_res['desc']; ?>
<?php } ?>
<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="40" /></div>
<div style="width: 702px; float: none; margin: 0 auto; background:#1f1f1f;"><img src="images/logo_bot.gif" alt="" width="207" height="108" /></div>
</div>
</div>
</div>
</div>
<?php include ('include/sidebar.php');?>
</div>
<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
<?php include ('include/footer.php'); ?>