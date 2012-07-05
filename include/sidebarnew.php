<div id="rightcol">
<!--
<div class="rightbox1">
<div class="curtop_bg">
<p>Make somebody happy!</p>
</div>
<div class="clear"></div>
<div class="curmid_bg"><img src="images/gift_box.gif" alt="" width="228" height="96" hspace="2" vspace="2" /></div>
<div class="curbot_bg"></div>
</div>
<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
 -->
<div class="rightbox1">
<div class="curtop_bg">
<p>Your Brand on GeeLaza</p>
</div>
<div class="clear"></div>
<div class="curmid_bg">
<div style="width: 230px; margin: 5px auto; float: none;">
<div style="width: 80px; margin: 0 auto; float: left;"><img src="images/pic.gif" vspace="2" hspace="2" alt="" width="76" height="90"/></div>
<div style="width: 140px; margin: 0 auto; float: right;"><p class="text11" style="font-size: 13px;">Make your business the center attention for the entire GeeLaza database.</p></div>
</div>
<div style="margin: 0 auto; float:left;"><a href="<?php echo SITE_URL; ?>merchant_business.php" style="padding: 0 0 0 10px; font-size: 13px;">Tell me more</a></div>
</div>
<div class="curbot_bg"></div>
</div>
<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" />
<?php
$sql_national_deal = "SELECT *, DATEDIFF(`deal_end_time`,`deal_start_time`) as date_diff FROM ".TABLE_DEALS." WHERE status >= 1 AND best_deal = 'y' AND deal_start_time <= '".date("Y-m-d G:i:s")."' AND deal_end_time >= '".date("Y-m-d G:i:s")."' LIMIT 0, 1";
$national_res = mysql_fetch_array(mysql_query($sql_national_deal));
$qr = mysql_query($sql_national_deal);
$rows = mysql_num_rows($qr);
$sql_national_image = "SELECT * FROM ".TABLE_DEAL_IMAGES." WHERE deal_id = ".$national_res['deal_id'];
$national_image = mysql_fetch_array(mysql_query($sql_national_image));
if ($rows != 0) {
?>
<?php if ($_GET['nd'] != "National deals") { ?>
<div class="rightbox">
<div class="headingbg_national">
<p>National deal</p>
</div>
<div style="background: #fff;">
<div class="clear"></div>
<div style="padding: 10px 10px;"><span><a href="<?php echo SITE_URL ;?>national_deals.php?nd=National deals"><?php echo $national_res['title']; ?></a></span></div>
<div class="clear"></div>
<div style="width: 230px; margin: 5px auto; float: none;">
<div style="width: 110px; margin: 0 6px; float: left;"><img src="<?php echo UPLOAD_PATH.$national_image['file']; ?>" alt="" width="106" height="70" class="border"/></div>
<div class="left_green">
<p>&pound;<?php echo $national_res['discounted_price']; ?></p>
<p style="padding-top: 5px;"><span style="text-align:center;">instead of<br/>
&pound;<?php echo $national_res['full_price']; ?></span></p>
</div>
</div>
<div class="clear"></div>
<a href="<?php echo SITE_URL; ?>national_deals.php?nd=National deals"><div class="see"></div></a>
<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="1" /></div>
</div>
<div style="width:232px; height:11px;"><img src="images/right_bttom.png" alt="" width="232" height="11" /></div>
</div>
<?php } ?>

<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
<?php } ?>
<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="2" /></div>
<div class="rightbox">

<!--
Other deals starts
-->


<?php
$city = end(explode("|",$_COOKIE['subscribe']));

//$sql_today = "SELECT * FROM ".TABLE_DEALS." WHERE status >= 1 AND deal_end_time LIKE '".date("Y-m-d")."%' OR deal_end_time < '".date("Y-m-d H:i:s")."' ORDER BY deal_id desc LIMIT 0, 6";

