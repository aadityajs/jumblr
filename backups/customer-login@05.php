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



<form name="cust_login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"  style="background:#fff; margin:0px; padding:0px; border:1px solid #fff;">

<!-- Login form starts --> 
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="blue_box" style="width:100%;">
       <tr>
         <td>
        
         <table width="600" border="0" align="center" cellpadding="3" cellspacing="3">
             <tr>
             <td colspan="3"><h6>Already have an Account?</h6>
             	<?php

				if($flag == 1)
				{
					?>
					<div style="width:100%; height:auto; background-color:transparent;padding-top:4px; padding-left:0px;">
					<label style="color:#CC0000;"><?php //echo "* ".$msg; ?>The email address and password that you entered is incorrect. Please try again.</label>
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
                 <input type="text" name="lemail" id="lemail" value="<?php if(isset($_POST) && $flag==1){ echo $_POST["lemail"];} ?>"class="text_box1" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/></td>
                 <td>
                 <div id='cust_login_lpassword_errorloc' class="error"></div>
                 <input type="password" name="lpassword" id="lpassword" class="text_box1" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/></td>
               </tr>
             </table></td>
           </tr>
           <tr>
             <td width="127"><input type="submit" name="btnLogin" value="Login" class="reset_btn" style="cursor:pointer;" /></td>
             <td width="22"><!--<input type="checkbox" name="checkbox" value="checkbox"/>--></td>
             <td width="451"><!--Login automatically--></td>
           </tr>
           <tr>
             <td colspan="3" class="forgot_password"><a href="<?php echo SITE_URL; ?>forgetpassword.php" style="color: blue; font-size:8.5px; font:Times new roman; ">Forgot password</a> </td>
           </tr>
         </table>
    
         </td>
       </tr>
     </table>
     <!-- Login form ends -->      
</form>
<!-- Login form validator starts --> 

<script language="JavaScript" type="text/javascript"
    xml:space="preserve">//<![CDATA[
//You should create the validator only after the definition of the HTML form
  var frmvalidator  = new Validator("cust_login");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();

    frmvalidator.addValidation("lemail","maxlen=50");
    frmvalidator.addValidation("lemail","req","Enter your email address");
    //frmvalidator.addValidation("lemail","email");

    frmvalidator.addValidation("lpassword","req","Enter your password");
    //frmvalidator.addValidation("lpassword","minlen=6","Password must be at least 6 charecters");

//]]></script>


  <!-- Login form validator ends --> 





<?php
	$flag = 0;
	if(strtolower($_SERVER['REQUEST_METHOD']) == 'post' && $_POST['btnRegister'] == "Let's Do it!" )
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
		}
		
		/*if($flag == 0)
		{
			if($terms !== 'terms')
			{
				$msg = 'Please agree with our Terms to use our service.';
				$flag = 1;
			}
		}*/
		
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
		<div style="width:345px; height:25px; background-color:transparent;padding-top:4px; padding-left:30px;">
		<label style="color:#006600;"><?php echo $msg; ?></label>
		</div>
		<?php
	}
}
?>


<h6 style="margin:0; background:#fff; padding:0px;" >New User Registration</h6>

 <form name="cust_register" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"  style="background:#fff; margin:0px; padding:0px; border:1px solid #fff;">
