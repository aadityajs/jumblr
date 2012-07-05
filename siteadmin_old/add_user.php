<?php
include("include/header.php");

if($_REQUEST[mode]=="delete")
{
	$user_id=intval($_REQUEST['id']);
	mysql_query("delete from ".TABLE_USERS." where user_id='$user_id'");
	mysql_query("delete from ".TABLE_USER_SUBSCRIPTION." where user_id='$user_id'");
	header("location:show_users.php");	
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
	
	header("location:show_users.php");
	
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
	$data['city']=$_POST['city'];
	$data['state']=$_POST['state'];
	$data['country']=$_POST['country'];
	$data['phone_no']=$_POST['phone_no'];
	$data['address1']=$_POST['address1'];
if(file_exists($_FILES['user_img']['tmp_name'])){
		$file=uniqid().$_FILES['user_img']['name'];
		move_uploaded_file($_FILES['user_img']['tmp_name'],"../upload_files/profile_image/".$file);
		$data['user_img']=$file;
		
	}
	
	$data['education']=$_POST['education'];
	$data['employment']=$_POST['employment'];
	$data['income']=$_POST['income'];
	$data['own_home']=$_POST['own_home'];
	$data['relationship']=$_POST['relationship'];
	$data['has_children']=$_POST['has_children'];
	
	
	
	if(isset($_POST['cpassword'])){
	$data['password']=md5($_POST['password']);
	}
	$data['email']=$_POST['email'];
	$data['status']=1;
	$data['date_added']=$date_added;
	
	if($_REQUEST['mode']=="edit")
	{
	
		$db->query_update(TABLE_USERS, $data, "user_id='$user_id'");
		
		$subscription=$_POST['subscription'];
		mysql_query("DELETE from ".TABLE_USER_SUBSCRIPTION." where user_id='$user_id'");
		foreach($subscription as $subs){
		
		
		$data1['city_id']=$subs;
		$data1['user_id']=$user_id;
		$db->query_insert(TABLE_USER_SUBSCRIPTION, $data1);
		
		
		}
		
		$data1=array();
		$pref=$_POST['preference'];
		
		mysql_query("DELETE from ".TABLE_USER_PREFERENCE." where user_id='$user_id'");
		foreach($pref as $preference){
		
		
		$data1['category_id']=$preference;
		$data1['user_id']=$user_id;
		$db->query_insert(TABLE_USER_PREFERENCE, $data1);
		
		
		}
		
		
	
	}
	else
	{	$data['reg_ip']=$_SERVER['REMOTE_ADDR'];
		$data['reg_type']='regular';
		$user_id=$db->query_insert(TABLE_USERS, $data);
		
		$subscription=$_POST['subscription'];
		foreach($subscription as $subs){
		$data1['city_id']=$subs;
		$data1['user_id']=$user_id;
		$db->query_insert(TABLE_USER_SUBSCRIPTION, $data1);
		
		
		}
		$data1=array();
		$pref=$_POST['preference'];
		foreach($pref as $preference){
		$data1['category_id']=$preference;
		$data1['user_id']=$user_id;
		$db->query_insert(TABLE_USER_PREFERENCE, $data1);
		
		
		}
		
	}
	
	header("location:show_users.php");
	
}




			$admin_id=intval($_SESSION['admin_id']);
			$sql = "SELECT admin_name FROM `".TABLE_ADMIN."` WHERE admin_id='$admin_id'";
			$record = $db->query_first($sql);
			
			if($_REQUEST[mode]=="edit")
			{
				$user_id=intval($_REQUEST['id']);
				$row_deals=mysql_fetch_array(mysql_query("select * from ".TABLE_USERS." where user_id='$user_id'"));
				
			}
