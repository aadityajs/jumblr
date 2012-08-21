<?php include("include/header.php");?>
<?php
error_reporting(E_ERROR && E_STRICT);
?>
<!--<script language="JavaScript" src="js/gen_validatorv4.js" type="text/javascript" xml:space="preserve"></script>-->

<div id="container">
<div id="leftcol">
<div class="loginBoxnew">
<div class="lb_top"></div>
<div class="clear"></div>
<div class="lb_mid">
<div class="signup_box_ani">

<?php 
if ($_GET['reset'] != "" ) {
		
		$_SESSION['email'] = $_GET['reset'];
		$decoded_email =  base64_decode(base64_decode($_SESSION['email']));
		}
?>
<?php

	$flag == 0;	
	if (strtolower($_SERVER['REQUEST_METHOD']) == 'post' && $_POST['btnReset'] == "Reset password") {
	
		$new_pass = $_POST['newpassword'];
		$conf_new_pass = $_POST['confpassword'];
		
		$enc_new_password = base64_encode($conf_new_pass);
		if($flag == 0)
			{
				if($new_pass == '' || $conf_new_pass == '')
				{
					$msg = 'Enter your new password';
					$flag = 1;
				}
				if($new_pass !== $conf_new_pass)
				{
					$msg = 'Password do not match. Please try again';
					$flag = 1;
				}
			}
		
		$decoded_email =  base64_decode(base64_decode($_SESSION['email']));
		//echo "----------------------------".$decoded_email;
		
			if($flag == 0) {
				$update_password_sql = "UPDATE ".TABLE_USERS." SET password = '$enc_new_password' WHERE email='$decoded_email'";
				$update_password_res = mysql_query($update_password_sql);
				$update_password_affect = mysql_affected_rows();
				
				$delete_temp_password = "DELETE FROM ".TABLE_TEMP_PASSWORD." WHERE email='$decoded_email'";
				mysql_query($delete_temp_password);
				unset($_SESSION['email']);
				$flag = 2;
				/*if($update_password_affect >0)
				{
					
					$flag = 2;
					//$msg = 'Your password has updated successfully! Plese login.';
					
				}
				else
				{
					$msg = 'Unexpected Error!';
					$flag = 1;
				}*/
			}
	}

	?>

<?php
if($flag == 1)
{
	?>
	<!-- 
	<div style="width:345px; height:45px; background-color:transparent;padding-top:4px; padding-left:30px;">
	<label style="color:#CC0000;"><?php //echo $msg; ?></label>
	</div>
	 -->
<?php } ?>


