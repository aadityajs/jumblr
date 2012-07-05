<?php 
error_reporting(E_ERROR && E_STRICT);
include("include/header.php");
session_start();
ob_start();
?>

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
<?php 

if ($_GET['item'] != "")  {
	$prod_id = $_GET['item'];
	
	$sql_prod = "SELECT * FROM ".TABLE_DEALS." WHERE status >= 1 AND deal_id = '".$prod_id."' LIMIT 0, 1";
	$prod_res = mysql_fetch_array(mysql_query($sql_prod));
	
	
	/*$sql_todays_buy = "SELECT SUM(qty) FROM ".TABLE_TRANSACTION." WHERE deal_id = ".$today_res['deal_id'];
	$total_buy = mysql_fetch_array(mysql_query($sql_todays_buy));
	
	$sql_todays_image = "SELECT * FROM ".TABLE_DEAL_IMAGES." WHERE deal_id = ".$today_res['deal_id'];
	$todays_image = mysql_fetch_array(mysql_query($sql_todays_image));*/
}

?>

<!-- Login code starts -->
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
<!-- Login code ends -->


<div class="accounts">
<div class="accounts_top"></div>
<div class="accounts_mid">
		<p style="padding:0; margin: 7px  0 0 10px; font-family: Arial Rounded MT Bold; color: #ff7f22; font-size:30px;">Your Order </p>
   <div class="white-container1" style="width:97%; margin: 10px auto 0 auto; background:#fff;">	
			<div>
              <!-- <div class="start_savings"></div>-->
            	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="cart_box2">
                  <tr>
                    <td colspan="4" style="font: bold 15px/26px Arial, Helvetica, sans-serif; color:#000"><strong></strong></td>                   
                  </tr>
                  <tr>
                    <th width="395"><strong>Deal</strong></th>
                    <th width="95"><strong>Quantity</strong></th>
                    <th width="41"><strong></strong></th>
                    <th width="97"><strong>Price</strong></th>
                    <th width="11"><strong></strong></th>
                    <th width="371" align="left"><strong>Total</strong></th>
                  </tr>
                  <tr class="gray_01">
                    <td><?php echo strip_tags($prod_res['title']); ?></td>
                    <td>
                    	<select name="amount" id="" onchange="ajaxReq(this.value);">
						<?php for ($i = 1; $i <= 30; $i++) { ?>
						<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						<?php } ?>
						</select>
                    </td>
                     <td>x</td>
                    <td>&pound; <?php echo strip_tags($prod_res['discounted_price']); ?></td>
                    <td>=</td>
                    <td><div id="total_price">&pound; <?php echo strip_tags($prod_res['discounted_price']); ?></div></td>
                  </tr>
                 
                  <!--<tr>
                    <td colspan="3" style="font: bold 15px/26px Arial, Helvetica, sans-serif; text-align:right;">Total Cost = </td>
                    <td style="font: bold 15px/26px Arial, Helvetica, sans-serif; text-align:right; text-align:left; padding-left:10px;">
                    	<div id="big_total_price">&pound; <?php echo strip_tags($prod_res['discounted_price']); ?></div> 
                    	<?php //echo $_SESSION['total_price']; ?>
                    </td>
                  </tr>-->
                </table>
				<div style="width: 100%; height: auto; margin:0;">
				  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
					 <td style="color:#7fd7fc; font: normal 12px/18px Arial, Helvetica, sans-serif;" width="28%"><a style="color:#3bb8ff; font: normal 12px/18px Arial, Helvetica, sans-serif; text-decoration: none; padding-left:5px;" href="#">Do you want to use your credit?</a></td>
                      <td style="font-family:Arial Rounded MT Bold; font-size: 26px; color: #000; text-align:right;" width="60%">Total Cost = &pound; </td>
                      <td style="font-family:Arial Rounded MT Bold; font-size: 26px; color: #000; text-align:left; padding-left:10px;" width="12%"><div id="big_total_price"><?php echo strip_tags($prod_res['discounted_price']); ?><span></span></div> 
                    	<?php //echo $_SESSION['total_price']; ?></td>
                    </tr>
                  </table>
				</div>
            </div>
			
    </div>
  </div>
		<div class="accounts_bot"><img src="images/spacer.gif" alt="" width="1" height="9"/></div>
</div>

