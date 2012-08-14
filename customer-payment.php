<?php
include("include/header.php");
if (!isset($_SESSION['fb_id'])) {
	include 'fbmain.php';
}
session_start();
ob_start();
?>
<?php
	if(!isset($_COOKIE["subscribe"]))
	header("location:".SITE_URL);

if ($_GET['item'] != "")  {
	$prod_id = $_GET['item'];
	$multi_deal_id = $_GET['mid'];

	$_SESSION['prod_id'] = $_GET['item'];
	$_SESSION['mid'] = $_GET['mid'];

	$sql_prod = "SELECT * FROM ".TABLE_DEALS." WHERE status >= 1 AND deal_id = '".$prod_id."' LIMIT 0, 1";
	$prod_res = mysql_fetch_array(mysql_query($sql_prod));

	// select multi deal if has
	if ($prod_res['is_multi'] == 'y') {
		if ($_GET['mid'] != '') {
			$sql_is_multi = "SELECT * FROM getdeals_multi_deals WHERE deal_id = ".$prod_res['deal_id']." AND multi_deal_id = ".$multi_deal_id;
			$is_multi = mysql_fetch_array(mysql_query($sql_is_multi));
		} else {
			header('location:'.SITE_URL);
		}
	}
	//$prod_res['is_multi'] == 'n' ? number_format($prod_res['discounted_price'], 2) : number_format($is_multi['multi_deal_item_price'], 2)

	/*$sql_todays_buy = "SELECT SUM(qty) FROM ".TABLE_TRANSACTION." WHERE deal_id = ".$today_res['deal_id'];
	$total_buy = mysql_fetch_array(mysql_query($sql_todays_buy));

	$sql_todays_image = "SELECT * FROM ".TABLE_DEAL_IMAGES." WHERE deal_id = ".$today_res['deal_id'];
	$todays_image = mysql_fetch_array(mysql_query($sql_todays_image));*/
}
else {
	header('location:'.SITE_URL);
}

/*if (isset($_POST['Submit']) && $_POST['Submit'] == 'Send as Gift') {
	$_SESSION['gift_mail'] = $_POST['frndemail'];
	$_SESSION['gift_name'] = $_POST['frndname'];
	$_SESSION['gift_msg'] = $_POST['frndmsg'];
}*/

if ($_GET['gift'] == 'gifting') {
		$_SESSION['gift'] = 'gifting';
}
if ($_SESSION['gift'] == 'gifting') {
		$_SESSION['header_location'] = SITE_URL.'customer-payment.php?item='.$_SESSION['prod_id'].'&gift='.$_SESSION['gift'];
	} else {
		$_SESSION['header_location'] = SITE_URL.'customer-payment.php?item='.$_SESSION['prod_id'];
}

?>

<!-- Login code starts -->
<?php
/*
	$flag = 0;
	if(strtolower($_SERVER['REQUEST_METHOD']) == 'post' && $_POST['btnLogin'] == "Log In")
	{


		$lemail = $_POST["lemail"];
		$lpassword = $_POST["lpassword"];

		if($flag == 0)
		{
			if($lemail == '')
			{
				$msg = 'Please enter email';
				$flag = 1;
			}
		}

		if($flag == 0)
		{
			if($lpassword == '')
			{
				$msg = 'Please enter password';
				$flag = 1;
			}
		}

		if($flag == 0)
		{
			$lpassword = base64_encode($lpassword);
			$sql_select = "SELECT * FROM ".TABLE_USERS." WHERE email="."'".$lemail."' and password="."'".$lpassword."'";
			$result_select = mysql_query($sql_select);
			$count_select = mysql_num_rows($result_select);
			if($count_select >0)
			{
				$row_select = mysql_fetch_array($result_select);
				$user_id = $row_select["user_id"];
				$_SESSION["user_id"] = $user_id;
				if ($_SESSION['mid'] != '') {
				header('location:'.SITE_URL.'customer-payment.php?item='.$_SESSION['prod_id'].'&mid='.$_SESSION['mid']);
				} else {
				header('location:'.SITE_URL.'customer-payment.php?item='.$_SESSION['prod_id']);
				}

			}
			else
			{
				$msg = 'Invalid login';
				$flag = 1;
			}
		}

	}

*/
?>
<!-- Login code ends -->
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
<?php
if ($_GET['gift'] == 'gifting') {
?>
<div class="top_curve1_23"></div>
<div class="clear"></div>
<div class="mid_curve1_23">
<div class="signup_box1">
<p class="reset" style="padding: 0px 0 0 15px; line-height: 10px; margin: 0px 0 0 0; font: normal 13px Arial Rounded MT Bold;">
	<span><img alt="" src="images/gift_pix.gif" align="absmiddle"></span>
	<span style="line-height: 10px; padding: 0 0 0 10px;">Buy this deal as gift. All Jumblr deals are transferable!</span>
</p>
</div>
</div>
<div class="bot_curve1_23"></div>
<?php
 }
?>

<div class="accounts">
<div class="accounts_top"></div>
<div class="accounts_mid">
		<!--<p style="padding:0; margin: 7px  0 0 10px; font-family: Arial Rounded MT Bold; color: #ff7f22; font-size:30px;">Your Order </p>-->
        <div class="white-container1" style="width:97%; margin: 10px auto 0 auto; background:#fff;">
			<div>
              <!-- <div class="start_savings"></div>-->
            	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="cart_box2">
                  <tr>
                    <td colspan="4" style="font: bold 15px/26px Arial, Helvetica, sans-serif; color:#000"><strong></strong></td>
                  </tr>
                  <tr>
                    <th width="395"><strong>Your Deal</strong></th>
                    <th width="95" style="border-right:0px;"><strong>Quantity</strong></th>
                    <th width="41" style="border-left:0px;"><strong></strong></th>
                    <th width="97" style="border-right:0px;"><strong>Price</strong></th>
                    <th width="11" style="border-left:0px;"><strong></strong></th>
                    <th width="371" align="left"><strong>Total</strong></th>
                  </tr>
                  <tr class="gray_01">
                    <td>
                    <script type="text/javascript">
                    	function multiProdSelect(mid) {
							var url = '<?php echo SITE_URL; ?>customer-payment.php?item=<?php echo $prod_res['deal_id']; ?>&mid='+mid+'';
							window.open(url, "_self", "");
                    	}
                    </script>
                    	<?php
                    		/*if ($_SESSION['gift_mail'] != NULL) {
                    			echo '<img height="50" width="55" alt="" src="images/Giftbox.png" align="left">';
                    		}*/
                    	if ($prod_res['is_multi'] == 'y') {
	                    	if ($_GET['mid'] != '') {
								$sql_is_multi_title = "SELECT * FROM getdeals_multi_deals WHERE deal_id = ".$prod_res['deal_id'];
								echo '
									<div style="width:290px;" class="styled_select left">
									<select name="" style="width:310px;" onchange="return multiProdSelect(this.options[this.selectedIndex].id);">';
								$is_multi_title_res = mysql_query($sql_is_multi_title);
									while ($is_multi_title_row = mysql_fetch_array($is_multi_title_res)) {
									echo '<option name="" value="'.$is_multi_title_row['multi_deal_item_name'].'" id="'.$is_multi_title_row['multi_deal_id'].'" '.($_GET['mid'] == $is_multi_title_row['multi_deal_id'] ? "selected=selected" : "").'>'.strip_tags($is_multi_title_row['multi_deal_item_name']).'</option>';
									}
								echo '
									</div>
									</select>';
	                    	}

                    	} else {
                    		echo strip_tags($prod_res['title']);
                    	}

                    		//echo strip_tags($prod_res['deal_id']);
                    	?>

                    </td>
                    <td>
					<div class="styled_select" style="width:60px;">
                    	<select style="background: transparent; width: 80px;" name="amount" id="" onchange="ajaxReq(this.value);">
						<?php for ($i = 1; $i <= 30; $i++) { ?>
						<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						<?php } ?>
						</select>
						</div>
                    </td>
                     <td>x</td>
                    <td><?php echo getSettings(currency_symbol); ?><?php echo ($prod_res['is_multi'] == 'n' ? number_format($prod_res['discounted_price'], 2) : number_format($is_multi['multi_deal_item_price'], 2)); //number_format($prod_res['discounted_price'], 2); ?></td>
                    <td>=</td>
                    <td><div id="total_price"><?php echo getSettings(currency_symbol); ?><?php echo ($prod_res['is_multi'] == 'n' ? number_format($prod_res['discounted_price'], 2) : number_format($is_multi['multi_deal_item_price'], 2)); //number_format($prod_res['discounted_price'], 2); ?></div></td>
                  </tr>

                  <!--<tr>
                    <td colspan="3" style="font: bold 15px/26px Arial, Helvetica, sans-serif; text-align:right;">Total Cost = </td>
                    <td style="font: bold 15px/26px Arial, Helvetica, sans-serif; text-align:right; text-align:left; padding-left:10px;">
                    	<div id="big_total_price"><?php echo getSettings(currency_symbol); ?><?php echo strip_tags($prod_res['discounted_price']); ?></div>
                    	<?php //echo $_SESSION['total_price']; ?>
                    </td>
                  </tr>-->
                </table>
                <br>
                <?php if ($_GET['gift'] == 'gifting') : ?>
                &nbsp;<a href="#giftdiv" id="gift" class="redemClass"><img alt="" src="images/icon_t.gif" align="bottom"> <b>Give this Jumblr as Gift</b></a>
				<?php endif ?>

				<div style="display: none;">
						<div id="giftdiv" style="width:701px;height:px;overflow:auto; background-color: transparent;">
					<?php //if (isset($_SESSION['user_id'])) {?>

					<form action="" name="frmgift" method="post">
						<div class="deal_recomm">
								<div class="top_recomm">
								<p>Buy it for a friend!</p>
								</div>
								<div class="clear"></div>
								<div style="border-bottom: 3px solid #7fd7fb;"></div>
								<div class="clear"></div>
								<div class="recomm_mid"  id="gift_response">


								<div class="invita_deal">
								<div><p style="font: bold 16px/16px Arial, Helvetica, sans-serif; padding: 14px 0 8px 0px; margin: 0;">Fill out the from below and give the gift of Jumblr!</p></div>
								<div class="clear"></div>
								</div>
								<div class="invita_deal">
								<div class="massage">
								  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                    <tbody><tr>
                                      <td><table width="100%" border="0" cellpadding="2" cellspacing="2">
                                        <tbody><tr>
                        <td><p style="font: normal 14px/16px Arial, Helvetica, sans-serif; padding: 6px 0px; margin: 0;">To</p></td>
                                        </tr>
                                        <tr>
	                                   <td>
	                                   	<input name="frndname" id="frndname" type="text"  class="text_box12" style="width: 230px;"/>
										<div id="name_error" class="error"  style="display: none;">This field is required.</div>
	                                   </td>
                                        </tr>
                                        <tr>
                                          <td><p style="font: normal 14px/16px Arial, Helvetica, sans-serif; padding: 6px 0px; margin: 0;">From <span style="font: normal 12px/16px Arial, Helvetica, sans-serif; padding: 10px 0px; margin: 0;">(Name you want the recipient to see)</span></p></td>
                                        </tr>
                                        <tr>
                                          <td>
                                          	<input name="fromname" id="fromname" class="text_box12" style="width: 230px;" type="text">

                                          	</td>
                                        </tr>
                                        <tr>
                                          <td><p style="font: normal 14px/16px Arial, Helvetica, sans-serif; padding: 6px 0px; margin: 0;">Delivery Method</p></td>
                                        </tr>
                                        <tr>
                                          <td><input name="radiobutton" value="radiobutton" type="radio">
                                          <span style="font: normal 12px/26px Arial, Helvetica, sans-serif; padding: 6px 0 20px 0px; margin: 0;">Email it to</span></td>
                                        </tr>
                                        <tr>
                                          <td>
                                          	<input name="frndemail" id="frndemail" type="text" class="text_box12" style="width: 230px;"/>
											<div id="email_error" class="error"  style="display: none;">Please enter a valid email.</div>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td><input name="radiobutton" value="radiobutton" type="radio">
                                          <span style="font: normal 12px/26px Arial, Helvetica, sans-serif; padding: 10px 0 20px 0px; margin: 0;">I'll print it myself</span></td>
                                        </tr>
                                        <tr>
                                          <td>
                                          <input type="button" name="Submit" class="tellbtn" value="Save Details" onclick="return set_gift();"/>
									<!-- <a href="javascript: void(0);" style="text-decoration: none;"><input type="button" name="close" class="tellbtn" value="Close" onclick=""/></a> -->
									<!-- href="<?php echo SITE_URL; ?>customer-payment.php?item=<?php echo $prod_res['deal_id']; ?>&gift=gifting" -->

										  </td>
                                        </tr>
                                        <tr>
                                          <td>&nbsp;</td>
                                        </tr>
                                      </tbody></table></td>
                                      <td align="left" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                        <tbody><tr>
                                          <td><p style="font: normal 14px/16px Arial, Helvetica, sans-serif; padding: 10px 0px; margin: 0;">Message <span style="font: normal 11px/26px Arial, Helvetica, sans-serif; padding: 10px 0 20px 0px; margin: 0;">(Maximum 350 characters)</span></p></td>
                                        </tr>
                                        <tr>
                                          <td>
                                          	<textarea name="frndmsg" id="frndmsg" class="textareabg" style="width: 300px; height: 210px;"></textarea>
											<div id="msg_error" class="error"  style="display: none;">Please enter your message.</div>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td><p style="font: normal 14px/16px Arial, Helvetica, sans-serif; padding: 10px 0px; margin: 0;">350 characters remaining</p></td>
                                        </tr>
                                      </tbody></table></td>
                                    </tr>
                                  </tbody></table>
								</div>
								</div>


								</div>
								<div class="clear"></div>
								<div style="border-bottom: 3px solid #7fd7fb;"></div>
								<div class="recomm_bot"></div>
								</div>
						</form>
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
				function set_gift() {
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
					$('.error').hide();


						var name = $("input#frndname").val();
						var email = $("input#frndemail").val();
						var details = $("textarea#frndmsg").val();

						if (name == "" || email == "" || details == "") {
					  $("div#name_error").show();
					  $("div#email_error").show();
					  //$("div#enquery_error").show();
					  $("div#msg_error").show();
					  //$("div#phno_error").show();
					 // $("input#name").focus();
					  return false;
					}

					var dataString = 'name='+ name + '&email=' + email + '&details=' + details ;
					//alert (dataString);return false;

					$.ajax({
				  type: "POST",
				  url: "ajax_gift.php",
				  data: dataString,
				  success: function() {
				    $('#gift_response').html("<div id='message' class='message'></div>");
				    $('#message').html("<h2>Thank You</h2>")
				    .append("<p>Thanks for attaching details!</p>")
				    //.append("<p>If you don't hear from us within 7 working days then please contact us.</p>")
				    //.hide()
				    //.fadeIn(1500, function() {
				     // $('#message').append("<img id='checkmark' src='images/tick.png' />");
				    //});
				  }
				 });
				return false;
				}
				</script>


				<div style="width: 100%; height: auto; margin:0;">
				  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr style="height: 40px;">
					<?php
					
					$chk_fb_sql = "SELECT * FROM ".TABLE_FB_USER." WHERE fb_id  = '".$_SESSION['fb_id']."'";
					$fb_query =  mysql_fetch_array(mysql_query($chk_fb_sql));
					 $email = $fb_query['email'];
					
					
					
					$chk_recom_vault_sql = "SELECT * FROM ".TABLE_CREDITS_VAULT." WHERE user_id  = '$email'";
					$recom_vault_query = mysql_query($chk_recom_vault_sql);
					$chk_recom_vault_row = mysql_num_rows($recom_vault_query);
					if ($chk_recom_vault_row > 0) {

					?> <td style="color:#7fd7fc; font: normal 12px/18px Arial, Helvetica, sans-serif;" width="59%">
					 <div id="redeem" style="width: 330px;" class="redemClass">
					 	<p style="padding:0; margin:0 0 0 5px;"><a href="javascript: void(0);">Do you want to use your discount?</a></p>
					 </div>
					 <div class="clear"></div>

					 <div id="redeem_div" style="width:330px; padding-top: 1px;  display: none;">
					 <div style="width:150px; float: left; margin: 5px 0 0 5px;">
					 
					 <label>20% discount</label>
					 </div>
					 <?php

					   $discount=$prod_res['discounted_price']-($prod_res['discounted_price']*getSettings(discount));

					  ?>
					 <div style="float: right; text-align:right; width: 130px; margin-top: 3px;"><input type="submit" class="tellbtn13" name="submit" value="Apply" id="discount" onclick="return change('<?php echo number_format($discount,2) ?>')"/></div><div id="disp" style="display:none">Discount will be deducted from purchase value</div>
					 </div>
					
					 </td> <?php
					 }
					 ?>

                      <td style="font-family:Arial Rounded MT Bold; font-size: 14px; color: #333333; text-align:right; text-align:left; padding-left:10px;" width="65%">Total amount:</td>
                      <td style="font-family:Arial Rounded MT Bold; font-size: 20px; color: #000; text-align:left; padding-left:15px;" width="36%;">

                      	<div id="big_total_price" style="text-align:right; padding-right: 15px;"><?php echo getSettings(currency_symbol); ?><?php echo ($prod_res['is_multi'] == 'n' ? number_format($prod_res['discounted_price'], 2) : number_format($is_multi['multi_deal_item_price'], 2)); //number_format($prod_res['discounted_price'], 2); ?><span></span>
                      	</div>
                    	<?php //echo $_SESSION['total_price']; ?></td>
                    </tr>
                  </table>
				</div>

            </div>

    </div>
  </div>
		<div class="accounts_bot"><img src="images/spacer.gif" alt="" width="1" height="9"/></div>
