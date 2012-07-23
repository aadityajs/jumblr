<?php
include("include/header.php");

?>

<?php
		/*
		$url_city = end(explode('/', $_SERVER['REQUEST_URI']));
		$country = 225;
		$city_name_data = mysql_fetch_array(mysql_query("SELECT * FROM ".TABLE_CITIES."  WHERE city_name = '$url_city'"));
		$city_name_row = mysql_num_rows(mysql_query("SELECT * FROM ".TABLE_CITIES."  WHERE city_name = '$url_city'"));

		$sql_today1 = "SELECT *, FROM ".TABLE_DEALS." WHERE status >= 1 AND deal_end_time >= '".date("Y-m-d")."' AND city = '$city_name_data[city_name]' LIMIT 0, 1";
		$today_res1 = mysql_fetch_array(mysql_query($sql_today1));
		//$_SESSION['current_deal_id'] = $today_res['deal_id'];

		$city_name_data['city_id'];
		//header('location:'.SITE_URL.'?city='.$city_name_data['city_id']);

		if ($city_name_row > 0) {
			//header('location:index.php?city='.$city_name_data['city_id']);
		}
		*/
?>
<?php
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
	if(strtolower($_SERVER['REQUEST_METHOD'])=='post' && $_POST['email_subs_btn'] == "SUBSCRIBE")
	{
	$cookie_val = $_COOKIE["subscribe"];
	$arr = explode("|",$cookie_val);
	$email = $arr[0];
	$city_id = $arr[1];

	$date = date('Y-m-d');
	$sql_subscription = "INSERT INTO ".TABLE_NEWSLETTERS."(email,city,status) VALUES('".$email."','".$city_id."','1','".$date."')";
	mysql_query($sql_subscription);

	header('location:index.php?city='.$city_id);
	}

?>

<style>

</style>

<script>

function validate()
{


		var getSelectedIndex = document.select_city.city.selectedIndex;
		var city_val = document.select_city.city[getSelectedIndex].value;
		var email_val =document.getElementById("email").value;

		var national = document.getElementById('nd').value;

		if (national == 'National deal') {
			alert(national);
			document.getElementById('select_city').action = '<?php echo SITE_URL; ?>national_deals.php?nd=National deals';
			document.getElementById('sublink').setAttribute("href", "<?php echo SITE_URL; ?>national_deals.php?nd=National deals");
			//document.getElementById('sublink').href += '<?php echo SITE_URL; ?>national_deals.php?nd=National deals';
		}

		if (email_val == '')
		{
			document.getElementById('email_check').innerHTML = '<label style="color:red;font-weight:bold; align: left;">Please enter email ID</label>';
			validation = 1;
			return false;
		}
		else if (email_val == 'Enter your email address')
		{
			document.getElementById('email_check').innerHTML = '<label style="color:red;font-weight:bold; align: left;">Please enter email ID</label>';
			validation = 1;
			return false;
		}
		else if (city_val == '') {
			document.getElementById('city_check').innerHTML = '<label style="color:red;font-weight:bold;">Please select a city</label>';
			validation = 1;
			return false;
		}




}
function nationalDeal(val) {
	if (val == 'National deal') {
		//setCookie("subscribe",-1,20);
		//window.location =	 '<?php echo SITE_URL; ?>national_deals.php?nd=National deals';
		//window.location = '<?php echo SITE_URL; ?>index.php?acsucc=You have been subscribed successfully';
		document.getElementById('select_city').action = '<?php echo SITE_URL; ?>national_deals.php?nd=National deals';
	}
}


