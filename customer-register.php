<?php
include("include/header.php");
include_once "fbmain.php";
?>
<?php
	if(!isset($_COOKIE["subscribe"]))
	header("location:".SITE_URL);
?>

<?php
	  if (!empty($fbUser)) {

	  	//echo '<pre>'.print_r($fbUser, TRUE).'</pre>';


	  		$fbUser['date_added'] = time();
	  		$fbUser['last_updated'] = time();


	 		//$fbUser['name'];
      		$fbUser['first_name'];
      		$fbUser['last_name'];
      		$fbUser['email'];
      		//echo $fbUser['birthday'];


				$sql_chk_fb_user = "SELECT * FROM ".TABLE_FB_USER." WHERE email = '".$fbUser['email']."'";
				$chk_fb_user_res = mysql_fetch_array(mysql_query($sql_chk_fb_user));
				$count_fb_user = mysql_num_rows(mysql_query($sql_chk_fb_user));

				if($count_fb_user > 0)		//  Register & login via fb
				{
					// Update user if already registered
					$fbUser['jumblr_status'] = 1;
					$db->query_update(TABLE_FB_USER, $fbUser, 'fb_id ='.$fbUser['fb_id']);
					$_SESSION["user_id"] = $chk_fb_user_res['user_id'];
					$_SESSION["fb_id"] = $chk_fb_user_res['fb_id'];
					//sleep(30);
					//header('location: '.SITE_URL.'?city=31');

					$cookie_expiry_time = time()+(3600000*24*1);
					$subscribeCookie= explode('|', $_COOKIE[subscribe]);
					$subscribeCookie[1] = 1;
					$subscribeCookie[0] = 1;	// Default city bath
					//print_r($subscribeCookie);
					$subscribeCookieVal = implode('|', $subscribeCookie);
					setcookie('subscribe',$subscribeCookieVal,$cookie_expiry_time);

					header('location: '.SITE_URL.'my-profile.php');
					exit();
					//echo "fine";
				}
				else {
					// Insert data to fb table
					$last_user_id['user_id'] = $db->query_insert(TABLE_FB_USER, $fbUser);
					$db->query_update(TABLE_FB_USER, $last_user_id, 'fb_id ='.$fbUser['fb_id']);
					//sleep(30);

					$cookie_expiry_time = time()+(3600000*24*1);
					$subscribeCookie= explode('|', $_COOKIE[subscribe]);
					$subscribeCookie[1] = 1;
					$subscribeCookie[0] = 1;	// Default city Bath
					//print_r($subscribeCookie);
					$subscribeCookieVal = implode('|', $subscribeCookie);
					setcookie('subscribe',$subscribeCookieVal,$cookie_expiry_time);

					header('location: '.SITE_URL.'my-profile.php');
					exit();

					/*
					 * $sql_insert = "INSERT INTO ".TABLE_USERS.
						  "(first_name,last_name,email,phone_no,password,dob,address1,address2,zip,city,date_added,reg_type,status)
						  VALUES('".$fname."','".$lname."','".$email."','".$phno."','".$password."','".$dob."','".$add1."','".$add2."','".$postcode."','".$city."','".$date."','regular',1)";

						mysql_query($sql_insert);
					 *
					 */
				}

			}



?>
<div id="container" style="background: none;">
<div id="leftcol" style="float: none;">
<div class="deal_info" style="float: none;">
<div class="green_curv10" style="width: 704px;"></div>
<div class="clear"></div>
<div class="green_curv30" style="width: 704px;">
<div class="today_deal">
<div class="register_box1">

<div class="clear"></div>
<center><img alt="" src="images/loader_new.gif"> <h3>Please wait while we are registering you with Jumbr!...</h3></center>
</div>
</div>
</div>
<div class="green_curv20" style="width: 704px;"></div>
</div>
</div>
<?php //include ('include/sidebar-login.php'); ?>
</div>
</div>
<?php include("include/footer.php");?>