</div>
<script>
$("div#redeem").click(function () {
	$("div#redeem_div").slideToggle(500);
});

/*$("p#close").click(function() {
	$("div#redeem_div").slideUp(300);

}); */

$("div#redeem_div").ready(function() {
	$("div#redeem_div").hide(0);
});
</script>
<div class="clear"></div>
<div class="accounts">
<div class="accounts_top"></div>
<div class="accounts_mid">

<?php if (!$_SESSION['fb_id']) { ?>
<p class="black_text1" style="color:#3A3B3D; margin: 5px 15px 0 0;"><a href="<?php echo $loginUrl; ?>"><img src="http://www.realestatenewport.com/assets/facebook-login-button-5c5750b27cc8759f735f49a5ad2a4263.png" alt="" align="top" /></a> Please login with Facebook to buy this deal. If you have an account on Facebook you can use it to log in.</p>
<?php } ?>
                <div class="clear"></div>
                <div class="register_box2">

                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td style="vertical-align:top; padding:0px;">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td>
<?php if (!isset($_SESSION['user_id'])) { ?>

<?php

if($flag !=0)
{
	if($flag == 1)
	{
		?>
		<div style="width:100%; height:45px; background-color:#fff; padding-top:4px; padding-left:30px;">
		<label style="color:red;"><?php //echo "* ".$msg; ?> Please enter your details into the highlited boxes and you must agree with our Terms &amp; Conditions.</label>

		</div>
		<?php
	}
	if($flag == 2)
	{
		//header('location:'.SITE_URL.'national_deals.php?acsucc=You\'ve successfully created your account. Welcome to Jumblr!');
		?>
		<div style="width:100%; height:45px; background-color:#fff;padding-top:4px; padding-left:30px;  text-align: center;">
		<label style="color:#006600;"><?php echo $msg; ?></label>
		</div>
		<?php
	}
}
?>

<form action="thankyou.php" name="cust_register" id="cust_register" onkeyup="javascript: return hasValue();" onsubmit="javascript:return ValidateCcForm();" method="post"  class="skinned-form-controls skinned-form-controls-mac" style="background:#fff; margin:0px; padding:0px; border:1px solid #fff;">


<div><h6 style="margin: 15px 0 15px 15px; background:none; font-size:24px; text-align:left;" >Choose Payment Method To Pay For Your Jumblr Voucher</h6></div>

    <div style="border:1px solid #CCCCCC; margin:15px 0;">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  	<td><form class="skinned-form-controls skinned-form-controls-mac"><table  style="padding-top:15px;" width="100%" border="0" cellspacing="0" cellpadding="0">
	  		<input type="hidden" maxlength="7" name="payment_amount" id="payment_amount" value="<?php echo ($prod_res['is_multi'] == 'n' ? number_format($prod_res['discounted_price'], 2) : number_format($is_multi['multi_deal_item_price'], 2)); //$prod_res['discounted_price']; ?>">
			<input type="hidden" name="paymentType" value="Sale" />
					  <tr>
					    <!--<td width="6%" align="left" valign="top" style="padding-left:12px;"><input type="radio" id="ccrad" name="payment_system"  value="cc" checked="checked" style="z-index: 1000;"/></td>-->
					    <td width="18%" align="left" valign="middle" style="font: bold 13px/33px Arial, Helvetica, sans-serif;
	color: #3a3b3d; padding-left: 15px;"><input style="margin-top: 7px;" type="radio" id="ccrad" name="payment_system"  value="cc" checked="checked"/><span style="text-transform: uppercase; font-size:12px; padding-left:5px;">&nbsp;&nbsp;Credit/Debit Card</span></td>
					    <td width="25%" align="left" valign="top"><img src="images/c_cards.gif" alt="" width="214" height="33" align="absmiddle"/></td>
						<td style="padding-left: 15px; font: bold 13px/33px Arial, Helvetica, sans-serif;
	color: #3a3b3d;" valign="top"><input style="margin-top: 7px;" type="radio" name="payment_system" id="maestro" value="maestro" />
                          <span style="text-transform: uppercase; font-size:12px; padding-left:5px;">&nbsp;&nbsp;Maestro</span> <img src="images/payment_icon01.gif" alt="" width="51" height="33" align="absmiddle" /></td>
						<td style="padding-left: 15px; font: bold 13px/33px Arial, Helvetica, sans-serif;
	color: #3a3b3d;" valign="top"><input style="margin-top: 7px;" type="radio" name="payment_system" id="paypal" value="paypal" />
                        <span style="text-transform: uppercase; font-size:12px; padding-left:5px;">&nbsp;&nbsp;Paypal</span> <img src="images/paypal.gif" alt="" width="51" height="33" align="absmiddle" /><br />
                        </td>
					  </tr>
					</table></form></td>
	  </tr>
	</table>

      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="660">

            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="leftfrom" style="width:100%; <?php if (isset($_SESSION['user_id'])) { echo 'border: none;'; }?> ">
                    <tr>
                    <td style="vertical-align:top;  padding:0px;">
<?php if (!isset($_SESSION['user_id'])) { ?>

   <!-- Not Login Payment table starts -->
<!-- <form action="" name="frmccnotloginpayment" method="post" class="skinned-form-controls skinned-form-controls-mac" onsubmit="javascript: return ValidateCcForm();"> -->
    <input type="hidden" maxlength="7" name="payment_amount" id="payment_amount" value="<?php echo ($prod_res['is_multi'] == 'n' ? number_format($prod_res['discounted_price'], 2) : number_format($is_multi['multi_deal_item_price'], 2)); //$prod_res['discounted_price']; ?>">
	<input type="hidden" name="paymentType" value="Sale" />
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  	<td></td>
	  </tr>
	</table>
         <table width="100%" border="0" cellspacing="0" cellpadding="0" class="leftfrom" style="width:100%;">
		 <!--<tr>
	  	<td><table  style="padding-top:15px;" width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
					    <td width="6%" align="left" valign="top" style="padding-left:12px;"><input id="ccrad" name="payment_system" type="radio" value="cc" checked="checked"/></td>
					    <td width="18%" align="left" valign="top" style="font: bold 13px/20px Arial, Helvetica, sans-serif;
	color: #3a3b3d;"><span style="text-transform: uppercase; font-size:12px;">Credit/Debit Card</span></td>
					    <td width="30%" align="left" valign="top"><img src="images/c_cards.png" alt="" width="112" height="19"/></td>
						<td style="padding-left: 15px; font: bold 13px/20px Arial, Helvetica, sans-serif;
	color: #3a3b3d;" valign="top"><input type="radio" name="payment_system" id="maestro" value="maestro" />
                          <span style="text-transform: uppercase; font-size:12px;">Maestro</span> <img src="images/payment_icon01.png" alt="" width="22" height="14" /></td>
						<td style="padding-left: 15px; font: bold 13px/20px Arial, Helvetica, sans-serif;
	color: #3a3b3d;" valign="top"><input type="radio" name="payment_system" id="paypal" value="paypal" />
                        <span style="text-transform: uppercase; font-size:12px;">Paypal</span> <img src="images/paypal.png" alt="" width="43" height="15" /><br />
                        </td>
					  </tr>
					</table></td>
	  </tr>-->
                <tr>
                  <td width="660">

                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                     <!--<tr>
                        <td colspan="2" style="padding-left:14px;"><img src="images/payment_details.png" alt="" width="164" height="21"/></td>
                     </tr>
                      <tr>
                        <td style="font: normal 11px/14px Arial, Helvetica, sans-serif; color:#666666; padding-left:14px;" width="100%" colspan="2">Please provide your credit card information below</td>
                      </tr>-->
					   <!--<tr>
                        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
					    <td width="6%" align="left" valign="top" style="padding-left:14px;"><input id="ccrad" name="payment_system" type="radio" value="cc" checked="checked"/></td>
					    <td width="26%" align="left" valign="top">Credit/Debit Card</td>
					    <td width="68%" align="left" valign="top"><img src="images/c_cards.png" alt="" width="112" height="19"/></td>
					  </tr>
					</table></td>
                    </tr>-->
				 <tr>
    <!-- cc form -->

                        <td colspan="2"><table  id="cc" style="margin: 0 0 0 20px;" width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="width:auto;">
                           <tr>
                            <td width="100%" colspan="2">
                            	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="width:auto;">
                                  <tr>
                                    <td width="315">CARDHOLDERS FIRST NAME</td>
                                    <td>CARDHOLDERS LAST NAME</td>
                                  </tr>
                                  <tr>
                                    <td><input type="text" size=30 maxlength=32 name=firstName id=firstName class="text_box123" style="width:285px;"/></td>
                                    <td><input type="text" size=30 maxlength=32 name=lastName id=lastName class="text_box123" style="width:286px;"/></td>
                                  </tr>
                                  <tr>
                                  	<td><div id="payment_cc_firstName_errorloc" class="error_orange"></div></td>
                                  	<td><div id="payment_cc_lastName_errorloc" class="error_orange"></div></td>
                                  </tr>
                                </table>
                            </td>
                          </tr>
                          <tr>
                            <td width="100%" colspan="2">ADDRESS LINE 1</td>
                          </tr>
                      <tr>
                        <td colspan="2">
                         <input type="text" maxlength=100 name=address1 id=address1 class="text_box12 width600"/>
						</td>
                      </tr>
                      <tr>
                        <td colspan="2"><div id="payment_cc_address1_errorloc" class="error_orange"></div></td>
                      </tr>
					   <tr>
                        <td width="100%" colspan="2">ADDRESS LINE 2</td>
                      </tr>
                      <tr>
                        <td colspan="2">
                         <input type="text" maxlength=100 name=address2 id=address2 class="text_box12 width600"/>
						</td>
					  </tr>
					   <tr>
                        <td colspan="2"><div id="payment_cc_address2_errorloc" class="error_orange"></div></td>
                      </tr>
                        <tr>
                            <td width="100%" colspan="2">
                            	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="width:auto;">
                                  <tr>
                                    <td width="315">TOWN / CITY</td>
                                    <td>POSTCODE</td>
                                  </tr>
                                  <tr>
                                    <td><input type="text" maxlength=40 name=city id=city class="text_box123" style="width: 285px;"/></td>
                                    <td><input type="text" maxlength=10 name=zip id=zip class="text_box123" style="width: 285px;" /></td>
                                  </tr>
                                  <tr>
                                    <td><div id="payment_cc_city_errorloc" class="error_orange"></div></td>
                                    <td><div id="payment_cc_zip_errorloc" class="error_orange"></div></td>
                                  </tr>
                                </table>
                            </td>
                          </tr>
                          <tr>
                            <td width="100%" colspan="2">
                            	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="width:auto;">
                                  <tr>
                                    <td width="315">CARD NUMBER</td>
                                    <!-- <td>CARD TYPE</td> -->
                                    <td width="315" style="padding-left: 0px;">SECURITY CODE <a href="javascript: showDetails(10)" onmouseover="return overlib('&lt;font class=bodytext&gt;<div class=tiptool12><div class=arrowright></div><div class=tip_top12></div><div class=clear></div><div class=tip_mid12><img src=images/toobg.gif style=padding-left:16px; /></div><div class=tip_bot12></div></div>&lt;/font&gt;',BORDER,'1');" onMouseOut="nd();"><img src="images/question.png" alt="" width="12" height="12" class="tips" original-title="3 digits security code"/></a></td>
                                  </tr>
                                  <tr>
                                    <td><input type="text" maxlength="19" name="creditCardNumber" id="creditCardNumber" class="text_box12" style="width:285px" value=""/></td>
                                    <td><input type="text" maxlength="4" name="cvv2Number" id="cvv2Number" class="text_box123" value="962" style="width:285px; margin-left: 0px;"/></td>
                                    <!-- <td>
                                    <div class="styled_select" style="width:135px;">
                                    <select name="creditCardType" id="creditCardType" onChange="javascript:generateCC(); return false;" style="width:150px;">
                                        <option value="Visa" selected>Visa</option>
                                        <option value="MasterCard">MasterCard</option>
                                        <option value="Discover">Discover</option>
                                        <option value="Amex">American Express</option>
                                   </select>
                                   </div>
                                  </td> -->
                                  </tr>
                                   <tr>
                                    <td><div id="payment_cc_creditCardNumber_errorloc" class="error_orange"></div></td>
                                    <!-- <td><div id="payment_cc_creditCardType_errorloc" class="error_orange"></div></td> -->
									<td><div id="payment_cc_cvv2Number_errorloc" class="error_orange"></div></td>
                                  </tr>
                                </table>
                            </td>
                          </tr>
                        <tr>
                            <td width="100%" colspan="2">
                            	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="width:auto;">
                                  <tr>
                                    <!-- <td width="315">SECURITY CODE <a href="javascript: showDetails(10)" onclick="return overlib('&lt;font class=bodytext&gt;<div class=tiptool><div class=tip_top></div><div class=clear></div><div class=tip_mid><h2>Where can I find my card security code?</h2><ul><li><img src=images/card.gif style=padding-left:30px; /></li></ul></div><div class=tip_bot></div></div>&lt;/font&gt;',BORDER,'1');" onMouseOut="nd();"><img src="images/question.png" alt="" width="12" height="12" /></a></td> -->
                                    <td>EXPIRY DATE</td>
                                  </tr>
                                  <tr>
                                   <!--  <td><input type="text" maxlength="4" name="cvv2Number" id="cvv2Number" class="text_box123" value="962" style="width:285px;"/></td> -->
                                    <td>
                                    <div class="styled_select" style="width:140px; float:left; margin-right:10px;">
                                    	<select name="expDateMonth" id="expDateMonth" style="width:155px;">
                            			<option value="000">Month</option>
                              		<?php for ($m = 1; $m <= 12; $m++) { ?>
                              			<option value="<?php echo $m; ?>"><?php echo $m; ?></option>
                              		<?php } ?>
                                </select>
                                </div>
                                <div class="styled_select" style="width:140px; float:left;">
	                            <select name="expDateYear" id="expDateYear" style="width:155px;">
	                                	<option value="000">Year</option>
                              		<?php for ($y = date("Y"); $y <= date("Y")+10; $y++) { ?>
                              			<option value="<?php echo $y; ?>"><?php echo $y; ?></option>
                              		<?php } ?>
	                            </select>
                                </div>
                                  </td>
                                  </tr>
                                   <tr>
                                    <!-- <td><div id="payment_cc_cvv2Number_errorloc" class="error_orange"></div></td> -->
                                    <td><div id="payment_cc_expDateMonth_errorloc" class="error_orange"></div><div id="payment_cc_expDateYear_errorloc" class="error_orange"></div></td>
                                    <td></td>
                                  </tr>
                                </table>
                            </td>
                          </tr>


                            </table>

                            </td>
                          </tr>
                        </table></td>
                      </tr>



	<!-- maestro form -->
					  <!--<tr>
                        <td style="padding-left:15px;"><input type="radio" name="payment_system" id="maestro" value="maestro" />
                          Maestro <img src="images/payment_icon01.png" alt="" width="22" height="14" /></td>
                      </tr>-->
                      <tr>

                      	<td colspan="2"><table id="maestro" style="margin: 0 0 0 20px;" width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                             	<tr>
                                    <td width="315">CARDHOLDERS FIRST NAME</td>
                                    <td style="padding: 0 0 0 9px;">CARDHOLDERS LAST NAME</td>
                                  </tr>
                                  <tr>
                                    <td><input type="text" size=30 maxlength=32 name=firstName id=firstName class="text_box123" style="width:282px;"/></td>
                                    <td><input type="text" size=30 maxlength=32 name=lastName id=lastName class="text_box123" style="width:289px; margin: 0 0 0 7px;"/></td>
                                  </tr>
                                  <tr>
                                  	<td><div id="payment_maestro_firstName_errorloc" class="error_orange"></div></td>
                                  	<td><div id="payment_maestro_lastName_errorloc" class="error_orange"></div></td>
                                  </tr>
		                      <tr>
		                        <td width="100%" colspan="2">ADDRESS LINE 1</td>
		                      </tr>
		                      <tr>
		                        <td colspan="2">
		                         <input type="text" maxlength=100 name=address1 id=address1 class="text_box12 width600"/>
								</td>
		                      </tr>
		                      <tr>
		                        <td colspan="2"><div id="payment_maestro_address1_errorloc" class="error_orange"></div></td>
		                      </tr>
							   <tr>
		                        <td width="100%" colspan="2">ADDRESS LINE 2</td>
		                      </tr>
		                      <tr>
		                        <td colspan="2">
		                         <input type="text" maxlength=100 name=address2 id=address2 class="text_box12 width600"/>
								</td>
							  </tr>
							  <tr>
		                        <td colspan="2"><div id="payment_maestro_address2_errorloc" class="error_orange"></div></td>
		                      </tr>
							     <tr>
		                            <td width="40%">TOWN / CITY</td>
		                            <td width="50%" style="padding-left: 8px;">POSTCODE</td>
		                      </tr>
		                          <tr>
                                    <td><input type="text" maxlength=40 name=city id=city class="text_box123" style="width: 289px;"/></td>
                                    <td><input type="text" maxlength=10 name=zip id=zip class="text_box123" style="width: 289px; margin: 0 0 0 8px;" /></td>
                                  </tr>
                                  <tr>
                                    <td><div id="payment_maestro_city_errorloc" class="error_orange"></div></td>
                                    <td><div id="payment_maestro_zip_errorloc" class="error_orange"></div></td>
                                  </tr>
								   <tr>
		                        <td>CARD NUMBER</td>
		                        <td style="padding-left: 8px;">SECURITY CODE <a href="javascript: showDetails(10)" onmouseover="return overlib('&lt;font class=bodytext&gt;<div class=tiptool><div class=arrowright></div><div class=tip_top></div><div class=clear></div><div class=tip_mid><img src=images/toobg.gif style=padding-left:20px; /></div><div class=tip_bot></div></div>&lt;/font&gt;',BORDER,'1');" onMouseOut="nd();"><img src="images/question.png" alt="" width="12" height="12" class="tips" original-title="3 digits security code"/></a></td>
		                      </tr>
		                      <tr>
                                    <td><input type="text" maxlength="19" name="creditCardNumber" id="creditCardNumber" class="text_box123" style="width:289px" value=""/></td>
                                    <td><input type="text" maxlength="4" name="cvv2Number" id="cvv2Number" class="text_box123" value="962" style="width:289px; margin-left: 10px;"/></td>
                                    <!-- <td>
                                    <div class="styled_select" style="width:135px;">
                                    <select name="creditCardType" id="creditCardType" onChange="javascript:generateCC(); return false;" style="width:150px;">
                                        <option value="Visa" selected>Visa</option>
                                        <option value="MasterCard">MasterCard</option>
                                        <option value="Discover">Discover</option>
                                        <option value="Amex">American Express</option>
                                   </select>
                                   </div>
                                  </td> -->
                                  </tr>
                                   <tr>
                                    <td><div id="payment_maestro_creditCardNumber_errorloc" class="error_orange"></div></td>
                                    <!-- <td><div id="payment_cc_creditCardType_errorloc" class="error_orange"></div></td> -->
                                    <td><div id="payment_maestro_cvv2Number_errorloc" class="error_orange"></div></td>
                                  </tr>
		                       <tr>
		                            <td width="40%">VALID FROM</td>
		                            <td width="50%" style="padding: 0 0 0 6px;">VALID UNTIL</td>
		                      	</tr>
		                          <tr>
		                            <td>
		                            	<div class="styled_select" style="width:140px; float:left; margin-right:0;">
		                            	<select name="valDateMonth" id="valDateMonth" style="width:155px;">
		                              		<?php for ($m = 1; $m <= 12; $m++) { ?>
		                              			<option value="<?php echo $m; ?>"><?php echo $m; ?></option>
		                              		<?php } ?>
		                                 </select>
		                                 </div>
		                                 <div class="styled_select" style="width:140px; float:right;  margin-right:6px;">
		                              	<select name="valDateYear" id="valDateYear" style="width:155px;">
		                                	<?php for ($y = date("Y"); $y <= date("Y")+10; $y++) { ?>
		                              			<option value="<?php echo $y; ?>"><?php echo $y; ?></option>
		                              		<?php } ?>
		                              	</select>
		                              	</div>
		                              	<div style="clear: both;"></div>
		                              	<div class="error_orange" id="payment_maestro_valDateMonth_errorloc"></div>
										<div class="error_orange" id="payment_maestro_valDateYear_errorloc"></div>
		                            </td>

		                           <td>
		                            	<div class="styled_select" style="width:140px; float:left; margin: 0 10px 0 10px;">
		                            	<select name="expDateMonth" id="expDateMonth" style="width:155px;">
		                              		<?php for ($m = 1; $m <= 12; $m++) { ?>
		                              			<option value="<?php echo $m; ?>"><?php echo $m; ?></option>
		                              		<?php } ?>
		                                 </select>
		                                 </div>
		                                 <div class="styled_select" style="width:140px; float:left;  margin-right:10px;">
		                              	<select name="expDateYear" id="expDateYear" style="width:155px;">
		                                	<?php for ($y = date("Y"); $y <= date("Y")+10; $y++) { ?>
		                              			<option value="<?php echo $y; ?>"><?php echo $y; ?></option>
		                              		<?php } ?>
		                              	</select>
		                              	</div>
		                              	<div style="clear: both;"></div>
		                              	<div class="error_orange" id="payment_maestro_expDateMonth_errorloc"></div>
										<div class="error_orange" id="payment_maestro_expDateYear_errorloc"></div>
		                            </td>
		                          </tr>
									</tr>
		                       <tr>
		                            <td width="50%" colspan="2">ISSUE NUMBER</td>
		                      </tr>
	                          <tr>
	                            <td colspan="2"><input type="text" name="issueno" id="issueno" class="text_box12" /></td>
	                          </tr>
	                          <tr>
	                            <td colspan="2"><div class="error_orange" id="payment_maestro_issueno_errorloc"></div></td>
	                          </tr>
		                            </table></td>
		                          </tr>
		                        </table></td>

                      </tr>
 	<!-- paypal  -->
                      <!--<tr>
                        <td colspan="2" style="padding-left:15px;"><input type="radio" name="payment_system" id="paypal" value="paypal" />
                        Paypal <img src="images/paypal.png" alt="" width="43" height="15" /><br />
                        </td>
                      </tr>-->
                      <!-- <tr id="paypal">
                      	<td style="font-size:11px;">paypal</td>
                      </tr> -->

                      <tr>
                        <td class="linkundrline" colspan="2" style="font-size:12px; padding-left:20px; font-weight: normal;">
                        	By purchasing, you agree to the deal <a id="various3" href="#fine_print" style="color:3f48cc;">Fine Print </a>and the Jumblr <a href="<?php echo SITE_URL; ?>page.php?page=Terms and Conditions" style="color:3f48cc;">Terms &amp; Conditions.</a>
                        </td>
                      </tr>
                       <tr>
                        <td colspan="2">
					<div style="display: none; ">
						<div id="fine_print" style=" background: #fff; border: 5px solid silver; height: 300pz; width: 410px; padding: 15px 15px;">
							<h2 style="border-bottom:1px dashed #CCCCCC; padding-bottom:8px; margin-bottom:4px;">Deal Fine Print</h2>
							<style>
								.fine_style{
									list-style-type: disc;
									width: 92%;
									margin: 0 auto;
								}
							</style>
							<?php echo $prod_res['fineprint']; ?>
							<!-- <ul class="fine_style">
								<li>One per person.</li>
								<li>May buy multiples as gifts.</li>
								<li>Voucher valid for 1 month.</li>
								<li>POstage costs an aditional <?php echo getSettings(currency_symbol); ?>4.95</li>
								<li>Please allow up to 10 working days for delivery after redeeming.</li>
							</ul> -->
							<br/>
						</div>


					</div>
                        <div id="gateway_error_msg" class="error"></div>

            				<!-- paypal IPN values  -->

            				 <?php
	            		 		//$amount = $_SESSION['total_price'];
								$user_id = $_SESSION["user_id"];
								$deal_id = $prod_res['deal_id'];
								//$qty = $_SESSION['qty'];
								$trn_date = date("Y-m-d H:i:s");
            				 ?>

            				<input type="hidden" id="frm_paypal_total_qty" name="item_number" value="1">
							<input type="hidden" id="frm_paypal_total_price" name="amount" value="<?php echo ($prod_res['is_multi'] == 'n' ? number_format($prod_res['discounted_price'], 2) : number_format($is_multi['multi_deal_item_price'], 2)); //$prod_res['discounted_price']; ?>">
							<input type="hidden" name="custom" value="<?php echo $user_id.",".$deal_id.",".$trn_date; ?>">
							<input type="hidden" name="item_name" value="<?php echo $prod_res['title']; ?>">

                        <input type="submit" name="Submit" value="Buy Now" class="buyu_btn07" style="margin-left:16px;"/>   </td>
                      </tr>
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                    </table>

 					</td>
                    <td width="260"><table style="padding-top: 40px;" width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr height="40px">
                              <td style="color:#696969; font: normal 18px/44px Calibri, Arial, Helvetica, sans-serif;"><img src="images/green_thick.gif" alt="" width="20" height="17" style="padding-top: 5px;" />Your privacy is assured</td>
                            </tr>
                             <tr height="40px">
                              <td style="color:#696969; font: normal 18px/44px Calibri, Arial, Helvetica, sans-serif;"><img src="images/green_thick.gif" alt="" width="20" height="17" style="padding-top: 5px;"/>Get amazing deals daily</td>
                            </tr>
                            <tr height="40px">
                              <td style="color:#696969; font: normal 18px/44px Calibri, Arial, Helvetica, sans-serif;"><img src="images/green_thick.gif" alt="" width="20" height="17" style="padding-top: 5px;"/>Shop online with confidence</td>
                             </tr>
                             <tr height="40px">
                              <td style="color:#696969; font: normal 18px/44px Calibri, Arial, Helvetica, sans-serif;"><img src="images/green_thick.gif" alt="" width="20" height="17" style="padding-top: 5px;"/>Explorer the new side of life</td>
                            </tr>
                        </table></td>
                    </tr>
                  </table>
<!-- Not Login payment form validator starts -->

<script type="text/javascript">

function ValidateCcForm() {
//alert('Hi'); return false;
	var ccrad = document.getElementById('ccrad').checked;
	var mrad = document.getElementById('maestro').checked;
	var prad = document.getElementById('paypal').checked;

	//alert(ccrad);alert(mrad);alert(prad); return false;
	if (ccrad == true) {
		var firstName = document.getElementById('firstName').value;
		var lastName = document.getElementById('lastName').value;
		var address1 = document.getElementById('address1').value;
		var address2 = document.getElementById('address2').value;
		var city = document.getElementById('city').value;
		var zip = document.getElementById('zip').value;
		var creditCardNumber = document.getElementById('creditCardNumber').value;

		//var creditCardType = document.getElementById('creditCardType').value;
		var cvv2Number = document.getElementById('cvv2Number').value;
		var expDateMonth = document.getElementById('expDateMonth').value;
		var expDateYear = document.getElementById('expDateYear').value;



		if ( firstName == "" || lastName == "" || address1 == "" || address2 == "" || city == "" || zip == "" || creditCardNumber == "" || cvv2Number == "" || expDateMonth == "000" || expDateYear == "000") {
			//alert ("asdasda");
			document.getElementById('payment_cc_firstName_errorloc').innerHTML = "Enter your first name";

			document.getElementById('payment_cc_lastName_errorloc').innerHTML = "Enter your last name";

			document.getElementById('payment_cc_address1_errorloc').innerHTML = "Enter your full address";

			//document.getElementById('payment_cc_address2_errorloc').innerHTML = "";

			document.getElementById('payment_cc_city_errorloc').innerHTML = "Enter your city";

			document.getElementById('payment_cc_zip_errorloc').innerHTML = "Enter your postcode";

			document.getElementById('payment_cc_creditCardNumber_errorloc').innerHTML = "Enter your Credit/Debit card number";

			document.getElementById('payment_cc_cvv2Number_errorloc').innerHTML = "Enter your CVV/Security number";

			document.getElementById('payment_cc_expDateMonth_errorloc').innerHTML = "Enter your card expiry date";

			//document.getElementById('payment_cc_expDateYear_errorloc').innerHTML = "Enter your card expiry year";
			return false;
		}
	}	// ccrad validation

	if (mrad == true) {
		var firstName = document.getElementById('firstName').value;
		var lastName = document.getElementById('lastName').value;
		var address1 = document.getElementById('address1').value;
		var address2 = document.getElementById('address2').value;
		var city = document.getElementById('city').value;
		var zip = document.getElementById('zip').value;
		var creditCardNumber = document.getElementById('creditCardNumber').value;

		//var creditCardType = document.getElementById('creditCardType').value;
		var cvv2Number = document.getElementById('cvv2Number').value;

		var valDateMonth = document.getElementById('valDateMonth').value;issueno
		var valDateYear = document.getElementById('valDateYear').value;

		var expDateMonth = document.getElementById('expDateMonth').value;
		var expDateYear = document.getElementById('expDateYear').value;

		var issueno = document.getElementById('issueno').value;


		if ( firstName == "" || lastName == "" || address1 == "" || address2 == "" || city == "" || zip == "" || creditCardNumber == "" || cvv2Number == "" || valDateMonth == "000" || valDateYear == "000" || expDateMonth == "000" || expDateYear == "000" || issueno == "") {
			//alert ("asdasda");
			document.getElementById('payment_maestro_firstName_errorloc').innerHTML = "Enter your first name";

			document.getElementById('payment_maestro_lastName_errorloc').innerHTML = "Enter your last name";

			document.getElementById('payment_maestro_address1_errorloc').innerHTML = "Enter your full address";

			//document.getElementById('payment_maestro_address2_errorloc').innerHTML = "";

			document.getElementById('payment_maestro_city_errorloc').innerHTML = "Enter your city";

			document.getElementById('payment_maestro_zip_errorloc').innerHTML = "Enter your postcode";

			document.getElementById('payment_maestro_creditCardNumber_errorloc').innerHTML = "Enter your Credit/Debit card number";

			document.getElementById('payment_maestro_cvv2Number_errorloc').innerHTML = "Enter your maestro number";

			document.getElementById('payment_maestro_valDateMonth_errorloc').innerHTML = "Enter your card valid from date";

			//document.getElementById('payment_maestro_valDateYear_errorloc').innerHTML = "Enter your card valid year";

			document.getElementById('payment_maestro_expDateMonth_errorloc').innerHTML = "Enter your card valid until date";

			//document.getElementById('payment_maestro_expDateYear_errorloc').innerHTML = "Enter your card expiry year";

			document.getElementById('payment_maestro_issueno_errorloc').innerHTML = "Enter your card Issue number";
			return false;
		}
	}	// maestro validation


}


</script>
<!-- Not Login payment form validator ends -->

<script type="text/javascript">

/*$("input[name='payment_system']:checked").change(function () {
	$("tr#cc").slideDown(500);
});
*/


$('table#cc').show();
$('table#maestro').hide(0);
$('tr#paypal').hide(0);

$('input[name="payment_system"]').change(function() {
                var selected_type = $(this).val();
                switch(selected_type) {
                        case "cc":
                                $('table#cc').slideDown(500);
                                //if others are visible just slideup
                                $('table#maestro').slideUp(500);
                                $('tr#paypal').slideUp(500);
                        break;

                        case "maestro":
                                $('table#maestro').slideDown(500);
                                //if others are visible just slideup
                                $('table#cc').slideUp(500);
                                $('tr#paypal').slideUp(500);
                        break;

                        case "paypal":
                                $('tr#paypal').slideDown(500);
                                //if others are visible just slideup
                                $('table#cc').slideUp(500);
                                $('table#maestro').slideUp(500);
                        break;
                }
        }
);
</script>

                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                    </table>
 </form>
 <!-- Not login Payment table ends -->
<?php } else { ?>

		<div class="how_right_ani2 debug" style="margin-top: 80px;">
		   <div style="font: normal 18px/25px Arial, Helvetica, sans-serif; color:#4d4550; text-align:center;">Got questions?</div>

			 <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td style="width: 24px; height:25px; padding-right: 10px"><a href="javascript: showDetails(10)" onmouseover="return overlib('&lt;font class=bodytext&gt;<div class=tiptool><div class=tip_top><p>What happens after I buy the deal?</p></div><div class=clear></div><div class=tip_mid><ul><li>You can find the link to your voucher in your Jumblr account and also in your personal email. Most of our voucher can be redeemed online but if your voucher cannot be redeemed online then print your voucher and present it to the merchant.</li></ul></div><div class=tip_bot></div></div>&lt;/font&gt;',BORDER,'1');" onMouseOut="nd();"><img src="images/1.png" alt="" width="24" height="25"/></a></td>
                    <td style="font: normal 12px/40px Arial, Helvetica, sans-serif; text-align:left; color: #777777; border-bottom: solid 1px #cccccc;"><a style="color:#3bb8ff; font: normal 12px/40px Arial, Helvetica, sans-serif; text-decoration: none;" href="javascript: showDetails(10)" onmouseover="return overlib('&lt;font class=bodytext&gt;<div class=tiptool><div class=tip_top><p>What happens after I buy the deal?</p></div><div class=clear></div><div class=tip_mid><ul><li>You can find the link to your voucher in your Jumblr account and also in your personal email. Most of our voucher can be redeemed online but if your voucher cannot be redeemed online then print your voucher and present it to the merchant.</li></ul></div><div class=tip_bot></div></div>&lt;/font&gt;',BORDER,'1');" onMouseOut="nd();">What happens after I buy the deal?</a></td>
                  </tr>
                  <tr>
                    <td style="width: 24px; height:25px; padding-right: 10px"><a href="javascript: showDetails(10)" onmouseover="return overlib('&lt;font class=bodytext&gt;<div class=tiptool><div class=tip_top><p>When can I use my deal?</p></div><div class=clear></div><div class=tip_mid><ul><li>Be patient. We will email you when your deal is ready to use.</li></ul></div><div class=tip_bot></div></div>&lt;/font&gt;',BORDER,'1');" onMouseOut="nd();"><img src="images/2.png" alt="" width="24" height="25"/></a></td>
                    <td style="font: normal 12px/40px Arial, Helvetica, sans-serif; text-align:left; color: #777777; border-bottom: solid 1px #cccccc;"><a style="color:#3bb8ff; font: normal 12px/40px Arial, Helvetica, sans-serif; text-decoration: none;" href="javascript: showDetails(10)" onmouseover="return overlib('&lt;font class=bodytext&gt;<div class=tiptool><div class=tip_top><p>When can I use my deal?</p></div><div class=clear></div><div class=tip_mid><ul><li>Be patient. We will email you when your deal is ready to use.</li></ul></div><div class=tip_bot></div></div>&lt;/font&gt;',BORDER,'1');" onMouseOut="nd();">When can I use my deal?</a></td>
                  </tr>
				  <tr>
                    <td style="width: 24px; height:25px; padding-right: 10px"><a href="javascript: showDetails(10)" onmouseover="return overlib('&lt;font class=bodytext&gt;<div class=tiptool><div class=tip_top><p>When will my voucher expire?</p></div><div class=clear></div><div class=tip_mid><ul><li>The voucher expires on the date printed on the voucher. Your voucher has everything that you would need to redeem it.</li></ul></div><div class=tip_bot></div></div>&lt;/font&gt;',BORDER,'1');" onMouseOut="nd();"><img src="images/3.png" alt="" width="24" height="25"/></a></td>
                    <td style="font: normal 12px/40px Arial, Helvetica, sans-serif; text-align:left; color: #777777; border-bottom: solid 1px #cccccc;"><a style="color:#3bb8ff; font: normal 12px/40px Arial, Helvetica, sans-serif; text-decoration: none;" href="javascript: showDetails(10)" onmouseover="return overlib('&lt;font class=bodytext&gt;<div class=tiptool><div class=tip_top><p>When will my voucher expire?</p></div><div class=clear></div><div class=tip_mid><ul><li>The voucher expires on the date printed on the voucher. Your voucher has everything that you would need to redeem it.</li></ul></div><div class=tip_bot></div></div>&lt;/font&gt;',BORDER,'1');" onMouseOut="nd();">When will my voucher expire?</a></td>
                  </tr>
				  <tr>
                    <td style="width: 24px; height:25px; padding-right: 10px"><a href="javascript: showDetails(10)" onmouseover="return overlib('&lt;font class=bodytext&gt;<div class=tiptool><div class=tip_top><p>Can I buy a deal as gift?</p></div><div class=clear></div><div class=tip_mid><ul><li>Off course! You can give our vouchers as a gift. Our vouchers are completely transferrable and don&prime;t worry about the name of the buyer on it.</li></ul></div><div class=tip_bot></div></div>&lt;/font&gt;',BORDER,'1');" onMouseOut="nd();"><img src="images/4.png" alt="" width="24" height="25"/></a></td>
                    <td style="font: normal 12px/40px Arial, Helvetica, sans-serif; text-align:left; color: #777777; border-bottom: solid 1px #cccccc;"><a style="color:#3bb8ff; font: normal 12px/40px Arial, Helvetica, sans-serif; text-decoration: none;" href="javascript: showDetails(10)" onmouseover="return overlib('&lt;font class=bodytext&gt;<div class=tiptool><div class=tip_top><p>Can I buy a deal as gift?</p></div><div class=clear></div><div class=tip_mid><ul><li>Off course! You can give our vouchers as a gift. Our vouchers are completely transferrable and don&prime;t worry about the name of the buyer on it.</li></ul></div><div class=tip_bot></div></div>&lt;/font&gt;',BORDER,'1');" onMouseOut="nd();">Can I buy a deal as gift?</a></td>
                  </tr>
				  <tr>
                    <td style="width: 24px; height:25px; padding-right: 10px"><a href="javascript: showDetails(10)" onmouseover="return overlib('&lt;font class=bodytext&gt;<div class=tiptool><div class=tip_top><p>Can I get refund for my order?</p></div><div class=clear></div><div class=tip_mid><ul><li>Yes! Jumblr will provide a refund if you change your mind within five days after you&prime;ve purchased your voucher and want to &ldquo;return&rdquo; the unused voucher.</li></ul></div><div class=tip_bot></div></div>&lt;/font&gt;',BORDER,'1');" onMouseOut="nd();"><img src="images/5.png" alt="" width="24" height="25"/></a></td>
                    <td style="font: normal 12px/40px Arial, Helvetica, sans-serif; text-align:left; color: #777777; border-bottom: solid 1px #cccccc;"><a style="color:#3bb8ff; font: normal 12px/40px Arial, Helvetica, sans-serif; text-decoration: none;" href="javascript: showDetails(10)" onmouseover="return overlib('&lt;font class=bodytext&gt;<div class=tiptool><div class=tip_top><p>Can I get refund for my order?</p></div><div class=clear></div><div class=tip_mid><ul><li>Yes! Jumblr will provide a refund if you change your mind within five days after you&prime;ve purchased your voucher and want to &ldquo;return&rdquo; the unused voucher.</li></ul></div><div class=tip_bot></div></div>&lt;/font&gt;',BORDER,'1');" onMouseOut="nd();">Can I get refund for my order?</a></td>
                  </tr>
                </table>

			 <!--
			 <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td style="width: 24px; height:25px; padding-right: 10px;"><a href="javascript: showDetails(10)" onclick="return overlib('&lt;font class=bodytext&gt;<div class=white-container style=width:220px; text-align:left; margin:80px auto;><ul><li><strong>What happens after I buy the deal?</strong> <br /> <br />You can find the link to your voucher in your Jumblr account and also in your personal email. Most of our voucher can be redeemed online but if your voucher cannot be redeemed online then print your voucher and present it to the merchant.</li></ul><div class=white-tl></div><div class=white-bl></div><div class=white-tr></div><div class=white-br></div></div>&lt;/font&gt;',BORDER,'1');" onMouseOut="nd();"><img src="images/1.png" alt="" width="24" height="25" style=" padding-top: 7px;"/></a></td>
                    <td style="font: normal 12px/40px Arial, Helvetica, sans-serif; text-align:left; color: #777777; border-bottom: solid 1px #cccccc;"><a style="color:#3bb8ff; font: normal 12px/40px Arial, Helvetica, sans-serif; text-decoration: none;" href="javascript: showDetails(10)" onclick="return overlib('&lt;font class=bodytext&gt;<div class=white-container2 style=width:220px; text-align:left; margin:80px auto;><ul><li><strong>What happens after I buy the deal?</strong> <br /> <br />You can find the link to your voucher in your Jumblr account and also in your personal email. Most of our voucher can be redeemed online but if your voucher cannot be redeemed online then print your voucher and present it to the merchant.</li></ul><div class=white-tl2></div><div class=white-bl2></div><div class=white-tr2></div><div class=white-br2></div></div>&lt;/font&gt;',BORDER,'1');" onMouseOut="nd();">What happens after I buy the deal?</a></td>
                  </tr>
                  <tr>
                    <td style="width: 24px; height:25px; padding-right: 10px"><a href="javascript: showDetails(10)" onclick="return overlib('&lt;font class=bodytext&gt;<div class=white-container style=width:220px; text-align:left; margin:80px auto;><ul><li><strong>When can I use my deal?</strong> <br /> <br />Be patient. We will email you when your deal is ready to use.</li></ul><div class=white-tl></div><div class=white-bl></div><div class=white-tr></div><div class=white-br></div></div>&lt;/font&gt;',BORDER,'1');" onMouseOut="nd();"><img src="images/2.png" alt="" width="24" height="25" style=" padding-top: 7px;"/></a></td>
                    <td style="font: normal 12px/40px Arial, Helvetica, sans-serif; text-align:left; color: #777777; border-bottom: solid 1px #cccccc;"><a style="color:#3bb8ff; font: normal 12px/40px Arial, Helvetica, sans-serif; text-decoration: none;" href="javascript: showDetails(10)" onclick="return overlib('&lt;font class=bodytext&gt;<div class=white-container2 style=width:220px; text-align:left; margin:80px auto;><ul><li><strong>When can I use my deal?</strong> <br /> <br />Be patient. We will email you when your deal is ready to use.</li></ul><div class=white-tl2></div><div class=white-bl2></div><div class=white-tr2></div><div class=white-br2></div></div>&lt;/font&gt;',BORDER,'1');" onMouseOut="nd();">When can I use my deal?</a></td>
                  </tr>
				  <tr>
                    <td style="width: 24px; height:25px; padding-right: 10px"><a href="javascript: showDetails(10)" onclick="return overlib('&lt;font class=bodytext&gt;<div class=white-container style=width:220px; text-align:left; margin:80px auto;><ul><li><strong>When will my voucher expire?</strong> <br /> <br />The voucher expires on the date printed on the voucher. Your voucher has everything that you would need to redeem it.</li></ul><div class=white-tl></div><div class=white-bl></div><div class=white-tr></div><div class=white-br></div></div>&lt;/font&gt;',BORDER,'1');" onMouseOut="nd();"><img src="images/3.png" alt="" width="24" height="25" style=" padding-top: 7px;"/></a></td>
                    <td style="font: normal 12px/40px Arial, Helvetica, sans-serif; text-align:left; color: #777777; border-bottom: solid 1px #cccccc;"><a style="color:#3bb8ff; font: normal 12px/40px Arial, Helvetica, sans-serif; text-decoration: none;" href="javascript: showDetails(10)" onclick="return overlib('&lt;font class=bodytext&gt;<div class=white-container2 style=width:220px; text-align:left; margin:80px auto;><ul><li><strong>When will my voucher expire?</strong> <br /> <br />The voucher expires on the date printed on the voucher. Your voucher has everything that you would need to redeem it.</li></ul><div class=white-tl2></div><div class=white-bl2></div><div class=white-tr2></div><div class=white-br2></div></div>&lt;/font&gt;',BORDER,'1');" onMouseOut="nd();">When will my voucher expire?</a></td>
                  </tr>
				  <tr>
                    <td style="width: 24px; height:25px; padding-right: 10px"><a href="javascript: showDetails(10)" onclick="return overlib('&lt;font class=bodytext&gt;<div class=white-container style=width:220px; text-align:left; margin:80px auto;><ul><li><strong>Can I buy a deal as gift?</strong> <br /> <br />Off course! You can give our vouchers as a gift. Our vouchers are completely transferrable and don&prime;t worry about the name of the buyer on it.</li></ul><div class=white-tl></div><div class=white-bl></div><div class=white-tr></div><div class=white-br></div></div>&lt;/font&gt;',BORDER,'1');" onMouseOut="nd();"><img src="images/4.png" alt="" width="24" height="25" style=" padding-top: 7px;"/></a></td>
                    <td style="font: normal 12px/40px Arial, Helvetica, sans-serif; text-align:left; color: #777777; border-bottom: solid 1px #cccccc;"><a style="color:#3bb8ff; font: normal 12px/40px Arial, Helvetica, sans-serif; text-decoration: none;" href="javascript: showDetails(10)" onclick="return overlib('&lt;font class=bodytext&gt;<div class=white-container2 style=width:220px; text-align:left; margin:80px auto;><ul><li><strong>Can I buy a deal as gift?</strong> <br /> <br />Off course! You can give our vouchers as a gift. Our vouchers are completely transferrable and don&prime;t worry about the name of the buyer on it.</li></ul><div class=white-tl2></div><div class=white-bl2></div><div class=white-tr2></div><div class=white-br2></div></div>&lt;/font&gt;',BORDER,'1');" onMouseOut="nd();">Can I buy a deal as gift?</a></td>
                  </tr>
				  <tr>
                    <td style="width: 24px; height:25px; padding-right: 10px"><a href="javascript: showDetails(10)" onclick="return overlib('&lt;font class=bodytext&gt;<div class=white-container style=width:220px; text-align:left; margin:80px auto;><ul><li><strong>Can I get refund for my order?</strong> <br /> <br />Yes! Jumblr will provide a refund if you change your mind within five days after you&prime;ve purchased your voucher and want to &ldquo;return&rdquo; the unused voucher.</li></ul><div class=white-tl></div><div class=white-bl></div><div class=white-tr></div><div class=white-br></div></div>&lt;/font&gt;',BORDER,'1');" onMouseOut="nd();"><img src="images/5.png" alt="" width="24" height="25" style=" padding-top: 7px;"/></a></td>
                    <td style="font: normal 12px/40px Arial, Helvetica, sans-serif; text-align:left; color: #777777; border-bottom: solid 1px #cccccc;"><a style="color:#3bb8ff; font: normal 12px/40px Arial, Helvetica, sans-serif; text-decoration: none;" href="javascript: showDetails(10)" onclick="return overlib('&lt;font class=bodytext&gt;<div class=white-container2 style=width:220px; text-align:left; margin:80px auto;><ul><li><strong>Can I get refund for my order?</strong> <br /> <br />Yes! Jumblr will provide a refund if you change your mind within five days after you&prime;ve purchased your voucher and want to &ldquo;return&rdquo; the unused voucher.</li></ul><div class=white-tl2></div><div class=white-bl2></div><div class=white-tr2></div><div class=white-br2></div></div>&lt;/font&gt;',BORDER,'1');" onMouseOut="nd();">Can I get refund for my order?</a></td>
                  </tr>
                </table>

			  -->



                		<table style="padding-top: 40px;" width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr height="40px">
                              <td style="color:#696969; font: normal 18px/44px Calibri, Arial, Helvetica, sans-serif;"><img src="images/green_thick.gif" alt="" width="20" height="17" style="padding-top: 5px;" />Your privacy is assured</td>
                            </tr>
                             <tr height="40px">
                              <td style="color:#696969; font: normal 18px/44px Calibri, Arial, Helvetica, sans-serif;"><img src="images/green_thick.gif" alt="" width="20" height="17" style="padding-top: 5px;"/>Get amazing deals daily</td>
                            </tr>
                            <tr height="40px">
                              <td style="color:#696969; font: normal 18px/44px Calibri, Arial, Helvetica, sans-serif;"><img src="images/green_thick.gif" alt="" width="20" height="17" style="padding-top: 5px;"/>Shop online with confidence</td>
                             </tr>
                             <tr height="40px">
                              <td style="color:#696969; font: normal 18px/44px Calibri, Arial, Helvetica, sans-serif;"><img src="images/green_thick.gif" alt="" width="20" height="17" style="padding-top: 5px;"/>Explorer the new side of life</td>
                            </tr>
                        </table>
            </div>

<?php } ?>
                    </td>
                    </tr>
                  </table>

        </td>
      </tr>
    </table>
                     </td>
                        </tr>
                        <tr>
                          <td>

                         <!-- <table style="padding-top: 15px;" width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="20" style="width:17px;"><img src="images/green_thick.gif" alt="" width="20" height="17" /></td>
                              <td width="175" style="color:#000; font: bold 14px/28px Calibri, Arial, Helvetica, sans-serif;">Shop with confidence online</td>
                              <td width="20">&nbsp;</td>
                              <td width="50" style="width:17px;"><img src="images/green_thick.gif" alt="" width="20" height="17" /></td>
                              <td width="196" style="color:#000; font: bold 14px/28px Calibri, Arial, Helvetica, sans-serif;">Your Privacy is assured</td>
                            </tr>
                            <tr>
                              <td colspan="5" style="width:17px;">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="20" style="width:17px;"><img src="images/green_thick.gif" alt="" width="20" height="17" /></td>
                              <td width="175" style="color:#000; font: bold 14px/28px Calibri, Arial, Helvetica, sans-serif;">Get amazing deals today</td>
                              <td width="20">&nbsp;</td>
                              <td width="50" style="width:17px;"><img src="images/green_thick.gif" alt="" width="20" height="17" /></td>
                              <td width="196" style="color:#000; font: bold 14px/28px Calibri, Arial, Helvetica, sans-serif;">Explorer the new side of life</td>
                            </tr>

                          </table>-->

                          </td>
<?php } else { ?>


<form class="skinned-form-controls skinned-form-controls-mac" action="thankyou.php" name="frmccloginpayment" method="post" onsubmit="javascript: return ValidateCcForm();">
	<input type="hidden" maxlength="7" name="payment_amount" id="payment_amount" value="<?php echo($prod_res['is_multi'] == 'n' ? number_format($prod_res['discounted_price'], 2) : number_format($is_multi['multi_deal_item_price'], 2)); // $prod_res['discounted_price']; ?>">
	<input type="hidden" name="paymentType" value="Sale" />
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  	<td><table  style="padding-top:15px;" width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
					    <!--<td width="6%" align="left" valign="top" style="padding-left:12px;"><input type="radio" id="ccrad" name="payment_system"  value="cc" checked="checked" style="z-index: 1000;"/></td>-->
					    <td width="18%" align="left" valign="top" style="font: bold 13px/33px Arial, Helvetica, sans-serif;
	color: #3a3b3d; padding-left: 15px;">
	<input style="margin-top: 7px;" type="radio" id="ccrad" name="payment_system"  value="cc" checked="checked" style="z-index: 1000;"/><span style="text-transform: uppercase; font-size:12px; padding-left:5px;">&nbsp;&nbsp;Credit/Debit Card</span></td>
					    <td width="25%" align="left" valign="top"><img src="images/c_cards.gif" alt="" width="214" height="33" align="absmiddle"/></td>
						<td style="padding-left: 15px; font: bold 13px/33px Arial, Helvetica, sans-serif;
	color: #3a3b3d;" valign="top">
	<input style="margin-top: 7px;" type="radio" name="payment_system" id="maestro" value="maestro" />
                          <span style="text-transform: uppercase; font-size:12px; padding-left:5px;">&nbsp;&nbsp;Maestro</span> <img src="images/payment_icon01.gif" alt="" width="51" height="33" align="absmiddle" /></td>
						<td style="padding-left: 15px; font: bold 13px/33px Arial, Helvetica, sans-serif;
	color: #3a3b3d;" valign="top">
	<input style="margin-top: 7px;" type="radio" name="payment_system" id="paypal" value="paypal" />
                        <span style="text-transform: uppercase; font-size:12px; padding-left:5px;">&nbsp;&nbsp;Paypal</span> <img src="images/paypal.gif" alt="" width="51" height="33" align="absmiddle" /><br />
                        </td>
					  </tr>
					</table></td>
	  </tr>
	</table>
         <table width="100%" border="0" cellspacing="0" cellpadding="0" class="leftfrom" style="width:100%;">
		 <!--<tr>
	  	<td><table  style="padding-top:15px;" width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
					    <td width="6%" align="left" valign="top" style="padding-left:12px;"><input id="ccrad" name="payment_system" type="radio" value="cc" checked="checked"/></td>
					    <td width="18%" align="left" valign="top" style="font: bold 13px/20px Arial, Helvetica, sans-serif;
	color: #3a3b3d;"><span style="text-transform: uppercase; font-size:12px;">Credit/Debit Card</span></td>
					    <td width="30%" align="left" valign="top"><img src="images/c_cards.png" alt="" width="112" height="19"/></td>
						<td style="padding-left: 15px; font: bold 13px/20px Arial, Helvetica, sans-serif;
	color: #3a3b3d;" valign="top"><input type="radio" name="payment_system" id="maestro" value="maestro" />
                          <span style="text-transform: uppercase; font-size:12px;">Maestro</span> <img src="images/payment_icon01.png" alt="" width="22" height="14" /></td>
						<td style="padding-left: 15px; font: bold 13px/20px Arial, Helvetica, sans-serif;
	color: #3a3b3d;" valign="top"><input type="radio" name="payment_system" id="paypal" value="paypal" />
                        <span style="text-transform: uppercase; font-size:12px;">Paypal</span> <img src="images/paypal.png" alt="" width="43" height="15" /><br />
                        </td>
					  </tr>
					</table></td>
	  </tr>-->
                <tr>
                  <td width="660">

                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                     <!--<tr>
                        <td colspan="2" style="padding-left:14px;"><img src="images/payment_details.png" alt="" width="164" height="21"/></td>
                     </tr>
                      <tr>
                        <td style="font: normal 11px/14px Arial, Helvetica, sans-serif; color:#666666; padding-left:14px;" width="100%" colspan="2">Please provide your credit card information below</td>
                      </tr>-->
					   <!--<tr>
                        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
					    <td width="6%" align="left" valign="top" style="padding-left:14px;"><input id="ccrad" name="payment_system" type="radio" value="cc" checked="checked"/></td>
					    <td width="26%" align="left" valign="top">Credit/Debit Card</td>
					    <td width="68%" align="left" valign="top"><img src="images/c_cards.png" alt="" width="112" height="19"/></td>
					  </tr>
					</table></td>
                    </tr>-->
				 <tr>
    <!-- cc form -->

                        <td colspan="2"><table  id="cc" style="margin: 0 0 0 20px;" width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="width:auto;">
                           <tr>
                            <td width="100%" colspan="2">
                            	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="width:auto;">
                                  <tr>
                                    <td width="315">CARDHOLDERS FIRST NAME</td>
                                    <td>CARDHOLDERS LAST NAME</td>
                                  </tr>
                                  <tr>
                                    <td><input type="text" size=30 maxlength=32 name=firstName id=firstName class="text_box123" style="width:285px;"/></td>
                                    <td><input type="text" size=30 maxlength=32 name=lastName id=lastName class="text_box123" style="width:285px;"/></td>
                                  </tr>
                                  <tr>
                                  	<td><div id="payment_cc_firstName_errorloc" class="error_orange"></div></td>
                                  	<td><div id="payment_cc_lastName_errorloc" class="error_orange"></div></td>
                                  </tr>
                                </table>
                            </td>
                          </tr>
                          <tr>
                            <td width="100%" colspan="2">ADDRESS LINE 1</td>
                          </tr>
                      <tr>
                        <td colspan="2">
                         <input type="text" maxlength=100 name=address1 id=address1 class="text_box123 width600"/>
						</td>
                      </tr>
                      <tr>
                        <td colspan="2"><div id="payment_cc_address1_errorloc" class="error_orange"></div></td>
                      </tr>
					   <tr>
                        <td width="100%" colspan="2">ADDRESS LINE 2</td>
                      </tr>
                      <tr>
                        <td colspan="2">
                         <input type="text" maxlength=100 name=address2 id=address2 class="text_box123 width600"/>
						</td>
					  </tr>
					   <tr>
                        <td colspan="2"><div id="payment_cc_address2_errorloc" class="error_orange"></div></td>
                      </tr>
                        <tr>
                            <td width="100%" colspan="2">
                            	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="width:auto;">
                                  <tr>
                                    <td width="315">TOWN / CITY</td>
                                    <td>POSTCODE</td>
                                  </tr>
                                  <tr>
                                    <td><input type="text" maxlength=40 name=city id=city class="text_box123" style="width: 285px;"/></td>
                                    <td><input type="text" maxlength=10 name=zip id=zip class="text_box123" style="width: 285px;" /></td>
                                  </tr>
                                  <tr>
                                    <td><div id="payment_cc_city_errorloc" class="error_orange"></div></td>
                                    <td><div id="payment_cc_zip_errorloc" class="error_orange"></div></td>
                                  </tr>
                                </table>
                            </td>
                          </tr>
                          <tr>
                            <td width="100%" colspan="2">
                            	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="width:auto;">
                                  <tr>
                                    <td width="315">CARD NUMBER</td>
                                    <!-- <td>CARD TYPE</td> -->
                                    <td width="315">SECURITY CODE <a href="javascript: showDetails(10)" onmouseover="return overlib('&lt;font class=bodytext&gt;<div class=tiptool><div class=arrowright></div><div class=tip_top></div><div class=clear></div><div class=tip_mid><img src=images/toobg.gif style=padding-left:20px; /></div><div class=tip_bot></div></div>&lt;/font&gt;',BORDER,'1');" onMouseOut="nd();"><img src="images/question.png" alt="" width="12" height="12" class="tips" original-title="3 digits security code"/></a></td>
                                  </tr>
                                  <tr>
                                    <td><input type="text" maxlength="19" name="creditCardNumber" id="creditCardNumber" class="text_box123" style="width:285px" value="4379828854845152"/></td>
                                    <td><input type="text" maxlength="4" name="cvv2Number" id="cvv2Number" class="text_box123" value="962" style="width:285px;"/></td>
                                    <!-- <td>
                                    <div class="styled_select" style="width:135px;">
                                    <select name="creditCardType" id="creditCardType" onChange="javascript:generateCC(); return false;" style="width:150px;">
                                        <option value="Visa" selected>Visa</option>
                                        <option value="MasterCard">MasterCard</option>
                                        <option value="Discover">Discover</option>
                                        <option value="Amex">American Express</option>
                                   </select>
                                   </div>
                                  </td> -->
                                  </tr>
                                   <tr>
                                    <td><div id="payment_cc_creditCardNumber_errorloc" class="error_orange"></div></td>
                                    <!-- <td><div id="payment_cc_creditCardType_errorloc" class="error_orange"></div></td> -->
                                    <td><div id="payment_cc_cvv2Number_errorloc" class="error_orange"></div></td>
                                  </tr>
                                </table>
                            </td>
                          </tr>
                        <tr>
                            <td width="100%" colspan="2">
                            	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="width:auto;">
                                  <tr>
                                    <!-- <td width="315">SECURITY CODE <a href="javascript: showDetails(10)" onclick="return overlib('&lt;font class=bodytext&gt;<div class=tiptool><div class=tip_top></div><div class=clear></div><div class=tip_mid><h2>Where can I find my card security code?</h2><ul><li><img src=images/card.gif style=padding-left:30px; /></li></ul></div><div class=tip_bot></div></div>&lt;/font&gt;',BORDER,'1');" onMouseOut="nd();"><img src="images/question.png" alt="" width="12" height="12" /></a></td> -->
                                    <td>EXPIRY DATE</td>
                                  </tr>
                                  <tr>
                                    <!-- <td><input type="text" maxlength="4" name="cvv2Number" id="cvv2Number" class="text_box123" value="962" style="width:285px;"/></td> -->
                                    <td>
                                    <div class="styled_select" style="width:140px; float:left; margin-right:10px;">
                                    	<select name="expDateMonth" id="expDateMonth" style="width:155px;">
                            			<option value="000">Month</option>
                              		<?php for ($m = 1; $m <= 12; $m++) { ?>
                              			<option value="<?php echo $m; ?>"><?php echo $m; ?></option>
                              		<?php } ?>
		                                </select>
		                           </div>
                                <div class="styled_select" style="width:140px; float:left;">
	                            <select name="expDateYear" id="expDateYear" style="width:155px;">
	                                	<option value="000">Year</option>
                              		<?php for ($y = date("Y"); $y <= date("Y")+10; $y++) { ?>
                              			<option value="<?php echo $y; ?>"><?php echo $y; ?></option>
                              		<?php } ?>
	                            </select>
                                </div>
                                  </td>
                                  </tr>
                                   <tr>
                                    <!-- <td><div id="payment_cc_cvv2Number_errorloc" class="error_orange"></div></td> -->
                                    <td><div id="payment_cc_expDateMonth_errorloc" class="error_orange"></div><div id="payment_cc_expDateYear_errorloc" class="error_orange"></div></td>
                                    <td></td>
                                  </tr>
                                </table>
                            </td>
                          </tr>


                            </table>

                            </td>
                          </tr>
                        </table></td>
                      </tr>



	<!-- maestro form -->
					  <!--<tr>
                        <td style="padding-left:15px;"><input type="radio" name="payment_system" id="maestro" value="maestro" />
                          Maestro <img src="images/payment_icon01.png" alt="" width="22" height="14" /></td>
                      </tr>-->
                      <tr>

                      	<td colspan="2"><table id="maestro" style="margin: 0 0 0 20px;" width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                             	<tr>
                                    <td width="315">CARDHOLDERS FIRST NAME</td>
                                    <td>CARDHOLDERS LAST NAME</td>
                                  </tr>
                                  <tr>
                                    <td><input type="text" size=30 maxlength=32 name=mfirstName id=firstName class="text_box123" style="width:285px;"/></td>
                                    <td><input type="text" size=30 maxlength=32 name=mlastName id=lastName class="text_box123" style="width:289px;"/></td>
                                  </tr>
                                  <tr>
                                  	<td><div id="payment_maestro_firstName_errorloc" class="error_orange"></div></td>
                                  	<td><div id="payment_maestro_lastName_errorloc" class="error_orange"></div></td>
                                  </tr>
		                      <tr>
		                        <td width="100%" colspan="2">ADDRESS LINE 1</td>
		                      </tr>
		                      <tr>
		                        <td colspan="2">
		                         <input type="text" maxlength=100 name=maddress1 id=address1 class="text_box123 width600"/>
								</td>
		                      </tr>
		                      <tr>
		                        <td colspan="2"><div id="payment_maestro_address1_errorloc" class="error_orange"></div></td>
		                      </tr>
							   <tr>
		                        <td width="100%" colspan="2">ADDRESS LINE 2</td>
		                      </tr>
		                      <tr>
		                        <td colspan="2">
		                         <input type="text" maxlength=100 name=maddress2 id=address2 class="text_box123 width600"/>
								</td>
							  </tr>
							  <tr>
		                        <td colspan="2"><div id="payment_maestro_address2_errorloc" class="error_orange"></div></td>
		                      </tr>
							     <tr>
		                            <td width="40%">TOWN / CITY</td>
		                            <td width="50%">POSTCODE</td>
		                      </tr>
		                          <tr>
                                    <td><input type="text" maxlength=40 name=mcity id=city class="text_box123" style="width: 285px;"/></td>
                                    <td><input type="text" maxlength=10 name=mzip id=zip class="text_box123" style="width: 289px;" /></td>
                                  </tr>
                                  <tr>
                                    <td><div id="payment_maestro_city_errorloc" class="error_orange"></div></td>
                                    <td><div id="payment_maestro_zip_errorloc" class="error_orange"></div></td>
                                  </tr>
								   <tr>
		                        <td>CARD NUMBER</td>
		                        <td>SECURITY CODE <a href="javascript: showDetails(10)" onmouseover="return overlib('&lt;font class=bodytext&gt;<div class=tiptool><div class=arrowright></div><div class=tip_top></div><div class=clear></div><div class=tip_mid><img src=images/toobg.gif style=padding-left:20px; /></div><div class=tip_bot></div></div>&lt;/font&gt;',BORDER,'1');" onMouseOut="nd();"><img src="images/question.png" alt="" width="12" height="12" class="tips" original-title="3 digits security code"/></a></td>
		                      </tr>
		                      <tr>
                                    <td><input type="text" maxlength="19" name="mcreditCardNumber" id="creditCardNumber" class="text_box123" style="width:285px" value=""/></td>
                                    <td><input type="text" maxlength="4" name="mcvv2Number" id="cvv2Number" class="text_box123" value="962" style="width:289px;"/></td>
                                    <!-- <td>
                                    <div class="styled_select" style="width:135px;">
                                    <select name="creditCardType" id="creditCardType" onChange="javascript:generateCC(); return false;" style="width:150px;">
                                        <option value="Visa" selected>Visa</option>
                                        <option value="MasterCard">MasterCard</option>
                                        <option value="Discover">Discover</option>
                                        <option value="Amex">American Express</option>
                                   </select>
                                   </div>
                                  </td> -->
                                  </tr>
                                   <tr>
                                    <td><div id="payment_maestro_creditCardNumber_errorloc" class="error_orange"></div></td>
                                    <!-- <td><div id="payment_cc_creditCardType_errorloc" class="error_orange"></div></td> -->
                                    <td><div id="payment_maestro_cvv2Number_errorloc" class="error_orange"></div></td>
                                  </tr>
		                       <tr>
		                            <td width="40%">VALID FROM</td>
		                            <td width="50%">VALID UNTIL</td>
		                      	</tr>
		                          <tr>
		                            <td>
		                            	<div class="styled_select" style="width:140px; float:left;  margin-right:10px;">
		                            	<select name="mvalDateMonth" id="valDateMonth" style="width:155px;">
		                              		<?php for ($m = 1; $m <= 12; $m++) { ?>
		                              			<option value="<?php echo $m; ?>"><?php echo $m; ?></option>
		                              		<?php } ?>
		                                 </select>
		                                 </div>
		                                 <div class="styled_select" style="width:140px; float:left;  margin-right:10px;">
		                              	<select name="mvalDateYear" id="valDateYear" style="width:155px;">
		                                	<?php for ($y = date("Y"); $y <= date("Y")+10; $y++) { ?>
		                              			<option value="<?php echo $y; ?>"><?php echo $y; ?></option>
		                              		<?php } ?>
		                              	</select>
		                              	</div>
		                              	<div style="clear: both;"></div>
		                              	<div class="error_orange" id="payment_maestro_valDateMonth_errorloc"></div>
										<div class="error_orange" id="payment_maestro_valDateYear_errorloc"></div>
		                            </td>

		                           <td>
		                            	<div class="styled_select" style="width:140px; float:left;  margin-right:10px;">
		                            	<select name="mexpDateMonth" id="expDateMonth" style="width:155px;">
		                              		<?php for ($m = 1; $m <= 12; $m++) { ?>
		                              			<option value="<?php echo $m; ?>"><?php echo $m; ?></option>
		                              		<?php } ?>
		                                 </select>
		                                 </div>
		                                 <div class="styled_select" style="width:140px; float:left;  margin-right:10px;">
		                              	<select name="mexpDateYear" id="expDateYear" style="width:155px;">
		                                	<?php for ($y = date("Y"); $y <= date("Y")+10; $y++) { ?>
		                              			<option value="<?php echo $y; ?>"><?php echo $y; ?></option>
		                              		<?php } ?>
		                              	</select>
		                              	</div>
		                              	<div style="clear: both;"></div>
		                              	<div class="error_orange" id="payment_maestro_expDateMonth_errorloc"></div>
										<div class="error_orange" id="payment_maestro_expDateYear_errorloc"></div>
		                            </td>
		                          </tr>
									</tr>
		                       <tr>
		                            <td width="50%" colspan="2">ISSUE NUMBER</td>
		                      </tr>
	                          <tr>
	                            <td colspan="2"><input type="text" name="missueno" id="issueno" class="text_box123" /></td>
	                          </tr>
	                          <tr>
	                            <td colspan="2"><div class="error_orange" id="payment_maestro_issueno_errorloc"></div></td>
	                          </tr>
		                            </table></td>
		                          </tr>
		                        </table></td>

                      </tr>
 	<!-- paypal  -->
                      <!--<tr>
                        <td colspan="2" style="padding-left:15px;"><input type="radio" name="payment_system" id="paypal" value="paypal" />
                        Paypal <img src="images/paypal.png" alt="" width="43" height="15" /><br />
                        </td>
                      </tr>-->
                      <!-- <tr id="paypal">
                      	<td style="font-size:11px;">paypal</td>
                      </tr> -->

                      <tr>
                        <td class="linkundrline" colspan="2" style="font-size:12px; padding-left:20px; font-weight: normal;">By purchasing, you agree to the deal <a id="various3" href="#fine_print_login"  style="color:3f48cc;">Fine Print </a>and the Jumblr <a href="<?php echo SITE_URL; ?>page.php?page=Terms and Conditions" style="color:3f48cc;">Terms &amp; Conditions.</a></td>
                      </tr>
                       <tr>
                        <td colspan="2">
					<div style="display: none;">
					<div id="fine_print_login" style=" background: #fff; border: 5px solid silver; height: 300pz; width: 410px; padding: 15px 15px;">
							<h2 style="border-bottom:1px dashed #CCCCCC; padding-bottom:8px; margin-bottom:4px;">Deal Fine Print</h2>
							<style>
								.fine_style{
									list-style-type: disc;
									width: 92%;
									margin: 0 auto;
								}
							</style>
							<ul class="fine_style">
								<li>One per person.</li>
								<li>May buy multiples as gifts.</li>
								<li>Voucher valid for 1 month.</li>
								<li>POstage costs an aditional <?php echo getSettings(currency_symbol); ?>4.95</li>
								<li>Please allow up to 10 working days for delivery after redeeming.</li>
							</ul>
						</div>
						</div>

                        <div id="gateway_error_msg" class="error"></div>

            				<!-- paypal IPN values  -->

            				 <?php
	            		 		//$amount = $_SESSION['total_price'];
								$user_id = $_SESSION["fb_id"];
								$deal_id = $prod_res['deal_id'];
								//$qty = $_SESSION['qty'];
								$trn_date = date("Y-m-d H:i:s");
            				 ?>

            				<input type="hidden" id="frm_paypal_total_qty" name="item_number" value="1">
							<input type="hidden" id="frm_paypal_total_price" name="amount" value="<?php echo ($prod_res['is_multi'] == 'n' ? number_format($prod_res['discounted_price'], 2) : number_format($is_multi['multi_deal_item_price'], 2)); //$prod_res['discounted_price']; ?>">
							<input type="hidden" name="custom" value="<?php echo $user_id.",".$deal_id.",".$trn_date; ?>">
							<input type="hidden" name="item_name" value="<?php echo $prod_res['title']; ?>">

                        <input type="submit" name="Submit" value="Buy Now" class="buyu_btn07" style="margin-left:16px;"/>   </td>
                      </tr>
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                    </table>

 					</td>
                    <td width="260"><table style="padding-top: 40px;" width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr height="40px">
                              <td style="color:#696969; font: normal 18px/44px Calibri, Arial, Helvetica, sans-serif;"><img src="images/green_thick.gif" alt="" width="20" height="17" style="padding-top: 5px;" />Your privacy is assured</td>
                            </tr>
                             <tr height="40px">
                              <td style="color:#696969; font: normal 18px/44px Calibri, Arial, Helvetica, sans-serif;"><img src="images/green_thick.gif" alt="" width="20" height="17" style="padding-top: 5px;"/>Get amazing deals daily</td>
                            </tr>
                            <tr height="40px">
                              <td style="color:#696969; font: normal 18px/44px Calibri, Arial, Helvetica, sans-serif;"><img src="images/green_thick.gif" alt="" width="20" height="17" style="padding-top: 5px;"/>Shop online with confidence</td>
                             </tr>
                             <tr height="40px">
                              <td style="color:#696969; font: normal 18px/44px Calibri, Arial, Helvetica, sans-serif;"><img src="images/green_thick.gif" alt="" width="20" height="17" style="padding-top: 5px;"/>Explorer the new side of life</td>
                            </tr>
                        </table></td>
                    </tr>
                  </table>
</form>

<!-- Login payment form validator starts -->

<script type="text/javascript">

function ValidateCcForm() {
//alert('Hi'); return false;
	var ccrad = document.getElementById('ccrad').checked;
	var mrad = document.getElementById('maestro').checked;
	var prad = document.getElementById('paypal').checked;

	//alert(ccrad);alert(mrad);alert(prad); return false;
	if (ccrad == true) {
		var firstName = document.getElementById('firstName').value;
		var lastName = document.getElementById('lastName').value;
		var address1 = document.getElementById('address1').value;
		var address2 = document.getElementById('address2').value;
		var city = document.getElementById('city').value;
		var zip = document.getElementById('zip').value;
		var creditCardNumber = document.getElementById('creditCardNumber').value;

		//var creditCardType = document.getElementById('creditCardType').value;
		var cvv2Number = document.getElementById('cvv2Number').value;
		var expDateMonth = document.getElementById('expDateMonth').value;
		var expDateYear = document.getElementById('expDateYear').value;



		if ( firstName == "" || lastName == "" || address1 == "" || address2 == "" || city == "" || zip == "" || creditCardNumber == "" || cvv2Number == "" || expDateMonth == "000" || expDateYear == "000") {
			//alert ("asdasda");
			document.getElementById('payment_cc_firstName_errorloc').innerHTML = "Enter your first name";

			document.getElementById('payment_cc_lastName_errorloc').innerHTML = "Enter your last name";

			document.getElementById('payment_cc_address1_errorloc').innerHTML = "Enter your full address";

			//document.getElementById('payment_cc_address2_errorloc').innerHTML = "";

			document.getElementById('payment_cc_city_errorloc').innerHTML = "Enter your city";

			document.getElementById('payment_cc_zip_errorloc').innerHTML = "Enter your postcode";

			document.getElementById('payment_cc_creditCardNumber_errorloc').innerHTML = "Enter your Credit/Debit card number";

			document.getElementById('payment_cc_cvv2Number_errorloc').innerHTML = "Enter your CVV/Security number";

			document.getElementById('payment_cc_expDateMonth_errorloc').innerHTML = "Enter your card expiry month";

			document.getElementById('payment_cc_expDateYear_errorloc').innerHTML = "Enter your card expiry year";
			return false;
		}
	}	// ccrad validation

	if (mrad == true) {
		var firstName = document.getElementById('firstName').value;
		var lastName = document.getElementById('lastName').value;
		var address1 = document.getElementById('address1').value;
		var address2 = document.getElementById('address2').value;
		var city = document.getElementById('city').value;
		var zip = document.getElementById('zip').value;
		var creditCardNumber = document.getElementById('creditCardNumber').value;

		//var creditCardType = document.getElementById('creditCardType').value;
		var cvv2Number = document.getElementById('cvv2Number').value;

		var valDateMonth = document.getElementById('valDateMonth').value;issueno
		var valDateYear = document.getElementById('valDateYear').value;

		var expDateMonth = document.getElementById('expDateMonth').value;
		var expDateYear = document.getElementById('expDateYear').value;

		var issueno = document.getElementById('issueno').value;


		if ( firstName == "" || lastName == "" || address1 == "" || address2 == "" || city == "" || zip == "" || creditCardNumber == "" || cvv2Number == "" || valDateMonth == "000" || valDateYear == "000" || expDateMonth == "000" || expDateYear == "000" || issueno == "") {
			//alert ("asdasda");
			document.getElementById('payment_maestro_firstName_errorloc').innerHTML = "Enter your first name";

			document.getElementById('payment_maestro_lastName_errorloc').innerHTML = "Enter your last name";

			document.getElementById('payment_maestro_address1_errorloc').innerHTML = "Enter your full address";

			//document.getElementById('payment_maestro_address2_errorloc').innerHTML = "";

			document.getElementById('payment_maestro_city_errorloc').innerHTML = "Enter your city";

			document.getElementById('payment_maestro_zip_errorloc').innerHTML = "Enter your postcode";

			document.getElementById('payment_maestro_creditCardNumber_errorloc').innerHTML = "Enter your maestro card number";

			document.getElementById('payment_maestro_cvv2Number_errorloc').innerHTML = "Enter your CVV/Security number";

			document.getElementById('payment_maestro_valDateMonth_errorloc').innerHTML = "Enter your card valid month";

			document.getElementById('payment_maestro_valDateYear_errorloc').innerHTML = "Enter your card valid year";

			document.getElementById('payment_maestro_expDateMonth_errorloc').innerHTML = "Enter your card expiry month";

			document.getElementById('payment_maestro_expDateYear_errorloc').innerHTML = "Enter your card expiry year";

			document.getElementById('payment_maestro_issueno_errorloc').innerHTML = "Enter your card Issue number";
			return false;
		}
	}	// maestro validation


}


</script>
<!-- Login payment form validator ends -->

<script type="text/javascript">

/*$("input[name='payment_system']:checked").change(function () {
	$("tr#cc").slideDown(500);
});
*/


$('table#cc').show();
$('table#maestro').hide(0);
$('tr#paypal').hide(0);

$('input[name="payment_system"]').change(function() {
                var selected_type = $(this).val();
                switch(selected_type) {
                        case "cc":
                                $('table#cc').slideDown(500);
                                //if others are visible just slideup
                                $('table#maestro').slideUp(500);
                                $('tr#paypal').slideUp(500);
                        break;

                        case "maestro":
                                $('table#maestro').slideDown(500);
                                //if others are visible just slideup
                                $('table#cc').slideUp(500);
                                $('tr#paypal').slideUp(500);
                        break;

                        case "paypal":
                                $('tr#paypal').slideDown(500);
                                //if others are visible just slideup
                                $('table#cc').slideUp(500);
                                $('table#maestro').slideUp(500);
                        break;
                }
        }
);
</script>
<?php }	// End Registration form condition ?>


                        </tr>
                      </table>                    </td>
                  </tr>
                </table>

                  <div>&nbsp;</div>
                </div>

    </div>
