<?php include("include/header.php");?>
<?php
error_reporting(E_ERROR && E_STRICT);
?>
<div id="container">
<div id="leftcol">
<div class="deal_info">
<div class="top_about">
<p>Password Reset</p>
</div>
<div class="clear"></div>
<div class="midbg">
<div class="today_deal">
<?php 
$flag == 0;	
if (isset($_POST['reset_email']) && ($_POST['btnReset'] == "Submit")) {
			
	$reset_email = $_POST['reset_email'];
	if($flag == 0)
		{
			if($reset_email == '')
			{
				$msg = 'Please enter correct Email address';
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

				$to = $row_reset_select["email"];
				$subject = "GetDeala Password Reset";
				$message = "Hi";	//base64_decode($row_reset_select['password'])
				
				@mail($to, $subject, $message);
				$flag = 2;
				$msg = 'Thanks for contacting. We have sent you an email at your registered email address.';
			}
			else
			{
				$msg = 'Invalid Email address';
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
	
<?php } elseif ($flag == 2) { ?>
	<div style="width:345px; height:45px; background-color:transparent;padding-top:4px; padding-left:30px;">
	<label style="color:green;"><?php echo $msg; ?></label>
	</div>
<?php } ?>

<form name="cust_login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

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
             <td width="127"><input type="submit" name="btnReset" value="Submit" class="reset_btn" style="cursor:pointer;" /></td>
           </tr>
          
         </table>
    
         </td>
       </tr>
     </table>
</form>

<!-- deal box ends -->
<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="30" /></div>
</div>
</div>
<div class="bot_about"></div>
</div>
</div>
<?php include ('include/sidebar.php');?>
</div>
<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
<?php include ('include/footer.php'); ?>