<div class="clear"></div>
<div class="accounts">
<div class="accounts_top"></div>
<div class="accounts_mid">
 <div class="white-container_ani" style="width:100%; margin: 0px auto 0 auto; background:#fff;">	
 
		<div style="width:620px; margin-right:0px; float:left;">
        
        <!-- Login form starts --> 
            <form name="cust_login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"  onsubmit="javascript: return ValidateLoginForm();" style="margin:0px; padding:0px;">
            <!--<h6 style="margin: -22px 0 6px 0; background:none; z-index: 1000;">Already have an Account?</h6>-->
            
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="loginBoxnew2">
              <tr>
                <td class="lb_top2">&nbsp;</td>
              </tr>
              <tr>
                <td class="lb_mid2"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="blue_box" style="width:100%; background: none; border: none;">
                   <tr>
                     <td>
                    
                     <table width="600" border="0" align="center" cellpadding="3" cellspacing="3">
                         <tr>
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
                         <td width="22"><!--<input type="checkbox" name="checkbox" value="checkbox"/>--></td>
                         <td width="451"><!--Login automatically--></td>
                       </tr>
                       <tr>
                         <td style="margin-top: -10px;" colspan="3" class="forgot_password"><a href="<?php echo SITE_URL; ?>forgetpassword.php" style="color: blue; font-size:12px; line-height: 14px; font-family:Arial, Helvetica, sans-serif; font-weight: bold; ">Forgot your password?</a></td>
                       </tr>
                     </table>
                
                     </td>
                   </tr>
                   <tr>
                   <td style="padding: 0 0 0 0px; line-height: 20px; margin: -15px 0 0 0;"><span><?php if ($cookie) { ?>
            <fb:login-button scope="email" autologoutlink="true" onlogin="window.location.reload()"></fb:login-button>
            <?php unset($_SESSION['fbuser']); ?> 
            <?php } else { ?><br />
            <span style="padding-left: 18px;"><fb:login-button scope="email" autologoutlink="true">Connect</fb:login-button></span>
            <?php } ?></span><span class="black_text1" style="color:#3A3B3D; margin-left: -15px;"><img src="images/spacer.gif" alt="" width="8" height="1"/>if you have an account on Facebook you can use it to log in.</span>
            </td>
                   </tr>
                 </table></td>
              </tr>
              <tr>
                <td class="lb_bottom2">&nbsp;</td>
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
               
        <div class="clear"></div>
        </div>
            
           <div class="how_right_ani2">
		   <div style="font: normal 18px/25px Arial, Helvetica, sans-serif; color:#4d4550; text-align:center;">Got questions?</div>
			 <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td style="width: 24px; height:25px; padding-right: 10px"><img src="images/1.png" alt="" width="24" height="25"/></td>
                    <td style="font: normal 12px/40px Arial, Helvetica, sans-serif; text-align:left; color: #777777; border-bottom: solid 1px #cccccc;">What happens after I buy the deal?</td>
                  </tr>
                  <tr>
                    <td style="width: 24px; height:25px; padding-right: 10px"><img src="images/2.png" alt="" width="24" height="25"/></td>
                    <td style="font: normal 12px/40px Arial, Helvetica, sans-serif; text-align:left; color: #777777; border-bottom: solid 1px #cccccc;">When can I use my deal?</td>
                  </tr>
				  <tr>
                    <td style="width: 24px; height:25px; padding-right: 10px"><img src="images/3.png" alt="" width="24" height="25"/></td>
                    <td style="font: normal 12px/40px Arial, Helvetica, sans-serif; text-align:left; color: #777777; border-bottom: solid 1px #cccccc;">When will my voucher expire?</td>
                  </tr>
				  <tr>
                    <td style="width: 24px; height:25px; padding-right: 10px"><img src="images/4.png" alt="" width="24" height="25"/></td>
                    <td style="font: normal 12px/40px Arial, Helvetica, sans-serif; text-align:left; color: #777777; border-bottom: solid 1px #cccccc;">Can I buy a deal as gift?</td>
                  </tr>
				  <tr>
                    <td style="width: 24px; height:25px; padding-right: 10px"><img src="images/5.png" alt="" width="24" height="25"/></td>
                    <td style="font: normal 12px/40px Arial, Helvetica, sans-serif; text-align:left; color: #777777; border-bottom: solid 1px #cccccc;">Can I get refund for my order?</td>
                  </tr>
                </table>
            </div>
    </div>

                <div class="clear"></div>
                <h6 style="margin: 15px 0 15px 15px; background:none; font-size:24px; text-align:left;" >Register Now</h6>
                <div class="register_box2">
                
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td style="vertical-align:top; padding:0px;">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="leftfrom">    
                    <tr>
                    <td style="padding:0px;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                    <td colspan="2"><!--<h6 style="float:left; line-height:0px; padding:16px 0 16px 0;">Address</h6>--><span><img src="images/account_d.png" alt="" width="146" height="21"/></span> <span style="float:right; margin:0 15px 0 0;">( required field <span class="red">*</span>)</span></td>
                    </tr>
					<tr>
                    <td colspan="2"><!--<h6 style="float:left; line-height:0px; padding:16px 0 16px 0;">Address</h6>--><span style="font: normal 11px/14px Arial, Helvetica, sans-serif; color:#666666;">Please enter your account details bellow</span></td>
                    </tr>
                    <tr>
						<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td style="margin:0;" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="login_bg3">
       <tr>
         <td>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="login_bg">  
   <!-- <tr>
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
    </tr>-->
    <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr>
        <td>First Name <span class="red">*</span></td>
      </tr>
      <tr>
        <td width="45%">
        <div id='cust_register_fname_errorloc' class="error"></div>
        <input type="text" name="fname" id="fname" value="<?php if(isset($_POST) && $flag ==1){ echo $_POST["fname"];} ?><?php if ($cookie) {echo $user->first_name;} ?>" class="text_box12" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/>        </td>
      </tr>
      
      <tr>
        <td>Last Name <span class="red">*</span></td>
      </tr>
      <tr>
        <td width="55%">
        <div id='cust_register_lname_errorloc' class="error"></div>
        <input type="text" name="lname" id="lname" value="<?php if(isset($_POST) && $flag ==1){ echo $_POST["lname"];} ?><?php if ($cookie) {echo $user->last_name;} ?>" class="text_box12" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/>        </td>
      </tr>
       <!--
       
      <tr>
        <td colspan="2">Address Line 1<span class="red">*</span></td>
      </tr>
      <tr>
        <td colspan="2">
        <div id='cust_register_add1_errorloc' class="error"></div>
        <input type="text" name="add1" id="add1" value="<?php if(isset($_POST) && $flag==1){ echo $_POST["add1"];} ?>" class="text_box12" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/>
        </td>
      </tr>  
       <tr><td>&nbsp;</td></tr>    
    -->
    
    </table></td>
    </tr>
   
    <!--<tr>
    <td>Address Line 2 <span class="red"></span> </td>
    </tr>
    <tr>
      <td><input type="text" name="add2" id="add2" value="<?php if(isset($_POST) && $flag==1){ echo $_POST["add2"];} ?>" class="text_box12"/></td>
    </tr>
     <tr><td>&nbsp;</td></tr>
    -->
    
    <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      
      <!--<tr>
        <td width="45%">Town/City <span class="red">*</span></td>
        <td width="55%">Postcode <span class="red">*</span></td>
      </tr>
      <tr>
      	<td>
      	<div id='cust_register_city_errorloc' class="error"></div>
      	<input type="text" name="city" id="city" style="width: 200px; margin-right: 10px; <?php if ($flag ==1) {echo 'border:1px solid red;';} ?>" value="<?php if(isset($_POST) && $flag==1){ echo $_POST["city"];} ?>" class="text_box11" />
      	</td>
        
        <td>
        <div id='cust_register_postcode_errorloc' class="error"></div>
        <input type="text" name="postcode" id="postcode" style="width: 100px; <?php if ($flag ==1) {echo 'border:1px solid red;';} ?>" value="<?php if(isset($_POST) && $flag==1){ echo $_POST["postcode"];} ?>" class="text_box11"/>
        </td>
      </tr>
      <tr><td>&nbsp;</td></tr>
    -->
    
    </table></td>
    </tr>
    <tr>
      <td>Email Address <span class="red">*</span></td>
    </tr>
    <tr>
      <td>
      <div id='cust_register_email_errorloc' class="error"></div>
      <input type="text" name="email" id="email" onblur="return ajaxReq(this.value); " value="<?php if(isset($_POST) && $flag==1){ echo $_POST["email"];} ?><?php if ($cookie) {echo $user->email;} ?>" class="text_box12" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/>      </td>
    </tr>
   <!-- <tr><td><img src="images/spacer.gif" alt="" width="1" height="13"/></td></tr>
    <tr>
      <td>Confirm Email Address <span class="red">*</span></td>
    </tr>
    <tr>
      <td>
      <div id='cust_register_confemail_errorloc' class="error"></div>
      <input type="text" name="confemail" id="confemail" value="<?php if(isset($_POST) && $flag==1){ echo $_POST["confemail"];} ?>" class="text_box12" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/>      </td>
    </tr> -->
    <tr>
      <td>Phone Number <span class="red"></span></td>
    </tr>
    <tr>
      <td><input type="text" name="phno" id="phno" value="<?php if(isset($_POST) && $flag==1){ echo $_POST["phno"];} ?>" class="text_box12" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/></td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td colspan="3">
		    <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="23%">Date of Birth</td>
                <td width="77%"><a href="javascript: showDetails(10)" onclick="return overlib('&lt;font class=bodytext&gt;<div class=white-container style=width:300px; text-align:left; margin:80px auto;><ul><li><strong>Why should i provide my date of birth?</strong> <br /> <br />You must provide your real date of birth to certfy that you are at least 18 years old.</li></ul><div class=white-tl></div><div class=white-bl></div><div class=white-tr></div><div class=white-br></div></div>&lt;/font&gt;',BORDER,'1');" onMouseOut="nd();"><img src="images/question.png" width="12" height="12" vspace="4" align="default" ></a></td>
            </tr>
            </table>
			<div id='cust_register_day_errorloc' class="error"></div>
            <div id='cust_register_month_errorloc' class="error"></div>
            <div id='cust_register_year_errorloc' class="error"></div>			</td>
        </tr>
		<tr>
          <td colspan="3">		  </td>
		  </tr>
        <tr>
          <td width="15%">
          		<select name="day" id="day" class="selectbg" title="">
			        <option value="000">Day</option>
			        <?php
			       for($d=1; $d <= 31; $d++)
			       {
			        $selected = ($date[2] == $d)? "selected" : "";
			        echo '<option value="'.$d.'" '.$selected.'>'.$d.'</option>';
			       }
			        ?>
                </select></td>
          <td width="26%"><select name="month" id="month" class="selectbg">
			        <option value="000" selected="selected">Month</option>
			        <?php for($m=1;$m<=12;$m++){
			        $xx='2001-'.$m.'-01';
			        $selected = ($date[1] == $m)? "selected" : "";
			         ?>
			        <option value="<?php echo'0'.$m?>" <?php echo $selected?>><?php echo date('F',strtotime($xx))?></option>
			        <?php } ?>
                  </select></td>
          <td width="59%">
          			<select name="year" id="year" class="selectbg">
				       <option value="000">Year</option>
				         <?php
				        for($y = date("Y")-50; $y <= date("Y"); $y++)
				        {
				         $selected = ($date[0] == $y)? "selected" : "";
				         echo '<option value="'.$y.'" '.$selected.'>'.$y.'</option>';
				        }
				         ?>
                  	</select> </td>
     
      
      				
								
	<td width="0%"></li></tr>
 
      </table></td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="45%">Password <span class="red">*</span></td>
        </tr>
        <tr>
          <td>
          <div id='cust_register_password_errorloc' class="error"></div>
          <input type="password" name="password" id="password" class="text_box12" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/>          </td>
        </tr>
        <tr>
          <td width="55%">Confirm password <span class="red">*</span></td>
        </tr>
        <tr>
          <td>
          <div id='cust_register_cpassword_errorloc' class="error"></div>
          <input type="password" name="cpassword" id="cpassword" class="text_box12" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/>          </td>
        </tr>
        
      </table></td>
    </tr>
    <tr>
      <td><img src="images/spacer.gif" alt="" width="1" height="13"/></td>
    </tr>
  </table>
  </td>
       </tr>
     </table></td>
                          </tr>
                        </table></td>
					</tr>
                    </table></td>
                    </tr>
                     </table></td>
                        </tr>
                        <tr>
                          <td><table style="padding-top: 15px;" width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="20" style="width:17px;"><img src="images/green_thick.gif" alt="" width="20" height="17" /></td>
                              <td width="175" style="color:#000; font: bold 14px/28px Calibri, Arial, Helvetica, sans-serif;">Shop with confidence online</td>
                              <td width="20">&nbsp;</td>
                              <td width="50" style="width:17px;"><img src="images/green_thick.gif" alt="" width="20" height="17" /></td>
                              <td width="196" style="color:#000; font: bold 14px/28px Calibri, Arial, Helvetica, sans-serif;">Your Privacy is assured</td>
                            </tr>
                            <tr>
                              <td colspan="5" style="width:17px;">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="20" style="width:17px;"><img src="images/green_thick.gif" alt="" width="20" height="17" /></td>
                              <td width="175" style="color:#000; font: bold 14px/28px Calibri, Arial, Helvetica, sans-serif;">Get amazing deals today</td>
                              <td width="20">&nbsp;</td>
                              <td width="50" style="width:17px;"><img src="images/green_thick.gif" alt="" width="20" height="17" /></td>
                              <td width="196" style="color:#000; font: bold 14px/28px Calibri, Arial, Helvetica, sans-serif;">Explorer the new side of life</td>
                            </tr>
							
                          </table></td>
                        </tr>
                      </table>                    </td>
                    <td style="vertical-align:top;  padding:0px;">
                     <table width="100%" border="0" cellspacing="0" cellpadding="0" class="leftfrom" style="float:right; height:636px;">
                    <tr>
                    <td style="vertical-align:top;  padding:0px;">    
                
                <!-- Payment table starts -->   
                   
                    <table width="100%" border="0" cellspacing="0" cellpadding="0"> 
                     <tr>
                        <td colspan="2"><img src="images/b.png" alt="" width="164" height="21"/></td>
                     </tr>
                      <tr>
                        <td style="font: normal 11px/14px Arial, Helvetica, sans-serif; color:#666666;" width="100%" colspan="2">Please provide your credit card information bellow</td>
                      </tr>
					   <tr>
                        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="6%" align="left" valign="top"><input name="radiobutton" type="radio" value="radiobutton" /></td>
    <td width="26%" align="left" valign="top">Credit/Debit Card</td>
    <td width="68%" align="left" valign="top"><img src="images/c_cards.png" alt="" width="112" height="19"/></td>
  </tr>
