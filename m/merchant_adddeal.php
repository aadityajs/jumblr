<?php
include("include/m_header.php");
$action=isset($_REQUEST['action'])?$_REQUEST['action']:'';
$user_id=intval($_SESSION['muser_id']);
$sql = "SELECT first_name,last_name,company_name FROM `".TABLE_USERS."` WHERE user_id='$user_id'";
$record = $db->query_first($sql);



if(isset($_REQUEST['submit']) ){
	$data['deal_cat']=$_POST['deal_cat'];
	$data['store_id']=$_POST['store_id'];
	$data['location_id']=$_POST['location_id'];
	$data['city']=$_POST['city'];
	$data['title']=$_POST['title'];
	$data['description']=$_POST['description'];

	$data['full_price']=$_POST['full_price'];
	$data['discounted_price']=$_POST['discounted_price'];

	
	$data['deal_start_time']=$_POST['deal_start_time'];	
	$data['deal_end_time']=$_POST['deal_end_time'];
	$data['status']=$_POST['status'];
	$data['mid']=$_POST['mid'];

	$data['coupon_expiry']=$_POST['coupon_expiry'];
	$data['max_coupons']=$_POST['max_coupons'];

		
	$data['date_added']=date("Y-m-d");			
	$data['address1']=$_POST['address1'];
		

	$data['website']=$_POST['website'];				
	$data['phone1']=$_POST['phone1'];
	$data['phone2']=$_POST['phone2'];
	$data['fax']=$_POST['fax'];
	$data['offer_details']=$_POST['offer_details'];
	$data['zip']=$_POST['zip'];	
	$data['item_type']=$_POST['item_type'];	
	$data['brand']=$_POST['brand'];	


	

	
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
		header("location:merchant_adddeal.php");	
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
	
	
		$_SESSION['msg']="Deal is added successfully.";
		header("location:merchant_adddeal.php");	
		exit;
	}
		
	
}




$row_stores=mysql_fetch_array(mysql_query("SELECT * FROM ".TABLE_STORES." where merchant_id='".$_SESSION['muser_id']."'"));

$merchant=mysql_fetch_array(mysql_query("SELECT * FROM ".TABLE_USERS." where reg_type='merchant' and user_id='".$_SESSION['muser_id']."'"));

if(empty($row_stores['store_id'])){
$_SESSION['errmsg']='Please create a store to add deal.';
		header("location:create_store.php");	
		exit;
}
if($row_stores['store_status']!='1'){
$_SESSION['errmsg']='Your store is not approved to add a deal.Please complete your profile and get approval from admin.';
		header("location:merchant_companyinfo.php");	
		exit;
}

$store_id=$row_stores['store_id'];

