<?php include("include/header.php");?>
<div id="container">
<div id="leftcol">
<div class="deal_info">
<div class="top_about">
<p>Customer Sign Up</p>
</div>
<div class="clear"></div>
<div class="midbg">
<div class="today_deal">
<div class="blue_text">New User</div>
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
<div class="clear"></div>
<div class="register_box">


<?php
	$flag = 0;
	if(strtolower($_SERVER['REQUEST_METHOD']) == 'post' && $_POST['btnRegister'] == "Let's Do it!" )
	{
		$title = $_POST["title"];
		$fname = $_POST["fname"];
		$lname = $_POST["lname"];
		$email = $_POST["email"];
		$phno = $_POST["phno"];
		$password = $_POST["password"];
		$cpassword = $_POST["cpassword"];
		
		$add1 = $_POST["add1"];
		$add2 = $_POST["add2"];
		$country = $_POST["country"];
		$city = $_POST["city"];
		
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
			if($phno == '')
			{
				$msg = 'Please enter Phone no.';
				$flag = 1;
			}
		}

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
		
		if($flag == 0)
		{
			if($add1 == '')
			{
				$msg = 'Please enter Address';
				$flag = 1;
			}
		}
		
		if($flag == 0)
		{
			if($country == '')
			{
				$msg = 'Please enter your country';
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
		}
		
		if($flag == 0)
		{
			if($terms !== 'terms')
			{
				$msg = 'Please agree with our Terms to use our service.';
				$flag = 1;
			}
		}
		
		if($flag == 0)
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
		}
		
		
		if($flag == 0)
		{
			$sql_select = "SELECT * FROM ".TABLE_USERS." WHERE email="."'".$email."'";
			$result_select = mysql_query($sql_select);
			$count_select = mysql_num_rows($result_select);
			if($count_select >0)
			{
				$msg = 'Email address already exists';
				$flag = 1;
			}
		}
		//first_name,last_name,email,phone_no,password,company_name,website,address1,address2,country,city,zip,business_cat,deal_city,details,date_added
		if($flag == 0)
		{
			$password = md5($password);
			$date = date('Y-m-d');
			
			/*$sql_insert = "INSERT INTO ".TABLE_USERS.
						  "(first_name,last_name,email,phone_no,password,company_name,website,address1,address2,country,city,zip,business_cat,deal_city,details,date_added)
						  VALUES('".$fname."','".$lname."','".$email."','".$phno."','".$password."','".$bname."','".$bsite."','".$add1."','".$add2."','".$country."','".$city."','".$postcode."','".$bcat."','".$dealcity."','".$about."','".$date."')";
			*/
			
			$sql_insert = "INSERT INTO ".TABLE_USERS.
						  "(title,first_name,last_name,email,phone_no,password,dob,address1,address2,country,city,date_added)
						  VALUES('".$title."','".$fname."','".$lname."','".$email."','".$phno."','".$password."','".$dob."','".$add1."','".$add2."','".$country."','".$city."','".$date."')";
			
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
		<div style="width:345px; height:45px; background-color:transparent;padding-top:4px; padding-left:30px;">
		<label style="color:#CC0000;"><?php //echo "* ".$msg; ?> Please enter your details into the highlited boxes and you must agree with aour Terms &amp; Conditions.</label>
		
		</div>
		<?php
	}
	if($flag == 2)
	{
		?>
		<div style="width:345px; height:45px; background-color:transparent;padding-top:4px; padding-left:30px;">
		<label style="color:#006600;"><?php echo $msg; ?></label>
		</div>
		<?php
	}
}
?>

  <form name="cust_register" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  
  
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
    <td width="61%"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="login_bg">
	<tr>
    <td><img src="images/spacer.gif" alt="" width="1" height="6"/></td>
    </tr>    
    <tr>
    <td class="text_orange">Address  <span><img src="images/spacer.gif" alt="" width="210" height="1" /></span><span>required field <span class="red">(*)</span></span></td>
    </tr>
    <tr>
      <td>Title <span class="red">*</span></td>
    </tr>
    <tr>
  <td><select name="title" class="selectbg">
  				  <option value="">Please choose</option>
                  <option value="Mr.">Mr.</option>
                  <option value="Mrs.">Mrs.</option>
                  <option value="Ms.">Ms.</option>
                  <option value="Miss">Miss</option>
                  
                  
                  </select></td>
    </tr>
    <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>First Name <span class="red">*</span></td>
        <td>Last Name <span class="red">*</span></td>
      </tr>
      <tr>
        <td width="45%"><input type="text" name="fname" id="fname" value="<?php if(isset($_POST) && $flag ==1){ echo $_POST["fname"];} ?>" class="text_box17" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/></td>
        <td width="55%"><input type="text" name="lname" id="lname" value="<?php if(isset($_POST) && $flag ==1){ echo $_POST["lname"];} ?>" class="text_box17" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/></td>
      </tr>
      <tr>
        <td colspan="2">Street Address <span class="red">*</span></td>
      </tr>
      <tr>
        <td colspan="2"><input type="text" name="add1" id="add1" value="<?php if(isset($_POST) && $flag==1){ echo $_POST["add1"];} ?>" class="text_box18" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/></td>
      </tr>      
    </table></td>
    </tr>
    <tr>
    <td>Street Address 2 <span class="red"></span> </td>
    </tr>
    <tr>
      <td><input type="text" name="add2" id="add2" value="<?php if(isset($_POST) && $flag==1){ echo $_POST["add2"];} ?>" class="text_box18"/></td>
    </tr>
    <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="45%">Town/City <span class="red">*</span></td>
        <td width="55%">Country <span class="red">*</span></td>
      </tr>
      <tr>
        <td><input type="text" name="city" id="city" value="<?php if(isset($_POST) && $flag==1){ echo $_POST["city"];} ?>" class="text_box17" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/></td>
        <td><input type="text" name="country" id="country" value="<?php if(isset($_POST) && $flag==1){ echo $_POST["country"];} ?>" class="text_box17" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/></td>
      </tr>
    </table></td>
    </tr>
    <tr>
      <td>Email Address <span class="red">*</span></td>
    </tr>
    <tr>
      <td><input type="text" name="email" id="email" value="<?php if(isset($_POST) && $flag==1){ echo $_POST["email"];} ?>" class="text_box18" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/></td>
    </tr>
    <tr>
      <td>Phone Number <span class="red">*</span></td>
    </tr>
    <tr>
      <td><input type="text" name="phno" id="phno" value="<?php if(isset($_POST) && $flag==1){ echo $_POST["phno"];} ?>" class="text_box18" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/></td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td colspan="3">Date of Birth </td>
        </tr>
        <tr>
          <td width="24%">
          		<select name="day" id="day" class="selectbg" title="">
			        <option value="">Day</option>
			        <?php
			       for($d=1; $d <= 31; $d++)
			       {
			        $selected = ($date[2] == $d)? "selected" : "";
			        echo '<option value="'.$d.'" '.$selected.'>'.$d.'</option>';
			       }
			        ?>
                </select></td>
          <td width="25%"><select name="month" id="month" class="selectbg">
			        <option value="" selected="selected">Month</option>
			        <? for($m=1;$m<=12;$m++){
			        $xx='2001-'.$m.'-01';
			        $selected = ($date[1] == $m)? "selected" : "";
			         ?>
			        <option value="<?='0'.$m?>" <?=$selected?>><?=date('F',strtotime($xx))?></option>
			        <? } ?>
                  </select></td>
          <td width="51%">
          			<select name="year" id="year" class="selectbg">
				       <option value="">Year</option>
				         <?php
				        for($y = date("Y")-50; $y <= date("Y"); $y++)
				        {
				         $selected = ($date[0] == $y)? "selected" : "";
				         echo '<option value="'.$y.'" '.$selected.'>'.$y.'</option>';
				        }
				         ?>
                  	</select><!--<a href="#" title="GetDeals recomends all users to provide their real date of birth to encourage authenticity and enable us t provide you amazing deals everyday." id="dob"> <img src="images/question.png" align="top" vspace="4"> </a>--></td>
        </tr>
        
