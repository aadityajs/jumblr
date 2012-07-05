<?php
include("include/m_header.php");
$mode=isset($_REQUEST['mode'])?$_REQUEST['mode']:'add';
$deal_id=isset($_REQUEST['deal_id'])?$_REQUEST['deal_id']:'';

$user_id=intval($_SESSION['muser_id']);
$sql = "SELECT first_name,last_name,company_name FROM `".TABLE_USERS."` WHERE user_id='$user_id'";
$record = $db->query_first($sql);



if(isset($_REQUEST['submit']) ){
	
	$data['store_id']=$_POST['store_id'];
	$locationdata['location']=$_POST['location'];

	$data['title']=$_POST['title'];
	$data['title2']=$_POST['title2'];
	$data['description']=$_POST['description'];

	$data['full_price']=$_POST['retailvalue'];
	$data['discounted_price']=$_POST['customerdisc'];
	$data['wakadeal_comission']=$_POST['wakadealfee'];
	
	
	$data['custpercent']=$_POST['custpercent'];
	$data['merchant_take']=$_POST['merchant_take'];
	$data['merchantpercent']=$_POST['merchantpercent'];
	$data['waka_percent']=$_POST['wakapercent'];
	
	
	
	$data['deal_start_time']=$_POST['deal_start']." ".$_POST['deal_start_time'];	
	$data['deal_end_time']=$_POST['deal_start']." ".$_POST['deal_end_time'];
	
	$data['mid']=$_POST['mid'];

	$data['coupon_expiry']=$_POST['coupon_expiry'];
	$data['max_coupons']=$_POST['max_coupons'];
	$data['deal_cat']=$_POST['deal_cat'];
		
	$data['date_added']=date("Y-m-d");			
	
	$data['offer_details']=$_POST['custom_resctiction'];

	$data['max_buy']=$_POST['max_sellable_quantity'];
	$data['max_purchase']=$_POST['max_per_purchase_quantity'];
	
	if(isset($_POST['days_of_the_week'])){
	$data['nowdeal_repeatday']=serialize($_POST['days_of_the_week']);
	}else{
	$data['nowdeal_repeatday']=$_POST['repeat_deal'];
	}
	
	$data['nowdeal_stopdate']=$_POST['repeat_date'];
	
	$data['deal_type']='nowdeal';
	
	if($data['title']=='' && $data['title2']=='' || $data['description']=='' || $data['deal_cat']=='' || $data['deal_start_time']=='' || $_POST['deal_end_time']=='' || $_POST['deal_start']==''){
	$_SESSION['errmsg']="Please enter valid details for a deal";
	header("location:".SITE_URL."merchant_addnowdeal");
	exit;
	}
		
	if($mode=="edit")
	{	
		
		$db->query_update(TABLE_DEALS, $data, "deal_id='".$deal_id."'");
		
		$dataimg['deal_id']=$deal_id;	
		
		$db->query_update(TABLE_DEAL_IMAGES, $dataimg, "deal_id='".$_SESSION["session_temp"]."'");
		
		$mdata['user_id']=$_POST['mid'];
		$mdata['deal_id']=$deal_id;
		$db->query_update(TABLE_DEALS_MERCHANT, $mdata, "deal_id='".$deal_id."'");
		
		mysql_query("DELETE FROM ".TABLE_DEALS_MERCHANT_LOCATION." where deal_id='$deal_id'");
		foreach($locationdata['location'] as $loc){
		$data=array();
		$data['deal_id']=$deal_id;
		$data['location_id']=$loc;
		$db->query_insert(TABLE_DEALS_MERCHANT_LOCATION, $data);
		}
		
				
		$_SESSION['msg']="Deal is updated successfully.";
		header("location:".SITE_URL."merchant_addnowdeal?mode=edit&deal_id=".$deal_id);	
		exit;

	}
	else
	{
	
	if(date('Y-m-d H:i',strtotime($data['deal_start_time']))>date('Y-m-d H:i')){
		$data['status']=2;
		}else{
		$data['status']=1;
		}
		
		$primary_id=$db->query_insert(TABLE_DEALS, $data);
		
		$mdata['user_id']=$_POST['mid'];
		$mdata['deal_id']=$primary_id;
		$db->query_insert(TABLE_DEALS_MERCHANT, $mdata);
		
		foreach($locationdata['location'] as $loc){
		$data=array();
		$data['deal_id']=$primary_id;
		$data['location_id']=$loc;
		$db->query_insert(TABLE_DEALS_MERCHANT_LOCATION, $data);
		}
	
	
		$data=array();
		$data['deal_id']=$primary_id;
		$data['tempid']='';
		$db->query_update(TABLE_DEAL_IMAGES, $data, "tempid='".$_SESSION['tmpid']."'");
		
		
		
		$_SESSION['msg']="Deal is added successfully.";
		header("location:".SITE_URL."merchant_addnowdeal");	
		exit;
	}
		
	
}

