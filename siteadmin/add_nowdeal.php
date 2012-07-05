<?php
include("include/header.php");

$admin_id=intval($_SESSION['admin_id']);
$sql = "SELECT admin_name FROM `".TABLE_ADMIN."` WHERE admin_id='$admin_id'";
$record = $db->query_first($sql);



if($_REQUEST[mode]=="edit")
{
	$deal_id=intval($_REQUEST['id']);
	$row_deals=mysql_fetch_array(mysql_query("select * from ".TABLE_DEALS." where deal_id='$deal_id'"));
	
	$row_img=mysql_query("select * from ".TABLE_DEAL_IMAGES." where deal_id='$deal_id'");
}

if($_REQUEST[mode]=="delete")
{
	$deal_id=intval($_REQUEST['id']);
	mysql_query("delete from ".TABLE_DEALS." where deal_id='$deal_id'");
	
	$fileq=mysql_query("SELECT * FROM ".TABLE_DEAL_IMAGES." where deal_id='".$deal_id."'");
		while($frow=mysql_fetch_array($fileq)){
		@unlink("files/".$frow['file']);
		@unlink("thumbnails/".$frow['file']);
		}
		mysql_query("delete from ".TABLE_DEAL_IMAGES." where deal_id='$deal_id'");
	$_SESSION['msg']="Deal is deleted successfully.";
		header("location:show_deals.php");	
		exit;			
}





