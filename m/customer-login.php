<?php
include("include/header.php");
include_once "fbmain.php";
?>
<?php
	$token=base64_decode($_REQUEST['token']);
			if($token!='')
			{
							$sql_chk_fb_user_mail = "SELECT * FROM ".TABLE_FB_USER." WHERE email = '".$token."'";
							$chk_fb_user_mail_res = mysql_fetch_array(mysql_query($sql_chk_fb_user_mail));
							$count_fb_email_user = mysql_num_rows($chk_fb_user_mail_res);
							if($count_fb_email_user>0)
							{
							
								
							}
							else
							{
								$sql_insert_vault = "INSERT INTO ".TABLE_CREDITS_VAULT.
									  "(user_id,date)
									  VALUES('".$token."','".date('Y-m-d')."')";
			
								mysql_query($sql_insert_vault);
							}
			}
	if($_GET["ref"] == 'fb') {
	

		header("location:".$loginUrl );
	}
	
	

?>
<script language="JavaScript" src="js/gen_validatorv4.js" type="text/javascript" xml:space="preserve"></script>

<div id="container" style="background:none;">
<div style="background:none; margin-top: 0;" id="leftcol">
<div style="background:none;" class="">
<!-- <div class="green_curv10"></div> -->
<div class="clear"></div>
<div class="">	<!-- green_curv30 -->
<div style="background:none;" class="">
<div style="background:none;" class="register_box1">
<div class="clear"></div>

<?php
	$flag = 0;
	if(strtolower($_SERVER['REQUEST_METHOD']) == 'post' && $_POST['btnLogin'] == "Log In")
	{
		$lemail = $_POST["lemail"];
		$lpassword = $_POST["lpassword"];

		if($flag == 0)
		{
			if($lemail == '')
			{
				$msg = 'Please enter email';
				$flag = 1;
			}
		}

		if($flag == 0)
		{
			if($lpassword == '')
			{
				$msg = 'Please enter password';
				$flag = 1;
			}
		}

		if($flag == 0)
		{
			$lpassword = base64_encode($lpassword);
			$sql_select = "SELECT * FROM ".TABLE_USERS." WHERE email="."'".$lemail."' AND password="."'".$lpassword."' AND status=1 AND reg_type <> 'merchant'";
			$result_select = mysql_query($sql_select);
			$count_select = mysql_num_rows($result_select);

			$sql_select2 = "SELECT * FROM ".TABLE_USERS." WHERE email='$lemail'";
			$err_status = mysql_fetch_array(mysql_query($sql_select2));
			$err_status['status'];

			if($count_select >0)
			{
				$row_select = mysql_fetch_array($result_select);
				$user_id = $row_select["user_id"];
				$_SESSION["user_id"] = $user_id;
				header('Location: '.SITE_URL.'customer-account.php');
			}
			else {

				if ( $err_status['status'] == 1)
				{
					$msg = 'Invalid login';
					$flag = 1;
				}
				else if ( $err_status['status'] == 2) {
					$msg = 'Account disabled by Administrator';
					$flag = 2;
				}
			}
		}

	}


?>

