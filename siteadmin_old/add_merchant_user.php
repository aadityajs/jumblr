<?php
include("include/header.php");

if($_REQUEST[mode]=="delete")
{
	$user_id=intval($_REQUEST['id']);
	mysql_query("delete from ".TABLE_USERS." where user_id='$user_id'");
	mysql_query("delete from ".TABLE_USER_SUBSCRIPTION." where user_id='$user_id'");
	header("location:show_merchant_users.php");	
}

if($_REQUEST[mode]=="status")
{
	$user_id=intval($_REQUEST['id']);
	$row_status=mysql_fetch_array(mysql_query("select status from ".TABLE_USERS." where user_id='$user_id'"));
	
	if($row_status[status]==1)
	{
		mysql_query("update ".TABLE_USERS." set status=0 where user_id='$user_id'");
	}
	else
	{
		mysql_query("update ".TABLE_USERS." set status=1 where user_id='$user_id'");
	}
	
	header("location:show_merchant_users.php");
	
}

if(isset($_REQUEST['submit']))
{
	
	$user_id=intval($_REQUEST['id']);
	$date_added=date("Y-m-d");	
	$data['first_name']=$_POST['first_name'];
	$data['last_name']=$_POST['last_name'];
	$data['zip']=$_POST['zip'];
	$data['work_zipcode']=$_POST['work_zipcode'];
	$data['gender']=$_POST['gender'];
	$data['age_range']=$_POST['age_range'];
	$data['reg_ip']=$_SERVER['REMOTE_ADDR'];
	$data['reg_type']='merchant';
	if(isset($_POST['cpassword'])){
	$data['password']=md5($_POST['password']);
	}
	$data['email']=$_POST['email'];
	$data['status']=1;
	$data['date_added']=$date_added;
	
	$data['company_name']=$_POST['company_name'];
	$data['address1']=$_POST['address1'];
	$data['address2']=$_POST['address2'];
	$data['city']=$_POST['city'];
	$data['state']=$_POST['state'];
	$data['zip']=$_POST['zip'];
	$data['country']=$_POST['country'];
	
	$data['fax']=$_POST['fax'];
	$data['website']=$_POST['website'];
	$data['paypal_email']=$_POST['paypal_email'];
	
	if($_REQUEST['mode']=="edit")
	{
	
		$db->query_update(TABLE_USERS, $data, "user_id='$user_id'");
		
		
		
		
	
	}
	else
	{
		$user_id=$db->query_insert(TABLE_USERS, $data);
		
		
		
	}
	
	header("location:show_merchant_users.php");
	
}

?>



	<script language="javascript">
		
		function validation()
		{
			var company_name = document.getElementById('company_name').value;
			var password = document.getElementById('password').value;
			var cpassword = document.getElementById('cpassword').value;
			var email = document.getElementById('email').value;
			var str="";
			
			if(company_name=="")
			{
				document.getElementById('err1').innerHTML="Enter Company Name";				
				str+="errmsg";
			}
			else
			{
				document.getElementById('err1').innerHTML="";
				
			}
			
			if(password=="")
			{
				document.getElementById('err2').innerHTML="Enter Password";
				str+="errmsg";
			}
			else
			{
				document.getElementById('err2').innerHTML="";
			}
			
			if(cpassword!="")
			{
				

				if(cpassword!=password)
				{
					document.getElementById('err3').innerHTML="Password Mismatch";
					str+="errmsg";
					
				}
				else
				{
					document.getElementById('err3').innerHTML="";
				}
			}
			
			if(email=="")
			{
				document.getElementById('err4').innerHTML="Enter Email";
				str+="errmsg";
				
			}
			else
			{
				document.getElementById('err4').innerHTML="";
			}
			
			 var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
   
		   if(reg.test(email) == false) 
		   {
			  document.getElementById('err4').innerHTML="Enter Valid Email";
			  str+="errmsg";
		   }
		   else
		  {
			 document.getElementById('err4').innerHTML="";
		  }
					
			
			if(str!="")
			{
				return false;
			}
			else
			{
				return true;
			}
	
		}

		</script>