if ($_GET['nd'] == "National deals") {
$sql_today = "SELECT * FROM ".TABLE_DEALS." WHERE status >= 1 AND in_sidebar = 'y' AND best_deal = 'y' ORDER BY deal_id desc";
} else {
$sql_today = "SELECT * FROM ".TABLE_DEALS." WHERE status >= 1 AND in_sidebar = 'y' AND city = '$city' ORDER BY deal_id desc";
}
//$today_res = mysql_fetch_array(mysql_query($sql_today));
$q=mysql_query($sql_today);
$c = 0;
while ( $today_res = mysql_fetch_array($q)) {
$c++;
//$num_rows = mysql_num_rows(mysql_query($sql_today)) ;

//if ($num_rows > 0) {


$sql_todays_image = "SELECT * FROM ".TABLE_DEAL_IMAGES." WHERE deal_id = ".$today_res['deal_id'];
$todays_image = mysql_fetch_array(mysql_query($sql_todays_image));
//}
?>

<?php if ($c == 1) { ?>
<div class="headingbg_national">
<p>More amazing deals</p>
</div>
<?php } ?>
<div class="rightbox">
<div class="curtop_bg_1"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
<div class="curmid_bg_ani">

 <div style="padding: 5px 10px;"><!--<<span>img src="images/star0<?php echo $c; ?>.gif" alt="" width="45" height="44" /></span>-->
 	<span><a href="<?php echo SITE_URL."index.php?action=view&id=".$today_res['deal_id'];?>"><?php echo strip_tags($today_res['title']); ?></a></span>
 </div>
  <div class="clear"></div>
  <div style="width: 230px; margin: 5px auto; float: none;">
  <div style="width: 110px; margin: 0 0 0 2px; float: left;"><img src="<?php echo UPLOAD_PATH.$todays_image['file']; ?>" alt="" width="106" height="70" class="border"/></div>
    <div style="margin-right: 10px;" class="left_green">
      <p>&pound;<?php echo strip_tags($today_res['discounted_price']); ?></p>
      <p style="padding-top: 5px;"><span style="text-align:center;">instead of<br/>
        &pound;<?php echo strip_tags($today_res['full_price']); ?></span></p> </div>
  </div>
  <div class="clear"></div>
  <a href="<?php echo SITE_URL."index.php?action=view&id=".$today_res['deal_id'];?>"><div class="see"></div></a>
  <div class="clear"><img src="images/spacer.gif" alt="" width="1" height="2" /></div>
  </div>

</div><div class="curbot_bg"></div>
<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
<?php } ?>



</div>

<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
<div class="rightbox1">
<div class="greentop_bg_ani_2012">
<p>GeeLaza UK <br />
Custome Services</p>
</div>
<div class="clear"></div>
<div class="greenmid_bg">
<div style="width: 212px; margin: 8px 8px; float: none; padding-top: 5px; padding-right: 5px;">
<span><a href="<?php echo SITE_URL; ?>faq.php" style="padding:0 0 10px 0; margin:0 0 10px 0;"><span style="line-height:25px; color: #292929; text-decoration: underline;">Check out our FAQs</span></a><br />
Please note you can retrieve your voucher by logging into your account via Login at the top of the website.<br /><br />
Whatever the query, well take care of it:</span>
</div>
<div style="width: 210px; margin: 0 auto; float: none; padding-left: 10px;"><a id="contact" href="#contactdiv"><img alt="" src="images/mail.png" align="absmiddle">&nbsp;<strong>support@geelaza.com</strong></a></div>
</div>
<div class="greenbot_bg"></div>

