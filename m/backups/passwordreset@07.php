<?php include("include/header.php");?>
<?php
error_reporting(E_ERROR && E_STRICT);
?>
<script language="JavaScript" src="js/gen_validatorv4.js" type="text/javascript" xml:space="preserve"></script>

<div id="container">
<div id="leftcol">
<div class="deal_curve">
<div class="top_curve"></div>
<div class="clear"></div>
<div class="mid_curve">
<div class="signup_box">

<?php 
if ($_GET['reset'] != "" ) {
		
		$_SESSION['email'] = $_GET['reset'];
		echo $decoded_email =  base64_decode(base64_decode($_SESSION['email']));
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
					$msg = 'Please enter password';
					$flag = 1;
				}
				if($new_pass !== $conf_new_pass)
				{
					$msg = 'Confirmation does not match!';
					$flag = 1;
				}
			}
		
		$decoded_email =  base64_decode(base64_decode($_SESSION['email']));
		//echo "----------------------------".$decoded_email;
		
			if($flag == 0) {
				$update_password_sql = "UPDATE ".TABLE_USERS." SET password = '$enc_new_password' WHERE email='$decoded_email'";
				$update_password_res = mysql_query($update_password_sql);
				$update_password_affect = mysql_affected_rows();
				
				if($update_password_affect >0)
				{
					
					$flag = 2;
					//$msg = 'Your password has updated successfully! Plese login.';
					unset($_SESSION['email']);
				}
				else
				{
					$msg = 'Unexpected Error!';
					$flag = 1;
				}
			}
	}

	?>

<?php
if($flag == 1)
{
	?>
	<div style="width:345px; height:45px; background-color:transparent;padding-top:4px; padding-left:30px;">
	<label style="color:#CC0000;"><?php echo $msg; ?></label>
	</div>
	
<?php } ?>


<?php 
if($flag == 2) {
?>
	<center><p class="reset">Your password has been Reset.</p></center>

<?php 	
} else {
?>



<form name="reset_password" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="javascript: return Validator();">
	<table width="400" border="0" align="center" cellpadding="0" cellspacing="0" class="password">
	  <tr>
	    <td colspan="2" class="reset">Reset your password below</td>
	  </tr>
	  <tr>
	    <td width="136" height="26">Password </td>
	    <td width="190">
	    Confirm Password 
		</td>
	  </tr>
	  <tr>
	    <td>
		<div id='reset_password_newpassword_errorloc' class="error"></div>
	    <input type="password" name="newpassword" id="newpassword" class="white_28" <?php if(isset($_POST) && $flag ==1) {echo 'style="border:1px solid red;"';} ?>/>
		</td>
	    <td>
		<div id='reset_password_confpassword_errorloc' class="error"></div>
	    <input type="password" name="confpassword" id="confpassword" class="white_28" <?php if(isset($_POST) && $flag ==1) {echo 'style="border:1px solid red;"';} ?>/></td>
	  </tr>
	  <tr>
	    <td colspan="2"><input type="submit" name="btnReset" value="Reset password" class="reset23" style="cursor:pointer;"/></td>
	  </tr>
	</table>
</form>

<!-- Reset password form validator starts --> 


<script language="JavaScript" type="text/javascript"
    xml:space="preserve">//<![CDATA[
//You should create the validator only after the definition of the HTML form
  	var frmvalidator  = new Validator("reset_password");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();
    //frmvalidator.clearAllValidations();
    
    frmvalidator.addValidation("newpassword","req","Enter your password");
    frmvalidator.addValidation("newpassword","maxlen=6");
    frmvalidator.addValidation("confpassword","req","Confirm your password");
    //frmvalidator.addValidation("confpassword","eqelmnt=newpassword","Confirm your password");

//]]></script>

  <!-- Reset password form validator ends --> 
  
 <?php } 		// endif ?>
</div>
</div>
<div class="bot_curve"></div>
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