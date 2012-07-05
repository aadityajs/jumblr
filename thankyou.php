<?php
error_reporting(E_ERROR && E_STRICT);
include("include/header.php");
require_once 'CallerService.php';
session_start();
ob_start();
$sql_user_details = "SELECT * FROM ".TABLE_USERS." WHERE user_id = $_SESSION[user_id]";
$user = mysql_fetch_array(mysql_query($sql_user_details));

$sql_deal_details = "SELECT * FROM ".TABLE_DEALS." WHERE deal_id = $_SESSION[prod_id]";
$deal_details = mysql_fetch_array(mysql_query($sql_deal_details));


$email_Template_1 = '
		<table width="760" border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr>
		   <td bgcolor="#f6f3e8" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color:#989595; text-align:center; vertical-align:middle; border: 0;">Add &quot;<a href="#" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color:#989595; text-decoration:none;">voucher@info.geelaza.com</a>&quot; to your address book to ensure you get emails from GeeLaza.</td>
		  </tr>
		  <tr>
		    <td align="center" valign="top"><img src="'.SITE_URL.'images/pdf_img/headerbg1.jpg" alt="" width="760" height="103" /></td>
		  </tr>
		  <tr>
		 <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-bottom:2px solid #000000; border-left:2px solid #000000; border-right:2px solid #000000;">
		      <tr>
		        <td><table width="733" border="0" align="center" cellpadding="0" cellspacing="0">
		          <tr>
		            <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; text-align:left; line-height:16px; color:#000; font-size:13px; font-weight: normal; font-smooth: always;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
		                <tr>
		                  <td width="74%"><p><strong>Thank you very much for your order, '.ucfirst($user['first_name']).' '.ucfirst($user['last_name']).'.</strong></p>
		                      <p>Thank the deal has been successfully closed we\'ll send you the voucher and all relevant information in a separate email.<br />
		                      </p>
		                    <p>Get yourself &pound;5 GeeLaza credit now. Recommend this deal to your friends. We will credit you<br />
		                      to the value of &pound;5 as a reward for every friend you send our way who buys this. or any other<br />
		                      deal on GeeLaza. You can redeem this credit against a future deal of your choice.<br />
		                      </p>
		                    <p>Your Groupon team<br />
		                      </p>
		                    <p><br />
		                    </p></td>
		                  <td width="26%" align="left" valign="top" style="padding: 14px 0;"><table width="150" border="0" align="center" cellpadding="0" cellspacing="0" style="border: 1px solid #b2c59d;">
		                      <tr>
		                        <td bgcolor="#cbeaa7" style="font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bold; line-height: 22px; text-align: center; vertical-align: middle; text-shadow: #e1f5c9 2px 2px 2px;">Advantages to you</td>
		                      </tr>
		                      <tr>
		                        <td bgcolor="#fff8d9"><table width="132" border="0" align="center" cellpadding="0" cellspacing="0">
		                            <tr>
		                              <td align="left" valign="top"><p> &pound;5 GeeLaza credit for every recruited friend</p>
		                                  <p>Redeen your credit againt your next deal.<br />
		                                  </p>
		                                <p>Restaurants. spas, beauty and leisure enjoy GeeLaza with friends. </p></td>
		                            </tr>
		                        </table></td>
		                      </tr>
		                  </table></td>
		                </tr>
		            </table></td>
		          </tr>
		          <tr>
		            <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; text-align:left; line-height:18px; color:#000; font-size:13px; font-weight: normal; font-smooth: always;"><p><strong>Completion of transaction and your right to cancel.</strong> The contact to buy is complete by us sending you this email. The Voucher will be sent to you in a second email shortly atter. You may cancel the transdaction by writing to us within 5 working days of Voucher receipt(prior to any redemption of the Voucher being made).</p>
		           <p><strong>National Deal is not your city? Choose your city:</strong><br/>
		           You can find interesting and up-to-date deals in these cities,</p></td>
		          </tr>
		          <tr>
		            <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; text-align:left; line-height:18px; color:#000; font-size:13px; font-weight: normal; font-smooth: always;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
		                <tr>
		                <td>&nbsp;</td>
		                </tr>
		                <tr>
		                  <td><table width="720"border="0" cellspacing="0" cellpadding="0">
								  <tr>
								    <td width="128" valign="top" style="list-style-type:none;"><ul>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=62" style="color:#4292e4; text-decoration:none; line-height: 15px;">&raquo; Aberdeen</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=68" style="color:#4292e4; line-height: 19px; text-decoration:none;">&raquo; Belfast</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=4" style="color:#4292e4; text-decoration:none;">&raquo; Birmingham</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=3" style="color:#4292e4; text-decoration:none;">&raquo; Bournemouth</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=5" style="color:#4292e4; text-decoration:none;">&raquo; Bradford</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=6" style="color:#4292e4; text-decoration:none;">&raquo; Brighton</a></li>
								      </ul>
								      <p>&nbsp;</p></td>
								    <td width="128" valign="top"><ul>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=1" style="color:#4292e4; text-decoration:none;">&raquo; Bath</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=7" style="color:#4292e4; text-decoration:none;">&raquo; Cambridge</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=67" style="color:#4292e4; text-decoration:none;">&raquo; Cardiff</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=14" style="color:#4292e4; text-decoration:none;">&raquo; Coventry</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=15" style="color:#4292e4; text-decoration:none;">&raquo; Derby</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=65" style="color:#4292e4; text-decoration:none;">&raquo; Dublin</a></li>
								      </ul></td>
								    <td width="128" valign="top"><ul>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=67" style="color:#4292e4; text-decoration:none;">&raquo; Dudley</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=70" style="color:#4292e4; text-decoration:none;">&raquo; Edinburgh</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=74" style="color:#4292e4; text-decoration:none;">&raquo; Glasgow</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=22" style="color:#4292e4; text-decoration:none;">&raquo; Hull</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=26" style="color:#4292e4; text-decoration:none;">&raquo; Leeds</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=27" style="color:#4292e4; text-decoration:none;">&raquo; Leicester</a></li>
								      </ul></td>
								    <td width="128" valign="top"><ul>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=30" style="color:#4292e4; text-decoration:none;">&raquo; Liverpool</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=31" style="color:#4292e4; text-decoration:none;">&raquo; London</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=70" style="color:#4292e4; text-decoration:none;">&raquo; Manchester</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=38" style="color:#4292e4; text-decoration:none;">&raquo; Newcastle</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=40" style="color:#4292e4; text-decoration:none;">&raquo; Nottingham</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=41" style="color:#4292e4; text-decoration:none;">&raquo; Oxford</a></li>
								      </ul></td>
								    <td width="138" valign="top"><ul>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=43" style="color:#4292e4; text-decoration:none;">&raquo; Plymouth</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=46" style="color:#4292e4; text-decoration:none;">&raquo; Reading</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=50" style="color:#4292e4; text-decoration:none;">&raquo; Sheffield</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=51" style="color:#4292e4; text-decoration:none;">&raquo; Southampton</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=60" style="color:#4292e4; text-decoration:none;">&raquo; Wolverhampton</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'" style="color:#4292e4; text-decoration:none;">&raquo; More cities</a></li>
								      </ul></td>
								  </tr>
								</table>
		                  </td>
		                </tr>
		            </table></td>
		          </tr>
		          <tr>
		            <td align="left" valign="top" style="font-family: Times New Roman, Times, serif; text-align:left; line-height:28px; color:#6d6969; font-size:22px; font-weight: bold; font-smooth: always; border-bottom: 1px dashed #6d6969;">Our Order Details</td>
		          </tr>
		          <tr>
		            <td height="40" align="left" valign="middle" style="font-family: Arial, Helvetica, sans-serif; text-align:left; line-height:18px; color:#000; font-size:13px; font-weight: normal; font-smooth: always;">Please check the following details</td>
		          </tr>
		          <tr>
		            <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; text-align:left; line-height:18px; color:#000; font-size:13px; font-weight: normal; font-smooth: always;"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border: 1px solid #d2d2d2;">
		                <tr>
		                  <td width="18%" bgcolor="#ececec" style="border-right: 1px solid #d2d2d2; border-bottom: 1px solid #d2d2d2; font-family: Times New Roman, Times, serif; text-align:left; line-height:28px; color:#2c2a2a; font-size:18px; font-weight: normal; font-smooth: always; padding: 4px 6px;">GeeLaza Title </td>
		                  <td width="82%" style="border-bottom: 1px solid #d2d2d2; padding: 0 6px;">'.$deal_details['title'].'(worth &pound;'.intval($deal_details['full_price']).')</td>
		                </tr>
		                <tr>
		                  <td bgcolor="#ececec" style="border-right: 1px solid #d2d2d2; border-bottom: 1px solid #d2d2d2; font-family: Times New Roman, Times, serif; text-align:left; line-height:28px; color:#2c2a2a; font-size:18px; font-weight: normal; font-smooth: always; padding: 4px 6px;">Price </td>
		                  <td style="border-bottom: 1px solid #d2d2d2; padding: 0 6px;">&pound;'.intval($deal_details['discounted_price']).'</td>
		                </tr>
		                <tr>
		                  <td bgcolor="#ececec" style="border-right: 1px solid #d2d2d2; border-bottom: 1px solid #d2d2d2; font-family: Times New Roman, Times, serif; text-align:left; line-height:28px; color:#2c2a2a; font-size:18px; font-weight: normal; font-smooth: always; padding: 4px 6px;">Discount</td>
		                  <td style="border-bottom: 1px solid #d2d2d2; padding: 0 6px;">&pound;'.intval($deal_details['full_price'] - $deal_details['discounted_price']).'</td>
		                </tr>
		                <tr>
		                  <td bgcolor="#ececec" style="border-right: 1px solid #d2d2d2; border-bottom: 1px solid #d2d2d2; font-family: Times New Roman, Times, serif; text-align:left; line-height:28px; color:#2c2a2a; font-size:18px; font-weight: normal; font-smooth: always; padding: 4px 6px;">Quantity</td>
		                  <td style="border-bottom: 1px solid #d2d2d2; padding: 0 6px;">'.$qty.'</td>
		                </tr>
		                <tr>
		                  <td bgcolor="#f2f0c0" style="border-right: 1px solid #d2d2d2; font-family: Times New Roman, Times, serif; text-align:left; line-height:28px; color:#2c2a2a; font-size:22px; font-weight: bold; font-smooth: always; padding: 4px 6px;">Total</td>
		                  <td bgcolor="#f2f0c0" style="padding: 0 6px; font-family: Times New Roman, Times, serif; text-align:left; line-height:28px; color:#2c2a2a; font-size:22px; font-weight: bold; font-smooth: always; padding: 4px 6px;">&pound;'.$payment_gross.'</td>
		                </tr>
		            </table></td>
		          </tr>
		          <tr>
		            <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; text-align:left; line-height:18px; color:#000; font-size:13px; font-weight: normal; font-smooth: always;">&nbsp;</td>
		          </tr>
		            <tr>
		            <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; text-align:left; line-height:18px; color:#000; font-size:13px; font-weight: normal; font-smooth: always;">&nbsp;</td>
		          </tr>
		        </table></td>
		      </tr>
		    </table></td>
		  </tr>
		  <tr>
		  <td bgcolor="#f6f3e8" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color:#989595; text-align:center; vertical-align:middle; border: 0;"> &copy; <a href="'.SITE_URL.'" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color:#989595; text-decoration:none;">GeeLaza.com</a> | <a href="'.SITE_URL.'page.php?page=Terms%20and%20Conditions" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color:#989595; text-decoration:none;">Terms & Conditions</a> | <a href="'.SITE_URL.'page.php?page=About%20GeeLaza%20UK" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color:#989595; text-decoration:none;">About GeeLaza</a> | <a href="'.SITE_URL.'faq.php" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color:#989595; text-decoration:none;">FAQ</a> | <a href="'.SITE_URL.'merchant_business.php" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color:#989595; text-decoration:none;">Get Your Business Featured On Geelaza</a></td>
		  </tr>
		</table>

		';
