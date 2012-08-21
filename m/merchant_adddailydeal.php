<?php
include("include/m_header.php");
$mode=isset($_REQUEST['mode'])?$_REQUEST['mode']:'add';
$deal_id=isset($_REQUEST['deal_id'])?$_REQUEST['deal_id']:'';

$user_id=intval($_SESSION['muser_id']);
$sql = "SELECT first_name,last_name,company_name FROM `".TABLE_USERS."` WHERE user_id='$user_id'";
$record = $db->query_first($sql);



if($mode=="edit")
{
	
	$row_deal=mysql_fetch_array(mysql_query("select * from ".TABLE_DEALS." where deal_id='$deal_id'"));
	
	$row_img=mysql_query("select * from ".TABLE_DEAL_IMAGES." where deal_id='$deal_id'");
	
}

if($mode=="delete")
{
	
	mysql_query("delete from ".TABLE_DEALS." where deal_id='$deal_id'");
	
	$fileq=mysql_query("SELECT * FROM ".TABLE_DEAL_IMAGES." where deal_id='".$deal_id."'");
		while($frow=mysql_fetch_array($fileq)){
		@unlink("files/".$frow['file']);
		@unlink("thumbnails/".$frow['file']);
		}
		mysql_query("delete from ".TABLE_DEAL_IMAGES." where deal_id='$deal_id'");
	
	$_SESSION['msg']="Deal is deleted successfully";
	header("location:".SITE_URL."merchant_dailydealactive");	
	exit;			
}





if(isset($_REQUEST['submit']) ){


	$data['deal_cat']=$_POST['deal_cat'];
	$data['store_id']=$_POST['store_id'];
	$data['location_id']=$_POST['location_id'];
	$data['city']=$_POST['city'];
	$data['title']=$_POST['title'];
	$data['description']=$_POST['description'];

	$data['full_price']=$_POST['retailvalue'];
	//$data['discounted_price']=$_POST['discounted_price'];
	$data['discounted_price']=$_POST['customerdisc'];
	$data['wakadeal_comission']=$_POST['wakadealfee'];
	
	
	$data['custpercent']=$_POST['custpercent'];
	$data['merchant_take']=$_POST['merchant_take'];
	$data['merchantpercent']=$_POST['merchantpercent'];
	$data['waka_percent']=$_POST['wakapercent'];
	
	$data['deal_start_time']=$_POST['deal_start_time'];	
	$data['deal_end_time']=$_POST['deal_end_time'];
	
	$data['mid']=$_POST['mid'];

	

	$data['coupon_expiry']=$_POST['coupon_expiry'];
	$data['max_coupons']=$_POST['max_coupons'];

		
	$data['date_added']=date("Y-m-d");			
	$data['address1']=$_POST['address1'];
		

	
	
	$data['offer_details']=$_POST['offer_details'];
	$data['website']=$_POST['website'];	
	$data['item_type']=$_POST['item_type'];	
	$data['brand']=$_POST['brand'];	
	$data['deal_type']='dailydeal';

if($data['deal_cat']=='' || $data['store_id']=='' || $data['location_id']=='' ||  $data['title']==''  ){
	$_SESSION['errmsg']="Please enter valid details for a deal";
	header("location:".SITE_URL."merchant_adddailydeal");
	exit;
	}
	
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
	//print_r($pr);
	$location = $pr[0];
	//print_r($location);
	$loc = $location[lat][0];
	$lng = $location[lng][0];
	
	$data['place_lat']=$loc;
	$data['place_lng']=$lng;
	
	

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
	
					
	if($mode=="edit")
	{				
		
		$db->query_update(TABLE_DEALS, $data, "deal_id='$deal_id'");
		
		$dataimg['deal_id']=$deal_id;	
		
		$db->query_update(TABLE_DEAL_IMAGES, $dataimg, "deal_id='".$_SESSION["session_temp"]."'");
		
		$mdata['user_id']=$_POST['mid'];
		$mdata['deal_id']=$deal_id;
		$db->query_update(TABLE_DEALS_MERCHANT, $mdata, "deal_id='$deal_id'");
		
		
		
				
		$_SESSION['msg']="Deal is updated successfully.";
		header("location:".SITE_URL."merchant_adddailydeal");	
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
		
		$dataimg['deal_id']=$primary_id;	
					
		$db->query_update(TABLE_DEAL_IMAGES, $dataimg, "deal_id='".$_SESSION["session_temp"]."'");
	
	
		$_SESSION['msg']="Deal is added successfully.";
		header("location:".SITE_URL."merchant_adddailydeal");	
		exit;
	}
		
	
}


									

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
$_SESSION["session_temp"] =$deal_id;
}else{
$_SESSION["session_temp"] =uniqid();
}


