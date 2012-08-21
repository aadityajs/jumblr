<?php
include 'include/header.php';
	$city = end(explode("|",$_COOKIE['subscribe']));
	$deal_cat = $_GET['cat'];
	$deal_type = $_GET['d'];
	$search_date = $_GET['srch'];


	if (isset($deal_cat)) {

		//sql_today_bot_deals = "SELECT *, DATEDIFF(`deal_end_time`,`deal_start_time`) as date_diff FROM ".TABLE_DEALS." WHERE status >= 1 AND deal_start_time <= '".date("Y-m-d G:i:s")."' AND deal_end_time >= '".date("Y-m-d G:i:s")."' AND city = $city LIMIT 1, 2";
		$sql_today_bot_deals = "SELECT * FROM ".TABLE_DEALS." WHERE deal_cat = $deal_cat AND city = $city AND status >= 1 AND deal_end_time >= '".date("Y-m-d G:i:s")."' LIMIT 0, 5";
	} elseif (isset($deal_type)) {
		$deal_type == 'business-generated' ? $deal_type = 'dailydeal' : $deal_type = 'user_deal';
		$sql_today_bot_deals = "SELECT *, DATEDIFF(`deal_end_time`,`deal_start_time`) as date_diff FROM ".TABLE_DEALS." WHERE deal_type = '$deal_type' AND status >= 1  AND city = $city AND deal_start_time <= '".date("Y-m-d G:i:s")."' AND deal_end_time >= '".date("Y-m-d G:i:s")."' LIMIT 0, 10";
		//$sql_today_bot_deals = "SELECT * FROM ".TABLE_DEALS." WHERE deal_type = '$deal_type' AND city = $city AND status >= 1 AND deal_end_time >= '".date("Y-m-d G:i:s")."' LIMIT 0, 5";
	}
	elseif (isset($search_date)) {
    $dt_srch = $_POST['in_date_srch'];
	$array_dt = explode(",",$dt_srch);

	for($i=0;$i<count($array_dt);$i++)
	{
		 $arr[$i]=date("Y-m-d",strtotime($array_dt[$i]));

	}

		$dt=implode("','",$arr);


		/*$start_time = $_POST['date_srch'];
		$end_time = $_POST['date_srch1'];

		$start_time = date("Y-m-d G:i:s",strtotime($_POST['date_srch']));
		$end_time = date("Y-m-d G:i:s",strtotime($_POST['date_srch1']));*/
		//echo date("Y-m-d",$_POST['in_date_srch']);
		$sql_today_bot_deals = "SELECT *  FROM ".TABLE_DEALS." WHERE status >= 1  AND city = $city AND deal_start_time IN ( '$dt ' )   LIMIT 0, 5";
		//echo $sql_today_bot_deals;

	}
	else {
		header('location:'.SITE_URL);
		exit();
	}

	$num_rows = mysql_num_rows(mysql_query($sql_today_bot_deals)) ;
	if ($num_rows > 0) {
	$today_res_bot_deals = mysql_query($sql_today_bot_deals);

	while ($today_row_bot_deals = mysql_fetch_array($today_res_bot_deals)) {
		if ($num_rows > 0) {

			// select multi deal if has
			if ($today_row_bot_deals['is_multi'] == 'y') {
			$sql_is_multi_bot_deals = "SELECT * FROM jumblr_multi_deals WHERE deal_id = ".$today_row_bot_deals['deal_id'];
			$is_multi_bot_deals = mysql_fetch_array(mysql_query($sql_is_multi_bot_deals));
			}

			$sql_todays_buy_bot_deals = "SELECT SUM(qty) FROM ".TABLE_TRANSACTION." WHERE deal_id = ".$today_row_bot_deals['deal_id'];
			$total_buy_bot_deals = mysql_fetch_array(mysql_query($sql_todays_buy_bot_deals));
//print_r($total_buy_bot_deals);exit;
			$sql_todays_image_bot_deals = "SELECT * FROM ".TABLE_DEAL_IMAGES." WHERE deal_id = ".$today_row_bot_deals['deal_id'];
			$todays_image_bot_count = mysql_num_rows(mysql_query($sql_todays_image_bot_deals));
			$todays_image_bot_deals = mysql_fetch_array(mysql_query($sql_todays_image_bot_deals));
			//$todays_image_res = mysql_query($sql_todays_image);

		}	// endif


?>

<div class="todays_deal" style="border:0px solid red;">
                <div class="todays_deal_left" style="width:268px;">
                    <ul>
                    	<li>
                    		<?php if ($todays_image_bot_count > 0) { ?>
                    		<img src="<?php echo UPLOAD_PATH.$todays_image_bot_deals['file']; ?>" class="image0" width="268px" height="236px">
                    		<?php } else { ?>
							<img src="images/no_img2.jpg" class="image0" width="267x" height="235px">
                    		<?php } ?>
                    	</li>
                    </ul>
                </div>
                <div class="todays_deal_right" id="todays_deal_right_circle<?php echo $today_row_bot_deals['deal_id']; ?>" style="margin: 0 35px;">
                   <!-- Members circle starts -->
				<?php
                 	$dealPurUser = $db->fetch_all_array("SELECT DISTINCT(user_id) FROM jumblr_transaction as tran WHERE deal_id = $today_row_bot_deals[deal_id]");
                 	//echo '<pre>'.print_r($dealPurUser, true).'</pre>';

                 	$userArr = array();
                 	foreach ($dealPurUser as $purUser) {
	                 	$sqlCircle = "SELECT *
												FROM jumblr_fb_user
												WHERE fb_id =$purUser[user_id]";
					$circleUser = mysql_fetch_array(mysql_query($sqlCircle));
					array_push($userArr, $circleUser);
					//echo '<pre>'.print_r($userArr, true).'</pre>';
					}
					//echo '<pre>'.print_r($userArr, true).'</pre>';
					$circleUser = $userArr;
					$circleUserCount = mysql_num_rows($db->query("SELECT DISTINCT(user_id) FROM jumblr_transaction as tran WHERE deal_id = $today_row_bot_deals[deal_id]"));

					foreach ($circleUser as $fbUser) {
			        			$groupRating += comp_user($fbUser['user_id']);
	        		}
	        		$averageGroupRating = $groupRating/$circleUserCount;
				?>

					<div class="circleDiv">
					<div class="innerCircle">
					<?php  $category_img_name = get_deal_category_image($today_row_bot_deals['deal_id']) ;?>
					<div class="cat_circle"><img class="tips" src="<?php echo $category_img_name?>" width="100" height="100" title="<br/>Click to See the Jumblrs!<br/><br/>"/></div>
						<?php
							$fbUserCount = 1;
							if ($circleUserCount <= 9) {
								foreach ($circleUser as $fbUser) {
										if ($fbUserCount <= 9) {
											echo '<div id="img'.$fbUserCount.'" class="profile_img">
													<a class="tips" href="my-profile.php?profile-'.$fbUser['fb_id'].'" title="'.$fbUser['name'].'<br/> Live Compatibility : '.comp_user($fbUser['user_id']).'" target="_blank">
														<img src="'.$fbUser['pic_square'].'" alt="" />
													</a>
												</div>';
											$fbUserCount++;
										}
								}
							}	//else{

								/*
								 * foreach ($circleUser as $fbUser) {
											if ($circleUserCount >= $fbUserCount) {
												echo '<div id="img'.$fbUserCount.'" class="profile_img">
														<a class="tips" href="'.$fbUser['profile_url'].'" title="'.$fbUser['name'].'" target="_blank">
															<img src="'.$fbUser['pic_square'].'" alt="" />
														</a>
													</div>';
												$fbUserCount++;
											}
									}
								 */

								for ($i = $circleUserCount+1; $i <= 9; $i++) {
										echo '<div id="img'.$i.'" class="profile_img">
											<a class="tips" href="'.SITE_FB_PROFILE.'" title="We want you here!" target="_blank">
												<img src="images/no_image_profile.png" alt="" />
											</a>
										</div>';
								}
							//}
						?>
						<!-- <div id="img1" class="profile_img"><a class="tips" href='#' title='This is an example of south gravity This is an example of south gravity'><img src="images/prof6.jpg" alt="" /></a></div>
					    <div id="img2" class="profile_img"><a class="tips" href='#' title='This is an example of south gravity'><img src="images/prof2.jpg" alt="" /></a></div>
					    <div id="img3" class="profile_img"><a class="tips" href='#' title='This is an example of south gravity'><img src="images/prof3.jpg" alt="" /></a></div>
					    <div id="img4" class="profile_img"><a class="tips" href='#' title='This is an example of south gravity'><img src="images/prof4.jpg" alt="" /></a></div>
					    <div id="img5" class="profile_img"><a class="tips" href='#' title='This is an example of south gravity'><img src="images/prof5.jpg" alt="" /></a></div>
					    <div id="img6" class="profile_img"><a class="tips" href='#' title='This is an example of south gravity'><img src="images/prof7.jpg" alt="" /></a></div>
					    <div id="img7" class="profile_img"><a class="tips" href='#' title='This is an example of south gravity'><img src="images/prof8.jpg" alt="" /></a></div>
						<div id="img8" class="profile_img"><a class="tips" href='#' title='This is an example of south gravity'><img src="images/prof9.jpg" alt="" /></a></div>
					    <div id="img9" class="profile_img"><a class="tips" href='#' title='This is an example of south gravity'><img src="images/prof9.jpg" alt="" /></a></div> -->
					</div>
				    </div>

				<!-- Members circle ends -->
              </div>
                <div class="todays_deal_middle">

                	<div class="todays_bg"><div class="todays_abc"><?php echo $circleUserCount; ?></div></div>

                	<div class="amount">Amount: <span><?php echo getSettings(currency_symbol); ?><?php echo ($today_row_bot_deals['is_multi'] == 'n' ? number_format($today_row_bot_deals['discounted_price'], 2) : number_format($is_multi_bot_deals['multi_deal_item_price'], 2)); ?></span></span></div>
                    <div class="available">
                    	<div style="border-right:1px solid #d2d2d2;">
                        	Available<br>
                        	<strong>
								<?php echo intval($today_row_bot_deals['max_coupons'] - $total_buy_bot_deals[0]); ?>
							</strong>
                        </div>
                        <div>
                        	Attending<br>
                        	<strong>
                        	<?php if ($total_buy_bot_deals[0] >= $today_row_bot_deals['min_coupons']) {

					   		if ($_GET['action'] != "sold") {
					   			if($total_buy_bot_deals[0] != 0) {echo $total_buy_bot_deals[0];} else {echo "0";}
					   		 	}
					   		//if ($_GET['action'] == "sold") { echo "Deal Completed!";}
						   	} else {
						   		if ($_GET['action'] != "sold") {
						   		if($total_buy_bot_deals[0] != 0) {echo $total_buy_bot_deals[0];} else {echo "0";}
						   		 	}
						   		//if ($_GET['action'] == "sold") { echo "Deal Completed!";}
						   	}
						   	?>
						  <?php /*if ($_GET['action'] != "sold") {
					   			if($total_buy[0] != 0) {echo $total_buy[0].' Bought!';} else {echo "Not Yet Bought!";}
					   		 	}*/
					   		if ($_GET['action'] == "sold") { echo "Deal Completed!";}

					   		?>

                        	</strong>
                        </div>
                    </div>
                  <div class="rating">Group rating: <span><?php echo intval($averageGroupRating); ?></span></div>
                 <div class="timer"><img src="images/clock.png" alt=""><?php echo date("<b>D</b> M j | <b>g:i A</b>", strtotime($today_row_bot_deals['deal_end_time'])); ?></div>
                 <div class="clear"></div>
                </div>
                <div class="clear"></div>
                <h1 style="font: normal 18px/21px Arial, Helvetica, sans-serif;">
                <a href="<?php echo SITE_URL;?>deal-details.php?action=view&id=<?php echo $today_row_bot_deals['deal_id']; ?>">
					   		<?php echo $today_row_bot_deals['title']; ?>
				</a>
                </h1>
               <div class="clear"></div>

				<?php  if ($circleUserCount > 0) { ?>
               <!-- Slider starts -->
				<?php  if ($circleUserCount < 9) { ?>
					<script type='text/javascript'>
						$(document).ready(function() {
							$('div.ca-nav').css({display: 'none'});});
					</script>
				<?php }?>
					<div id="ca-container<?php echo $today_row_bot_deals['deal_id']; ?>" class="ca-container"  style="display: none;">
                    <div class="ca-wrapper">

                        <?php
						foreach ($circleUser as $fbUser) {
		        				echo '<div class="ca-item ca-item-3">
				                          <div class="jewellry_img_box">
				                          	<a class="tips-right" href="'.$fbUser['profile_url'].'" title="'.$fbUser['name'].'" target="_blank">
				                           		<img src="'.$fbUser['pic_square'].'" alt="" height="80" width="80">
				                           	<div class="clear"></div>
				                           	</a>
				                           </div>
				                           <div class="point">'.comp_user($fbUser['user_id']).'</div>
				                        </div>';

			        			$fbUserCount++;
			        			}
						?>
                    </div>
		     	</div>

				<!-- Slider ends -->
				<?php } ?>

            </div>

			<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
			<!-- the jScrollPane script
			<script type="text/javascript" src="js/jquery.mousewheel.js"></script>-->
			<script type="text/javascript" src="js/jquery.contentcarousel.js"></script>

			<script type="text/javascript">
				$('#ca-container<?php echo $today_row_bot_deals['deal_id']; ?>').contentcarousel();
				$("div#todays_deal_right_circle<?php echo $today_row_bot_deals['deal_id']; ?>").click(function () {
					$("div#ca-container<?php echo $today_row_bot_deals['deal_id']; ?>").slideToggle(300);
				});
				$("document").ready(function() {
					$("div#ca-container<?php echo $today_row_bot_deals['deal_id']; ?>").hide();
					$("div#locations").hide();
				});
			</script>

<?php
		}	// endwhile
	} else {	// if no deal found
	?>

<!-- No deal layout starts -->

	<div>


	<div class="todays_deal">
		<?php
            $sql_nodeal_city = "SELECT * FROM ".TABLE_CITIES." WHERE city_id = $city";
            $result_nodeal_city = mysql_query($sql_nodeal_city);
            $row_nodeal_city = mysql_fetch_array($result_nodeal_city);

        ?>
    <div class="moreinfo_top"></div>
      <div class="moreinfo_mid" style="width:890px;">
	  <div class="coming_soon" style="width:850px;">
	  <div class="coming_soon_top"></div>
	  <div class="coming_soon_mid">
	  <div class="coming_left">
	   <img src="images/coming_small10.gif" alt="" width="322" height="224"/></div>
	  <div class="coming_right" style="width:480px;">
	 <div>
	 <p>COMING SOON: THE BEST DEALS THAT <?php echo strtoupper($row_nodeal_city[city_name]); ?> HAS TO OFFER</p>
	 </div>
	 <div style="margin:20px auto;">
	 Discover your city upto 90% off See your city in a brand new light with Jumblr. New and diverse deals on spa, beauty, leisure, restaurents and sport bring Jumblr customers excitement for upto 90% less, every single day. But it's not just about presenting deals, Jumblr...</div>
	 <div class="clear"></div>
	 <!-- <div class="sendbtn"><a id="nodeal_info_btn" href="#more_info_div"></a></div> -->
	 <div style="float: right; margin: 4px auto; width: 90px; font: bold 22px/24px Arial, Helvetica, sans-serif; color:#3d3a3a;">- 90%</div>
	  </div>
	  </div>
	  <div class="coming_soon_bot"></div>
      <div class="clear"></div>
	  </div>
      </div>
     <div class="moreinfo_bot"></div>
	</div>


	<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="4" /></div>
	</div>


<div style="display: none;">
	<div id="more_info_div" >


		<div style="border: 0px solid red;">
		<div class="moreinfo_top"></div>
		<div class="moreinfo_mid">
		<div class="info_midbg">
		<div><h1>Never miss a deal again</h1></div>

		<div class="clear"></div>
		<div style="float: left; width: 216px; margin: 0 auto;"><img src="images/coming_small.gif" alt="" width="216" height="167"/></div>
		<div style="float: right; width: 530px; margin: 30px auto;">
		<div class="soon">COMING SOON</div>
		<div><p>Discover your city for up to 90% off. See your city in a brand new light with Jumblr. We will provide with deals that are simply too good to be missed. We have revolutionised the way people buy deals online. Jumblr brings exciting deals up to 90% off every single day. All deals on Jumblr are the best of their kind. Subscribe today to never miss a deal again and be the first to hear about our new deals.</p></div>
		</div>
		<div class="clear"></div>
		<div class="subs_box">
		<div class="top_cur"></div>
		<div class="mid_cur">
		<div>
		<p>Subscribe to Jumblr newsletters and find out when this or similar deal is
		available again. Subscribing is not registering so to get full access and take advantage of the Jumblr user account, register by clicking <a href="<?php echo SITE_URL.'customer-register.php'; ?>">here</a>.</p>
		</div>
		<div>

		<?php
			if ($_POST['email_subs_btn2'] && $_POST['email_subs_btn2'] == "Submit") {
						$subs_email = $_POST['email_subs2'];
						$date = date("Y-m-d");

						if (!empty($_GET['nd'])) {
							$buttonlink = SITE_URL.'national_deals.php?nd=National%20deals';
						}
						else {
							$buttonlink = SITE_URL.'index.php?city='.$city;
						}

					$chkNewsletterSql = mysql_query("SELECT email FROM ".TABLE_NEWSLETTER." WHERE email = '".$subs_email."' AND city = ".$city);
					//mysql_num_rows(mysql_query($chkNewsletterSql));
					if (mysql_num_rows($chkNewsletterSql) <= 0) {

						$subscribe_sql = "INSERT INTO ".TABLE_NEWSLETTER." (ns_id, email, city, status, date_added) VALUES (NULL, '$subs_email', '$city', 1, '$date')";
						mysql_query($subscribe_sql);
						header('location:'.SITE_URL.'?newssucc=You have successfully subscribed to Jumblr UK newsltter for '.$row_nodeal_city[city_name].' with the following email address: '.$subs_email);
					} else {
						header('location:'.SITE_URL.'?errnewssucc=The email address '.$subs_email.' is already subscribed to Jumblr UK newsletter for '.$row_nodeal_city[city_name].'.');
					}

			}

		?>


		<form name="frm_email_subs2" method="post" onsubmit="javascript: return chk_email_subs2();">
		  <table width="100%" align="center" border="0" cellspacing="3" cellpadding="3" class="submit_box">
		    <tr>
		      <td width="31%">Your email address</td>
		      <td width="69%"><strong>The Jumblr Promise</strong></td>
		    </tr>
		    <tr>
		      <td><input type="text" class="fieldbg_30" name="email_subs2" id="email_subs2" value="Enter your email address" onclick="this.value=''"/><div id="email_subs_error_loc2" class="error_orange"></div></td>
		      <td>If you have any issue with using Jumblr, please contact us and we promise we will make it right</td>
		    </tr>
		    <tr>
		      <td><input type="submit" class="log_in" name="email_subs_btn2" id="email_subs_btn2" value="Submit"/></td>
		      <td>&nbsp;</td>
		    </tr>
		  </table>
		  </form>

				<script type="text/javascript">
					function chk_email_subs2() {
						var email = document.getElementById('email_subs2').value;
						//alert(email);
						if (email == "" || email == "Enter your email address") {
							document.getElementById('email_subs_error_loc2').innerHTML = "Enter your email address";
							return false;
						}
					}
				</script>

		</div>
		</div>
		<div class="bot_cur"></div>
		</div>
		</div>
		</div>
		<div class="moreinfo_bot"></div>
		</div>


	</div>
</div>

<!-- No deal layouot ends -->

	<?php
	}
?>





</div>
<?php
include 'include/footer.php';
?>