<?php
			$admin_id=intval($_SESSION['admin_id']);
			$sql = "SELECT admin_name FROM `".TABLE_ADMIN."` WHERE admin_id='$admin_id'";
			$record = $db->query_first($sql);
			
			if($_REQUEST[mode]=="edit")
			{
				$user_id=intval($_REQUEST['id']);
				$row_deals=mysql_fetch_array(mysql_query("select * from ".TABLE_USERS." where user_id='$user_id'"));
				
			}
	
	?>

    
    <div class="main_content">
    
      <?php include("include/top_menu.inc.php");?>                    
                    


    <div class="center_content">  
    
   		<?php require("include/left_menu.php"); ?>        
    
    <div class="right_content">  
	
		 
		 <div class="form">
		 
		

					<?php
						if($_REQUEST['mode']=="edit")
						{
					?>
							<h1>Edit Merchant User</span></h1>
							<form method="post" action="?id=<?php echo $user_id;?>&mode=edit" enctype="multipart/form-data" onSubmit="return validation()">
					
					<?php
						}
						else
						{
					?>
							<h1>Add Merchant User</span></h1>
							<form method="post" enctype="multipart/form-data" onSubmit="return validation()">
							
					<?php
						}
					?>
										
										<!-- Fieldset -->
										<fieldset>
									
									<?php
										if($_REQUEST['mode']=="edit")
										{
									?>
											<legend>Edit User Account</legend>
									
									<?php
										}
										else
										{
									?>
											<legend>Create User Account</legend>
											
									<?php
										}
									?>
																															
											<dl>
												<dt><label for="gender">Company Name:</label></dt>
												<dd>
													<input type="text" name="company_name" id="company_name" size="54" value="<?php echo stripslashes($row_deals[company_name]);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /><br />
												<span class="validate_error" style="color:#FF0000" id="err1"></span>
												</dd>
											</dl>
											
											<dl>
												<dt><label for="password">Company Address 1:</label></dt>
												<dd><input type="text" name="address1" id="address1" size="54" value="<?php echo $row_deals[address1]?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
											</dl>
											
											<dl>
												<dt><label for="email">Company Address 2:</label></dt>
												<dd><input type="text" name="address2" id="address2" size="54" value="<?php echo stripslashes($row_deals[address2]);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
											</dl>
											
											<dl>
												<dt><label for="email">Company City:</label></dt>
												<dd>
												<select name="city">
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
												<dt><label for="email">Company State:</label></dt>
												<dd><input type="text" name="state" id="state" size="54" value="<?php echo stripslashes($row_deals[state]);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
											</dl>
											<dl>
											<dt><label for="email">Company Country:</label></dt>
											
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
												<dt><label for="fullname">Company Zipcode: </label></dt>
												<dd><input class="lf" name="zip" id="zip" type="text" value="<?php echo $row_deals[zip]?>" />
												</dd>
											</dl>
											
											
											
											
											
											
											
											<dl>
												<dt><label for="password">Password: </label></dt>
												<dd><input class="lf" name="password" id="password" type="password" value="<?php echo $row_deals[password]?>" />
												<span class="validate_error" id="err2"></span></dd>
											</dl>
											
											
											
											<dl>
												<dt><label for="cpassword">Confirm Password: </label></dt>
												<dd><input class="lf" name="cpassword" id="cpassword" type="password" value="" />
												<span class="validate_error" id="err3"></span></dd>
											</dl>
											
											
											<dl>
												<dt><label for="email">Email/Merchant LoginId: </label></dt>
												<dd><input class="lf" name="email" id="email" type="text" value="<?php echo $row_deals[email]?>" />
												<span class="validate_error" id="err4"></span></dd>
											</dl>	
										
										<dl>
											<dt><label for="email">FAX:</label></dt>
											<dd><input type="text" name="fax" id="fax" size="54" value="<?php echo stripslashes($row_deals[fax]);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
										</dl>
										
										<dl>
											<dt><label for="email">Website:</label></dt>
											<dd><input type="text" name="website" id="website" size="54" value="<?php echo stripslashes($row_deals[website]);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
										</dl>
										
										
										<dl>
											<dt><label for="email">Paypal Email:</label></dt>
											<dd><input type="text" name="paypal_email" id="paypal_email" size="54" value="<?php echo stripslashes($row_deals[paypal_email]);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
										</dl>
											
											
											  <dl class="submit">
												<input type="submit" name="submit" id="submit" value="Submit" />
												 </dl>
											</fieldset>
										<!-- End of fieldset -->
									</form>
				
					
					
         </div>
		 
     </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->  
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    	<?php require("include/footer.inc.php"); ?>   