<script type="text/javascript">
	$(document).ready(function(){
	
	$("a#dob").append("<em></em>");
	
	$("a#dob").hover(function() {
	$(this).find("em").animate({opacity: "show", top: "-75"}, "slow");
	var hoverText = $(this).attr("title");
	    $(this).find("em").text(hoverText);
	}, function() {
	$(this).find("em").animate({opacity: "hide", top: "-85"}, "fast");
	});
	
	
	});
</script>
       
      </table></td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="45%">Password <span class="red">*</span></td>
          <td width="55%">Confirm password <span class="red">*</span></td>
        </tr>
        <tr>
          <td><input type="password" name="password" id="password" class="text_box17" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/></td>
          <td><input type="password" name="cpassword" id="cpassword" class="text_box17" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </table></td>
        <td width="39%" align="left" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="2">
          <tr>
            <td width="11%" align="center" valign="top"><input type="checkbox" name="checkbox2" value="checkbox"/></td>
            <td width="89%" align="left" valign="top">If you don't want to miss our amazing deals then subscribe today by ticking this box and you 
              will receive emails which contains our latest deals near you. You can unsubscribe at any time 
by clicking on the link at the bottom of the email newsletter.</td>
          </tr>
          <tr>
            <td align="left" valign="top" style="border-top: 1px solid #CCCCCC;"><input type="checkbox" name="terms" value="terms"/></td>
            <td align="left" valign="top" style="border-top: 1px solid #CCCCCC;">I confirm that I am atlest the age of 18 years old and I have read and agree to the<br/> <a href="#">Terms &amp; Conditions.</a></td>
          </tr>
          <tr>
            <td align="center" valign="top" style="color:#FF0000;">*<br/>
              <br/>*<br/><br/><br/>*<br/><br/><br/>*<br/>
                <br/></td>
            <td align="left" valign="top">Your Privacy is assured<br/><br/>
              Shop with confidence using GeeLaza<br/><br/>
              Get amazing deals at discounted price<br/><br/>
              get the most of your life and enojoy</td>
          </tr>
          <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top"><input type="submit" name="btnRegister" value="Let's Do it!" class="reset_btn"  style="cursor:pointer;"/></td>
          </tr>
          <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
   <tr>
     <td colspan="2">
   
    </td>
     </tr>
    </table>
  
  
  </form>
   


