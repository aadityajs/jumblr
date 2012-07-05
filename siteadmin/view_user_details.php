<?php
include("include/header.php");


$admin_id=intval($_SESSION['admin_id']);
$sql = "SELECT admin_name FROM `".TABLE_ADMIN."` WHERE admin_id='$admin_id'";
$record = $db->query_first($sql);

$userid=intval($_REQUEST['id']);
$sql_user = "SELECT * FROM ".TABLE_USERS." WHERE user_id='$userid' ";
$user_det = $db->query_first($sql_user);

?>


    <div class="main_content">

      <?php include("include/top_menu.inc.php");?>

    <div class="center_content">

   		<?php require("include/left_menu.php"); ?>

    <div class="right_content">


		 <div class="form">

					<h1>User Details Of :<?php echo $user_det['email'];?></span></h1>
<a href="<?php echo SITE_URL; ?>siteadmin/merchant_user_request.php?email=<?php echo $user_det[user_id];?>"><input type="button" value="Email <?php echo $user_det[first_name]; ?>" /></a>
                <fieldset>

                    <dl>
                        <dt><label for="password">First Name:</label></dt>
                        <dt><?php echo $user_det[first_name];?></dt>
                    </dl>

					<dl>
                        <dt><label for="email">Last Name:</label></dt>
                        <dt><?php echo $user_det[last_name];?></dt>
                    </dl>

					<dl>
                        <dt><label for="email">Email:</label></dt>
                        <dt><?php echo $user_det[email];?></dt>
                    </dl>

					<dl>
                        <dt><label for="email">Phone No:</label></dt>
                        <dt><?php echo $user_det[phone_no];?></dt>
                    </dl>

					<dl>
                        <dt><label for="email">Address:</label></dt>
                        <dt><?php echo $user_det[address1];?>,<?php echo $user_det[address2];?></dt>
                    </dl>

					<dl>
                        <dt><label for="email">City:</label></dt>
                        <dt><?php echo $user_det[city];?></dt>
                    </dl>

                   <dl>
                        <dt><label for="email">State:</label></dt>
                        <dt><?php echo $user_det[state];?></dt>
                    </dl>

					<dl>
                        <dt><label for="email">Zip Code:</label></dt>
                        <dt><?php echo $user_det[zip];?></dt>
                    </dl>


					 <dl>
                        <dt><label for="upload">Country:</label></dt>
                        <dt><?php
						$sql_country=mysql_fetch_array(mysql_query("select country_name from " .TABLE_COUNTRIES." where country_name='".$user_det[country]."'"));
						echo $sql_country[country_name];

						?></dt>
                    </dl>

					<!-- <dl>
                        <dt><label for="upload">Profile Image:</label></dt>
                        <dt><?php if($user_det['user_img']){?><img src="../upload_files/profile_image/<?php echo $user_det['user_img']?>" width="100"/><?php }?></dt>
                    </dl>

					<dl>
                        <dt><label for="upload">Education:</label></dt>
                        <dt><?php echo $user_det['education']?></dt>
                    </dl>
					<dl>
                        <dt><label for="upload">Employment Status:</label></dt>
                        <dt><?php echo $user_det['employment']?></dt>
                    </dl>

					<dl>
                        <dt><label for="upload">Income Range:</label></dt>
                        <dt><?php echo $user_det['income']?></dt>
                    </dl>

					<dl>
                        <dt><label for="upload">Own a home?:</label></dt>
                        <dt><?php echo $user_det['own_home']?></dt>
                    </dl>
					<dl>
                        <dt><label for="upload">Relationship status:</label></dt>
                        <dt><?php echo $user_det['relationship']?></dt>
                    </dl>
					<dl>
                        <dt><label for="upload">Have children?:</label></dt>
                        <dt><?php echo $user_det['has_children']?></dt>
                    </dl> -->

					 <dl>
                        <dt><label for="password">Registration Date:</label></dt>
                        <dt><?php echo strftime("%d %b %Y", strtotime($user_det['date_added']));?></dt>
                    </dl>

					<!-- <dl>
                        <dt><label for="ip">Registration IP:</label></dt>
                        <dt><?php echo ($user_det['reg_ip']);?></dt>
                    </dl>

					 <dl>
                        <dt><label for="range">Age Range:</label></dt>
                        <dt><?php

						if($user_det['age_range']=='0'){echo "Under 25";}
						elseif($user_det['age_range']=='1'){echo "25 - 35";}
						elseif($user_det['age_range']=='2'){echo "35 - 45";}
						elseif($user_det['age_range']=='3'){echo "45 - 55";}
						elseif($user_det['age_range']=='4'){echo "55 - 65";}
						elseif($user_det['age_range']=='5'){echo "Over 65";}
						?></dt>
                    </dl> -->

					<dl>
                        <dt><label for="subscription">Subscriptions:</label></dt>
                        <dt><?php $city=mysql_query("SELECT * FROM `".TABLE_CITIES."` ");
							while($row=mysql_fetch_array($city)){

							$sub=mysql_fetch_object(mysql_query("SELECT * FROM `".TABLE_USERS."` LEFT JOIN `".TABLE_USER_SUBSCRIPTION."` ON ( ".TABLE_USERS.".user_id = ".TABLE_USER_SUBSCRIPTION.".user_id ) where ".TABLE_USERS.".user_id='".$user_det['user_id']."' and ".TABLE_USER_SUBSCRIPTION.".city_id='".$row['city_id']."'"));

												 if($sub->city_id==$row['city_id']){ echo $row['city_name'].",";}

										 }?>

												</dt>
                    </dl>

					<!-- <dl>
                        <dt><label for="preference">Preferences:</label></dt>
                        <dt><?php $pref=mysql_query("SELECT * FROM `".TABLE_CATEGORIES."` ");
							while($row2=mysql_fetch_array($pref)){

							$sub=mysql_fetch_object(mysql_query("SELECT * FROM `".TABLE_USERS."` LEFT JOIN `".TABLE_USER_PREFERENCE."` ON ( ".TABLE_USERS.".user_id = ".TABLE_USER_PREFERENCE.".user_id ) where ".TABLE_USERS.".user_id='".$user_det['user_id']."' and ".TABLE_USER_PREFERENCE.".category_id='".$row2['cat_id']."'"));

												if($sub->category_id==$row['cat_id']){ echo $row2['cat_name'].",";}

										 }?></dt>
                    </dl> -->
					<dl>
                        <dt><label for="bucks">Account Balace:</label></dt>
                        <dt>$<?php echo ($user_det['bucks']);?></dt>
                    </dl>

					<!-- <dl>
                        <dt><label for="bucks">Perticipage in Rewards:</label></dt>
                        <dt><?php echo ($user_det['reward_participate']);?></dt>
                    </dl>
					<dl>
                        <dt><label for="bucks">Registration Type:</label></dt>
                        <dt><?php echo ($user_det['reg_type']);?></dt>
                    </dl>	 -->
                     <dl class="submit">
                    <input type="button" name="button" id="button" value="Close" ONCLICK="history.go(-1)" class="NFButton" />
                     </dl>

                </fieldset>

         </form>
         </div>

     </div><!-- end of right content-->


  </div>   <!--end of center content -->

    <div class="clear"></div>
    </div> <!--end of main content-->

    	<?php require("include/footer.inc.php"); ?>