<div style="display: none;">
		<div id="contactdiv" style="width:840px;height:px;overflow:auto; background-color: transparent;">
	<?php //if (isset($_SESSION['user_id'])) {?>


		<div class="deal_recomm_ani10">
				<div class="top_recomm_ani10">
				<p>Customer Support</p>
				</div>
				<div class="clear"></div>
				<div style="border-bottom: 2px solid #eaf2e2;"></div>
				<div class="clear"></div>
				<div class="recomm_mid_ani10">

                    <table id="contact_form" width="100%" border="0" cellspacing="0" cellpadding="0" class="popup_form">
                      <tr>
                        <td width="400" style="vertical-align:top;">
                         <div class="white-container4">
		             	<form action="" name="frmcontact" method="post">
                           	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td style="white-space:nowrap;">Please fill out the form below and we will respond to you as soon as possible.</td>
                              </tr>
                              <tr>
                                <td>Your name <span class="red_txt">*</span></td>
                              </tr>
                              <tr>
                                <td><input type="text" name="name" id="name" class="txt_box1"/>
                                	<div class="error_orange"  style="display: none;" for="name" id="name_error">This field is required.</div>
                                </td>
                              </tr>
                              <tr>
                                <td>Your email address <span class="red_txt">*</span></td>
                              </tr>
                              <tr>
                                <td><input type="text" name="email" id="cont_email" class="txt_box1"/>
                                	<div class="error_orange"  style="display: none;" for="email" id="email_error">This field is required.</div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td>What is your enquiry about? <span class="red_txt">*</span></td>
                                        <td>Contact telephone number</td>
                                      </tr>
                                       <tr>
                                        <td>
                                        	<div style="width:190px;" class="styled_select">
                                            <select name="enquery" id="enquery" style="width:210px; color: #666666;">
                                                <option value="">Select your Subject</option>
						                        <option value="Account Management">Account Management</option>
						                        <option value="Credit Issue">Credit Issue</option>
						                        <option value="Deal Issue">Deal Issue</option>
						                        <option value="General Feedback">General Feedback</option>
						                        <option value="Gifting">Gifting</option>
						                        <option value="Payment">Payment</option>
						                        <option value="Policies">Policies</option>
						                        <option value="Technical Issue">Technical Issue</option>
                                            </select>
                                            </div>
                                            <div class="error_orange"  style="display: none;" for="enquery" id="enquery_error">This field is required.</div>
                                        </td>
                                        <td><input type="text" name="phno" id="phno" class="txt_box1" style="width:190px;"/>
                                        	<div class="error" for="phno" style="display: none;" id="phno_error">&nbsp;</div>
                                        </td>
                                      </tr>
                                    </table>
                                </td>
                              </tr>
                              <tr>
                                <td>Tell us a bit more<span class="red_txt">*</span></td>
                              </tr>
                              <tr>
                                <td>
                                	<textarea name="details" id="details"></textarea>
                                	<div class="error_orange"  style="display: none;" for="details" id="details_error">This field is required.</div>
                                </td>
                              </tr>
                              <tr>
                         <td><input type="button" name="submit"  value=" " class="submit_btn0" onclick="return send_mail();"></td>
                              </tr>


                            </table>
				</form>