mysql_query("DELETE FROM ".TABLE_DEAL_IMAGES." where deal_id=''");


$row_stores=mysql_fetch_array(mysql_query("SELECT * FROM ".TABLE_STORES." where merchant_id='".$_SESSION['muser_id']."'"));

$merchant=mysql_fetch_array(mysql_query("SELECT * FROM ".TABLE_USERS." where reg_type='merchant' and user_id='".$_SESSION['muser_id']."'"));

if(empty($row_stores['store_id'])){

$_SESSION['errmsg']='Please create a store to add deal.';
		header("location:".SITE_URL."create_store");	
		exit;
}
if($row_stores['store_status']!='1'){
$_SESSION['errmsg']='Your store is not approved to add a deal.Please complete your profile and get approval from admin.';
		header("location:".SITE_URL."merchant_companyinfo");	
		exit;
}

$store_id=$row_stores['store_id'];

if($_REQUEST['mode']=='edit' || $_REQUEST['mode']=='delete'){
$_SESSION["tmpid"] =$deal_id;
}else{
$_SESSION["tmpid"] =uniqid();
}


if($mode=='edit'){
$sql= "SELECT * FROM ".TABLE_DEALS." where deal_id='$deal_id'";
$row_deal=mysql_fetch_array(mysql_query($sql));

}


?>

<style>
		fieldset {
				border: medium solid #cccccc;
				clear: both;
				padding:2px;
				width:630px;
				
			}
		fieldset legend {
				font-size:16px;
				
			}
		.dealcalcbox{
		width:40px; height:25px; border:1px solid #cccccc; padding:2px;
		}		
		#Layer1 {
	position:relative;
	width:595px;
	height:auto;
	z-index:1001;
	left: -30px;
	top: 180px;
}
        </style>


<script>
function formvalidation(myform){
	
	if(myform.title[0].checked==false && myform.title[1].checked==false){
	
		alert("Please select a title");
		return false;
	}
	else if(document.getElementById('description').value=='eg. food & drink or travel' || document.getElementById('description').value==''){
		document.getElementById('description').focus();
		alert("Please enter description");
		return false;
	}
	else if(document.getElementById('deal_start').value==''){
		alert("Please enter deal schedule date");
		document.getElementById('deal_start').focus()
		return false;
	}
	
	return true;
}
</script>

