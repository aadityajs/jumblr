<?php include("include/header.php");?>
<?php
error_reporting(E_ERROR && E_STRICT);
?>

<?php 
/** Function to validate email with PHP 
 * @author Aditya Jyoti Saha
 * 
 * */
function ValidateEmail($email) {
	//$email = "someone@example.com"; 
	
	if(eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) { 
	  //echo "Valid email address.";
	  return TRUE; 
	} 
	else { 
	  //echo "Invalid email address.";
	  return FALSE; 
	}	 
}
?>


<div id="container">
<div id="leftcol">
<div class="deal_curve1">
<div class="top_curve1"></div>
<div class="clear"></div>
<div class="mid_curve1">
<div class="signup_box1">

<?php 
$flag == 0;	
if (isset($_POST['reset_email']) && ($_POST['submit'] == "Submit")) {

	$chk_for_email_sql = "SELECT * FROM ".TABLE_TEMP_PASSWORD;
	$chk_for_email_res = mysql_query($chk_for_email_sql); 
	
	while ($chk_for_email_row = mysql_fetch_array($chk_for_email_res)) {
		
		if ($chk_for_email_row['email'] == $_POST['reset_email']) {
			$msg = 'You already have requested for pasword reset, please follow the required steps in the email sent to you.';
			$flag = 1;
		}
	}
	
	$reset_email = $_POST['reset_email'];
	if($flag == 0)
		{
			if($reset_email == '')
			{
				$msg = 'Please enter your email address.';
				$flag = 1;
			}
			if (ValidateEmail($reset_email) == FALSE)
			{
				$msg = 'Please enter a valid email address.';
				$flag = 1;
			}
		}
		
		if($flag == 0) {
			$sql_reset_select = "SELECT * FROM ".TABLE_USERS." WHERE email='$reset_email'";
			$result_reset_select = mysql_query($sql_reset_select);
			$count_reset_select = mysql_num_rows($result_reset_select);
			
			if($count_reset_select >0)
			{
				$row_reset_select = mysql_fetch_array($result_reset_select);
				$user_id = $row_reset_select["user_id"];
				$decoded_password = base64_decode($row_reset_select['password']);
				
				$enc_email =  base64_encode(base64_encode($row_reset_select["email"]));
				
				//<!-- Email Template Starts -->

				$EmailTemplate = '
				
				<table width="650" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#75d4fc">
				  <tr>
				    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
				      <tr>
				        <td><img src="'.SITE_URL.'images/bgtop.gif" alt="" width="650" height="15" /></td>
				      </tr>
				      <tr>
				        <td style="background: url('.SITE_URL.'images/bgmid.gif) left top repeat-y;"><table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
				          <tr>
				            <td width="250" bgcolor="#FFF8DA"><img src="'.SITE_URL.'images/logo.png" alt="" width="143" height="59" /></td>
				            <td width="350" bgcolor="#FFF8DA" style="font-family: Arial, Helvetica, sans-serif; font-size: 20px; line-height: 20px; color: #9B162B; font-weight: normal;">
				            GeeLaza - Your new password is here
				            </td>
				          </tr>
				        </table></td>
				      </tr>
				      <tr>
				        <td><img src="'.SITE_URL.'images/bgbot.gif" alt="" width="650" height="26" /></td>
				      </tr>
				    </table></td>
				  </tr>
				  <tr>
				    <td><table width="631" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
				      <tr>
				        <td style="font-family: Arial, Helvetica, sans-serif; padding-left: 10px; font-size: 16px; line-height: 20px; color: #3c3c3c; font-weight: bold;">Hi '.$row_reset_select["first_name"].',</td>
				      </tr>
				      <tr>
				    <td style="font-family: Arial, Helvetica, sans-serif; padding-left: 10px; padding-top: 10px; font-size: 16px; line-height: 20px; color: #3c3c3c; font-weight: bold;">Did you forget your password?, No problem at all, you just few clicks away from recovering your password. </td>
				      </tr>
				      <tr>
				      <td style="font-family: Arial, Helvetica, sans-serif; padding-left: 10px; padding-top: 10px; font-size: 16px; line-height: 20px; color: #3c3c3c; font-weight: bold;">Please click on the link below to reset your password.</td>
				      </tr>
				      <tr>
				        <td style="font-family: Arial, Helvetica, sans-serif; padding-left: 10px; padding-top: 10px; font-size: 16px; line-height: 20px; color: #3c3c3c; font-weight: bold;">
				       	 <a href="'.SITE_URL.'passwordreset.php?reset='.$enc_email.'" style="text-decoration: none;">http://www.geelaza.com/passwordreset</a>
				        </td>
				      </tr>
				      <tr>
				        <td style="font-family: Arial, Helvetica, sans-serif; padding-left: 10px; padding-top: 10px; font-size: 16px; line-height: 20px; color: #3c3c3c; font-weight: bold;">After resetting your password. you will be able to sign into your GeeLaza account straight away.</td>
				      </tr>
				      <tr>
				        <td style="font-family: Arial, Helvetica, sans-serif; padding-left: 10px; padding-top: 10px; font-size: 16px; line-height: 20px; color: #3c3c3c; font-weight: bold;">Good Luck</td>
				      </tr>
				      <tr>
				        <td>&nbsp;</td>
				      </tr>
				      <tr>
				        <td>&nbsp;</td>
				      </tr>
				    </table></td>
				  </tr>
				  <tr>
				    <td><table width="631" border="0" align="center" cellpadding="0" cellspacing="0" style="padding: 8px 0 0 0;">
				      <tr>
				        <td colspan="2" bgcolor="#75d4fc">&nbsp;</td>
				        </tr>
				      <tr>
				        <td width="516" bgcolor="#ddedcc" style="font-family: Arial, Helvetica, sans-serif; padding-left: 10px; padding-bottom: 10px; padding-top: 10px; font-size: 12px; line-height: 16px; color: #3c3c3c; font-weight: normal;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. <a href="#" style="color:#FF0000; text-decoration:none;">more read</a></td>
				        <td width="115" align="left" valign="top" bgcolor="#ddedcc" style="padding-top: 10px;"><table width="130" border="0" cellspacing="0" cellpadding="0">
				          <tr>
				            <td width="69" style="font-family: Arial, Helvetica, sans-serif; padding-left: 10px; padding-bottom: 10px; padding-top: 10px; font-size: 12px; line-height: 16px; color: #3c3c3c; font-weight: bold;">Follow us:</td>
				            <td width="22"><img src="'.SITE_URL.'images/facebook.png" alt="" width="17" height="18" /></td>
				            <td width="24"><img src="'.SITE_URL.'images/twitter.png" alt="" width="17" height="18" /></td>
				          </tr>
				        </table></td>
				      </tr>
				      <tr>
				        <td colspan="2"><img src="'.SITE_URL.'images/spacer.gif" alt="" width="1" height="9"/></td>
				      </tr>
				      <tr>
				        <td colspan="2" bgcolor="#FFFFFF" style="font-family: Arial, Helvetica, sans-serif; text-align: center; padding-left: 10px; padding-bottom: 10px; padding-top: 10px; font-size: 12px; line-height: 16px; color: #3c3c3c; font-weight: bold;"><a href="#" style="color: #333333; text-decoration: none;">@GeeLaza.com</a> | <a href="#" style="color: #333333; text-decoration: none;">Terms & Conditions</a> | <a href="#" style="color: #333333; text-decoration: none;">About GeeLaza</a></td>
				      </tr>
				      <tr>
				        <td colspan="2" bgcolor="#75d4fc">&nbsp;</td>
				      </tr>
				    </table></td>
				  </tr>
				</table>
				
				
				'; 
				
				
				//<!-- Email Template Ends -->
				
				$to = $row_reset_select["email"];
				$subject = "GetDeala Password Reset";
				$message = $EmailTemplate;	//base64_decode($row_reset_select['password'])
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: GeeLaza <GeeLaza@example.com>' . "\r\n";
				
				
				mail($to, $subject, $message, $headers);
				//echo "mail fired...";
				$flag = 2;
				$msg = 'Thanks for contacting. We have sent you an email at your registered email address.';
				
				$temp_password = str_rand($length = 32, $seeds = 'alphanum');
				
				$temp_password_sql = "INSERT INTO ".TABLE_TEMP_PASSWORD." VALUES ('','$row_reset_select[user_id]', '$row_reset_select[email]', '$temp_password')";
				mysql_query($temp_password_sql);
			}
			else
			{
				$msg = 'The email address you entered is not registered with us.';
				$flag = 1;
			}
		}
}
?>

