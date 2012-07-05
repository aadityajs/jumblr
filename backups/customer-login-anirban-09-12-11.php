<?php
include("include/header.php");
?>
<script language="JavaScript" src="js/gen_validatorv4.js" type="text/javascript" xml:space="preserve"></script>

<div id="container">
<div id="leftcol">
<div class="deal_info">
<div class="green_curv10"></div>
<div class="clear"></div>
<div class="green_curv30">
<div class="today_deal">
<div class="register_box1">
<!-- 


<div class="blue_text">Existing User</div>
<div class="clear"></div>
<div class="black_text">Geelaza allows your business whether its a small, medium or big business to reach new customers and take your business to the next level. we have a great relation with our handpicked merchants and customers as we are doing something that keeps everyone happy. It's that simple.</div>
<div class="clear"></div>
<div class="customer_box">
<div class="customer_left">
<img src="images/1pic.gif" alt="" width="77" class="wrap" height="84"/><p>Growing your business now</p></div>
<div class="customer_left">
<img src="images/2pix.gif" alt="" width="85" class="wrap" height="84"/>
<p>Getting more customers</p></div>
<div class="customer_right">
<img src="images/3pic.gif" alt="" width="120" class="wrap" height="89"/>
<p>Getting more revenues</p></div>
</div>

 -->
<div class="clear"></div>

<?php
	$flag = 0;
	if(strtolower($_SERVER['REQUEST_METHOD']) == 'post' && $_POST['btnLogin'] == "Log in")
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
			$sql_select = "SELECT * FROM ".TABLE_USERS." WHERE email="."'".$lemail."' and password="."'".$lpassword."'";
			$result_select = mysql_query($sql_select);
			$count_select = mysql_num_rows($result_select);
			if($count_select >0)
			{
				$row_select = mysql_fetch_array($result_select);
				$user_id = $row_select["user_id"];
				$_SESSION["user_id"] = $user_id;
				header('Location: '.SITE_URL.'customer-account.php');
			}
			else
			{
				$msg = 'Invalid login';
				$flag = 1;
			}
		}
		
	}


?>



