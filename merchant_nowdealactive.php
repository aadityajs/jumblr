<?php
include("include/m_header.php");

$muser_id=intval($_SESSION['muser_id']);
$sql = "SELECT first_name,last_name,company_name FROM `".TABLE_USERS."` WHERE user_id='$muser_id'";
$record = $db->query_first($sql);

$sql = "SELECT * FROM `".TABLE_STORES."` WHERE merchant_id='$muser_id'";
	$store = $db->query_first($sql);

$row_deals=$db->fetch_all_array("select * from ".TABLE_DEALS." where deal_type='nowdeal' and status<>0  and store_id='".$store['store_id']."'");

$k=0;
foreach($row_deals as $repeatdeal){

		if($repeatdeal['nowdeal_repeatday']=='weekends'){
		$dealdays=array("SA","SU");
		}
		elseif($repeatdeal['nowdeal_repeatday']=='weekdays'){
		$dealdays=array("MO","TU","WE","TH","FR");
		}
		elseif($repeatdeal['nowdeal_repeatday']!=''){
		$dealdays=unserialize($repeatdeal['nowdeal_repeatday']);
		}
		
		if(is_array($dealdays) ){
			$startdate=strtotime(date("Y-m-d H:i",strtotime($repeatdeal['deal_start_time'])));
			
			$enddate=strtotime(date("Y-m-d H:i",strtotime($repeatdeal['deal_end_time'])));
			
			
						if(date("Y",strtotime($repeatdeal['nowdeal_stopdate']))>2000){
						
						$enddate = strtotime(date("Y-m-d", strtotime($repeatdeal['nowdeal_stopdate']))." ".date("H:i",strtotime($repeatdeal['deal_end_time'])) );
						}else{
						$enddate = strtotime(date("Y-m-d H:i", ($enddate)) . " +30 days");
						}
						//echo date("Y-m-d H:i",$startdate);
					//echo date("Y-m-d H:i",$enddate);
			
			$starttime=repeat_days($startdate,$enddate,$dealdays);	
			
			
			$endtime=array();
				foreach($starttime as $start){
					
					$endtime[]=date("Y-m-d",strtotime($start))." ".date("H:i",$enddate);
				
				}
			if(count($starttime)<=0){
			array_unshift($starttime,date("Y-m-d H:i",strtotime($repeatdeal['deal_start_time'])));
			array_unshift($endtime,date("Y-m-d H:i",strtotime($repeatdeal['deal_end_time'])));
			}
			$row_deals[$k]['repeat_start_time']=array();
			$row_deals[$k]['repeat_end_time']=array();
			array_push($row_deals[$k]['repeat_start_time'],$starttime);
			array_push($row_deals[$k]['repeat_end_time'],$endtime);
			
		
		}else{
		
			
			
			$row_deals[$k]['repeat_start_time'][0]=array($repeatdeal['deal_start_time']);
			$row_deals[$k]['repeat_end_time'][0]=array($repeatdeal['deal_end_time']);
			
		}

		

$k++;
}


				if($_SESSION['errmsg']){
				echo '<div class="error_box" style="font-size:12px;">'.$_SESSION['errmsg'].'</div>' ;
				$_SESSION['errmsg']="";
				}if($_SESSION['msg']){
				echo '<div class="valid_box" style="font-size:12px;">'.$_SESSION['msg'].'</div>' ;
				$_SESSION['msg']="";
				}
	//print_r($row_deals);		
				?>
				
		
		 
		<link rel='stylesheet' type='text/css' href='css/cupertino/theme.css' />
		<script type='text/javascript' src='js/calendar/src/_loader.js'></script>
		<script type='text/javascript' src='js/jquery.simplemodal.js'></script>
		
	<!-- Contact Form CSS files -->
<link type='text/css' href='css/basic.css' rel='stylesheet' media='screen' />

<!-- IE6 "fix" for the close png image -->
<!--[if lt IE 7]>
<link type='text/css' href='css/basic_ie.css' rel='stylesheet' media='screen' />
<![endif]-->

