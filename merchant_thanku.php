<?php
include("include/header.php");

if(strtolower($_POST["btnRegister"])=='submit')
{
	$dob = $_POST["year"].'-'.$_POST["month"].'-'.$_POST["day"];
	$_POST["dob"] = $dob;
	$_POST["reg_type"] = 'temp_merchant';
	$date = date('Y-m-d');
	$to = $_POST["email"];

	if ($_POST["fname"] == "") {
	$fname = $_POST["company_md_fname"];
	}
	if ($_POST["lname"] == "") {
	$lname = $_POST["company_md_lname"];
	}

	$sql_insert_merchant = "INSERT INTO ".TABLE_USERS."(company_name,first_name,last_name,address1,city,zip,state,email,phone_no,password,dob,reg_type,date_added,website,trading_name,company_type,company_reg_no,md_fname,md_lname,business_type,business_start_date,trading_address,hear_abt_us,job_type) VALUES('".$_POST["company_name"]."','".$fname."','".$lname."','".$_POST["address1"]."','".$_POST["city"]."','".$_POST["zip"]."','".$_POST["state"]."','".$_POST["email"]."','".$_POST["phone_no"]."','".$_POST["password"]."','".$_POST["dob"]."','".$_POST["reg_type"]."','".$date."','".$_POST["website"]."','".$_POST["company_trading_name"]."','".$_POST["company_type"]."','".$_POST["company_reg_no"]."','".$_POST["company_md_fname"]."','".$_POST["company_md_lname"]."','".$_POST["business_type"]."','".$_POST["business_start_date"]."','".$_POST["trading_address"]."','".$_POST["hear_abt_us"]."','".$_POST["company_job_type"]."')";
	mysql_query($sql_insert_merchant);
	//$GLOBALS["reg_msg"] = 'The merchant registration is successfull';

	$Template = '
		<table width="650" border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr>
		    <td align="center" valign="top"><table width="650" border="0" align="center" cellpadding="0" cellspacing="0">
		      <tr>
		        <td><img src="'.SITE_URL.'images/reg_newsletter/logo.gif" alt="" width="646" height="98" /></td>
		        </tr>
		      <tr>
		        <td style="font-family: Arial, Helvetica, sans-serif; text-align:left; line-height:18px; color:#000; font-size:13px; font-weight: normal; font-smooth: always;">
		          <p>Dear '.ucfirst($_POST["company_name"]).',<br />
		          </p>
		          <p>Thanks for your interest in partnering with GeeLaza!</p>
		          <p>Right now, one of our Deal Research Specialists is taking a look at your information. We want to make sure that we can create a promotion that brings customers through your door and delivers measurable results.</p>
		          <p>That way, everyone wins. specially you.</p>
		          <p>We\'ll be in touch soon.</p>
		          <p>Thanks again.</p>
		          <p>The GeeLaza team.</p>         </td>
		      </tr>
		     </table></td>
		  </tr>
		</table>
	';

	$subject = "Thank You for Your Interest in GeeLaza";

	$sql="SELECT * FROM ".TABLE_ADMIN." where admin_name='admin'";
	$admin=$db->query_first($sql);

	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= "From: GeeLaza Business Team<b2b@geelaza.com>". "\r\n" ;

	@mail($to,$subject,$Template,$headers);
}

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
<h6 style="margin:-15px 0; background:#fff; padding:0px 0 10px 0; color: #404040; font: bold 30px/35px Candara, Arial, Helvetica, sans-serif;" >Thank You</h6>
<!--<div class="txt1"><strong>All the require fields are represented by(<span style="color:#FF0000 !important;">*</span>)</strong></div>-->
<div class="txt1_gp" style="padding-bottom: 10px;"><p>Thank you for your interest in being a GeeLaza merchant. We are in the middle of processing your request and you should hear from our representative soon!<br /><br />

Please note that we receive many requests to be our daily deal. So if you dont hear from us within 5 working days then please contact us and one of our representative will advice your further.<br />

</p>
</div>
<div class="clear"></div>
<div class="w_next">
<h2>Whats next ?</h2>
<div class="next_Box">
<img src="images/next1.gif" alt="" width="87" height="87"/>
<h2>Review</h2>
<p>We will look over the information that you’ve submitted and decide if your company is in line with our business and the wants of our subscribers.</p>
</div>
<div class="next_Box">
<img src="images/next2.gif" alt="" width="95" height="87"/>
<h2>Contact</h2>
<p>If you have a good business that we can work with then we will get in touch to discuss further.</p>
</div>
<div class="next_Box">
<img src="images/next3.gif" alt="" width="98" height="87"/>
<h2>Consult</h2>
<p>Our team will help you set a deal that will interest our subscribers and achieve your business goals.</p>
</div>
<div class="next_Box">
<img src="images/next4.gif" alt="" width="95" height="87"/>
<h2>Deal day</h2>
<p>On the day of your deal you can track the progress of our main deal page.</p>
</div>
<div style="margin:0;" class="next_Box">
<img src="images/next5.gif" alt="" width="95" height="87"/>
<h2>Pay day</h2>
<p>Receive you payment from your deal within 10 business days.</p>
</div>
</div>
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

<br/><br/>
</div>
</div>
<div class="green_curv20"></div>
</div>
</div>
<?php include ('include/sidebar-login.php'); ?>
</div>
<?php include("include/footer.php");?>