<!-- Login form starts -->

 <form name="cust_login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"  onsubmit="javascript: return ValidateLoginForm();" style="margin:0px; padding:0px;">

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="loginBoxnew">
  <tr>
    <td class="lb_top">&nbsp;</td>
  </tr>
  <tr>
    <td class="lb_mid"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="blue_box" style="width:100%; background: none; border: none;">
       <tr>
         <td>

         <table width="600" border="0" align="center" cellpadding="3" cellspacing="3">
            <!-- <tr>
             <td colspan="3"><p style="line-height: 25px; font-size: 24px; font-family: Georgia, 'Times New Roman', Times, serif; color: #363636; margin-bottom:15px; margin-top: -10px;">Already have an Account?</p>

				<?php

				if($flag == 1)
				{
					?>
					<div style="width:100%; height:auto; background-color:transparent;padding-top:4px; padding-left:0px;">
					<label style="color:red;"><?php //echo "* ".$msg; ?>(-) Email address or password  is incorrect!</label>
					</div>
					<?php
				}
				if($flag == 2)
				{
					?>
					<div class="error_message_box">
					Your account has been disabled by an administrator. If you have any questions or concerns, you can visit our FAQ page <a href="<?php echo SITE_URL;?>faq.php">here</a>.
					</div>
					<?php
				}
				?>
             </td>
           </tr>
           <tr>
             <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
               <tr>
                 <td width="51%">Email Address</td>
                 <td width="49%">Password</td>
               </tr>
               <tr>
                 <td>
                 <div id='cust_login_lemail_errorloc' class="error"></div>
                 <input type="text" name="lemail" id="lemail" onblur="javascript: return validateEmail(this.value);"  value="<?php //if(isset($_POST) && $flag==1){ echo $_POST["lemail"];} ?>"class="text_box1" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/></td>
                 <td>
                 <div id='cust_login_lpassword_errorloc' class="error"></div>
                 <input type="password" name="lpassword" id="lpassword" class="text_box1" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/></td>
               </tr>
             </table></td>
           </tr>
           <tr>
             <td width="127"><input type="submit" name="btnLogin" value="Log In" class="log_in" style="cursor:pointer; font-size:20px;" /></td>
             <td width="22"></td>
             <td width="451"></td>
           </tr>
           <tr>
             <td style="padding-bottom: 20px;" colspan="3" class="forgot_password"><a href="<?php echo SITE_URL; ?>forgetpassword.php" style="color: blue; font-size:12px; font-family:Arial, Helvetica, sans-serif; ">Forgot your password?</a></td>
           </tr>-->
           <tr>
             <td colspan="3"  style="padding:0px; margin:0px;  height:20px;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="width:auto;">
                  <tr>
                    <td>

				        <a href="<?php echo $loginUrl; ?>"><img src="http://www.realestatenewport.com/assets/facebook-login-button-5c5750b27cc8759f735f49a5ad2a4263.png" alt="" /></a>



                    </td>
                    <td class="black_text" style="color:#3A3B3D; padding:0 0 0 6px; font-size:12px;">
                        If you have an account on Facebook you can use it to log in.
                    </td>
                  </tr>
                </table>
             </td>
           </tr>

         </table>

         </td>
       </tr>
     </table></td>
  </tr>
  <tr>
    <td class="lb_bottom">&nbsp;</td>
  </tr>
</table>
</form>

<!-- Login form ends -->


<!-- Login form validator starts -->

<script type="text/javascript">

function validateEmail(email) {

    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!re.test(email)) {
    document.getElementById('cust_login_lemail_errorloc').innerHTML = 'Invalid email address';
    document.getElementById('cust_login_lpassword_errorloc').innerHTML = '&nbsp;';
    document.getElementById('lemail').style.border = "1px solid red";
	document.getElementById('lpassword').style.border = "1px solid red";
    return false;
    }
}

function ValidateLoginForm () {
	var email = document.getElementById('lemail').value;
	var pass = document.getElementById('lpassword').value;
	if ( email == "") {
		//alert ("asdasda");
		document.getElementById('cust_login_lemail_errorloc').innerHTML = "Enter your email address";
		document.getElementById('cust_login_lpassword_errorloc').innerHTML = "Enter your password";
		document.getElementById('lemail').style.border = "1px solid red";
		document.getElementById('lpassword').style.border = "1px solid red";
		return false;
	}
	else if ( pass == "") {

		document.getElementById('cust_login_lemail_errorloc').innerHTML = "Enter your email address";
		document.getElementById('cust_login_lpassword_errorloc').innerHTML = "Enter your password";
		document.getElementById('lemail').style.border = "1px solid red";
		document.getElementById('lpassword').style.border = "1px solid red";
		return false;
	}

}

</script>

<!-- Login form validator ends -->


<?php


?>