if($_REQUEST['mode']=='edit' || $_REQUEST['mode']=='delete'){
$_SESSION["session_temp"] =$deal_id;
}else{
$_SESSION["session_temp"] =uniqid();
}


				if($_SESSION['errmsg']){
				echo '<div class="error_box" style="font-size:12px;">'.$_SESSION['errmsg'].'</div>' ;
				$_SESSION['errmsg']="";
				}if($_SESSION['msg']){
				echo '<div class="valid_box" style="font-size:12px;">'.$_SESSION['msg'].'</div>' ;
				$_SESSION['msg']="";
				}
				
				?>
		

		<div class="form">	
		
		<br style="clear:both" />
		<h2>Add Deal</h2>
		<form method="post" class="niceform2">
		<input type="hidden" name="mid" value="<?php echo $_SESSION['muser_id']?>" />
		<fieldset>
				
				
				
		
					
					<dl>
                        <dt><label for="gender">Store Location:</label></dt>
                        <dd><?php 
						 $row_stores=mysql_fetch_array(mysql_query("SELECT * FROM ".TABLE_STORES." where merchant_id='".$_SESSION['muser_id']."'"));

						$merchant=mysql_fetch_array(mysql_query("SELECT * FROM ".TABLE_USERS." where reg_type='merchant' and user_id='".$_SESSION['muser_id']."'"));
									
								
						
						?>
                            <input type="hidden" name="store_id" value="<?php echo $m_store->store_id?>">
						    <select name="location_id" class="dropdown" id="location_id"  size="1">
								<option value="">-- Select --</option>
                                <?php												
												
									$sql_stores=mysql_query("select location_id,location_name from " .TABLE_STORES_LOCATION." where 1=1 and store_id='".$row_stores['store_id']."' order by location_name asc");
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
                        <dt><label for="email">Title:</label></dt>
                        <dd><input type="text" name="brand" id="brand" size="54" value="<?php echo stripslashes($row_deals[brand]);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>
					
                    <dl>
                        <dt><label for="email">Deal Name:</label></dt>
                        <dd><input type="text" name="title" id="title" size="54" value="<?php echo stripslashes($row_deals[title]);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>
                 
					
					<dl>
                        <dt><label for="email">Deal City:</label></dt>
                        <dd>						
						
						<select name="city" class="dropdown" id="city" size="1">
								<option value="">-- Select --</option>
                                <?php												
														
									$sql_cities=mysql_query("select city_name,city_id from " .TABLE_CITIES." order by city_name asc");
									while($row_cities=mysql_fetch_array($sql_cities))
									{												
								?>
								
										<option value="<?php echo $row_cities[city_name];?>" <?php if($row_cities[city_name]==$row_deals[city]) { echo "selected"; }?>><?php echo ucfirst($row_cities[city_name]);?></option>
								<?php
									}
								?>			
                            </select>
						
						</dd>
                    </dl>
					
				
					
					<dl>
                        <dt><label for="email">Website:</label></dt>
                        <dd><input type="text" name="website" id="website" size="54" value="<?php echo stripslashes($row_deals[website]);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>
                    				
					<dl>
                        <dt><label for="email">Deal Start Time:</label></dt>
                        <dd><input type="text" name="deal_start_time" id="my_date_field" size="54" value="<?php if(!empty($row_deals[deal_start_time])){echo date("Y-m-d H:i",strtotime($row_deals[deal_start_time]));}?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /><span id="cal1"><img src="siteadmin/zpcal/themes/icons/calendar1.gif" width="27" height="21" style="cursor:pointer"/></span>
								 <script type="text/javascript">
								  var cal = new Zapatec.Calendar.setup({
								  
								  inputField:"my_date_field",
								  ifFormat:"%Y-%m-%d %H:%M",
								  button:"cal1",
								  showsTime:false
								
								  });
								  
								 </script> </span>
                    </dl>
                    <dl>
                        <dt><label for="password">Deal End Time:</label></dt>
                        <dd><input type="text" name="deal_end_time" id="my_date_field2" size="54" value="<?php  if(!empty($row_deals[deal_end_time])){echo date("Y-m-d H:i",strtotime($row_deals[deal_end_time]));}?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /><span id="cal2"><img src="siteadmin/zpcal/themes/icons/calendar1.gif" width="27" height="21" style="cursor:pointer"/></span>
								 <script type="text/javascript">
								  var cal = new Zapatec.Calendar.setup({
								  
								  inputField:"my_date_field2",
								  ifFormat:"%Y-%m-%d %H:%M",
								  button:"cal2",
								  showsTime:false
								
								  });
								  
								 </script> </span></dd>
						
                    </dl>
					
					<dl>
                        <dt><label for="email">Max Coupons:</label></dt>
                        <dd><input type="text" name="max_coupons" id="max_coupons" size="54" value="<?php echo stripslashes($row_deals['max_coupons']);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>
                    <dl>
                        <dt><label for="password">Original Price:</label></dt>
                        <dd><input type="text" name="full_price" id="full_price" size="54" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" value="<?php echo $row_deals['full_price']?>" /></dd>
                    </dl>
					
					<dl>
                        <dt><label for="email">Discount Price:</label></dt>
                        <dd><input type="text" name="discounted_price" id="discounted_price" size="54" value="<?php echo stripslashes($row_deals['discounted_price']);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>
					
					
					
                    <dl>
                        <dt><label for="email">Description:</label></dt>
                        <dd>
						<?php									
							$oFCKeditor = new FCKeditor('description');
							$oFCKeditor->BasePath = 'fckeditor/';
							$oFCKeditor->Value = stripslashes($row_deals['description']) ;
							$oFCKeditor->Width = '100%' ;
							$oFCKeditor->Height = '200' ;
							$oFCKeditor->ToolbarSet = 'Basic';
							$oFCKeditor->Create();
						?>							
						</dd>
                    </dl>
					
					
                    
					
					
					 <dl>
                        <dt><label for="password">Offer Details:</label></dt>
                        <dd>
							<?php										
								$oFCKeditor = new FCKeditor('offer_details');
								$oFCKeditor->BasePath = 'fckeditor/';
								$oFCKeditor->Value = stripslashes($row_deals['offer_details']) ;
								$oFCKeditor->Width = '100%' ;
								$oFCKeditor->Height = '200' ;
								$oFCKeditor->ToolbarSet = 'Basic';
								$oFCKeditor->Create();
							?>						
						</dd>
                    </dl>
					
					 <dl>
                        <dt><label for="password">Deal Item Type?</label></dt>
                        <dd>Single:
						<?php												
							if($row_deals[item_type]=="single")
							{
						?>
								<input type="radio" value="single" name="item_type" id="item_type" checked="checked" >
						<?php
							}else{
							?>
							<input type="radio" value="single" name="item_type" id="item_type" checked="checked">
							<?php }?>
							
							Multiple:
						<?php	if($row_deals[item_type]=="multiple")
							{
						?>
								<input type="radio" value="multiple" name="item_type" id="item_type" checked="checked">
								
								<?php }else{?>
								<input type="radio" value="multiple" name="item_type" id="item_type">
								<?php }?>
						
						</dd>
                    </dl>
					
					
					<dl>
                        <dt><label for="password">Deal Item Controlbox Type(Multiple Items)?</label></dt>
                        <dd>Checkbox:
						<?php												
							if($row_deals[item_control_type]=="checkbox")
							{
						?>
								<input type="radio" value="checkbox" name="item_control_type" id="item_control_type" checked="checked" >
						<?php
							}else{
							?>
							<input type="radio" value="checkbox" name="item_control_type" id="item_control_type" checked="checked">
							<?php }?>
							
							Radio button:
						<?php	if($row_deals[item_control_type]=="radio")
							{
						?>
								<input type="radio" value="radio" name="item_control_type" id="item_control_type" checked="checked">
								
								<?php }else{?>
								<input type="radio" value="radio" name="item_control_type" id="item_control_type">
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
					<link rel="stylesheet" href="siteadmin/js/uploader/jquery.fileupload-ui.css">
					
					<div id="fileupload">
						<form action="siteadmin/upload.php" method="POST" enctype="multipart/form-data">
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
					<script src="siteadmin/js/uploader/jquery.iframe-transport.js"></script>
					<script src="siteadmin/js/uploader/jquery.fileupload.js"></script>
					<script src="siteadmin/js/uploader/jquery.fileupload-ui.js"></script>
					<script src="siteadmin/js/uploader/application.js"></script>
					
					
					
					</div>
		 
    
   
	
    	<?php require("include/merchant_footer.inc.php"); ?>   

