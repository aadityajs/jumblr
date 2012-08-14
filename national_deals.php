<?php include("include/header.php");?>

<?php
	if(!isset($_COOKIE["subscribe"]))
	header("location:".SITE_URL);
?>

<?php
error_reporting(E_ERROR && E_STRICT);
?>

<script src="js/countdown.js" type="text/javascript" charset="utf-8"></script>


<?php

 //echo $_COOKIE['subscribe'];

?>

<?php
// best_deal treated as National Deal here.
//if ($_GET['nd'] != "") {
	$deal_id = $_GET['nd'];

	$sql_today = "SELECT *, DATEDIFF(`deal_end_time`,`deal_start_time`) as date_diff FROM ".TABLE_DEALS." WHERE status >= 1 AND best_deal = 'y' AND deal_start_time <= '".date("Y-m-d G:i:s")."' AND deal_end_time >= '".date("Y-m-d G:i:s")."' LIMIT 0, 1";
	$today_res = mysql_fetch_array(mysql_query($sql_today));
	$no_of_deal = mysql_num_rows(mysql_query($sql_today));

	$sql_todays_buy = "SELECT SUM(qty) FROM ".TABLE_TRANSACTION." WHERE deal_id = ".$today_res['deal_id'];
	$total_buy = mysql_fetch_array(mysql_query($sql_todays_buy));

	$sql_todays_image = "SELECT * FROM ".TABLE_DEAL_IMAGES." WHERE deal_id = ".$today_res['deal_id'];
	//$todays_image = mysql_fetch_array(mysql_query($sql_todays_image));
	$todays_image_res = mysql_query($sql_todays_image);


//}
?>
<div class="topbg">
<ul>
<li><p><strong>DEAL INFORMATION</strong></p></li>
<li><img src="images/spacer.gif" alt="" width="160" height="1" /></li>
<li>Recommend This Deal By:</li>
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

<?php include 'recommendation_popup.php';?>

