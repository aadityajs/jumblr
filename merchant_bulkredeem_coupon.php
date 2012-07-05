<?php
include("include/m_header.php");

$muser_id=intval($_SESSION['muser_id']);
$sql = "SELECT * FROM `".TABLE_USERS."` join ".TABLE_STORES." on (`".TABLE_USERS."`.user_id=".TABLE_STORES.".merchant_id) WHERE user_id='$muser_id'";
$record = $db->query_first($sql);


 if(isset($_REQUEST['submit'])){

	$data['redeem_status']='1';
	$data['redeem_location']=$_POST['location'];
	
	$code=explode(",",$_POST['coupon_code']);

	foreach($code as $ccode){

		$tran=mysql_query("SELECT * FROM ".TABLE_TRANSACTION." where coupon_code='".$db->escape($ccode)."' and transaction_status='success' "); 
		$tran_rec=mysql_fetch_array($tran);
		if(mysql_num_rows($tran)<=0){
		$_SESSION['errmsg'] .="Code ".$ccode." does not exists<br />";
		continue;
		}
		
		if($tran_rec['redeem_status']=='1'){
			$_SESSION['errmsg'] .="Coupon ".$ccode."  already redeemed<br />";
		continue;
		}
		
		
		$db->query_update(TABLE_TRANSACTION, $data, "coupon_code='".$db->escape($ccode)."'");
	
		$_SESSION['msg'] .="Coupon ".$ccode."  is successfully redeemed<br />";
		
		}
		
		header("location:".SITE_URL."merchant_bulkredeem_coupon");
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
		</style>
		
		 <h1><?php echo $record['store_name'];?></h1>
    <form method="post" >
     <fieldset>
   	 <legend  title="Primary Location">Coupon Redemption </legend>
	 
	 <table width="100%" border="0" cellspacing="2" cellpadding="2">
			  <tr>
				<td>Location</td>
				<td><select name="location" id="location">
				<option value="">Select</option>
				<?php 
				$location=mysql_query("SELECT * FROM ".TABLE_STORES_LOCATION." where store_id='$record[store_id]'");
				while($locrow=mysql_fetch_array($location)){
				?>
				
				<option value="<?php echo $locrow['location_id']?>"><?php echo $locrow['location_name']?></option>
				<?php }?>
				</select></td>
			  </tr>
			  
			  <tr>
				<td>Redemption Code (seperated by comma ,)</td>
				<td><textarea name="coupon_code" id="coupon_code" cols="40"></textarea></td>
			  </tr>
			  <tr>
				<td></td>
				<td><input type="submit" value="Redeem"  id="submit" name="submit"/></td>
			  </tr>
			</table>

	
	</fieldset>
	</form>
    	<?php require("include/merchant_footer.inc.php"); ?>   

