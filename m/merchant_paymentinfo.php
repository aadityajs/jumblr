<?php
include("include/m_header.php");
$action=isset($_REQUEST['action'])?$_REQUEST['action']:'';
$user_id=intval($_SESSION['muser_id']);
$sql = "SELECT first_name,last_name,company_name FROM `".TABLE_USERS."` WHERE user_id='$user_id'";
$record = $db->query_first($sql);



if(isset($_REQUEST['submit']) ){
	$store_id=intval($_REQUEST['store_id']);
	
	
	
	
	
		
		$data['chq_country']=$_POST['country'];
		$data['chq_payable']=$_POST['chq_payable'];
		$data['chq_address1']=$_POST['address1'];
		$data['chq_address2']=$_POST['address2'];
		$data['chq_city']=$_POST['city'];
		$data['chq_state']=$_POST['state'];
		$data['chq_zip']=$_POST['zip'];
		
		
		if(!empty($data['chq_payable'])){
		
		$db->query_update(TABLE_STORES, $data, "store_id='$store_id'");
		$_SESSION['msg']='Store Payment Information is updated successfully';
		header("location:".SITE_URL."merchant_paymentinfo");	
		exit;
		
		}
		else{
		$_SESSION['errmsg']='Please enter all information.';
		header("location:".SITE_URL."merchant_paymentinfo");	
		exit;
		
		}
		
	
		
		


}




$row_stores=mysql_fetch_array(mysql_query("SELECT * FROM ".TABLE_STORES." where merchant_id='".$_SESSION['muser_id']."'"));

$merchant=mysql_fetch_array(mysql_query("SELECT * FROM ".TABLE_USERS." where reg_type='merchant' and user_id='".$_SESSION['muser_id']."'"));

if(empty($row_stores['store_id'])){
$_SESSION['errmsg']='Please create a store to add paymentinfo.';
		header("location:".SITE_URL."create_store");	
		exit;
}
else{
$store_id=$row_stores['store_id'];
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
		<h2>Send Checks To:</h2>
		<form method="post"  class="niceform2" >
		<input type="hidden" value="<?php echo $action?>" name="action" />
		<input type="hidden" value="<?php echo $row_stores['store_id']?>" name="store_id" />
		<input type="hidden" value="<?php echo $_SESSION['muser_id']?>" name="muser_id" />
		
		
				
				
				
					<dl>
					<dt><label for="email">Address1: </label></dt>
					<dd><input type="text" name="address1" id="address1" size="54" value="<?php echo stripslashes($row_stores['chq_address1']);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
				</dl>
				
				<dl>
					<dt><label for="email">Address2: </label></dt>
					<dd><input type="text" name="address2" id="address2" size="54" value="<?php echo stripslashes($row_stores['chq_address2']);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
				</dl>
				
				<dl>
					<dt><label for="email">City: </label></dt>
					<dd><input type="text" name="city" id="city" size="54" value="<?php echo stripslashes($row_stores['chq_city']);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
				</dl>
				<dl>
					<dt><label for="email">State: </label></dt>
					<dd><input type="text" name="state" id="state" size="54" value="<?php echo stripslashes($row_stores['chq_state']);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
				</dl>
				
				<dl>
					<dt><label for="email">Zip: </label></dt>
					<dd><input type="text" name="zip" id="zip" size="54" value="<?php echo stripslashes($row_stores['chq_zip']);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
				</dl>
				<dl>
					<dt><label for="email">Country:</label></dt>
					<dd><input type="text" name="country" id="country" size="54" value="<?php echo stripslashes($row_stores['chq_country']);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
				</dl>
				
				<dl>
					<dt><label for="email">Make Checks Payable To:</label></dt>
					<dd><input type="text" name="chq_payable" id="chq_payable" size="54" value="<?php echo stripslashes($row_stores['chq_payable']);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
				</dl>
			
			
				
			<dl class="submit">
                    <input type="submit" name="submit" id="submit" value="Save" /> 
                     </dl>	
				
		</form>
		
		 
		
		
		</div>
		
		 
    
   
	
    	<?php require("include/merchant_footer.inc.php"); ?>   

