<!-- Multi deal pop up box start -->
<div style="display: none;">
	<div id="multi_deal_popup">
	<div class="deal_pop">
	<div class="top_pop"></div>
	<div class="clear"></div>
	<div class="mid_pop">
	<div class="pop_box">
	<div class="cross"><!-- <img src="images/cross.png" alt="" width="32" height="32" /> --></div>
	<div class="reset">Pick Your Deal</div>
	<div class="clear"></div>
	<div class="pop_deal">

		<?php
			$count = 1;
			$multi_deal_res = mysql_query($sql_is_multi);
			while ($multi_deal_row = mysql_fetch_array($multi_deal_res)) {  ?>
		<div class="pop_inner<?php echo ($count%2 == 0 ? '' : '1'); ?>">
		<div class="pop_left">
		<div><p><a href="<?php echo SITE_URL;?>customer-payment.php?item=<?php echo $today_res['deal_id']; ?>&mid=<?php echo $multi_deal_row['multi_deal_id']; ?>"><?php echo $multi_deal_row['multi_deal_item_name']; ?></a></p></div>
		<div><p><strong><?php echo $multi_deal_row['multi_deal_item_disc']; ?> </strong>Discount - Save <strong><?php echo getSettings(currency_symbol); ?><?php echo number_format($multi_deal_row['multi_deal_item_save'], 2); ?></strong></p></div>
		</div>
		<div class="pop_mid">
		<div style="margin: 8px 0;"><p>Price<br/><?php echo getSettings(currency_symbol); ?><?php echo number_format($multi_deal_row['multi_deal_item_price'], 2); ?> </p></div>
		</div>
		<div class="pop_right">
		<div><a class="buynow_btn2" href="<?php echo SITE_URL;?>customer-payment.php?item=<?php echo $today_res['deal_id']; ?>&mid=<?php echo $multi_deal_row['multi_deal_id']; ?>">Buy it now</a></div>
		</div>
		</div>

		<!-- <div class="pop_inner1">
		<div class="pop_left">
		<div><p><a href="#">Ten Personalised A4 Wall Mount Photo Calendars</a></p></div>
		<div><p>83.0% Discount - Save 149.90</p></div>
		</div>
		<div class="pop_mid">
		<div><p>Price<br/>30.90</p></div>
		</div>
		<div class="pop_right">
		<div><input type="submit" name="Submit" class="buynow_btn" value="Buy Now"/></div>
		</div>
		</div> -->
		<?php $count++; } ?>

	</div>
	</div>
	</div>
	<div class="bot_pop"></div>
	</div>
	</div>
</div>
<!-- Multi deal pop up box end -->