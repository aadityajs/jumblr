<?php
include("include/header.php");

/*
 * if(strtolower($_POST["btnRegister"])=='submit')
{
	$dob = $_POST["year"].'-'.$_POST["month"].'-'.$_POST["day"];
	$_POST["dob"] = $dob;
	$_POST["reg_type"] = 'temp_merchant';
	$date = date('Y-m-d');

	$sql_insert_merchant = "INSERT INTO ".TABLE_USERS."(company_name,address1,city,zip,state,email,phone_no,password,dob,reg_type,date_added,website,country,pref_id,status)
							VALUES('".$_POST["company_name"]."','".$_POST["address1"]."','".$_POST["city"]."','".$_POST["zip"]."','".$_POST["county"]."','".$_POST["email"]."','".$_POST["phone_no"]."','".$_POST["password"]."','".$_POST["dob"]."','".$_POST["reg_type"]."','".$date."','".$_POST["website"]."','".$_POST["country"]."','".$_POST["dealcity"]."',1)";
	mysql_query($sql_insert_merchant);
	$GLOBALS["reg_msg"] = 'Merchant registration is successfull';
	//header('location:'.SITE_URL.'merchant_thanku.php');
}
 *
 */

if(strtolower($_POST["btnLogin"])=='login')
{
	$email = $_POST["email"];
	$password = $_POST["password"];

	$sql_merchant = "SELECT * FROM ".TABLE_USERS." WHERE email='".$email."' and password='".$password."' and reg_type='merchant'";
	$result_merchant = mysql_query($sql_merchant);
	$count_merchant = mysql_num_rows($result_merchant);
	if($count_merchant>0)
	{
		$row_merchant = mysql_fetch_array($result_merchant);
		$user_id = $row_merchant["user_id"];
		$_SESSION["muser_id"] = $user_id;
		header('location:merchant_home.php');
	}
}

?>


<?php
	if($GLOBALS['reg_errmsg']){
	echo '<div class="error_box" style="font-size:15px;">'.$GLOBALS['reg_errmsg'].'</div>' ;
	$GLOBALS['reg_errmsg']="";
	}


	if($GLOBALS['reg_msg']){
	echo '<div class="valid_box" style="font-size:15px;">'.$GLOBALS['reg_msg'].'</div>' ;
	$GLOBALS['reg_msg']="";
	}
?>





<div id="container">
<div id="leftcol">
<div class="deal_info">
<div class="green_curv10"></div>
<div class="clear"></div>
<div class="green_curv30">
<div class="today_deal">
<div class="register_box1">

<div class="clear"></div>
<h6 style="margin:-15px 0; background:#fff; padding:0px 0 20px 0; color: #404040; font: bold 30px/35px Arial, Helvetica, sans-serif;" >Get Your Business Featured</h6>
<!-- <div class="txt1"><strong>All the require fields are represented by(<span style="color:red !important;">*</span>)</strong></div>
<div class="txt1" style="padding-bottom: 10px;">Fill out the following form and we'll contact you shortly.</div> -->
<form name="mer_register" action="<?php echo SITE_URL; ?>merchant_thanku.php" method="post" onsubmit="javascript: return ValidateMerRegisterForm();" style="background:#fff; margin:0px; padding:0px; border:1px solid #fff;">



<!-- ###################################### Form starts ################################################# -->



