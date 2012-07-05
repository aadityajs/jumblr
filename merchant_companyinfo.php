<?php
include("include/m_header.php");

$user_id=intval($_SESSION['muser_id']);
$sql = "SELECT first_name,last_name,company_name FROM `".TABLE_USERS."` WHERE user_id='$user_id'";
$record = $db->query_first($sql);

if(isset($_REQUEST['submit'])){
	$store_id=intval($_REQUEST['store_id']);
	
	$data['store_name']=$_POST['store_name'];
	$data['merchant_id']=$_POST['muser_id'];
	$data['category_id']=$_POST['category_id'];
	$data['twitterpage']=$_POST['twitterpage'];
	$data['facebookpage']=$_POST['facebookpage'];
	$data['website']=$_POST['website'];
	$data['business_desc']=stripslashes($_POST['business_desc']);
	$data['product_recommend']=stripslashes($_POST['product_recommend']);
	$data['experience']=stripslashes($_POST['experience']);
	$data['stand_out']=stripslashes($_POST['stand_out']);
	$data['why_not_come']=stripslashes($_POST['why_not_come']);
	
	
	$site=$_REQUEST['site'];
	$comment=$_REQUEST['comment'];
	
	
	$db->query_update(TABLE_STORES, $data, "store_id='$store_id'");
	
	
	
	mysql_query("DELETE from ".TABLE_STORES_REVIEW." where store_id='$store_id'");
	for($s=0;$s<count($site);$s++){
	if(!empty($site[$s])){
	$data=array();
		$data['store_id']=$store_id;
		$data['site']=$site[$s];
		$data['comment']=$comment[$s];
		
		$db->query_insert(TABLE_STORES_REVIEW,$data);
		}
	}
	
	$db->query_update(TABLE_STORES, $data, "store_id='$store_id'");
	
	$data=array();
		$data['store_id']=$store_id;
		$data['tempid']='';
		$db->query_update(TABLE_STORES_PROFILEIMG, $data, "tempid='".$_SESSION['tmpid']."'");
		
		$_SESSION['msg']='Store is updated successfully';
		header("location:".SITE_URL."merchant_companyinfo");	
		exit;


}


 $_SESSION['tmpid']=uniqid();


$row_stores=mysql_fetch_array(mysql_query("SELECT * FROM ".TABLE_STORES." where merchant_id='".$_SESSION['muser_id']."'"));

$merchant=mysql_fetch_array(mysql_query("SELECT * FROM ".TABLE_USERS." where reg_type='merchant' and user_id='".$_SESSION['muser_id']."'"));

				if($_SESSION['errmsg']){
				echo '<div class="error_box" style="font-size:12px;">'.$_SESSION['errmsg'].'</div>' ;
				$_SESSION['errmsg']="";
				}if($_SESSION['msg']){
				echo '<div class="valid_box" style="font-size:12px;">'.$_SESSION['msg'].'</div>' ;
				$_SESSION['msg']="";
				}
				
				?>
				
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
	urlsend="<?php echo SITE_URL;?>delete-file?imgid="+imgid;
	urlsend=urlsend+"&sid="+Math.random();
	
	req=new XMLHttpRequest(); 
					req.open('GET',urlsend,false); 	
					req.send(null); 
							if(req.readyState==4){
								
								$("#file"+imgid).remove();
						}
	
	}
	
	function getfilename(imgid){
	
	urlsend="<?php echo SITE_URL;?>get-file?imgid="+imgid;
	urlsend=urlsend+"&sid="+Math.random();
	
	req=new XMLHttpRequest(); 
					req.open('GET',urlsend,false); 	
					req.send(null); 
							if(req.readyState==4){
								
								
								return req.responseText;
						}
	}