<div class="clear"></div>
<?php if($no_of_deal > 0) { ?>
<div class="midbg">


<div class="today_deal">

<div style="height: auto;"></div>
	  <div class="clear"><img src="images/spacer.gif" alt="" width="1" height="1" /></div>

   <?php if ($_GET['action'] == "sold") { ?>
   	<div class="tab_button1"></div>
   <?php } else { ?>
   	<a href="<?php echo SITE_URL; ?>customer-payment.php?item=<?php echo $today_res['deal_id']; ?>">
   		<div class="tab_button"></div>
   	</a>
   <?php } ?>

<!--

<div style="height: auto;"><?php if ($_GET['action'] != "sold") { ?><a href="<?php echo SITE_URL; ?>customer-payment.php?item=<?php echo $today_res['deal_id']; ?>"><?php } ?><h1><?php echo strip_tags($today_res['title']); ?></h1><?php if ($_GET['action'] != "sold") { ?></a><?php } ?></div>
	  <div class="clear"><img src="images/spacer.gif" alt="" width="1" height="1" /></div>
	  <div class="<?php if ($_GET['action'] == "sold") { echo "tab_button1"; } else {echo "tab_button"; } ?>"><span>&pound;<?php echo strip_tags($today_res['discounted_price']); ?></span><a href="<?php echo SITE_URL; ?>customer-payment.php?item=<?php echo $today_res['deal_id']; ?>"><?php if ($_GET['action'] != "sold") { ?><span class="tab_buy">&nbsp;&nbsp;&nbsp;</span><?php } ?></a></div>


 -->

	  <div class="deal_left" style="margin-top: 5px;">

	  <div class="pric"><span><?php echo getSettings(currency_symbol); ?><?php echo ($today_res['discounted_price']); ?></span></div>

	  <div class="blue_box" style="margin-top:55px;">
	  <div class="timer_box2">
	  <ul>
	  <li><p>Value<br/><span><?php echo getSettings(currency_symbol);?><?php echo $today_res['full_price']; ?></span></p></li>
	  <li><p>Discount <br/><span><?php echo $today_res['discount']; ?></span></p></li>
	  <li style="border-right: 0;"><p>Saving<br/><span><?php echo getSettings(currency_symbol);?><?php echo $today_res['savings']; ?></span></p></li>
	  </ul>
	  </div>
	  </div>
	 <!--   <div class="pric"><span>&pound;<?php echo strip_tags($today_res['discounted_price']); ?></span></div>

	  <div class="blue_box"  style="margin-top:55px;">
	  <div class="timer_box2">
	  <ul>
	  <li><p>Value<br/><span>&pound;<?php echo strip_tags($today_res['full_price']); ?></span></p></li>
	  <li><p>Discount <br/><span><?php echo intval($today_res['discounted_price']*100/$today_res['full_price']); ?>%</span></p></li>
	  <li style="border-right: 0;"><p>Saving<br/><span>&pound;<?php echo strip_tags($today_res['full_price'] - $today_res['discounted_price']); ?></span></p></li>
	  </ul>
	  </div>
	  </div> -->
	  <div class="clear"><img src="images/spacer.gif" alt="" width="1" height="4" /></div>
	<?php //if ($_GET['action'] == "view") { ?>
	  <div class="blue_box">
	  <div class="timer_box1">
	  <ul>
	  <li><img src="images/gift.gif" alt="" width="42" height="35" /></li>
	  <li><p><a id="gift" href="#giftdiv" >Buy it for a friend!</a></p></li>
	  </ul>
	  </div>
	  </div>
	<?php //} ?>

	<div style="display: none;">
		<div id="giftdiv" style="width:701px;height:px;overflow:auto; background-color: transparent;">
	<?php if (isset($_SESSION['user_id'])) {?>

	<form action="<?php echo SITE_URL; ?>customer-payment.php?item=<?php echo $today_res['deal_id']; ?>" name="frmgift" method="post">
		<div class="deal_recomm">
				<div class="top_recomm">
				<p>Buy it for a friend!</p>
				</div>
				<div class="clear"></div>
				<div style="border-bottom: 3px solid #7fd7fb;"></div>
				<div class="clear"></div>
				<div class="recomm_mid">

				<div class="invita_deal">
				<div><p>Friend's name:</p></div>
				<div class="clear"></div>
				<div class="massage">
				<div class="massage_left"><input name="frndname" type="text" class="mailbox1"  style="width: 430px;"/></div>
				</div>
				</div>

				<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>

				<div class="invita_deal">
				<div><p>Friend's email address:</p></div>
				<div class="clear"></div>
				<div class="massage">
				<div class="massage_left"><input name="frndemail" type="text" class="mailbox1" style="width: 430px;"/></div>
				</div>
				</div>

				<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>

				<div class="invita_deal">
				<div><p>Your Message:</p></div>
				<div class="clear"></div>
				<div class="massage">
				<div class="massage_left"><textarea name="frndmsg" class="textarea2"></textarea></div>
				</div>
				</div>
				<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
				<div style="width: auto; margin: 0 230px 0 0; float:right;">
					<input type="submit" name="Submit" class="tellbtn" value="Send as Gift"/>
					<!-- href="<?php echo SITE_URL; ?>customer-payment.php?item=<?php echo $today_res['deal_id']; ?>&gift=gifting" -->
				</div>

				<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>

				</div>
				<div class="clear"></div>
				<div style="border-bottom: 3px solid #7fd7fb;"></div>
				<div class="recomm_bot"></div>
				</div>
		</form>
		<?php } else { ?>
		<div class="top_recomm">
			<p>Please login to Gift deals to friends.</p>
		</div>
		<div class="clear"></div>
		<div style="border-bottom: 3px solid #7fd7fb;"></div>
		<div class="recomm_bot"></div>
		<?php } ?>
		</div>
</div>

<?php //var_dump($today_res);
	 //echo '++++'.$today_res['date_diff'];
?>


<?php if ($_GET['action'] != "sold") { ?>
<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="4" /></div>
	  <div class="blue_box">
	  <div><h3>Time left to buy this
	  	<a href="javascript: showDetails(10)" onmouseover="return overlib('&lt;font class=bodytext&gt;<div class=tiptool><div class=tip_top></div><div class=arrowright2></div><div class=tip_mid><ul><li>A deal ends when the clock strikes &Prime;00 00 00&Prime;, unless the deal sells out early. For more information, see our Universal Fine Print.</li></ul></div><div class=tip_bot></div></div>&lt;/font&gt;',BORDER,'1');" onMouseOut="nd();"><img src="images/question1.gif" alt="" width="14" height="13"/></a>
	   deal:</h3></div>

	<?php
	  //if($today_res['date_diff'] != 0)
	 // {
	  ?>
	  <div class="timer_box">

	  <?php



	$time1=explode("-",$today_res['deal_end_time']);
	$year=$time1[0];
	$month=$time1[1];
	$time2=explode(" ",$time1[2]);
	$day=$time2[0];
	$time4=explode(":",$time2[1]);
	$hour_deal=$time4[0];
	$minute_deal=$time4[1];
	$secon_deal=$time4[2];
	$time=$hour_deal.":".$minute_deal.":".$secon_deal;
	$last_deal_time=$month."/".$day."/".$year." ".$time;
	//echo $last_deal_time;
	//exit;

	$time_now=date("m/d/Y H:i:s");



	  ?>

	  <script language="javascript">
	  <?php
	 // if($today_res['date_diff'] != 0)
	 // {
	  ?>
	var cd<?php echo $today_res['deal_id'];?>a   = new countdown('cd<?php echo $today_res['deal_id'];?>a');
	cd<?php echo $today_res['deal_id'];?>a.Div   = "clock<?php echo $today_res['deal_id'];?>a";
	cd<?php echo $today_res['deal_id'];?>a.TargetDate = "<?php echo $last_deal_time;?>";
	cd<?php echo $today_res['deal_id'];?>a.CurDate  = "<?php echo $time_now;?>";
	cd<?php echo $today_res['deal_id'];?>a.DisplayFormat = "<span  style='margin: 0 0 0 5px;'>%%D%%</span>";
	<?php
	//}
	?>

	var cd<?php echo $today_res['deal_id'];?>b			= new countdown('cd<?php echo $today_res['deal_id'];?>b');
	cd<?php echo $today_res['deal_id'];?>b.Div			= "clock<?php echo $today_res['deal_id'];?>b";
	cd<?php echo $today_res['deal_id'];?>b.TargetDate	= "<?php echo $last_deal_time;?>";
	cd<?php echo $today_res['deal_id'];?>b.CurDate		= "<?php echo $time_now;?>";
	cd<?php echo $today_res['deal_id'];?>b.DisplayFormat	= "<span  style='margin: 0 0 0 5px;'>%%H%%</span>";

	var cd<?php echo $today_res['deal_id'];?>c			= new countdown('cd<?php echo $today_res['deal_id'];?>c');
	cd<?php echo $today_res['deal_id'];?>c.Div			= "clock<?php echo $today_res['deal_id'];?>c";
	cd<?php echo $today_res['deal_id'];?>c.TargetDate	= "<?php echo $last_deal_time;?>";
	cd<?php echo $today_res['deal_id'];?>c.CurDate		= "<?php echo $time_now;?>";
	cd<?php echo $today_res['deal_id'];?>c.DisplayFormat	= "<span  style='margin: 0 0 0 5px;'>%%M%%</span>";

	var cd<?php echo $today_res['deal_id'];?>d			= new countdown('cd<?php echo $today_res['deal_id'];?>d');
	cd<?php echo $today_res['deal_id'];?>d.Div			= "clock<?php echo $today_res['deal_id'];?>d";
	cd<?php echo $today_res['deal_id'];?>d.TargetDate	= "<?php echo $last_deal_time;?>";
	cd<?php echo $today_res['deal_id'];?>d.CurDate		= "<?php echo $time_now;?>";
	cd<?php echo $today_res['deal_id'];?>d.DisplayFormat	= "<span  style='margin: 0 0 0 5px;'>%%S%%</span>";

</script>


	  <ul>
	  <?php
	 // if($today_res['date_diff'] != 0)
	  //{
	  ?>
		  <li class="hours"><p style="padding:5px 0 0 0;"><span class="txt2" id="clock<?php echo $today_res['deal_id'];?>a"></span><br/><span>Days</span></p></li>
		<?php
		//}
		?>
		  <li class="hours"><p style="padding:5px 0 0 0;"><span class="txt2" id="clock<?php echo $today_res['deal_id'];?>b"></span><br/><span>Hrs.</span></p></li>
		  <li class="hours"><p style="padding:5px 0 0 0px;"><span class="txt2" id="clock<?php echo $today_res['deal_id'];?>c"></span><br/><span>Min.</span></p></li>
		  <li class="hours"><p style="padding:5px 0 0 0px;"><span class="txt2" id="clock<?php echo $today_res['deal_id'];?>d"></span><br/><span>Sec.</span></p></li>
	  </ul>



 <script language="javascript">
 <?php
	 // if($today_res['date_diff'] != 0)
	 // {
	  ?>
 				cd<?php echo $today_res['deal_id'];?>a.Setup();
				<?php
				//}
				?>
				cd<?php echo $today_res['deal_id'];?>b.Setup();
				cd<?php echo $today_res['deal_id'];?>c.Setup();
				cd<?php echo $today_res['deal_id'];?>d.Setup();
			</script>

	  </div>
	<?php //} else { ?>
<!--
	<div class="timer_box" style="background:url(images/timmer_bg2.png) 65% top no-repeat; width:188px;">

		  <?php



		$time1=explode("-",$today_res['deal_end_time']);
		$year=$time1[0];
		$month=$time1[1];
		$time2=explode(" ",$time1[2]);
		$day=$time2[0];
		$time4=explode(":",$time2[1]);
		$hour_deal=$time4[0];
		$minute_deal=$time4[1];
		$secon_deal=$time4[2];
		$time=$hour_deal.":".$minute_deal.":".$secon_deal;
		$last_deal_time=$month."/".$day."/".$year." ".$time;
		//echo $last_deal_time;
		//exit;

		$time_now=date("m/d/Y H:i:s");



		  ?>

		  <script language="javascript">

		var cd<?php echo $today_res['deal_id'];?>a   = new countdown('cd<?php echo $today_res['deal_id'];?>a');
		cd<?php echo $today_res['deal_id'];?>a.Div   = "clock<?php echo $today_res['deal_id'];?>a";
		cd<?php echo $today_res['deal_id'];?>a.TargetDate = "<?php echo $last_deal_time;?>";
		cd<?php echo $today_res['deal_id'];?>a.CurDate  = "<?php echo $time_now;?>";
		cd<?php echo $today_res['deal_id'];?>a.DisplayFormat = "<span  style='margin: 0 0 0 5px;'>%%D%%</span>";


		var cd<?php echo $today_res['deal_id'];?>b			= new countdown('cd<?php echo $today_res['deal_id'];?>b');
		cd<?php echo $today_res['deal_id'];?>b.Div			= "clock<?php echo $today_res['deal_id'];?>b";
		cd<?php echo $today_res['deal_id'];?>b.TargetDate	= "<?php echo $last_deal_time;?>";
		cd<?php echo $today_res['deal_id'];?>b.CurDate		= "<?php echo $time_now;?>";
		cd<?php echo $today_res['deal_id'];?>b.DisplayFormat	= "<span  style='margin: 0 0 0 5px;'>%%H%%</span>";

		var cd<?php echo $today_res['deal_id'];?>c			= new countdown('cd<?php echo $today_res['deal_id'];?>c');
		cd<?php echo $today_res['deal_id'];?>c.Div			= "clock<?php echo $today_res['deal_id'];?>c";
		cd<?php echo $today_res['deal_id'];?>c.TargetDate	= "<?php echo $last_deal_time;?>";
		cd<?php echo $today_res['deal_id'];?>c.CurDate		= "<?php echo $time_now;?>";
		cd<?php echo $today_res['deal_id'];?>c.DisplayFormat	= "<span  style='margin: 0 0 0 5px;'>%%M%%</span>";

		var cd<?php echo $today_res['deal_id'];?>d			= new countdown('cd<?php echo $today_res['deal_id'];?>d');
		cd<?php echo $today_res['deal_id'];?>d.Div			= "clock<?php echo $today_res['deal_id'];?>d";
		cd<?php echo $today_res['deal_id'];?>d.TargetDate	= "<?php echo $last_deal_time;?>";
		cd<?php echo $today_res['deal_id'];?>d.CurDate		= "<?php echo $time_now;?>";
		cd<?php echo $today_res['deal_id'];?>d.DisplayFormat	= "<span  style='margin: 0 0 0 5px;'>%%S%%</span>";

	</script>


		  <ul>

			  <li class="hours"><p style="padding:5px 0 0 0;"><span class="txt2" id="clock<?php echo $today_res['deal_id'];?>b"></span><br/><span>Hrs.</span></p></li>
			  <li class="hours"><p style="padding:5px 0 0 30px;"><span class="txt2" id="clock<?php echo $today_res['deal_id'];?>c"></span><br/><span>Min.</span></p></li>
			  <li class="hours"><p style="padding:5px 0 0 40px;"><span class="txt2" id="clock<?php echo $today_res['deal_id'];?>d"></span><br/><span>Sec.</span></p></li>
		  </ul>



	 <script language="javascript">
	 <?php
		  if($today_res['date_diff'] != 0)
		  {
		  ?>
	 				cd<?php echo $today_res['deal_id'];?>a.Setup();
					<?php
					}
					?>
					cd<?php echo $today_res['deal_id'];?>b.Setup();
					cd<?php echo $today_res['deal_id'];?>c.Setup();
					cd<?php echo $today_res['deal_id'];?>d.Setup();
				</script>

		  </div>
-->
	<?php //} ?>
	  </div>
	  <?php } 	// action == view end?>

	  <div class="clear"><img src="images/spacer.gif" alt="" width="1" height="4" /></div>

	  <div class="blue_box">
	<div class="brought" style="border-bottom:0px;">
   <div class="font24px" >
   	<?php if ($total_buy[0] >= $today_res['min_coupons']) {

   		if ($_GET['action'] != "sold") {
   			if($total_buy[0] != 0) {echo $total_buy[0].' Bought!';} else {echo "1 Bought!";}
   		 	}
   		//if ($_GET['action'] == "sold") { echo "Deal Completed!";}
   	} else {
   		if ($_GET['action'] != "sold") {
   		if($total_buy[0] != 0) {echo $total_buy[0].' Bought!';} else {echo "1 Bought!";}
   		 	}
   		//if ($_GET['action'] == "sold") { echo "Deal Completed!";}
   	}
   	?>
	  <?php /*if ($_GET['action'] != "sold") {
   			if($total_buy[0] != 0) {echo $total_buy[0].' Bought!';} else {echo "Not Yet Bought!";}
   		 	}*/
   		if ($_GET['action'] == "sold") { echo "Deal Completed!";}

   		?>
<style type="text/css">

.ui-progressbar { height:6px; text-align: left; overflow: hidden; width: 100%;}
.ui-progressbar {margin: -1px; height:100%;
	/*background: url(images/redAerrow.png) center left no-repeat !important;*/
}
.ui-widget-content {
    border: 1px solid #c3c3c3;
    color: #222222;
    padding: 3px;
}
.ui-progressbar-value{
	border: 1px solid #9a9347 !important;
	background: #edeb6e !important;
	margin: -1px; height:100%;
	/* url(images/redAerrow.png) center right no-repeat  */
}
.timer_icon{
	background: url(images/timer_icon.png ) center center no-repeat;
	width: 18px;
	height: 31px;
	position: absolute;
	margin: -8px 0 0 190px;
}
</style>


   </div>
	<div>
	<ul>
	<li><?php if ($_GET['action'] != "sold") { ?><img src="images/icon_tick.png" alt="" width="30" height="28" style="margin: 0px -15px 0 15px; float:left;"/>&nbsp;&nbsp;&nbsp;&nbsp; Deal is on!<?php } ?></li>
	<li style="padding: 0 0 0 0;">


		<?php if ($total_buy[0] < $today_res['min_coupons']) {
			//if ($_GET['action'] != "sold") {
			?>

			<!--
				<script>
				$(function() {
					$( "#progressbar" ).progressbar({
						value: <?php if ($total_buy[0] != 0) {echo $total_buy[0]; } else {echo '0';} ?>,
						max: <?php echo $today_res['max_coupons']; ?>
					});
				});
			</script>
			<?php echo intval($today_res['min_coupons'] - $total_buy[0]) ; ?> More deals need to buy to active the deal
			<div class="demo" style="width:87%;">
                <div class="timer_icon"></div>
				<div id="progressbar" style="height:8px;"></div>
	             <div class="main_box" style="width:200px;">
                	 <p style="float:left; font:bold 14px/28px Tahoma,Arial,Helvetica,sans-serif; color:#414141; padding:0px;"><?php echo $today_res['min_coupons']; ?></p>
                    <p style="float:right; font:bold 14px/28px Tahoma,Arial,Helvetica,sans-serif; color:#414141; padding:0 12px 0 0;"><?php echo $today_res['max_coupons']; ?></p>
                 <div class="clear"><img src="images/spacer.gif" alt="" width="1" height="4" /></div>
                </div>

			</div> <!-- End progressbar -->

			<?php
		//	}
			if ($_GET['action'] == "sold") {
		 	if($total_buy[0] != 0) {echo $total_buy[0].' Bought!';} else {echo "Not Yet Bought!";}
			}
		} else {
			//if ($_GET['action'] != "sold") { echo 'Deal is on!';}
			if ($_GET['action'] == "sold") {
		 	if($total_buy[0] != 0) {echo $total_buy[0].' Bought!';} else {echo "Not Yet Bought!";}
		}
   		?>

   		<?php /*if ($_GET['action'] != "sold") { echo "Deal is on!";}
			if ($_GET['action'] == "sold") {
		 	if($total_buy[0] != 0) {echo $total_buy[0].' Bought!';} else {echo "Not Yet Bought!";} */
 		} ?>

	</li>
	</ul>
	</div>
     </div>
	  </div>
	   <div class="clear"><img src="images/spacer.gif" alt="" width="1" height="4" /></div>


	  <div class="blue_box">
	  <div class="font_11">Share with friends!</div>
	<div class="timer_box3" style="border-bottom:0px;">
	<ul>
	<li><img src="images/email.png" alt="" width="18" height="18" /></li>
	<li><a id="various2" href="#inline1">Email</a></li>
	<!-- <li><img src="images/facebook.png" alt="" width="19" height="18" /></li> -->
	<li><a name="fb_share" type="icon_link">Facebook</a>
		<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share"
		        type="text/javascript">
		</script>
	</li>
	<!-- <li><img src="images/twitter.png" alt="" width="19" height="18" /></li> -->
	<li>
		<a href="https://twitter.com/share" class="twitter-share-button" data-text="Twitter" data-via="unifiedinfotech" data-count="none"></a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	</li>
	</ul>
     </div>
	  </div>
 	<?php if ($_GET['action'] == "sold") { ?>
 	<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="4" /></div>
	<div style="float: none; margin: 0 13px; width: 229px;"><a href="#"><img src="images/sold_btn.gif" alt="" width="229" height="96" border="0" /></a></div>
	  <?php } ?>
	  </div>
	  <div class="box683_right">
  	  <div>
  	  	<!-- <img src="<?php echo UPLOAD_PATH.$todays_image['file']; ?>" alt="" width="439" height="293" /> -->

  	  	<?php //echo '<pre>'.print_r($todays_image, true).'</pre>'; ?>


			<div id="gallery" class="ad-gallery">
		      <div class="ad-image-wrapper">
		      </div>
		      <div class="ad-controls">
		      </div>
		      <div class="ad-nav">
		        <div class="ad-thumbs" style="width:394px; margin-left:12px;">
		          <ul class="ad-thumb-list">

					<?php
						while ($todays_image = mysql_fetch_array($todays_image_res)) {
							$todays_image_count++;
					?>

		            <li>
		              <a href="<?php echo UPLOAD_PATH.$todays_image['file']; ?>">
		                <img src="<?php echo UPLOAD_PATH.$todays_image['file']; ?>" class="image0" width="90px" height="60px">
		              </a>
		            </li>
		            <?php } ?>

		            <li>
		              <a href="gallery-images/10.jpg">
		                <img src="gallery-images/thumbs/t10.jpg" class="image1">
		              </a>
		            </li>
		            <li>
		              <a href="gallery-images/11.jpg">
		                <img src="gallery-images/thumbs/t11.jpg" class="image2">
		              </a>
		            </li>
		            <li>
		              <a href="gallery-images/12.jpg">
		                <img src="gallery-images/thumbs/t12.jpg" class="image3">
		              </a>
		            </li>
		            <li>
		              <a href="gallery-images/13.jpg">
		                <img src="gallery-images/thumbs/t13.jpg" class="image4">
		              </a>
		            </li>
		            <li>
		              <a href="gallery-images/14.jpg">
		                <img src="gallery-images/thumbs/t14.jpg" class="image5">
		              </a>
		            </li>
		            <li>
		              <a href="gallery-images/2.jpg">
		                <img src="gallery-images/thumbs/t2.jpg" class="image6">
		              </a>
		            </li>
		            <li>
		              <a href="gallery-images/3.jpg">
		                <img src="gallery-images/thumbs/t3.jpg" class="image7">
		              </a>
		            </li>
		            <li>
		              <a href="gallery-images/4.jpg">
		                <img src="gallery-images/thumbs/t4.jpg" class="image8">
		              </a>
		            </li>
		            <li>
		              <a href="gallery-images/5.jpg">
		                <img src="gallery-images/thumbs/t5.jpg" class="image9">
		              </a>
		            </li>
		            <li>
		              <a href="gallery-images/6.jpg">
		                <img src="gallery-images/thumbs/t6.jpg" class="image10">
		              </a>
		            </li>
		            <li>
		              <a href="gallery-images/7.jpg">
		                <img src="gallery-images/thumbs/t7.jpg" class="image11">
		              </a>
		            </li>
		            <li>
		              <a href="gallery-images/8.jpg">
		                <img src="gallery-images/thumbs/t8.jpg" class="image12">
		              </a>
		            </li>
		            <li>
		              <a href="gallery-images/9.jpg">
		                <img src="gallery-images/thumbs/t9.jpg" class="image13">
		              </a>
		            </li>


		          </ul>
		        </div>
		      </div>

		    </div>


  	  </div>
  <div class="highlights">
		<?php if ($_GET['action'] != "sold") { ?><a href="<?php echo SITE_URL; ?>customer-payment.php?item=<?php echo $today_res['deal_id']; ?>"><?php } ?><h1 style="padding: 0;"><span style="color:#5b8f32; text-transform:uppercase;">Todays deal : </span><?php echo strip_tags($today_res['title']); ?></h1><?php if ($_GET['action'] != "sold") { ?></a><?php } ?>

    <!--
    	<div style="width:200px; float: left; margin: 0 auto;">
     <?php //echo $today_res['highlights']; ?>

    </div>
    <div style="width:196px; float: right; margin: 0 auto;">

     <?php //echo $today_res['fineprint']; ?>

    </div>

     -->
  </div>
  <div>&nbsp;</div>
  <div class="main_box">
  	 <ul style="float:left; width:49%; padding-bottom: 15px;">
     	<li style="padding:0px 0 0 10px; list-style-image:url(images/bullet_new.gif); list-style-position: inside; font: bold 11px/13px Arial, Helvetica, sans-serif; color: #000;">Get amazing deals everyday</li>
        <li style="padding:17px 0 0 10px; list-style-image:url(images/bullet_new.gif); list-style-position: inside; font: bold 11px/13px Arial, Helvetica, sans-serif; color: #000;">Shop online the smarter way</li>
     </ul>
      <ul style="float:right; width:49%; padding-bottom: 15px;">
     	<li style="padding:0px 0 0 10px; list-style-image:url(images/bullet_new.gif); list-style-position: inside; font: bold 11px/13px Arial, Helvetica, sans-serif; color: #000;">We have deals near you</li>
        <li style="padding:17px 0 0 10px; list-style-image:url(images/bullet_new.gif); list-style-position: inside; font: bold 11px/13px Arial, Helvetica, sans-serif; color: #000;">Enjoy life like never before</li>
     </ul>
  </div>
</div>
</div>

<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="4" /></div>
</div>
<?php
}
else
{
?>
	<div class="midbg">
	<div class="today_deal">



	<a id="nodeal_info" href="#more_info_div">

	<div class="tab_button_more_info" style="margin-top: 410px;">
	<ul>
	<li></li>
	<li><img src="images/spacer.gif" alt="" width="32" height="1" /></li>
	<li style="margin: 7px 0;"> <!-- <img src="images/more_info.png" alt="" width="279" height="51" border="0" /> --> </li>
	</ul>
	</div>
	</a>
	<div class="coming_soon">
	  <div class="coming_soon_top"></div>
	  <div class="coming_soon_mid">
	  <div class="coming_left">
	   <img src="images/coming_small10.gif" alt="" width="322" height="224"/></div>
	  <div class="coming_right">
	 <div>
	 <p>COMING SOON: THE BEST DEALS THAT NATIONAL DEAL HAS TO OFFER</p>
	 </div>
	 <div style="margin:20px auto;">
	 Discover your city upto 90% off See your city in a brand new light with GeeLaza. New and diverse deals on spa, beauty, leisure, restaurents and sport bring GeeLaza customers excitement for upto 90% less, every single day. But it's not just about presenting deals, GeeLaza...</div>
	 <div class="clear"></div>
	 <div class="sendbtn"><a id="nodeal_info_btn" href="#more_info_div"></a></div>
	 <div style="float: right; margin: 4px auto; width: 90px; font: bold 22px/24px Arial, Helvetica, sans-serif; color:#3d3a3a;">- 90%</div>
	  </div>
	  </div>
	  <div class="coming_soon_bot"></div>
	  </div>

	  <div style="font: bold 28px/30px Arial, Helvetica, sans-serif; color: #000000; padding: 4px 0 0 14px;">COMING SOON: THE BEST DEALS THAT NATIONAL DEAL HAS TO OFFER</div>
	  <div class="clear"><img src="images/spacer.gif" alt="" width="1" height="1" /></div>

		<div class="pric"><span><?php echo getSettings(currency_symbol);?>10</span></div>
	  <div class="deal_left">
	   <div class="blue_box" style="margin-top: 50px;">
	  <div class="timer_box2">
	  <ul>
	  <li style="width: 50%"><h3>Discount<br/><span>90%</span></h3></li>
	  <li style="border-right: 0;"><h3>Savings<br/><span><?php echo getSettings(currency_symbol);?>?90</span></h3></li>
	  </ul>
	  </div>
	  </div>
	  <div class="clear"><img src="images/spacer.gif" alt="" width="1" height="4" /></div>
	   <div style="width: 260px; float: none; margin: 10px 10px;">
	   <div style="margin: 10px auto;"><img src="images/bestprice.gif" alt="" width="250" height="317" /></div>
	   </div>
	   </div>

	   <div class="box683_right">
		  <div><img src="images/coming_soon.jpg" alt="" width="401" height="342" style="margin-top: -60px;"/></div>
		  <div class="highlights">
		  <div class="highlights09">
		    <ul>
		      <li style="background:none; margin: 10px auto;">
		        <h2>Highlights</h2>
		      </li>
		      <li>The best deals in your city searched out by our expert team</li>
		      <li>A wide range of fun things to do, places to go, restaurants to visit, beauty treatments to enjoy...and much more</li>
		    </ul>
			</div>
			<div class="highlights10">
		    <ul>
		       <li style="background:none; margin: 10px auto;">
		        <h2>Fine Print</h2>
		      </li>
		      <li>Simply register and receive an email the morning our amazing offers go live</li>
			  <li>Remember,they are only available to buy for 24hrs. so snap them up quick!</li>
		    </ul>
			</div>
		  </div>
		</div>


</div>
<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="4" /></div>
</div>

<div style="display: none;">
	<div id="more_info_div" >


		<div style="border: 0px solid red;">
		<div class="moreinfo_top"></div>
		<div class="moreinfo_mid">
		<div class="info_midbg">
		<div><h1>Never miss a deal again</h1></div>
		<div class="clear"></div>
		<div style="float: left; width: 216px; margin: 0 auto;"><img src="images/coming_small.gif" alt="" width="216" height="167"/></div>
		<div style="float: right; width: 530px; margin: 30px auto;">
		<div class="soon">COMING SOON</div>
		<div><p>Discover your city for up to 90% off. See your city in a brand new light with GeeLaza. We will provide with deals that are simply too good to be missed. We have revolutionised the way people buy deals online. GeeLaza brings exciting deals up to 90% off every single day. All deals on GeeLaza are the best of their kind. Subscribe today to never miss a deal again and be the first to hear about our new deals.</p></div>
		</div>
		<div class="clear"></div>
		<div class="subs_box">
		<div class="top_cur"></div>
		<div class="mid_cur">
		<div>
		<p>Subscribe to GeeLaza newsletters and find out when this or similar deal is
		available again. Subscribing is not registering so to get full access and take advantage of the GeeLaza user account, register by clicking <a href="<?php echo SITE_URL.'customer-register.php'; ?>">here</a>.</p>
		</div>
		<div>

		<?php
			if ($_POST['email_subs_btn2'] && $_POST['email_subs_btn2'] == "Submit") {
						$subs_email = $_POST['email_subs2'];
						$date = date("Y-m-d");

						if (!empty($_GET['nd'])) {
							$buttonlink = SITE_URL.'national_deals.php?nd=National%20deals';
						}
						else {
							$buttonlink = SITE_URL.'index.php?city='.$city;
						}

					$chkNewsletterSql = mysql_query("SELECT email FROM ".TABLE_NEWSLETTER." WHERE email = '".$subs_email."' AND city = ".$city);
					//mysql_num_rows(mysql_query($chkNewsletterSql));
					if (mysql_num_rows($chkNewsletterSql) <= 0) {

						$subscribe_sql = "INSERT INTO ".TABLE_NEWSLETTER." (ns_id, email, city, status, date_added) VALUES (NULL, '$subs_email', '$city', 1, '$date')";
						mysql_query($subscribe_sql);
						header('location:'.SITE_URL.'?newssucc=You have successfully subscribed to GeeLaza UK newsltter for '.$row_nodeal_city[city_name].' with the following email address: '.$subs_email);
					} else {
						header('location:'.SITE_URL.'?errnewssucc=The email address '.$subs_email.' is already subscribed to GeeLaza UK newsletter for '.$row_nodeal_city[city_name].'.');
					}

			}

		?>


		<form name="frm_email_subs2" method="post" onsubmit="javascript: return chk_email_subs2();">
		  <table width="100%" align="center" border="0" cellspacing="3" cellpadding="3" class="submit_box">
		    <tr>
		      <td width="31%">Your email address</td>
		      <td width="69%"><strong>The GeeLaza Promise</strong></td>
		    </tr>
		    <tr>
		      <td><input type="text" class="fieldbg_30" name="email_subs2" id="email_subs2" value="Enter your email address" onclick="this.value=''"/><div id="email_subs_error_loc2" class="error_orange"></div></td>
		      <td>If you have any issue with using GeeLaza, please contact us and we promise we will make it right</td>
		    </tr>
		    <tr>
		      <td><input type="submit" class="log_in" name="email_subs_btn2" id="email_subs_btn2" value="Submit"/></td>
		      <td>&nbsp;</td>
		    </tr>
		  </table>
		  </form>

				<script type="text/javascript">
					function chk_email_subs2() {
						var email = document.getElementById('email_subs2').value;
						//alert(email);
						if (email == "" || email == "Enter your email address") {
							document.getElementById('email_subs_error_loc2').innerHTML = "Enter your email address";
							return false;
						}
					}
				</script>

		</div>
		</div>
		<div class="bot_cur"></div>
		</div>
		</div>
		</div>
		<div class="moreinfo_bot"></div>
		</div>


	</div>
</div>



<!-- ###################################################################### -->

<?php
}
?>
<div class="botbg">