<div class="Feature">
<div class="txt1">Contact information <span>(<span style="color:#FF0000;"><strong>* </strong></span> indicates required fields)</span></div>
<div class="clear"></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="Feature_box">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="28%">Your name <span>*</span></td>
        <td width="35%"><input type="text" name="company_md_fname" id="company_md_fname" value="<?php if(isset($_POST) && $flag ==1){ echo $_POST["md_fname"];} ?>" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?> class="text_boxgo9" /></td>
        <td width="37%"><input type="text" name="company_md_lname" id="company_md_lname" value="<?php if(isset($_POST) && $flag ==1){ echo $_POST["md_lname"];} ?>" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?> class="text_boxgo9"/></td>
		<tr>
			<td></td>
			<td colspan="2">
				<div id='mer_register_company_md_name_errorloc' class="error_orange"></div>
			</td>
		</tr>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td>Your job title <span>*</span></td>
        <td colspan="2">
			<input type="text" name="company_job_type" id="company_job_type" value="<?php if(isset($_POST) && $flag ==1){ echo $_POST["job_type"];} ?>" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?> class="text_boxgo" />
			<div id='mer_register_company_job_type_errorloc' class="error_orange"></div>
		</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td>Your email <span>*</span></td>
        <td colspan="2">
        	<input type="text" name="email" id="email" onkeyup="javascript: return validateEmail(this.value);" onblur="return ajaxReq(this.value); " value="<?php if(isset($_POST) && $flag==1){ echo $_POST["email"];} ?>" class="text_boxgo" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/>
		    <div id='mer_register_email_errorloc' class="error_orange"></div>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td>Your phone <span>*</span></td>
        <td colspan="2">
			<input type="text" name="phone_no" id="phone_no" value="<?php if(isset($_POST) && $flag==1){ echo $_POST["phone_no"];} ?>" class="text_boxgo" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/>
            <div id='mer_register_phone_no_errorloc' class="error_orange"></div>
		</td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
        </tr>

    </table></td>
  </tr>
  <tr>
    <td>
	<div class="txt1">Business details</div>
	<div class="clear"></div>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="28%">Business name <span>*</span></td>
        <td width="72%">
        	<input type="text" name="company_name" id="company_name" value="<?php if(isset($_POST) && $flag ==1){ echo $_POST["company_name"];} ?>" class="text_boxgo" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/>
            <div id='mer_register_company_name_errorloc' class="error_orange"></div>
        </td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Business website <span>*</span></br><span style="padding:0; margin:0; font:normal 12px/17px Arial, Helvetica, sans-serif; color: #757575; font-style: italic;">(or Facebook fan page)</span></td>
        <td>
        	<input type="text" name="website" id="website" value="<?php if(isset($_POST) && $flag==1){ echo $_POST["website"];} ?>" class="text_boxgo" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/>
            <div id='mer_register_website_errorloc' class="error_orange"></div>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Post code <span>*</span></td>
        <td>
			<input type="text" name="zip" id="zip" style="<?php if ($flag ==1) {echo 'border:1px solid red;';} ?>" value="<?php if(isset($_POST) && $flag==1){ echo $_POST["zip"];} ?>" class="text_boxgo"/>
        	<div id='mer_register_zip_errorloc' class="error_orange"></div>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Country <span>*</span></td>
        <td>
        	<div class="styled_select" style="width:450px;">
                        <select name="country" id="country" class="selectbg" style="width:468px;">
                        <option value=''> Select Country </option>

                        <?php
                            $sql_country = "SELECT * FROM ".TABLE_COUNTRIES." GROUP BY country_name";
                            $result_country = mysql_query($sql_country);
                            while($row_country = mysql_fetch_array($result_country))
                            {
                        ?>
                            <option value='<?php echo $row_country["country_id"] ?>'><?php echo $row_country["country_name"]; ?></option>
                        <?php
                            }
                        ?>
                        <option value='Other'>Other</option>
                        </select>
                        </div>
                        <div id='mer_register_country_errorloc' class="error_orange"></div>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Business type <span>*</span></br><!-- <span style="padding:0; margin:0; font:normal 12px/17px Arial, Helvetica, sans-serif; color: #757575; font-style: italic;">(check all that apply)</span> --></td>
        <td>
        				<div class="styled_select" style="width:450px;">
	                        <select name="business_type" id="business_type" class="selectbg" style="width:468px;">
	                        <option value=""> Select Business Type </option>
	                        <option value="Adventure/Outdoors">Adventure/Outdoors</option>
	                        <option value="Canvas">Canvas</option>
	                        <option value="Education/Photography">Education/Photography</option>
	                        <option value="Entertainment">Entertainment</option>
	                        <option value="Food & Beverage">Food & Beverage</option>
	                        <option value="Health & Beauty">Health & Beauty</option>
	                        <option value="Product">Product</option>
	                        <option value="Travel/Accommodation">Travel/Accommodation</option>
	                        <option value="Other Services">Other Services</option>
	                        </select>
                        </div>
                        <div id='mer_register_business_type_errorloc' class="error_orange"></div>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
		<div class="txt1">More information</div>
	   <div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10"/></div>
      <tr>
        <td>How did you hear about us? <span>*</span></td>
      </tr>
      <tr>
      <td>
	  <div class="moreinfo_box">
	  <ul>
	  <li style="width: 175px;"><input name="hear_abt_us" type="radio" value="TV"/> TV</li>
	  <li style="width: 195px;"><input name="hear_abt_us" type="radio" value="Radio"/> Radio</li>
	  <li style="width: 170px;"><input name="hear_abt_us" type="radio" value="Online Banner"/> Online Banner</li>
	  <li style="width: 120px;"><input name="hear_abt_us" type="radio" value="Search"/> Search</li>
	  <li style="width: 175px;"><input name="hear_abt_us" type="radio" value="Direct Mail"/> Direct Mail</li>
	  <li style="width: 195px;"><input name="hear_abt_us" type="radio" value="Fellow Business Owner"/> Fellow Business Owner</li>
	  <li style="width: 170px;"><input name="hear_abt_us" type="radio" value="Event/Trade Show"/> Event/Trade Show</li>
	  <li style="width: 120px;"><input name="hear_abt_us" type="radio" value="Other"/> Other</li>
	  </ul>

	  </div>

	  <div id='mer_register_hear_abt_us_errorloc' class="error_orange clear"></div>
	  </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Tell us about your business.</td>
      </tr>
      <tr>
        <td>
        	<textarea name="about" id="about" class="textareabg" style="height:100px; background: #f5f6f9;	border: 1px solid #e0e0e3;"></textarea>
        </td>
      </tr>
      <tr>
        <td><p style="margin-top: 20px;">By submitting this information you declare that the information is true, accurate and up to date. You also understand that upon submission, GeeLaza will begin the process of verifying this information, which may included, but is not limited to, perform credits, reference checks and  consumer credit checks.</p></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
       <td style="float: right;"><input type="submit" style="cursor:pointer;" class="blue_btng" value="Submit" name="btnRegister"></td>
      </tr>
    </table></td>
  </tr>