<?php
	$flag = 0;
	if(strtolower($_SERVER['REQUEST_METHOD']) == 'post' && $_POST['btnLogin'] == "Login")
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
			$lpassword = md5($lpassword);
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
   
<?php

if($flag == 1)
{
	?>
	<div style="width:345px; height:45px; background-color:transparent;padding-top:4px; padding-left:30px;">
	<label style="color:#CC0000;"><?php //echo "* ".$msg; ?>Please enter your details into the highlited boxes and you must agree with aour Terms &amp; Conditions.</label>
	</div>
	<?php
}
?>   
    <form name="cust_login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

<!-- Login form starts --> 
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="blue_box">
       <tr>
         <td>
        
         <table width="600" border="0" align="center" cellpadding="3" cellspacing="3">
             <tr>
             <td colspan="3"><p>Already have an Account?</p></td>
           </tr>
           <tr>
             <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
               <tr>
                 <td width="51%">Email Address</td>
                 <td width="49%">Password</td>
               </tr>
               <tr>
                 <td><input type="text" name="lemail" id="lemail" value="<?php if(isset($_POST) && $flag==1){ echo $_POST["email"];} ?>"class="text_box1" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/></td>
                 <td><input type="password" name="lpassword" id="lpassword" class="text_box1" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/></td>
               </tr>
             </table></td>
           </tr>
           <tr>
             <td width="127"><input type="submit" name="btnLogin" value="Login" class="reset_btn" style="cursor:pointer;" /></td>
             <td width="22"><input type="checkbox" name="checkbox" value="checkbox"/></td>
             <td width="451">Login automatically</td>
           </tr>
           <tr>
             <td colspan="3"><a href="#">Forgot password</a> </td>
           </tr>
         </table>
    
         </td>
       </tr>
     </table>
     <!-- Login form ends -->      
</form>
         

    
  
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
<span class="black_text">Have facebook account? Use it to sing to GetLaza!</span>
<?php if ($cookie) { ?>
<fb:login-button perms="email" autologoutlink="true" onlogin="window.location.reload()"></fb:login-button>
<?php unset($_SESSION['fbuser']); ?> 
<?php } else { ?>
<fb:login-button perms="email" autologoutlink="true">Login with facebook</fb:login-button> 
<?php } ?>
<br/><br/>
</div>
</div>
</div>
</div>

<?php include ('include/sidebar.php'); ?>
</div>

<?php include("include/footer.php");?>