<body>
	<div style="margin-top: 10px;" id="maincontainer">
    
		    <?php include("merchant_menu_section.php"); ?>
           
		   
			<div class="main_box white_bg">
			<div class="clear"></div>
			
             <div class="main_box">
             
              <div id="TabbedPanels2" class="TabbedPanels2">
              <ul class="TabbedPanelsTabGroup2">
                <li class="TabbedPanelsTab2" tabindex="0">Create a Now Deal</li>
				<li class="TabbedPanelsTab2" tabindex="0">Close Deals</li>
                <li class="TabbedPanelsTab2" tabindex="0">Active Deals</li>
              </ul>
              <div class="TabbedPanelsContentGroup2">
                <div class="TabbedPanelsContent2">
		
		
		
		
		
		
		
		
					<form method="post" class="niceform2" onSubmit="return formvalidation(this);" name="frmnowdeal" >
					<input type="hidden" name="mid" value="<?php echo $_SESSION['muser_id']?>" />
					<input type="hidden" name="store_id" value="<?php echo $store_id?>" />
					<input type="hidden" name="deal_id" value="<?php echo $deal_id?>" />
					<fieldset>
					<legend  title="Primary Location">Step 1 : Define Your NOW Deal</legend>
					<script language="javascript" type="text/javascript">
					
					function numbersonly(e){
					var unicode=e.charCode? e.charCode : e.keyCode
					if (unicode!=8){ //if the key isn't the backspace key (which we should allow)
					if (unicode<48||unicode>57) //if not a number
					return false //disable key press
					}
					}
					
					
					function calculatedeal(boxname){
					retail=parseFloat(document.getElementById('retailvalue').value);
					discount=parseFloat(document.getElementById('customerdisc').value);
					merchant=parseFloat(document.getElementById('merchant_take').value);
					
					custpercent=parseFloat(document.getElementById('custpercent').value);
					merchantpercent=parseFloat(document.getElementById('merchantpercent').innerHTML);
					wakadealpercent=parseFloat(document.getElementById('wakadealpercent').innerHTML);
					
					if(retail<=0 || discount<=0 || merchant<=0 || isNaN(retail)==true || isNaN(discount)==true || isNaN(merchant)==true ){
					return false;
					}
					if(discount>retail-1){
					return false;
					}
					
					if(boxname=='customer'){
					
					//custpercent=(parseFloat(discount)/parseFloat(retail))*100;
					//document.getElementById('custpercent').value=custpercent.toFixed(2);
					
					//merchantpercent=100-(custpercent+wakadealpercent);
					//document.getElementById('merchantpercent').innerHTML=merchantpercent.toFixed(2)
					
					}
					/*if(boxname=='merchant'){
					merchantpercent=(parseFloat(document.getElementById('merchant_take').value)/parseFloat(document.getElementById('retailvalue').value))*100;
					document.getElementById('merchantpercent').innerHTML=merchantpercent;
					
					custpercent=100-(merchantpercent+parseFloat(document.getElementById('wakadealpercent').innerHTML));
					document.getElementById('custpercent').value=custpercent;
					}*/
					
					merchantpercent=100-wakadealpercent;
					document.getElementById('merchantpercent').innerHTML=merchantpercent;
					
					
					
					if(retail>0){
					custvalue=retail*(custpercent/100);
					//document.getElementById('customerdisc').value=custvalue;
					discountprice=retail-discount;
					custpercent=(parseFloat(discountprice)/parseFloat(retail))*100;
					document.getElementById('custpercent').value=parseInt(custpercent);
					
					
					merchantvalue=discount*(merchantpercent/100);
					document.getElementById('merchant_take').value=merchantvalue.toFixed(2);
					
					wakadealvalue=discount*(wakadealpercent/100);
					document.getElementById('wakafee').value=wakadealvalue.toFixed(2);
					document.getElementById('wakadealfee').value=wakadealvalue.toFixed(2);
					
					totalv=parseFloat(merchantvalue)+parseFloat(wakadealvalue);
					
					document.getElementById('title1').innerHTML="$"+(totalv.toFixed(2))+" for $"+retail.toFixed(2)+" at "+document.getElementById('storename').value+"<br />"+parseInt(custpercent)+" % off "+document.getElementById('description').value;
					//document.getElementById('desc1').innerHTML=custpercent.toFixed(2)+" % off "+document.getElementById('description').value;
					
					document.getElementById('title2').innerHTML="$"+(totalv.toFixed(2))+" for "+document.getElementById('description').value+" at "+document.getElementById('storename').value+"<br />"+parseInt(custpercent)+" % off ";
					//document.getElementById('desc2').innerHTML=custpercent.toFixed(2)+" % off ";
					document.getElementById('title11').value=document.getElementById('title1').innerHTML;
					document.getElementById('title22').value=document.getElementById('title2').innerHTML;
					
					
					
					}
					
					
					}
					
					
					
					
					</script>
					<table width="100%" border="0" cellspacing="5" cellpadding="5">
					<tr>
					<td align="right"><strong>Set Deal Value:</strong></td>
					<td  style="padding-left:10px;"><table width="100%" border="0" cellspacing="0" cellpadding="0" >
					<tr style="background-color:#cccccc;">
					<td style="padding:5px;">Regular Price</td>
					<td style="padding:5px;">Discount Price</td>
					<td style="padding:5px;">% Off</td>
					<td style="padding:5px;">Merchant's Take</td>
					<td style="padding:5px;">Wakadeal Fee</td>
					</tr>
					<?php
					$sql = "SELECT * FROM `".TABLE_SETTING."` WHERE name='deal_fee'";
					$fee = $db->query_first($sql);
					$retailvalue=isset($row_deal['full_price'])?$row_deal['full_price']:20;
					$customerdisc=isset($row_deal['discounted_price'])?$row_deal['discounted_price']:10;
					$custpercent=isset($row_deal['custpercent'])?$row_deal['custpercent']:50;
					$merchant_take=isset($row_deal['merchant_take'])?$row_deal['merchant_take']:7.5;
					$waka_percent=isset($row_deal['waka_percent'])?$row_deal['waka_percent']:$fee['value'];
					$wakadeal_comission=isset($row_deal['wakadeal_comission'])?$row_deal['wakadeal_comission']:2.5;
					?>
					<tr style="background-color:#F3F3F3">
					<input type="hidden" value="<?php echo $row_stores['store_name'];?>" name="storename"  id="storename"/>
					<td style="padding:4px; border-right:1px solid #000000; text-align:center">$
					<input type="text" id="retailvalue" name="retailvalue" value="<?php echo $retailvalue?>" class="dealcalcbox"  onkeyup="calculatedeal('retail')" onBlur="calculatedeal('retail')" onKeyPress="return numbersonly(event)" /></td>
					<td style="padding:4px; border-right:1px solid #000000;text-align:center">$
					<input type="text" id="customerdisc" name="customerdisc" class="dealcalcbox"  value="<?php echo $customerdisc?>" onKeyUp="calculatedeal('customer')" onBlur="calculatedeal('customer')" onKeyPress="return numbersonly(event)" /></td>
					<td style="padding:4px; border-right:1px solid #000000;text-align:center"><input type="text" id="custpercent" value="<?php echo $custpercent?>" name="custpercent"  size="2" readonly="">
					%</td>
					<td style="padding:4px; border-right:1px solid #000000;text-align:center">$
					<input type="text" id="merchant_take"  name="merchant_take"  size="5" value="<?php echo $merchant_take?>"  readonly="" />
					<span id="merchantpercent">75</span>%</td>
					<td style="padding:4px; text-align:center">$
					<input type="text" value="<?php echo $wakadeal_comission?>" readonly="" id="wakafee"  size="5">
					&nbsp;&nbsp;&nbsp; <span  id="wakadealpercent"><?php echo $waka_percent?></span>%
					<input type="hidden" name="wakadealfee" id="wakadealfee" value="<?php echo $wakadeal_comission?>" />
					<input type="hidden" name="wakapercent" id="wakapercent" value="<?php echo $waka_percent?>" />
					</td>
					</tr>
					</table></td>
					</tr>
					<tr>
					<?php 
					$description=isset($row_deal['description'])?$row_deal['description']:'eg. food & drink or travel';
					?>
					<td align="right" ><strong>Description:</strong></td>
					<td style="padding-left:10px;"><input type="text" size="50" name="description" id="description" value="<?php echo $description?>"  onkeyup="calculatedeal('')" onClick="if(this.defaultValue==this.value) this.value=''"      onblur="if (this.value=='') this.value=this.defaultValue"/></td>
					</tr>
					<tr>
					<td align="right" style="vertical-align:top"><strong>Choose your deal's title:</strong></td>
					<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
					<td  style="text-align:right; vertical-align:top; width:10px;"><input type="radio" value="title1" id="title11"   name="title" onClick="this.value=document.getElementById('title1').innerHTML;document.getElementById('title22').checked=false" <?php if(!empty($row_deal['title'])){ echo "checked";}?>  /></td>
					<td><span id='title1' >$10 for $20 at Kates Cars<br />
					50% off desc test cx sdfsd</span><br />
					<br />
					</td>
					</tr>
					<tr>
					<td style="text-align:right; vertical-align:top; width:10px;"><input type="radio" value="title2" id="title22"  name="title2" onClick="this.value=document.getElementById('title2').innerHTML;document.getElementById('title11').checked=false" <?php if(!empty($row_deal['title2'])){ echo "checked";}?>/></td>
					<td><span id='title2' >$10 for $20 at Kates Cars<br />
					50% off desc test cx sdfsd</span></td>
					</tr>
					</table></td>
					</tr>
					<tr>
					<td align="right" style="vertical-align:top"><strong>Locations:</strong></td>
					<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
					
					
					<?php if($mode=='edit'){
					$location=mysql_query("SELECT * FROM ".TABLE_STORES_LOCATION." where store_id='".$row_stores['store_id']."'");
					while($locrow=mysql_fetch_array($location)){
					
					$editloc=mysql_fetch_array(mysql_query("SELECT * FROM ".TABLE_DEALS_MERCHANT_LOCATION." where location_id='".$locrow['location_id']."' and deal_id='$deal_id'"));
					?>
					<tr>
					<td><input type="checkbox" name="location[]"  <?php if($editloc['location_id']==$locrow['location_id']){echo "checked";}?> value="<?php echo $locrow['location_id']?>"/>
					<?php echo $locrow['location_name']?></td>
					</tr>
					
					<?php }}else{
					$location=mysql_query("SELECT * FROM ".TABLE_STORES_LOCATION." where store_id='".$row_stores['store_id']."'");
					while($locrow=mysql_fetch_array($location)){
					?>
					<tr>
					<td><input type="checkbox" name="location[]" <?php if($locrow['location_id']==$row_stores['primary_location']){echo "checked";}?> value="<?php echo $locrow['location_id']?>"/>
					<?php echo $locrow['location_name']?></td>
					</tr>
					<?php } }?>
					</table></td>
					</tr>
					<tr>
					<td align="right"><strong>Category:</strong></td>
					<td><select name="deal_cat" class="dropdown" id="deal_cat" >
					<option value="">-- Select --</option>
					<?php
					$sql_categories=mysql_query("select cat_name,cat_id from " .TABLE_CATEGORIES." where parent_id=0 order by cat_name asc");
					while($row_categories=mysql_fetch_array($sql_categories))
					{?>
					<option value="<?php echo $row_categories[cat_id];?>" <?php if($row_categories[cat_id]==$row_deal[deal_cat]) { echo "selected"; }?>><?php echo $row_categories[cat_name];?></option>
					<?php }	?>
					</select>
					</td>
					</tr>
					<?php 
					$offer_details=isset($row_deal['offer_details'])?$row_deal['offer_details']:'';
					?>
					<tr>
					<td align="right"><strong>Custom Restrictions:</strong></td>
					<td><textarea rows="5" cols="25" name="custom_resctiction"><?php echo $offer_details?></textarea>
					</td>
					</tr>
					</table>
					</fieldset>
					<fieldset>
					<legend  title="Primary Location">Step 2: Schedule Your Deal</legend>
					<table width="100%" border="0" cellspacing="5" cellpadding="5">
					<tr>
					<td width="200" align="right" style="vertical-align:top"><strong>Accept Wakadeals beginning :</strong></td>
					<td><input type="textbox" size="10" name="deal_start"  id="deal_start" value="<?php if($row_deal['deal_start_time']){echo date("Y-m-d",strtotime($row_deal['deal_start_time']));}?>"/>
					<span id="cal2"><img src="siteadmin/zpcal/themes/icons/calendar1.gif" width="27" height="21" style="cursor:pointer"/></span>
					<script type="text/javascript">
					var cal = new Zapatec.Calendar.setup({
					
					inputField:"deal_start",
					ifFormat:"%Y-%m-%d",
					button:"cal2",
					showsTime:false
					
					});
					
					</script>
					</span><br />
					<br />
					
					<select name="deal_start_time" id="deal_start_time">
					<?php 
					
					$time1=0;
					$timepart="AM";
					for($t1=0;$t1<=23; $t1++){
					
					if($time1>11)
					{ $time1=0;
					$timepart="PM";}
					for($t2=0;$t2<60;$t2=$t2+15){
					
					//$time = date( "h:i:s", strtotime($end) - strtotime($start) ) ; 
					$value=date("H:i",strtotime($t1.":".$t2));
					$text=date("h:i",strtotime($time1.":".$t2))." ".$timepart;
					?>	
					<option value="<?php echo $value?>" <?php if(date("H:i",strtotime($row_deal['deal_start_time']))==$value && isset($row_deal['deal_start_time'])){echo "selected";}?>><?php echo $text?></option>
					
					<?php	
					}
					$time1++;
					}
					?>
					
					</select>
					to
					<select name="deal_end_time" id="deal_end_time">
					<?php 
					
					$time1=0;
					$timepart="AM";
					for($t1=0;$t1<=23; $t1++){
					
					if($time1>11)
					{ $time1=0;
					$timepart="PM";}
					for($t2=0;$t2<60;$t2=$t2+15){
					
					//$time = date( "h:i:s", strtotime($end) - strtotime($start) ) ; 
					$value=date("H:i",strtotime($t1.":".$t2));
					$text=date("h:i",strtotime($time1.":".$t2))." ".$timepart;
					?>	
					<option value="<?php echo $value?>" <?php if(date("H:i",strtotime($row_deal['deal_end_time']))==$value && isset($row_deal['deal_end_time'])){echo "selected";}?>><?php echo $text?></option>
					
					<?php	
					}
					$time1++;
					}
					?>
					</select>
					</td>
					</tr>
					<script>
					
					
					function repeat_until(curval){
					
					innercont='<div class="custom_end_block">'+
					'<input type="radio" value="forever" name="until" label="false" id="until_forever" checked="checked">'+
					'<label for="until_forever">I stop it</label>'+
					'</div>'+
					'<div class="custom_end_block">'+
					'<input type="radio" value="custom" name="until" label="false" id="until_custom">'+
					
					'<div ><input type="text" value="" size="10" id="repeat_date" name="repeat_date" ><span id="cal3"><img src="siteadmin/zpcal/themes/icons/calendar1.gif" width="27" height="21" style="cursor:pointer"/></span></div>'+
					
					'</div>';
					
					custominnercontent='<div class="right_column">'+
					'<input type="checkbox" value="SU" name="days_of_the_week[]" '+
					'<label for="sunday">S</label>'+
					'<input type="checkbox" value="MO" name="days_of_the_week[]" '+
					'<label for="monday">M</label>'+
					'<input type="checkbox" value="TU" name="days_of_the_week[]" '+
					'<label for="tuesday">T</label>'+
					'<input type="checkbox" value="WE" name="days_of_the_week[]" '+
					'<label for="wednesday">W</label>'+
					'<input type="checkbox" value="TH" name="days_of_the_week[]" '+
					'<label for="thursday">T</label>'+
					'<input type="checkbox" value="FR" name="days_of_the_week[]" '+
					'<label for="friday">F</label>'+
					'<input type="checkbox" value="SA" name="days_of_the_week[]" '+
					'<label for="saturday">S</label>'+
					'</div>';
					
					if(curval==''){
					document.getElementById("repeatuntil").innerHTML="<td></td>";
					document.getElementById("repeatuntil").style.display='none';
					}
					
					if(curval=='weekdays'){
					document.getElementById("repeatuntil").style.display='block';
					content='<td><strong>Repeat until:</strong></td>'+
					'<td>'+innercont+
					'</td>';
					
					}
					if(curval=='weekends'){
					document.getElementById("repeatuntil").style.display='block';
					content='<td><strong>Repeat until:</strong></td>'+
					'<td>'+innercont+
					'</td>';
					
					}
					
					if(curval=='custom'){
					document.getElementById("repeatuntil").style.display='block';
					content='<td><strong>Repeat until:</strong></td>'+
					'<td>'+custominnercontent+
					innercont+
					'</td>';
					
					}
					
					document.getElementById('repeatuntil').innerHTML=content;
					
					if(curval!=''){
					var cal = new Zapatec.Calendar.setup({
					
					inputField:"repeat_date",
					ifFormat:"%Y-%m-%d",
					button:"cal3",
					showsTime:false
					
					});
					}
					
					}
					</script>
					<tr>
					<td align="right"><strong>Repeat deal :</strong></td>
					<td><select name="repeat_deal" id="repeat_deal" onChange="repeat_until(this.value)">
					<option value="">Select</option>
					<option value="" <?php if($row_deal['nowdeal_repeatday']==''){echo "selected";}?>>Don't Repeat</option>
					<option value="weekdays" <?php if($row_deal['nowdeal_repeatday']=='weekdays'){echo "selected";}?>>Weekdays (Mon - Fri)</option>
					<option value="weekends" <?php if($row_deal['nowdeal_repeatday']=='weekends'){echo "selected";}?>>Weekends (Sat - Sun)</option>
					<option value="custom" <?php if($row_deal['nowdeal_repeatday']!='' && $row_deal['nowdeal_repeatday']!='weekdays' && $row_deal['nowdeal_repeatday']!='weekends'){echo "selected";}?>>Custom</option>
					</select>
					</td>
					</tr>
					<tr>
					<td></td>
					<td>
					<?php
					if($row_deal['nowdeal_repeatday']!=''){
					?>
					<div id="repeatuntil" > <strong>Repeat until:</strong> 
					
					<?php 
					
					if($row_deal['nowdeal_repeatday']=='weekdays' || $row_deal['nowdeal_repeatday']=='weekends'){
					
					?>
					<div class="custom_end_block">
					<input type="radio" value="forever" name="until" label="false" id="until_forever" checked="checked" <?php if(date("Y",strtotime($row_deal['nowdeal_stopdate']))<2000){echo "checked";}?>>
					<label for="until_forever">I stop it</label>
					</div>
					<div class="custom_end_block">
					<input type="radio" value="custom" name="until" label="false" id="until_custom" <?php if(date("Y",strtotime($row_deal['nowdeal_stopdate']))>2000){echo "checked";}?>>
					
					<div ><input type="text" value="<?php if(date("Y",strtotime($row_deal['nowdeal_stopdate']))>2000){echo date("Y-m-d",strtotime($row_deal['nowdeal_stopdate']));}?>" size="10" id="repeat_date" name="repeat_date"  ><span id="cal4"><img src="siteadmin/zpcal/themes/icons/calendar1.gif" width="27" height="21" style="cursor:pointer"/></span></div>
					<script>
					var cal = new Zapatec.Calendar.setup({
					
					inputField:"repeat_date",
					ifFormat:"%Y-%m-%d",
					button:"cal4",
					showsTime:false
					
					});
					</script>
					</div>
					<?php }else{
					$customval=unserialize($row_deal['nowdeal_repeatday']);
					
					?>
					
					<div class="right_column">
					<input type="checkbox" value="SU" name="days_of_the_week[]" <?php if(in_array("SU",$customval)){echo "checked";}?> />
					<label for="sunday">S</label>
					<input type="checkbox" value="MO" name="days_of_the_week[]" <?php if(in_array("MO",$customval)){echo "checked";}?> />
					<label for="monday">M</label>
					<input type="checkbox" value="TU" name="days_of_the_week[]" <?php if(in_array("TU",$customval)){echo "checked";}?> />
					<label for="tuesday">T</label>
					<input type="checkbox" value="WE" name="days_of_the_week[]" <?php if(in_array("WE",$customval)){echo "checked";}?> />
					<label for="wednesday">W</label>
					<input type="checkbox" value="TH" name="days_of_the_week[]" <?php if(in_array("TH",$customval)){echo "checked";}?> />
					<label for="thursday">T</label>
					<input type="checkbox" value="FR" name="days_of_the_week[]" <?php if(in_array("FR",$customval)){echo "checked";}?> />
					<label for="friday">F</label>
					<input type="checkbox" value="SA" name="days_of_the_week[]" <?php if(in_array("SA",$customval)){echo "checked";}?> />
					<label for="saturday">S</label>
					</div>
					
					<div class="custom_end_block">
					<input type="radio" value="forever" name="until" label="false" id="until_forever"  <?php if(date("Y",strtotime($row_deal['nowdeal_stopdate']))<2000){echo "checked";}?>>
					<label for="until_forever">I stop it</label>
					</div>
					<div class="custom_end_block">
					<input type="radio" value="custom" name="until" label="false" id="until_custom" <?php if(date("Y",strtotime($row_deal['nowdeal_stopdate']))>2000){echo "checked";}?>>
					
					<div ><input type="text" value="<?php if($row_deal['nowdeal_stopdate']!=''){echo date("Y-m-d",strtotime($row_deal['nowdeal_stopdate']));}?>" size="10" id="repeat_date" name="repeat_date"  ><span id="cal4"><img src="siteadmin/zpcal/themes/icons/calendar1.gif" width="27" height="21" style="cursor:pointer"/></span></div>
					<script>
					var cal = new Zapatec.Calendar.setup({
					
					inputField:"repeat_date",
					ifFormat:"%Y-%m-%d",
					button:"cal4",
					showsTime:false
					
					});
					</script>
					
					</div>
					<?php }?>
					
					</div>
					<?php }else{?>
					<div id="repeatuntil" style="display:none"> <strong>Repeat until:</strong> </div>
					<?php }?>
					</td>
					</tr>
					<tr>
					<td align="right"><strong>Maximum quantity :</strong></td>
					<td><div id="deal_template_max_sellable_quantity">
					<input type="checkbox" id="max_quantity_check" <?php if(!empty($row_deal['max_buy'])){echo "checked";}?> >
					<label> Sell no more than
					<input type="text" size="5" name="max_sellable_quantity" id="max_sellable_quantity" class="input" <?php if(!empty($row_deal['max_buy'])){?> value="<?php echo $row_deal['max_buy']?>" <?php }?>>
					units per day </label>
					</div></td>
					</tr>
					<tr>
					<td align="right"><strong>Maximum per purchase quantity :</strong></td>
					<td><div id="max_purchase_quantity">
					<input type="checkbox" id="max_per_purchase_quantity_check" <?php if(!empty($row_deal['max_purchase'])){echo "checked";}?>>
					<label> Sell no more than
					<input type="text"  size="5" name="max_per_purchase_quantity" id="max_per_purchase_quantity" class="input"  value="<?php if(!empty($row_deal['max_purchase'])){echo $row_deal['max_purchase'];}else{echo "4";}?>">
					per purchase </label>
					</div></td>
					</tr>
					</table>
					</fieldset>
					<script type="text/javascript" src="js/ajaxupload.3.5.js" ></script>
					<script type="text/javascript" >
					$(function(){
					var btnUpload=$('#upload');
					var status=$('#status');
					var i=1
					new AjaxUpload(btnUpload, {
					action: '<?php echo SITE_URL; ?>upload-dealfile.php',
					name: 'uploadfile',
					
					onSubmit: function(file, ext){
					if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
					// extension is not allowed 
					status.text('Only JPG, PNG or GIF files are allowed');
					return false;
					}
					status.html('<img src="images/loader.gif" >');
					},
					onComplete: function(file, response){
					//On completion clear the status
					status.text('');
					//Add uploaded file to list
					
					if((response)!=''){
					
					filname=getfilename(response);
					$('<li id="file'+response+'"></li>').appendTo('#files').html('<img src="./upload_files/files/'+filname+'" alt="" /><br/><a href="javascript:void(0)" onclick=DeletePic('+response+')>Delete</a>').addClass('success');
					i++;
					} else{
					$('<li></li>').appendTo('#files').text(filname).addClass('error');
					}
					}
					});
					
					});
					
					function DeletePic(imgid){
					urlsend="<?php echo SITE_URL;?>delete-dealfile.php?imgid="+imgid;
					urlsend=urlsend+"&sid="+Math.random();
					
					req=new XMLHttpRequest(); 
					req.open('GET',urlsend,false); 	
					req.send(null); 
					if(req.readyState==4){
					
					$("#file"+imgid).remove();
					}
					
					}
					
					function getfilename(imgid){
					
					urlsend="<?php echo SITE_URL;?>get-dealfile.php?imgid="+imgid;
					urlsend=urlsend+"&sid="+Math.random();
					
					req=new XMLHttpRequest(); 
					req.open('GET',urlsend,false); 	
					req.send(null); 
					if(req.readyState==4){
					
					
					return req.responseText;
					}
					}
					</script>
					<fieldset>
					<legend  title="Primary Location">Step 3: Add a photo</legend>
					<table width="100%" border="0" cellspacing="2" cellpadding="2">
					<tr>
					<td><ul id="files" >
					<?php
					
					$proimg="SELECT * FROM ".TABLE_DEAL_IMAGES." where deal_id='".$row_deal['deal_id']."'";
					$imgrow=$db->fetch_all_array($proimg);
					
					
					
					foreach($imgrow as $profileimg){?>
					<li id="file<?php echo $profileimg[imgid]?>" class="success">
					<img alt="" src="./upload_files/files/<?php echo $profileimg[file]?>"><br>
					<a onClick="DeletePic(<?php echo $profileimg[imgid]?>)" href="javascript:void(0)">Delete</a></li>
					<?php }?>
					</ul>
					<div style="clear:both"></div>
					<br />
					<span id="status" ></span>
					<div id="upload" ><span>Browse</span></div></td>
					</tr>
					</table>
					</fieldset>
					<dl class="submit">
					<input type="submit" name="submit" id="submit" value="Submit" style="height:30px; width:80px;"/>
					</dl>
					</form>
					<script>
					calculatedeal();
					</script>
		
		
				
				
				</div>
                    <div class="TabbedPanelsContent2">
	
