<?php
include("include/m_header.php");

$muser_id=intval($_SESSION['muser_id']);
$sql = "SELECT * FROM `".TABLE_USERS."` join ".TABLE_STORES." on (`".TABLE_USERS."`.user_id=".TABLE_STORES.".merchant_id) WHERE user_id='$muser_id'";
$record = $db->query_first($sql);


$location=mysql_fetch_array(mysql_query("SELECT * FROM ".TABLE_STORES_LOCATION." where location_id='$record[location_id]'"));

 if(isset($_REQUEST['submit'])){

		$tran=mysql_query("SELECT * FROM ".TABLE_TRANSACTION." where coupon_code='".$db->escape($_REQUEST['coupon_code'])."' and transaction_status='success'"); 
		$tran_rec=mysql_fetch_array($tran);
		if(mysql_num_rows($tran)<=0){
		$_SESSION['errmsg']="Code does not exists";
		header("location:merchant_unredeem_coupon");
		exit;
		}else{
		if($tran_rec["redeem_status"] == 0)
		{
		$_SESSION['errmsg']="Code already unredeemed";
		header("location:merchant_unredeem_coupon");
		exit;
		}
		
		}
	
/*	if($tran_rec['redeem_status']=='1'){
		$_SESSION['errmsg']="Coupon already redeemed";
		header("location:employee_redeem_coupon.php");
		exit;
	}
	*/
	$data['redeem_status']='0';
	$data['redeem_location']=$_POST['location'];
	
	$db->query_update(TABLE_TRANSACTION, $data, "coupon_code='".$db->escape($_REQUEST['coupon_code'])."'");
	
		$_SESSION['msg']="Coupon is successfully unredeemed";
		header("location:merchant_unredeem_coupon");
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
				
	<script type="text/javascript">
	
	function checkAlert()
	{
		var responce = confirm("Are you sure you want to unredemeed this coupon?");
		if(responce)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	</script>

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
		
		 <h1><?php echo $record['store_name'];?>  Location <?php echo $location['location_name'];?></h1>
    <form method="post" onsubmit="return checkAlert();">
	<input type="hidden" name="location" value="<?php echo $location['location_id'];?>" />
     <fieldset>
   	 <legend  title="Primary Location">Coupon Unredemption </legend>
	 
	 <table width="100%" border="0" cellspacing="2" cellpadding="2">

			  <tr>
				<td>Redemption Code</td>
				<td><input type="text" name="coupon_code"  id="coupon_code"/></td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				<td></td>
				<td><input type="submit" value="Unredeem"  id="submit" name="submit"/></td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
			  </tr>
			</table>

	
	</fieldset>
	</form>
    	<?php require("include/merchant_footer.inc.php"); ?>   