function getSubscribeValues(id)
{
		var city_id;
		var email;
		var cookieValue;

		var getSelectedIndex = document.select_city.city.selectedIndex;
		var city_val = document.select_city.city[getSelectedIndex].value;
		var email_val =document.getElementById("email_subscript").value;

		var national = document.getElementById('nd').value;

		/*if (national == 'National deal') {
			alert(national);
			document.getElementById('select_city').action = '<?php echo SITE_URL; ?>national_deals.php?nd=National deals';
			document.getElementById('sublink').setAttribute("href", "<?php echo SITE_URL; ?>national_deals.php?nd=National deals");
			//document.getElementById('sublink').href += '<?php echo SITE_URL; ?>national_deals.php?nd=National deals';
		}*/
		if (email_val == '')
		{
			document.getElementById('email_check').innerHTML = '<label style="color:red;font-weight:bold; align: left;">Please enter email ID</label>';
			validation = 1;
			return false;
		}
		else if (email_val == 'Enter your email address')
		{
			document.getElementById('email_check').innerHTML = '<label style="color:red;font-weight:bold; align: left;">Please enter email ID</label>';
			validation = 1;
			return false;
		}
		else if (city_val == '') {
			document.getElementById('city_check').innerHTML = '<label style="color:red;font-weight:bold;">Please select a city</label>';
			validation = 1;
			return false;
		}

		if(id=='city_submit')
		{
			var getSelectedIndex = document.select_city.city.selectedIndex;
			city_id = document.select_city.city[getSelectedIndex].value;
			setCookie("subscribe",city_id,20);
			if(city_id == 'National deal')
			{
				window.location = '<?php echo SITE_URL; ?>national_deals.php?nd=National deals';
			}
			else
			{
				window.location = '<?php echo SITE_URL; ?>index.php?acsucc=You have been subscribed successfully';
			}

		}

		if(id=='subscribe_email')
		{
			email = document.getElementById("email").value;
			var value = getCookie("subscribe");
			cookieValue = email+'|'+value;
			setCookie("subscribe",cookieValue,20);
			city_id = document.select_city.city[getSelectedIndex].value;
			if(city_id == 'National deal')
				window.location = '<?php echo SITE_URL; ?>national_deals.php?nd=National deals';
			else
				window.location = '<?php echo SITE_URL; ?>index.php?acsucc=You have been subscribed successfully';
		}


}
/* ---------------- Create cookie and set cookie ---------------------------- */
function setCookie(cookieName,cookieValue,nDays)
{
	var today = new Date();
	var expire = new Date();
	if (nDays==null || nDays==0) nDays=1;
	expire.setTime(today.getTime() + 3600000*24*nDays);
	document.cookie = cookieName+"="+escape(cookieValue) + ";expires="+expire.toGMTString();
}
function getCookie (name)
{
	var arg = name + "=";
	var alen = arg.length;
	var clen = document.cookie.length;
	var i = 0;
	while (i < clen)
	{
		var j = i + alen;
		if (document.cookie.substring(i, j) == arg)
		{
			return getCookieVal (j);
		}
		i = document.cookie.indexOf(" ", i) + 1;
		if (i == 0) break;
	}
	return null;
}
function getCookieVal (offset)
{
  var endstr = document.cookie.indexOf (";", offset);
  if (endstr == -1) { endstr = document.cookie.length; }
  return unescape(document.cookie.substring(offset, endstr));
}
/* --------------------------------------------------- */

</script>
<script>
var validation =0;
$(document).ready(function() {

	$('a.panel').click(function () {

		$('a.panel').removeClass('selected');
		$(this).addClass('selected');

		current = $(this);

		if(validation==0)
		{
			$('#subcribewrapper').scrollTo($(this).attr('href'), 1000);
		}

		return false;
	});

	$(window).resize(function () {
		resizePanel();
	});

});

function resizePanel() {

	width = $(window).width();
	height = $(window).height();

	mask_width = width * $('.item').length;

	$('#debug').html(width  + ' ' + height + ' ' + mask_width);

	$('#subcribewrapper, .item').css({width: width, height: height});
	$('#mask').css({width: mask_width, height: height});
	$('#wrapper').scrollTo($('a.selected').attr('href'), 0);

}

</script>



<!--
if need  to enable the hide overlay on clicking, add the below code ---

onclick="if (!is_modal) HideLightBox(); return false;"
 -->
<div id="fade" class="LB-black-overlay"></div>


<script src="js/countdown.js" type="text/javascript" charset="utf-8"></script>


<?php

 //echo $_COOKIE['subscribe'];

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
	//$todays_image_res = mysql_query($sql_todays_image);

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
			//$todays_image_res = mysql_query($sql_todays_image);

		}
}	// end else
$_SESSION['current_deal_id'] = $today_res['deal_id'];
?>