<?php 
if($flag == 2) {
	header('location:'.SITE_URL.'?prs=Your account password has been reset successfully.');
?>
	<!--<center><p class="reset">Your password has been Reset.</p></center>-->

<?php 	
} else {
?>

<!--  onsubmit="javascript: return Validator();" -->

<form name="reset_password" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="javascript: return ValidateResetForm();">
	<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="password">
	  <tr>
	    <td colspan="2" class="reset">Reset your password below</td>
	  </tr>
	  <tr>
	    <td width="136" height="16" style="margin: 0 0 -10px 0;">New Password </td>
	    <td width="190">
	    Confirm New Password 
		</td>
	  </tr>
	  <tr>
	  	
	    <td style="padding-right: 10px;">
		<div id='reset_password_newpassword_errorloc' class="error"><?php echo $msg; ?></div>
	    <input  type="password" name="newpassword" id="newpassword" class="text_box12" style="width:290px; <?php if(isset($_POST) && $flag ==1) {echo 'border:1px solid red;';} ?>"/>
		</td>
	    <td>
		<div id='reset_password_confpassword_errorloc' class="error"><?php if ($msg) {echo '&nbsp;'; }?></div>
	    <input type="password" name="confpassword" id="confpassword" class="text_box12" style="width:290px; <?php if(isset($_POST) && $flag ==1) {echo 'border:1px solid red;';} ?>"/></td>
	  </tr>
	  <tr>
	    <td colspan="2"><input type="submit" name="btnReset" value="Reset password" class="log_in_2012" style="cursor:pointer;"/></td>
	  </tr>
	</table>
</form>

<!-- Reset password form validator starts --> 


<script language="JavaScript" type="text/javascript"
    xml:space="preserve">//<![CDATA[
//You should create the validator only after the definition of the HTML form
  	//var frmvalidator  = new Validator("reset_password");
    //frmvalidator.EnableOnPageErrorDisplay();
    //frmvalidator.EnableMsgsTogether();
    //frmvalidator.clearAllValidations();
    
    //frmvalidator.addValidation("newpassword","req","Enter your password");
    //frmvalidator.addValidation("newpassword","maxlen=6");
   // frmvalidator.addValidation("confpassword","req","Confirm your password");
    //frmvalidator.addValidation("confpassword","eqelmnt=newpassword","Confirm your password");

//]]></script>
<script type="text/javascript">

function ValidateResetForm () {
	var newpass = document.getElementById('newpassword').value;
	var confnewpass = document.getElementById('confpassword').value;
	if ( newpass == "") {
		//alert ("asdasda");
		document.getElementById('reset_password_newpassword_errorloc').innerHTML = "Enter your new password";
		document.getElementById('reset_password_confpassword_errorloc').innerHTML = "You must confirm new password";
		document.getElementById('newpassword').style.border = "1px solid red";
		document.getElementById('confpassword').style.border = "1px solid red";
		return false;
	}
	else if ( confnewpass == "") {
		
		document.getElementById('reset_password_newpassword_errorloc').innerHTML = "&nbsp;";
		document.getElementById('reset_password_confpassword_errorloc').innerHTML = "You must confirm new password";
		document.getElementById('newpassword').style.border = "1px solid red";
		document.getElementById('confpassword').style.border = "1px solid red";
		return false;
	}
	else if ( newpass.length <= 5) {
		
		document.getElementById('reset_password_newpassword_errorloc').innerHTML = "Your Password must be minimum 6 charecters";
		document.getElementById('reset_password_confpassword_errorloc').innerHTML = "&nbsp;";
		document.getElementById('newpassword').style.border = "1px solid red";
		document.getElementById('confpassword').style.border = "1px solid red";
		return false;
	}
	else if ( newpass != confnewpass) {
		
		document.getElementById('reset_password_newpassword_errorloc').innerHTML = "Password do not match. Please try again";
		document.getElementById('reset_password_confpassword_errorloc').innerHTML = "&nbsp;";
		document.getElementById('newpassword').style.border = "1px solid red";
		document.getElementById('confpassword').style.border = "1px solid red";
		return false;
	}
	
	
}

</script>
  <!-- Reset password form validator ends --> 
  
 <?php } 		// endif ?>
</div>
</div>
<div class="lb_bottom"></div>
</div>


<!--<form name="cust_login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="blue_box" style=" background:#dae8c4">
       <tr>
         <td>
        
         <table width="600" border="0" align="center" cellpadding="3" cellspacing="3">
           <tr>
             <td colspan="3"><p></p></td>
           </tr>
           <tr>
             <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
               <tr>
                 <td width="51%" height="50px;" >Email Address</td>
                 <td width="49%"><input type="text" name="reset_email" id="reset_email" value="" class="text_box1" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/></td>
               </tr>
               <tr>
                 <td height="50px;" >New Password</td>
                 <td><input type="password" name="newpassword" id="newpassword" class="text_box1" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/></td>
               </tr>
               <tr>
                 <td height="50px;" >Confirm Password</td>
                 <td><input type="password" name="confpassword" id="confpassword" class="text_box1" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/></td>
               </tr>
             </table>
             </td>
           </tr>
           <tr>
             <td width="127"><input type="submit" name="btnReset" value="Reset password" class="reset_btn" style="cursor:pointer;" /></td>
           </tr>
          
         </table>
    
         </td>
       </tr>
     </table>
</form>-->

<!-- deal box ends -->

</div>
<?php include ('include/sidebar.php');?>
</div>
<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
<?php include ('include/footer.php'); ?>