<div  style="border:1px #CCCCCC solid; background:#fff;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
    <td width="61%">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="login_bg2">
       <tr>
         <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="login_bg">
            <tr>
            <td><img src="images/spacer.gif" alt="" width="1" height="6"/></td>
            </tr>    
            <tr>
            <td class="text_black"><span><img src="images/spacer.gif" alt="" width="210" height="1" /></span><!-- <span>Required field <span class="red">(*)</span></span> --></td>
            </tr>
         
           <!-- <tr>
              <td>Title <span class="red">*</span></td>
            </tr>
            <tr>
          <td><select name="title" class="selectbg">
                          <option value="">Please choose</option>
                          <option value="Mr.">Mr.</option>
                          <option value="Mrs.">Mrs.</option>
                          <option value="Miss">Miss</option>
                          <option value="Dr.">Dr.</option>
                          
                          </select></td>
            </tr>
            <tr>-->
            
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>First Name <span class="red">*</span></td>
              </tr>
              <tr>
                <td width="45%">
                <div id='cust_register_fname_errorloc' class="error"></div>
                <input type="text" name="fname" id="fname" value="<?php if(isset($_POST) && $flag ==1){ echo $_POST["fname"];} ?>" class="text_box12" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/></td>
              </tr>
              <tr><td>&nbsp;</td></tr>
              <tr>
                <td>Last Name <span class="red">*</span></td>
              </tr>
              <tr>
                <td width="55%">
                <div id='cust_register_lname_errorloc' class="error"></div>
                <input type="text" name="lname" id="lname" value="<?php if(isset($_POST) && $flag ==1){ echo $_POST["lname"];} ?>" class="text_box12" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/></td>
              </tr>
               <tr><td>&nbsp;</td></tr>
              <tr>
                <td colspan="2">Address Line 1 <span class="red">*</span></td>
              </tr>
              <tr>
                <td colspan="2">
                <div id='cust_register_add1_errorloc' class="error"></div>
                <input type="text" name="add1" id="add1" value="<?php if(isset($_POST) && $flag==1){ echo $_POST["add1"];} ?>" class="text_box12" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/></td>
              </tr>  
               <tr><td>&nbsp;</td></tr>    
            </table></td>
            </tr>
            <tr>
            <td>Address Line 2 <span class="red"></span> </td>
            </tr>
            <tr>
              <td><input type="text" name="add2" id="add2" value="<?php if(isset($_POST) && $flag==1){ echo $_POST["add2"];} ?>" class="text_box12"/></td>
            </tr>
             <tr><td>&nbsp;</td></tr>
            <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="45%">Town/City <span class="red">*</span></td>
                <td width="55%">Postcode<span class="red">*</span></td>
              </tr>
              <tr>
                <td>
                <div id='cust_register_city_errorloc' class="error"></div>
                <input type="text" name="city" id="city" style="width: 200px; margin-right: 10px; <?php if ($flag ==1) {echo 'border:1px solid red;';} ?>" value="<?php if(isset($_POST) && $flag==1){ echo $_POST["city"];} ?>" class="text_box11" /></td>
                
                <td>
                <div id='cust_register_postcode_errorloc' class="error"></div>
                <input type="text" name="postcode" id="postcode" style="width: 100px; <?php if ($flag ==1) {echo 'border:1px solid red;';} ?>" value="<?php if(isset($_POST) && $flag==1){ echo $_POST["postcode"];} ?>" class="text_box11"/></td>
              </tr>
            </table></td>
            </tr>
            <tr><td>&nbsp;</td></tr>
            <tr>
              <td>Email Address <span class="red">*</span></td>
            </tr>
            <tr>
              <td>
              <div id='cust_register_email_errorloc' class="error"></div>
              <input type="text" name="email" id="email" value="<?php if(isset($_POST) && $flag==1){ echo $_POST["email"];} ?>" class="text_box12" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/></td>
            </tr>
            <tr><td>&nbsp;</td></tr>
            <tr>
              <td>Confirm Email Address <span class="red">*</span></td>
            </tr>
            <tr>
              <td>
              <div id='cust_register_confemail_errorloc' class="error"></div>
              <input type="text" name="confemail" id="confemail" value="<?php if(isset($_POST) && $flag==1){ echo $_POST["confemail"];} ?>" class="text_box12" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/></td>
            </tr>
            <tr><td>&nbsp;</td></tr>
            <tr>
              <td>Phone Number <span class="red">*</span></td>
            </tr>
            <tr>
              <td><input type="text" name="phno" id="phno" value="<?php if(isset($_POST) && $flag==1){ echo $_POST["phno"];} ?>" class="text_box12" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/></td>
            </tr>
            <tr><td>&nbsp;</td></tr>
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td colspan="3">Date of Birth <a href="javascript: showDetails(10)" onMouseOver="return overlib('&lt;font class=bodytext&gt;GeeLaza recomends all users to provide their real <br>date of birth to encourage authenticity and enable us <br>to provide you amazing deals everyday.&lt;/font&gt;',VAUTO,CAPTION,'&lt;font class=help&gt;<span align=center>Why should i provide my birthday? </span> &lt;/font&gt;',BORDER,'1');" onMouseOut="nd();"><img src="images/question.png" align="default" vspace="4" ></a></td>
                </tr>
                <tr>
                  <td width="24%">
                        <select name="day" id="day" class="selectbg">
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
                            </select></td>
                </tr>
              </table></td>
            </tr>
            <tr><td>&nbsp;</td></tr>
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="45%">Password <span class="red">*</span></td>
                </tr>
                <tr>
                  <td>
                  <div id='cust_register_password_errorloc' class="error"></div>
                  <input type="password" name="password" id="password" class="text_box12" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/></td>
                </tr>
                <tr><td>&nbsp;</td></tr>
                <tr>
                  <td width="55%">Confirm password <span class="red">*</span></td>
                </tr>
                <tr>
                  <td>
                  <div id='cust_register_cpassword_errorloc' class="error"></div>
                  <input type="password" name="cpassword" id="cpassword" class="text_box12" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/></td>
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
              <td style="font-weight:normal;">By registering you agree to the  <a href="#">Terms and Conditions</a></span> and  <a href="#">Privacy Policy</a></td>
            </tr>
          </table>
   </td>
       </tr>
     </table>
  </td>
        <td width="39%" align="left" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="2">         
    
          <tr>
            <!--<td align="center" valign="top" style="color:#50b6d0; font: bold 18px/18px Arial, Helvetica, sans-serif;">*<br/>
              <br/>*<br/><br/>*<br/><br/>*<br/>
                <br/></td>
            <td align="left" valign="top" style="font: 14px/17px Calibri; color: #000;">Your Privacy is assured<br/><br/>
              Shop with confidence using GeeLaza<br/><br/>
              Get amazing deals at discounted price<br/><br/>
              get the most of your life and enojoy</td>-->
			  
		<td colspan="2" align="center" valign="middle" style="color:#000; font: bold 14px/18px Calibri, Arial, Helvetica, sans-serif;">&nbsp;</td>
      </tr>  
          <tr>
            <td width="16%" align="center" valign="middle"><img src="images/green_thick.gif" alt="" width="23" height="18" /></td>
            <td width="84%" align="left" valign="middle" style="color:#000; font: bold 14px/28px Calibri, Arial, Helvetica, sans-serif;">Your Privacy is assured</td>
          </tr>
          <tr>
            <td align="center" valign="middle"><img src="images/green_thick.gif" alt="" width="23" height="18" /></td>
            <td align="left" valign="middle" style="color:#000; font: bold 14px/28px Calibri, Arial, Helvetica, sans-serif;">Shop with confidence online</td>
          </tr>
          <tr>
            <td align="center" valign="middle"><img src="images/green_thick.gif" alt="" width="23" height="18" /></td>
            <td align="left" valign="middle" style="color:#000; font: bold 14px/28px Calibri, Arial, Helvetica, sans-serif;">Get amazing deals today</td>
          </tr>
          <tr>
            <td align="center" valign="middle"><img src="images/green_thick.gif" alt="" width="23" height="18" /></td>
            <td align="left" valign="middle" style="color:#000; font: bold 14px/28px Calibri, Arial, Helvetica, sans-serif;">Explorer the new side of life</td>
          </tr>  
           
          <tr>
            <td align="center" valign="top" style="color:#50b6d0;">
             <!-- <input type="checkbox" name="terms" value="terms"/>-->
            </span></td>
            <td align="left" valign="top" style="font: bold 12px/17px Arial, Helvetica, sans-serif; color: #666666;"><!--I confirm that I am atlest the age of 18 years old and I have read and agree to the
                <a href="#">Terms &amp; Conditions.</a></span>--></td>
          </tr>          
          <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top"><input type="submit" name="btnRegister" value="Let's Do it!" class="reset_btn2"  style="cursor:pointer;"/></td>
          </tr>
          <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
   
    </table>