<?php				
					$muser_id=intval($_SESSION['muser_id']);
					$sql = "SELECT first_name,last_name,company_name FROM `".TABLE_USERS."` WHERE user_id='$user_id'";
					$record = $db->query_first($sql);
					$sql = "SELECT * FROM `".TABLE_STORES."` WHERE merchant_id='$muser_id'";
					$store = $db->query_first($sql);
					
					$items = 5;
					$page = 1;
					
					if(isset($_GET['page']) and is_numeric($_GET['page']) and $page = $_GET['page'])
					$limit = " LIMIT ".(($page-1)*$items).",$items";
					else
					$limit = " LIMIT $items";
					
					
					
					
					$sqlStrAux ="select count(*) as total from ".TABLE_DEALS." where deal_type='dailydeal' and status<>0 and store_id='".$store['store_id']."'";
					$row_deals=$db->fetch_all_array("select * from ".TABLE_DEALS." where deal_type='dailydeal' and status<>0 and store_id='".$store['store_id']."' $limit");
					$aux = mysql_fetch_assoc(mysql_query($sqlStrAux));	
					
					
					$p = new pagination;
					$p->Items($aux['total']);
					$p->limit($items);
					$p->target($target);
					$p->currentPage($page);
					$p->calculate();
					$p->changeClass("pagination");
					
					$i=1;
					
