<?php include("include/header.php");?>

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
<div class="refund_box">
<div class="refund_top"></div>
<div class="refund_mid">

<?php if ($_GET['claimed'] != "done") { ?>
	<div><p>Can I get a refund for my order?</p></div>
	<div class="clear"></div>
	<div class="text13">We do provide refund if you change your mind on a purchase within five days after you've purchase your
	voucher and want to "return" the unused voucher. After that, we do not provide refunds expect that we
	will provide a refund if you are unable to redeem a voucher because the merchant has gone out of business.</div>
	<div class="clear"></div>

	<?php
	$flag = 0;
	if (isset($_POST['submit'])) {

		/*$chk_for_email_sql = "SELECT * FROM ".TABLE_TEMP_PASSWORD;
		$chk_for_email_res = mysql_query($chk_for_email_sql);

		while ($chk_for_email_row = mysql_fetch_array($chk_for_email_res)) {

			if ($chk_for_email_row['email'] == $_POST['reset_email']) {
				$msg = 'You already have requested for pasword reset, please follow the required steps in the email sent to you.';
				$flag = 1;
			}
		}*/
		$_SESSION['email'] = $_POST['email'];
		$email = $_POST['email'];
		$geecode = $_POST['geecode'];
		$date = date('d/m/Y');

		if($flag == 0)
			{
				if($email == '')
				{
					$msg = 'Please enter your email address.';
					$flag = 1;
				}
				else if (ValidateEmail($email) == FALSE)
				{
					$msg = 'Please enter a valid email address.';
					$flag = 1;
				}
			}

			if($flag == 0) {
				$sql_reset_select = "SELECT * FROM ".TABLE_USERS." WHERE email='$email'";
				$result_reset_select = mysql_query($sql_reset_select);
				$count_reset_select = mysql_num_rows($result_reset_select);

				if($count_reset_select >0)
				{
				$refund_req_sql = "INSERT INTO ".TABLE_REFUND_REQUEST." VALUES (null,'$email', '$geecode', '$date', 1)";
				mysql_query($refund_req_sql);


				$sql_reset_select = "SELECT * FROM ".TABLE_USERS." WHERE email='$_SESSION[email]'";
				$result_reset_select = mysql_query($sql_reset_select);
				$count_reset_select = mysql_num_rows($result_reset_select);
				$row_reset_select = mysql_fetch_array($result_reset_select);

				$image_path = SITE_URL.'images/';
				$EmailTemplate = '
							<table border="0" cellspacing="0" cellpadding="0" width="620" style="vertical-align:top; width:620px;margin:0 auto 0 auto;">
							  <tr>
								<td valign="top" align="left" height="83" style="height:10px; line-height:0px;"><img src="'.$image_path.'box1_top.png"  width="620" height="83" alt="" /></td>
							  </tr>
							   <tr>
								<td valign="top">
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
												<center>Your Refund Claim Confirmation</center>
												</td>
												</tr>
												<tr>
												<td style="vertical-align:top; color:#ff7f27; font-family: Arial Rounded MT, Arial, Helvetica, sans-serif; line-height:15px; font-size:24px;  padding:20px 0 10px 15px; font-weight: bold;">
												Hi '.$row_reset_select["first_name"].'
												</td>
												</tr>
												<tr>
												<td style="vertical-align:top; color:#333231; font-family: Arial, Helvetica, sans-serif; line-height:26px; font-size:12px;  padding:0 0 15px 15px;">
												This is to acknowledge that we have received a Refund Claim request from you with the following details. <br />
												GeeLaza Code: <strong>'.$geecode.'</strong>
												<br/>
												We will check the information you have provided to us and we will get back to you as soon as possible.
												<br/>
												If you don’t hear back from us in the next 5 days, please contact The GeeLaza Team and mention your GeeLaza Code. <br /><br />
												Regards, <br />
												The GeeLaza Team
												</td>
												</tr>

												<tr>
												<td>
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
												<tr>
												<td style="vertical-align:top; color:#333231; font-family: Arial, Helvetica, sans-serif; line-height:26px; font-size:12px;  padding:0 0 0 0;"></td>
												<td width="85" style="vertical-align:top; color:#333231; font-family: Arial, Helvetica, sans-serif; line-height:26px; font-size:12px;  padding:0 0 0 0; text-align:center;">Follow Us on:</td>
												</tr>
												<tr>
												<td style="vertical-align:top; color:#333231; font-family: Arial, Helvetica, sans-serif; line-height:26px; font-size:12px;  padding:0 0 0 0;"></td>
												<td style="text-align:center;"><img src="'.$image_path.'facebook.png" width="17" height="18" alt="" /> <img src="'.$image_path.'icon_02.png" width="17" height="18" alt="" /></td>
												</tr>
												</table>
												</td>
												</tr>

												<tr>
												<td style="vertical-align:top; color:#333231; font-family: Arial, Helvetica, sans-serif; line-height:26px; font-size:12px;  padding:8px 0 0 15px; text-align: center;">

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
								<td valign="top" align="left" height="10" style="height:10px;  line-height:0px;"><img src="'.$image_path.'box1_bottom.png"  width="620" height="10" alt="" /></td>
							  </tr>
							</table>
						';

				//echo $EmailTemplate;
		//<!-- Email Template Ends -->

						$to = $_SESSION['email'];
						$subject = "Your Refund Claim Confirmation";
						$message = $EmailTemplate;
						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$headers .= 'From: GeeLaza <support@geelaza.com>' . "\r\n";


						mail($to, $subject, $message, $headers);
						//echo "mail fired...";


				header('location:'.SITE_URL.'ecard.php?claimed=done');
				}
				else
				{
					$msg = 'Your refund claim was not submitted because: <br/>Email Address not found';
					$flag = 1;
				}
			}
	}
	?>

	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="refund_req" id="refund_req" onsubmit="javascript: return ValidateRefund_ReqForm();" >
	  <div style="border:1px #CCCCCC solid; width: 676px; margin: 0 auto; float: none;">
	  <table width="676" align="center" border="0" cellspacing="0" cellpadding="0">
	   <tr>
	    <td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="login_bg2">
	       <tr>
	         <td>
	         <?php
			if($flag == 1)
			{
				?>
				<div style="width:100%; height:auto; background-color:transparent;padding-top:4px; padding-left:0px;">
				<label class="error_red"><?php echo $msg; ?></label>
				</div>

			<?php } ?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="login_bg">
		<tr>
	    <td><img src="images/spacer.gif" alt="" width="1" height="6"/></td>
	    </tr>
	    <tr>
	    <td class="text_black"> <span><img src="images/spacer.gif" alt="" width="210" height="1" /></span><!-- <span>Required field <span class="red">(*)</span></span> --></td>
	    </tr>

	    <tr>
	    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
	     <tr>
	        <td>Email Address:</td>
	      </tr>
	      <tr>
	        <td width="45%">
	        <div id="email_errorloc" class="error_red"></div>
	        <input type="text" name="email" id="email" value="" class="text_box12" />        </td>
	      </tr>
	      <tr><td><img src="images/spacer.gif" alt="" width="1" height="13"/></td></tr>
	      <tr>
	        <td>GeeLaza Code:</td>
	      </tr>
	      <tr>
	        <td width="55%">
	        <div id="geecode_errorloc" class="error_red"></div>
	        <input type="text" name="geecode" id="geecode" value="" class="text_box12" />        </td>
	      </tr>
	       <tr><td><img src="images/spacer.gif" alt="" width="1" height="13"/></td></tr>

	    </table></td>
	    </tr>

	    <tr>
	    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

	      </table></td>
	    </tr>
	  </table>
	  </td>
	       </tr>
	     </table>

	  </td>
	        <td width="39%" align="left" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="2">

	   		  <td colspan="2" align="center" valign="middle" style="color:#000; font: bold 14px/18px Calibri, Arial, Helvetica, sans-serif;">&nbsp;</td>

	      </tr>
	          <tr>
	            <td width="16%" align="center" valign="middle"><img src="images/green_thick.gif" alt="" width="23" height="18" /></td>
	            <td width="84%" align="left" valign="middle" style="color:#000; font: bold 14px/28px Calibri, Arial, Helvetica, sans-serif;">Claim within 5 days</td>
	          </tr>
	          <tr>
	            <td align="center" valign="middle"><img src="images/green_thick.gif" alt="" width="23" height="18" /></td>
	            <td align="left" valign="middle" style="color:#000; font: bold 14px/28px Calibri, Arial, Helvetica, sans-serif;">Voucher must be unused</td>
	          </tr>
	          <tr>
	            <td colspan="2" style="padding: 10px 14px;">
                    <input type="submit" class="claim" name="submit" id="button" value="" style="cursor: pointer;"/>

	            </td>
	            </tr>

	        </table></td>
	      </tr>
	   <tr>
	     <td colspan="2">

	    </td>
	     </tr>
	    </table>
	  <div></div>
	  </div>
	  </form>

	  <script type="text/javascript">
	  function ValidateRefund_ReqForm() {
		var email = document.getElementById('email').value;
		var geecode = document.getElementById('geecode').value;
		if ( email == "" || geecode == "") {
			//alert ("asdasda");
			document.getElementById('email_errorloc').innerHTML = "This field is required";
			document.getElementById('email').style.border = "1px solid red";

			document.getElementById('geecode_errorloc').innerHTML = "This field is required";
			document.getElementById('geecode').style.border = "1px solid red";
		return false;
		}

	  }

	  </script>

<?php } else { ?>
<!--start thankyou-->

<div class="content_box2" style="width:680px; margin-left:10px; background:none; padding-top:10px;">
<div class="content_box2" style="width:680px; border:1px solid #edeced; margin:0px; background:none; padding-top:10px;">
	<h1 style="width:100%; text-align:left;">Thank You</h1>
    <div style="padding-left:15px;">Thank you for submitting the claim. An acknowledgement email has been sent to you. </div>
 </div>
    <h1 style="width:100%; text-align:left; font-size:17px;">What’s next?</h1>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="300">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="text-align:center;"><img src="images/next1.gif" alt="" /><br />Review</td>
                <td style="line-height:15px;">We will check our records against the information you have provided to find your voucher to see if you are eligible for a refund claim.</td>
              </tr>
            </table>
         </td>
        <td width="30">&nbsp;</td>
        <td>
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="text-align:center;"><img src="images/next2.gif" alt="" /><br />contact</td>
                <td style="line-height:15px; padding:0 8px 0 0;">We will contact you to let you know if your claim has been successful or not. If you are eligible for a refund then we will refund you, its that simple!</td>
              </tr>
            </table>
        </td>
      </tr>
    </table>

<div class="clear"></div>
</div>
<!--end thankyou-->








<?php } ?>
</div>
<div class="refund_bot"></div>
</div>
</div>

<?php include ('include/sidebar-login.php'); ?>
</div>

<?php include("include/footer.php");?>