<div class="accounts_bot"><img src="images/spacer.gif" alt="" width="1" height="9"/></div>
</div>
</div>










<script type="text/javascript">
var flag_disc=0;
$("document").ready(function(){

	$("#discount").click(function(){
	
	flag_disc=1;
	document.getElementById("disp").style.display='block';

	});

});
function total_price(qty) {
	var single_price = <?php echo ($prod_res['is_multi'] == 'n' ? number_format($prod_res['discounted_price'], 2) : number_format($is_multi['multi_deal_item_price'], 2)); //$prod_res['discounted_price']; ?>;
	//alert (single_price);
	var total_price = single_price*qty;

	document.getElementById('total_price').innerHTML = '<?php echo getSettings(currency_symbol); ?>'+total_price;
}

function ajaxReq(str)
{
var xmlhttp;
//alert(flag_disc);
//alert(flag_disc);
if (str.length==0)
  {
  document.getElementById("total_price").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	  
	    if(flag_disc==1)
		{
			var total = xmlhttp.responseText;
			var disc=parseFloat('<?php echo getSettings(discount)?>');
			document.getElementById("payment_amount").value = addCommas(total-(total*disc));
			//alert(addCommas(total));
			document.getElementById("total_price").innerHTML='<?php echo getSettings(currency_symbol); ?>'+addCommas((total-(total*disc)));
			document.getElementById("big_total_price").innerHTML = '<?php echo getSettings(currency_symbol); ?>'+addCommas((total-(total*disc)));
			document.getElementById("frm_paypal_total_price").value=addCommas((total-(total*disc)));
			document.getElementById("frm_paypal_total_qty").value=str;
		}
		else
		{
			//var total = xmlhttp.responseText;
			
			//alert(number(xmlhttp.responseText));
			document.getElementById("payment_amount").value = xmlhttp.responseText;
			document.getElementById("total_price").innerHTML='<?php echo getSettings(currency_symbol); ?>'+xmlhttp.responseText;
			document.getElementById("big_total_price").innerHTML = '<?php echo getSettings(currency_symbol); ?>'+xmlhttp.responseText;
			document.getElementById("frm_paypal_total_price").value=xmlhttp.responseText;
			document.getElementById("frm_paypal_total_qty").value=str;
		}

    }
  }
<?php if ($multi_deal_id != '') { ?>
xmlhttp.open("GET","ajax_payment.php?qty="+str+"&id="+<?php echo $prod_id; ?>+"&mid="+<?php echo $multi_deal_id; ?>,true);
<?php } else { ?>
xmlhttp.open("GET","ajax_payment.php?qty="+str+"&id="+<?php echo $prod_id; ?>,true);
<?php } ?>
xmlhttp.send();
}

function addCommas(num) {

    var p = num.toFixed(2).split(".");
    return p[0].split("").reverse().reduce(function(acc, num, i, orig) {
        return  num + (i && !(i % 3) ? "," : "") + acc;
    }, "") + "." + p[1];
	
}


function change(val)
{
	
			document.getElementById("payment_amount").value = (val);
			//alert(val);
			document.getElementById("total_price").innerHTML='<?php echo getSettings(currency_symbol); ?>'+(val);
			document.getElementById("big_total_price").innerHTML = '<?php echo getSettings(currency_symbol); ?>'+(val);
			document.getElementById("frm_paypal_total_price").value=(val);
}


</script>



</div>
</div>
</div>
</div>
<?php include ('include/footer.php'); ?>