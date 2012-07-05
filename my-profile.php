<?php
include 'include/header.php';
isLogin();
?>


<div class="todays_deal">
                <div class="todays_deal_left1" style="width:200px;">
				<?php
					$sqlProfile = "SELECT * FROM ".TABLE_FB_USER." WHERE fb_id = $_SESSION[fb_id]";
					$profileUser = mysql_fetch_array(mysql_query($sqlProfile));
					$profileUserCount = mysql_num_rows($db->query($sqlProfile));
					//print_r($profileUser);

				?>

                <div style="width:200px; float: left; margin: 0 20px 0 0; overflow: hidden; text-align: center;">
				<a href="<?php echo $profileUser['profile_url'];?>" target="_blank"><img src="<?php echo $profileUser['pic_big'];?>" alt="" class="border"></a>

				</div>
                </div>
                <div class="todays_deal_middle03">
                	<div class="amount1"><a style="padding:0; margin:0;" href="<?php echo $profileUser['profile_url'];?>" target="_blank"><?php echo $profileUser['name'];?></a></div>
                    <div style="margin: -10px 10px 10px 10px;"><?php echo $profileUser['email'];?></div>
                    <div class="rating1"><span>72</span></div>
                 <div class="timer03">Compatibility</div>
                 <!--<div class="timer" style="padding:7px 0; height:54px;"><img src="images/buy_nowbtn.png" alt=""></div>
-->                 <div class="clear"></div>
                </div>



                <!--<div class="todays_deal_right">
                   <img src="images/member.png" alt=""></div>-->

             <div class="clear"></div>
			 <div class="todays_deal_left" style="margin: 18px auto;">
                           <!-- AddThis Button BEGIN -->
							<div class="addthis_toolbox addthis_default_style addthis_16x16_style">
							<div style="float: left;">
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
                </div>
				<div class="clear"></div>

				<div class="todays_deal_left" style="margin: 10px 0;">
                <span style="font: bold 14px/18px Arial, Helvetica, sans-serif; width:160px; color:#333333; float: left; margin: 0 auto;">PAST JUMBLRS</span><span style="font: bold 20px/20px Arial, Helvetica, sans-serif; width:160px; color:#0b5d9c; float: right; margin: 0 auto;">26</span>
                </div>
				<div class="clear"></div>
								<div class="todays_deal_left">
                <span style="font: bold 14px/18px Arial, Helvetica, sans-serif; width:160px; color:#333333; float: left; margin: 0 auto;">INTERESTS</span><span style="font: bold 14px/18px Arial, Helvetica, sans-serif; width:160px; color:#0b5d9c; float: right; margin: 0 auto;"></span>
                </div>

				<div class="clear"></div>

				<div class="my_account" style="width: auto">
				<?php
					$likes = explode('~', $profileUser['likes']);
					//print_r($likes);
					foreach ($likes as $like) {
						if (!empty($like)) :
				?>

				<div class="interest"  style=" height: 20px;">
           		<div style="width:14px; float: left; margin: 5px 6px;"><img src="images/heart.png" alt="" width="13" height="12"></div>
                <div style="font: bold 12px/18px Arial, Helvetica, sans-serif; width:auto; color:#6196b5; float: right; margin: 0px 5px;"><?php echo $like; ?></div>
				</div>

				<!-- <div class="interest" style=" height: 20px;">
            	<div style="width:14px; float: left; margin: 5px 6px;"><img src="images/heart.png" alt="" width="13" height="12"></div>
                <div style="font: bold 12px/18px Arial, Helvetica, sans-serif; width:auto; color:#000; float: right; margin: 0px 5px;"><?php echo $like; ?></div>
				</div> -->

				<?php endif; } ?>


				<div class="clear"></div>
				<div style="margin:8px 0;"><a href="#"><img src="images/concern_btn.png" alt="" width="150" border="0" height="30"></a></div>
                </div>
				<div class="clear"></div>
            </div>



</div>
<?php
include 'include/footer.php';
?>