//echo $email_Template_1;

//var_dump($_SESSION);

//<!-- Payment page Registration code start -->

	$flag = 0;
	if(strtolower($_SERVER['REQUEST_METHOD']) == 'post' && $_POST['Submit'] == "Buy your deal" )
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

		/*if($flag == 0)
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
		}*/

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

		/*if($flag == 0)
		{
			if($add1 == '')
			{
				$msg = 'Please enter Address';
				$flag = 1;
			}
		}

		if($flag == 0)
		{
			if($postcode  == '')
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

		if($flag == 0)
		{
			if($terms !== 'terms')
			{
				$msg = 'Please agree with our Terms to use our service.';
				$flag = 1;
			}
		}

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
		}*/


		if($flag == 0)
		{
			$sql_select = "SELECT * FROM ".TABLE_USERS." WHERE email="."'".$email."'";
			$result_select = mysql_query($sql_select);
			$count_select = mysql_num_rows($result_select);
			if($count_select >0)
			{
				$msg = 'Email address already exists';
				$flag = 5;
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

			echo $sql_insert = "INSERT INTO ".TABLE_USERS.
						  "(first_name,last_name,email,phone_no,password,dob,address1,address2,zip,city,date_added)
						  VALUES('".$fname."','".$lname."','".$email."','".$phno."','".$password."','".$dob."','".$add1."','".$add2."','".$postcode."','".$city."','".$date."')";

			mysql_query($sql_insert);


			$msg = 'Your account has been successfully created!';
			$flag = 2;

			// send wellcome email
			//RegistrationEmail($email);


				$sql_email1 = "SELECT * FROM ".TABLE_DEALS." WHERE status >= 1 LIMIT 0, 1"; //AND deal_end_time LIKE '".date("Y-m-d")."%' LIMIT 0, 4";
				$email_res1 = mysql_fetch_array(mysql_query($sql_email1));
				$sql_email_image1 = "SELECT * FROM ".TABLE_DEAL_IMAGES." WHERE deal_id = ".$email_res1['deal_id'];
				$email_image_1 = mysql_fetch_array(mysql_query($sql_email_image1));

				$sql_email2 = "SELECT * FROM ".TABLE_DEALS." WHERE status >= 1 LIMIT 1, 1"; //AND deal_end_time LIKE '".date("Y-m-d")."%' LIMIT 0, 4";
				$email_res2 = mysql_fetch_array(mysql_query($sql_email2));
				$sql_email_image2 = "SELECT * FROM ".TABLE_DEAL_IMAGES." WHERE deal_id = ".$email_res2['deal_id'];
				$email_image_2 = mysql_fetch_array(mysql_query($sql_email_image2));

				$sql_email3 = "SELECT * FROM ".TABLE_DEALS." WHERE status >= 1 LIMIT 2, 1"; //AND deal_end_time LIKE '".date("Y-m-d")."%' LIMIT 0, 4";
				$email_res3 = mysql_fetch_array(mysql_query($sql_email3));
				$sql_email_image3 = "SELECT * FROM ".TABLE_DEAL_IMAGES." WHERE deal_id = ".$email_res3['deal_id'];
				$email_image_3 = mysql_fetch_array(mysql_query($sql_email_image3));

				$sql_email4 = "SELECT * FROM ".TABLE_DEALS." WHERE status >= 1 LIMIT 3, 1"; //AND deal_end_time LIKE '".date("Y-m-d")."%' LIMIT 0, 4";
				$email_res4 = mysql_fetch_array(mysql_query($sql_email4));
				$sql_email_image4 = "SELECT * FROM ".TABLE_DEAL_IMAGES." WHERE deal_id = ".$email_res4['deal_id'];
				$email_image_4 = mysql_fetch_array(mysql_query($sql_email_image4));


					//$email_deal_details_1 = get_deal_details($deal_id);


				$Template = '

						<table border="0" cellspacing="0" cellpadding="0" width="620" style="vertical-align:top; width:620px; margin:0 auto;">
						  <tr>
							<td background="'.SITE_URL.'images/daily_email_images/box1_top.png"><img src="'.SITE_URL.'images/daily_email_images/spacer.gif" width="620" height="10" alt="" /></td>
						  </tr>
						   <tr>
							<td valign="top" align="left" background="'.SITE_URL.'images/daily_email_images/bg_p.gif">
							 <table width="100%" border="0" cellspacing="0" cellpadding="0">
							  <tr>
								<td valign="top" align="left">
									<table border="0" cellspacing="0" cellpadding="0" width="620" style="vertical-align:top; width:620px;">
								  <tr>
									<td width="10" valign="top" style="vertical-align:top; width:10px;"><img src="'.SITE_URL.'images/daily_email_images/spacer.gif" width="10" height="1" alt="" /></td>
									<td width="171" height="76" align="left" valign="top" style="vertical-align:top; text-align:left; width:171px; height:76px; line-height:0px;">
										<img src="'.SITE_URL.'images/daily_email_images/logo.png" width="164" height="72" alt="" />
									</td>
									<td width="350" valign="top" style="vertical-align:top; width:350px;"><img src="'.SITE_URL.'images/daily_email_images/spacer.gif" width="350" height="1" alt="" /></td>
								  </tr>
							  </table>
								</td>
							  </tr>
							  <tr>
								 <td height="15" valign="top" style="vertical-align:top; height:15px; line-height:0px;"><img src="'.SITE_URL.'images/daily_email_images/spacer.gif" width="1" height="15" alt="" />
									<span style="float:right; font: 12px Arial, Helvetica, sans-serif;  color:#CCCCCC; padding-right: 15px;">'.date("d.m.Y").'</span>
								 </td>
							 </tr>
							  <tr>
								 <td height="15" valign="top" style="vertical-align:top; height:15px; line-height:0px;"><img src="'.SITE_URL.'images/daily_email_images/box2_top.png" width="620" height="15" alt="" /></td>
							 </tr>
							 <tr>
								<td valign="top" background="'.SITE_URL.'images/daily_email_images/box2_middle.png" style="padding:0 15px;">
									<table width="590" border="0" cellspacing="0" cellpadding="0" style="width:590px; margin: 0 auto;">
									  <tr>
											<td valign="top" style="color:#14131b; font-family:Arial, Helvetica, sans-serif; line-height:26px; font-size:25px; font-weight:bold; padding:10px 0 10px 18px; border-bottom:2px solid #7fd7fc;">Welcome to GeeLaza</td>
										  </tr>
										  <tr>
											<td valign="top" style="padding:10px 0 10px 18px; color:#ff7522; font-family:Arial, Helvetica, sans-serif; line-height:20px; font-size:18px; font-weight:bold;">
											Hey '.ucfirst($fname).'
											</td>
										  </tr>
										  <tr>
											<td valign="top" style="color:#828585; padding:0 0 10px 18px; font-family:Arial, Helvetica, sans-serif; line-height:17px; font-size:12px; font-weight:normal; border-bottom:2px solid #7fd7fc;">Thank you for becoming a GeeLaza member! Each day, we’ll email you with great experiences and values at local restaurants, events, fitness, and more. <br /> You\'ll love it-we promise.</td>
										  </tr>
									 </table>
								  </td>
								  </tr>
								<tr>
								<td valign="top" background="'.SITE_URL.'images/daily_email_images/box2_middle.png" style="padding:0 25px;">
									<table width="570" border="0" cellspacing="0" cellpadding="0" style="width:570px; margin: 0 auto;">
									  <tr>
										<td valign="top">
										 <table width="100%" border="0" cellspacing="0" cellpadding="0">
										  <tr>
											<td valign="top" align="left" style="color:#828585; padding:0 6px 10px 6px; font-family:Arial, Helvetica, sans-serif; line-height:17px; font-size:12px; font-weight:normal;">

											  <p><b style="color:#279cea;padding:0 0 6px 0;font-family:Arial, Helvetica, sans-serif; line-height:17px; font-size:13px; font-weight:bold; display:inline-block;">What happens when you buy a deal?</b><br />
						When you purchase a deal, we&rsquo;ll send you a voucher 24-48  hours after the clock runs out on your deal. If you ever lose this email, you  can access by loggin into your GeeLaza account and it will be under &ldquo;My  Vouchers&rdquo;. Once you&rsquo;ve received your voucher, simply follow instructions on the  voucher to enjoy the deal, or you can send your voucher to a loved one as a  gift (don&rsquo;t worry about your name being on the voucher).</p>

						<p><b style="color:#279cea;padding:0 0 8px 0;font-family:Arial, Helvetica, sans-serif; line-height:17px; font-size:13px; font-weight:bold; display:inline-block;">Check out today&rsquo;s deal now and then start saving! </b><br />
						Right now we&rsquo;re in the process of expanding to cover all  areas in the UK, so if your area doesn&rsquo;t get a deal immediately don&rsquo;t worry,  we&rsquo;ll have deals there soon.<br /><br />
						Plus, we run frequent <a href="'.SITE_URL.'national_deals.php?nd=National%20deals" style="color:#279cea; text-decoration:none"> <strong style="color:#279cea;">National Deals</strong></a> &ndash; so you can grab a  bargain no matter where you live.</p>

							<p><b style="color:#279cea;padding:0 0 8px 0;font-family:Arial, Helvetica, sans-serif; line-height:17px; font-size:13px; font-weight:bold; display:inline-block;">
							Now what?</b><br />
							Check out today&rsquo;s daily deals in <span style="color:#279cea;">
							<a href="http://unifiedinfotech.net/getdeals/?city=68" style="color:#279cea; text-decoration:none">Belfast</a>,
							<a href="http://unifiedinfotech.net/getdeals/?city=4" style="color:#279cea; text-decoration:none">Birmingham</a>,
							<a href="#" style="color:#279cea; text-decoration:none">Bristol</a>,
							<a href="'.SITE_URL.'?city=67" style="color:#279cea; text-decoration:none">Cardiff</a>,
							<a href="'.SITE_URL.'?city=70" style="color:#279cea; text-decoration:none">Edinburgh</a>,
							<a href="'.SITE_URL.'?city=74" style="color:#279cea; text-decoration:none">Glasgow</a>,
							<a href="'.SITE_URL.'?city=26" style="color:#279cea; text-decoration:none">Leeds</a>,
							<a href="'.SITE_URL.'?city=30" style="color:#279cea; text-decoration:none">Liverpool</a>,
							<a href="'.SITE_URL.'?city=31" style="color:#279cea; text-decoration:none">London</a>,
							<a href="'.SITE_URL.'?city=36" style="color:#279cea; text-decoration:none">Manchester</a>,
							<a href="'.SITE_URL.'national_deals.php?nd=National%20deals" style="color:#279cea; text-decoration:none">National</a>,
							<a href="'.SITE_URL.'?city=38" style="color:#279cea; text-decoration:none">Newcastle</a>,
							<a href="'.SITE_URL.'?city=40" style="color:#279cea; text-decoration:none">Nottingham</a>,
							<a href="'.SITE_URL.'?city=46" style="color:#279cea; text-decoration:none">Reading</a>,
							<a href="'.SITE_URL.'?city=50" style="color:#279cea; text-decoration:none">Sheffield</a>
							</span></p>
						   <p> <a href="'.SITE_URL.'" style="color:#279cea; text-decoration:none;">More cities &raquo;</a></p>

						   <p> If you need any help, get in touch with us. We thank you  once again for registering with us and we hope you have a great time and enjoy deal  hunting.</p>
							<p><b>Need help?</b> <a href="#" style="color:#279cea; text-decoration:none;">Click here</a></p>
							<p><b>The GeeLaza Team</b></p>
										  </td>
										  </tr>
										 </table>
									   </td>
									  </tr>
									   <tr>
										 <td>
											<table width="100%" border="0" cellspacing="0" cellpadding="0">
											  <tr>
												<td valign="top" width="410"><img src="'.SITE_URL.'images/daily_email_images/spacer.gif" alt="" width="410" height="1" /></td>
												<td style="color:#000; padding:0 0 10px 6px; font-family:Arial, Helvetica, sans-serif; line-height:17px; font-size:13px; font-weight:bold;">Follow Us on:</td>
												<td valign="top" width="6"><img src="'.SITE_URL.'images/daily_email_images/spacer.gif" alt="" width="6" height="1" /></td>
												<td valign="top"><a href="#"><img src="'.SITE_URL.'images/daily_email_images/icon_01.png" alt="" border="0" /></a></td>
												<td valign="top" width="6"><img src="'.SITE_URL.'images/daily_email_images/spacer.gif" alt="" width="6" height="1" /></td>
												<td valign="top"><a href="#"><img src="'.SITE_URL.'images/daily_email_images/icon_02.png" alt="" border="0" /></a></td>
											  </tr>
											</table>
										</td>
										</tr>
										 <tr>
											 <td valign="top" height="6"><img src="'.SITE_URL.'images/daily_email_images/spacer.gif" alt="" width="1" height="6" /></td>
										</tr>
										<tr>
										 <td valign="top" height="1" bgcolor="#7ed7fc"><img src="'.SITE_URL.'images/daily_email_images/spacer.gif" alt="" width="1" height="1" /></td>
									   </tr>
										<tr>
											 <td valign="top" height="6"><img src="'.SITE_URL.'images/daily_email_images/spacer.gif" alt="" width="1" height="6" /></td>
										   </tr>
										<tr>
											<td valign="top" align="center">
											<a href="'.SITE_URL.'" style="padding:0 4px; color:#5b6cd9; font-family:Arial, Helvetica, sans-serif; line-height:18px; font-size:14px;text-align:center; text-decoration:none;">&copy; GeeLaza.com</a>
											<a href="'.SITE_URL.'page.php?page=Terms and Conditions" style="padding:0 4px; color:#5b6cd9; font-family:Arial, Helvetica, sans-serif; line-height:18px; font-size:14px;text-align:center; text-decoration:none;">Terms & Conditions</a>
											<a href="'.SITE_URL.'customer-register.php" style="padding:0 4px; color:#5b6cd9; font-family:Arial, Helvetica, sans-serif; line-height:18px; font-size:14px;text-align:center; text-decoration:none;">Join Us</a>
											<a href="'.SITE_URL.'page.php?page=About GeeLaza UK" style="padding:0 4px; color:#5b6cd9; font-family:Arial, Helvetica, sans-serif; line-height:18px; font-size:14px;text-align:center; text-decoration:none;">About GeeLaza</a>
											<a href="'.SITE_URL.'merchant_business.php" style="padding:0 4px; color:#5b6cd9; font-family:Arial, Helvetica, sans-serif; line-height:18px; font-size:14px;text-align:center; text-decoration:none;">Run Deal With Us</a>                   </td>
										 </tr>
									 </table>
								  </td>
								  </tr>
								 <tr>
								 <td height="15" valign="top" style="vertical-align:top; height:15px; line-height:0px;"><img src="'.SITE_URL.'images/daily_email_images/box2_bottom.png" width="620" height="15" alt="" /></td>
							 </tr>
							</table>
							</td>
						   </tr>
						   <tr>
							 <td valign="top" height="6" background="'.SITE_URL.'images/daily_email_images/bg_p.gif"><img src="'.SITE_URL.'images/daily_email_images/spacer.gif" alt="" width="1" height="6" /></td>
						  </tr>
						   <tr>
							<td valign="top" align="center" background="'.SITE_URL.'images/daily_email_images/bg_p.gif">
							   <table width="600" bgcolor="#d1d1d1" border="0" cellspacing="0" cellpadding="0" style="width:600px; margin:0 auto;">
								  <tr>
									<td style="padding:8px 4px; color:#5b5960; font-family:Arial, Helvetica, sans-serif; line-height:14px; font-size:11px; text-decoration:none;">Please add info@geelaza.com to your address book or safe sender list so our emails get to your inbox.<br />The message was sent by GeeLaza UK.
						</td>
								 </tr>
								 <tr>
									<td style="padding:0 4px 8px 4px; color:#5b5960; font-family:Arial, Helvetica, sans-serif; line-height:14px; font-size:11px; text-decoration:none;">You are receiving this email because you have an existing relationship with <a href="'.SITE_URL.'" style="color:#279cea; text-decoration:none;">http://www.geelaza.com</a>.
									If you no longer wish to receive emails from us, you can <a href="'.SITE_URL.'unsubscribe_newsletter.php?unsub_email='.$email.'">unsubscribe</a>.</td>
								 </tr>
								</table>
						  </tr>
						   <tr>
							<td background="'.SITE_URL.'images/daily_email_images/box1_bottom.png"><img src="'.SITE_URL.'images/daily_email_images/spacer.gif" width="620" height="10" alt="" /></td>
						  </tr>
						</table>


						';

		//echo $Template;

			if (isset($Template)) {
					//$to  = $to;



					$subject = "Welcome to GeeLaza.com ";

					$sql="SELECT * FROM ".TABLE_ADMIN." where admin_name='admin'";
					$admin=$db->query_first($sql);

					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$headers .= "From: GeeLaza.com<voucher@geelaza.com>". "\r\n" ;

					@mail($email,$subject,$Template,$headers);
			}

		}

	}


