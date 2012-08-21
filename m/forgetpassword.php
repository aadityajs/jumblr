<?php include("include/header.php");?>
<?php
error_reporting(E_ERROR && E_STRICT);
?>

<?php
$image_path = SITE_URL.'images/';

$EmailTemplate = '
					<table border="0" cellspacing="0" cellpadding="0" width="620" style="vertical-align:top; width:620px;margin:0 auto;">
					  <tr>
						<td valign="top" align="left" height="10" style="height:10px; line-height: 0;"><img src="'.$image_path.'box1_top.png"  width="620" height="10" alt="" /></td>
					  </tr>
					   <tr>
						<td>
						<table border="0" cellspacing="0" cellpadding="0" width="620" background="'.$image_path.'bg_p.gif" style="vertical-align:top; width:620px;margin:0 auto;">
										<tr>
										<td height="0" valign="top" style="vertical-align:top; height:0px; line-height:0px;">
										<table border="0" cellspacing="0" cellpadding="0" width="620" background="'.$image_path.'bg_p.gif" style="vertical-align:top; width:620px;">
										<tr>
										<td width="10" valign="top" style="vertical-align:top; width:10px;"><img src="'.$image_path.'spacer.gif" width="10" height="1" alt="" /></td>
										<td width="164" height="72" align="left" valign="top" style="vertical-align:top; text-align:left; width:164px; height:72px; line-height:0px;"><img src="'.$image_path.'logo_email.gif" width="164" height="72" alt="" style="border-left:1px solid gray; border-right:1px solid gray"/></td>
										<td width="350" valign="top" style="vertical-align:top; width:350px;"><img src="'.$image_path.'spacer.gif" width="350" height="1" alt="" /></td>
										</tr>
										</table>
										</td>
										</tr>
										<tr>
										<td height="5" valign="top" style="vertical-align:top; height:5px; line-height:0px;"><img src="'.$image_path.'spacer.gif" width="1" height="5" alt="" /></td>
										</tr>

										<tr>
										<td height="0" valign="top">
										<table border="0"  bgcolor="#7fd7fc" cellspacing="0" cellpadding="0" width="600"  style="vertical-align:top; width:600px; margin:0 auto;">
										<tr>
										<td  style="padding:8px 0;">

										<table border="0" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" width="586"  style="vertical-align:top; width:586px; margin:0 auto;">
										<tr>
										<td height="9" valign="top" style="vertical-align:top; height:9px; line-height:0px;"><img src="'.$image_path.'top.gif" width="586" height="9" alt="" /></td>
										</tr>
										<tr>
										<td style="vertical-align:top; color:#333231; font-family:Arial, Helvetica, sans-serif; line-height:28px; font-size:28px; border-bottom:3px solid #10adff; padding:14px 0 20px 15px; font-weight: bold;">
										GeeLaza - Your new password is here!
										</td>
										</tr>
										<tr>
										<td style="vertical-align:top; color:#ff7f27; font-family: Arial Rounded MT, Arial, Helvetica, sans-serif; line-height:15px; font-size:24px;  padding:20px 0 10px 15px; font-weight: bold;">
										Hey '.$row_reset_select["first_name"].'
										</td>
										</tr>
										<tr>
										<td style="vertical-align:top; color:#333231; font-family: Arial, Helvetica, sans-serif; line-height:26px; font-size:12px;  padding:0 0 15px 15px;">
										Forgot your password? No Problem.   <br />
										Please click on the link below to reset your password. <br />
										<a href="'.SITE_URL.'passwordreset.php?reset='.$enc_email.'" style="text-decoration: none;">'.SITE_URL.'passwordreset.php?reset='.$enc_email.'</a><br />
										As always, if you have any questions, comments, or concerns, please contact your <a href="'.SITE_URL.'page.php?page=Contact us" style="text-decoration:none;">customer service</a>.<br />
										We\'d love to hear from you! <br />
										The GeeLaza Team
										</td>
										</tr>

										<tr>
										<td valign="top" align="left" style="padding:8px 15px 8px 15px; border-top:3px solid #10adff; border-bottom:3px solid #10adff;">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
										<td style="vertical-align:top; color:#333231; font-family: Arial, Helvetica, sans-serif; line-height:26px; font-size:12px;  padding:0 0 0 0;">Other Cities:</td>
										<td width="85" style="vertical-align:top; color:#333231; font-family: Arial, Helvetica, sans-serif; line-height:26px; font-size:12px;  padding:0 0 0 0; text-align:center;">Follow Us on:</td>
										</tr>
										<tr>
										<td style="vertical-align:top; color:#333231; font-family: Arial, Helvetica, sans-serif; line-height:26px; font-size:12px;  padding:0 0 0 0;"> <a href="'.SITE_URL.'?city=31">London</a>, <a href="'.SITE_URL.'?city=4">Brimingham</a>, <a href="'.SITE_URL.'?city=74">Glasgow</a>, <a href="'.SITE_URL.'?city=65">Dublin</a>, <a href="'.SITE_URL.'?city=30">Liverpool</a>, <a href="'.SITE_URL.'?city=26">Leeds</a>, <a href="'.SITE_URL.'?city=70">Edinburg</a>, <a href="'.SITE_URL.'" style="text-decoration:none;">more cities &raquo;</a></td>
										<td style="text-align:center;"><img src="'.$image_path.'facebook.png" width="17" height="18" alt="" /> <img src="'.$image_path.'icon_02.png" width="17" height="18" alt="" /></td>
										</tr>
										</table>
										</td>
										</tr>

										<tr>
										<td style="vertical-align:top; color:#333231; font-family: Arial, Helvetica, sans-serif; line-height:26px; font-size:12px;  padding:8px 0 0 15px; text-align: center;">
										<a href="'.SITE_URL.'">© Geelaza.com</a>  | <a href="'.SITE_URL.'page.php?page=Terms%20and%20Conditions">Terms & Conditions</a>    | <a href="'.SITE_URL.'customer-register.php">Join us</a> | <a href="'.SITE_URL.'page.php?page=About%20GeeLaza%20UK">About GeeLaza</a> | <a href="'.SITE_URL.'customer-register.php">Get Featured</a>
										</td>
										</tr>
										<tr>
										<td height="9" valign="top" style="vertical-align:top; height:9px; line-height:0px;"><img src="'.$image_path.'bottom.gif" width="586" height="9" alt="" /></td>
										</tr>
										</table>
										</td>
										</tr>
										</table>
										<tr>
										<td height="8" valign="top" style="vertical-align:top; height:8px; line-height:0px;"><img src="'.$image_path.'spacer.gif" width="1" height="8" alt="" /></td>
										</tr>
										</td>
										</tr>

										</table>
						</td>
					  </tr>
					  <tr>
						<td valign="top" align="left" height="10" style="height:10px; line-height: 0;"><img src="'.$image_path.'box1_bottom.png"  width="620" height="10" alt="" /></td>
					  </tr>
					</table>
				';


