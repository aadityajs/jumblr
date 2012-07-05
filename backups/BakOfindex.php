<?php include("include/header.php");?>
<?php
error_reporting(E_ERROR && E_STRICT);
?>
<script src="js/countdown.js" type="text/javascript" charset="utf-8"></script>

<div class="topbg">
<ul>
<li><p>DEAL INFORMATION</p></li>
<li><img src="images/spacer.gif" alt="" width="170" height="1" /></li>
<li>Recommend This Deal By:</li>
<li><img src="images/email.png" alt="" width="19" height="18" /></li>
<li><a href="#">Email</a></li>
<li><img src="images/facebook.png" alt="" width="19" height="18" /></li>
<li><a href="#">Facebook</a></li>
<li><img src="images/twitter.png" alt="" width="19" height="18" /></li>
<li><a href="#">Twitter</a></li>
</ul>
</div>

<div class="clear"></div>
<div class="midbg">

<?php 
if (($_GET['action'] != "") && ($_GET['id'] != "")) {
	$action = $_GET['action'];
	$deal_id = $_GET['id'];
	
	$sql_today = "SELECT * FROM ".TABLE_DEALS." WHERE status >= 1 AND deal_id = '".$deal_id."' LIMIT 0, 1";
	$today_res = mysql_fetch_array(mysql_query($sql_today));
	
	$sql_todays_buy = "SELECT SUM(qty) FROM ".TABLE_TRANSACTION." WHERE deal_id = ".$today_res['deal_id'];
	$total_buy = mysql_fetch_array(mysql_query($sql_todays_buy));
	
	$sql_todays_image = "SELECT * FROM ".TABLE_DEAL_IMAGES." WHERE deal_id = ".$today_res['deal_id'];
	$todays_image = mysql_fetch_array(mysql_query($sql_todays_image));
	
}
else {
	$sql_today = "SELECT * FROM ".TABLE_DEALS." WHERE status >= 1 AND deal_end_time LIKE '".date("Y-m-d")."%' LIMIT 0, 1";
	$today_res = mysql_fetch_array(mysql_query($sql_today));
	
	$num_rows = mysql_num_rows(mysql_query($sql_today)) ;
	
		if ($num_rows > 0) {
		
			$sql_todays_buy = "SELECT SUM(qty) FROM ".TABLE_TRANSACTION." WHERE deal_id = ".$today_res['deal_id'];
			$total_buy = mysql_fetch_array(mysql_query($sql_todays_buy));
			
			$sql_todays_image = "SELECT * FROM ".TABLE_DEAL_IMAGES." WHERE deal_id = ".$today_res['deal_id'];
			$todays_image = mysql_fetch_array(mysql_query($sql_todays_image));
		}	
}	// end else
?>

