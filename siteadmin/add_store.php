<?php
include("include/header.php");


if($_REQUEST[mode]=="edit")
{
	$store_id=intval($_REQUEST['id']);
	$row_stores=mysql_fetch_array(mysql_query("select * from ".TABLE_STORES." where store_id='$store_id'"));
}

if($_REQUEST[mode]=="delete")
{
	$store_id=intval($_REQUEST['id']);
	mysql_query("delete from ".TABLE_STORES." where store_id='$store_id'");
	mysql_query("delete from ".TABLE_STORES_REVIEW." where store_id='$store_id'");
	mysql_query("delete from ".TABLE_STORES_LOCATION." where store_id='$store_id'");
	$_SESSION['']="Store is deleted successfully";
	header("location:show_stores.php");
	exit;	
}

if(isset($_REQUEST['submit']))
{	
	$store_id=intval($_REQUEST['id']);
	$date_added=date("Y-m-d H:i");	
	$data['store_name']=$_POST['store_name'];
	$data['merchant_id']=$_POST['merchant_id'];
	$data['category_id']=$_POST['category_id'];
	$data['address1']=$_POST['address1'];
	$data['address2']=$_POST['address2'];
	$data['city']=$_POST['city'];
	$data['state']=$_POST['state'];
	$data['zip']=$_POST['zip'];
	$data['twitterpage']=$_POST['twitterpage'];
	$data['facebookpage']=$_POST['facebookpage'];
	$data['phone']=$_POST['phone'];
	$data['website']=$_POST['website'];
	
	$data['business_desc']=stripslashes($_POST['business_desc']);
	$data['product_recommend']=stripslashes($_POST['product_recommend']);
	$data['experience']=stripslashes($_POST['experience']);
	$data['stand_out']=stripslashes($_POST['stand_out']);
	$data['why_not_come']=stripslashes($_POST['why_not_come']);
	$data['chq_address1']=$_POST['chq_address1'];
	$data['chq_address2']=$_POST['chq_address2'];
	$data['chq_city']=$_POST['chq_city'];
	$data['chq_state']=$_POST['chq_state'];
	$data['chq_zip']=$_POST['chq_zip'];
	$data['chq_country']=$_POST['chq_country'];
	$data['chq_payable']=$_POST['chq_payable'];
	
	
	if($_REQUEST['mode']=="edit")
	{	
		
		$db->query_update(TABLE_STORES, $data, "store_id='$store_id'");
		$_SESSION['msg']='Store is updated successfully';
		header("location:show_stores.php");	
		exit;
	}
	else
	{
		$data['date_added']=' NOW() ';
		$data['store_status']=1;
		$store_id=$db->query_insert(TABLE_STORES, $data);
		
		if($store_id)
		{
		$_SESSION['msg']='Store is created successfully';
		header("location:show_stores.php");
		exit;
		}
		else
		{
		$_SESSION['errmsg']="Unable to create store";
		header("location:show_stores.php");
		exit;
		}
	}	

}

if($_REQUEST['mode']=='edit' || $_REQUEST['mode']=='delete'){
$_SESSION["session_store"] =$store_id;
}else{
$_SESSION["session_store"] =uniqid();
}