<?php 
if($flag == 2) {
?>
	<p class="reset" style="padding: 15px;">We have sent you instructions on how to reset your password to your email address. Please chekc your email address for a password reset link.</p>

<?php 	
} else {
?>



 
<form name="cust_login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<table width="600" border="0" align="center" cellpadding="2" cellspacing="2">
  <tr>
    <td colspan="2" class="forgot">Forgot your password?</td>
  </tr>
  <tr>
    <td width="301" height="26">Enter your Email address, click the "Submit" button and we'll send you an image with a link to reset it.</td>
    <td width="285">
    	<?php
		if($flag == 1)
		{
			?>
			<div style="width:100%; height:auto; background-color:transparent;padding-top:4px; padding-left:0px;">
			<label style="color:red;"><?php echo $msg; ?></label>
			</div>
			
		 <?php } ?>
			
    <input type="text" name="reset_email" id="reset_email" value="" class="white_29" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/></td>
  </tr>
  <tr>
    <td><input type="submit" class="reset29" name="submit" value="Submit"/></td>
    <td class="note"><!-- Note:This should be the email address that is registered with GeeLaza --></td>
  </tr>
 </table>

</form>

<?php } ?>

</div>
</div>
<div class="bot_curve1"></div>
</div>

<!-- deal box ends -->
<?php echo $EmailTemplate; ?>
</div>
<?php include ('include/sidebar-forget.php');?>
</div>
<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
<?php include ('include/footer.php'); ?>