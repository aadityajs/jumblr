<?php
ob_start();
session_start();
require("config.inc.php");
require("class/Database.class.php");
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);			
$db->connect();
mysql_query("SET CHARACTER SET utf8"); 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Merchant Login Panel</title>
<link rel="stylesheet" type="text/css" href="siteadmin/style.css" />
<script type="text/javascript" src="siteadmin/js/jquery6.min.js"></script>
<script type="text/javascript" src="siteadmin/js/ddaccordion.js"></script>



<script language="javascript" type="text/javascript" src="siteadmin/js/niceforms.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="siteadmin/js/niceforms-default.css" />

</head>
<body>

<?php	
	if(isset($_POST['submit']))
	{			
		$email=$_POST['email'];
		$sql="SELECT * FROM ".TABLE_USERS." where email='".$email."'";
		$userexists=$db->query_first($sql);
		
		
		
		if(!empty($userexists['email'])){
		 $_SESSION['errmsg']="Email address already registered with us."; 
			 header("location:merchant_signup.php");
			 exit;
		}
		if(empty($_POST['password'])){
		 $_SESSION['errmsg']="Please enter your password."; 
			 header("location:merchant_signup.php");
			 exit;
		}
		if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email)==false)
			{ 
			$_SESSION['errmsg']="Invalid email address."; 
			header("location:merchant_signup.php");
			exit;
			}
				
				
	
	
	$date_added=date("Y-m-d H:i");	
	$data['date_added']=$date_added;
	$data['zip']=$_POST['zip'];
	$data['work_zipcode']=$_POST['work_zipcode'];
	
	$data['reg_ip']=$_SERVER['REMOTE_ADDR'];
	$data['reg_type']='merchant';
	if(isset($_POST['cpassword'])){
	$data['password']=md5($_POST['password']);
	}
	$data['email']=$_POST['email'];
	$data['status']=1;
	
	
	$data['company_name']=$_POST['company_name'];
	$data['address1']=$_POST['address1'];
	$data['address2']=$_POST['address2'];
	$data['city']=$_POST['city'];
	$data['state']=$_POST['state'];
	$data['zip']=$_POST['zip'];
	$data['country']=$_POST['country'];
	$data['phone']=$_POST['phone'];
	$data['fax']=$_POST['fax'];
	$data['website']=$_POST['website'];
	
	
	$user_id=$db->query_insert(TABLE_USERS, $data);
	
	if($user_id){
	$sql="SELECT * FROM ".TABLE_ADMIN." where admin_name='admin'";
				$admin=$db->query_first($sql);
	
				$to = $email;
				$subject = "Welcome to GeeLaza.com";
				$txt = "Thanks For Regisration and thanks for contact with us. Your account detail is given below:<br />";
				$txt .= "Username:".$email."<br />";
				$txt .= "Password:".$_POST['password']."<br />";
				$txt .= "After login please complete all the steps and create a store and wait for admin approval.";
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= "From: GeeLaza.com<".$admin['email'].">". "\r\n" ;
				
				$status=@mail($to,$subject,$txt,$headers);
	}	
		
	$_SESSION['msg']="Registration Successful.Please login with your user details.";
	header("location:merchant.php");
	exit;
		
	
	}
