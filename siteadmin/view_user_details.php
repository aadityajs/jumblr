<?php
include("include/header.php");


$admin_id=intval($_SESSION['admin_id']);
$sql = "SELECT admin_name FROM `".TABLE_ADMIN."` WHERE admin_id='$admin_id'";
$record = $db->query_first($sql);

$userid=intval($_REQUEST['id']);
$sql_user = "SELECT * FROM ".TABLE_MERCHANTS." WHERE mid='$userid' ";
$user_det = $db->query_first($sql_user);

?>


    <div class="main_content">

      <?php include("include/top_menu.inc.php");?>

    <div class="center_content">

   		<?php require("include/left_menu.php"); ?>

    <div class="right_content">


		 <div class="form">

					<h1>Store Details Of: <?php echo $user_det[store_name];?></span></h1>
<a href="<?php echo SITE_URL; ?>siteadmin/merchant_user_request.php?email=<?php echo $user_det[mid];?>"><input type="button" value="Email to <?php echo $user_det[employee_name]; ?>" /></a>
                <fieldset>

					<dl>
                        <dt><label for="comp_name">Company Name:</label></dt>
                        <dt><?php echo $user_det[store_name];?></dt>
                    </dl>

					<dl>
                        <dt><label for="name">Name:</label></dt>
                        <dt><?php echo $user_det[employee_name];?></dt>
                    </dl>

					<dl>
                        <dt><label for="email">Email:</label></dt>
                        <dt><?php echo $user_det[email];?></dt>
                    </dl>

					<dl>
                        <dt><label for="email">Phone No:</label></dt>
                        <dt><?php echo $user_det[phone];?></dt>
                    </dl>

					<dl>
                        <dt><label for="email">Address:</label></dt>
                        <dt><?php echo $user_det[address1];?></dt>
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
						$sql_country=mysql_fetch_array(mysql_query("select * from " .TABLE_COUNTRIES." where country_id='".$user_det[country]."'"));
						echo $sql_country[country_name];

						?></dt>
                    </dl>

					<dl>
                        <dt><label for="reg_date">Registration Date:</label></dt>
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
                    </dl>

					<dl>
                        <dt><label for="subscription">Subscriptions:</label></dt>
                        <dt><?php $city=mysql_query("SELECT * FROM `".TABLE_CITIES."` ");
							while($row=mysql_fetch_array($city)){

							$sub=mysql_fetch_object(mysql_query("SELECT * FROM `".TABLE_USERS."` LEFT JOIN `".TABLE_USER_SUBSCRIPTION."` ON ( ".TABLE_USERS.".user_id = ".TABLE_USER_SUBSCRIPTION.".user_id ) where ".TABLE_USERS.".user_id='".$user_det['user_id']."' and ".TABLE_USER_SUBSCRIPTION.".city_id='".$row['city_id']."'"));

												 if($sub->city_id==$row['city_id']){ echo $row['city_name'].",";}

										 }?>

												</dt>
                    </dl>-->

                    <dl>
                        <dt><label for="about">About:</label></dt>
                        <dt><?php echo ($user_det['about']);?></dt>
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
                        <dt><label for="bucks">Account Balance:</label></dt>
                        <dt>$<?php echo ($user_det['bucks']);?></dt>
                    </dl>

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

