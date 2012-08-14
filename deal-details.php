<?php
include("include/header.php");
	if(!isset($_COOKIE["subscribe"]))
	//header("location:index.php");

	{
		$cookie_val = $_COOKIE["subscribe"];
		$arr = explode("|",$cookie_val);

		$email = $arr[0];
		$city_id = $arr[1];
	}

?>

<?php
if ($city_id != "") {
	$deal_city = $city_id;
	$today_city = "SELECT * FROM ".TABLE_CITIES." WHERE city_name = '$deal_city' AND status = 1";
	$today_city_res = mysql_fetch_array(mysql_query($today_city));
	$today_city_res['city_id'];
}


if (($_GET['action'] != "") && ($_GET['id'] != "")) {
	$action = $_GET['action'];
	$deal_id = $_GET['id'];

	$sql_today = "SELECT *,DATEDIFF(`deal_end_time`,`deal_start_time`) as date_diff FROM ".TABLE_DEALS." WHERE status >= 1 AND deal_id = '".$deal_id."' AND deal_start_time <= '".date("Y-m-d G:i:s")."' AND deal_end_time >= '".date("Y-m-d G:i:s")."'  LIMIT 0, 1";
	$today_res = mysql_fetch_array(mysql_query($sql_today));

	$sql_todays_buy = "SELECT SUM(qty) FROM ".TABLE_TRANSACTION." WHERE deal_id = ".$today_res['deal_id'];
	$total_buy = mysql_fetch_array(mysql_query($sql_todays_buy));

	$sql_todays_image = "SELECT * FROM ".TABLE_DEAL_IMAGES." WHERE deal_id = ".$today_res['deal_id'];
	$todays_image = mysql_fetch_array(mysql_query($sql_todays_image));
	$todays_image_count = mysql_num_rows(mysql_query($sql_todays_image));
	//$todays_image_res = mysql_query($sql_todays_image);

	// select multi deal if has
	if ($today_res['is_multi'] == 'y') {
	$sql_is_multi = "SELECT * FROM jumblr_multi_deals WHERE deal_id = ".$today_res['deal_id'];
	$is_multi = mysql_fetch_array(mysql_query($sql_is_multi));
	}

}
elseif(($_GET['id'] != ''))
{
	$deal_id = $_GET['id'];
	$sql_today = "SELECT *,DATEDIFF(`deal_end_time`,`deal_start_time`) as date_diff FROM ".TABLE_DEALS." WHERE status >= 1 AND deal_id = '".$deal_id."' AND deal_start_time <= '".date("Y-m-d G:i:s")."' AND deal_end_time >= '".date("Y-m-d G:i:s")."'  LIMIT 0, 1";
	$today_res = mysql_fetch_array(mysql_query($sql_today));

	$sql_todays_buy = "SELECT SUM(qty) FROM ".TABLE_TRANSACTION." WHERE deal_id = ".$today_res['deal_id'];
	$total_buy = mysql_fetch_array(mysql_query($sql_todays_buy));

	$sql_todays_image = "SELECT * FROM ".TABLE_DEAL_IMAGES." WHERE deal_id = ".$today_res['deal_id'];
	$todays_image = mysql_fetch_array(mysql_query($sql_todays_image));
	$todays_image_count = mysql_num_rows(mysql_query($sql_todays_image));
	//$todays_image_res = mysql_query($sql_todays_image);
}
else {
$city = end(explode("|",$_COOKIE['subscribe']));
	$sql_today = "SELECT *, DATEDIFF(`deal_end_time`,`deal_start_time`) as date_diff FROM ".TABLE_DEALS." WHERE status >= 1 AND deal_start_time <= '".date("Y-m-d G:i:s")."' AND deal_end_time >= '".date("Y-m-d G:i:s")."' AND city = $city LIMIT 0, 1";
	//$sql_today = "SELECT * FROM ".TABLE_DEALS." WHERE status >= 1 AND deal_end_time LIKE '".date("Y-m-d")."%' LIMIT 0, 1";
	$today_res = mysql_fetch_array(mysql_query($sql_today));

	// select multi deal if has
	if ($today_res['is_multi'] == 'y') {
	$sql_is_multi = "SELECT * FROM jumblr_multi_deals WHERE deal_id = ".$today_res['deal_id'];
	$is_multi = mysql_fetch_array(mysql_query($sql_is_multi));
	}

	$num_rows = mysql_num_rows(mysql_query($sql_today)) ;

		if ($num_rows > 0) {

			$sql_todays_buy = "SELECT SUM(qty) FROM ".TABLE_TRANSACTION." WHERE deal_id = ".$today_res['deal_id'];
			$total_buy = mysql_fetch_array(mysql_query($sql_todays_buy));

			$sql_todays_image = "SELECT * FROM ".TABLE_DEAL_IMAGES." WHERE deal_id = ".$today_res['deal_id'];
			$todays_image = mysql_fetch_array(mysql_query($sql_todays_image));
			$todays_image_count = mysql_num_rows(mysql_query($sql_todays_image));
			//$todays_image_res = mysql_query($sql_todays_image);

		}
}	// end else
$_SESSION['current_deal_id'] = $today_res['deal_id'];
?>

