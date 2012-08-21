<?php 
ob_start();
session_start();

$user_id=$_REQUEST['user_id'];			
require("../config.inc.php");
require("../class/Database.class.php");

$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);			
$db->connect();
mysql_query("SET CHARACTER SET utf8"); 
$sql="SELECT * FROM ".TABLE_USERS." where user_id='$user_id'";
$userexists=$db->query_first($sql);




if(empty($userexists['email'])){
 echo "Account does not exists."; 
	 
	 exit;
}
				//$newpass=uniqid();
				//$data['password']=md5($newpass);
				
				$email=$userexists['email'];
				//$db->query_update(TABLE_USERS, $data, "email='$email'");
		
				$to = $userexists['email'];
				
				$subject = "Your Merchant Account is active at GeeLaza.com";
				$txt = "Congratulations!! Your account is created in GeeLaza.com and userid is : ".$userexists['email']."<br /><br /><br />";
				//$txt .="Your password is :".$newpass."<br /><br />"; 
				
				$sql="SELECT * FROM ".TABLE_ADMIN." where admin_name='admin'";
							$admin=$db->query_first($sql);
							
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= "From: GeeLaza.com<".$admin['email'].">". "\r\n" ;
				
				$status=@mail($to,$subject,$txt,$headers);
				
				
				
				
				
				echo   "Mail is sent to the merchant with account details."; 
				exit;
				
			
				
?>