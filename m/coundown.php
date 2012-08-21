 <script src="file:///D|/working_dir/xampp/htdocs/timer/countdown.js" type="text/javascript" charset="utf-8"></script>
 <?php
 	$time1=explode("-",'2011-12-18 17:59:59');
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
	
	
	var cd2b			= new countdown('cd2b');
	cd2b.Div			= "clock2b";
	cd2b.TargetDate	= "<?php echo $last_deal_time;?>";
	cd2b.CurDate		= "<?php echo $time_now;?>";
	cd2b.DisplayFormat	= "<span  style='margin: 0 0 0 5px;'>%%H%%</span>";

	var cd2c			= new countdown('cd2c');
	cd2c.Div			= "clock2c";
	cd2c.TargetDate	= "<?php echo $last_deal_time;?>";
	cd2c.CurDate		= "<?php echo $time_now;?>";
	cd2c.DisplayFormat	= "<span  style='margin: 0 0 0 5px;'>%%M%%</span>";

	var cd2d			= new countdown('cd2d');
	cd2d.Div			= "clock2d";
	cd2d.TargetDate	= "<?php echo $last_deal_time;?>";
	cd2d.CurDate		= "<?php echo $time_now;?>";
	cd2d.DisplayFormat	= "<span  style='margin: 0 0 0 5px;'>%%S%%</span>";
	
</script> 


<strong><span id="clock2b"></span>:<span id="clock2c"></span>:<span id="clock2d"></span></strong>


 <script language="javascript">
				cd2b.Setup();
				cd2c.Setup();
				cd2d.Setup();
			</script>