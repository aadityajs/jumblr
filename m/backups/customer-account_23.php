<?php
include("include/header.php");
$user_id = $_SESSION["user_id"];
?>
<div id="container">
<div id="leftcol">
<div class="deal_info">
<div class="top_about">
<p>Customer Account</p>
</div>
<div class="clear"></div>
<div class="midbg">
<div class="today_deal">
<div class="blue_text">Welcome</div>
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
<?php

	
	if(strtolower($_SERVER['REQUEST_METHOD']) == 'post' && $_POST["btnProfile"]=='Submit')
	{
	
		$user_id = $_SESSION["user_id"];
		$location_id = $_POST["location"];
		$cat_id = $_POST["category"];
		
		if($location_id == '' and $cat_id == '')
		{
			$msg = 'No field selected. Please select a field';
			$flag=1;
		}
		
		if($flag != 1)
		{
			if($location_id != '')
			{
				$sql_profile_select_city = "SELECT * FROM ".TABLE_USER_SUBSCRIPTION." WHERE user_id=".$user_id." and city_id=".$location_id;
				$result_profile_select_city = mysql_query($sql_profile_select_city);
				$count_profile_select_city = mysql_num_rows($result_profile_select_city);
				
				if($count_profile_select_city > 0)
				{
					$msg = 'Selected city already exists';
					$flag=1;
				}
			}
			
			if($flag != 1)
			{
				if($cat_id != '')
				{
					$sql_profile_select_cat = "SELECT * FROM ".TABLE_USER_PREFERENCE." WHERE user_id=".$user_id." and category_id=".$cat_id;
					$result_profile_select_cat = mysql_query($sql_profile_select_cat);
					$count_profile_select_cat = mysql_num_rows($result_profile_select_cat);
					
					if($count_profile_select_cat > 0)
					{
						$msg = 'Selected category already exists';
						$flag=1;
					}
				}
				
			}
		}
		
		if($flag != 1)
		{
			if($location_id != '')
			{
				$sql_profile_insert_city = "INSERT INTO ".TABLE_USER_SUBSCRIPTION."(user_id,city_id) VALUES("."'".$user_id."',"."'".$location_id."'".")";
				mysql_query($sql_profile_insert_city);
			}
			
			if($cat_id != '')
			{
				$sql_profile_insert_cat = "INSERT INTO ".TABLE_USER_PREFERENCE."(user_id,category_id) VALUES("."'".$user_id."',"."'".$cat_id."'".")";
				mysql_query($sql_profile_insert_cat);
			}
		
		
			$msg= 'Profile successfully updated';
			$flag=2;
		}
		
	
	}
	
	
	
	if(isset($_POST['tab']))
		$tab_no = $_POST['tab'];
	else
		$tab_no = 2;	
?>
	<script type="text/javascript" language="javascript">
	<!--
		function show_tab(ID)
		{
			for(i=1; i<=5; i++)
			{
				document.getElementById("myaccount_"+i).style.display = "none";
				/*document.getElementById("tab_"+i).style.backgroundPosition = "";
				document.getElementById("stab_"+i).style.backgroundPosition = "";
				document.getElementById("stab_"+i).style.color = "";
				document.getElementById("tab_"+i).style.color = "";*/
			}
			document.getElementById("myaccount_"+ID).style.display = "block";
			/*document.getElementById("tab_"+ID).style.backgroundPosition = "0% -29px";
			document.getElementById("stab_"+ID).style.backgroundPosition = "100% -29px";
			document.getElementById("tab_"+ID).style.color = "#000";
			document.getElementById("stab_"+ID).style.color = "#000";*/
		}
		//-->
	</script>
<script type="text/javascript">

	function editFields(linkElem){
		var parent=$(linkElem).parents('table');
		var parentId=parent.attr('id');
		parent.hide();
		$('#'+parentId+'Form').show();
		}
	
	
	function cancelFields(linkElem){var parent=$(linkElem).parents('form');var parentId=parent.attr('id');var tableTextId=parentId.substring(0,parentId.length-4);parent.hide();$('#'+tableTextId).show();var textFields=parent.find('input[type="text"]');textFields.each(function(i){var span=$('span[id="'+$(this).attr('name')+'"]');if(span.size()==1){var value=span.text();$(this).val(value);}});if($('#editGenderField').size()==1){var name=$('#editGenderField').attr('name');$('#editGenderField').val($('span[id="'+name+'"]').attr('class'));}
	if($('#jRegisterBirthdayDay').size()==1){var spanBirth=$('#birthday');$('select[name="birthDay"]').val(spanBirth.text().substring(0,2));$('select[name="birthMonth"]').val(spanBirth.attr('class'));$('select[name="birthYear"]').val(spanBirth.text().substring(6));}
	clearPwdFields(parent);clearErrors(true);}

