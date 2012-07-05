<?php
include("include/m_header.php");
?>
<body>

	<div style="margin-top: 10px;" id="maincontainer">
    
		    <?php include("merchant_menu_section.php"); ?>
           
		   
			<div class="main_box white_bg">
			<div class="clear"></div>


             <div class="main_box">
<?php 
$muser_id=intval($_SESSION['muser_id']);
$sql = "SELECT first_name,last_name,company_name FROM `".TABLE_USERS."` WHERE user_id='$muser_id'";
$record = $db->query_first($sql);


	$sql = "SELECT * FROM `".TABLE_STORES."` WHERE merchant_id='$muser_id'";
	$store = $db->query_first($sql);
	$_SESSION['store_status']=$store['store_status'];
	
	if(!empty($store['store_status'])){
	$_SESSION['errmsg']="You have already created a store. Please complete all the steps and wait for admin approval.";
	header("location:merchant_home.php");
	exit;
	}
 
 if(isset($_POST['submit'])){
 

	
		$data['store_name']=$_POST['store_name'];
		$data['merchant_id']=$_POST['muser_id'];
		$data['category_id']=$_POST['category_id'];
		$data['address1']=$_POST['address1'];
		$data['address2']=$_POST['address2'];
		$data['city']=$_POST['city'];
		$data['state']=$_POST['state'];
		$data['zip']=$_POST['zip'];
		
		$data['phone']=$_POST['phone'];
		$data['website']=$_POST['website'];
		
		
		$data['date_added']=date('Y-m-d h:i');
		$data['store_status']=2;
		$store_id=$db->query_insert(TABLE_STORES, $data);
		
		if(!empty($store_id))
		{
		
		$data=array();
		$data['store_id']=$store_id;
		$data['tempid']='';
		$db->query_update(TABLE_STORES_PROFILEIMG, $data, "tempid='".$_SESSION['tmpid']."'");
		
		
		
		$data=array();
		$data['store_id']=$store_id;
		$data['location_name']="primary";
		$data['address1']=$_POST['address1'];
		$data['address2']=$_POST['address2'];
		$data['city']=$_POST['city'];
		$data['state']=$_POST['state'];
		$data['zip']=$_POST['zip'];
		$data['phone']=$_POST['phone'];
		$data['added_date']=date("Y-m-d H:i");
		$location_id=$db->query_insert(TABLE_STORES_LOCATION, $data);
		
		$data=array();
		$data['primary_location']=$location_id;
		$db->query_update(TABLE_STORES, $data, "store_id='$store_id'");
		

		$_SESSION['tmpid']='';
		$_SESSION['msg']='Store is created successfully. Please complete all the steps and wait for admin approval.';
		header("location:merchant_home.php");
		exit;
		}
		
 
 }

 $_SESSION['tmpid']=uniqid();
 
 
 
 
 
 
				if($_SESSION['errmsg']){
				echo '<div class="error_box" style="font-size:12px;">'.$_SESSION['errmsg'].'</div>' ;
				$_SESSION['errmsg']="";
				}if($_SESSION['msg']){
				echo '<div class="valid_box" style="font-size:12px;">'.$_SESSION['msg'].'</div>' ;
				$_SESSION['msg']="";
				}
				
				?>
				
	<h1>Click Apply to open your GetDeal Store!</h1>
		 
		<div class="form">
		<script>
		function validateform(){
		
		if(document.getElementById('store_name').value==''){
		document.getElementById('store_name').focus();
		alert("Please enter store name");
		return false;
		}
		if(document.getElementById('category_id').value==''){
		document.getElementById('category_id').focus();
		alert("Please select a category");
		return false;
		}
		
		if(document.getElementById('address1').value==''){
		document.getElementById('address1').focus();
		alert("Please enter your business address");
		return false;
		}
		
		if(document.getElementById('city').value==''){
		document.getElementById('city').focus();
		alert("Please enter your business city");
		return false;
		}
		if(document.getElementById('state').value==''){
		document.getElementById('state').focus();
		alert("Please enter your business state");
		return false;
		}
		
		if(document.getElementById('zip').value==''){
		document.getElementById('zip').focus();
		alert("Please enter your business zipcode");
		return false;
		}
		if(document.getElementById('phone').value==''){
		document.getElementById('phone').focus();
		alert("Please enter your business phone");
		return false;
		}
		if(document.getElementById('website').value==''){
		document.getElementById('website').focus();
		alert("Please enter your business website");
		return false;
		}
		url=document.getElementById('website').value
		validurl=is_valid_url(url)
		
		if(!validurl){
		document.getElementById('website').focus();
		alert("Please enter your valid business website");
		return false;
		}
		
		return true;
		}
		
		function is_valid_url(url)
			{
				 return url.match(/^(ht|f)tps?:\/\/[a-z0-9-\.]+\.[a-z]{2,4}\/?([^\s<>\#%"\,\{\}\\|\\\^\[\]`]+)?$/);
			}
		</script>
	<script type="text/javascript" src="js/jquery-1.5.1.js" ></script>	
		<script type="text/javascript" src="js/ajaxupload.3.5.js" ></script>

<script type="text/javascript" >
	$(function(){
		var btnUpload=$('#upload');
		var status=$('#status');
		var i=1
		new AjaxUpload(btnUpload, {
			action: '<?php echo SITE_URL;?>mupload-file',
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
					$('<li id="file'+response+'"></li>').appendTo('#files').html('<img src="./upload_files/profile_image/'+filname+'" alt="" /><br/><a href="javascript:void(0)" onclick=DeletePic('+response+')>Delete</a>').addClass('success');
				i++;
				} else{
					$('<li></li>').appendTo('#files').text(filname).addClass('error');
				}
			}
		});
		
	});
	
	function DeletePic(imgid){
	urlsend="delete-file.php?imgid="+imgid;
	urlsend=urlsend+"&sid="+Math.random();
	
	req=new XMLHttpRequest(); 
					req.open('GET',urlsend,false); 	
					req.send(null); 
							if(req.readyState==4){
								
								$("#file"+imgid).remove();
						}
	
	}
	
	function getfilename(imgid){
	
	urlsend="get-file.php?imgid="+imgid;
	urlsend=urlsend+"&sid="+Math.random();
	
	req=new XMLHttpRequest(); 
					req.open('GET',urlsend,false); 	
					req.send(null); 
							if(req.readyState==4){
								
								
								return req.responseText;
						}
	}
</script>

		<form method="post" action="" enctype="multipart/form-data" class="niceform2" onSubmit="return validateform()">
		<input type="hidden" value="<?php echo $store['store_id']?>" name="store_id" />
		<input type="hidden" value="<?php echo $_SESSION['muser_id']?>" name="muser_id" />
		
		
				<dl>
					<dt><label for="email">Store Business Name:<span class="formimportant"> *</span> </label></dt>
					<dd><input type="text" name="store_name" id="store_name" size="54" value="<?php echo stripslashes($store[store_name]);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
				</dl>
				
				
				
				<dl>
					<dt><label for="email">Store Category: <span class="formimportant"> *</span></label></dt>
					<dd>
					<select name="category_id" class="dropdown" id="category_id" >
								<option value="">-- Select --</option>
                                <?php												
														
									$sql_categories=mysql_query("select cat_name,cat_id from " .TABLE_STORE_CATEGORIES." where parent_id=0 order by cat_name asc");
									while($row_categories=mysql_fetch_array($sql_categories))
									{												
								?>
								
										<option value="<?php echo $row_categories[cat_id];?>" <?php if($row_categories[cat_id]==$store[category_id]) { echo "selected"; }?>><?php echo $row_categories[cat_name];?></option>
								<?php
									}
								?>			
                            </select>
					</dd>
				</dl>
				<h3>Please Enter the primary location of your business</h3>
				
				
				<dl>
					<dt><label for="email">Address1: <span class="formimportant"> *</span></label></dt>
					<dd><input type="text" name="address1" id="address1" size="54" value="<?php echo stripslashes($store['address1']);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
				</dl>
				
				<dl>
					<dt><label for="email">Address2: </label></dt>
					<dd><input type="text" name="address2" id="address2" size="54" value="<?php echo stripslashes($store['address2']);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
				</dl>
				
				<dl>
					<dt><label for="email">City: <span class="formimportant"> *</span></label></dt>
					<dd><input type="text" name="city" id="city" size="54" value="<?php echo stripslashes($store['city']);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
				</dl>
				<dl>
					<dt><label for="email">State: <span class="formimportant"> *</span></label></dt>
					<dd><input type="text" name="state" id="state" size="54" value="<?php echo stripslashes($store['state']);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
				</dl>
				
				<dl>
					<dt><label for="email">Zip: <span class="formimportant"> *</span></label></dt>
					<dd><input type="text" name="zip" id="zip" size="54" value="<?php echo stripslashes($store['zip']);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
				</dl>
				<dl>
					<dt><label for="email">Phone: <span class="formimportant"> *</span></label></dt>
					<dd><input type="text" name="phone" id="phone" size="54" value="<?php echo stripslashes($store['phone']);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
				</dl>
				<dl>
					<dt><label for="email">Website: <span class="formimportant"> *</span></label></dt>
					<dd><input type="text" name="website" id="website" size="54" value="<?php echo stripslashes($store['website']);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
				</dl>
				
				
				<dl>
					<dt><label for="email">Add photos to your company profile: <span class="formimportant"> *</span></label></dt>
					<dd>
					<ul id="files" ></ul>
					<div style="clear:both"></div><br />
					
					<span id="status" ></span><div id="upload" ><span>Browse<span></div>
		
					
					
					</dd>
				</dl>
				
				<dl class="submit">
                    <input type="submit" name="submit" id="submit" value="Submit" />
                     </dl>
				
		</form>
		
		
		</div>
	
	
	</div>
               <div class="clear"></div>
              </div>

		
	
    	<?php require("include/merchant_footer.inc.php"); ?>   