?>

    <div class="main_content">
    
      <?php include("include/top_menu.inc.php");?>                    
                    
    <div class="center_content">  
    
   		<?php require("include/left_menu.php"); ?>        
    
    <div class="right_content"> 	
		 
		 <div class="form">		 
		 
		
					<h1>Add Store </h1>
					<form method="post" action="" enctype="multipart/form-data" class="niceform2">
					<input type="hidden" name="id" value="<?php echo $_REQUEST['id']?>" />
					<input type="hidden" name="mode" value="<?php echo  $_REQUEST['mode']?>" />
         
                <fieldset>
				
                    <dl>
                        <dt><label for="email">Store Business Name:</label></dt>
                        <dd>
						<input type="text" name="store_name" id="store_name" size="54" value="<?php echo $row_stores[store_name]?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" />
						
						</dd>
                    </dl>
					
					<dl>
                        <dt><label for="email">Merchant Name:</label></dt>
                        <dd>
						<select name="merchant_id" id="merchant_id">
						<?php 
						$merchant=mysql_query("SELECT * FROM ".TABLE_USERS." where reg_type='merchant'");
						while($mrow=mysql_fetch_array($merchant)){
						if($mrow['merchant_id']==$row_stores['merchant_id']){
						?>
						<option value="<?php echo $mrow['user_id']?>" selected="selected"><?php echo $mrow['company_name']?></option>
						<?php }else{?>
						<option value="<?php echo $mrow['user_id']?>" ><?php echo $mrow['company_name']?></option>
						<?php }}?>
						</select>
						
						</dd>
                    </dl>
					
					
					<dl>
                        <dt><label for="email">Store Category:</label></dt>
                        <dd>
						<select name="category_id" class="dropdown" id="category_id" >
								<option value="">-- Select --</option>
                                <?php												
														
									$sql_categories=mysql_query("select cat_name,cat_id from " .TABLE_STORE_CATEGORIES." where parent_id=0 order by cat_name asc");
									while($row_categories=mysql_fetch_array($sql_categories))
									{												
								?>
								
										<option value="<?php echo $row_categories[cat_id];?>" <?php if($row_categories[cat_id]==$row_stores[category_id]) { echo "selected"; }?>><?php echo $row_categories[cat_name];?></option>
								<?php
									}
								?>			
                            </select>
						
						</dd>
                    </dl>
					
					<dl>
                        <dt><label for="password">Address1:</label></dt>
                        <dd><input type="text" name="address1" id="address1" size="54" value="<?php echo $row_stores[address1]?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>
					<dl>
                        <dt><label for="password">Address2:</label></dt>
                        <dd><input type="text" name="address2" id="address2" size="54" value="<?php echo $row_stores[address2]?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>
					
					
					
                    <dl>
                        <dt><label for="password">City:</label></dt>
                        <dd>
							<select name="city" class="dropdown" id="city" size="1">
								<option value="">-- Select --</option>
                                <?php												
														
									$sql_cities=mysql_query("select city_name,city_id from " .TABLE_CITIES." order by city_name asc");
									while($row_cities=mysql_fetch_array($sql_cities))
									{												
								?>
								
										<option value="<?php echo $row_cities[city_name];?>" <?php if($row_cities[city_name]==$row_stores[city]) { echo "selected"; }?>><?php echo ucfirst($row_cities[city_name]);?></option>
								<?php
									}
								?>			
                            </select>
						
						</dd>
                    </dl>
					
					<dl>
                        <dt><label for="password">State:</label></dt>
                        <dd><input type="text" name="state" id="state" size="54" value="<?php echo $row_stores[state]?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>
					<dl>
                        <dt><label for="password">Zip:</label></dt>
                        <dd><input type="text" name="zip" id="zip" size="54" value="<?php echo $row_stores[zip]?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>
					
					<dl>
                        <dt><label for="password">Phone:</label></dt>
                        <dd><input type="text" name="phone" id="phone" size="54" value="<?php echo $row_stores[phone]?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>
					
					<dl>
                        <dt><label for="password">Website:</label></dt>
                        <dd><input type="text" name="website" id="website" size="54" value="<?php echo $row_stores[website]?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>
					<dl>
                        <dt><label for="password">Twitter Page:</label></dt>
                        <dd><input type="text" name="twitterpage" id="twitterpage" size="54" value="<?php echo $row_stores[twitterpage]?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>
					
					<dl>
                        <dt><label for="password">Facebook Page:</label></dt>
                        <dd><input type="text" name="facebookpage" id="facebookpage" size="54" value="<?php echo $row_stores[facebookpage]?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>
					
					<dl>
                        <dt><label for="password">Business Details:</label></dt>
                        <dd><textarea  rows="5" cols="35" name="business_desc"><?php echo $row_stores[business_desc]?></textarea></dd>
                    </dl>
					<dl>
                        <dt><label for="password">What product or service do you recommend?:</label></dt>
                        <dd><textarea  rows="5" cols="35" name="product_recommend"><?php echo $row_stores[product_recommend]?></textarea></dd>
                    </dl>
					
					<dl>
                        <dt><label for="password">Tell a quick story about a customer or experience at your business.:</label></dt>
                        <dd><textarea  rows="5" cols="35" name="experience"><?php echo $row_stores[experience]?></textarea></dd>
                    </dl>
					<dl>
                        <dt><label for="password">What makes you stand out?:</label></dt>
                        <dd><textarea  rows="5" cols="35" name="stand_out"><?php echo $row_stores[stand_out]?></textarea></dd>
                    </dl>
					
					<dl>
                        <dt><label for="password">Don't come here if.:</label></dt>
                        <dd><textarea  rows="5" cols="35" name="why_not_come"><?php echo $row_stores[why_not_come]?></textarea></dd>
                    </dl>
					
					<dl>
                        <dt>&nbsp;</dt>
                        <dd>Cheque Details here:<strong>Send Checks To:</strong></dd>
                    </dl>
					
					<dl>
                        <dt><label for="password">Address1:</label></dt>
                        <dd><input type="text" name="chq_address1" id="chq_address1" size="54" value="<?php echo $row_stores[chq_address1]?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>
					<dl>
                        <dt><label for="password">Address2:</label></dt>
                        <dd><input type="text" name="chq_address2" id="chq_address2" size="54" value="<?php echo $row_stores[chq_address2]?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>
					<dl>
                        <dt><label for="password">City:</label></dt>
                        <dd><input type="text" name="chq_city" id="chq_city" size="54" value="<?php echo $row_stores[chq_city]?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>
					
					
					<dl>
                        <dt><label for="password">State:</label></dt>
                        <dd><input type="text" name="chq_state" id="chq_state" size="54" value="<?php echo $row_stores[chq_state]?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>
					<dl>
                        <dt><label for="password">Zip:</label></dt>
                        <dd><input type="text" name="chq_zip" id="chq_zip" size="54" value="<?php echo $row_stores[chq_zip]?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>
					
                     <dl>
                        <dt><label for="password">Country:</label></dt>
                        <dd><input type="text" name="chq_country" id="chq_country" size="54" value="<?php echo $row_stores[chq_country]?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl> 
					<dl>
                        <dt><label for="password">Cheque Payable:</label></dt>
                        <dd><input type="text" name="chq_payable" id="chq_payable" size="54" value="<?php echo $row_stores[chq_payable]?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>
					
					<dl class="submit">
                    <input type="submit" name="submit" id="submit" value="Submit" />
                     </dl>
					 
                </fieldset>
                
         </form>
         </div>
		 
		 
		 <div>
			<span style="font-weight:bold">Upload Store Profile Images:</span>	
				
		
				
					<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/themes/base/jquery-ui.css" id="theme">
					<link rel="stylesheet" href="js/uploader/jquery.fileupload-ui.css">
					
					<div id="fileupload">
						<form action="uploadstoreprofileimg.php" method="POST" enctype="multipart/form-data">
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
            
                    
  </div>   <!--end of center content -->  
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    	<?php require("include/footer.inc.php"); ?>   