</table></td>
                     </tr>
					 <tr>
                        <td colspan="2"><table style="margin: 0 0 0 20px;" width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                             <tr>
                        <td>Cardholders First Name</td>
                        <td>Cardholders Last Name</td>
                      </tr>
                      <tr>
                        <td><input type="text" name="textfield4" class="text_box123 size_140" /></td>
                        <td><input type="text" name="textfield4" class="text_box123 size_140"/></td>
                      </tr>
                      <tr>
                        <td width="100%" colspan="2">Address Line 1</td>
                      </tr>
                      <tr>
                        <td colspan="2">
                         <input type="text" name="textfield4" class="text_box12" style="width:390px"/>
						</td>
                      </tr>
					   <tr>
                        <td width="100%" colspan="2">Address Line 2</td>
                      </tr>
                      <tr>
                        <td colspan="2">
                         <input type="text" name="textfield4" class="text_box12" style="width:390px"/>
						</td>
                      </tr>
					     <tr>
                            <td width="40%">Town / City</td>
                            <td width="50%">Expiry Date<span class="red">*</span></td>
                      </tr>
                          <tr>
                            <td><input type="text" name="textfield22" class="text_box123 size_140" /></td>
                            <td><input type="text" name="textfield22" class="text_box123" style="width: 120px;" /></td>
                          </tr>
						   <tr>
                        <td width="100%" colspan="2">Card Number</td>
                      </tr>
                      <tr>
                        <td colspan="2">
                         <input type="text" name="textfield4" class="text_box12" style="width:200px"/>
						</td>
                      </tr>  
                       <tr>
                            <td width="40%">Security Code <img src="images/question.png" alt="" width="12" height="12" /></td>
                            <td width="50%">Expiry Date<span class="red">*</span></td>
                      </tr>
                          <tr>
                            <td><input type="text" name="textfield22" class="text_box123 size_140" /></td>
                            <td><select name="select2" id="select2">
                              <option>01</option>
                                        </select>
                              <select name="select2" id="select2">
                                <option>2011</option>
                              </select></td>
                          </tr>    
                      
                            </table></td>
                          </tr>
                        </table></td>
                      </tr>
					  <tr>
                        <td><input type="radio" name="payment_system" id="radio" value="radio" />
                          Maestro <img src="images/payment_icon01.png" alt="" width="22" height="14" /></td>
                        <td style="font-size:11px;">&nbsp;</td>
                      </tr>    
                      <tr>
                        <td colspan="2"><input type="radio" name="payment_system" id="amex" value="radio2" />
                        Paypal <img src="images/paypal.png" alt="" width="43" height="15" /><br />
                        <br />
                        <br /></td>
                      </tr>
                      <tr>
                        <td colspan="2" style="font-size:11px;">how all this mistaken idea of <a href="#">pleasure and</a> praising pain Policy is assured</td>
                      </tr>
                       <tr>
                        <td colspan="2">
                        
                        <div id="gateway_error_msg" class="error"></div>
            				<?php
		                    //$amount = $_SESSION['total_price'];
		                    $user_id = $_SESSION["user_id"];
		                    
		                    $deal_id = $prod_res['deal_id'];
		                    //$qty = $_SESSION['qty'];
		                    $trn_date = date("Y-m-d H:i:s");
		                   
		                    
		                    echo $message="<form action=\"https://www.sandbox.paypal.com/cgi-bin/webscr\" method=\"post\" >
		                    <input type=\"hidden\" name=\"notify_url\" value=\"http://unifiedinfotech.net/getdeals/paypal_ipn.php\">
		                    <input type=\"hidden\" name=\"cmd\" value=\"_xclick\">
		                    <input type=\"hidden\" name=\"business\" value=\"santan_1313669535_biz@unifiedwebdevelopment.com\">
		                    <input type=\"hidden\" name=\"item_name\" value=\"Paypal test service\">
		                    <input type=\"hidden\" id=\"frm_paypal_total_qty\" name=\"item_number\" value=\"\">
		                    <input type=\"hidden\" id=\"frm_paypal_total_price\" name=\"amount\" value=\"$prod_res[discounted_price]\">
		                    <input type=\"hidden\" name=\"page_style\" value=\"Primary\">
		                    <input type=\"hidden\" name=\"no_shipping\" value=\"1\">
		                    <input type=\"hidden\" name=\"return\" value=\"http://unifiedinfotech.net/getdeals/thankyou.php\">
		                    <input type=\"hidden\" name=\"cancel_return\" value=\"http://unifiedinfotech.net/getdeals/cancel.php\">
		                    <input type=\"hidden\" name=\"no_note\" value=\"1\">
		                    <input type=\"hidden\" name=\"currency_code\" value=\"USD\">
		                    <input type=\"hidden\" name=\"custom\" value=\"".$user_id.",".$deal_id.",".$trn_date."\"> <p>            
		                    <p>
		                    <input type=\"submit\" name=\submit\" value=\"Buy your deal\" class=\"buyu_btn\" style=\"cursor:pointer; font-size:20px;\">
		                    </p>
		                    </form>";
		                    //<input type=\"submit\" name=\submit\" value=\"Pay\">
		                   
		                    
		                    ?>
                        
                        <!--<input type="submit" name="Submit" value="Buy your deal" class="buyu_btn" />--></td>
                      </tr>
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                    </table>    
                    
                    <!-- Payment table ends -->
                    
                    </td>
                    </tr> 
                  </table>
                    </td>
                  </tr>
                </table>
                  
                  <div>&nbsp;</div>
                </div>

    </div>
<div class="accounts_bot"><img src="images/spacer.gif" alt="" width="1" height="9"/></div
></div>
</div>










<script type="text/javascript">

function total_price(qty) {
	var single_price = <?php echo strip_tags($prod_res['discounted_price']); ?>;
	//alert (single_price);
	var total_price = single_price*qty;
	
	document.getElementById('total_price').innerHTML = '&pound; '+total_price;
}


function ajaxReq(str)
{
var xmlhttp;
//alert(str); die();
if (str.length==0)
  { 
  document.getElementById("total_price").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("total_price").innerHTML='&pound; '+xmlhttp.responseText;
    document.getElementById("big_total_price").innerHTML=xmlhttp.responseText;
    document.getElementById("frm_paypal_total_price").value=xmlhttp.responseText;
    document.getElementById("frm_paypal_total_qty").value=str;
    }
  }
xmlhttp.open("GET","ajax_payment.php?qty="+str+"&id="+<?php echo $prod_id; ?>,true);
xmlhttp.send();
}

</script>



</div>
</div>
</div>
</div>
<?php include ('include/footer.php'); ?>