//<!-- Payment page registration code end -->



if($_POST['payment_system'] == 'cc')
{

/**
 * PayPal Pro web form request Visa, Amex, MasterCard, Discover.
 */
	if (!empty($_POST['paymentType'])) {

		$custom = $_POST['custom'];

		$paymentType =urlencode( $_POST['paymentType']);
		$firstName =urlencode( $_POST['firstName']);
		$lastName =urlencode( $_POST['lastName']);
		$creditCardType =urlencode( $_POST['creditCardType']);
		$creditCardNumber = urlencode($_POST['creditCardNumber']);
		$expDateMonth =urlencode( $_POST['expDateMonth']);

		// Month must be padded with leading zero
		$padDateMonth = str_pad($expDateMonth, 2, '0', STR_PAD_LEFT);

		$expDateYear =urlencode( $_POST['expDateYear']);
		$cvv2Number = urlencode($_POST['cvv2Number']);
		$address1 = urlencode($_POST['address1']);
		$address2 = urlencode($_POST['address2']);
		$city = urlencode($_POST['city']);
		$state =urlencode( $_POST['state']);
		$zip = urlencode($_POST['zip']);
		$amount = urlencode($_POST['payment_amount']);
		//$currencyCode=urlencode($_POST['currency']);
		$currencyCode="GBP";
		$paymentType=urlencode($_POST['paymentType']);


		/* Construct the request string that will be sent to PayPal.
		   The variable $nvpstr contains all the variables and is a
		   name value pair string with & as a delimiter */
		$nvpstr="&PAYMENTACTION=$paymentType&AMT=$amount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber&EXPDATE=".$padDateMonth.$expDateYear."&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName&STREET=$address1&CITY=$city&STATE=$state"."&ZIP=$zip&COUNTRYCODE=US&CURRENCYCODE=$currencyCode";

		/* Make the API call to PayPal, using API signature.
		   The API response is stored in an associative array called $resArray */
		$resArray=hash_call("doDirectPayment",$nvpstr);

		/* Display the API response back to the browser.
		   If the response from PayPal was a success, display the response parameters'
		   If the response was an error, display the errors received using APIError.php.
		   */
		$ack = strtoupper($resArray["ACK"]);

		if($ack!="SUCCESS")  {
			$_SESSION['reshash']=$resArray;
			$location = "APIError.php";
				 header("Location: $location");
		   }


		   if ($ack == "SUCCESS") {

		   		$custom_expl = explode(',', $custom);
				$user_id = $custom_expl[0];
				$deal_id = $custom_expl[1];
				$trn_date = $custom_expl[2];

				$user_id = $_SESSION['user_id'];
				$deal_id = $custom_expl[1];
				$trn_date = $resArray['TIMESTAMP'];
				$coupon_code = strtoupper(str_rand($length = 13, $seeds = 'alphanum'));

				$txn_id = $resArray['TRANSACTIONID'];
				$payment_status = 'success';
				$qty = $_POST['item_number'];
				$payment_gross = $resArray['AMT'];
				$withdraw_status = 'received';

				$sql_trnsaction = "INSERT INTO ".TABLE_TRANSACTION." (tran_id,deal_id,transaction_status,amount,qty,transaction_date,user_id,withdraw_status,transaction_id,coupon_code)
										VALUES(null,'$deal_id','$payment_status','$payment_gross','$qty','$trn_date','$user_id','$withdraw_status','$txn_id','$coupon_code')";
				mysql_query($sql_trnsaction);
				$payment_flag = 1;

			}

			/* $giftEmailTemplate = '

			<h2>Hey '.$_SESSION['gift_name'].'</h2>

			<p><img height="100" width="100" alt="" src="'.SITE_URL.'images/Giftbox.png" align="left">You have received a gift</p>
			<p>'.$_SESSION['gift_msg'].'</p>
			<p>Your gift coupon code is - '.$coupon_code.'</p>
			'; */

			//echo $giftEmailTemplate;

			if (isset($giftEmailTemplate) && !empty($_SESSION['gift_mail'])) {
								$sql="SELECT * FROM ".TABLE_USERS." where user_id=$_SESSION[user_id]";
								$user=$db->query_first($sql);

								$email = $_SESSION['gift_mail'];
								$subject = "You have got a Gift from ". $user[first_name]." - GeeLaza.com";

								$headers  = 'MIME-Version: 1.0' . "\r\n";
								$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
								$headers .= "From: GeeLaza.com<admin@geelaza.com>". "\r\n" ;

								@mail($email,$subject,$giftEmailTemplate,$headers);
								echo "<p>Your gift has been sent successfully</p>";
						}

			unset($_SESSION['gift_mail']);
			unset($_SESSION['gift_msg']);
			unset($_SESSION['gift_name']);



	}
}
elseif($_POST['payment_system'] == 'maestro')
{

/**
 * PayPal Pro web form request Maestro.
 */

	if (!empty($_POST['paymentType'])) {

		$paymentType =urlencode( $_POST['paymentType']);
		$firstName =urlencode( $_POST['mfirstName']);
		$lastName =urlencode( $_POST['mlastName']);
		$creditCardType =urlencode( $_POST['mcreditCardType']);
		$creditCardNumber = urlencode($_POST['mcreditCardNumber']);
		$expDateMonth =urlencode( $_POST['mexpDateMonth']);

		// Month must be padded with leading zero
		$padDateMonth = str_pad($expDateMonth, 2, '0', STR_PAD_LEFT);


		$expDateYear =urlencode( $_POST['mexpDateYear']);

		$startDateMonth =urlencode( $_POST['mvalDateMonth']);
		$padstartDateMonth = str_pad($startDateMonth, 2, '0', STR_PAD_LEFT);
		$startDateYear =urlencode( $_POST['mvalDateYear']);
		$issueNumber =urlencode( $_POST['missueNumber']);

		$cvv2Number = urlencode($_POST['mcvv2Number']);
		$address1 = urlencode($_POST['maddress1']);
		$address2 = urlencode($_POST['maddress2']);
		$city = urlencode($_POST['mcity']);
		$state =urlencode( $_POST['mstate']);
		$zip = urlencode($_POST['mzip']);
		$amount = urlencode($_POST['payment_amount']);
		//$currencyCode=urlencode($_POST['currency']);
		$currencyCode="GBP";
		$paymentType=urlencode($_POST['paymentType']);

		/* Construct the request string that will be sent to PayPal.
		   The variable $nvpstr contains all the variables and is a
		   name value pair string with & as a delimiter */
		$nvpstr="&PAYMENTACTION=$paymentType&AMT=$amount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber&EXPDATE=".$padDateMonth.$expDateYear."&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName&STREET=$address1&CITY=$city&STATE=$state".
		"&ZIP=$zip&COUNTRYCODE=US&CURRENCYCODE=$currencyCode";

		//.&STARTDATE=".$padstartDateMonth.$startDateYear."&ISSUENUMBER=$issueNumber

		/* Make the API call to PayPal, using API signature.
		   The API response is stored in an associative array called $resArray */
		$resArray=hash_call("doDirectPayment",$nvpstr);

		/* Display the API response back to the browser.
		   If the response from PayPal was a success, display the response parameters'
		   If the response was an error, display the errors received using APIError.php.
		   */
		$ack = strtoupper($resArray["ACK"]);

		if($ack!="SUCCESS")  {
			$_SESSION['reshash']=$resArray;
			$location = "APIError.php";
				 header("Location: $location");
		   }


		   if ($ack == "SUCCESS") {

				$user_id = $_SESSION['user_id'];
				$deal_id = $custom_expl[1];
				$trn_date = $resArray['TIMESTAMP'];
				$coupon_code = strtoupper(str_rand($length = 13, $seeds = 'alphanum'));

				$txn_id = $resArray['TRANSACTIONID'];
				$payment_status = 'success';
				$qty = $_POST['item_number'];
				$payment_gross = $resArray['AMT'];
				$withdraw_status = 'received';

				$sql_trnsaction = "INSERT INTO ".TABLE_TRANSACTION." (tran_id,deal_id,transaction_status,amount,qty,transaction_date,user_id,withdraw_status,transaction_id,coupon_code)
										VALUES(null,'$deal_id','$payment_status','$payment_gross','$qty','$trn_date','$user_id','$withdraw_status','$txn_id','$coupon_code')";
				mysql_query($sql_trnsaction);
				$payment_flag = 1;

			}
	}
	//var_dump($resArray);
}
elseif($_POST['payment_system'] == 'paypal')
{

/**
 * PayPal IPN web form request
 */

	$qty = $_POST['item_number'];
	$amount_ipn = $_POST['amount'];
	$custom_val = $_POST['custom'];
	$item_name = $_POST['item_name'];

	echo $message="<form action=\"https://www.sandbox.paypal.com/cgi-bin/webscr\" method=\"post\" name=\"frmIPN\">
	<input type=\"hidden\" name=\"notify_url\" value=\"http://unifiedinfotech.net/getdeals/paypal_ipn.php\">
	<input type=\"hidden\" name=\"cmd\" value=\"_xclick\">
	<input type=\"hidden\" name=\"business\" value=\"santan_1313669535_biz@unifiedwebdevelopment.com\">
	<input type=\"hidden\" name=\"item_name\" value=\"$item_name\">
	<input type=\"hidden\" id=\"frm_paypal_total_qty\" name=\"item_number\" value=\"$qty\">
	<input type=\"hidden\" id=\"frm_paypal_total_price\" name=\"amount\" value=\"$amount_ipn\">
	<input type=\"hidden\" name=\"page_style\" value=\"Primary\">
	<input type=\"hidden\" name=\"no_shipping\" value=\"1\">
	<input type=\"hidden\" name=\"return\" value=\"http://unifiedinfotech.net/getdeals/thankyou.php\">
	<input type=\"hidden\" name=\"cancel_return\" value=\"http://unifiedinfotech.net/getdeals/cancel.php\">
	<input type=\"hidden\" name=\"no_note\" value=\"1\">
	<input type=\"hidden\" name=\"currency_code\" value=\"GBP\">
	<input type=\"hidden\" name=\"custom\" value=\"$custom_val\"> <p>

	<script type=\"text/javascript\">document.frmIPN.submit();</script>

	</form>";

	//<input type=\"submit\" name=\submit\" value=\"Pay\">
	//<input type=\"submit\" name=\submit\" value=\"Buy your ddeal\" class=\"buyu_btn\" style=\"cursor:pointer; font-size:20px;\">



if (!empty($_POST['custom'])) {

		$custom = $_POST['custom'];

		$custom_expl = explode(',', $custom);
		$user_id = $custom_expl[0];
		$deal_id = $custom_expl[1];
		$trn_date = $custom_expl[2];
		$coupon_code = strtoupper(str_rand($length = 13, $seeds = 'alphanum'));

		$txn_id = $_POST['txn_id'];
		//$payment_status = $_POST['payment_status'];
		$payment_status = 'success';
		//$payer_email = $_POST['payer_email'];
		$qty = $_POST['item_number'];
		$payment_gross = $_POST['payment_gross'];
		$withdraw_status = 'received';

		$sql_trnsaction = "INSERT INTO ".TABLE_TRANSACTION." (tran_id,deal_id,transaction_status,amount,qty,transaction_date,user_id,withdraw_status,transaction_id,coupon_code)
								VALUES(null,'$deal_id','$payment_status','$payment_gross','$qty','$trn_date','$user_id','$withdraw_status','$txn_id','$coupon_code')";
		mysql_query($sql_trnsaction);
		$payment_flag = 1;

	}

	/* $giftEmailTemplate = '

			<h2>Hey '.$_SESSION['gift_name'].'</h2>

			<p><img height="100" width="100" alt="" src="'.SITE_URL.'images/Giftbox.png" align="left">You have received a gift</p>
			<p>'.$_SESSION['gift_msg'].'</p>
			<p>Your gift coupon code is - '.$coupon_code.'</p>
			';

			//echo $giftEmailTemplate;

			if (isset($giftEmailTemplate) && !empty($_SESSION['gift_mail'])) {
								$sql="SELECT * FROM ".TABLE_USERS." where user_id=$_SESSION[user_id]";
								$user=$db->query_first($sql);

								$email = $_SESSION['gift_mail'];
								$subject = "You have got a Gift from ". $user[first_name]." - GeeLaza.com";

								$headers  = 'MIME-Version: 1.0' . "\r\n";
								$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
								$headers .= "From: GeeLaza.com<admin@geelaza.com>". "\r\n" ;

								@mail($email,$subject,$giftEmailTemplate,$headers);
								echo "<p>Your gift has been sent successfully</p>";
						}

			unset($_SESSION['gift_mail']);
			unset($_SESSION['gift_msg']);
			unset($_SESSION['gift_name']); */

}


