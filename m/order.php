<?php include("include/header.php");?>
<!--<script language="JavaScript" src="js/gen_validatorv4.js" type="text/javascript" xml:space="preserve"></script>-->

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
				
	  	 	
			/*$sql_chk_fb_user = "SELECT * FROM ".TABLE_USERS." WHERE email = '".$user->email."'";
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
	   		*/		
		
			
	   			
		
	   	}
?>
<div id="container">
<div id="leftcol">
<div class="refund_box">
<div class="refund_top"></div>
<div class="refund_mid">
<div><p>Can I get a refund for my order?</p></div>
<div class="clear"></div>
<div class="text13">We do provide refund if you change your mind on a purchase within five days after you've purchase your
voucher and want to "return" the unused voucher. After that, we do not provide refunds expect that we
will provide a refund if you are unable to redeem a voucher because the merchant has gone out of business.</div>
<div class="clear"></div>
<form name="cust_register" id="cust_register" onsubmit="javascript:return ValidateRegisterForm();" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <div style="border:1px #CCCCCC solid; width: 676px; margin: 0 auto; float: none;">
  <table width="676" align="center" border="0" cellspacing="0" cellpadding="0">
   <tr>
    <td>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="login_bg2">
       <tr>
         <td>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="login_bg">
	<tr>
    <td><img src="images/spacer.gif" alt="" width="1" height="6"/></td>
    </tr>    
    <tr>
    <td class="text_black"> <span><img src="images/spacer.gif" alt="" width="210" height="1" /></span><!-- <span>Required field <span class="red">(*)</span></span> --></td>
    </tr>
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
        <td class="text14">Your refund claim has been reject because:</td>
      </tr>
      <tr>
        <td width="45%" class="text14"><span>*</span>Your voucher is used</td>
      </tr>
      <tr><td><img src="images/spacer.gif" alt="" width="1" height="13"/></td></tr>
      <tr>
        <td class="or">OR</td>
      </tr>
      <tr>
        <td width="55%" class="text14"><span>*</span>Your claim is not within 5 days of purchase</td>
      </tr>
       <tr><td><img src="images/spacer.gif" alt="" width="1" height="13"/></td></tr>
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
  </table>
  </td>
       </tr>
     </table>
 
  </td>
        <td width="39%" align="left" valign="top">&nbsp;</td>
   </tr>
   <tr>
     <td colspan="2">
   
    </td>
     </tr>
    </table>
  <div></div>
  </div>
  </form>
</div>
<div class="refund_bot"></div>
</div>
</div>

<?php include ('include/sidebar-login.php'); ?>
</div>

<?php include("include/footer.php");?>