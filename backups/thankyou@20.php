<?php 
error_reporting(E_ERROR && E_STRICT);
include("include/header.php");
session_start();
ob_start();
?>


<div class="deal_info">
<div class="top_about">

<p>Thankyou</p>


</div>
<div class="clear"></div>
<div class="midbg">
<div class="today_deal">

<h1>Thankyou for buying!</h1>
<pre>
<?php 
//var_dump($_POST);
//echo strtoupper(str_rand($length = 13, $seeds = 'alphanum'));
?>
</pre>
<?php 
	if ($_POST) {
		
		$custom = $_POST['custom'];

		$custom_expl = explode(',', $custom);
		$user_id = $custom_expl[0];
		$deal_id = $custom_expl[1];
		$trn_date = $custom_expl[2];
		$coupon_code = strtoupper(str_rand($length = 13, $seeds = 'alphanum'));
		
		$txn_id = $_POST['txn_id'];
		//$payment_status = $_POST['payment_status'];
		$payment_status = 'success';
		//$payer_email = $_POST['payer_email'];
		$qty = $_POST['item_number'];
		$payment_gross = $_POST['payment_gross'];
		$withdraw_status = 'received';
		
		$sql_trnsaction = "INSERT INTO ".TABLE_TRANSACTION." (tran_id,deal_id,transaction_status,amount,qty,transaction_date,user_id,withdraw_status,transaction_id,coupon_code) 
								VALUES(null,'$deal_id','$payment_status','$payment_gross','$qty','$trn_date','$user_id','$withdraw_status','$txn_id','$coupon_code')";
		mysql_query($sql_trnsaction);
		
		
	}
	
		/*$custom = "11,60,2011-12-14 18:00:48";
		$custom = $_POST['custom'];

		$custom_expl = explode(',', $custom);
		$user_id = $custom_expl[0];
		$deal_id = $custom_expl[1];
		$trn_date = $custom_expl[2];*/
		


?>
<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="40" /></div>
<div style="width: 702px; float: none; margin: 0 auto; background:#1f1f1f;"><img src="images/logo_bot.gif" alt="" width="207" height="108" /></div>
</div>
</div>
<div class="bot_about"></div>
</div>


</div>
</div>
</div>
</div>
<?php include ('include/footer.php'); ?>
