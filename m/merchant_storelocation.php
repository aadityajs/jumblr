<?php
include("include/m_header.php");
$action=isset($_REQUEST['action'])?$_REQUEST['action']:'';
$user_id=intval($_SESSION['muser_id']);
$sql = "SELECT first_name,last_name,company_name FROM `".TABLE_USERS."` WHERE user_id='$user_id'";
$record = $db->query_first($sql);



if(isset($_REQUEST['submit']) ){
	$store_id=intval($_REQUEST['store_id']);
	
	
	
	
	
		$data['store_id']=$store_id;
		$data['location_name']=$_POST['location_name'];
		$data['address1']=$_POST['address1'];
		$data['address2']=$_POST['address2'];
		$data['city']=$_POST['city'];
		$data['state']=$_POST['state'];
		$data['zip']=$_POST['zip'];
		$data['phone']=$_POST['phone'];
		$data['added_date']=date("Y-m-d H:i");
		
		
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
	$lon = $location[lat][0];
	$lng = $location[lng][0];
	
	$data['latitude']=$lon;
	$data['longitude']=$lng;
	
		if( $action=='add'){
		$location_id=$db->query_insert(TABLE_STORES_LOCATION, $data);
		
		$_SESSION['msg']='Store Location is added successfully';
		header("location:".SITE_URL."merchant_storelocation");	
		exit;
		}
	
	
	elseif( $action=='edit'){
		$location_id=$_REQUEST['location_id'];
		$location_id=$db->query_update(TABLE_STORES_LOCATION, $data, "store_id='$store_id' and location_id='$location_id'");
		
		$_SESSION['msg']='Store Location is updated successfully';
		header("location:".SITE_URL."merchant_storelocation");	
		exit;
		}
	
		
		


}




$row_stores=mysql_fetch_array(mysql_query("SELECT * FROM ".TABLE_STORES." where merchant_id='".$_SESSION['muser_id']."'"));

$merchant=mysql_fetch_array(mysql_query("SELECT * FROM ".TABLE_USERS." where reg_type='merchant' and user_id='".$_SESSION['muser_id']."'"));

if(empty($row_stores['store_id'])){
$_SESSION['errmsg']='Please create a store to add location.';
		header("location:".SITE_URL."create_store");	
		exit;
}
else{
$store_id=$row_stores['store_id'];
}