?>
<body>
	<div style="margin-top: 10px;" id="maincontainer">
    
		    <?php include("merchant_menu_section.php"); ?>
           
		   
			<div class="main_box white_bg">
			<div class="clear"></div>
			
             <div class="main_box">
             
              <div id="TabbedPanels2" class="TabbedPanels2">
              <ul class="TabbedPanelsTabGroup2">
                <li class="TabbedPanelsTab2" tabindex="0">Create a Daily Deal</li>
                <li class="TabbedPanelsTab2" tabindex="0">Active Deals</li>
                <li class="TabbedPanelsTab2" tabindex="0">Close Deals</li>
              </ul>
              <div class="TabbedPanelsContentGroup2">
                <div class="TabbedPanelsContent2">
				
				<!-- START OF FORM APPLICATION -->
					<form method="post" class="niceform2">
					<input type="hidden" name="mid" value="<?php echo $_SESSION['muser_id']?>" />
					<input type="hidden" name="mode" value="<?php echo $mode?>" />
					<input type="hidden" name="deal_id" value="<?php echo $deal_id?>" />
					
					<style>
					.dealcalcbox{
					width:40px; height:25px; border:1px solid #cccccc; padding:2px;
					}		
					
					.dealcalctxtbox{
					padding:4px; border-right:1px solid #000000;text-align:center
					}
					</style>		
					
					
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
					document.getElementById('mpercent').value=merchantpercent;
					
					
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
						
						document.getElementById('title1').innerHTML="$"+(totalv.toFixed(2))+" for $"+retail.toFixed(2)+" at "+document.getElementById('storename').value+"<br />"+custpercent.toFixed(2)+" % off "+document.getElementById('description').value;
					
						
						document.getElementById('title2').innerHTML="$"+(totalv.toFixed(2))+" for "+document.getElementById('description').value+" at "+document.getElementById('storename').value+"<br />"+custpercent.toFixed(2)+" % off ";
						
						document.getElementById('title11').value=document.getElementById('title1').innerHTML;
						document.getElementById('title22').value=document.getElementById('title2').innerHTML;
						
						
						
						}
					
					
					}
					
					
					
					
					</script>
					<table width="630" border="0" cellspacing="5" cellpadding="5">
					<tr>
					<td align="right" width="100"><strong>Set Deal Value:</strong></td>
					<td  ><br /><table width="100%" border="0" cellspacing="0" cellpadding="0" >
					<tr style="background-color:#cccccc;">
					<td style="padding:5px;">Regular Price</td>
					<td style="padding:5px;">Discount Price</td>
					<td style="padding:5px;">% Off</td>
					<td style="padding:5px;">Merchant's Take</td>
					<td style="padding:5px;">Wakadeal Fee</td>
					</tr>
					<?php
						
						
						$sql = "SELECT * FROM `".TABLE_SETTING."` WHERE name='dailydeal_fee'";
						$fee = $db->query_first($sql);
						$retailvalue=isset($row_deal['full_price'])?$row_deal['full_price']:20;
						$customerdisc=isset($row_deal['discounted_price'])?$row_deal['discounted_price']:10;
						$custpercent=isset($row_deal['custpercent'])?$row_deal['custpercent']:50;
						$merchant_take=isset($row_deal['merchant_take'])?$row_deal['merchant_take']:7.5;
						$merchantpercent=isset($row_deal['merchantpercent'])?$row_deal['merchantpercent']:75;
						$waka_percent=isset($row_deal['waka_percent'])?$row_deal['waka_percent']:$fee['value'];
						$wakadeal_comission=isset($row_deal['wakadeal_comission'])?$row_deal['wakadeal_comission']:2.5;
								  ?>
					<tr style="background-color:#F3F3F3">
					<input type="hidden" value="<?php echo $row_stores['store_name'];?>" name="storename"  id="storename"/>
					<td class="dealcalctxtbox">$
					<input type="text" id="retailvalue" name="retailvalue" value="<?php echo $retailvalue?>" class="dealcalcbox"  onkeyup="calculatedeal('retail')" onBlur="calculatedeal('retail')" onKeyPress="return numbersonly(event)" /></td>
					<td class="dealcalctxtbox">$
					<input type="text" id="customerdisc" name="customerdisc" class="dealcalcbox"  value="<?php echo $customerdisc?>" onKeyUp="calculatedeal('customer')" onBlur="calculatedeal('customer')" onKeyPress="return numbersonly(event)" /></td>
					<td style="padding:4px; border-right:1px solid #000000;text-align:center"><input type="text" id="custpercent" value="<?php echo $custpercent?>" name="custpercent"  size="2" readonly="">
					%</td>
					<td class="dealcalctxtbox">$
					<input type="text" id="merchant_take"  name="merchant_take"  size="5"  value="<?php echo $merchant_take?>"  readonly="" />
					 <input type="hidden" name="merchantpercent" id="mpercent" value="<?php echo $merchantpercent?>" />
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
					<td style="text-align:right; vertical-align:top; width:10px;"><input type="radio" value="title2" id="title22"  name="title" onClick="this.value=document.getElementById('title2').innerHTML;document.getElementById('title11').checked=false" <?php if(!empty($row_deal['title2'])){ echo "checked";}?>/></td>
					<td><span id='title2' >$10 for $20 at Kates Cars<br />
					50% off desc test cx sdfsd</span></td>
					</tr>
					</table></td>
					</tr>
					
					<tr>
					<td align="right" style="vertical-align:top"><strong>Store Location:</strong></td>
					<td>
								<input type="hidden" name="store_id" value="<?php echo $m_store->store_id?>">
								<select name="location_id" class="dropdown" id="location_id"  size="1">
									<option value="">-- Select --</option>
									<?php												
													
										$sql_stores=mysql_query("select location_id,location_name from " .TABLE_STORES_LOCATION." where 1=1 and store_id='".$row_stores['store_id']."' order by location_name asc");
										while($row_stores=mysql_fetch_array($sql_stores))
										{	
																								
									?>
									<option value="<?php echo $row_stores[location_id];?>" <?php if($row_stores[location_id]==$row_deal[location_id]) { echo "selected"; }?>><?php echo $row_stores[location_name];?></option>
									<?php
										}
									?>			
								</select></td>
					</tr>
					
					<tr>
					<td align="right" style="vertical-align:top"><strong>Deal Category:</strong></td>
					<td> <select name="deal_cat" class="dropdown" id="deal_cat" onChange="getCity('<?php echo SITE_URL;?>findsubcat?cat_id='+this.value)" size="1">
									<option value="">-- Select --</option>
									<?php												
															
										$sql_categories=mysql_query("select cat_name,cat_id from " .TABLE_CATEGORIES." where parent_id=0 order by cat_name asc");
										while($row_categories=mysql_fetch_array($sql_categories))
										{												
									?>
									
											<option value="<?php echo $row_categories[cat_id];?>" <?php if($row_categories[cat_id]==$row_deal[deal_cat]) { echo "selected"; }?>><?php echo $row_categories[cat_name];?></option>
									<?php
										}
									?>			
								</select></td>
					</tr>
					
					
					
					<tr>
					<td align="right" style="vertical-align:top"><strong>Website:</strong></td>
					<td><input type="text" name="website" id="website" size="54" value="<?php echo stripslashes($row_deal[website]);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></td>
					
					</tr>
					
					<tr>
					<td align="right" style="vertical-align:top"><strong>Deal Start Time:</strong></td>
					<td><input type="text" name="deal_start_time" id="my_date_field" size="20" value="<?php if(!empty($row_deal[deal_start_time])){echo date("Y-m-d H:i",strtotime($row_deal[deal_start_time]));}?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /><span id="cal1"><img src="siteadmin/zpcal/themes/icons/calendar1.gif" width="27" height="21" style="cursor:pointer"/></span>
									 <script type="text/javascript">
									  var cal = new Zapatec.Calendar.setup({
									  
									  inputField:"my_date_field",
									  ifFormat:"%Y-%m-%d %H:%M",
									  button:"cal1",
									  showsTime:false
									
									  });
									  
									 </script> </span></td>
					
					</tr>
					
					
					<tr>
					<td align="right" style="vertical-align:top"><strong>Deal End Time:</strong></td>
					<td><input type="text" name="deal_end_time" id="my_date_field2" size="20" value="<?php  if(!empty($row_deal[deal_end_time])){echo date("Y-m-d H:i",strtotime($row_deal[deal_end_time]));}?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /><span id="cal2"><img src="siteadmin/zpcal/themes/icons/calendar1.gif" width="27" height="21" style="cursor:pointer"/></span>
									 <script type="text/javascript">
									  var cal = new Zapatec.Calendar.setup({
									  
									  inputField:"my_date_field2",
									  ifFormat:"%Y-%m-%d %H:%M",
									  button:"cal2",
									  showsTime:false
									
									  });
									  
									 </script> </span></td>
					
					</tr>
					
					<tr>
					<td align="right" style="vertical-align:top"><strong>Max Coupons:</strong></td>
					<td><input type="text" name="max_coupons" id="max_coupons" size="10" value="<?php echo stripslashes($row_deal['max_coupons']);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></td>
					
					</tr>
					
					<tr>
					<td align="right" style="vertical-align:top"><strong>Details:</strong></td>
					<td><?php										
									$oFCKeditor = new FCKeditor('offer_details');
									$oFCKeditor->BasePath = 'fckeditor/';
									$oFCKeditor->Value = stripslashes($row_deal['offer_details']) ;
									$oFCKeditor->Width = '100%' ;
									$oFCKeditor->Height = '200' ;
									$oFCKeditor->ToolbarSet = 'Basic';
									$oFCKeditor->Create();
								?>	</td>
					
					</tr>
					
					
					
					
					<tr><td colspan="2" align="center" style="padding-left: 300px;">  <input type="hidden" name="store_id" value="<?php echo $store_id?>" /><input type="submit" name="submit" id="submit" value="Submit" style="width:80px; height:30px; cursor:pointer;"/></td></tr>
					
					</table>
					
					
					</form>
					
					
					<script>
					calculatedeal();
					</script>
					
					<div>
					<span style="font-weight:bold">Upload Files:</span>	
					
					
						<!-- <iframe src="uploader/example/uploader" width="600" frameborder="0" scrolling="no"></iframe>-->
						<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/themes/base/jquery-ui.css" id="theme">
						<link rel="stylesheet" href="<?php echo SITE_URL?>siteadmin/js/uploader/jquery.fileupload-ui.css">
						
						<div id="fileupload">
							<form action="<?php echo SITE_URL;?>upload.php" method="POST" enctype="multipart/form-data">
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
						<script src="<?php echo SITE_URL?>siteadmin/js/uploader/jquery.iframe-transport.js"></script>
						<script src="<?php echo SITE_URL?>siteadmin/js/uploader/jquery.fileupload.js"></script>
						<script src="<?php echo SITE_URL?>siteadmin/js/uploader/jquery.fileupload-ui.js"></script>
						<script src="<?php echo SITE_URL?>siteadmin/js/uploader/application.js"></script>
						
						<!-- END OF FORM SECTION -->
						
						</div>
						  
					  
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
					
					
					
					
					$sqlStrAux ="select count(*) as total from ".TABLE_DEALS." where deal_type='dailydeal' and status=0  and store_id='".$store['store_id'] ."' ";
					$row_deals=$db->fetch_all_array("select * from ".TABLE_DEALS." where deal_type='dailydeal' and status=0 and store_id='".$store['store_id'] ."' $limit");
					$aux = mysql_fetch_assoc(mysql_query($sqlStrAux));	
					
					
					$p = new pagination;
					$p->Items($aux['total']);
					$p->limit($items);
					$p->target($target);
					$p->currentPage($page);
					$p->calculate();
					$p->changeClass("pagination");
					$i=0;
					
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
					<td><a href="#">Edit</a> <a href="#">Delete</a></td>
					</tr>
					
					<?php }?>
					
					<tr><td colspan="6" align="center"> <div align="center" style=" margin-left:150px;"><?php echo $p->show();?></div></td></tr>
					<?php }else{?>
					<tr>
					<td style="height:50px; padding-left: 280px; padding-top: 20px;"><label style="color:#333333; font-weight:bold;">No Deal Found</label></td>
					</tr>
					<?php } ?>
					</table>
					
					  
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