<div style="width: 200px;  height: auto; margin: 5px 0 0 15px ; z-index: 1000; float: right;">

<div style="float: right; width: 80px; display:inline-block; margin-right: 10px;">
<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
<a href="https://twitter.com/share" class="twitter-share-button"
	data-via="santanu_patra" data-lang="en" data-related="santanu_patra"
	data-hashtags="santanu_patra">Tweet</a>
</div>

<div  id='fb-root' style="float:right; margin-right: 0; width: 80px; height: 20px;">
<b:if cond='data:blog.pageType == "item"'>
<script>
window.fbAsyncInit = function() {
FB.init({appId: '197123393709565', status: true, cookie: true,
xfbml: true});
};
(function() {
var e = document.createElement('script'); e.async = true;
e.src = document.location.protocol +
'//connect.facebook.net/en_US/all.js';
document.getElementById('fb-root').appendChild(e);
}());
</script>

<fb:like action='like' colorscheme='light' expr:href='data:Post.url'
layout='button_count' show_faces='true' width='80'/>
</b:if>
</div>


<div class="clear"></div>
</div>

</div>
</div>
<div class="clear"></div>

<?php if($no_of_deal > 0) { ?>
<div id="dealbg_bot">

			<script type="text/javascript" language="javascript">
	<!--
		function show_tab(ID)
		{
			for(i=1; i<=5; i++)
			{
				document.getElementById("myaccount_"+i).style.display = "none";
				/*document.getElementById("tab_"+i).style.backgroundPosition = "";
				document.getElementById("stab_"+i).style.backgroundPosition = "";
				document.getElementById("stab_"+i).style.color = "";
				document.getElementById("tab_"+i).style.color = "";*/
				$('#tab_'+i).removeClass('here');
				/*if (i == 2) {
					document.getElementById("myaccount_"+i+"_b").style.display = "none";
					}*/

			}
			document.getElementById("myaccount_"+ID).style.display = "block";
			/*document.getElementById("tab_"+ID).style.backgroundPosition = "0% -29px";
			document.getElementById("stab_"+ID).style.backgroundPosition = "100% -29px";
			document.getElementById("tab_"+ID).style.color = "#000";
			document.getElementById("stab_"+ID).style.color = "#000";*/

			$('#tab_'+ID).addClass('here');

			/*if (ID == 2) {
				document.getElementById("myaccount_"+ID+"_b").style.display = "block";
				}*/

		}

		//-->
	</script>




<div style="width:685px; float: left; margin: 0  0 0 8px;">

   	<div class="tabs">
		<a href="javascript: show_tab(1);" id="tab_1" style="text-decoration: none; margin-right: 32px;">Deal information</a>
		<a href="javascript: show_tab(2);" id="tab_2" style="text-decoration: none; margin-right: 32px;">Highlights</a>
		<a href="javascript: show_tab(3);" id="tab_3" style="text-decoration: none; margin-right: 32px;">Fine Prints</a>
		<a href="javascript: show_tab(4);" id="tab_4" style="text-decoration: none; margin-right: 32px;">Company</a>
		<a href="javascript: show_tab(5);" id="tab_5" style="text-decoration: none; margin-left: 10px;">Postage</a>
		<!-- <a href="javascript: show_tab(6);" id="tab_6">Temp</a> -->

    </div>

    <!--<div class="TabbedPanels">
      <ul>
        <li><a href="javascript: show_tab(1);" id="tab_1">My Order</a></li>
        <li><a href="javascript: show_tab(2);" id="tab_2">My Credit</a></li>
        <li><a href="javascript: show_tab(3);" id="tab_3">General</a></li>
        <li><a href="javascript: show_tab(4);" id="tab_4">Security</a></li>
        <li><a href="javascript: show_tab(5);" id="tab_5">Subscriptions</a></li>
       </ul>
	 </div>-->

    <div class="TabbedPanels1 dealbg_right" id="myaccount_1">
		<?php echo $today_res['offer_details']; ?>
    </div>	<!-- 1 ends here  -->

	<div class="TabbedPanels1 dealbg_right" id="myaccount_2" style="display:none;">
		<?php echo $today_res['highlights']; ?>
    </div><!-- 2 ends here  -->


	<div class="TabbedPanels1 dealbg_right" id="myaccount_3" style="display:none;">
		<?php echo $today_res['fineprint']; ?>
	</div>
	<!-- 3 ends here  -->


	<div class="TabbedPanels1 dealbg_right" id="myaccount_4" style="display:none;">
		<?php echo $today_res['offer_details_sidebar']; ?>
	</div>
	<!-- 4 ends here  -->

	<div class="TabbedPanels1 dealbg_right" id="myaccount_5" style="display:none;">
		<?php echo $today_res['postage']; ?>

	</div>
	<!-- 5 ends here  -->

	<div class="TabbedPanels1 dealbg_right" id="myaccount_6" style="display:none;">
		6
	</div><!-- 6 ends here  -->

	<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="40"/></div>

  </div>

	<!--
		<div class="dealbg_left">

		 <?php echo $today_res['offer_details']; ?>


		<br/><br/>
		</div>
		<div class="dealbg_right">
		<div> -->
		<!--<?php echo $today_res['offer_details_sidebar']; ?>
		<div>If you have any question then please don't hesitate to ask GetDeala now.</div>
		<div style="margin: 10px auto;"><a href="#"><img src="images/askme.gif" alt="" width="173" height="36" border="0" /></a></div>
		-->
	<!--	</div>
		<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="40"/></div>
		</div>

	 -->
</div>

<?php } else { ?>


<div style="width: 704px; float: left; margin: 10px auto; background: #FFFFFF;">
<div class="dealbg_left30">
<div>
<p>COMING SOON: THE BEST DEALS THAT  NATIONAL DEAL HAS TO OFFER</p><br/>
<span><strong>Discover your City for up to 90% off!</strong></span><br/><br/>
<span>See your city in a brand new light with GeeLaza. New and diverse deals on restaurants, leisure, spa, beauty and sport bring GeeLaza customers excitement for up to 90% less, every single day.<br/><br/>

But it's not just about presenting deals; GeeLaza is a city guide with a difference. Let GeeLaza take you on a journey of discovery with unrivalled deals on the best your city has to offer-all for unbeatable prices.</span><br/>
<br/>
<span><strong>Earn extra cash by recommending GeeLaza:</strong><br/>
<br/>
Recommend your favourite offers to friends, relatives and colleagues who haven't heard of GeeLaza. If someone buys a deal which you’ve recommended to them then you receive £5 GeeLaza credit. The best thing is, with friends and family on board, you can experience the best of your city has to offer with those who matter most.<br/>
<br/>
You can recommend GeeLaza in number of ways: via<a href="#">Facebook</a>, Or <a href="#">Twitter</a><br/>
<br/>
<strong>Gift Giving  with a Difference:</strong>.<br/><br/>
Presents are meant to be special but finding a suitable gift for those picky loved-ones is not always an easy task. The solution is simple: with Geelaza’s exciting, original and diverse range of offers it’s almost impossible to go wrong. Shopping with GeeLaza is stress free and uncomplicated; all you have to do is buy, print and give. <br/><br/>
<p>COMING SOON.</p>
The best deals, in your city<br/>
Company <a href="<?php echo SITE_URL; ?>national_deals.php?nd=National%20deals">Website</a>
</span>
</div>
</div>
<!--<div class="dealbg_right">
<div>
<p>The Stuart Hotel</p>
<span>
119 London Road<br/>
Derby DE1 2QR<br/>
<a href="#">http://www.thestuart.com</a></span></div>
<div class="clear"></div>
<div style="margin: 12px auto;"><img src="images/map.gif" alt="" width="189" height="172" class="border"/></div>
<div class="clear"></div>
<div style="margin: 12px auto;"><p>The Stuart Hotel presented by GeeLaza.co.uk</p></div>
<div>If you have any question then please don't hesitate to ask GetDeala now.</div>
<div style="margin: 10px auto;"><a href="#"><img src="images/askme.gif" alt="" width="173" height="36" border="0" /></a></div>
</div>-->
<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="40"/></div>
</div>

<?php } ?>

</div>


<?php include ('include/sidebar.php'); ?>

<?php include ('include/footer.php'); ?>