</script>	
		 
		<div class="form">
		<h3>About Your Company</h3>
		<form method="post" action="<?php echo SITE_URL;?>merchant_companyinfo" enctype="multipart/form-data" class="niceform2">
		<input type="hidden" value="<?php echo $row_stores['store_id']?>" name="store_id" />
		<input type="hidden" value="<?php echo $_SESSION['muser_id']?>" name="muser_id" />
		
		
				<dl>
					<dt><label for="email">Store Business Name: </label></dt>
					<dd><input type="text" name="store_name" id="store_name" size="54" value="<?php echo $row_stores[store_name]?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
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
				
			<h3>Share your web information</h3>	
			
			<dl>
					<dt><label for="email">Website:</label></dt>
					<dd>
					<input type="text" name="website" id="website" size="54" value="<?php echo $row_stores[website]?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" />
					
					</dd>
			</dl>
			<dl>
				<dt><label for="email">Twitter Page:</label></dt>
					<dd>
					<input type="text" name="twitterpage" id="website" size="54" value="<?php echo $row_stores[twitterpage]?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" />
					
					</dd>
			</dl>
			<dl>
				<dt><label for="email">Facebook Page:</label></dt>
					<dd>
					<input type="text" name="facebookpage" id="facebookpage" size="54" value="<?php echo $row_stores[facebookpage]?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" />
					
					</dd>
			</dl>
			
			<dl>
				<dt><label for="email"></label></dt>
					<dd><strong>Please select a reviews website and enter the URL to your reviews into the field:</strong>
					 <?php 
  
						  $reviews=array("CitySearch","Google","Insider Pages","Metromix","Urbanspoon","Yahoo","Yelp");
						  
						  for($i=0;$i<count($reviews); $i++){
						  
								  $sql="SELECT * FROM ".TABLE_STORES_REVIEW." where store_id='".$row_stores[store_id]."' and site='".$reviews[$i]."'";
								  $review=mysql_fetch_array(mysql_query($sql));
								  
								  if(is_array($review)){
								  $style="style='display:block'";
								  $k=$i;
								  }else{
								  $style="style='display:none'";
								  }
								  
								  
								
								  $countreview=mysql_num_rows(mysql_query("SELECT * FROM ".TABLE_STORES_REVIEW." where store_id='".$row_stores[store_id]."'"));  
								  if($i==0 && $countreview<=0){
								   $style="style='display:block'";
								   $k=$i;
								  }
						  
						  ?>
						  
						  <div id="review<?php echo $i?>" <?php echo $style?>><select name="site[]" id="site"><option value="">Please select...</option>
												   <?php foreach($reviews as $revarr){?>
												   <option value="<?php  echo $revarr?>" <?php if($revarr==$review['site']){echo "selected";}?>><?php echo $revarr?></option>
												   <?php }?>
												   </select> 
													Url:<input type="text" name="comment[]" value="<?php echo $review['comment']?>" /></div>
						  
						  <?php }?>
						  <input type="hidden" id="showblock" value="<?php echo $k?>" />
						  <div><a href="javascript:void(0)" onclick="addreviewdiv(document.getElementById('showblock').value)">Add another review</a></div>
						  <script>
						  function addreviewdiv(curval){
						  
						  curval=parseInt(curval)+1;
						  document.getElementById('showblock').value=curval
						  
						  document.getElementById('review'+curval).style.display="block"
						  }
						  </script>
					
					</dd>
			</dl>
			<h3>Share some details about your business:</h3>
			
			<dl>
				<dt><label for="email">Business Details:</label></dt>
					<dd>
					<textarea name="business_desc" rows="3" cols="35" id="business_desc" tabindex="4" title="business_desc"><?php echo $row_stores[business_desc]?></textarea>
					
					</dd>
			</dl>
			
			<dl>
				<dt><label for="email">What product or service do you recommend?:</label></dt>
					<dd>
					<textarea name="product_recommend" rows="3" cols="35" id="product_recommend" tabindex="4" title="product_recommend"><?php echo $row_stores[business_desc]?></textarea>
					
					</dd>
			</dl>
			
			<dl>
				<dt><label for="email">Tell a quick story about a customer or experience at your business?: </label></dt>
					<dd>
					<textarea name="experience" rows="3" cols="35" id="experience" tabindex="4" title="experience"><?php echo $row_stores[experience]?></textarea>
					
					</dd>
			</dl>
			
			<dl>
				<dt><label for="email">What makes you stand out?: </label></dt>
					<dd>
					<textarea name="stand_out" rows="3" cols="35" id="stand_out" tabindex="4" title="stand_out"><?php echo $row_stores[stand_out]?></textarea>
					
					</dd>
			</dl>
			
			<dl>
				<dt><label for="email">Don't come here if?: </label></dt>
					<dd>
					<textarea name="why_not_come" rows="3" cols="35" id="why_not_come" tabindex="4" title="why_not_come"><?php echo $row_stores[why_not_come]?></textarea>
					
					</dd>
			</dl>
			<?php 
		$proimg="SELECT * FROM ".TABLE_STORES_PROFILEIMG." where store_id='".$row_stores['store_id']."'";
			$imgrow=$db->fetch_all_array($proimg);
			
			
			?>
			
			<dl>
					<dt><label for="email">Add photos to your company profile: <span class="formimportant"> *</span></label></dt>
					<dd>
					<ul id="files">
						<?php foreach($imgrow as $profileimg){?>
						<li id="file<?php echo $profileimg[imgid]?>" class="success">
						<img alt="" src="./upload_files/profile_image/<?php echo $profileimg[file]?>"><br>
						<a onclick="DeletePic(<?php echo $profileimg[imgid]?>)" href="javascript:void(0)">Delete</a></li>
						<?php }?>
					
					</ul>
					
					
					<div style="clear:both"></div><br />
					
					<span id="status" ></span><div id="upload" ><span>Browse<span></div>
		
					
					
					</dd>
				</dl>
				
			<dl class="submit">
                    <input type="submit" name="submit" id="submit" value="Update My Profile" />
                     </dl>	
				
		</form>

		
		
		
		</div>
		
		 
    
   
	
    	<?php require("include/merchant_footer.inc.php"); ?>   