<script type="text/javascript">
function send_mail() {
	//alert('Hi'); return false;

	//$('.error_orange').hide();
	//$('.error').hide();
	  $('input.text-input').css({backgroundColor:"#FFFFFF"});
	  $('input.text-input').focus(function(){
	    $(this).css({backgroundColor:"#FFDDAA"});
	  });
	  $('input.text-input').blur(function(){
	    $(this).css({backgroundColor:"#FFFFFF"});
	  });


	// validate and process form
	// first hide any error messages
	$('.error_orange').hide();


		var name = $("input#name").val();
		var email = $("input#cont_email").val();
		var enquery = $("select#enquery").val();
		var phno = $("input#phno").val();
		var details = $("textarea#details").val();

		if (name == "" || email == "" || enquery == "" || details == "") {
	  $("div#name_error").show();
	  $("div#email_error").show();
	  $("div#enquery_error").show();
	  $("div#details_error").show();
	  //$("div#phno_error").show();
	 // $("input#name").focus();
	  return false;
	}

	var dataString = 'name='+ name + '&email=' + email + '&enquery=' + enquery + '&details=' + details + '&phno=' + phno;
	//alert (dataString);return false;

	$.ajax({
  type: "POST",
  url: "ajax_contact.php",
  data: dataString,
  success: function() {
    $('#contact_form').html("<div id='message' class='message'></div>");
    $('#message').html("<h2>Thank You</h2>")
    .append("<p>Thanks for contacting us! A member of our Customer Service team will get back to you as soon as possible!</p>")
    .append("<p>If you don't hear from us within 7 working days then please contact us.</p>")
    //.hide()
    //.fadeIn(1500, function() {
     // $('#message').append("<img id='checkmark' src='images/tick.png' />");
    //});
  }
 });
return false;
}
</script>

                            <div class="white-tl4"></div>
                            <div class="white-bl4"></div>
                            <div class="white-tr4"></div>
                            <div class="white-br4"></div>
                        </div>
                        </td>
                        <td width="20">&nbsp;</td>
                        <td valign="top">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td>

                            	<ul class="popular_topics">
                            		<h1>Popular Topics</h1>
                                    <li id="gotqq1"><b>How do I print?</b></li>
                                    <div id="gotqa1" style="display: none;  margin-left: 28px;"><span style="font: normal 12px/17px Arial, Helvetica, sans-serif;">You can find your  vouchers in the emails that we sent to your personal email account. You can  alternatively click on this link <a href="<?php echo SITE_URL; ?>customer-login.php">www.geelaza.com</a> and log into your account. Once you have logged in, click on &ldquo;My  Vouchers&rdquo; and your voucher will be there for you to use or print it off like  you usually print off documents.</span></div>

                                    <li id="gotqq2">Where are my vouchers?</li>
                                    <div id="gotqa2" style="display: none;  margin-left: 28px;"><span style="font: normal 12px/17px Arial, Helvetica, sans-serif;">You can always find  all of your deals that you bought by clicking on &ldquo;My Account&rdquo; then select &ldquo;My  Vouchers&rdquo; from the option list in the top right corner (if you&rsquo;re logged in),  or by <a href="<?php echo SITE_URL; ?>customer-login.php">click</a> here.</span></div>

                                    <li id="gotqq3">How do I get credit for my referral work?</li>
                                    <div id="gotqa3" style="display: none;  margin-left: 28px;"><span style="font: normal 12px/17px Arial, Helvetica, sans-serif;">Well put &pound;5 worth of credit in your account after they (the person you recommended deal to) buy their first deal of more than 15! (This can take up to 48 hours). You can check your account credit by logging in and then go to Credits.</span></div>

                                    <li id="gotqq4">What if my voucher deal is about to expire?</li>
                                    <div id="gotqa4" style="display: none;  margin-left: 28px;"><span style="font: normal 12px/17px Arial, Helvetica, sans-serif;">We can&rsquo;t do much once your voucher has expired  so we recommend you to use your voucher before it expires otherwise you&rsquo;ve  wasted your money!</span></div>

                                    <li id="gotqq5">Can I return a voucher that I bought recently?</li>
                                    <div id="gotqa5" style="display: none;  margin-left: 28px;"><span style="font: normal 12px/17px Arial, Helvetica, sans-serif;">We provide a refund if you change your mind  within 5 days after you&rsquo;ve purchased your voucher (s) and want to return the  &ldquo;unused&rdquo; voucher(s)</span></div>
                                </ul>
                            </td>
                          </tr>
                          <tr>
                          	<td style="height:40px;">&nbsp;</td>
                          </tr>
                          <tr>
                            <td>
                            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td style="line-height:16px; width: 270px; padding-right: 10px;"><b>The GeeLaza Promise</b></<br /><br />
                                        If you have any issue with using GeeLaza, please contact us and we promise we will make it right.
                                    </td>
                                    <td><img src="images/timer.png" alt=""/></td>
                                  </tr>
                                </table>
                            </td>
                          </tr>
                        </table>
                        </td>
                      </tr>
                    </table>


				<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
				</div>
				<div class="clear"></div>
				<!--<div style="border-bottom: 2px solid #eaf2e2;"></div>-->
				<div class="recomm_bot_ani10"></div>
				</div>
		<?php //} else { ?>
		<!--
		<div class="top_recomm">
			<p>Please login to Gift deals to friends.</p>
		</div>
		<div class="clear"></div>
		<div style="border-bottom: 3px solid #7fd7fb;"></div>
		<div class="recomm_bot"></div>
		 -->
		<?php //} ?>
		</div>
</div>
		<script type="text/javascript">
	           $("li#gotqq1").click(function () {
	        	   $("div#gotqa1").slideToggle(300);
	        	   });

	        	   $(document).ready(function(){
	        	   $("div#gotqa1").ready(function() {
	        	   	$("div#gotqa1").hide(0);
	        	   });
	        	   });

	           $("li#gotqq2").click(function () {
	        	   $("div#gotqa2").slideToggle(300);
	        	   });

	        	   $(document).ready(function(){
	        	   $("div#gotqa2").ready(function() {
	        	   	$("div#gotqa2").hide(0);
	        	   });
	        	   });

	           $("li#gotqq3").click(function () {
	        	   $("div#gotqa3").slideToggle(300);
	        	   });

	        	   $(document).ready(function(){
	        	   $("div#gotqa3").ready(function() {
	        	   	$("div#gotqa3").hide(0);
	        	   });
	        	   });


        	   $("li#gotqq4").click(function () {
	        	   $("div#gotqa4").slideToggle(300);
	        	   });

	        	   $(document).ready(function(){
	        	   $("div#gotqa4").ready(function() {
	        	   	$("div#gotqa4").hide(0);
	        	   });
	        	   });

        	   $("li#gotqq5").click(function () {
	        	   $("div#gotqa5").slideToggle(300);
	        	   });

	        	   $(document).ready(function(){
	        	   $("div#gotqa5").ready(function() {
	        	   	$("div#gotqa5").hide(0);
	        	   });
	        	   });

           </script>