<?php if ($num_rows > 0 || $_GET['action'] == "sold" || $_GET['action'] == "view") { ?>

			<div class="todays_deal">
            	<div class="todays_deal_img"></div>
                <a href="<?php echo SITE_URL;?>deal-details.php?action=view&id=<?php echo $today_res['deal_id']; ?>"><div class="more_info"></div></a>
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
                    	<li><img src="<?php echo UPLOAD_PATH.$todays_image['file']; ?>" class="image0" width="348px" height="307px"></li>
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
                	<div class="amount">Amount: <span>&pound;<?php echo ($today_res['is_multi'] == 'n' ? number_format($today_res['discounted_price'], 2) : number_format($is_multi['multi_deal_item_price'], 2)); ?></span></div>
                    <div class="available">
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
						  <?php /*if ($_GET['action'] != "sold") {
					   			if($total_buy[0] != 0) {echo $total_buy[0].' Bought!';} else {echo "Not Yet Bought!";}
					   		 	}*/
					   		if ($_GET['action'] == "sold") { echo "Deal Completed!";}

					   		?>

                        	</strong>
                        </div>
                    </div>

                 <?php
					$sqlCircle = "SELECT * FROM ".TABLE_FB_USER." WHERE jumblr_status = 1";
					$circleUser = $db->fetch_all_array($sqlCircle);
					$circleUserCount = mysql_num_rows($db->query($sqlCircle));

					foreach ($circleUser as $fbUser) {
			        			$groupRating += comp_user($fbUser['user_id']);
	        		}
	        		$averageGroupRating = $groupRating/$circleUserCount;
				?>

                 <div class="rating">Group rating: <span><?php echo intval($averageGroupRating); ?></span></div>
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
                </div>
                <div class="todays_deal_right" id="click">
                   <!-- <img src="images/member.png" alt=""> -->
				<!-- Members circle starts -->

					<div class="circleDiv">
				    	<div class="innerCircle">
				        <div class="cat_circle"><img src="images/cat_icon1.jpg" width="100" height="100" /></div>
				        	<?php
				        		$fbUserCount = 1;
				        		if ($circleUserCount <= 9) {
					        		foreach ($circleUser as $fbUser) {
						        			if ($fbUserCount <= 9) {
							        			echo '<div id="img'.$fbUserCount.'" class="profile_img">
							        					<a class="tips" href="my-profile.php?profile-'.$fbUser['fb_id'].'" title="'.$fbUser['name'].'<br/> Compatibility : '.comp_user($fbUser['user_id']).'" target="_blank">
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

	<div class="common_box">
	<div class="main_box">
						<?php
							$sql_nodeal_city = "SELECT * FROM ".TABLE_CITIES." WHERE city_id = $city";
							$result_nodeal_city = mysql_query($sql_nodeal_city);
							$row_nodeal_city = mysql_fetch_array($result_nodeal_city);
						?>
	  <div class="coming_soon" >
	  <div class="coming_soon_top"></div>
	  <div class="coming_soon_mid">
	  <div class="coming_left">
	   <img src="images/coming_small10.gif" alt="" width="322" height="224"/></div>
	  <div class="coming_right" style="width:510px;">
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
      <div class="clear"></div>
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




<!-- jumblr deal members drop down start -->
<div class="todays_deal" id="locations" style="margin-top: -35px; z-index: 0; display: block; border: 0px solid red;">
				<?php  if ($circleUserCount < 9) { ?>
					<script type='text/javascript'>
						$(document).ready(function() {
							$('div.ca-nav').css({display: 'none'});});
					</script>
				<?php }?>

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

					$commentSql = "SELECT * FROM ".TABLE_DEAL_GROUP." WHERE deal_id = $today_res[deal_id]";
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

                    	<textarea type="textarea" class="textarea" name="comment" id="comment" <?php echo (isset($_SESSION['fb_id']) ? '' : 'disabled=disabled') ?>><?php echo (isset($_SESSION['fb_id']) ? '' : 'Please login to post comment!') ?></textarea>
                        <input type="button" name="commentPost" id="commentPost" onclick="return post_comment(<?php echo $today_res['deal_id']; ?>);" <?php echo (isset($_SESSION['fb_id']) ? '' : 'disabled=disabled') ?> value="Post" class="post_btn"/>
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
	    $('#message').html("<p>Thank You</p>")
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


<!-- ##################### -->



	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
	<!-- the jScrollPane script
	<script type="text/javascript" src="js/jquery.mousewheel.js"></script>-->
	<script type="text/javascript" src="js/jquery.contentcarousel.js"></script>

		<script type="text/javascript">
			$('#ca-container').contentcarousel();
		</script>



<div class="clear"></div>

<?php
	$city = end(explode("|",$_COOKIE['subscribe']));
	//sql_today_bot_deals = "SELECT *, DATEDIFF(`deal_end_time`,`deal_start_time`) as date_diff FROM ".TABLE_DEALS." WHERE status >= 1 AND deal_start_time <= '".date("Y-m-d G:i:s")."' AND deal_end_time >= '".date("Y-m-d G:i:s")."' AND city = $city LIMIT 1, 2";
	$sql_today_bot_deals = "SELECT * FROM ".TABLE_DEALS." WHERE status >= 1 LIMIT 1, 2";


	$num_rows = mysql_num_rows(mysql_query($sql_today_bot_deals)) ;

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

			$sql_todays_image_bot_deals = "SELECT * FROM ".TABLE_DEAL_IMAGES." WHERE deal_id = ".$today_row_bot_deals['deal_id'];
			$todays_image_bot_deals = mysql_fetch_array(mysql_query($sql_todays_image_bot_deals));
			//$todays_image_res = mysql_query($sql_todays_image);

		}	// endif


?>
<!-- carousel jquery -->





		<div class="todays_deal">
                <div class="todays_deal_left" style="width:268px;">
                    <ul>
                    	<li><img src="<?php echo UPLOAD_PATH.$todays_image_bot_deals['file']; ?>" class="image0" width="268px" height="236px"></li>
                    </ul>
                </div>
                <div class="todays_deal_right" id="todays_deal_right_circle<?php echo $today_row_bot_deals['deal_id']; ?>" style="margin: 0 35px;">
                   <img src="images/member.png" alt="">
              </div>
                <div class="todays_deal_middle">

                	<div class="todays_bg"></div>

                	<div class="amount">Amount: <span>&pound;<?php echo ($today_row_bot_deals['is_multi'] == 'n' ? number_format($today_row_bot_deals['discounted_price'], 2) : number_format($is_multi_bot_deals['multi_deal_item_price'], 2)); ?></span></span></div>
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
                  <div class="rating">Group rating: <span>72</span></div>
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

               <!-- Slider starts -->

					<div id="ca-container<?php echo $today_row_bot_deals['deal_id']; ?>" class="ca-container"  style="display: none;">
                    <div class="ca-wrapper">

                        <div class="ca-item ca-item-3">
                          <div class="jewellry_img_box">
                           <img src="images/animal3.png" alt="" height="80" width="80">
                           </div>
                           <div class="point">120</div>
                        </div>

						<div class="ca-item ca-item-3">
                          <div class="jewellry_img_box">
                           <img src="images/animal3.png" alt="" height="80" width="80">
                           </div>
                           <div class="point">120</div>
                        </div>
                        <div class="ca-item ca-item-3">
                          <div class="jewellry_img_box">
                           <img src="images/animal3.png" alt="" height="80" width="80">
                           </div>
                           <div class="point">120</div>
                        </div>
                        <div class="ca-item ca-item-3">
                          <div class="jewellry_img_box">
                           <img src="images/animal3.png" alt="" height="80" width="80">
                           </div>
                           <div class="point">120</div>
                        </div>
                        <div class="ca-item ca-item-3">
                          <div class="jewellry_img_box">
                           <img src="images/animal3.png" alt="" height="80" width="80">
                           </div>
                           <div class="point">120</div>
                        </div>
                        <div class="ca-item ca-item-3">
                          <div class="jewellry_img_box">
                           <img src="images/animal3.png" alt="" height="80" width="80">
                           </div>
                           <div class="point">120</div>
                        </div>
                        <div class="ca-item ca-item-3">
                          <div class="jewellry_img_box">
                           <img src="images/animal3.png" alt="" height="80" width="80">
                           </div>
                           <div class="point">120</div>
                        </div>
                        <div class="ca-item ca-item-3">
                          <div class="jewellry_img_box">
                           <img src="images/animal3.png" alt="" height="80" width="80">
                           </div>
                           <div class="point">120</div>
                        </div>
                        <div class="ca-item ca-item-3">
                          <div class="jewellry_img_box">
                           <img src="images/animal3.png" alt="" height="80" width="80">
                           </div>
                           <div class="point">120</div>
                        </div>
                        <div class="ca-item ca-item-3">
                          <div class="jewellry_img_box">
                           <img src="images/animal3.png" alt="" height="80" width="80">
                           </div>
                           <div class="point">120</div>
                        </div>
                        <div class="ca-item ca-item-3">
                          <div class="jewellry_img_box">
                           <img src="images/animal3.png" alt="" height="80" width="80">
                           </div>
                           <div class="point">120</div>
                        </div>
                    </div>
		     	</div>

				<!-- Slider ends -->

            </div>

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

?>




</div>
<div class="clear"></div>
</div><br>




<div id="email-form" class="LB-white-content" style="background: url(images/bodybg.jpg) left top repeat; margin:0;">
	<a id="close" href="" onclick="HideLightBox(); return false;"></a>

		<div class="subscribe_box">
		<!--<div id="cross"><a href="#"><img src="images/cross_white.gif" alt="" width="22" height="32" border="0" /></a></div>
		-->
        <div class="title_txt" style="font-size: 27px; font-family:Georgia, 'Times New Roman', Times, serif;">We give you the best daily deals in your city!</div>
        <div class="title_txt2" style="font-family:Georgia, 'Times New Roman', Times, serif;">Save up to 90% in restaurants, spas, cinemas, gyms, event and many more...</div>
		<div class="clear"></div>
		<form name="select_city" id="select_city" action="<?php echo $_SERVER["PHP_SELF"]?>">
		<div id="subscribe">
		<ul>
		<li style="width: 450px; float: left; margin-top: 20px;">
			<div id="email_check" style="float: left;"></div>
			<input type="text" name="email" id="email_subscript" class="white_box2" value="Enter your email address" style="font-family: Georgia, 'Times New Roman', Times, serif; color:#999999; font-size: 18px; font-weight: normal;" onclick="javascript: if (this.value == 'Enter your email address') { this.value = '' };" onblur ="javascript: if (this.value == ''){ this.value = 'Enter your email address' }; "/>
		</li>
		<li style="margin: 8px 0 0 40px;">
			<div id="city_check" style="float: left;"></div>
			<select name="city" id="city" class="text_select">
                        <option value="" style="font-family: Georgia, 'Times New Roman', Times, serif; font-size:18px; font-weight: normal; color:#999999;">Choose your city</option>
                        <option value="National deal" id="nd">National Deal</option>
                        <?php
							$sql_cities = "SELECT * FROM ".TABLE_CITIES." GROUP BY city_name";
							$result_cities = mysql_query($sql_cities);
							while($row_cities = mysql_fetch_array($result_cities))
{
								?>
                        <option value="<?php echo $row_cities["city_id"]; ?>"><?php echo $row_cities["city_name"]; ?></option>
                        <?php
}
							?>
              </select>
			<input type="button" name="Submit" class="subs_btn" value="Sign up now" id="city_submit" onclick="javascript: return getSubscribeValues(this.id);"/>
		</li>
		<!--<li style="margin: 8px 0 0 90px;">By subscribing I agree the <a href="#">Terms & Conditions</a> and <a href="#">Provacy Policy</a>.</li>-->
		</ul>
		</div>
		</form>

		<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="150" border="0" /></div>

        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="65%">
            	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="share_box1">
                  <tr>
                    <td>
                    	<ul class="tick_list">
                            <li>One email a day with at least 50% off the best brands.</li>
                            <li>No spam ever, unsubscribe with just one click</li>
                        </ul>
                    </td>
                  </tr>
                  <tr>

                  	<td><p style="float:left;"><a href="<?php echo SITE_URL;?>?city=31">Already a member?</a></p> <p style="float:right;">
                  	<a href="<?php echo SITE_URL; ?>page.php?page=Privacy%20Policy">Our Privacy Policy</a></p></td>
                  </tr>
                </table>
            </td>
            <td width="30%">
            	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="share_box2">
                  <tr>
                    <td><img src="images/no_1.png" alt="" border="0" /></td>
                    <td>Buy</td>
                    <td><img src="images/no_2.png" alt="" border="0" /></td>
                    <td>Share</td>
                    <td><img src="images/no_3.png" alt="" border="0" /></td>
                    <td style="padding-right:10px;">Enjoy</td>
                  </tr>
                </table>

            </td>
          </tr>
        </table>

		</div>
</div>



</section>
		<!--end body-->
	  <div class="clear"></div>
	</div>
<!--end maincontainer-->


<?php //include ('include/sidebar.php'); ?>

<?php include ('include/footer.php'); ?>