<?php if ($num_rows > 0 || $_GET['action'] == "sold" || $_GET['action'] == "view") { ?>

			<div class="todays_deal">
            	<div class="todays_deal_img"></div>
                <div class="reffer_friend" style="z-index: 1;"></div>
            	<h1 style="margin-left:48px;">
            		<?php if ($_GET['action'] != "sold") { ?>
						<a href="<?php echo SITE_URL; ?>customer-payment.php?item=<?php echo $today_res['deal_id']; ?>">
					<?php } if ($today_res['is_multi'] == 'y') { ?>
						<a id="gift" href="#multi_deal_popup">
					<?php } ?>
							<span style="color:#5b8f32; text-decoration: none;"><?php echo strip_tags($today_res['title']); ?></span>
					<?php if ($_GET['action'] != "sold") { ?>
						</a>
					<?php } ?>
            	</h1>
                <div class="todays_deal_left">
                    <ul>
                    	<li>
                    		<?php if ($todays_image_count > 0 ) { ?>
                    		<img src="<?php echo UPLOAD_PATH.$todays_image['file']; ?>" class="image0" width="348px" height="307px">
                    		<?php } else { ?>
                    		<img src="images/no_img2.jpg" class="image0" width="348px" height="307px">
                    		<?php } ?>
                    	</li>
                        <li>&nbsp;</li>
                        <li class="share">

                            <!-- <img src="images/social_02.png" alt="">

                            <img src="images/social_03.png" alt="">

                            <a name="fb_share" type="icon"><img src="images/social_04.png" alt=""></a>
							<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share"
							        type="text/javascript">
							</script>

                            <img src="images/social_05.png" alt=""> -->

                            <!-- AddThis Button BEGIN -->
							<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
							<div style="float: left;">
							Share The Deal:
                        	<!-- <a <?php if (isset($_SESSION['user_id'])) { ?>href="#inline1" id="various1" <?php } else { ?>href="<?php echo SITE_URL; ?>recomendation.php"<?php } ?>>
                            <img src="images/social_01.png" alt="">
                            </a> -->
							</div>
							<a class="addthis_button_email"></a>
							<a class="addthis_button_blogger"></a>
							<a class="addthis_button_twitter"></a>
							<a class="addthis_button_facebook"></a>
							<a class="addthis_button_google_plusone_share"></a>
							</div>
							<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4fe2b61371e640b5"></script>
							<!-- AddThis Button END -->

                         </li>
                    </ul>
                </div>
                <div class="todays_deal_middle">
                	<div class="amount">Amount: <span><?php echo getSettings(currency_symbol); ?><?php echo ($today_res['is_multi'] == 'n' ? number_format($today_res['discounted_price'], 2) : number_format($is_multi['multi_deal_item_price'], 2)); ?></span></div>
                    <div class="available">
                    	<?php /*if ($_GET['action'] != "sold") {
					   			if($total_buy[0] != 0) {echo $total_buy[0].' Bought!';} else {echo "Not Yet Bought!";}
					   		 	}*/
					   		if ($_GET['action'] == "sold") { echo "<h3>Deal Completed!</h3>";} else {

					   		?>
                    	<div style="border-right:1px solid #d2d2d2;">
                        	Available<br>
                        	<strong>
								<?php echo intval($today_res['max_coupons'] - $total_buy[0]); ?>
							</strong>
                        </div>
                        <div>
                        	Attending<br>
							<strong>
                        	<?php if ($total_buy[0] >= $today_res['min_coupons']) {

					   		if ($_GET['action'] != "sold") {
					   			if($total_buy[0] != 0) {echo $total_buy[0];} else {echo "0";}
					   		 	}
					   		//if ($_GET['action'] == "sold") { echo "Deal Completed!";}
						   	} else {
						   		if ($_GET['action'] != "sold") {
						   			if($total_buy[0] != 0) {echo $total_buy[0];} else {echo "0";}
						   		 	}
						   		//if ($_GET['action'] == "sold") { echo "Deal Completed!";}
						   	}
						   	?>


                        	</strong>
                        </div>
                        <?php } 	// end deal completed ?>
                    </div>
                  <div class="rating">Group rating: <span>72</span></div>
                 <div class="timer"><img src="images/clock.png" alt=""><?php echo date("<b>D</b> M j | <b>g:i A</b>", strtotime($today_res['deal_end_time'])); ?></div>

                 <div class="timer" style="padding:7px 0; height:54px;">
                 	<?php if ($_GET['action'] == "sold") { ?>
				   	<div class="tab_button1"></div>
				   <?php } else { ?>
					   	<?php if ($today_res['is_multi'] == 'n') { ?>
					   	<a href="<?php echo SITE_URL; ?>customer-payment.php?item=<?php echo $today_res['deal_id']; ?>">
					   		<img src="images/buy_nowbtn.png" alt="">
					   	</a>
					   	<?php } else { ?>
					   	<a id="various4" href="#multi_deal_popup">
					   		<img src="images/buy_nowbtn.png" alt="">
					   	</a>
					   	<?php } ?>
				   <?php } ?>


                 </div>
                 <div class="clear"></div>
                  <div style="margin: 21px 0 0 -60px; width: 270px; font-size: 11px; text-align:left;">
                 <img src="images/pointer.png" alt="" align="absmiddle"><a href="javascript: void(0);" id="locateDealMap" style="padding: 10px; color:#9a9a9a;">Locate this deal</a>
                 </div>
                </div>
                <div class="todays_deal_right" id="click">
                      <!-- <img src="images/member.png" alt=""> -->
				<!-- Members circle starts -->
				<?php
                 	$dealPurUser = $db->fetch_all_array("SELECT DISTINCT(user_id) FROM jumblr_transaction as tran WHERE deal_id = $today_res[deal_id]");
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
					$circleUserCount = mysql_num_rows($db->query("SELECT DISTINCT(user_id) FROM jumblr_transaction as tran WHERE deal_id = $today_res[deal_id]"));

					foreach ($circleUser as $fbUser) {
			        			$groupRating += comp_user($fbUser['user_id']);
	        		}
	        		$averageGroupRating = $groupRating/$circleUserCount;
				?>

					<div class="circleDiv">
					<div class="innerCircle">
					<div class="cat_circle"><img class="tips" src="images/cat_icon1.png" width="100" height="100" title="<br/>Click to See the Jumblrs!<br/><br/>"/></div>
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
             <div class="clear"></div>
            </div>

			<?php include 'multi-deal-popup.php';?>

<?php } else {?>

<!-- No deal layout starts -->

<div class="midbg">
<div class="today_deal">



						<?php
							$sql_nodeal_city = "SELECT * FROM ".TABLE_CITIES." WHERE city_id = $city";
							$result_nodeal_city = mysql_query($sql_nodeal_city);
							$row_nodeal_city = mysql_fetch_array($result_nodeal_city);
						?>
	  <div class="coming_soon">
	  <div class="coming_soon_top"></div>
	  <div class="coming_soon_mid">
	  <div class="coming_left">
	   <img src="images/coming_small10.gif" alt="" width="322" height="224"/></div>
	  <div class="coming_right">
	 <div>
	 <p>COMING SOON: THE BEST DEALS THAT <?php echo strtoupper($row_nodeal_city[city_name]); ?> HAS TO OFFER</p>
	 </div>
	 <div style="margin:20px auto;">
	 Discover your city upto 90% off See your city in a brand new light with Jumblr. New and diverse deals on spa, beauty, leisure, restaurents and sport bring Jumblr customers excitement for upto 90% less, every single day. But it's not just about presenting deals, Jumblr...</div>
	 <div class="clear"></div>
	 <div class="sendbtn"><a id="nodeal_info_btn" href="#more_info_div"></a></div>
	 <div style="float: right; margin: 4px auto; width: 90px; font: bold 22px/24px Arial, Helvetica, sans-serif; color:#3d3a3a;">- 90%</div>
	  </div>
	  </div>
	  <div class="coming_soon_bot"></div>
	  </div>


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
<?php } ?>