//echo $EmailTemplate;



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
if (isset($_POST['reset_email']) && ($_POST['submit'] == "Reset my passwod")) {

	/*$chk_for_email_sql = "SELECT * FROM ".TABLE_TEMP_PASSWORD;
	$chk_for_email_res = mysql_query($chk_for_email_sql);

	while ($chk_for_email_row = mysql_fetch_array($chk_for_email_res)) {

		if ($chk_for_email_row['email'] == $_POST['reset_email']) {
			$msg = 'You already have requested for pasword reset, please follow the required steps in the email sent to you.';
			$flag = 1;
		}
	}*/

	$reset_email = $_POST['reset_email'];
	if($flag == 0)
		{
			if($reset_email == '')
			{
				$msg = 'Please enter your email address.';
				$flag = 1;
			}
			else if (ValidateEmail($reset_email) == FALSE)
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

					<table border="0" cellspacing="0" cellpadding="0" width="620" style="vertical-align:top; width:620px;margin:0 auto;">
					  <tr>
						<td valign="bottom" align="left" height="10" style="height:10px; line-height: 0;"><img src="'.$image_path.'box1_top.png"  width="620" height="10" alt=""/></td>
					  </tr>
					   <tr>
						<td>
						<table border="0" cellspacing="0" cellpadding="0" width="620" background="'.$image_path.'bg_p.gif" style="vertical-align:top; width:620px;margin:0 auto;">
										<tr>
										<td height="0" valign="top" style="vertical-align:top; height:0px; line-height:0px;">
										<table border="0" cellspacing="0" cellpadding="0" width="620" background="'.$image_path.'bg_p.gif" style="vertical-align:top; width:620px;">
										<tr>
										<td width="10" valign="top" style="vertical-align:top; width:10px;"><img src="'.$image_path.'spacer.gif" width="10" height="1" alt="" /></td>
										<td width="164" height="72" align="left" valign="top" style="vertical-align:top; text-align:left; width:164px; height:72px; line-height:0px;"><img src="'.$image_path.'logo_email.gif" width="164" height="72" alt="" style="border-left:1px solid gray; border-right:1px solid gray"/></td>
										<td width="350" valign="top" style="vertical-align:top; width:350px;"><img src="'.$image_path.'spacer.gif" width="350" height="1" alt="" /></td>
										</tr>
										</table>
										</td>
										</tr>
										<tr>
										<td height="5" valign="top" style="vertical-align:top; height:5px; line-height:0px;"><img src="'.$image_path.'spacer.gif" width="1" height="5" alt="" /></td>
										</tr>

										<tr>
										<td height="0" valign="top">
										<table border="0"  bgcolor="#7fd7fc" cellspacing="0" cellpadding="0" width="600"  style="vertical-align:top; width:600px; margin:0 auto;">
										<tr>
										<td style="padding:8px 0;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td width="7" align="left" valign="top" style="width:7px; line-height:0px;"><img src="'.$image_path.'spacer.gif" width="7" height="1" alt="" /></td>
                                            <td>
                                               <table border="0" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" width="586"  style="vertical-align:top; width:586px; margin:0 auto;">
										<tr>
										<td height="9" valign="top" style="vertical-align:top; height:9px; line-height:0px;"><img src="'.$image_path.'top.gif" width="586" height="9" alt="" /></td>
										</tr>
										<tr>
										<td style="vertical-align:top; color:#333231; font-family:Arial, Helvetica, sans-serif; line-height:28px; font-size:28px; border-bottom:3px solid #10adff; padding:14px 0 20px 15px; font-weight: bold;">
										GeeLaza - Your new password is here!
										</td>
										</tr>
										<tr>
										<td style="vertical-align:top; color:#ff7f27; font-family: Arial Rounded MT, Arial, Helvetica, sans-serif; line-height:15px; font-size:24px;  padding:20px 0 10px 15px; font-weight: bold;">
										Hey '.$row_reset_select["first_name"].'
										</td>
										</tr>
										<tr>
										<td style="vertical-align:top; color:#333231; font-family: Arial, Helvetica, sans-serif; line-height:26px; font-size:12px;  padding:0 0 15px 15px;">
										Forgot your password? No Problem.   <br />
										Please click on the link below to reset your password. <br />
										<a href="'.SITE_URL.'passwordreset.php?reset='.$enc_email.'" style="text-decoration: none;">'.SITE_URL.'passwordreset.php?reset='.$enc_email.'</a><br />
										As always, if you have any questions, comments, or concerns, please contact your <a href="'.SITE_URL.'page.php?page=Contact us" style="text-decoration:none;">customer service</a>.<br />
										We\'d love to hear from you! <br />
										The GeeLaza Team
										</td>
										</tr>

										<tr>
										<td valign="top" align="left" style="padding:8px 15px 8px 15px; border-top:3px solid #10adff; border-bottom:3px solid #10adff;">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
										<td style="vertical-align:top; color:#333231; font-family: Arial, Helvetica, sans-serif; line-height:26px; font-size:12px;  padding:0 0 0 0;">Other Cities:</td>
										<td width="85" style="vertical-align:top; color:#333231; font-family: Arial, Helvetica, sans-serif; line-height:26px; font-size:12px;  padding:0 0 0 0; text-align:center;">Follow Us on:</td>
										</tr>
										<tr>
										<td style="vertical-align:top; color:#333231; font-family: Arial, Helvetica, sans-serif; line-height:26px; font-size:12px;  padding:0 0 0 0;"> <a href="'.SITE_URL.'?city=31">London</a>, <a href="'.SITE_URL.'?city=4">Brimingham</a>, <a href="'.SITE_URL.'?city=74">Glasgow</a>, <a href="'.SITE_URL.'?city=65">Dublin</a>, <a href="'.SITE_URL.'?city=30">Liverpool</a>, <a href="'.SITE_URL.'?city=26">Leeds</a>, <a href="'.SITE_URL.'?city=70">Edinburg</a>, <a href="'.SITE_URL.'" style="text-decoration:none;">more cities &raquo;</a></td>
										<td style="text-align:center;"><img src="'.$image_path.'facebook.png" width="17" height="18" alt="" /> <img src="'.$image_path.'icon_02.png" width="17" height="18" alt="" /></td>
										</tr>
										</table>
										</td>
										</tr>

										<tr>
										<td style="vertical-align:top; color:#333231; font-family: Arial, Helvetica, sans-serif; line-height:26px; font-size:12px;  padding:8px 0 0 15px; text-align: center;">
										<a href="'.SITE_URL.'">© Geelaza.com</a>  | <a href="'.SITE_URL.'page.php?page=Terms%20and%20Conditions">Terms & Conditions</a>    | <a href="'.SITE_URL.'customer-register.php">Join us</a> | <a href="'.SITE_URL.'page.php?page=About%20GeeLaza%20UK">About GeeLaza</a> | <a href="'.SITE_URL.'customer-register.php">Get Featured</a>
										</td>
										</tr>
										<tr>
										<td height="9" valign="top" style="vertical-align:top; height:9px; line-height:0px;"><img src="'.$image_path.'bottom.gif" width="586" height="9" alt="" /></td>
										</tr>
										</table>
                                            </td>
                                            <td width="7" align="left" valign="top" style="width:7px; line-height:0px;"><img src="'.$image_path.'spacer.gif" width="7" height="1" alt="" /></td>
                                          </tr>
                                        </table>
										</td>
										</tr>
										</table>
										<tr>
										<td height="8" valign="top" style="vertical-align:top; height:8px; line-height:0px;"><img src="'.$image_path.'spacer.gif" width="1" height="8" alt="" /></td>
										</tr>
										</td>
										</tr>

										</table>
						</td>
					  </tr>
					  <tr>
						<td valign="top" align="left" height="10" style="height:10px; line-height: 0;"><img src="'.$image_path.'box1_bottom.png"  width="620" height="10" alt="" /></td>
					  </tr>
					</table>

				';

				//<!-- Email Template Ends -->

				$to = $row_reset_select["email"];
				$subject = "Your new password reset link is here";
				$message = $EmailTemplate;	//base64_decode($row_reset_select['password'])
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: GeeLaza <info@geelaza.com >' . "\r\n";


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
	<p class="reset" style="padding: 0 0 0 15px; line-height: 20px; margin: 0px 0 0 0;">An email with instructions how to reset your password has been sent to your email address.</p>

<?php
} else {
?>




<form name="cust_login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<table width="600" border="0" align="center" cellpadding="2" cellspacing="2">
  <tr>
    <td colspan="2" class="forgot">Forgot your account password?</td>
  </tr>
  <tr>
    <td width="301" height="26">Enter your email address that you used for registration and we will send you a link to reset your password.</td>
    <td width="285">
    	<?php
		if($flag == 1)
		{
			?>
			<div style="width:100%; height:auto; background-color:transparent;padding-top:4px; padding-left:0px;">
			<label style="color:red;"><?php echo $msg; ?></label>
			</div>

		 <?php } ?>

    <input style="width: 280px; <?php if ($flag ==1) {echo 'border:1px solid red;"';} ?>" type="text" name="reset_email" id="reset_email" value="" class="white_29" /></td>
  </tr>
  <tr>
    <!--<td><input type="submit" class="reset29" name="submit" value="Submit"/></td>-->
	<td><input type="submit" class="log_in_2012" name="submit" value="Reset my passwod"/></td>
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

</div>
<?php include ('include/sidebar.php');?>
</div>
</div></div>
<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
<?php include ('include/footer.php'); ?>