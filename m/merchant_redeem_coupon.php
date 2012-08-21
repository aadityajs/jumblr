<?php
		include("include/m_header.php");
		
		
		
		if(isset($_REQUEST['submitSingle'])){
		$muser_id=intval($_SESSION['muser_id']);
		$sql = "SELECT * FROM `".TABLE_USERS."` join ".TABLE_STORES." on (`".TABLE_USERS."`.user_id=".TABLE_STORES.".merchant_id) WHERE user_id='$muser_id'";
		$record = $db->query_first($sql);
		
		
		if(isset($_REQUEST['submitSingle'])){
		$tran=mysql_query("SELECT * FROM ".TABLE_TRANSACTION." where coupon_code='".$db->escape($_REQUEST['coupon_code'])."' and transaction_status='success' and amount='".$_REQUEST['total_amount']."'"); 
		$tran_rec=mysql_fetch_array($tran);
		if(mysql_num_rows($tran)<=0){
		$_SESSION['errmsg']="Code does not exists";
		header("location:".SITE_URL."merchant_redeem_coupon");
		exit;
		}
		
		if($tran_rec['redeem_status']=='1'){
		$_SESSION['errmsg']="Coupon already redeemed";
		header("location:".SITE_URL."merchant_redeem_coupon");
		exit;
		}
		
		$data['redeem_status']='1';
		$data['redeem_location']=$_POST['location'];
		
		$db->query_update(TABLE_TRANSACTION, $data, "coupon_code='".$db->escape($_REQUEST['coupon_code'])."'");
		
		$_SESSION['msg']="Coupon is successfully redeemed";
		header("location:".SITE_URL."merchant_redeem_coupon");
		exit;
		}
		}
		
if(isset($_REQUEST['submitBulk'])){
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
 
			if(isset($_REQUEST['submitUnredeem'])){
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
}
 
		}
?>
<body>
	<div style="margin-top: 10px;" id="maincontainer">
    
		    <?php include("merchant_menu_section.php"); ?>
           
		   
			<div class="main_box white_bg" style="padding-top: 10px;">
			<div class="clear"></div>
			
             <div class="main_box">
             
              <div id="TabbedPanels2" class="TabbedPanels2">
              <ul class="TabbedPanelsTabGroup2">
                <li class="TabbedPanelsTab2" tabindex="0">Redeem</li>
                <li class="TabbedPanelsTab2" tabindex="0">Redeem Bulk Coupon</li>
                <li class="TabbedPanelsTab2" tabindex="0">Unredeem Coupon</li>
              </ul>
              <div class="TabbedPanelsContentGroup2">
				<div class="TabbedPanelsContent2">
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
				<td>Bill Total</td>
				<td><input type="text" name="total_amount"  id="total_amount"/></td>
				</tr>
				<tr>
				<td>Redemption Code</td>
				<td><input type="text" name="coupon_code"  id="coupon_code"/></td>
				</tr>
				<tr>
				<td></td>
				<td><input type="submit" value="Redeem"  id="submitSingle" name="submitSingle"/></td>
				</tr>
				</table>
				
				
				</fieldset>
				</form>
				</div>
					
					
				<div class="TabbedPanelsContent2">
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
					<td><input type="submit" value="Redeem"  id="submitBulk" name="submitBulk"/></td>
					</tr>
					</table>
					
					
					</fieldset>
					</form>
				
				</div>
				
				
				<div class="TabbedPanelsContent2">
				
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
					<td><input type="submit" value="Unredeem"  id="submitUnredeem" name="submitUnredeem"/></td>
					</tr>
					<tr>
					<td>&nbsp;</td>
					</tr>
					</table>
					
					
					</fieldset>
					</form>
				
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