</table>
</div>

<!-- ###################################### Form ends ################################################# -->
</form>

<!-- Merchant Registration form validator starts -->

<script type="text/javascript">
function ajaxReq(str)
{
var xmlhttp;
//alert(str); die();
if (str.length==0)
  {
  document.getElementById("mer_register_email_errorloc").innerHTML="";
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
    document.getElementById("mer_register_email_errorloc").innerHTML=xmlhttp.responseText;
    alert(xmlhttp.responseText);
    //document.getElementById('email').style.border = "1px solid red";
    }
  	else {
	  document.getElementById('email').style.border = "1px solid #C8C8C8";
  	}
  }
xmlhttp.open("GET","ajax_registration.php?email="+str,true);
xmlhttp.send();
}



function validateEmail(email) {

    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!re.test(email)) {
    document.getElementById('mer_register_email_errorloc').innerHTML = 'Invalid email address';
    //document.getElementById('cust_login_lpassword_errorloc').innerHTML = '&nbsp;';
    //document.getElementById('lemail').style.border = "1px solid red";
	//document.getElementById('lpassword').style.border = "1px solid red";
    return false;
    } else {
    	document.getElementById('mer_register_email_errorloc').innerHTML = '';
        }
}

function ValidateMerRegisterForm() {
//alert('hi'); return false;
	var company_md_fname = document.getElementById('company_md_fname').value;
	var company_md_lname = document.getElementById('company_md_lname').value;
	var company_job_type = document.getElementById('company_job_type').value;
	var email = document.getElementById('email').value;
	var phone_no = document.getElementById('phone_no').value;
	var company_name = document.getElementById('company_name').value;
	var website = document.getElementById('website').value;
	var zip = document.getElementById('zip').value;
	var country = document.getElementById('country').value;
	var hear_abt_us = document.getElementsByName('hear_abt_us').value;

	//var company_trading_name = document.getElementById('company_trading_name').value;
	//var company_type = document.getElementById('company_type').value;
	//var company_reg_no = document.getElementById('company_reg_no').value;

	//var fname = document.getElementById('fname').value;
	//var lname = document.getElementById('lname').value;

	//var address1 = document.getElementById('address1').value;
	//var city = document.getElementById('city').value;
	//var county = document.getElementById('county').value;
	var business_type = document.getElementById('business_type').value;

	//var business_start_date = document.getElementById('business_start_date').value;

	//var category = document.getElementById('category').value;
	//var dealcity = document.getElementById('dealcity').value;



	if ( company_md_fname == "" || company_md_lname == "" || business_type == "" || company_job_type == "" || email == "" ||  phone_no == "" || company_name == "" || website == "" || zip == "" || country == "" || hear_abt_us == "" ) {
		//alert ("asdasda");
		document.getElementById('mer_register_company_md_name_errorloc').innerHTML = "Please enter your full name";
		document.getElementById('mer_register_company_job_type_errorloc').innerHTML = "Please enter job title of your company";
		document.getElementById('mer_register_phone_no_errorloc').innerHTML = "Please enter a valid phone number minimum of 8 numbers.";
		document.getElementById('mer_register_email_errorloc').innerHTML = "Please enter a valid email address";
		document.getElementById('mer_register_company_name_errorloc').innerHTML = "Please enter business name";
		document.getElementById('mer_register_website_errorloc').innerHTML = "Please enter a valid website";
		document.getElementById('mer_register_zip_errorloc').innerHTML = "Please enter a valid post code";
		document.getElementById('mer_register_country_errorloc').innerHTML = "Please select a country";
		document.getElementById('mer_register_hear_abt_us_errorloc').innerHTML = "Please select from where you have heard about us";




		//document.getElementById('mer_register_fname_errorloc').innerHTML = "Please enter a valid first name & last name";

		//document.getElementById('mer_register_lname_errorloc').innerHTML = "Please enter a valid last name";

		//document.getElementById('mer_register_address1_errorloc').innerHTML = "Please enter your full business address";

		//document.getElementById('mer_register_city_errorloc').innerHTML = "Please enter your city";

		//document.getElementById('mer_register_county_errorloc').innerHTML = "Please enter your county";

		//document.getElementById('mer_register_category_errorloc').innerHTML = "Please select a category";

		//document.getElementById('mer_register_dealcity_errorloc').innerHTML = "Please select deal city";

		//document.getElementById('mer_register_company_type_errorloc').innerHTML = "Please select company type";

		//document.getElementById('mer_register_company_reg_no_errorloc').innerHTML = "Please enter company registration number";

		document.getElementById('mer_register_business_type_errorloc').innerHTML = "Please select business type";

		//document.getElementById('mer_register_business_start_date_errorloc').innerHTML = "Please enter business start date";
		return false;
	}

}