?>



	<script language="javascript">
		
		function validation()
		{
			var first_name = document.getElementById('first_name').value;
			var password = document.getElementById('password').value;
			var cpassword = document.getElementById('cpassword').value;
			var email = document.getElementById('email').value;
			var str="";
			
			if(first_name=="")
			{
				document.getElementById('err1').innerHTML="Enter User Name";				
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
							<h1>Edit User</span></h1>
							<form method="post" action="?id=<?php echo $user_id;?>&mode=edit" enctype="multipart/form-data" onSubmit="return validation()">
					
					<?php
						}
						else
						{
					?>
							<h1>Add User</span></h1>
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
												<dt><label for="fullname">First Name: </label></dt>
												<dd><input class="lf" name="first_name" id="first_name" type="text" value="<?php echo $row_deals[first_name]?>" />
												<span class="validate_error" id="err1"></span></dd>
											</dl>
											
																															
											<dl>
												<dt><label for="fullname">Last Name: </label></dt>
												<dd><input class="lf" name="last_name" id="last_name" type="text" value="<?php echo $row_deals[last_name]?>" />
												</dd>
											</dl>
											
											
											
											
											
											
											<dl>
												<dt><label for="email"> City:</label></dt>
												<dd>						
												
												<select name="city" class="dropdown" id="city" size="1">
														<option value="">-- Select --</option>
														<?php												
																				
															$sql_cities=mysql_query("select city_name,city_id from " .TABLE_CITIES." order by city_name asc");
															while($row_cities=mysql_fetch_array($sql_cities))
															{												
														?>
														
																<option value="<?php echo $row_cities[city_name];?>" <?php if($row_cities[city_name]==$row_deals[city]) { echo "selected"; }?>><?php echo ucfirst($row_cities[city_name]);?></option>
														<?php
															}
														?>			
													</select>
												
												</dd>
											</dl>
											
											<dl>
												<dt><label for="fullname">State: </label></dt>
												<dd><input class="lf" name="state" id="state" type="text" value="<?php echo $row_deals[state]?>" />
												</dd>
											</dl>
											
											<dl>
												<dt><label for="fullname">Country: </label></dt>
												<dd><select name="country" class="dropdown" id="city" size="1">
														<option value="">-- Select --</option>
														<?php												
																				
															$sql_cities=mysql_query("select country_name,country_id from " .TABLE_COUNTRIES." order by country_name asc");
															while($row_country=mysql_fetch_array($sql_cities))
															{												
														?>
														
																<option value="<?php echo $row_country[country_name];?>" <?php if($row_country[country_name]==$row_deals[country]) { echo "selected"; }?>><?php echo ucfirst($row_country[country_name]);?></option>
														<?php
															}
														?>			
													</select>
												</dd>
											</dl>
											<dl>
												<dt><label for="fullname">Phone: </label></dt>
												<dd><input class="lf" name="phone_no" id="phone_no" type="text" value="<?php echo $row_deals[phone_no]?>" />
												</dd>
											</dl>
											
											<dl>
												<dt><label for="fullname">Address: </label></dt>
												<dd><input class="lf" name="address1" id="address1" type="text" value="<?php echo $row_deals[address1]?>" />
												</dd>
											</dl>
											<dl>
												<dt><label for="fullname">Zip: </label></dt>
												<dd><input class="lf" name="zip" id="zip" type="text" value="<?php echo $row_deals[zip]?>" />
												</dd>
											</dl>
											
											<dl>
												<dt><label for="upload">Profile Image:</label></dt>
												<dd><input type="file" name="user_img" />
												<?php if($row_deals['user_img']){?><img src="../upload_files/profile_image/<?php echo $row_deals['user_img']?>" width="100"/><?php }?>
												</dd>
											</dl>
											<dl>
												<dt><label for="fullname">Education: </label></dt>
												<dd>
												<select name="education" id="education"><option value="">Select</option>
												  <option value="Some high school" <?php if($row_deals['education']=='Some high school'){echo "Selected";}?>>Some high school</option>
												  <option value="High school graduate or equivalent" <?php if($row_deals['education']=='High school graduate or equivalent'){echo "Selected";}?>>High school graduate or equivalent</option>
												  <option value="Trade or vocational degree" <?php if($row_deals['education']=='Trade or vocational degree'){echo "Selected";}?>>Trade or vocational degree</option>
												  <option value="Some college" <?php if($row_deals['education']=='Some college'){echo "Selected";}?>>Some college</option>
												  <option value="Associate degree" <?php if($row_deals['education']=='Associate degree'){echo "Selected";}?>>Associate degree</option>
												  <option value="Bachelor's degree" <?php if($row_deals['education']=="Bachelor's degree"){echo "Selected";}?>>Bachelor's degree</option>
												  <option value="Graduate or professional degree" <?php if($row_deals['education']=="Graduate or professional degree"){echo "Selected";}?>>Graduate or professional degree</option>
												  <option value="Prefer not to share" <?php if($row_deals['education']=="Prefer not to share"){echo "Selected";}?>>Prefer not to share</option>
												  </select>
												
												</dd>
											</dl>
											
											<dl>
												<dt><label for="fullname">Employment Status: </label></dt>
												<dd>
												<select name="employment" id="employment"><option value="">Select</option>
												  <option value="Employed full time" <?php if($row_deals['employment']=='Employed full time'){echo "Selected";}?>>Employed full time</option>
												  <option value="Not employed but looking for work" <?php if($row_deals['employment']=='Not employed but looking for work'){echo "Selected";}?>>Not employed but looking for work</option>
												  <option value="Not employed and not looking for work" <?php if($row_deals['employment']=='Not employed and not looking for work'){echo "Selected";}?>>Not employed and not looking for work</option>
												  <option value="Retired" <?php if($row_deals['employment']=='Retired'){echo "Selected";}?>>Retired</option>
												  <option value="Student" <?php if($row_deals['employment']=='Student'){echo "Selected";}?>>Student</option>
												  <option value="Homemaker" <?php if($row_deals['employment']=='Homemaker'){echo "Selected";}?>>Homemaker</option>
												  <option value="Prefer not to share" <?php if($row_deals['employment']=='Prefer not to share'){echo "Selected";}?>>Prefer not to share</option>
												</select>
												
												</dd>
											</dl>
											
											<dl>
												<dt><label for="fullname">Income Range: </label></dt>
												<dd>
												<select name="income" id="income"><option value="">Select</option>
												  <option value="Under $20,000" <?php if($row_deals['income']=='Under $20,000'){echo "Selected";}?>>Under $20,000</option>
												  <option value="$20,000 &ndash; 29,999" <?php if($row_deals['income']=='$20,000 &ndash; 29,999'){echo "Selected";}?>>$20,000 &ndash; 29,999</option>
												  <option value="$30,000 &ndash; 39,999" <?php if($row_deals['income']=='$30,000 &ndash; 39,999'){echo "Selected";}?>>$30,000 &ndash; 39,999</option>
												  <option value="$40,000 &ndash; 49,999" <?php if($row_deals['income']=='$40,000 &ndash; 49,999'){echo "Selected";}?>>$40,000 &ndash; 49,999</option>
												  <option value="$50,000 &ndash; 69,999" <?php if($row_deals['income']=='$50,000 &ndash; 69,999'){echo "Selected";}?>>$50,000 &ndash; 69,999</option>
												  <option value="$70,000 &ndash; 99,999" <?php if($row_deals['income']=='$70,000 &ndash; 99,999'){echo "Selected";}?>>$70,000 &ndash; 99,999</option>
												  <option value="$100,000 &ndash; 149,999" <?php if($row_deals['income']=='$100,000 &ndash; 149,999'){echo "Selected";}?>>$100,000 &ndash; 149,999</option>
												  <option value="$150,000 or more" <?php if($row_deals['income']=='$150,000 or more'){echo "Selected";}?>>$150,000 or more</option>
												  <option value="Prefer not to share" <?php if($row_deals['income']=='Prefer not to share'){echo "Selected";}?>>Prefer not to share</option>
												</select>
												
												</dd>
											</dl>
											
											<dl>
												<dt><label for="fullname">Own a home?: </label></dt>
												<dd>
													<input type="radio" name="own_home" value="yes" <?php if($row_deals['own_home']=='yes'){echo "checked";}?>/>Yes
													<input type="radio" name="own_home" value="no" <?php if($row_deals['own_home']=='no'){echo "checked";}?>/>No
												
												</dd>
											</dl>
											
											<dl>
												<dt><label for="fullname">Relationship status: </label></dt>
												<dd>
													<select name="relationship" id="relationship"><option value="">Select</option>
													  <option value="Single, not married" <?php if($row_deals['relationship']=='Single, not married'){echo "Selected";}?>>Single, not married</option>
													  <option value="Married" <?php if($row_deals['relationship']=='Married'){echo "Selected";}?>>Married</option>
													  <option value="Living with partner" <?php if($row_deals['relationship']=='Living with partner'){echo "Selected";}?>>Living with partner</option>
													  <option value="Separated" <?php if($row_deals['relationship']=='Separated'){echo "Selected";}?>>Separated</option>
													  <option value="Divorced" <?php if($row_deals['relationship']=='Divorced'){echo "Selected";}?>>Divorced</option>
													  <option value="Widowed" <?php if($row_deals['relationship']=='Widowed'){echo "Selected";}?>>Widowed</option>
													  <option value="Prefer not to share" <?php if($row_deals['relationship']=='Prefer not to share'){echo "Selected";}?>>Prefer not to share</option>
													</select>
												
												</dd>
											</dl>
											
											<dl>
												<dt><label for="fullname">Have children?: </label></dt>
												<dd>
													<input type="radio" name="has_children" value="yes" <?php if($row_deals['has_children']=='yes'){echo "checked";}?>/>Yes
													<input type="radio" name="has_children" value="no" <?php if($row_deals['has_children']=='no'){echo "checked";}?>/>No
												
												</dd>
											</dl>
											
											<dl>
												<dt><label for="fullname">User Subscriptions: </label></dt>
												<dd>
												<?php 
																							
												
												$city=mysql_query("SELECT * FROM `".TABLE_CITIES."` ");	
												while($row=mysql_fetch_array($city)){
												
												$sub=mysql_fetch_object(mysql_query("SELECT * FROM `".TABLE_USERS."` LEFT JOIN `".TABLE_USER_SUBSCRIPTION."` ON ( ".TABLE_USERS.".user_id = ".TABLE_USER_SUBSCRIPTION.".user_id ) where ".TABLE_USERS.".user_id='".$user_id."' and ".TABLE_USER_SUBSCRIPTION.".city_id='".$row['city_id']."'"));	
												
												?>
												
												<input type="checkbox" name="subscription[]" value="<?php echo $row['city_id']?>" <?php if($sub->city_id==$row['city_id']){echo "checked='checked'";}?>/><?php echo $row['city_name']?>
												<?php }?>
												
												</dd>
											</dl>
											
											
											
											<dl>
												<dt><label for="fullname">User Preference: </label></dt>
												<dd>
												<?php 
																							
												
												$pref=mysql_query("SELECT * FROM `".TABLE_CATEGORIES."` ");	
												$itemloop=0;
												while($row=mysql_fetch_array($pref)){
												
												$sub=mysql_fetch_object(mysql_query("SELECT * FROM `".TABLE_USERS."` LEFT JOIN `".TABLE_USER_PREFERENCE."` ON ( ".TABLE_USERS.".user_id = ".TABLE_USER_PREFERENCE.".user_id ) where ".TABLE_USERS.".user_id='".$user_id."' and ".TABLE_USER_PREFERENCE.".category_id='".$row['cat_id']."'"));	
												
												?>
												
												<input type="checkbox" name="preference[]" value="<?php echo $row['cat_id']?>" <?php if($sub->category_id==$row['cat_id']){echo "checked='checked'";}?>/><?php echo $row['cat_name']?>
												<?php
												if($itemloop>2){
												$itemloop=0;
												echo "<br />";
												}
												 $itemloop++;}?>
												
												</dd>
											</dl>
											
											
											<dl>
												<dt><label for="fullname">Gender: </label></dt>
												<dd>
												
												<select name="gender">
												<option value="">---Select ---</option>
												<option value="male" <?php if($row_deals['gender']=='male'){echo "selected='selected'";}?>>Male</option>
												<option value="female" <?php if($row_deals['gender']=='female'){echo "selected='selected'";}?>>Female</option>
												</select>
												</dd>
											</dl>
											
											<dl>
												<dt><label for="fullname">Age Range: </label></dt>
												<dd>
												
												<select name="age_range">
												
												
												<option value="">---Select ---</option>
												<option value="0" <?php if($row_deals['age_range']=='0'){echo "selected='selected'";}?>>Under 25</option>
												<option value="1" <?php if($row_deals['age_range']=='1'){echo "selected='selected'";}?>>25 - 35</option>
												<option value="2" <?php if($row_deals['age_range']=='2'){echo "selected='selected'";}?>>35 - 45</option>
												<option value="3" <?php if($row_deals['age_range']=='3'){echo "selected='selected'";}?>>45 - 55</option>
												<option value="4" <?php if($row_deals['age_range']=='4'){echo "selected='selected'";}?>>55 - 65</option>
												<option value="5" <?php if($row_deals['age_range']=='5'){echo "selected='selected'";}?>>Over 65</option>
												</select>
												
												
											
												
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
												<dt><label for="email">Email Address: </label></dt>
												<dd><input class="lf" name="email" id="email" type="text" value="<?php echo $row_deals[email]?>" />
												<span class="validate_error" id="err4"></span></dd>
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