?>
		

                
                      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="transactions_box">
                      <tr>
                        <th>Title</th>
                        <th>Start Date</th>
                        <th>Clode On</th>
                        <th>Units Sold </th>
                        <th>Units Redeemed</th>
                        <th>Your Earnings (based on redemption)</th>
                        <th>Action</th>
                      </tr>
					  <?php
						if($aux['total']>0){
						foreach($row_deals as $data){
						if($i%2 != 0){
						?>
						<tr class="gray_02">
						<?php
						}else{
						?>
						<tr class="gray_01">
						<?php
						}
						?>
						
							<td><?php if(!empty($data['title'])){echo $data['title'];}else{echo $data['title2'];}?></td>
							<td><?php echo date("Y-m-d H:i",strtotime($data['deal_start_time']))?></td>
							<td><?php echo date("Y-m-d H:i",strtotime($data['deal_end_time']))?></td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td><a href="<?php echo SITE_URL;?>merchant_adddailydeal?mode=edit&deal_id=<?php echo $data['deal_id']?>">Edit</a> <a href="#" onClick="javascript:a=confirm('Are you sure?'); if(a){location.href='<?php echo SITE_URL;?>merchant_adddailydeal?mode=delete&deal_id=<?php echo $data['deal_id']?>'}">Delete</a></td>
						</tr>
					  
					  <?php }?>
					  
					  <tr><td colspan="6" align="center"> <div align="center" style=" margin-left:150px;"><?php echo $p->show();?></div></td></tr>
					  <?php }?>
					  
                    </table>

                    </div>
                    <div class="TabbedPanelsContent2">
                
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
					
					  
                    </div>

					
                   <div class="clear"></div> 
                  </div>
                  
                </div>
               <div class="clear"></div>
              </div>
			
			<div class="clear"></div>
			</div>
		   
		   
				
           <div>&nbsp;</div>
		
			 <div class="clear"></div>
			 
	<?php require("include/merchant_footer.inc.php"); ?>   				
		
	  <div class="clear"></div>
	</div>

<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
</script>
<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels2");
</script>
</body>
</html>