<?php

	$flag = 0;
	if(strtolower($_SERVER['REQUEST_METHOD']) == 'post' && $_POST['btnRegister'] == "Sign up" )
	{
		//$title = $_POST["title"];
		$fname = $_POST["fname"];
		$lname = $_POST["lname"];
		$email = $_POST["email"];
		$cemail = $_POST["confemail"];
		$phno = $_POST["phno"];
		$password = $_POST["password"];
		$cpassword = $_POST["cpassword"];

		$add1 = $_POST["add1"];
		$add2 = $_POST["add2"];
		//$country = $_POST["country"];
		$city = $_POST["city"];
		$postcode = $_POST["postcode"];

		$dobday = $_POST["day"];
		$dobmonth = $_POST["month"];
		$dobyear = $_POST["year"];

		$dob = $dobyear."-".$dobmonth."-".$dobday;

		$terms = $_POST['terms'];

		if($fname == '')
		{
			$msg = 'Please enter first name';
			$flag = 1;
		}

		if($flag == 0)
		{
			if($lname == '')
			{
				$msg = 'Please enter last name';
				$flag = 1;
			}
		}

		if($flag == 0)
		{
			if($email == '')
			{
				$msg = 'Please enter email';
				$flag = 1;
			}
		}

		if($flag == 0)
		{
			if($cemail == '' || $cemail != $email)
			{
				$msg = 'Email id does not match';
				$flag = 1;
			}
		}

		/*if($flag == 0)
		{
			if($phno == '')
			{
				$msg = 'Please enter Phone no.';
				$flag = 1;
			}
		}*/

		if($flag == 0)
		{
			if($password == '')
			{
				$msg = 'Please enter password';
				$flag = 1;
			}
		}
		if($flag == 0)
		{
			if($cpassword == '' || $cpassword != $password)
			{
				$msg = 'Password and confirm password does not match';
				$flag = 1;
			}
		}

		//first_name,last_name,email,phone_no,password,company_name,website,address1,address2,country,city,zip,business_cat,deal_city,details,date_added
		if($flag == 0)
		{
			$password = base64_encode($password);
			$date = date('Y-m-d');

			/*$sql_insert = "INSERT INTO ".TABLE_USERS.
						  "(first_name,last_name,email,phone_no,password,company_name,website,address1,address2,country,city,zip,business_cat,deal_city,details,date_added)
						  VALUES('".$fname."','".$lname."','".$email."','".$phno."','".$password."','".$bname."','".$bsite."','".$add1."','".$add2."','".$country."','".$city."','".$postcode."','".$bcat."','".$dealcity."','".$about."','".$date."')";
			*/

			$sql_insert = "INSERT INTO ".TABLE_USERS.
						  "(first_name,last_name,email,phone_no,password,dob,address1,address2,zip,city,date_added)
						  VALUES('".$fname."','".$lname."','".$email."','".$phno."','".$password."','".$dob."','".$add1."','".$add2."','".$postcode."','".$city."','".$date."')";

			mysql_query($sql_insert);
			$msg = 'Your account has been successfully created!';
			$flag = 2;

		}

	}

?>


<?php

if($flag !=0)
{
	if($flag == 1)
	{
		?>
		<div style="width:100%; height:45px; background-color:#fff; padding-top:4px; padding-left:30px;">
		<label style="color:red;"><?php //echo "* ".$msg; ?>Please enter your details into the highlited boxes and you must agree with aour Terms &amp; Conditions.</label>
		</div>
		<?php
	}
	if($flag == 2)
	{
		?>
		<div style="width:100%; height:45px; background-color:#fff;padding-top:4px; padding-left:30px;  text-align: center;">
		<label style="color:#006600;"><?php echo $msg; ?></label>
		</div>
		<?php
	}
}
?>





<!-- Registration form validator starts -->




</div>



<?php

			if (!empty($userInfo)) {

				$sql_chk_fb_user = "SELECT * FROM ".TABLE_USERS." WHERE email = '".$userInfo['email']."'";
				$chk_fb_user_res = mysql_fetch_array(mysql_query($sql_chk_fb_user));
				$count_fb_user = mysql_num_rows($chk_fb_user_res);

				if($count_fb_user > 0)		//  Register & login via fb
				{
					$_SESSION["user_id"] = $chk_fb_user_res['user_id'];
					header('location: '.SITE_URL.'customer-account.php');
				}
			}


	 //  	}
?>

</div>
</div>
<!-- <div class="green_curv20"></div> -->
</div>
</div>
<?php include ('include/sidebar-login.php'); ?>
</div>
<?php include("include/footer.php");?>