if($action=='delete' && !empty($_REQUEST['location_id'])){

mysql_query("Delete from ".TABLE_STORES_LOCATION." where location_id='".$_REQUEST['location_id']."' and location_id<>'".$row_stores['primary_location']."'");
$_SESSION['msg']='Store Location is deleted successfully';
		header("location:".SITE_URL."merchant_storelocation");	
		exit;
}




				if($_SESSION['errmsg']){
				echo '<div class="error_box" style="font-size:12px;">'.$_SESSION['errmsg'].'</div>' ;
				$_SESSION['errmsg']="";
				}if($_SESSION['msg']){
				echo '<div class="valid_box" style="font-size:12px;">'.$_SESSION['msg'].'</div>' ;
				$_SESSION['msg']="";
				}
				
				?>
		
		<script language="javascript" type="text/javascript">
		function validate_location(){
		
		if(document.getElementById('location_name').value==''){
		document.getElementById('location_name').focus();
		alert("Please enter store location name");
		return false;
		}
		
		
		if(document.getElementById('address1').value==''){
		document.getElementById('address1').focus();
		alert("Please enter your store address");
		return false;
		}
		
		if(document.getElementById('city').value==''){
		document.getElementById('city').focus();
		alert("Please enter your store city");
		return false;
		}
		if(document.getElementById('state').value==''){
		document.getElementById('state').focus();
		alert("Please enter your store state");
		return false;
		}
		
		if(document.getElementById('zip').value==''){
		document.getElementById('zip').focus();
		alert("Please enter your store zipcode");
		return false;
		}
		if(document.getElementById('phone').value==''){
		document.getElementById('phone').focus();
		alert("Please enter your store phone");
		return false;
		}
		
		
		
		
		return true
		}
		
		</script>
		<div class="form">	
		<div style="float:left"><input type="button" onclick="location.href='<?php echo SITE_URL;?>merchant_storelocation?action=add'" value="Add Location"	 /></div>
		<br style="clear:both" />
		<?php if($action=='add' || $action=='edit'){
		if(!empty($_REQUEST['location_id'])){
		$row_location=mysql_fetch_array(mysql_query("SELECT * FROM ".TABLE_STORES_LOCATION." where location_id='".$_REQUEST['location_id']."'"));
		}
		?>
		<form method="post"  class="niceform2" onsubmit="return validate_location();">
		<input type="hidden" value="<?php echo $action?>" name="action" />
		<input type="hidden" value="<?php echo $row_stores['store_id']?>" name="store_id" />
		<input type="hidden" value="<?php echo $_SESSION['muser_id']?>" name="muser_id" />
		<input type="hidden" value="<?php echo $row_location['location_id']?>" name="location_id" />
		
				<dl>
					<dt><label for="password">Location Name:<span class="formimportant"> *</span></label></dt>
					<dd><input type="text" name="location_name" id="location_name" size="54" value="<?php echo $row_location[location_name]?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
				</dl>
				
				
				
					<dl>
					<dt><label for="email">Address1: <span class="formimportant"> *</span></label></dt>
					<dd><input type="text" name="address1" id="address1" size="54" value="<?php echo stripslashes($row_location['address1']);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
				</dl>
				
				<dl>
					<dt><label for="email">Address2: </label></dt>
					<dd><input type="text" name="address2" id="address2" size="54" value="<?php echo stripslashes($row_location['address2']);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
				</dl>
				
				<dl>
					<dt><label for="email">City: <span class="formimportant"> *</span></label></dt>
					<dd><input type="text" name="city" id="city" size="54" value="<?php echo stripslashes($row_location['city']);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
				</dl>
				<dl>
					<dt><label for="email">State: <span class="formimportant"> *</span></label></dt>
					<dd><input type="text" name="state" id="state" size="54" value="<?php echo stripslashes($row_location['state']);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
				</dl>
				
				<dl>
					<dt><label for="email">Zip: <span class="formimportant"> *</span></label></dt>
					<dd><input type="text" name="zip" id="zip" size="54" value="<?php echo stripslashes($row_location['zip']);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
				</dl>
				<dl>
					<dt><label for="email">Phone: <span class="formimportant"> *</span></label></dt>
					<dd><input type="text" name="phone" id="phone" size="54" value="<?php echo stripslashes($row_location['phone']);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
				</dl>
				
		
			
			
				
			<dl class="submit">
                    <input type="submit" name="submit" id="submit" value="Save" /> &nbsp; <input type="button" name="reset" id="reset" value="Cancel" onclick="location.href='<?php echo SITE_URL;?>merchant_storelocation'" />
                     </dl>	
				
		</form>
		<?php
		}?>
		 
		
		<h3>My Store Locations</h3>
		<script>
		function setprimary(locationid){
		req=new XMLHttpRequest(); 
					req.open('GET','<?php echo SITE_URL;?>ajax_setprimiarylocation/?location_id='+locationid,false); 	
					req.send(null); 
							if(req.readyState==4){
							
							 document.getElementById("tablelocation").innerHTML=req.responseText;
							
							 	
							}else{
							 document.getElementById("tablelocation").innerHTML='<img src="<?php echo SITE_URL?>images/loader.gif" >';
							}
		
		}
		</script>
		<div style="clear:both"></div>
		<div id="tablelocation">
		<table width="100%" border="0" cellspacing="2" cellpadding="2" >
		  <tr>
			<td width="10%"><strong>Primary</strong></td>
			<td width="40%"><strong>Address</strong></td>
			<td width="15%"><strong>Phone Number</strong></td>
			<td width="10%"><strong>Action</strong></td>
		  </tr>
		  <?php
		  $row_all_locations=mysql_query("SELECT * FROM ".TABLE_STORES_LOCATION." where store_id='".$store_id."'");
		  
		  while($row_all=mysql_fetch_array($row_all_locations)){
		  ?>
		  
		  <tr style="<?php if($row_all['location_id']==$row_stores['primary_location']){echo "background-color:#DBF7DD";}else{echo "background-color:#DBF7FF";}?> ; height:50px;">
			<td style="text-align:center">
			<input type="radio" name="primary" value="<?php echo $row_all['location_id']?>" <?php if($row_all['location_id']==$row_stores['primary_location']){echo "checked='checked'";}?> onclick="setprimary(this.value)"/></td>
			<td><div class="location_address">
			<div><b>Location:</b> <?php echo $row_all['location_name']?></div>
			<div><b>Address1:</b> <?php echo $row_all['address1']?></div>
			<div><b>Address2:</b> <?php echo $row_all['address2']?></div>
			<div><b>City:</b> <?php echo $row_all['city']?></div>
			<div><b>State:</b> <?php echo $row_all['state']?></div>
			<div><b>Zip:</b> <?php echo $row_all['zip']?></div>
			
			
			</div></td>
			<td><?php echo $row_all['phone']?></td>
			 <td><a href="<?php echo SITE_URL;?>merchant_storelocation?action=edit&location_id=<?php echo $row_all['location_id']?>">Edit</a> 
			 
			 <?php if($row_all['location_id']!=$row_stores['primary_location']){ ?>
			 <a href="#" onclick="a=confirm('Are you sure?');if(a){location.href='<?php echo SITE_URL;?>merchant_storelocation?action=delete&location_id=<?php echo $row_all['location_id']?>'}">Delete</a> <?php }?></td>
		  </tr>
		  <?php }?>
		
		</table>
		</div>
		
		
		

		
		
		
		</div>
		
		 
    
   
	
    	<?php require("include/merchant_footer.inc.php"); ?>   