?>

<div class="deal_info">
<div class="top_about">

<p>Thankyou</p>


</div>
<div class="clear"></div>
<div class="midbg">
<div class="today_deal">

<h1>Thank you for buying!</h1>
<!--
<script type="text/javascript">
setTimeout(function () {
	   window.location.href= '<?php echo SITE_URL; ?>'; // the redirect goes here

	},30000);

</script>
 -->
<pre>
<?php
if ($payment_flag == 1) {

$email_Template_1 = '
		<table width="760" border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr>
		   <td bgcolor="#f6f3e8" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color:#989595; text-align:center; vertical-align:middle; border: 0;">Add &quot;<a href="#" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color:#989595; text-decoration:none;">voucher@info.geelaza.com</a>&quot; to your address book to ensure you get emails from GeeLaza.</td>
		  </tr>
		  <tr>
		    <td align="center" valign="top"><img src="'.SITE_URL.'images/pdf_img/headerbg1.jpg" alt="" width="760" height="103" /></td>
		  </tr>
		  <tr>
		 <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-bottom:2px solid #000000; border-left:2px solid #000000; border-right:2px solid #000000;">
		      <tr>
		        <td><table width="733" border="0" align="center" cellpadding="0" cellspacing="0">
		          <tr>
		            <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; text-align:left; line-height:16px; color:#000; font-size:13px; font-weight: normal; font-smooth: always;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
		                <tr>
		                  <td width="74%"><p><strong>Thank you very much for your order, '.ucfirst($user['first_name']).' '.ucfirst($user['last_name']).'.</strong></p>
		                      <p>Thank the deal has been successfully closed we\'ll send you the voucher and all relevant information in a separate email.<br />
		                      </p>
		                    <p>Get yourself &pound;5 GeeLaza credit now. Recommend this deal to your friends. We will credit you<br />
		                      to the value of &pound;5 as a reward for every friend you send our way who buys this. or any other<br />
		                      deal on GeeLaza. You can redeem this credit against a future deal of your choice.<br />
		                      </p>
		                    <p>Your Groupon team<br />
		                      </p>
		                    <p><br />
		                    </p></td>
		                  <td width="26%" align="left" valign="top" style="padding: 14px 0;"><table width="150" border="0" align="center" cellpadding="0" cellspacing="0" style="border: 1px solid #b2c59d;">
		                      <tr>
		                        <td bgcolor="#cbeaa7" style="font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bold; line-height: 22px; text-align: center; vertical-align: middle; text-shadow: #e1f5c9 2px 2px 2px;">Advantages to you</td>
		                      </tr>
		                      <tr>
		                        <td bgcolor="#fff8d9"><table width="132" border="0" align="center" cellpadding="0" cellspacing="0">
		                            <tr>
		                              <td align="left" valign="top"><p> &pound;5 GeeLaza credit for every recruited friend</p>
		                                  <p>Redeen your credit againt your next deal.<br />
		                                  </p>
		                                <p>Restaurants. spas, beauty and leisure enjoy GeeLaza with friends. </p></td>
		                            </tr>
		                        </table></td>
		                      </tr>
		                  </table></td>
		                </tr>
		            </table></td>
		          </tr>
		          <tr>
		            <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; text-align:left; line-height:18px; color:#000; font-size:13px; font-weight: normal; font-smooth: always;"><p><strong>Completion of transaction and your right to cancel.</strong> The contact to buy is complete by us sending you this email. The Voucher will be sent to you in a second email shortly atter. You may cancel the transdaction by writing to us within 5 working days of Voucher receipt(prior to any redemption of the Voucher being made).</p>
		           <p><strong>National Deal is not your city? Choose your city:</strong><br/>
		           You can find interesting and up-to-date deals in these cities,</p></td>
		          </tr>
		          <tr>
		            <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; text-align:left; line-height:18px; color:#000; font-size:13px; font-weight: normal; font-smooth: always;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
		                <tr>
		                <td>&nbsp;</td>
		                </tr>
		                <tr>
		                  <td><table width="720"border="0" cellspacing="0" cellpadding="0">
								  <tr>
								    <td width="128" valign="top" style="list-style-type:none;"><ul>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=62" style="color:#4292e4; text-decoration:none; line-height: 15px;">&raquo; Aberdeen</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=68" style="color:#4292e4; line-height: 19px; text-decoration:none;">&raquo; Belfast</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=4" style="color:#4292e4; text-decoration:none;">&raquo; Birmingham</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=3" style="color:#4292e4; text-decoration:none;">&raquo; Bournemouth</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=5" style="color:#4292e4; text-decoration:none;">&raquo; Bradford</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=6" style="color:#4292e4; text-decoration:none;">&raquo; Brighton</a></li>
								      </ul>
								      <p>&nbsp;</p></td>
								    <td width="128" valign="top"><ul>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=1" style="color:#4292e4; text-decoration:none;">&raquo; Bath</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=7" style="color:#4292e4; text-decoration:none;">&raquo; Cambridge</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=67" style="color:#4292e4; text-decoration:none;">&raquo; Cardiff</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=14" style="color:#4292e4; text-decoration:none;">&raquo; Coventry</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=15" style="color:#4292e4; text-decoration:none;">&raquo; Derby</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=65" style="color:#4292e4; text-decoration:none;">&raquo; Dublin</a></li>
								      </ul></td>
								    <td width="128" valign="top"><ul>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=67" style="color:#4292e4; text-decoration:none;">&raquo; Dudley</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=70" style="color:#4292e4; text-decoration:none;">&raquo; Edinburgh</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=74" style="color:#4292e4; text-decoration:none;">&raquo; Glasgow</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=22" style="color:#4292e4; text-decoration:none;">&raquo; Hull</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=26" style="color:#4292e4; text-decoration:none;">&raquo; Leeds</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=27" style="color:#4292e4; text-decoration:none;">&raquo; Leicester</a></li>
								      </ul></td>
								    <td width="128" valign="top"><ul>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=30" style="color:#4292e4; text-decoration:none;">&raquo; Liverpool</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=31" style="color:#4292e4; text-decoration:none;">&raquo; London</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=70" style="color:#4292e4; text-decoration:none;">&raquo; Manchester</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=38" style="color:#4292e4; text-decoration:none;">&raquo; Newcastle</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=40" style="color:#4292e4; text-decoration:none;">&raquo; Nottingham</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=41" style="color:#4292e4; text-decoration:none;">&raquo; Oxford</a></li>
								      </ul></td>
								    <td width="138" valign="top"><ul>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=43" style="color:#4292e4; text-decoration:none;">&raquo; Plymouth</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=46" style="color:#4292e4; text-decoration:none;">&raquo; Reading</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=50" style="color:#4292e4; text-decoration:none;">&raquo; Sheffield</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=51" style="color:#4292e4; text-decoration:none;">&raquo; Southampton</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'?city=60" style="color:#4292e4; text-decoration:none;">&raquo; Wolverhampton</a></li>
								        <li style="list-style-type:none;"><a href="'.SITE_URL.'" style="color:#4292e4; text-decoration:none;">&raquo; More cities</a></li>
								      </ul></td>
								  </tr>
								</table>
		                  </td>
		                </tr>
		            </table></td>
		          </tr>
		          <tr>
		            <td align="left" valign="top" style="font-family: Times New Roman, Times, serif; text-align:left; line-height:28px; color:#6d6969; font-size:22px; font-weight: bold; font-smooth: always; border-bottom: 1px dashed #6d6969;">Our Order Details</td>
		          </tr>
		          <tr>
		            <td height="40" align="left" valign="middle" style="font-family: Arial, Helvetica, sans-serif; text-align:left; line-height:18px; color:#000; font-size:13px; font-weight: normal; font-smooth: always;">Please check the following details</td>
		          </tr>
		          <tr>
		            <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; text-align:left; line-height:18px; color:#000; font-size:13px; font-weight: normal; font-smooth: always;"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border: 1px solid #d2d2d2;">
		                <tr>
		                  <td width="18%" bgcolor="#ececec" style="border-right: 1px solid #d2d2d2; border-bottom: 1px solid #d2d2d2; font-family: Times New Roman, Times, serif; text-align:left; line-height:28px; color:#2c2a2a; font-size:18px; font-weight: normal; font-smooth: always; padding: 4px 6px;">GeeLaza Title </td>
		                  <td width="82%" style="border-bottom: 1px solid #d2d2d2; padding: 0 6px;">'.$deal_details['title'].'(worth &pound;'.intval($deal_details['full_price']).')</td>
		                </tr>
		                <tr>
		                  <td bgcolor="#ececec" style="border-right: 1px solid #d2d2d2; border-bottom: 1px solid #d2d2d2; font-family: Times New Roman, Times, serif; text-align:left; line-height:28px; color:#2c2a2a; font-size:18px; font-weight: normal; font-smooth: always; padding: 4px 6px;">Price </td>
		                  <td style="border-bottom: 1px solid #d2d2d2; padding: 0 6px;">&pound;'.intval($deal_details['discounted_price']).'</td>
		                </tr>
		                <tr>
		                  <td bgcolor="#ececec" style="border-right: 1px solid #d2d2d2; border-bottom: 1px solid #d2d2d2; font-family: Times New Roman, Times, serif; text-align:left; line-height:28px; color:#2c2a2a; font-size:18px; font-weight: normal; font-smooth: always; padding: 4px 6px;">Discount</td>
		                  <td style="border-bottom: 1px solid #d2d2d2; padding: 0 6px;">&pound;'.intval($deal_details['full_price'] - $deal_details['discounted_price']).'</td>
		                </tr>
		                <tr>
		                  <td bgcolor="#ececec" style="border-right: 1px solid #d2d2d2; border-bottom: 1px solid #d2d2d2; font-family: Times New Roman, Times, serif; text-align:left; line-height:28px; color:#2c2a2a; font-size:18px; font-weight: normal; font-smooth: always; padding: 4px 6px;">Quantity</td>
		                  <td style="border-bottom: 1px solid #d2d2d2; padding: 0 6px;">'.$qty.'</td>
		                </tr>
		                <tr>
		                  <td bgcolor="#f2f0c0" style="border-right: 1px solid #d2d2d2; font-family: Times New Roman, Times, serif; text-align:left; line-height:28px; color:#2c2a2a; font-size:22px; font-weight: bold; font-smooth: always; padding: 4px 6px;">Total</td>
		                  <td bgcolor="#f2f0c0" style="padding: 0 6px; font-family: Times New Roman, Times, serif; text-align:left; line-height:28px; color:#2c2a2a; font-size:22px; font-weight: bold; font-smooth: always; padding: 4px 6px;">&pound;'.$payment_gross.'</td>
		                </tr>
		            </table></td>
		          </tr>
		          <tr>
		            <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; text-align:left; line-height:18px; color:#000; font-size:13px; font-weight: normal; font-smooth: always;">&nbsp;</td>
		          </tr>
		            <tr>
		            <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; text-align:left; line-height:18px; color:#000; font-size:13px; font-weight: normal; font-smooth: always;">&nbsp;</td>
		          </tr>
		        </table></td>
		      </tr>
		    </table></td>
		  </tr>
		  <tr>
		  <td bgcolor="#f6f3e8" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color:#989595; text-align:center; vertical-align:middle; border: 0;"> &copy; <a href="'.SITE_URL.'" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color:#989595; text-decoration:none;">GeeLaza.com</a> | <a href="'.SITE_URL.'page.php?page=Terms%20and%20Conditions" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color:#989595; text-decoration:none;">Terms & Conditions</a> | <a href="'.SITE_URL.'page.php?page=About%20GeeLaza%20UK" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color:#989595; text-decoration:none;">About GeeLaza</a> | <a href="'.SITE_URL.'faq.php" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color:#989595; text-decoration:none;">FAQ</a> | <a href="'.SITE_URL.'merchant_business.php" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color:#989595; text-decoration:none;">Get Your Business Featured On Geelaza</a></td>
		  </tr>
		</table>

		';

//		echo $email_Template_1;
		$subject = "GeeLaza - your order has been received";

		$sql="SELECT * FROM ".TABLE_ADMIN." where admin_name='admin'";
		$admin=$db->query_first($sql);

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "From: GeeLaza<voucher@geelaza.com>". "\r\n" ;

		@mail($user['email'],$subject,$email_Template_1,$headers);



$email_Template_2 = '<table width="760" border="0" align="center" cellpadding="0" cellspacing="0">
					   <tr>
					    <td align="center" valign="top"><img src="'.SITE_URL.'images/pdf_img/headerbg1.jpg" alt="" width="760" height="100" /></td>
					  </tr>
					  <tr>
					 <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-bottom:2px solid #000000; border-left:2px solid #000000; border-right:2px solid #000000;">
					      <tr>
					        <td align="left" valign="top" style="padding:8px 0 0 0; font-family: Arial, Helvetica, sans-serif; text-align:left; line-height:16px; color:#000; font-size:13px; font-weight: normal; font-smooth: always;"><table width="733" border="0" align="center" cellpadding="0" cellspacing="0">
					          <tr>
					            <td colspan="2" align="left" valign="top"><p><strong>Congratulations!</strong><br/><br/>
					Thanks to your support the deal was a success!<br/><br/>
					The total cost has been deducted from your account via your  selected payment method.</p></td>
					          </tr>
					          <tr>
					            <td colspan="2" align="left" valign="top">&nbsp;</td>
					          </tr>
					          <tr>
					            <td colspan="2" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="background:#ecf8dd; border: 1px solid #a9bc93;">
					              <tr>
					                <td><table width="710" border="0" align="center" cellpadding="0" cellspacing="0" style="padding: 6px 0;">
					                  <tr>
					                    <td><p>You now receive your personal voucher as an attachment to  this mail.<br />
					                      This is how you use it:</p></td>
					                  </tr>
					                  <tr>
					                    <td style="font-weight:bold; line-height: 20px;"><ol>
					                         <li><em>Open the pdf file attachment</em></li>
					                         <li><em>Print voucher</em></li>
					                         <li><em>Take note of the fine print</em></li>
					                         <li><em>Redeem your voucher</em></li>
					                         </ol></td>
					                  </tr>
					                </table></td>
					              </tr>
					            </table></td>
					          </tr>
					          <tr>
					            <td colspan="2" align="left" valign="top">&nbsp;</td>
					          </tr>
					          <tr>
					            <td width="39" align="left" valign="top"><p><img src="'.SITE_URL.'images/i_icon.gif" alt="" width="31" height="33" /></p></td>
					            <td width="694" align="left" valign="top"><p>No PDF? No Problem!<br />
					              Download Adobe Acrobat Reader free at <a href="http://get.adobe.com/reader" style="color:#2b4bd1; text-decoration:none;">http://get.adobe.com/reader</a></p></td>
					          </tr>
					          <tr>
					          <td colspan="2" align="left" valign="top"><p><strong>Your voucher details</strong><br /><br />
					            YOUR GEELA CODE is <strong>'.$coupon_code.'</strong> and this deal is valid from  09/02/2012 to 08/05/12.<br /><br />
					            We have also attached a PDF document of your GeeLaza deal to  this email, which you may need to print out.<br /><br />
					            Make sure you check the ‘valid from’ and ‘valid to’ dates.  You won’t be able to use your GeeLaza Deal after these dates. For some details  you may be required to give your GeeLaza voucher to a member of staff (or  merchant) – so remember to print it out and take it with you!<br /><br />
					            If you have any problems please email <a href="mailto:support@geelaza.com" style="color:#000; text-decoration:none;">support@geelaza.com</a> or visit our  website’s <a href="'.SITE_URL.'faq.php" style="color:#2b4bd1; text-decoration:none; font-weight:bold;">FAQ</a> and don’t forget to check out <a href="'.SITE_URL.'" style="color:#000; text-decoration:none;">www.geelaza.com</a>  for more great deals.<br /><br />The GeeLaza Team</p></td>
					          </tr>
					          <tr>
					            <td colspan="2" align="left" valign="top">&nbsp;</td>
					          </tr>
					          <tr>
					            <td colspan="2" align="left" valign="top"><table width="130" border="0" align="center" cellpadding="0" cellspacing="0">
					              <tr>
					                <td width="65" align="center" valign="middle"><p style="line-height: 27px;"><strong>Follow us: </strong></p></td>
					                <td width="40" align="center" valign="middle"><img src="'.SITE_URL.'images/facebook.gif" alt="" width="25" height="27" /></td>
					                <td width="25" align="right" valign="middle"><img src="'.SITE_URL.'images/twitter.gif" alt="" width="25" height="27" /></td>
					              </tr>
					            </table></td>
					          </tr>
					          <tr>
					            <td colspan="2" align="left" valign="top" style="border-bottom: 1px dashed #666666;">&nbsp;</td>
					          </tr>
					          <tr>
					            <td colspan="2" align="left" valign="top"><p><strong>Other cities:</strong><br/><br/>
					            <a href="'.SITE_URL.'?city=31">London</a>,
					            <a href="'.SITE_URL.'?city=4">Birmingham</a>,
					            <a href="'.SITE_URL.'?city=74">Glasgow</a>,
					            <a href="'.SITE_URL.'?city=65">Dublin</a>,
					            <a href="'.SITE_URL.'?city=30">Liverpool</a>,
					            <a href="'.SITE_URL.'?city=26">Leeds</a>,
					            <a href="'.SITE_URL.'?city=50">Sheffield</a>,
					            <a href="'.SITE_URL.'?city=70">Edinburgh</a>,
					            <a href="'.SITE_URL.'?city=94">Bristol</a>,
					            <a href="'.SITE_URL.'?city=36">Manchester</a>,
					            <a href="'.SITE_URL.'?city=27">Leicester</a>,
					            <a href="'.SITE_URL.'?city=14">Conventry</a>,
					            <a href="'.SITE_URL.'?city=22">Hull</a>,
					            <a href="'.SITE_URL.'?city=5">Bradford</a>,
					            <a href="'.SITE_URL.'?city=67">cardiff</a>,
					            <a href="'.SITE_URL.'?city=68">Belfast</a>.
					            <a href="'.SITE_URL.'" style="color:#2b4bd1; text-decoration:none;">more cities &gt;</a></p></td>
					          </tr>
					          <tr>
					            <td colspan="2" align="left" valign="top">&nbsp;</td>
					          </tr>
					          <tr>
					            <td colspan="2" align="left" valign="top">&nbsp;</td>
					          </tr>
					        </table></td>
					      </tr>
					    </table></td>
					  </tr>
					  <tr>
					 <td bgcolor="#f6f3e8" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 24px; color:#989595; text-align:center; vertical-align:middle; border: 0;"> &copy; <a href="'.SITE_URL.'" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color:#989595; text-decoration:none;">GeeLaza.com</a> | <a href="'.SITE_URL.'page.php?page=Terms%20and%20Conditions" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color:#989595; text-decoration:none;">Terms & Conditions</a> | <a href="'.SITE_URL.'page.php?page=About%20GeeLaza%20UK" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color:#989595; text-decoration:none;">About GeeLaza</a> | <a href="'.SITE_URL.'faq.php" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color:#989595; text-decoration:none;">FAQ</a> | <a href="'.SITE_URL.'merchant_business.php" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color:#989595; text-decoration:none;">Get Your Business Featured On Geelaza</a></td>
					  </tr>
					  </table>';

		$subject = "Voucher for your recently purchased deal";

		$sql="SELECT * FROM ".TABLE_ADMIN." where admin_name='admin'";
		$admin=$db->query_first($sql);

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "From: GeeLaza<voucher@geelaza.com>". "\r\n" ;

		@mail($user['email'],$subject,$email_Template_2,$headers);

//var_dump($_POST);		// PayPal IPN return values


		$get_credit_fee = mysql_fetch_array(mysql_query("SELECT * FROM ".TABLE_SETTING." WHERE name = 'credit_fee'"));
		$credit_fee = $get_credit_fee['value'];

		// Chk buyer if exists in recommendation vault then add 5 pound in credit
			$today = date("Y-m-d");
			$chk_recom_vault_sql = "SELECT * FROM getdeals_credits_vault WHERE user_id  = '$user[email]'";
			$recom_vault_query = mysql_query($chk_recom_vault_sql);
			$chk_recom_vault_row = mysql_num_rows($recom_vault_query);
			if ($chk_recom_vault_row > 0) {
				while ($recom_vault_data = mysql_fetch_array($recom_vault_query)) {
					$recom_vault_data['r_email'];
					$recom_vault_sql = "INSERT INTO getdeals_credits VALUES ('',$_SESSION[user_id],'$credit_fee','$today')";
					mysql_query($recom_vault_sql);
				}	//	end while
			}	// end if
}
//var_dump($resArray); 	// PayPal Pro return values

?>

</pre>






<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="40" /></div>
<div style="width: 702px; float: none; margin: 0 auto; background:#1f1f1f;"><img src="images/logo_bot.gif" alt="" width="207" height="108" /></div>
</div>
</div>
<div class="bot_about"></div>
</div>


</div>
</div>
</div>
</div>
<?php include ('include/footer.php'); ?>