<form name="cust_login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"  onsubmit="javascript: return ValidateLoginForm();" style="background:#fff; margin:0px; padding:0px; border:1px solid #fff;">
<!--<h6 style="margin: -22px 0 6px 0; background:none; z-index: 1000;">Already have an Account?</h6>-->
<!-- Login form starts --> 

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="blue_box" style="width:100%;">
       <tr>
         <td>
        
         <table width="600" border="0" align="center" cellpadding="3" cellspacing="3">
             <tr>
             <td colspan="3"><p style="line-height: 20px; font-size: 20px; font-family: Georgia, 'Times New Roman', Times, serif; color: #363636; margin-bottom:-10px; padding-top: 10px;">Already have an Account?</p>
             	
				<?php

				if($flag == 1)
				{
					?>
					<div style="width:100%; height:auto; background-color:transparent;padding-top:4px; padding-left:0px;">
					<label style="color:red;"><?php //echo "* ".$msg; ?>(-) Email address or password  is incorrect!</label>
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
             <td width="127"><input type="submit" name="btnLogin" value="Log in" class="reset_btn" style="cursor:pointer;" /></td>
             <td width="22"><!--<input type="checkbox" name="checkbox" value="checkbox"/>--></td>
             <td width="451"><!--Login automatically--></td>
           </tr>
           <tr>
             <td colspan="3" class="forgot_password"><a href="<?php echo SITE_URL; ?>forgetpassword.php" style="color: blue; font-size:9px; font-family:Arial, Helvetica, sans-serif; ">Forgot your password?</a> </td>
           </tr>
         </table>
    
         </td>
       </tr>
     </table>
     <!-- Login form ends -->      
</form>
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
		
		/*if($flag == 0)
		{
			if($add1 == '')
			{
				$msg = 'Please enter Address';
				$flag = 1;
			}
		}
		
		if($flag == 0)
		{
			if($postcode == '')
			{
				$msg = 'Please enter your postcode';
				$flag = 1;
			}
		}
		
		if($flag == 0)
		{
			if($city == '')
			{
				$msg = 'Please enter your city';
				$flag = 1;
			}
		}*/
		
		/*if($flag == 0)
		{
			if($terms !== 'terms')
			{
				$msg = 'Please agree with our Terms to use our service.';
				$flag = 1;
			}
		}*/
		
		/*if($flag == 0)
		{
			if($dobday == '')
			{
				$msg = 'Please Enter your Date of Birth';
				$flag = 1;
			}
		}
		
		if($flag == 0)
		{
			if($dobmonth == '')
			{
				$msg = 'Please Enter your Month of Birth';
				$flag = 1;
			}
		}
		
		if($flag == 0)
		{
			if($dobyear == '')
			{
				$msg = 'Please Enter your Year of Birth';
				$flag = 1;
			}
		}*/
		
		
		/*if($flag == 0)
		{
			$sql_select = "SELECT * FROM ".TABLE_USERS." WHERE email="."'".$email."'";
			$result_select = mysql_query($sql_select);
			$count_select = mysql_num_rows($result_select);
			if($count_select >0)
			{
				$msg = 'Email address already exists';
				$flag = 1;
			}
		}*/
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
		
	   	$cookie = get_facebook_cookie('192309027517422', '7f1eb32e301277d025d35b77b06dd863');
	   	if ($cookie) {
		$user = json_decode(file_get_contents('https://graph.facebook.com/me?access_token=' .$cookie['access_token']));
	   //var_dump($user);
	   //echo '<pre>'.print_r($user,true).'</pre>';
	   
	 				/*echo $user->name;
      				echo $user->first_name;
      				echo $user->last_name;
      				echo $user->gender;
      				echo $user->timezone;
      				echo $user->location->name;	
	  				echo $user->email;
	  				echo $user->hometown->name;*/
	   
	   			$city = reset(explode(",", $user->location->name));
	   			$country = end(explode(",", $user->location->name));
	   			$add1 = reset(explode(",", $user->hometown->name));
				$date = date('Y-m-d');
				
	  	 	
			$sql_chk_fb_user = "SELECT * FROM ".TABLE_USERS." WHERE email = '".$user->email."'";
			$chk_fb_user_res = mysql_query($sql_chk_fb_user);
			$count_fb_user = mysql_num_rows($chk_fb_user_res);

			if($count_fb_user <= 0)		//  Register & login via fb
			{
				$sql_insert_fb = "INSERT INTO ".TABLE_USERS.
						  "(first_name,last_name,email,address1,country,city,date_added) VALUES('".$user->first_name."','".$user->last_name."','".$user->email."','".$add1."','".$country."','".$city."','".$date."')";
			
				mysql_query($sql_insert_fb);
				
				$sql_select_fb = "SELECT * FROM ".TABLE_USERS." WHERE email = '".$user->email."'";
				$result_select_fb = mysql_query($sql_select_fb);
				$count_select_fb = mysql_num_rows($result_select_fb);
				
				if($count_select_fb >0) {
					$row_select_fb = mysql_fetch_array($result_select_fb);
					$user_id = $result_select_fb["user_id"];
					$_SESSION["user_id"] = $user_id;
					//header('Location: '.SITE_URL.'customer-account.php');
				}
		
			}		//  Register & login via fb End
			else {
				$sql_select_fb = "SELECT * FROM ".TABLE_USERS." WHERE email = '".$user->email."'";
				$result_select_fb = mysql_query($sql_select_fb);
				$count_select_fb = mysql_num_rows($result_select_fb);
				
				if($count_select_fb >0) {
					$row_select_fb = mysql_fetch_array($result_select_fb);
					$user_id = $result_select_fb["user_id"];
					$_SESSION["user_id"] = $user_id;
					$_SESSION['fbuser'] = TRUE;
					//header('Location: '.SITE_URL.'customer-account.php');
				}
				
			}
	   				
		
			
	   			
		
	   	}
?>
<span class="black_text" style="color:#3A3B3D;"><img src="images/spacer.gif" alt="" width="8" height="1"/>Do you have an account on Facebook? Use it to sign into GeeLaza</span>
<?php if ($cookie) { ?>
<fb:login-button perms="email" autologoutlink="true" onlogin="window.location.reload()"></fb:login-button>
<?php unset($_SESSION['fbuser']); ?> 
<?php } else { ?>
<fb:login-button perms="email" autologoutlink="true">Connect</fb:login-button> 
<?php } ?>
<br/><br/>
</div>
</div>
<div class="green_curv20"></div>
</div>
</div>
<?php include ('include/sidebar-login.php'); ?>
</div>
<?php include("include/footer.php");?>