if(isset($_REQUEST['submit']))
{
	$data['deal_cat']=$_POST['deal_cat'];
	
	$data['location_id']=$_POST['location_id'];
	$data['city']=$_POST['city'];
	$data['title']=$_POST['title'];
	$data['description']=$_POST['description'];

	$data['offer_details']=$_POST['offer_details'];
	
	$data['full_price']=$_POST['full_price'];
	$data['discounted_price']=$_POST['discounted_price'];
	$data['wakadeal_comission']=$_POST['wakadealfee'];
	$data['custpercent']=$_POST['custpercent'];
	$data['merchant_take']=$_POST['merchant_take'];
	$data['merchantpercent']=$_POST['merchantpercent'];
	$data['waka_percent']=$_POST['wakapercent'];
	$data['deal_start_time']=$_POST['deal_start']." ".$_POST['deal_start_time'];	
	$data['deal_end_time']=$_POST['deal_start']." ".$_POST['deal_end_time'];
	
	if(isset($_POST['days_of_the_week'])){
		$data['nowdeal_repeatday']=serialize($_POST['days_of_the_week']);
		}else{
		$data['nowdeal_repeatday']=$_POST['repeat_deal'];
		}
	
	$data['nowdeal_stopdate']=$_POST['repeat_date'];
	
	$data['status']=$_POST['status'];
	$data['mid']=$_POST['mid'];
	$data['admin_id']=intval($_SESSION['admin_id']);
	$data['coupon_expiry']=$_POST['coupon_expiry'];
	$data['min_coupons']=$_POST['min_coupons'];
	$data['max_coupons']=$_POST['max_coupons'];
	
	$data['max_buy']=$_POST['max_buy'];
	$data['max_purchase']=$_POST['max_purchase'];
	$data['date_added']=date("Y-m-d");			
	
	
	$data['website']=$_POST['website'];				

	$data['offer_details']=$_POST['offer_details'];




	$data['best_deal']=$_POST['best_deal'];	
	$data['deal_type']='nowdeal';
	$data['item_control_type']=$_POST['item_control_type'];	
	$data['referral_no']=$_POST['referral_no'];	
	$data['referral_value']=$_POST['referral_value'];	
	/********************** Code for Getting Latitude and Longitude Starts *********************/

	$address1=str_replace(" ","+",$_POST['address1']);
	$address2=str_replace(" ","+",$_POST['address2']);				
	$city=str_replace(" ","+",$_POST['city']);				
	$state=str_replace(" ","+",$_POST['state']);
	
	$concat_address=$address1."+".$address2."+".$city;
	
	$xml = "http://maps.googleapis.com/maps/api/geocode/xml?address=".$concat_address."&sensor=false";
				
	// create a new object
	$parser = new SimpleLargeXMLParser();
	// load the XML
	$parser->loadXML($xml);
	$pr= $parser->parseXML("//result/geometry/location");

	$location = $pr[0];
	
	$loc = $location[lat][0];
	$lng = $location[lng][0];
	
	$data['place_lat']=$loc;
	$data['place_lng']=$lng;
	
	
						
	$sql="SELECT * FROM ".TABLE_STORES_LOCATION." where 1=1 and  ".TABLE_STORES_LOCATION.".location_id='".$_POST['location_id']."'";
																				
	$m_store=mysql_fetch_object(mysql_query($sql));
	
	$data['store_id']=$m_store->store_id;
									

/********************** Code for Getting Latitude and Longitude Ends *********************/				
		/* --------------------mail to similar users -----------------*/
		$usersql=mysql_query("SELECT * FROM ".TABLE_USERS." where password<>''");
		
		while($userrow=mysql_fetch_array($usersql)){
			$city=$db->fetch_all_array("SELECT city_name as city FROM ".TABLE_CITIES." JOIN ".TABLE_USER_SUBSCRIPTION." on(".TABLE_CITIES.".city_id=".TABLE_USER_SUBSCRIPTION.".city_id) and ".TABLE_USER_SUBSCRIPTION.".user_id='".$userrow['user_id']."'");
			$category=$db->fetch_all_array("SELECT cat_id as category FROM ".TABLE_CATEGORIES." JOIN ".TABLE_USER_PREFERENCE." on(".TABLE_CATEGORIES.".cat_id=".TABLE_USER_PREFERENCE.".category_id) and ".TABLE_USER_PREFERENCE.".user_id='".$userrow['user_id']."'");
			
					
				foreach($city as $usercity){
					if($usercity['city_name']==$_POST['city']){
					$usermail[]=$userrow['email'];
					}
				}
				
				foreach($category as $usercat){
					if($usercat['category']==$_POST['deal_cat']){
					$usermail[]=$userrow['email'];
					}
				}
			
			}
				$to  = implode(",",array_unique($usermail));
			
				
				$subject = $_POST['brand']." from GeeLaza.com ";
				$txt = "New offer is created in your city ".$_POST['city']."<br />";
				$txt .= " Offer :<b>".$_POST['title']."</b><br/>";
				
				$sql="SELECT * FROM ".TABLE_ADMIN." where admin_name='admin'";
				$admin=$db->query_first($sql);
				
				$txt .= " Please visit the link :".SITE_URL."city/".str_replace(" ","-",trim(strtolower($_POST['city'])))."/offer/".str_replace(" ","-",trim(strtolower($_POST['brand'])))."<br/>";
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= "From: GeeLaza.com<".$admin['email'].">". "\r\n" ;
				
				$status=@mail($to,$subject,$txt,$headers);
	
					
	if($_REQUEST['mode']=="edit")
	{				
		$deal_id=intval($_REQUEST['id']);
		$db->query_update(TABLE_DEALS, $data, "deal_id='$deal_id'");
		
		$dataimg['deal_id']=$deal_id;	
		
		$db->query_update(TABLE_DEAL_IMAGES, $dataimg, "deal_id='".$_SESSION["session_temp"]."'");
		
		$mdata['user_id']=$_POST['mid'];
		$mdata['deal_id']=$deal_id;
		$db->query_update(TABLE_DEALS_MERCHANT, $mdata, "deal_id='$deal_id'");
		
		
		
				
		$_SESSION['msg']="Deal is updated successfully.";
		header("location:show_nowdeals.php");	
		exit;	

	}
	else
	{
	
	if(date('Y-m-d H:i',strtotime($data['deal_start_time']))>date('Y-m-d H:i')){
		$data['status']=2;
		}
		
		$primary_id=$db->query_insert(TABLE_DEALS, $data);
		
		$mdata['user_id']=$_POST['mid'];
		$mdata['deal_id']=$primary_id;
		$db->query_insert(TABLE_DEALS_MERCHANT, $mdata);
		
		$dataimg['deal_id']=$primary_id;	
					
		$db->query_update(TABLE_DEAL_IMAGES, $dataimg, "deal_id='".$_SESSION["session_temp"]."'");
	
	
		$_SESSION['msg']="Deal is created successfully.";
		header("location:show_nowdeals.php");	
		exit;
	}
		
	
}
if($_REQUEST['mode']=='edit' || $_REQUEST['mode']=='delete'){
$_SESSION["session_temp"] =$deal_id;
}else{
$_SESSION["session_temp"] =uniqid();
}



  
	$fee = mysql_fetch_assoc(mysql_query("SELECT * FROM `".TABLE_SETTING."` WHERE name='deal_fee'"));
	$retailvalue=!empty($row_deals['full_price'])?$row_deals['full_price']:20;
	$customerdisc=!empty($row_deals['discounted_price'])?$row_deals['discounted_price']:10;
	$custpercent=!empty($row_deals['custpercent'])?$row_deals['custpercent']:50;
	$merchant_take=!empty($row_deals['merchant_take'])?$row_deals['merchant_take']:7.5;
	$waka_percent=!empty($row_deals['waka_percent'])?$row_deals['waka_percent']:$fee['value'];
	$wakadeal_comission=!empty($row_deals['wakadeal_comission'])?$row_deals['wakadeal_comission']:2.5;
	$merchantpercent=!empty($row_deals['merchantpercent'])?$row_deals['merchantpercent']:75;
	