</div>
<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>

<!--


<div class="rightbox1">
<div class="curtop_bg">
<p>Enjoy with friends</p>
</div>
<div class="clear"></div>
<div class="curmid_bg">
<div style="padding: 10px 10px;"><span>If you have any issues/queries please get in touch with us and we will respond to you as soon as possible.</span></div>
<div class="clear"></div>


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


			/*$sql_chk_fb_user = "SELECT * FROM ".TABLE_USERS." WHERE email = '".$user->email."'";
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

			}*/





	   	}
?>
<div style="width: 220px; height: 22px; padding-left: 10px;">
<?php //if ($cookie) { ?>
<!--<div><a href="#"><img src="images/login.gif" border="0" alt="" width="70" height="21" /></a></div>-->
<!--<fb:login-button perms="email" autologoutlink="true" onlogin="window.location.reload()"></fb:login-button>
<?php unset($_SESSION['fbuser']); ?>
<?php //} else { ?>
<fb:login-button perms="email" autologoutlink="true">Login with facebook</fb:login-button>
<?php //header("location:".SITE_URL."customer-account.php"); ?>
<?php //} ?>
</div>
</div>
<div class="curbot_bg"></div>
<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
</div>-->


<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
<div class="rightbox1">
<div class="curtop_bg">
<p style="font-size: 15px;">Check GeeLaza with friends</p>
</div>
<div class="clear"></div>
<div class="curmid_bg">
<div style="padding: 10px 10px;">

<iframe style="border: 0px solid red; width: 212px; height: 270px;" src="https://www.connect.facebook.com/widgets/fan.php?id=359033627455403&connections=10&stream=false&header=true"></iframe>

<!-- <div class="fb-like-box" data-href="http://www.facebook.com/pages/GeeLaza/359033627455403" data-width="212" data-height="300" data-show-faces="true" data-stream="false" data-header="false"></div> -->
<span class="black_text" style="color:#3A3B3D;"><img alt="" src="images/twitter.png" align="top">&nbsp;<b>Follow GeeLaza UK on Twitter</b></span>
</div>
<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
</div>
</div>
<div class="curbot_bg"></div>
<div><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
</div>
<div class="clear"></div>
<!--<div class="rightbox1">
<div class="curtop_bg">
<p style="text-align: center;">Our Promise</p>
</div>
<div class="clear"></div>
<div class="curmid_bg">
<p style="margin-top: -20px; width: 212px; padding: 0 10px 0 10px; line-height: 16px; text-align:center;">If you change your mind within five after you've purchased your voucher and want to return the unused voucher. Then click on the refund button to proceed.</p>
<div style="text-align:center; margin-top:10px;"><a href="ecard.php"><img src="images/refund.png" alt="" border="0" width="87" height="20" /></a></div>
</div>
<div class="curbot_bg"></div>
</div>-->
<div><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
<div class="rightbox">
<div class="headingbg_national">
<p>The GeeLaza Promise</p>
</div>
<div style="background: #fff;">
<div style="background: none;" class="curmid_bg">
<p style="width: 212px; padding: 0 10px 0 10px; line-height: 20px; text-align: left; font-family: arial; font-size: 14px; color: #7a7a7a;">We provide a refund if you change your mind within 5 days after you've purchased your voucher(s) and want to return the unused voucher(s)</p>
<a href="ecard.php"><div class="refund_6"></div></a>
</div>
</div>
<div style="width:232px; height:11px;"><img src="images/right_bttom.png" alt="" width="232" height="11" /></div>
</div>
<!--<div style="height:216px" class="ecardBox">
	<div style="width: 190px; height: 150px; float: none; clear: both; padding: 40px 20px 10px 20px; font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000;">
	<p>We have fanstastic range of email cards which are perfectly designed and you can send it to your loved one in less than a minute with your personal message.</p>
	<p><a href="order.php"><img src="images/ecard_btn.png" alt="" width="150" height="34" border="0" /></a></p>
	</div>
</div>-->

</div>
<!--</div>-->
<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
</div>