<!-- JS files are loaded at the bottom of the page -->	
		 
   <script type='text/javascript'>

	$(document).ready(function() {
	
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		$('#calendar').fullCalendar({
			theme: true,
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek'
			},
			editable: false,
				eventClick: function(event, jsEvent, view) {
			//alert('EVENT CLICK ' + event.id);
			
			var urlsend="<?php echo SITE_URL;?>ajax_eventdialog";  
						urlsend=urlsend+"?deal="+event.id;  
						urlsend=urlsend+"&sid="+Math.random();
						
					$.ajax({
						   type: "POST",
						   url: urlsend,
						   async: false,
						   success: function(message){
							
							 content=message;
						   }
						}); 
						
						
								$('#eventdialog').modal();
						
								
							
	
			/*content="<b>Start Time :</b><div class='eventtext'>"+event.start+"</div> <br />";
			content=content+"<b>End Time :</b><div class='eventtext'>"+event.end+"</div> <br /><br />";
			content=content+"<div class='eventbutton'><input type='button' onClick=closedialog('"+event.id+"') value='Edit'></div>"*/
				$("#eventdialog").html(content);
				
			},
			events: [
			<?php 
			$i=1;
			
			foreach($row_deals as $deal){
		
			if(is_array($deal['repeat_start_time'][0]) ){
			
			$p=0;
			$cnt=count($deal['repeat_start_time'][0]);
			foreach($deal['repeat_start_time'][0] as $repeattime){
			
			$repeat_start_time=$repeattime;
			$repeat_end_time=$deal['repeat_end_time'][0][$p];
			?>
				{
					id:'deal<?php echo $deal['deal_id']?>',
					title: '<?php if(!empty($deal['title'])){echo strip_tags($deal['title']);}else{echo strip_tags($deal['title2']);}?>',
					start: new Date(<?php echo date('Y',strtotime($repeat_start_time))?>, 
									 <?php echo round(date('m',strtotime($repeat_start_time)))-1?>,
									 <?php echo (date('d',strtotime($repeat_start_time)))?>, 
									 <?php echo round(date('H',strtotime($repeat_start_time)))?>, 
									 <?php echo round(date('i',strtotime($repeat_start_time)))?>),
					 
					end: new Date(<?php echo date('Y',strtotime($repeat_end_time))?>, 
									<?php echo round(date('m',strtotime($repeat_end_time)))-1?>,
									<?php echo (date('d',strtotime($repeat_end_time)))?>,
									<?php echo round(date('H',strtotime($repeat_end_time)))?>,
									<?php echo round(date('i',strtotime($repeat_end_time)))?>),
									
					   
					allDay: false,
					url: 'javascript:void(0)',
					className :'basic'
				}
			
			
			<?php
			$p++;
			
						if($cnt!=$p || $i<count($row_deals)){
						echo ",";
						} 
				
				
				}
			}
			
					
			$i++;
			}?>	
				
			]
		});
		
	$('#calendar').fullCalendar( 'changeView', 'agendaWeek' )	
	});

</script>
<style type='text/css'>

	
	#calendar {
		width: 650px;
		margin: 0 auto;
		}

</style>


		
		
		<!-- modal content -->
		<div id="eventdialog">
			<div style="margin:0 auto; vertical-align:bottom; width:100%"><input type="button" value="Edit"  /></div>
		</div>

	
   <div id='calendar'></div>
   
   <script>
  /* jQuery(function ($) {
	// Load dialog on page load
	//$('#basic-modal-content').modal();

	// Load dialog on click
	$('.basic').click(function (e) {
		$('#eventdialog').modal();

		return false;
	});
});*/

   function closedialog(dealid)
{
$.modal.close();
var mySplitResult = dealid.split("deal");

location.href='<?php echo SITE_URL;?>merchant_addnowdeal?mode=edit&deal_id='+dealid;
}
   </script>
   
    <?php 
	
		
	if(empty($store['store_status'])){
	
	?>
	<div class="formcenteralighed">
	<h3>You don't have any Groupon Store deals yet! <a href="create_store.php">Create Store Now</a></h3></div>
	
	
	<?php }?>
   
	
    	<?php require("include/merchant_footer.inc.php"); ?>   

