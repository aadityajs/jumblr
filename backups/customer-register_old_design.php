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
	if(strtolower($_SERVER['REQUEST_METHOD']) == 'post')
	{
		
		$fname = $_POST["fname"];
		$lname = $_POST["lname"];
		$email = $_POST["email"];
		$phno = $_POST["phno"];
		$password = $_POST["password"];
		$cpassword = $_POST["cpassword"];
		
		// Business Details
		$bname = $_POST["bname"];
		$bsite = $_POST["bsite"];
		$add1 = $_POST["add1"];
		$add2 = $_POST["add2"];
		$country = $_POST["country"];
		$city = $_POST["city"];
		$postcode = $_POST["postcode"];
		$bcat = $_POST["bcat"];
		$dealcity = $_POST["dealcity"];
		$about = $_POST["about"];
		
		
		
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
			if($bname == '')
			{
				$msg = 'Please enter Business Name';
				$flag = 1;
			}
		}
		
		if($flag == 0)
		{
			if($bsite == '')
			{
				$msg = 'Please enter Business Website';
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
			if($postcode == '')
			{
				$msg = 'Please enter your ZIP Code';
				$flag = 1;
			}
		}
		
		if($flag == 0)
		{
			if($bcat == '')
			{
				$msg = 'Please enter your Business Category';
				$flag = 1;
			}
		}
		
		if($flag == 0)
		{
			if($dealcity == '')
			{
				$msg = 'Please enter your Deal City';
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
			//$sql_insert = "INSERT INTO ".TABLE_USERS."(first_name,last_name,email,password,date_added) VALUES("."'".$fname."',"."'".$lname."',"."'".$email."',"."'".$password."',"."'".$date."'".")";
			
			$sql_insert = "INSERT INTO ".TABLE_USERS.
						  "(first_name,last_name,email,phone_no,password,company_name,website,address1,address2,country,city,zip,business_cat,deal_city,details,date_added)
						  VALUES('".$fname."','".$lname."','".$email."','".$phno."','".$password."','".$bname."','".$bsite."','".$add1."','".$add2."','".$country."','".$city."','".$postcode."','".$bcat."','".$dealcity."','".$about."','".$date."')";
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
		<div style="width:345px; height:25px; background-color:transparent;padding-top:4px; padding-left:30px;">
		<label style="color:#CC0000;"><?php echo "* ".$msg; ?></label>
		</div>
		<?php
	}
	if($flag == 2)
	{
		?>
		<div style="width:345px; height:25px; background-color:transparent;padding-top:4px; padding-left:30px;">
		<label style="color:#006600;"><?php echo $msg; ?></label>
		</div>
		<?php
	}
}
?>

  <form name="cust_register" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="registered_bg">
    <tr>
    <td><h6>Get Featured</h6></td>
    </tr>
    <tr>
    <td class="text_orange">Contact details <span>( required field <span class="red">*</span>)</span></td>
    </tr>
    <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="2">Full name <span class="red">*</span></td>
      </tr>
      <tr>
        <td width="32%"><input type="text" name="fname" id="fname" value="<?php if(isset($_POST) && $flag ==1){ echo $_POST["fname"];} ?>" class="text_box"/></td>
        <td width="68%"><input type="text" name="lname" id="lname" value="<?php if(isset($_POST) && $flag ==1){ echo $_POST["lname"];} ?>" class="text_box"/></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="50%">Email address <span class="red">*</span></td>
            <td width="50%">Phone number <span class="red">*</span></td>
          </tr>
          <tr>
            <td><input type="text" name="email" id="email" value="<?php if(isset($_POST) && $flag==1){ echo $_POST["email"];} ?>" class="text_box1"/></td>
            <td><input type="text" name="phno" id="phno" value="<?php if(isset($_POST) && $flag==1){ echo $_POST["phno"];} ?>" class="text_box1"/></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>Password<span class="red">*</span></td>
            <td>Confirm Password<span class="red">*</span></td>
            </tr>
          <tr>
            <td><input type="password" name="password" id="password" class="text_box1"/></td>
            <td><input type="password" name="cpassword" id="cpassword" class="text_box1"/></td>
          </tr>
        </table></td>
      </tr>
      
    </table></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    </tr>
    <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="text_orange">Business details</td>
        <td>&nbsp;</td>
      </tr>      
      <tr>
        <td>Business name <span class="red">*</span></td>
        <td>Business website <span class="red">*</span></td>
      </tr>
      <tr>
        <td><input type="text" name="bname" id="bname" value="<?php if(isset($_POST) && $flag==1){ echo $_POST["bname"];} ?>" class="text_box1"/></td>
        <td><input type="text" name="bsite" id="bsite" value="<?php if(isset($_POST) && $flag==1){ echo $_POST["bsite"];} ?>" class="text_box1"/></td>
      </tr>
      <tr>
        <td>address line1 <span class="red">*</span></td>
        <td>address line2 </td>
      </tr>
      <tr>
        <td><input type="text" name="add1" id="add1" value="<?php if(isset($_POST) && $flag==1){ echo $_POST["add1"];} ?>" class="text_box1"/></td>
        <td><input type="text" name="1dd2" id="add2" value="<?php if(isset($_POST) && $flag==1){ echo $_POST["add2"];} ?>" class="text_box1"/></td>
      </tr>
      <tr>
        <td>County <span class="red">*</span></td>
        <td>City <span class="red">*</span></td>
      </tr>
      <tr>
        <td><input type="text" name="country" id="country" value="<?php if(isset($_POST) && $flag==1){ echo $_POST["country"];} ?>" class="text_box1"/></td>
        <td><input type="text" name="city" id="city" value="<?php if(isset($_POST) && $flag==1){ echo $_POST["city"];} ?>" class="text_box1"/></td>
      </tr>
      <tr>
        
        <td colspan="2">Post code <span class="red">*</span></td>
      </tr>
      <tr>
        <td><input type="text" name="postcode" id="postcode" value="<?php if(isset($_POST) && $flag==1){ echo $_POST["postcode"];} ?>" class="text_box1"/></td>
        <td></td>
      </tr>
      <tr>
        <td>Select your business category <span class="red">*</span></td>
        <td>Select the city you want your deal to run at <span class="red">*</span></td>
      </tr>
      <tr>
        <td><input type="text" name="bcat" id="bcat" value="<?php if(isset($_POST) && $flag==1){ echo $_POST["bcat"];} ?>" class="text_box1"/></td>
        <td><input type="text" name="dealcity" id="dealcity" value="<?php if(isset($_POST) && $flag==1){ echo $_POST["dealcity"];} ?>" class="text_box1"/></td>
      </tr>
    </table></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>tell us a little bit about your business and why GetDeala should partner with you. <span class="red">*</span></td>
        </tr>
        <tr>
          <td><textarea class="textarea1" name="about" id="about"><?php if(isset($_POST) && $flag==1){ echo $_POST["about"];} ?></textarea></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td><table width="266" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="133"><input type="submit" name="btnRegister" value="Submit" class="reset_btn"  style="cursor:pointer;"/></td>
          <td width="133"><input type="reset" name="Submit" class="reset_btn" value="Reset"  style="cursor:pointer;"/></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
    </tr>
  </table>
  </form>
  
</div>
</div>
</div>
</div>
</div>

<?php include ('include/sidebar.php'); ?>
</div>

<?php include("include/footer.php");?>