</div>
</form>
<!-- Registration form validator starts --> 


<script language="JavaScript" type="text/javascript"
    xml:space="preserve">//<![CDATA[
//You should create the validator only after the definition of the HTML form
  var frmvalidator  = new Validator("cust_register");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();

    frmvalidator.addValidation("fname","req","Enter your first name");
    frmvalidator.addValidation("fname","maxlen=20",	"Max length for first name is 20");

    frmvalidator.addValidation("lname","req","Enter your last name");

    frmvalidator.addValidation("add1","req","Enter your address");
    frmvalidator.addValidation("city","req","Enter your city");
    frmvalidator.addValidation("postcode","req","Enter your postcode");

    frmvalidator.addValidation("email","maxlen=50");
    frmvalidator.addValidation("email","req","Enter your email address");
    frmvalidator.addValidation("email","email");

  	//frmvalidator.addValidation("confemail","req","Confirm your email address");
    frmvalidator.addValidation("confemail","eqelmnt=email","Confirm your email address");

    frmvalidator.addValidation("password","req","Enter your password");
    frmvalidator.addValidation("password","minlen=6","Password must be at least 6 charecters");

    //frmvalidator.addValidation("cpassword","req");
    frmvalidator.addValidation("cpassword","eqelmnt=password","Password must be confirmed");
       
//]]></script>

  <!-- Registration form validator ends --> 


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
<span class="black_text" style="color:#3A3B3D;">Do you have an account on Facebook? Use it to sign into GeeLaza</span>
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