?>
<div id="main_container">

	<div class="header_login">
    <div style="width:595px; margin: 12px auto; float: left; background:#09070D;"><a href="#"><img src="siteadmin/images/logo.png" alt="" title="" border="0" /></a></div>    
    </div>
		<div class="msghead" style="margin-left:50px;">
		<?php 
				if($_SESSION['errmsg']){
				echo '<div class="error_box" style="font-size:12px;">'.$_SESSION['errmsg'].'</div>' ;
				$_SESSION['errmsg']="";
				}if($_SESSION['msg']){
				echo '<div class="valid_box" style="font-size:12px;">'.$_SESSION['msg'].'</div>' ;
				$_SESSION['msg']="";
				}
				
				?>
		</div>	
         <div class="merchant_form">
         
         <h2 style="padding:10px;">Merchant Signup</h2>
         <script>
		 function validateform(){
		 var company_name = document.getElementById('company_name').value;
			var password = document.getElementById('password').value;
			var cpassword = document.getElementById('cpassword').value;
			var email = document.getElementById('email').value;
			var address1 = document.getElementById('address1').value;
			var country = document.getElementById('country').value;
			var city = document.getElementById('city').value;
			var state = document.getElementById('state').value;
			var zip = document.getElementById('zip').value;
			var phone = document.getElementById('phone').value;
			if(company_name==''){
			document.getElementById('company_name').focus();
			
			alert("Please enter company name");
			return false;
			}
		 	if(email==''){
			document.getElementById('email').focus();
			alert("Please enter email");
			return false;
			}
			
			 var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
   
		   if(reg.test(email) == false) 
		   {
		  	 document.getElementById('email').focus();
			  alert("Please enter valid email address.");
			  return false
		   }
			if(password==''){
			document.getElementById('password').focus();
			alert("Please enter password");
			return false;
			}
			if(password!=cpassword){
			document.getElementById('cpassword').focus();
			alert("Your password is not matching.");
			return false;
			}
			if(address1==''){
			document.getElementById('address1').focus();
			alert("Please enter your primary address.");
			return false;
			}
			if(country==''){
			document.getElementById('country').focus();
			alert("Please enter your primary country.");
			return false;
			}
			if(city==''){
			document.getElementById('city').focus();
			alert("Please enter your primary store city");
			return false;
			}
			if(state==''){
			document.getElementById('state').focus();
			alert("Please enter your primary store state");
			return false;
			}
			if(zip==''){
			document.getElementById('zip').focus();
			alert("Please enter your primary store zipcode");
			return false;
			}
			if(phone==''){
			document.getElementById('phone').focus();
			alert("Please enter your primary store phone");
			return false;
			}
		 return true;
		 }
		 </script>
        <style>
		fieldset {
				border: medium solid #cccccc;
				clear: both;
				padding:10px;
				width:500px;
				margin-left:90px;
			}
		</style>
         <form action="" method="post" class="niceform2" onsubmit="return validateform()">
         
                <fieldset>
			
					
                    				<legend  title="Primary Location">Company Login Info</legend>																			
											<dl>
												<dt><label for="gender">Company Name:<span class="formimportant"> *</span></label></dt>
												<dd>
													<input type="text" name="company_name" id="company_name" size="54" value="<?php echo stripslashes($row_deals[company_name]);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /><br />
												<span class="validate_error" style="color:#FF0000" id="err1"></span>
												</dd>
											</dl>
											
													
											<dl>
												<dt><label for="email">Email/User Id:<span class="formimportant"> *</span> </label></dt>
												<dd><input class="lf" name="email" id="email" type="text" value="<?php echo $row_deals[email]?>" />
												<span class="validate_error" id="err4"></span></dd>
											</dl>	
											
											
											<dl>
												<dt><label for="password">Password:<span class="formimportant"> *</span> </label></dt>
												<dd><input class="lf" name="password" id="password" type="password" value="<?php echo $row_deals[password]?>" />
												<span class="validate_error" id="err2"></span></dd>
											</dl>
											
											
											
											<dl>
												<dt><label for="cpassword">Confirm Password: </label></dt>
												<dd><input class="lf" name="cpassword" id="cpassword" type="password" value="" />
												<span class="validate_error" id="err3"></span></dd>
											</dl>
											
						</fieldset>
						<br  style="clear:both" />
						<fieldset>					
							<legend  title="Primary Location">Company Location</legend>				
											<dl>
												<dt><label for="password">Company Address 1:<span class="formimportant"> *</span></label></dt>
												<dd><input type="text" name="address1" id="address1" size="54" value="<?php echo $row_deals[address1]?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
											</dl>
											
											<dl>
												<dt><label for="email">Company Address 2:</label></dt>
												<dd><input type="text" name="address2" id="address2" size="54" value="<?php echo stripslashes($row_deals[address2]);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
											</dl>
											
											<dl>
											<dt><label for="email">Company Country:<span class="formimportant"> *</span></label></dt>
											
											<select name="country" class="dropdown" id="country" size="1">
													<option value="">-- Select --</option>
													<?php												
																			
														$sql_categories=mysql_query("select * from " .TABLE_COUNTRIES." order by country_name asc");
														while($row_categories=mysql_fetch_array($sql_categories))
														{												
													?>
													
															<option value="<?php echo $row_categories[country_id];?>" <?php if($row_categories[country_id]==$row_deals[country]) { echo "selected"; }?>><?php echo $row_categories[country_name];?></option>
													<?php
														}
													?>			
												</select>						
									</dl>
									
											<dl>
												<dt><label for="email">Company City:<span class="formimportant"> *</span></label></dt>
												<dd>
												<select name="city" id="city">
												<?php $city=$db->fetch_all_array("SELECT * FROM ".TABLE_CITIES." where status='1' group by city_name order by city_name asc");
												
												foreach($city as $cityitem){
												?>
												<?php if($row_deals[city]==$cityitem){?>
												<option value="<?php echo $cityitem['city_name']?>" selected="selected"><?php echo $cityitem['city_name']?></option>
												<?php }else{?>
												<option value="<?php echo $cityitem['city_name']?>"><?php echo $cityitem['city_name']?></option>
												<?php }?>
												<?php }?>
												</select>
												</dd>
											</dl>
																
											<dl>
												<dt><label for="email">Company State:<span class="formimportant"> *</span></label></dt>
												<dd><input type="text" name="state" id="state" size="54" value="<?php echo stripslashes($row_deals[state]);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
											</dl>
											
											
											
											<dl>
												<dt><label for="fullname">Company Zipcode:<span class="formimportant"> *</span> </label></dt>
												<dd><input class="lf" name="zip" id="zip" type="text" value="<?php echo $row_deals[zip]?>" />
												</dd>
											</dl>
											
											
											
									<dl>
											<dt><label for="email">Phone:</label><span class="formimportant"> *</span></dt>
											<dd><input type="text" name="phone" id="phone" size="54" value="<?php echo stripslashes($row_deals[phone]);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
										</dl>
											
											
										
										<dl>
											<dt><label for="email">FAX:</label></dt>
											<dd><input type="text" name="fax" id="fax" size="54" value="<?php echo stripslashes($row_deals[fax]);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
										</dl>
										
										<dl>
											<dt><label for="email">Website:</label></dt>
											<dd><input type="text" name="website" id="website" size="54" value="<?php echo stripslashes($row_deals[website]);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
										</dl>
										
									
					
					
					
                    
								
                    
					 
                </fieldset>
				  <br  style="clear:both" />
			<div style="text-align:center; margin:0 auto; width:50px;">
				<input type="submit" name="submit" id="submit" value="Submit" class="login_btn" style="padding-bottom: 5px;"/></div>
                
         </form>
         </div>
    
    <div class="footer_login">
    
    	
    
    </div>

</div>		
</body>
</html>