<div class="today_deal">
<div class="tab_button"><span>£<?php echo strip_tags($today_res['discounted_price']); ?></span></div>
	  <div><a href="#"><h1><?php echo strip_tags($today_res['title']); ?></h1></a></div>
	  <div class="clear"><img src="images/spacer.gif" alt="" width="1" height="1" /></div>
	  <div class="deal_left">	  
	  <div class="blue_box">
	  <div class="timer_box2">
	  <ul>
	  <li><p>Value<br/><span>£<?php echo strip_tags($today_res['full_price']); ?></span></p></li>
	  <li><p>Discount <br/><span><?php echo intval($today_res['discounted_price']*100/$today_res['full_price']); ?>%</span></p></li>
	  <li style="border-right: 0;"><p>Saving<br/><span>£<?php echo strip_tags($today_res['full_price'] - $today_res['discounted_price']); ?></span></p></li>
	  </ul>
	  </div>
	  </div>
	  <div class="clear"><img src="images/spacer.gif" alt="" width="1" height="4" /></div>
	  <div class="blue_box">
	  <div class="timer_box1">	  
	  <ul>	  
	  <li><img src="images/gift.gif" alt="" width="42" height="35" /></li>		  
	  <li><p>Buy it for a friend!</p></li>
	  </ul>	
	  </div> 
	  </div>
	  <div class="clear"><img src="images/spacer.gif" alt="" width="1" height="4" /></div>

	  <div class="blue_box">
	  <div><h3>Time left to buy this deal:</h3></div>
	  <div class="timer_box">	 
	  
	  <?php 
	  	
		$timeNow = date("Y-m-d H:i:s");
	  	
	  	/*$today = strtotime($timeNow);
		$last_deal_time = strtotime($today_res['deal_end_time']);
		$daytohr = round(abs($today-$last_deal_time)/60/60);*/
		
	  
	  
	  	$date = explode("-", $today_res['deal_end_time']);
	  	
	  	//var_dump($date);
	  	$year = $date[0];
	  	$month = $date[1];
	  		$darr = explode(" ", $date[2]);
	  	$day = $darr[0];
	  	
	  	$time = explode(":", $darr[1]);
	  	//var_dump($time);
	  	$hr = $time[0];
	  	$min = $time[1];
	  	$sec = $time[2];
	  	$last_deal_time = $year."-".$month."-".$day." ".$hr.":".$min.":".$sec;
	  	
	  	
	  ?>
	  <script language="javascript">			
	
									var cd<?php echo $today_res['deal_id'];?>a			=  new countdown('cd<?php echo $today_res['deal_id'];?>a');
									cd<?php echo $today_res['deal_id'];?>a.Div			= "clock<?php echo $today_res['deal_id'];?>a";
									cd<?php echo $today_res['deal_id'];?>a.TargetDate	= "<?php echo $last_deal_time;?>";
									cd<?php echo $today_res['deal_id'];?>a.CurDate		= "<?php echo $timeNow;?>";
									cd<?php echo $today_res['deal_id'];?>a.DisplayFormat	= "<span>%%H%% </span>";
	
									var cd<?php echo $today_res['deal_id'];?>b			= new countdown('cd<?php echo $today_res['deal_id'];?>b');
									cd<?php echo $today_res['deal_id'];?>b.Div			= "clock<?php echo $today_res['deal_id'];?>b";
									cd<?php echo $today_res['deal_id'];?>b.TargetDate	= "<?php echo $last_deal_time;?>";
									cd<?php echo $today_res['deal_id'];?>b.CurDate		= "<?php echo $timeNow;?>";
									cd<?php echo $today_res['deal_id'];?>b.DisplayFormat	= "<span>%%M%%</span>";
	
									var cd<?php echo $today_res['deal_id'];?>c			= new countdown('cd<?php echo $today_res['deal_id'];?>c');
									cd<?php echo $today_res['deal_id'];?>c.Div			= "clock<?php echo $today_res['deal_id'];?>c";
									cd<?php echo $today_res['deal_id'];?>c.TargetDate	= "<?php echo $last_deal_time;?>";
									cd<?php echo $today_res['deal_id'];?>c.CurDate		= "<?php echo $timeNow;?>";
									cd<?php echo $today_res['deal_id'];?>c.DisplayFormat	= "<span >%%S%%</span>";
	
									
		</script>  
	  <ul>
		  <li><p style="padding:5px 0 0 0;"><span class="txt2" id="clock<?php echo $today_res['deal_id'];?>a"></span><br/><span>Hrs.</span></p></li>
		  <li><p style="padding:5px 0 0 0px;"><span class="txt2" id="clock<?php echo $today_res['deal_id'];?>b"></span><br/><span>Min.</span></p></li>
		  <li><p style="padding:5px 0 0 0px;"><span class="txt2" id="clock<?php echo $today_res['deal_id'];?>c"></span><br/><span>Sec.</span></p></li>
	  </ul>	
		<script language="javascript">
					cd<?php echo $today_res['deal_id'];?>a.Setup();
					cd<?php echo $today_res['deal_id'];?>b.Setup();
					cd<?php echo $today_res['deal_id'];?>c.Setup();
					
		</script>	

	  </div> 
	  </div>
	  <div class="clear"><img src="images/spacer.gif" alt="" width="1" height="4" /></div>
	  
	  <div class="blue_box">	
	<div class="brought" style="border-bottom:0px;">
   <div class="font24px" ><?php if($total_buy[0] != 0) {echo $total_buy[0].'Bought!';} else {echo "Not Yet Bought!";} ?> </div>
	<div>
	<ul>
	<li><img src="images/icon_tick.png" alt="" width="30" height="28" style="margin: 0px -15px 0 15px; float:left;"/></li>
	<li style="padding: 10px 0 0 4px;">Deal is on!</li>
	</ul>
	</div>							
     </div> 
	  </div>
	   <div class="clear"><img src="images/spacer.gif" alt="" width="1" height="4" /></div>
	  <div class="blue_box">
	  <div class="font_11">Share with friends!</div>	
	<div class="timer_box3" style="border-bottom:0px;">
	<ul>
	<li><img src="images/email.png" alt="" width="19" height="18" /></li>
	<li><a href="#">Email</a></li>
	<li><img src="images/facebook.png" alt="" width="19" height="18" /></li>
	<li><a href="#">Facebook</a></li>
	<li><img src="images/twitter.png" alt="" width="19" height="18" /></li>
	<li><a href="#">Twitter</a></li>
	</ul>						
     </div> 
	  </div>
	  </div>
	  <div class="box683_right">
  <div><img src="<?php echo UPLOAD_PATH.$todays_image['file']; ?>" alt="" width="439" height="293" /></div>
  <div class="highlights"> 
  	
    <div style="width:200px; float: left; margin: 0 auto;">
     <?php echo $today_res['highlights']; ?>
     
    </div>
    <div style="width:196px; float: right; margin: 0 auto;">
    
     <?php echo $today_res['fineprint']; ?>
     
    </div>
  </div>
</div>
</div>
<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="4" /></div>
</div>
</div>
<div class="clear"></div>
<div id="dealbg_bot">
<div class="dealbg_left">

 <?php echo $today_res['offer_details']; ?>


<br/><br/>
</div>
<div class="dealbg_right">
<div>
<?php echo $today_res['offer_details_sidebar']; ?>
<div>If you have any question then please don't hesitate to ask GetDeala now.</div>
<div style="margin: 10px auto;"><a href="#"><img src="images/askme.gif" alt="" width="173" height="36" border="0" /></a></div>
</div>
<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="40"/></div>
</div>
</div>
</div>
<?php include ('include/sidebar.php'); ?>
<?php include ('include/footer.php'); ?>