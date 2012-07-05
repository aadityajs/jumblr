<?php include("include/header.php");?>
<?php
error_reporting(E_ERROR && E_STRICT);
?>
<div id="container">
<div id="leftcol">
<div class="deal_info">
<div class="top_about">
<p>Previous Deals</p>
</div>
<div class="clear"></div>
<div class="midbg">
<div class="today_deal">

<?php 


	//$sql_previous = "SELECT * FROM ".TABLE_DEALS." WHERE status >= 1 AND deal_end_time NOT LIKE '".date("Y-m-d")."%' LIMIT 0, 30";
	$sql_previous = "SELECT * FROM ".TABLE_TRANSACTION." WHERE transaction_status = 'success' LIMIT 0, 30";
	$qr = mysql_num_rows(mysql_query($sql_previous));
	$sql_previous_res = mysql_query($sql_previous);
	
	while ($previous_res = mysql_fetch_array($sql_previous_res)) {
		
		$sql_previous_details = "SELECT * FROM ".TABLE_DEALS." WHERE status >= 1 AND deal_id = '".$previous_res['deal_id']."' LIMIT 0, 30";
		$previous_details = mysql_fetch_array(mysql_query($sql_previous_details));
		
		$sql_previous_buy = "SELECT SUM(qty) FROM ".TABLE_TRANSACTION." WHERE deal_id = ".$previous_res['deal_id'];
		$previous_buy = mysql_fetch_array(mysql_query($sql_previous_buy));
		
		$sql_previous_image = "SELECT * FROM ".TABLE_DEAL_IMAGES." WHERE deal_id = ".$previous_res['deal_id'];
		$previous_image = mysql_fetch_array(mysql_query($sql_previous_image));
		

?>

<!-- deal box start -->
<div class="previous_deal">
<div><p><a href="<?php echo SITE_URL; ?>?action=sold&id=<?php echo $previous_res['deal_id']; ?>"><?php echo truncate_string($previous_details['title'], 100); ?></a></p></div>
<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="8" /></div>
<div class="previous_left"><img src="<?php echo UPLOAD_PATH.$previous_image['file']; ?>" alt="" width="190" height="127" /></div>
<div class="previous_right">
<div class="left_grey">
<p><?php echo $previous_buy[0]; ?></p>
<span style="text-align:center;">sold</span>
</div>
<div class="clear"></div>
<div class="left_green1">
<p>&pound;<?php echo $previous_details['discounted_price']; ?></p>
<span style="text-align:center;">instead of
&pound;<?php echo $previous_details['full_price']; ?></span>
</div>
</div>
</div>
<?php } 	// End while ?>
<!-- deal box ends -->
<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="30" /></div>
</div>
</div>
</div>
</div>
<?php include ('include/sidebar.php');?>
</div>
<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
<?php include ('include/footer.php'); ?>