<?php  if ($circleUserCount > 0) { ?>
<!-- jumblr deal members drop down start -->
<div class="todays_deal" id="locations" style="margin-top: -35px; z-index: 0; display: block; border: 0px solid red;">
				<?php  if ($circleUserCount < 9) { ?>
					<script type='text/javascript'>
						$(document).ready(function() {
							$('div.ca-nav').css({display: 'none'});});
					</script>
				<?php } ?>

                  <div id="ca-container" class="ca-container" style="height: 620px;">
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

						<!-- <div class="ca-item ca-item-3">
                          <div class="jewellry_img_box">
                           <img src="images/animal3.png" alt="" height="80" width="80">
                           </div>
                           <div class="point">120</div>
                        </div>
                        -->
                        <div class="clear"></div>

<!-- Comment starts -->
					<div style="padding: 50px 0 0 0; margin-top: 100px;">
				  	  <h4>Deal Group Discussion Broad:</h4>
                    </div>
                    <div class="clear"></div>
                    <div class="comment_box" id="comment_box" style="margin-top: 10px; padding: 10px; height: 280px; overflow-x:hidden; overflow-y:scroll;">

				<?php

					$commentSql = "SELECT * FROM ".TABLE_DEAL_GROUP." WHERE fb_id IN (SELECT DISTINCT(user_id) FROM jumblr_transaction as tran WHERE deal_id = $today_res[deal_id]) AND deal_id = $today_res[deal_id]";
					$commentData = $db->fetch_all_array($commentSql);
					//print_r($commentData);
					foreach ($commentData as $comment) {
						//$comment[fb_id];
						$userDetails = getFbUserDetails($comment[fb_id]);
						//print_r($userDetails);
				?>

                       <div class="box3">
                          <div class="box3_top">
                           	 <div class="float_left"><a href="<?php echo $userDetails['profile_url']; ?>"><img src="<?php echo $userDetails['pic_square']; ?>" alt="" width="50" height="50" class="blog"/></a></div>
                               <div class="heading_txt">
                               		<strong><a href="<?php echo $userDetails['profile_url']; ?>"><?php echo $userDetails['name']; ?></a></strong><br/> <?php echo date("F j, Y, g:i a", $comment['date_added']); ?>
                              </div>
                            <div class="clear"></div>
                          </div>
                            <div class="inner_box30">
                               <?php echo $comment[comment]; ?>
                              </div>
                             <div class="clear"></div>
                         </div>

					<?php } ?>

					</div>

					<div id="comment_post_box" style="margin-top: 10px;">
                       <div style="width:60px; float:left;">
						<a href="<?php echo getLoginUserDetails(profile_url); ?>" style="clear:right;"> <img src='<?php echo getLoginUserDetails(pic_square); ?>' alt='' width='50' height='50' class='blog'/></a>
                        </div>
                        <div style="width:700px; float:left;">
                    	<textarea type="textarea" class="textarea" name="comment" id="comment" style="width: 690px; height:50px;" <?php echo (isset($_SESSION['fb_id']) ? '' : 'disabled=disabled') ?>><?php echo (isset($_SESSION['fb_id']) ? '' : 'Please login to post comment!') ?></textarea>
                        </div>
                        <div style="width:40px; float:left;">
                        <input type="button" name="commentPost" id="commentPost" onClick="return post_comment(<?php echo $today_res['deal_id']; ?>);" <?php echo (isset($_SESSION['fb_id']) ? '' : 'disabled=disabled') ?> value="Post" class="post_btn" style="height:60px; width:60px; margin:0"/>
                    	<div class="clear"></div>
                    	</div>
                    </div>
					<div class="clear"></div>


                     <div class="clear"></div>
                    </div>

<!-- Comment ends -->


		     	</div>

             <div class="clear"></div>
            </div>

<?php $userDetails = getFbUserDetails($_SESSION[fb_id]); ?>
<script type="text/javascript">
function post_comment(deal_id) {
	//alert('Hi'); return false;

	//$('.error_orange').hide();
	//$('.error').hide();
	/*  $('input.text-input').css({backgroundColor:"#FFFFFF"});
	  $('input.text-input').focus(function(){
	    $(this).css({backgroundColor:"#FFDDAA"});
	  });
	  $('input.text-input').blur(function(){
	    $(this).css({backgroundColor:"#FFFFFF"});
	  });
	*/

	// validate and process form
	// first hide any error messages
	//$('.error_orange').hide();


	/*	var name = $("input#name").val();
		var email = $("input#cont_email").val();
		var enquery = $("select#enquery").val();
		var phno = $("input#phno").val();
	*/
		var details = $("textarea#comment").val();
		$("textarea#comment").focus();

	var dataString = '&details=' + details + '&deal_id=' + deal_id;
	//alert (dataString);return false;
	if (details != '') {
		$.ajax({
	  type: "POST",
	  url: "ajax_comment.php",
	  data: dataString,
	  success: function() {
	    $('#comment_post_box').append("<div id='message' class='message'></div>");
	    $('#message').html("<p>Thanks for your precious comment.</p>")
	    //.append("<img id='checkmark' src='images/tick.png' />")
	    //.append("<p>Thanks for posting your precious comment!</p>")
	    //.hide()
	    //.fadeIn(1500, function() {
	     // $('#comment_post_box');
	   // });
	    $('#comment_box').append("<div class='box3'><div class='box3_top'><div class='float_left'><img src='<?php echo $userDetails[pic_square]; ?>' alt='' width='50' height='50' class='blog'/></div><div class='heading_txt'><strong><?php echo $userDetails[name]; ?></strong><br/> <?php echo date("F j, Y, g:i a"); ?> </div><div class='clear'></div></div><div class='inner_box30'>"+details+"</div><div class='clear'></div></div>");
	    $('textarea#comment').val(' ');
	  }
	 });

	}
return false;
}
</script>

<!-- jumblr deal members drop down ends -->

<!-- jumblr deal map start -->
<?php
		// Create MapBuilder object.
		$map = new MapBuilder();

		// Set map's center position by latitude and longitude coordinates.
		$map->setCenter($map->getCenterLat(), $map->getCenterLng());
		//$map->getMapMaker();

		/*	API key = AIzaSyC9UNqcEMSb0Y9THkRudR34yQZkvLnRilM */



		// Set the default map type.
		$map->setMapTypeId(MapBuilder::MAP_TYPE_ID_ROADMAP);

		// Set width and height of the map.
		$map->setSize(890, 500);

		// Set default zoom level.
		$map->setZoom(6);

		// Make zoom control compact.
		$map->setZoomControlStyle(MapBuilder::ZOOM_CONTROL_STYLE_SMALL);
		//$map->setMapTypeControl(MapBuilder::MAP_TYPE_CONTROL_STYLE_HORIZONTAL_BAR);

		$markers = array();
		foreach ($dealPurUser as $purUser) {
	                 	$sqlMarker = "SELECT name,pic_square,hometown_location
												FROM jumblr_fb_user
												WHERE fb_id =$purUser[user_id]";
					$markerUser = mysql_fetch_array(mysql_query($sqlMarker), MYSQL_NUM);

					//Get lat lng by human readable adress
					$address = unserialize($markerUser[2]);
					$fomatedAddress = $address[city].'+'.$address[state].'+'.$address[country];
					//print_r($address);
					$lat = reset($map->getLatLng($fomatedAddress));
					$lng = end($map->getLatLng($fomatedAddress));

					$markers[] = array(0=>$markerUser[0], 1=>$lat, 2=>$lng, 3=>'#FF7B6F', 4=>$markerUser[1], 5=>60, 6=>60, 7=>$address[city].','.$address[state].' '.$address[country]);

					//array_push($markers, $markerUser);

					}
					//echo '<pre>'.print_r($markers, true).'</pre>';
					//echo '<pre>'.print_r($markerUser, true).'</pre>';


		// Define locations and add markers with custom icons and attached info windows.
		/*$locations = array(
		    array('Eifel Tower', $lat, $lng, '#FF7B6F', 'http://armdex.com/maps/eifel-tower.jpg', 120, 160),
		    array('The Louvre', 48.8640411, 2.3360444, '#6BE337', 'http://armdex.com/maps/the-louvre.jpg', 160, 111),
		    array('Musee d\'Orsay', 48.860181, 2.3249648, '#E6E325', 'http://armdex.com/maps/musee-dorsay.jpg', 160, 120),
		    array('Jardin du Luxembourg', 48.8469529, 2.337285, '#61A1FF', 'http://armdex.com/maps/jardin-du-luxembourg.jpg', 160, 106),
		    array('Promenade Plantee', 48.856614, 2.3522219, '#FF61E3', 'http://armdex.com/maps/promenade-plantee.jpg', 160, 120)
		);
		echo '<pre>'.print_r($locations, true).'</pre>';
		*/
		foreach ($markers as $i => $location) {
		    $map->addMarker($location[1], $location[2], array(
		        'title' => $location[0],
		        'icon' => 'http://armdex.com/maps/icon' . ($i + 1) . '.png',
		        'html' => '<div><img src="' . $location[4] . '" width="' . $location[5] . '" height="' . $location[6] . '"align="texttop" />' .  $location[7] . '</div><b>' . $location[0] . '</b>',
		        'infoCloseOthers' => true,
		    	'animation' => 'DROP'
		    ));
		}


	?>
<div class="todays_deal" id="dealMap" style="margin-top: -35px; z-index: 0; display: none; border: 0px solid red;">
<?php

	// Display the map.
	$map->show();
?>
</div>

<!-- jumblr deal map start -->

<?php } ?>
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
	<!-- the jScrollPane script
	<script type="text/javascript" src="js/jquery.mousewheel.js"></script>-->
	<script type="text/javascript" src="js/jquery.contentcarousel.js"></script>

		<script type="text/javascript">
			$('#ca-container').contentcarousel();
		</script>