</script>


<div style="width:700px; float: left; margin: 0 auto;">
    <div class="TabbedPanels">
      <ul>
		<li><a href="javascript: show_tab(3);" id="tab_3">General</a></li>  
		<li><a href="javascript: show_tab(4);" id="tab_4">Security</a></li> 
		<li><a href="javascript: show_tab(5);" id="tab_5">Notification</a></li>     
        <li><a href="javascript: show_tab(1);" id="tab_1">My Order</a></li>
        <li><a href="javascript: show_tab(2);" id="tab_2">My Credit</a></li>
        
        
               
       </ul>
	 </div>
  
    <div class="TabbedPanels1" id="myaccount_1">
		<h4>My orders</h4><hr>
		<p><b>You still have not bought a deal</b></p>
		<br><br><br><br>
    </div>

	<div class="TabbedPanels1" id="myaccount_2" style="display:none;">
		
		<h4>Credit</h4><hr>
		<p><b>You have no credit on your account</b></p>
		<br><br><br><br>
		
		<h1>Reward credits: how do they	work?*</h1>
		<p><b>Why should I recommend a friend?</b></p>
		<br>
		<p>The chance of a deal having enough participants increases with every new
		user that joins Groupon. Therefore you should invite as many of your
		friends as possible, so that you have the greatest chance of getting
		your favourite deal! If you already have an account with us every time
		someone you have recommended buys their first deal, we will reward you
		with &pound;6! 
		</p>
		<br>
		<br>
		<p><b>How can I recommend a friend to Groupon?</b></p>
		<br>
		<p>
		There are many opportunities to recommend a friend to Groupon. On every
		deal you can find a link, which you can use to send invitations to
		friends using Twitter, Facebook or Email. On your Personal
		Recommendation Page you can find your personal reference link, which you
		can post anywhere on the internet to get people to join up. We reserve
		the right to refuse or withdraw credit when the recommendation function
		is being abused.
		</p>
		<br>
		<br>
		<p><b>I have not received my reward credit!</b></p>
		<br>
		<p>
		Your friend needs to create an account for the first time and have
		purchased their first deal within 72 hours of the referral. Your reward
		will appear as "delayed": if after seven days the deal they bought has
		not been cancelled or withdrawn, and your friends payment went through
		successfully, we will credit your account with &pound;6, and your next deal
		will cost &pound;6 less!
		</p>
		<br>
		<br>
		<p><b>How long is the credit valid for?</b></p>
		<br>
		<p>Your credit is valid for a whole six months. Keep this in mind!</p>
		<br>
		<br>
		<p><b>How can I spend my credit?</b></p>
		<br>
		<p>
		You can use your credit on any deal with us, and you redeem it on the
		payment page. If your credit is worth more than the cost of the deal
		because you have been recommending lots of friends, then whatever is
		left over can be redeemed on your next deal, unless it has expired. So
		be sure to tick the box to use your credit when you checkout.
		</p>
		<br>
		<br>
		
		
    </div>
	
	<div class="TabbedPanels1" id="myaccount_3" style="display:none;">
		
		<?php

			$sql_user = "SELECT * FROM ".TABLE_USERS." WHERE user_id=".$user_id;
			$result_user = mysql_query($sql_user);
			$row_user = mysql_fetch_array($result_user);
			
			//var_dump($row_user);
			
			$title = trim($row_user["title"]);
			$fname = trim($row_user["first_name"]);
			$lname = trim($row_user["last_name"]);
			
			$add1 = $row_user["address1"];
			$add2 = $row_user["address2"];
			$city = $row_user["city"];
			$country = $row_user["country"];
			$phno = $row_user["phone_no"];
			
			$email = $row_user["email"];
			
			$current_password = $row_user["password"];
			
			//$image = $row_user["user_img"];
		
		?>
		
		<table class="myaccount" id="name">
			<tr>
			<td style="float:left; width: 100px; margin: 0 auto;"><p>Name:</p></td>
			<td style="float:left; width: 170px; margin: 0 auto;"><p><?php echo $title.' '.$fname.' '.$lname; ?></p></td>
			<td style="float:right; width: 30px; margin: 0 30px;"><p><a onclick="editFields(this); return false;" href="">Edit</a></p></td>
			</tr>
		</table>
		<?php 
		
			$flag = 0;
			$msg ='';
	if(strtolower($_SERVER['REQUEST_METHOD']) == 'post' && $_POST["btnNameUpdate"]=='Save Changes')
	{
		//$image = $_FILES["image"]["name"];
		
		$fname = $_POST["fname"];
		$lname = $_POST["lname"];
		$email = $_POST["email"];
		$npassword = $_POST["password"];
		

		
		if($flag == 0)
		{
			if($fname == '')
			{
				$msg = 'Please enter first name';
				$flag=1;
			}
		}
		
		if($flag == 0)
		{
			if($lname == '')
			{
				$msg = 'Please enter last name';
				$flag=1;
			}
		}
					
		if($flag == 0)
		{
			if($npassword == '')
			{
				$msg = 'Please enter password';
				$flag=1;
			}
		}
				
		if($flag == 0 && $current_password == md5($npassword)) {
			
			
				$sql_name_update = "UPDATE ".TABLE_USERS." SET first_name='".$fname."', last_name='".$lname."' WHERE user_id=".$user_id;
				mysql_query($sql_name_update);
				$msg = 'Customer updated successfully';
				$flag =2;
	
		}
		
		
	}
		
		?>
		<form name="frmname" id="nameForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" style="display:none;">

			<table width="450" border="0" cellspacing="0" cellpadding="0" class="blue_box" >
    <tr>
      <td>
      
      <?php
		if(strtolower($_SERVER['REQUEST_METHOD']) == 'post' && $_POST["btnNameUpdate"]=='Save Changes' && $flag!=0) { 
		?>
			<div style="height: 25px; width: auto; margin: 10px; padding: 5px; border: 1px dashed <?php if ($flag == 1) {echo "red";} else {echo "green"; } ?>;">
				<?php if($flag==1) { ?>
				<label style="color: #CC0000; font-weight: bold;"><?=$msg?></label>
				<?php } ?>
				<?php if($flag==2) { ?>
				<label style="color: #006600; font-weight: bold;"><?=$msg?></label>
				<?php }	?>
			</div>
		<?php }	?>
      
      <table width="450" border="0" align="left" cellpadding="3" cellspacing="3">
          <!--<tr>
            <td width="450"><p>Note: Name can only be change every 6 months!</p></td>
          </tr>-->
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="51%">First name </td>
                <td width="49%">&nbsp;</td>
              </tr>
              <tr>
                <td><input type="text" name="fname" id="fname" value="<?php if(isset($_POST["btnNameUpdate"])) { echo $_POST["fname"];}else{ echo $fname;} ?>" class="text_box1"/></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>Last name </td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><input type="text" name="lname" id="lname" value="<?php if(isset($_POST["btnNameUpdate"])) { echo $_POST["lname"];}else{ echo $lname;} ?>" class="text_box1"/></td>
                <td>&nbsp;</td>
              </tr>
              
            </table></td>
          </tr>

          <tr>
            <td>To save these new settings, please enter your GeeLaza password</td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="51%">Password</td>
                <td width="49%">&nbsp;</td>
              </tr>
              <tr>
                <td><input type="password" name="password" class="text_box1"/></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><table width="300" border="0" align="left" cellpadding="0" cellspacing="0">
              <tr>
                <td><input type="submit" name="btnNameUpdate" class="save_btn" value="Save Changes"/></td>
                <td><input type="button" name="cancel" class="save_btn" value="Cancel" onclick="cancelFields(this); return false;"/></td>
              </tr>
            </table></td>
          </tr>
      </table></td>
    </tr>
  </table>
		</form>
		
		
		
		
		<table class="myaccount" id="address">
			<tr>
				<td style="float:left; width: 100px; margin: 0 auto;"><p>Address:</p></td>
				<td style="float:left; width: 170px; margin: 0 auto;"><p><?php echo $add1.', '.$add2; ?>, <strong><?php echo $city; ?>, <?php echo $country; ?></strong></p><p><?php echo $phno; ?></p></td>
				<td style="float:right; width: 30px; margin: 0 30px;"><p><a onclick="editFields(this); return false;" href="">Edit</a></p></td>
			</tr>
		</table>
		
		<?php 
		
			$flag = 0;
			$msg ='';
	if(strtolower($_SERVER['REQUEST_METHOD']) == 'post' && $_POST["btnAddressUpdate"]=='Save Changes')
	{
		//$image = $_FILES["image"]["name"];
		
		$add1 = $_POST["add1"];
		$add2 = $_POST["add2"];
		$city = $_POST["city"];
		$country = $_POST["country"];
		$phno = $_POST["phno"];
		
		$apassword = $_POST["password"];
		
		//$rpassword = $_POST["rpassword"];
		
		if($flag == 0)
		{
			if($add1 == '')
			{
				$msg = 'Please enter street address';
				$flag=1;
			}
		}
		
		if($flag == 0)
		{
			if($add2 == '')
			{
				$msg = 'Please enter street address 2';
				$flag=1;
			}
		}
		
		if($flag == 0)
		{
			if($city == '')
			{
				$msg = 'Please enter city';
				$flag=1;
			}
		}
		
		if($flag == 0)
		{
			if($country == '')
			{
				$msg = 'Please enter country';
				$flag=1;
			}
		}
		
		if($flag == 0)
		{
			if($phno == '')
			{
				$msg = 'Please enter phone number';
				$flag=1;
			}
			elseif ( !is_numeric($phno)) {
				$msg = 'Please enter numeric digit in phone number';
				$flag=1;
			}
		}
		
		
		
		if($flag == 0)
		{
			if($apassword == '')
			{
				$msg = 'Please enter password';
				$flag=1;
			}
		}
		
		
		
		if($flag == 0 && $current_password == md5($apassword)) {
			
			
				$sql_address_update = "UPDATE ".TABLE_USERS." SET address1='".$add1."', address2='".$add2."', city='".$city."', country='".$country."', phone_no='".$phno."' WHERE user_id=".$user_id;
				mysql_query($sql_address_update);
				$msg = 'Address successfully updated';
				$flag =2;
	
		}
		
		
	}
		
		?>
		
		<form name="frmaddress" id="addressForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" style="display:none;">

	<table width="450" border="0" cellspacing="0" cellpadding="0" class="blue_box" >
   	 <tr>
      <td>
      
      <?php
		if(strtolower($_SERVER['REQUEST_METHOD']) == 'post' && $_POST["btnAddressUpdate"]=='Save Changes' && $flag!=0) { 
		?>
			<div style="height: 25px; width: auto; margin: 10px; padding: 5px; border: 1px dashed <?php if ($flag == 1) {echo "red";} else {echo "green"; } ?>;">
				<?php if($flag==1) { ?>
				<label style="color: #CC0000; font-weight: bold;"><?=$msg?></label>
				<?php } ?>
				<?php if($flag==2) { ?>
				<label style="color: #006600; font-weight: bold;"><?=$msg?></label>
				<?php }	?>
			</div>
		<?php }	?>
      
      <table width="450" border="0" align="left" cellpadding="3" cellspacing="3">
         
          <tr>
            <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="51%">Street Address:</td>
                <td width="49%">&nbsp;</td>
              </tr>
              <tr>
                <td><input type="text" name="add1" id="add1" value="<?php if(isset($_POST["btnAddressUpdate"])) { echo $_POST["add1"];}else{ echo $add1;} ?>" class="text_box1"/></td>
                <td>&nbsp;</td>
              </tr>
              
              <tr>
                <td width="51%">Street Address 2:</td>
                <td width="49%">&nbsp;</td>
              </tr>
              <tr>
                <td><input type="text" name="add2" id="add2" value="<?php if(isset($_POST["btnAddressUpdate"])) { echo $_POST["add2"];}else{ echo $add2;} ?>" class="text_box1"/></td>
                <td>&nbsp;</td>
              </tr>
              
              <tr>
                <td width="51%">City:</td>
                <td width="49%">&nbsp;</td>
              </tr>
              <tr>
                <td><input type="text" name="city" id="city" value="<?php if(isset($_POST["btnAddressUpdate"])) { echo $_POST["city"];}else{ echo $city;} ?>" class="text_box1"/></td>
                <td>&nbsp;</td>
              </tr>
              
              <tr>
                <td width="51%">Country:</td>
                <td width="49%">&nbsp;</td>
              </tr>
              <tr>
                <td><input type="text" name="country" id="country" value="<?php if(isset($_POST["btnAddressUpdate"])) { echo $_POST["country"];}else{ echo $country;} ?>" class="text_box1"/></td>
                <td>&nbsp;</td>
              </tr>
              
              <tr>
                <td width="51%">Phone No.:</td>
                <td width="49%">&nbsp;</td>
              </tr>
              <tr>
                <td><input type="text" name="phno" id="phno" value="<?php if(isset($_POST["btnAddressUpdate"])) { echo $_POST["phno"];}else{ echo $phno;} ?>" class="text_box1"/></td>
                <td>&nbsp;</td>
              </tr>
              
            </table>
            </td>
          </tr>

          <tr>
            <td>To save these new settings, please enter your GeeLaza password</td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="51%">Password</td>
                <td width="49%">&nbsp;</td>
              </tr>
              <tr>
                <td><input type="password" name="password" class="text_box1"/></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><table width="300" border="0" align="left" cellpadding="0" cellspacing="0">
              <tr>
                <td><input type="submit" name="btnAddressUpdate" class="save_btn" value="Save Changes"/></td>
                <td><input type="button" name="cancel" class="save_btn" value="Cancel" onclick="cancelFields(this); return false;"/></td>
              </tr>
            </table></td>
          </tr>
      </table></td>
    </tr>
  </table>
		</form>
		
		
		
		<table class="myaccount" id="email">
			<tr>
				<td style="float:left; width: 100px; margin: 0 auto;"><p>Email:</p></td>
				<td style="float:left; width: 170px; margin: 0 auto;"><p><?php echo $email; ?></p></td>
				<td style="float:right; width: 30px; margin: 0 30px;"><p><a onclick="editFields(this); return false;" href="">Edit</a></p></td>
			</tr>
		</table>
				<?php 
		
			$flag = 0;
			$msg ='';
	if(strtolower($_SERVER['REQUEST_METHOD']) == 'post' && $_POST["btnEmailUpdate"]=='Save Changes')
	{
		//$image = $_FILES["image"]["name"];
		
		$email = $_POST["email"];
		
		$epassword = $_POST["password"];
		
		//$rpassword = $_POST["rpassword"];
		
		if($flag == 0)
		{
			if($email == '')
			{
				$msg = 'Please enter email address';
				$flag=1;
			}
		}
		
		
		if($flag == 0)
		{
			if($epassword == '')
			{
				$msg = 'Please enter password';
				$flag=1;
			}
		}
		
		
		
		if($flag == 0 && $current_password == md5($epassword)) {
			
			
				$sql_email_update = "UPDATE ".TABLE_USERS." SET email='".$email."' WHERE user_id=".$user_id;
				mysql_query($sql_email_update);
				$msg = 'Email successfully updated';
				$flag =2;
	
		}
		
		
	}
		
		?>
		
		<form name="frmemail" id="emailForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" style="display:none;">
	
	<table width="450" border="0" cellspacing="0" cellpadding="0" class="blue_box" >
   	 <tr>
      <td>
      
      <?php
		if(strtolower($_SERVER['REQUEST_METHOD']) == 'post' && $_POST["btnEmailUpdate"]=='Save Changes' && $flag!=0) { 
		?>
			<div style="height: 25px; width: auto; margin: 10px; padding: 5px; border: 1px dashed <?php if ($flag == 1) {echo "red";} else {echo "green"; } ?>;">
				<?php if($flag==1) { ?>
				<label style="color: #CC0000; font-weight: bold;"><?=$msg?></label>
				<?php } ?>
				<?php if($flag==2) { ?>
				<label style="color: #006600; font-weight: bold;"><?=$msg?></label>
				<?php }	?>
			</div>
		<?php }	?>
      
      <table width="450" border="0" align="left" cellpadding="3" cellspacing="3">
         
          <tr>
            <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="51%">Email </td>
                <td width="49%">&nbsp;</td>
              </tr>
              <tr>
                <td><input type="text" name="email" id="email" value="<?php if(isset($_POST["btnEmailUpdate"])) { echo $_POST["email"];}else{ echo $email;} ?>" class="text_box1"/></td>
                <td>&nbsp;</td>
              </tr>
            </table>
            </td>
          </tr>

          <tr>
            <td>To save these new settings, please enter your GeeLaza password</td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="51%">Password</td>
                <td width="49%">&nbsp;</td>
              </tr>
              <tr>
                <td><input type="password" name="password" class="text_box1"/></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><table width="300" border="0" align="left" cellpadding="0" cellspacing="0">
              <tr>
                <td><input type="submit" name="btnEmailUpdate" class="save_btn" value="Save Changes"/></td>
                <td><input type="button" name="cancel" class="save_btn" value="Cancel" onclick="cancelFields(this); return false;"/></td>
              </tr>
            </table></td>
          </tr>
      </table></td>
    </tr>
  </table>
		</form>
		

	</div>


	
	<div class="TabbedPanels1" id="myaccount_4" style="display:none;">
		
		
		<table class="myaccount" id="pass">
			<tr>
				<td style="float:left; width: 100px; margin: 0 auto;"><p>Password:</p></td>
				<td style="float:left; width: 170px; margin: 0 auto;"><p>***************</p></td>
				<td style="float:right; width: 30px; margin: 0 30px;"><p><a onclick="editFields(this); return false;" href="">Edit</a></p></td>
			</tr>
      	</table>
      	
  <?php 
		
			$flag = 0;
			$msg ='';
	if(strtolower($_SERVER['REQUEST_METHOD']) == 'post' && $_POST["btnPassUpdate"]=='Save Changes')
	{
		//$image = $_FILES["image"]["name"];
		
		$new_password = $_POST["password"];
		$rpassword = $_POST["rpassword"];
		
		$ppassword = $_POST["ppassword"];
		
		if($flag == 0)
		{
			if($new_password == '')
			{
				$msg = 'Please enter new password';
				$flag=1;
			}
		}
		
		if($flag == 0)
		{
			if($rpassword == '')
			{
				$msg = 'Please retype new password';
				$flag=1;
			}
		}
		
		
		if($flag == 0)
		{
			if($ppassword == '')
			{
				$msg = 'Please current enter password';
				$flag=1;
			}
		}
		
		
		
		if($flag == 0 && $current_password == md5($ppassword)) {
			
			
				$sql_pass_update = "UPDATE ".TABLE_USERS." SET password='".md5($new_password)."' WHERE user_id=".$user_id;
				mysql_query($sql_pass_update);
				$msg = 'Password successfully updated';
				$flag =2;
	
		}
		
		
	}
		
		?>
      	
      <form name="frmpass" id="passForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" style="display:none;">
		
			
	<table width="450" border="0" cellspacing="0" cellpadding="0" class="blue_box" >
   	 <tr>
      <td>
      
		<?php
		if(strtolower($_SERVER['REQUEST_METHOD']) == 'post' && $_POST["btnPassUpdate"]=='Save Changes' && $flag!=0) { 
		?>
			<div style="height: 25px; width: auto; margin: 10px; padding: 5px; border: 1px dashed <?php if ($flag == 1) {echo "red";} else {echo "green"; } ?>;">
				<?php if($flag==1) { ?>
				<label style="color: #CC0000; font-weight: bold;"><?=$msg?></label>
				<?php } ?>
				<?php if($flag==2) { ?>
				<label style="color: #006600; font-weight: bold;"><?=$msg?></label>
				<?php }	?>
			</div>
		<?php }	?>
      
      <table width="450" border="0" align="left" cellpadding="3" cellspacing="3">
         
          <tr>
            <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="51%">New Password </td>
                <td width="49%">&nbsp;</td>
              </tr>
              <tr>
                <td><input type="password" name="password" id="password" class="text_box1"/></td>
                <td>&nbsp;</td>
              </tr>
              
              <tr>
                <td width="51%">Retype Password </td>
                <td width="49%">&nbsp;</td>
              </tr>
              <tr>
                <td><input type="password" name="rpassword" id="rpassword" class="text_box1"/></td>
                <td>&nbsp;</td>
              </tr>
            </table>
            </td>
          </tr>

          <tr>
            <td>To save these new settings, please enter your GeeLaza password</td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="51%">Password</td>
                <td width="49%">&nbsp;</td>
              </tr>
              <tr>
                <td><input type="password" name="ppassword" class="text_box1"/></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><table width="300" border="0" align="left" cellpadding="0" cellspacing="0">
              <tr>
                <td><input type="submit" name="btnPassUpdate" class="save_btn" value="Save Changes"/></td>
                <td><input type="button" name="cancel" class="save_btn" value="Cancel" onclick="cancelFields(this); return false;"/></td>
              </tr>
            </table></td>
          </tr>
      </table></td>
    </tr>
  </table>
		</form>
		
		
	</div>
	
	<div class="TabbedPanels1" id="myaccount_5" style="display:none;">
		
	<table class="myaccount" id="noti">
			<tr>
				<td style="float:left; width: 100px; margin: 0 auto;"><p>Notifications</p></td>
				<td style="float:left; width: 170px; margin: 0 auto;"><p>Test</p></td>
				<td style="float:right; width: 30px; margin: 0 30px;"><p><a onclick="editFields(this); return false;" href="">Edit</a></p></td>
			</tr>
     </table>	
     
	<form name="frmnotification" id="notiForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" style="display:none;">
	
	<table width="450" border="0" cellspacing="0" cellpadding="0" class="blue_box" >
   	 <tr>
      <td>
      
      <?php
		if(strtolower($_SERVER['REQUEST_METHOD']) == 'post' && $_POST["btnNotiUpdate"]=='Save Changes' && $flag!=0) { 
		?>
			<div style="height: 25px; width: auto; margin: 10px; padding: 5px; border: 1px dashed <?php if ($flag == 1) {echo "red";} else {echo "green"; } ?>;">
				<?php if($flag==1) { ?>
				<label style="color: #CC0000; font-weight: bold;"><?=$msg?></label>
				<?php } ?>
				<?php if($flag==2) { ?>
				<label style="color: #006600; font-weight: bold;"><?=$msg?></label>
				<?php }	?>
			</div>
		<?php }	?>
      
      <table width="450" border="0" align="left" cellpadding="3" cellspacing="3">
         
          <tr>
            <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="51%">Email </td>
                <td width="49%">&nbsp;</td>
              </tr>
              <tr>
                <td>
                	
                	<label > Where I want my deals </label><br />
					<select name="location" id="location" style="width:230px;">
					<option id="" value=""> Select location</option>
					<?php
						$sql_locs = "SELECT * FROM ".TABLE_CITIES;
						$result_locs = mysql_query($sql_locs);
						while($row_locs = mysql_fetch_array($result_locs))
						{
					?>
							<option id="<?=$row_locs["city_id"]?>" value="<?=$row_locs["city_id"]?>"><?=$row_locs["city_name"]?></option>
					<?php
						}
					?>
					</select>
                
                </td>
                <td>&nbsp;</td>
              </tr>
            </table>
            </td>
          </tr>

          <tr>
            <td>To save these new settings, please enter your GeeLaza password</td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="51%">Password</td>
                <td width="49%">&nbsp;</td>
              </tr>
              <tr>
                <td><input type="password" name="password" class="text_box1"/></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><table width="300" border="0" align="left" cellpadding="0" cellspacing="0">
              <tr>
                <td><input type="submit" name="btnNotiUpdate" class="save_btn" value="Save Changes"/></td>
                <td><input type="button" name="cancel" class="save_btn" value="Cancel" onclick="cancelFields(this); return false;"/></td>
              </tr>
            </table></td>
          </tr>
      </table></td>
    </tr>
  </table>
		</form>
		
		
	</div>
	
	
  </div>











<!-- 
<label><b>Change Profile Picture</b></label> <?php
if($image == '')
{
	?> <img src="images/user_sidebar.png"
	style="height: 60px; width: 60px;" /><br />
<br />
	<?php
}
else
{
	?> <img src="<?php echo PROFILE_IAMGE_PATH.$image;?>"
	style="height: 60px; width: 60px;" /><br />
<br />
	<?php
}
?> <input type="file" name="image" id="image" value=""
	style="width: 220px; height: 25px;" /><br />
<br />
<br />
<br />
 -->






</div>

<div class="clear"></div>	
<br/><br/><br/>
</div>
</div>
</div>
<?php include ('include/sidebar.php'); ?>
</div>             

<?php include("include/footer.php"); ?>
