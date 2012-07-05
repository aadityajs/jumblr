<?php


if(isset($_REQUEST['submitSingle'])){
		$muser_id=intval($_SESSION['muser_id']);
		$sql = "SELECT * FROM `".TABLE_USERS."` join ".TABLE_STORES." on (`".TABLE_USERS."`.user_id=".TABLE_STORES.".merchant_id) WHERE user_id='$muser_id'";
		$record = $db->query_first($sql);
		
		
		if(isset($_REQUEST['submitSingle'])){
		$tran=mysql_query("SELECT * FROM ".TABLE_TRANSACTION." where coupon_code='".$db->escape($_REQUEST['coupon_code'])."' and transaction_status='success' and amount='".$_REQUEST['total_amount']."'"); 
		$tran_rec=mysql_fetch_array($tran);
		if(mysql_num_rows($tran)<=0){
		$_SESSION['errmsg']="Code does not exists";
		header("location:merchant_home.php");
		exit;
		}
		
		if($tran_rec['redeem_status']=='1'){
		$_SESSION['errmsg']="Coupon already redeemed";
		header("location:merchant_home.php");
		exit;
		}
		
		$data['redeem_status']='1';
		$data['redeem_location']=$_POST['location'];
		
		$db->query_update(TABLE_TRANSACTION, $data, "coupon_code='".$db->escape($_REQUEST['coupon_code'])."'");
		
		$_SESSION['msg']="Coupon is successfully redeemed";
		header("location:merchant_home.php");
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

header("location:".SITE_URL."merchant_home");
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
header("location:merchant_home");
exit;
}else{
if($tran_rec["redeem_status"] == 0)
{
$_SESSION['errmsg']="Code already unredeemed";
header("location:merchant_home");
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
header("location:merchant_home");
exit;

}
}

}


?>