?>




    
    <div class="main_content">
    
      <?php include("include/top_menu.inc.php");?>                    
                    
    <div class="center_content">  
    
   		<?php require("include/left_menu.php"); ?>        
    
    <div class="right_content">  
	
		 
		 <div class="form">
		 
		 
		 <?php
				if($_REQUEST['mode']=="edit")
				{
		?>
					<h1>Edit Now Deal</span></h1>
					<form method="post" action="?id=<?php echo $deal_id;?>&mode=edit" enctype="multipart/form-data" class="niceform2">
			
		<?php
				}
				else
				{
		?>
					<h1>Add Now Deal</span></h1>
					<form method="post" action="" enctype="multipart/form-data" class="niceform2">
					
			
		<?php
				}
		?>
         
                <fieldset>
				
				<script>
				function getStore(mid){
				
				var urlsend="ajax_storelocation.php?";  
				urlsend=urlsend+"merchant_id="+mid;		
				urlsend=urlsend+"&sid="+Math.random();
					
				
				req=new XMLHttpRequest(); 
					req.open('GET',urlsend,false); 	
					req.send(null); 
					
							if(req.readyState==4){
								
								document.getElementById("location_id").innerHTML=req.responseText;
								
						}
				
				
				}
				
				</script>
				
				<dl>
                        <dt><label for="gender">Merchant Name:</label></dt>
                        <dd>
                            <select name="mid" class="dropdown" id="merchant_name" onChange="getStore(this.value)">
													<option value="">-- Select --</option>
													
													<?php
													
														$sql_owners=mysql_query("select company_name,first_name,last_name,user_id from " .TABLE_USERS." where status=1 and reg_type='merchant' order by company_name asc");
														while($row_owners=mysql_fetch_array($sql_owners))
														{
														
														$sql="SELECT * FROM ".TABLE_DEALS_MERCHANT." JOIN ".TABLE_DEALS." on(".TABLE_DEALS_MERCHANT.".deal_id=".TABLE_DEALS.".deal_id) where 1=1 and ".TABLE_DEALS_MERCHANT.".user_id='".$row_owners[user_id]."' and  ".TABLE_DEALS_MERCHANT.".deal_id='".$row_deals[deal_id]."'";
																										
														$m_deal=mysql_fetch_object(mysql_query($sql));
													?>
													
															<option value="<?php echo $row_owners[user_id];?>" <?php if($row_owners[user_id]==$m_deal->user_id) { echo "selected"; }?>><?php echo $row_owners[company_name]."(".$row_owners[first_name]." ".$row_owners[last_name].")";?></option>
													<?php
														}
													?>													
													
												</select>
                        </dd>
                    </dl>
					
					<dl>
                        <dt><label for="gender">Store Location:</label></dt>
                        <dd>
                            <input type="hidden" name="store_id" value="<?php echo $m_store->store_id?>">
						    <select name="location_id" class="dropdown" id="location_id"  size="1">
								<option value="">-- Select --</option>
                                <?php												
												
									$sql_stores=mysql_query("select location_id,location_name from " .TABLE_STORES_LOCATION." where 1=1 and store_id='".$row_deals[store_id]."' order by location_name asc");
									while($row_stores=mysql_fetch_array($sql_stores))
									{	
									
									
																									
								?>
								
										<option value="<?php echo $row_stores[location_id];?>" <?php if($row_stores[location_id]==$row_deals[location_id]) { echo "selected"; }?>><?php echo $row_stores[location_name];?></option>
								<?php
									}
								?>			
                            </select>
                        </dd>
                    </dl>
					
					
					<dl>
                        <dt><label for="gender">Deal Category:</label></dt>
                        <dd>
                            <select name="deal_cat" class="dropdown" id="deal_cat" onChange="getCity('findsubcat.php?cat_id='+this.value)" size="1">
								<option value="">-- Select --</option>
                                <?php												
														
									$sql_categories=mysql_query("select cat_name,cat_id from " .TABLE_CATEGORIES." where parent_id=0 order by cat_name asc");
									while($row_categories=mysql_fetch_array($sql_categories))
									{												
								?>
								
										<option value="<?php echo $row_categories[cat_id];?>" <?php if($row_categories[cat_id]==$row_deals[deal_cat]) { echo "selected"; }?>><?php echo $row_categories[cat_name];?></option>
								<?php
									}
								?>			
                            </select>
                        </dd>
                    </dl>
					
				
                    <dl>
                        <dt><label for="email">Deal Name:</label></dt>
                        <dd><input type="text" name="title" id="title" size="54" value="<?php echo stripslashes($row_deals[title]);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>
                   
					
					<dl>
                        <dt><label for="email">Website:</label></dt>
                        <dd><input type="text" name="website" id="website" size="54" value="<?php echo stripslashes($row_deals[website]);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>
                    				
					<dl>
                        <dt><label for="email">Accept Wakadeals beginning :</label></dt>
                        <dd>
						
						
						<input type="textbox" size="10" name="deal_start"  id="deal_start" value="<?php if($row_deals['deal_start_time']){echo date("Y-m-d",strtotime($row_deals['deal_start_time']));}?>"/>
          <span id="cal2"><img src="zpcal/themes/icons/calendar1.gif" width="27" height="21" style="cursor:pointer"/></span>
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
			 <option value="<?php echo $value?>" <?php if(date("H:i",strtotime($row_deals['deal_start_time']))==$value && !empty($row_deals['deal_start_time'])){echo "selected";}?>><?php echo $text?></option>
			
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
			 <option value="<?php echo $value?>" <?php if(date("H:i",strtotime($row_deals['deal_end_time']))==$value && !empty($row_deals['deal_end_time'])){echo "selected";}?>><?php echo $text?></option>
			
			<?php	
					}
				$time1++;
				}
		   ?>
          </select>
		  
						</dd>
								 
								 
								 
                    </dl>
                   
					
					<dl>
                        <dt><label for="email">Max Coupons:</label></dt>
                        <dd><input type="text" name="max_coupons" id="max_coupons" size="10" value="<?php echo stripslashes($row_deals['max_coupons']);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>
                    <dl>
                        <dt><label for="password">Original Price:</label></dt>
                        <dd><input type="text" onkeyup="calculatedeal('retail')" onblur="calculatedeal('retail')" onkeypress="return numbersonly(event)"  name="full_price" id="retailvalue" size="10" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" value="<?php echo $retailvalue?>" /></dd>
                    </dl>
					
					<dl>
                        <dt><label for="email">Discount Price:</label></dt>
                        <dd><input type="text" onkeyup="calculatedeal('customer')" onblur="calculatedeal('customer')" onkeypress="return numbersonly(event)" name="discounted_price" id="customerdisc" size="10" value="<?php echo $customerdisc;?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>
					<dl>
                        <dt><label for="email">Wakadeal Comission:</label></dt>
                        <dd><input type="text" name="wakadeal_comission" id="wakafee" size="10" value="<?php echo $wakadeal_comission;?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" />
						<span  id="wakadealpercent"><?php echo $waka_percent?></span>%
						</dd>
                    </dl>
					<dl>
                        <dt><label for="email">Customer Percent:</label></dt>
                        <dd><input type="text" name="custpercent" id="custpercent" size="10" value="<?php echo $custpercent;?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>
					<dl>
                        <dt><label for="email">Merchant Take:</label></dt>
                        <dd><input type="text" name="merchant_take" id="merchant_take" size="10" value="<?php echo $merchant_take;?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>
					<dl>
                        <dt><label for="email">Merchant Percent:</label></dt>
                        <dd><input type="text" name="merchantpercent" id="merchantpercent" size="10" value="<?php echo $merchantpercent;?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" />
						
						</dd>
                    </dl>
				 <input type="hidden" name="wakadealfee" id="wakadealfee" value="<?php echo $wakadeal_comission?>" />
                <input type="hidden" name="wakapercent" id="wakapercent" value="<?php echo $waka_percent?>" />
					<dl>
                        <dt><label for="email">Wakadeal Percent:</label></dt>
                        <dd><input type="text" name="waka_percent" id="waka_percent" size="10" value="<?php echo $waka_percent;?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>
	
				
					<dl>
                        <dt><label for="referral_no">Referral Number:</label></dt>
                        <dd><input type="text" name="referral_no" id="referral_no" size="10" value="<?php echo stripslashes($row_deals['referral_no']);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>
					
					
					<dl>
                        <dt><label for="referral_value">Offer Refferal Value:</label></dt>
                        <dd><input type="text" name="referral_value" id="referral_value" size="10" value="<?php echo stripslashes($row_deals['referral_value']);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>
					
					<dl>
                        <dt><label for="referral_value">Deal Status:</label></dt>
                        <dd><select name="status" id="status">
						<option value="1" <?php if($row_deals['status']=='1'){echo "Selected";}?>>Active</option>
						<option value="0" <?php if($row_deals['status']=='0'){echo "Selected";}?>>Inactive</option>
						<option value="2" <?php if($row_deals['status']=='2'){echo "Selected";}?>>Upcoming</option>
						<option value="3" <?php if($row_deals['status']=='3'){echo "Selected";}?>>End</option>
						</select>
						</dd>
                    </dl>
					
					 <dl>
                        <dt><label for="email">Deal Schedule:</label></dt>
                        <dd>
						<strong>Repeat deal :</strong>
        <select name="repeat_deal" id="repeat_deal" onchange="repeat_until(this.value)">
            <option value="">Select</option>
            <option value="" <?php if($row_deals['nowdeal_repeatday']==''){echo "selected";}?>>Don't Repeat</option>
            <option value="weekdays" <?php if($row_deals['nowdeal_repeatday']=='weekdays'){echo "selected";}?>>Weekdays (Mon - Fri)</option>
            <option value="weekends" <?php if($row_deals['nowdeal_repeatday']=='weekends'){echo "selected";}?>>Weekends (Sat - Sun)</option>
            <option value="custom" <?php if($row_deals['nowdeal_repeatday']!='' && $row_deals['nowdeal_repeatday']!='weekdays' && $row_deals['nowdeal_repeatday']!='weekends'){echo "selected";}?>>Custom</option>
          </select>
		  <br /><br />
								<?php
		if($row_deals['nowdeal_repeatday']!=''){
		 ?>
		<div id="repeatuntil" > <strong>Repeat until:</strong> 
		
		<?php 
		
		if($row_deals['nowdeal_repeatday']=='weekdays' || $row_deals['nowdeal_repeatday']=='weekends'){
		
		?>
		<div class="custom_end_block">
                            <input type="radio" value="forever" name="until" label="false" id="until_forever" checked="checked" <?php if(date("Y",strtotime($row_deals['nowdeal_stopdate']))<2000){echo "checked";}?>>
                            <label for="until_forever">I stop it</label>
                          </div>
                          <div class="custom_end_block">
                            <input type="radio" value="custom" name="until" label="false" id="until_custom" <?php if(date("Y",strtotime($row_deals['nowdeal_stopdate']))>2000){echo "checked";}?>>
                           
                              <div ><input type="text" value="<?php if(date("Y",strtotime($row_deals['nowdeal_stopdate']))>2000){echo date("Y-m-d",strtotime($row_deals['nowdeal_stopdate']));}?>" size="10" id="repeat_date" name="repeat_date"  >
							  <span id="cal4"><img src="zpcal/themes/icons/calendar1.gif" width="27" height="21" style="cursor:pointer"/></span></div>
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
		$customval=unserialize($row_deals['nowdeal_repeatday']);
		 	
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
                            <input type="radio" value="forever" name="until" label="false" id="until_forever"  <?php if(date("Y",strtotime($row_deals['nowdeal_stopdate']))<2000){echo "checked";}?>>
                            <label for="until_forever">I stop it</label>
                          </div>
                          <div class="custom_end_block">
                            <input type="radio" value="custom" name="until" label="false" id="until_custom" <?php if(date("Y",strtotime($row_deals['nowdeal_stopdate']))>2000){echo "checked";}?>>
                           
                              <div ><input type="text" value="<?php if($row_deals['nowdeal_stopdate']!=''){echo date("Y-m-d",strtotime($row_deals['nowdeal_stopdate']));}?>" size="10" id="repeat_date" name="repeat_date"  ><span id="cal4"><img src="zpcal/themes/icons/calendar1.gif" width="27" height="21" style="cursor:pointer"/></span></div>
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
											
						</dd>
                    </dl>
					
					<dl>
                        <dt><label for="password">Maximum quantity :	</label></dt>
                        <dd>
							<input type="text" size="5" name="max_buy" id="max_sellable_quantity"   style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" value="<?php echo $row_deals['max_buy']?>" >			
						</dd>
                    </dl>
					<dl>
                        <dt><label for="password">Maximum per purchase quantity :</label></dt>
                        <dd>
							 <input type="text" size="5" name="max_purchase" id="max_per_purchase_quantity"  style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" value="<?php echo $row_deals['max_purchase']?>">		
						</dd>
                    </dl>
					
					
                    <dl>
                        <dt><label for="email">Description:</label></dt>
                        <dd><input type="text" name="description" id="description" size="54" value="<?php echo stripslashes($row_deals['description']);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" />
											
						</dd>
                    </dl>
			
					
					
					 <dl>
                        <dt><label for="password">Custom Restrictions: 	</label></dt>
                        <dd>
							<?php										
								$oFCKeditor = new FCKeditor('offer_details');
								$oFCKeditor->BasePath = '../fckeditor/';
								$oFCKeditor->Value = stripslashes($row_deals['offer_details']) ;
								$oFCKeditor->Width = '100%' ;
								$oFCKeditor->Height = '200' ;
								$oFCKeditor->ToolbarSet = 'Basic';
								$oFCKeditor->Create();
							?>						
						</dd>
                    </dl>
					
					 
					
					   
					<dl>
                        <dt><label for="bestdeal">Is it best deal?</label></dt>
                        <dd>No:
						<?php												
							if($row_deals[best_deal]=="n")
							{
						?>
								<input type="radio" value="n" name="best_deal" id="best_deal" checked="checked" >
						<?php
							}else{
							?>
							<input type="radio" value="n" name="best_deal" id="best_deal" checked="checked" >
							<?php }?>
							
							Yes:
						<?php	if($row_deals[best_deal]=="y")
							{
						?>
								<input type="radio" value="y" name="best_deal" id="best_deal" checked="checked">
								
								<?php }else{?>
								<input type="radio" value="y" name="best_deal" id="best_deal">
								<?php }?>
						
						</dd>
                    </dl>
					
					
					
                     <dl class="submit">
                    <input type="submit" name="submit" id="submit" value="Submit" />
                     </dl>
					 
                </fieldset>
                
         </form>
         </div>
		 
		 <div>
			<span style="font-weight:bold">Upload Files:</span>	
				
		
					<!-- <iframe src="uploader/example/uploader.php" width="600" frameborder="0" scrolling="no"></iframe>-->
					<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/themes/base/jquery-ui.css" id="theme">
					<link rel="stylesheet" href="js/uploader/jquery.fileupload-ui.css">
					
					<div id="fileupload">
						<form action="upload.php" method="POST" enctype="multipart/form-data">
							<div class="fileupload-buttonbar">
								<label class="fileinput-button">
									<span>Add files...</span>
									<input type="file" name="files[]" multiple>
								</label>
								<button type="submit" class="start">Start upload</button>
								<button type="reset" class="cancel">Cancel upload</button>
								<button type="button" class="delete">Delete files</button>
							</div>
						</form>
						<div class="fileupload-content">
							<table class="files"></table>
							<div class="fileupload-progressbar"></div>
						</div>
					</div>
					<script id="template-upload" type="text/x-jquery-tmpl">
						<tr class="template-upload{{if error}} ui-state-error{{/if}}">
							<td class="preview"></td>
							<td class="name">${name}</td>
							<td class="size">${sizef}</td>
							{{if error}}
								<td class="error" colspan="2">Error:
									{{if error === 'maxFileSize'}}File is too big
									{{else error === 'minFileSize'}}File is too small
									{{else error === 'acceptFileTypes'}}Filetype not allowed
									{{else error === 'maxNumberOfFiles'}}Max number of files exceeded
									{{else}}${error}
									{{/if}}
								</td>
							{{else}}
								<td class="progress"><div></div></td>
								<td class="start"><button>Start</button></td>
							{{/if}}
							<td class="cancel"><button>Cancel</button></td>
						</tr>
					</script>
					<script id="template-download" type="text/x-jquery-tmpl">
						<tr class="template-download{{if error}} ui-state-error{{/if}}">
							{{if error}}
								<td></td>
								<td class="name">${name}</td>
								<td class="size">${sizef}</td>
								<td class="error" colspan="2">Error:
									{{if error === 1}}File exceeds upload_max_filesize (php.ini directive)
									{{else error === 2}}File exceeds MAX_FILE_SIZE (HTML form directive)
									{{else error === 3}}File was only partially uploaded
									{{else error === 4}}No File was uploaded
									{{else error === 5}}Missing a temporary folder
									{{else error === 6}}Failed to write file to disk
									{{else error === 7}}File upload stopped by extension
									{{else error === 'maxFileSize'}}File is too big
									{{else error === 'minFileSize'}}File is too small
									{{else error === 'acceptFileTypes'}}Filetype not allowed
									{{else error === 'maxNumberOfFiles'}}Max number of files exceeded
									{{else error === 'uploadedBytes'}}Uploaded bytes exceed file size
									{{else error === 'emptyResult'}}Empty file upload result
									{{else}}${error}
									{{/if}}
								</td>
							{{else}}
								<td class="preview">
									{{if thumbnail_url}}
										<a href="${url}" target="_blank"><img src="${thumbnail_url}"></a>
									{{/if}}
								</td>
								<td class="name">
									<a href="${url}"{{if thumbnail_url}} target="_blank"{{/if}}>${name}</a>
								</td>
								<td class="size">${sizef}</td>
								<td colspan="2"></td>
							{{/if}}
							<td class="delete">
								<button data-type="${delete_type}" data-url="${delete_url}">Delete</button>
							</td>
						</tr>
					</script>
					<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
					<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>
					<script src="//ajax.aspnetcdn.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js"></script>
					<script src="js/uploader/jquery.iframe-transport.js"></script>
					<script src="js/uploader/jquery.fileupload.js"></script>
					<script src="js/uploader/jquery.fileupload-ui.js"></script>
					<script src="js/uploader/application.js"></script>
					
					
					
					</div>
		 
     </div><!-- end of right content-->
            
     <script>
				   
				  
				  function repeat_until(curval){
				
				  innercont='<div class="custom_end_block">'+
                            '<input type="radio" value="forever" name="until" label="false" id="until_forever" checked="checked">'+
                            '<label for="until_forever">I stop it</label>'+
                          '</div>'+
                          '<div class="custom_end_block">'+
                            '<input type="radio" value="custom" name="until" label="false" id="until_custom">'+
                           
                              '<div ><input type="text" value="" size="10" id="repeat_date" name="repeat_date" ><span id="cal3"><img src="zpcal/themes/icons/calendar1.gif" width="27" height="21" style="cursor:pointer"/></span></div>'+
                           
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
					
					
					
					
					}
				
				
				}
				
				
				
				
				</script>
				
				<script>
		calculatedeal();
		</script>         
  </div>   <!--end of center content -->  
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    	<?php require("include/footer.inc.php"); ?>   

