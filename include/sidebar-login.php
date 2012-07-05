<div id="rightcol">
<?php if ($_SESSION["user_id"] != "") { ?>
<div class="rightbox1">
<div class="curtop_bg">
<p style="font-size:18px;">Recomend Jumblr</p>
</div>
<div class="clear"></div>
<div class="curmid_bg">
<div style="width: 230px; margin: 5px auto; float: none;">

<div style="width: 220px; margin: 0 auto; float: right;"><p class="text11">Recomend Jumblr to your friends and you will receive:<br> <b>&pound;5.00 </b>for every Recommendation!</p></div>
<div class="clear"></div>
<div class="price_bg">Your account: &pound;<?php if (get_credits($_SESSION['user_id']) == '') { echo "0.00";} else { echo number_format(get_credits($_SESSION['user_id']),2);} ?></div>
<center class="recomend_btn"><a id="various2" href="#inline1" class="recomend_btn"><!--<img src="images/recommend_btn.png" width="140px" height="28" class="recomend_btn">-->recommend_btn</a></center>
</div>
<?php include '../recommendation_popup.php';?>
</div>
<div class="curbot_bg"></div>
</div>
<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
<?php } ?>

<div class="rightbox1">
<div class="greentop_bg_ani_2012">
<p>Jumblr UK <br />
Custome Services</p>
</div>
<div class="clear"></div>
<div class="greenmid_bg">
<div style="width: 212px; margin: 8px 8px; float: none; padding-top: 5px; padding-right: 5px;">
<span><a href="<?php echo SITE_URL; ?>faq.php" style="padding:0 0 10px 0; margin:0 0 10px 0;"><span style="line-height:25px; color: #292929; text-decoration: underline;">Check out our FAQ’s</span></a><br />
Please note you can retrieve your voucher by logging into your account via “Login” at the top of the website.<br /><br />
Whatever the query, we’ll take care of it:</span>
</div>
<div style="width: 210px; margin: 0 auto; float: none; padding-left: 10px;"><a id="contact" href="#contactdiv"><img alt="" src="images/mail.png" align="absmiddle">&nbsp;<strong>support@Jumblr.com</strong></a></div>
</div>
<div class="greenbot_bg"></div>

<div style="display: none;">
		<div id="contactdiv" style="width: auto; height:px; overflow:auto; background-color: transparent;">
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
                                        	<div class="error" style="display: none;" for="phno" id="phno_error">&nbsp;</div>
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
                                	<div class="error_orange" for="details" id="details_error" style="display: none;">This field is required.</div>
                                </td>
                              </tr>
                              <tr>
                                <td><input type="button" name="submit"  value="Submit" class="submit_btn01" style="cursor: pointer;" onclick="return send_mail();"></td>
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
                                    <div id="gotqa1" style="display: none;  margin-left: 28px;"><span style="font: normal 12px/17px Arial, Helvetica, sans-serif;">You can find your  vouchers in the emails that we sent to your personal email account. You can  alternatively click on this link <a href="<?php echo SITE_URL; ?>customer-login.php">www.Jumblr.com</a> and log into your account. Once you have logged in, click on &ldquo;My  Vouchers&rdquo; and your voucher will be there for you to use or print it off like  you usually print off documents.</span></div>

                                    <li id="gotqq2">Where are my vouchers?</li>
                                    <div id="gotqa2" style="display: none;  margin-left: 28px;"><span style="font: normal 12px/17px Arial, Helvetica, sans-serif;">You can always find  all of your deals that you bought by clicking on &ldquo;My Account&rdquo; then select &ldquo;My  Vouchers&rdquo; from the option list in the top right corner (if you&rsquo;re logged in),  or by <a href="<?php echo SITE_URL; ?>customer-login.php">click</a> here.</span></div>

                                    <li id="gotqq3">How do I get credit for my referral work?</li>
                                    <div id="gotqa3" style="display: none;  margin-left: 28px;"><span style="font: normal 12px/17px Arial, Helvetica, sans-serif;">We’ll put &pound;5 worth of credit in your account after they (the person you recommended deal to) buy their first deal of more than £15! (This can take up to 48 hours). You can check your account credit by logging in and then go to “Credits”.</span></div>

                                    <li id="gotqq4">What if my voucher deal is about to expire?</li>
                                    <div id="gotqa4" style="display: none;  margin-left: 28px;"><span style="font: normal 12px/17px Arial, Helvetica, sans-serif;">We can&rsquo;t do much once your voucher has expired  so we recommend you to use your voucher before it expires otherwise you&rsquo;ve  wasted your money!</span></div>

                                    <li id="gotqq5">Can I return a voucher that I bought recently?</li>
                                    <div id="gotqa5" style="display: none;  margin-left: 28px;"><span style="font: normal 12px/17px Arial, Helvetica, sans-serif;">We provide a refund if you change your mind  within 5 days after you&rsquo;ve purchased your voucher (s) and want to return the  &ldquo;unused&rdquo; voucher(s)</span></div>
                                </ul>
                            </td>
                          </tr>
                          <tr>
                          	<td style="height:160px;">&nbsp;</td>
                          </tr>
                          <tr>
                            <td>
                            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td style="line-height:16px; width: 270px; padding-right: 10px;"><b>The Jumblr Promise</b></<br /><br />
                                        If you have any issue with using Jumblr, please contact us and we promise we will make it right.
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



<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
<div class="rightbox1">
<div class="curtop_bg">
<p style="font-size: 15px;">Check Jumblr with friends</p>
</div>
<div class="clear"></div>
<div class="curmid_bg">
<div style="padding: 10px 10px;">

<iframe style="border: 0px solid red; width: 212px; height: 270px;" src="https://www.connect.facebook.com/widgets/fan.php?id=141790935958288&connections=10&stream=false&header=true"></iframe>

<!-- <div class="fb-like-box" data-href="http://www.facebook.com/pages/Jumblr/141790935958288" data-width="212" data-height="300" data-show-faces="true" data-stream="false" data-header="false"></div> -->

<span class="black_text" style="color:#3A3B3D;"><img alt="" src="images/twitter.png" align="top">&nbsp;<b>FollowJumblra UK on Twitter</b></span>
</div>
<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
</div>
</div>
<div class="curbot_bg"></div>
<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>



</div>
</div>
</div>
</div>
<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
</div>