function hasValue() {
	var fname = document.getElementById('fname').value;
	var lname = document.getElementById('lname').value;
	var email = document.getElementById('email').value;
	//var confemail = document.getElementById('confemail').value;
	var password = document.getElementById('password').value;
	var cpassword = document.getElementById('cpassword').value;

	var day = document.getElementById('day').value;
	var month = document.getElementById('month').value;
	var year = document.getElementById('year').value;

	if ( fname != "") {
		document.getElementById('cust_register_fname_errorloc').innerHTML = "";
		document.getElementById('fname').style.border = "1px solid #C8C8C8";
		}
	if ( lname != "") {
		document.getElementById('cust_register_lname_errorloc').innerHTML = "";
		document.getElementById('lname').style.border = "1px solid #C8C8C8";
		}
	if ( email != "" ) {
		document.getElementById('cust_register_email_errorloc').innerHTML != "";
		document.getElementById('email').style.border = "1px solid #C8C8C8";
		}
	/*if ( day != "000" || month != "000" || year != "000" ) {
		document.getElementById('cust_register_day_errorloc').innerHTML = "";
		document.getElementById('day').style.border = "1px solid #C8C8C8";
		document.getElementById('month').style.border = "1px solid #C8C8C8";
		document.getElementById('year').style.border = "1px solid #C8C8C8";
		}*/
	if ( password != "" ) {
		document.getElementById('cust_register_password_errorloc').innerHTML = "";
		document.getElementById('password').style.border = "1px solid #C8C8C8";
		}
	if ( password == cpassword) {
		document.getElementById('cust_register_cpassword_errorloc').innerHTML = "";
		document.getElementById('cpassword').style.border = "1px solid #C8C8C8";
	}
	return true;
}

</script>
<!-- Merchant Registration form validator ends -->

</div>



<?php

	   	/*
	   	 * $cookie = get_facebook_cookie('192309027517422', '7f1eb32e301277d025d35b77b06dd863');
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

	   			/*$city = reset(explode(",", $user->location->name));
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
	   	 */
?>

<br/><br/>
</div>
</div>
<div class="green_curv20"></div>
</div>
</div>
<?php include ('include/sidebar-featured.php'); ?>
</div>
<?php include("include/footer.php");?>