<!-- details start -->


<div class="todays_deal">
	<div class="clear"></div>

		<!-- <h1 style="font: normal 18px/21px Arial, Helvetica, sans-serif;">
			<a href="http://unifiedinfotech.net/jumblr/customer-payment.php?item=126">
				99 instead of 299 for a day of sailing in the Solent, including pick up, breakfast and Champagne lunch with Global Sailing &ndash; save 67%
			</a>
		</h1> -->

		<div id="dealbg_bot1">

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
						$('#tab_'+i).removeClass('here');
						/*if (i == 2) {
							document.getElementById("myaccount_"+i+"_b").style.display = "none";
							}*/

					}
					document.getElementById("myaccount_"+ID).style.display = "block";
					/*document.getElementById("tab_"+ID).style.backgroundPosition = "0% -29px";
					document.getElementById("stab_"+ID).style.backgroundPosition = "100% -29px";
					document.getElementById("tab_"+ID).style.color = "#000";
					document.getElementById("stab_"+ID).style.color = "#000";*/

					$('#tab_'+ID).addClass('here');

					/*if (ID == 2) {
						document.getElementById("myaccount_"+ID+"_b").style.display = "block";
						}*/

				}

				//-->
			</script>

<div style="width:890px; float: left; margin: 0  0 0 8px;">

		   	<div class="tabs">
			<a href="javascript: show_tab(1);" id="tab_1" style="text-decoration: none; margin-right: 0px;">Deal information</a>
			<a href="javascript: show_tab(2);" id="tab_2" style="text-decoration: none; margin-right: 0px;">Highlights</a>
			<a href="javascript: show_tab(3);" id="tab_3" style="text-decoration: none; margin-right: 0px;">Fine Prints</a>
			<a href="javascript: show_tab(4);" id="tab_4" style="text-decoration: none; margin-right: 0px;">Company</a>
			<a href="javascript: show_tab(5);" id="tab_5" style="text-decoration: none; margin-left: 0px;">Postage</a>
			<!-- <a href="javascript: show_tab(6);" id="tab_6">Temp</a> -->
		    </div>

		    <!--<div class="TabbedPanels">
		      <ul>
		        <li><a href="javascript: show_tab(1);" id="tab_1">My Order</a></li>
		        <li><a href="javascript: show_tab(2);" id="tab_2">My Credit</a></li>
		        <li><a href="javascript: show_tab(3);" id="tab_3">General</a></li>
		        <li><a href="javascript: show_tab(4);" id="tab_4">Security</a></li>
		        <li><a href="javascript: show_tab(5);" id="tab_5">Subscriptions</a></li>
		       </ul>
			 </div>-->

		    <div class="TabbedPanelsContent" id="myaccount_1">
				<?php echo $today_res['offer_details']; ?>
		    </div>	<!-- 1 ends here  -->

			<div class="TabbedPanelsContent" id="myaccount_2" style="display:none;">
				<?php echo $today_res['highlights']; ?>
		    </div><!-- 2 ends here  -->


			<div class="TabbedPanelsContent" id="myaccount_3" style="display:none;">
			<?php echo $today_res['fineprint']; ?>
			</div>
			<!-- 3 ends here  -->


			<div class="TabbedPanelsContent" id="myaccount_4" style="display:none;">
				<?php echo $today_res['offer_details_sidebar']; ?>
			</div>
			<!-- 4 ends here  -->

			<div class="TabbedPanelsContent" id="myaccount_5" style="display:none;">
				<?php echo $today_res['postage']; ?>

			</div>
			<!-- 5 ends here  -->

			<div class="TTabbedPanelsContent" id="myaccount_6" style="display:none;">
				6
			</div><!-- 6 ends here  -->

			<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="1"/></div>

		  </div>



			<!--
				<div class="dealbg_left">

				 <?php echo $today_res['offer_details']; ?>


				<br/><br/>
				</div>
				<div class="dealbg_right">
				<div> -->
				<!--<?php echo $today_res['offer_details_sidebar']; ?>
				<div>If you have any question then please don't hesitate to ask GetDeala now.</div>
				<div style="margin: 10px auto;"><a href="#"><img src="images/askme.gif" alt="" width="173" height="36" border="0" /></a></div>
				-->
			<!--	</div>
				<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="40"/></div>
				</div>

			 -->
		</div>



	<div class="clear"></div>
</div>


<!-- details ends -->

</section>
		<!--end body-->
	  <div class="clear"></div>
	</div>
<!--end maincontainer-->
<?php include ('include/footer.php'); ?>