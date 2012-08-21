<?php
include("include/header.php");
include("plugin/mpdf/mpdf.php");
include("fckeditor/fckeditor.php");
session_start();
$mpdf=new mPDF();
$user_id = $_SESSION["user_id"];

//isLogin();
?>

<?php
	if(!isset($_COOKIE["subscribe"]))
	header("location:".SITE_URL);
?>

<?php if($_GET['usucc'] != "") {  ?>
<div class="register_Main">
<div style="float:left; width:9px; height:49px; margin:0 0 0 0px;"><img src="images/g_left.png" alt="" width="9" height="49" border="0"/></div>
<div class="register_bg">
<h6 style="font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; padding: 10px; color: #333333; font-size: 14px;">
<span  id="close"><img src="images/closed.gif" width="15" height="13" align="right" style=" margin:0 -10px 0 0;" border="0"/></span>
<?php echo $_GET['usucc']; ?>
</h6>
</div>
<div style="float:left; width:9px; height:49px; margin:0 0 0 0;"><img src="images/g_right.png" alt="" width="9" height="49" border="0"/></div>
</div>
<?php } ?>
<script>
$("span#close").click(function() {
	$("div.register_Main").slideUp(300);

});
</script>


<div id="container">
<div id="leftcol">
<div class="deal_info">
<div class="top_about2">
<p style="font-family: Candara; font-size: 28px; font-weight: bold; line-height:30px; color: #333333; padding: 0px 0 0 10px;">My Account</p>
</div>
<div class="clear"></div>
<div class="midbg">
<div class="today_deal">

<div class="clear"></div>
<?php

	if(strtolower($_SERVER['REQUEST_METHOD']) == 'post' && $_POST["btnProfile"]=='Submit')
	{

		$user_id = $_SESSION["user_id"];
		$location_id = $_POST["location"];
		$cat_id = $_POST["category"];

		if($location_id == '' and $cat_id == '')
		{
			$msg = 'No field selected. Please select a field';
			$flag=1;
		}

		if($flag != 1)
		{
			if($location_id != '')
			{
				$sql_profile_select_city = "SELECT * FROM ".TABLE_USER_SUBSCRIPTION." WHERE user_id=".$user_id." and city_id=".$location_id;
				$result_profile_select_city = mysql_query($sql_profile_select_city);
				$count_profile_select_city = mysql_num_rows($result_profile_select_city);

				if($count_profile_select_city > 0)
				{
					$msg = 'Selected city already exists';
					$flag=1;
				}
			}

			if($flag != 1)
			{
				if($cat_id != '')
				{
					$sql_profile_select_cat = "SELECT * FROM ".TABLE_USER_PREFERENCE." WHERE user_id=".$user_id." and category_id=".$cat_id;
					$result_profile_select_cat = mysql_query($sql_profile_select_cat);
					$count_profile_select_cat = mysql_num_rows($result_profile_select_cat);

					if($count_profile_select_cat > 0)
					{
						$msg = 'Selected category already exists';
						$flag=1;
					}
				}

			}
		}

		if($flag != 1)
		{
			if($location_id != '')
			{
				$sql_profile_insert_city = "INSERT INTO ".TABLE_USER_SUBSCRIPTION."(user_id,city_id) VALUES("."'".$user_id."',"."'".$location_id."'".")";
				mysql_query($sql_profile_insert_city);
			}

			if($cat_id != '')
			{
				$sql_profile_insert_cat = "INSERT INTO ".TABLE_USER_PREFERENCE."(user_id,category_id) VALUES("."'".$user_id."',"."'".$cat_id."'".")";
				mysql_query($sql_profile_insert_cat);
			}


			$msg= 'Profile successfully updated';
			$flag=2;
		}


	}



?>
<style type="text/css" >

/*
Old Left tab My account design's .here class
.here{
	font: bold 12px/29px Arial, Helvetica, sans-serif;
	color: #fff;
	float: left;
	text-align: center;
	margin: 4px 0px 4px 0;
	border: 1px solid #d6d6d6;
	background: url(../images/tab_hover.gif) left top repeat-x;
	outline: none;
	width: 100px;
	padding: 0 20px;
	height: 29px;
}*/

</style>
	<script type="text/javascript" language="javascript">
	<!--
		function show_tab(ID)
		{
			for(i=1; i<=8; i++)
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

<script type="text/javascript">

	function editFields(linkElem){
		var parent=$(linkElem).parents('table');
		var parentId=parent.attr('id');
		parent.hide();
		$('#'+parentId+'Form').show();
		}


	function cancelFields(linkElem){var parent=$(linkElem).parents('form');var parentId=parent.attr('id');var tableTextId=parentId.substring(0,parentId.length-4);parent.hide();$('#'+tableTextId).show();var textFields=parent.find('input[type="text"]');textFields.each(function(i){var span=$('span[id="'+$(this).attr('name')+'"]');if(span.size()==1){var value=span.text();$(this).val(value);}});if($('#editGenderField').size()==1){var name=$('#editGenderField').attr('name');$('#editGenderField').val($('span[id="'+name+'"]').attr('class'));}
	if($('#jRegisterBirthdayDay').size()==1){var spanBirth=$('#birthday');$('select[name="birthDay"]').val(spanBirth.text().substring(0,2));$('select[name="birthMonth"]').val(spanBirth.attr('class'));$('select[name="birthYear"]').val(spanBirth.text().substring(6));}
	clearPwdFields(parent);clearErrors(true);}

</script>


<div style="width:890px; float: left; margin: 10px  20px 10px 18px;">
   	<div class="tabs">
		<a href="javascript: show_tab(1);" id="tab_1" style="text-decoration: none; margin-right: 0px;">My Vouchers</a>
		<a href="javascript: show_tab(6);" id="tab_6" style="text-decoration: none; margin-right: 0px;">Purchase History</a>
		<a href="javascript: show_tab(7);" id="tab_7" style="text-decoration: none; margin-right: 0px;">Add Jumble</a>
		<a href="javascript: show_tab(8);" id="tab_8" style="text-decoration: none; margin-right: 0px;">Past Jumble</a>
		<!-- <a href="javascript: show_tab(2);" id="tab_2">Credits</a>
		<a href="javascript: show_tab(4);" id="tab_4">Royal Points</a>
		<a href="javascript: show_tab(5);" id="tab_5">Subscriptions</a>
		<a href="javascript: show_tab(3);" id="tab_3">Account</a> -->
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
		<div class="title">My Vouchers</div>
	<?php
		$sql_orders = "SELECT * FROM ".TABLE_TRANSACTION." WHERE user_id = $_SESSION[fb_id]";
		$orders_res = mysql_query($sql_orders);
		$orders_num = mysql_num_rows($orders_res);

		if ($orders_num <= 0) {
	?>
		<h4>You haven&rsquo;t bought a deal yet.</h4>
		<p>You haven&rsquo;t made any purchases yet or all of your deals have  been used, redeemed, or given as gifts. To see a full record of all the  vouchers you've used or gifted in the past, visit your&nbsp;<a href="<?php echo SITE_URL; ?>customer-account.php?tab=purchase">Purchase History</a>.</p>
	<?php
		}
		else {

		//var_dump($_SESSION);
		$count = 0;

		while ($orders_row = mysql_fetch_array($orders_res)) {
			$deal_details = get_deal_details($orders_row['deal_id']);
			$pur_date = $orders_row["transaction_date"];
			$pur_date_formated = strftime("%d %B %Y", strtotime($pur_date));

			$start_date = reset(explode(" ",$deal_details["deal_start_time"]));
			$end_date = reset(explode(" ",$deal_details["deal_end_time"]));
			//$end_date_formated = strftime("%d %B %Y", strtotime($end_date));

			$start_date_formated = strftime("%d/%m/%Y",strtotime($start_date));
			$end_date_formated = strftime("%d/%m/%Y",strtotime($end_date));

			$sql_deal_image = "SELECT * FROM ".TABLE_DEAL_IMAGES." WHERE deal_id = ".$orders_row['deal_id'];
			$deal_image = mysql_fetch_array(mysql_query($sql_deal_image));


			$count++;

	?>
	<!-- loop start -->
		<div class="TabbedPanelsContent27" id="myaccount_1">
         <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <th style="width:150px;">Deal Number</th>
            <th style="width:100px;">Jumblr Code</th>
            <th style="width:280px;">How to get your deal</th>
            <th style="width:150px;">Deal Status</th>
          </tr>
           <tr>
            <td style="width:150px;"><?php echo $count; ?></td>
            <td style="width:100px;"><?php echo $orders_row['coupon_code']; ?></td>
            <td style="width:280px; line-height:15px;">Click on the link to open your vouchar<br /><img src="images/pdf_icon.gif" alt="" />
			<a href="<?php echo SITE_URL; ?>pdf.php?deal_title=<?php echo $deal_details['title']; ?>&c_code=<?php echo $orders_row['coupon_code']; ?>&price=<?php echo $orders_row['amount']; ?>&e_valid=<?php echo $end_date_formated; ?>&s_valid=<?php echo $start_date_formated; ?>&img=<?php echo UPLOAD_PATH.$deal_image['file']; ?>" target="_new" onclick="">
			Your Jumblr deal
			</a></td>
            <td style="width:150px;"><?php echo ucfirst($orders_row['transaction_status']); ?></td>
          </tr>
          </table>

          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="product_box">
              <tr>
                <td width="180"><img src="<?php echo UPLOAD_PATH.$deal_image['file']; ?>" alt="" class="product_img"/></td>
                <td width="220">
                	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="product_box2">
                      <tr>
                        <td colspan="2" class="font12"><strong>Date of Purchase: <?php echo $pur_date_formated; ?></strong></td>
                      </tr>
                      <tr>
                        <td><strong>Price:</strong></td>
                        <td><?php echo getSettings(currency_symbol);?><?php echo $orders_row['amount']; ?></td>
                      </tr>
                      <tr>
                        <td><strong>Quantiry:</strong></td>
                        <td><?php echo $orders_row['qty']; ?> x</td>
                      </tr>
                      <tr>
                        <td><strong>Value:</strong></td>
                        <td><?php echo getSettings(currency_symbol);?><?php echo $deal_details['full_price']; ?></td>
                      </tr>
                      <tr>
                        <td><strong>Discount:</strong></td>
                        <td><?php echo $deal_details['discount']; ?></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                    </table>
                </td>
                <td>
                	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="product_box3">
                      <tr>
                        <td  class="font12"><strong>Valid From: <?php echo $start_date_formated; ?></strong></td>
                        <td  class="font12"><strong>Valid until: <?php echo $end_date_formated; ?></strong></td>
                      </tr>
                      <tr>
                        <td colspan="2" style="padding: 8px 0 0 0;"><strong><a href="<?php echo SITE_URL; ?>deal-details.php?action=view&id=<?php echo $orders_row['deal_id']; ?>" target="_blank"><?php echo $deal_details['title']; ?></a></strong></td>
                      </tr>
                      <!-- <tr class="savings">
                        <td><strong>Total Savings:</strong></td>
                       <td><strong>&pound;<?php echo $deal_details['savings'];?></strong></td>
                      </tr> -->
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                    </table>
                </td>
              </tr>
            </table>
       </div>
	   <!-- loop ends -->
<?php
		} // End while
		}	// End else
?>

    </div>	<!-- 1 ends here  -->

	<div class="TabbedPanels1" id="myaccount_2" style="display:none;">
	   <div style="width:99%;" class="title">
		 Credit

	<?php if (get_credits($_SESSION['user_id']) == '') { ?>

		 <span class="float_right" style="font: normal 12px/19px Arial, Helvetica, sans-serif; margin: 10px 0 0px 0;">
			You have no credit on your account
		 </span>

		<div class="clear"></div>
		<?php } else { ?>
		<div class="clear"></div>
      	<div style="float:right; height:29px; margin:-26px 0 0 0; padding:0px; width:150px; text-align:center; font: bold 12px/29px Candara, Arial, Helvetica, sans-serif;  background: url(images/tab_bg1.gif) left top repeat-x;">
		  Credits: <?php echo getSettings(currency_symbol);?><?php echo number_format(get_credits($_SESSION['user_id']),2); ?>
		</div>
		<?php } ?>
	  </div>


		<!--<p><b>You have no credit on your account</b></p>-->

		<div class="today_deal" style="width:660px; margin: 0 auto; padding:0px;">

 <h4>Recommend us and we will top up your credit</h4>
 <div class="content_box3">
    Why not surprise your friends with unbeatable deals in your city while earning easy cash at the same time?<br>
    We love our customers so therefore we will reward you 5 worth of credit for every new customer you bring our way (see details below)
</div>

<p class="center_align">

</p>

<div class="content_box2" style="width:660px; border:1px solid #edeced; margin:0px; background:none; padding-top:10px;">
	<h1 style="width:100%; text-align:center;">Get going and invite your friends</h1>
	<ul style="width: 180px; float: none; margin: 0 auto;">
    	<li class="btn10">
        	<a id="various1" href="#inline1"><!--<img src="images/recomandedus07.png" alt=""/>-->recomandedus07</a>
        </li>
        <!--<li>
        	<b style="font-size:12px;">Log in and receive your recommendation link.</b> <br />You dont have an account yet? <a href="#" style="text-decoration:underline;">Sign up here</a></li>-->
    </ul>

    <ul style="width:48%; float:right;">
       <!-- <li style="padding:15px 0;">
        	<a href="<?php echo SITE_URL; ?>customer-login.php"><img src="images/btn_02.gif" alt=""/></a>
        </li>-->
    	<!--<li>
        	<b style="font-size:12px;">Pass on your personal link </b> <br /> You can pass on the link via e-mail or on your Website, Facebook or by any other means necessary.
        </li>-->
    </ul>
  <div class="clear"></div>
 </div>

<h4>OK, but how does Jumblr credits work?</h4>

 <div class="content_box2" style="margin:0px; width:660px; background:none; padding:10px 0;">
        	<b> Why recommend deals?</b><br /> Recommending deals has many benefits but most importantly, we will credited you with <?php echo getSettings(currency_symbol);?>5.00 which means you can get your next deal at even greater discounted price. The main reason we like our users to recommend deals is because we feel god to know that all people who are interested in buying our deals are aware of the deal. Help your friends and families to save money on great deals too!
</div>

 <div class="content_box2" style="margin:0px; width:660px; background:none; padding:10px 0;">
        	<b> How can I recommend Jumblr to my friends who havent heard of Jumblr?</b><br /> We provide our users with easy recommendation facilities to allow them to tell friends without doing much. Every deal that we feature on Jumblr are assigned with a special link which you can send to your friends using Facebook, Twitter or Email.<br /><br /> Whoever you recommend us to, have 48 hours to create an account with us and buy a deal worth more than <?php echo getSettings(currency_symbol);?>15 for the first time. If the 48 hours runs out and they havent created an account then we cannot give you the credit.
</div>
<div class="content_box2" style="margin:0px; width:660px;  background:none; padding:10px 0;">
<b>How long is my account credit valid until?</b><br /> You have 3 months to use your credit. After the 3 months your unused credit will be no longer be valid to use.
</div>

<div class="content_box2" style="margin:0px; width:660px;  background:none; padding:10px 0;">
<b>How can I spend my credits?</b><br /> You can use your credit on any deal you want. You will have to redeem your credit on the payment page otherwise the credit will not be rewarded towards your deal price. If you have recommended us to many people then there may be situation where your account credit is more than the deal price so in this case, whatever is left over can be used on your deal unless it has expired.
</div>

</div>

    </div><!-- 2 ends here  -->


	<div class="TabbedPanels1" id="myaccount_3" style="display:none;">
		 <div class="title">Account


				<?php //if($succ_msg != "") {

				?>

				<!-- <label style="color: #191919; font: bold 18px/22px Arial, Helvetica, sans-serif; margin-left: 50px;">
				<img src="images/tick_mark.gif" align="top" style=" float:left; margin:0 5px 0 0;"><?php echo $succ_msg?>
				</label> -->
				<?php //}	?>
		</div>

		<?php
//
			$sql_user = "SELECT * FROM ".TABLE_USERS." WHERE user_id=".$user_id;
			$result_user = mysql_query($sql_user);
			$row_user = mysql_fetch_array($result_user);

			//var_dump($row_user);

			$title = trim($row_user["title"]);
			$fname = trim($row_user["first_name"]);
			$lname = trim($row_user["last_name"]);

			$add1 = $row_user["address1"];
			$add2 = $row_user["address2"];
			$city = $row_user["city"];
			$postcode = $row_user["zip"];
			$phno = $row_user["phone_no"];
			$dob = $row_user["dob"];

			$dob_formated = strftime("%d %B %Y", strtotime($dob));


			$email = $row_user["email"];

			$current_password = $row_user["password"];

			//$image = $row_user["user_img"];

		?>

		<table class="account_table" id="name">
			<tr>
			<td width="160"><strong>Name</strong></td>
			<td width="160"> <?php echo $title.' '.$fname.' '.$lname; ?></td>
			<td class="right_align"><a onclick="editFields(this); return false;" href=""><!--Edit--></a></td>
			</tr>
		</table>
		<?php

			//$flag = 0;
			//$msg ='';
	if(strtolower($_SERVER['REQUEST_METHOD']) == 'post' && $_POST["btnNameUpdate"]=='Save')
	{
		//$image = $_FILES["image"]["name"];

		$fname = $_POST["fname"];
		$lname = $_POST["lname"];
		$email = $_POST["email"];
		$npassword = $_POST["password"];

		if($fname == '')
		{
			$err_msg = 'Please enter first name';
			$flag = 1;
		}
		if($lname == '')
		{
			$err_msg = 'Please enter last name';
			$flag = 1;
		}
		if($npassword == '')
		{
			$err_msg = 'Please enter password';
			$flag = 1;
		}


		/*if($flag == 0)
		{
			if($fname == '')
			{
				$msg = 'Please enter first name';
				$flag=1;
			}
		}

		if($flag == 0)
		{
			if($lname == '')
			{
				$msg = 'Please enter last name';
				$flag=1;
			}
		}

		if($flag == 0)
		{
			if($npassword == '')
			{
				$msg = 'Please enter password';
				$flag=1;
			}
		}*/

		//if($flag != 1 && $current_password == base64_encode($npassword)) {
				$sql_name_update = "UPDATE ".TABLE_USERS." SET first_name='".$fname."', last_name='".$lname."' WHERE user_id=".$user_id;
				mysql_query($sql_name_update);
				$succ_msg = 'Customer updated successfully';

				//$flag =2;
		//}


	}

		?>
		<form name="frmname" id="nameForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" style="display:none;">
			<input type="hidden" name="tab_no" value="3">

			<table width="450" border="0" cellspacing="0" cellpadding="0" class="white_box">
    <tr>
      <td>

   <!-- <?php
		if(strtolower($_SERVER['REQUEST_METHOD']) == 'post' && $_POST["btnNameUpdate"]=='Save' && $flag!=0) {
		?>
			<div style="height: 25px; width: auto; margin: 10px; padding: 5px; border: 1px dashed <?php if ($flag == 1) {echo "red";} else {echo "green"; } ?>;">
				<?php if($msg != "") { ?>
				<label style="color: #CC0000; font-weight: bold;"><?=$msg?></label>
				<?php } ?>
				<?php if($succ_msg != "") { ?>
				<label style="color: #006600; font-weight: bold;"><?=$succ_msg?></label>
				<?php }	?>
			</div>
		<?php }	?> -->

     <table width="450" border="0" align="left" cellpadding="3" cellspacing="3" class="form_box">
          <!--<tr>
            <td width="450"><p>Note: Name can only be change every 6 months!</p></td>
          </tr>-->
          <tr>
            <td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>Current Full Name </td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><input type="text" name="cfname" id="cfname" value="<?php echo $title.' '.$fname.' '.$lname; ?>" class="text_box12"/><span><br />Notice:</span> <span style="font-family: Arial; font-weight: lighter; font-size: 12px; color: #000;">Name can only be changed every six months.</span></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="40%">First name</td>
                    <td width="60%">Last name</td>
                  </tr>
                </table></td>
                </tr>
				<tr>
                <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="40%"><input type="text" name="fname" id="fname" value="<?php if(isset($_POST["btnNameUpdate"])) { echo $_POST["fname"];}else{ echo $fname;} ?>" class="text_box11"/></td>
                    <td width="60%"><input type="text" name="lname" id="lname" value="<?php if(isset($_POST["btnNameUpdate"])) { echo $_POST["lname"];}else{ echo $lname;} ?>" class="text_box11"/></td>
                  </tr>
                </table></td>
                </tr>

              <!--<tr>
                <td>Last name </td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><input type="text" name="lname" id="lname" value="<?php if(isset($_POST["btnNameUpdate"])) { echo $_POST["lname"];}else{ echo $lname;} ?>" class="text_box12"/></td>
                <td>&nbsp;</td>
              </tr>-->
            </table>

			</td>
          </tr>

          <tr>
            <td><!-- To save these new settings, please enter your Jumblr password --></td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>Password</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><input type="password" name="password" class="text_box11"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" name="btnNameUpdate" class="save_btn_small" value="Save"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="button" name="cancel" class="cancel_btn" value="Cancel" onclick="cancelFields(this); return false;"/></td>
                <td></td></tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <!--<tr>
            <td><table width="300" border="0" align="left" cellpadding="0" cellspacing="0">
              <tr>
                <td><input type="submit" name="btnNameUpdate" class="save_btn_small" value="Save"/></td>
                <td><input type="button" name="cancel" class="cancel_btn" value="Cancel" onclick="cancelFields(this); return false;"/></td>
              </tr>
            </table></td>
          </tr>-->
      </table></td>
    </tr>
  </table>
		</form>


		<table class="account_table" id="dob">
			<tr>
			<td width="160"><strong>Date of Birth</strong></td>
			<td width="160"> <?php echo $dob_formated; ?></td>
			<td class="right_align">&nbsp;</td>
			</tr>
		</table>



	<!-- <table class="myaccount" id="address">
			<tr>
				<td style="float:left; width: 100px; margin: 0 auto;"><p style="font-family: Helvetica; font-size: 9px; font-weight: bold; color: #000;">Address</p></td>
				<td style="float:left; width: 170px; margin: 0 auto;"><p style="font-family: Helvetica; font-size: 9px; color: #000;"><?php echo $add1.', '.$add2; ?>, <strong><?php echo $city; ?>, <?php echo $postcode; ?></strong></p></td>
				<td style="float:right; width: 30px; margin: 0 30px;"><p><a onclick="editFields(this); return false;" href="">Edit</a></p></td>
			</tr>
		</table>  -->

		<?php


	if(strtolower($_SERVER['REQUEST_METHOD']) == 'post' && $_POST["btnAddressUpdate"]=='Save')
	{
		$flag = 0;
		$msg ='';

		//$image = $_FILES["image"]["name"];

		$add1 = $_POST["add1"];
		$add2 = $_POST["add2"];
		$city = $_POST["city"];
		$postcode = $_POST["postcode"];
		//$phno = $_POST["phno"];

		$apassword = $_POST["password"];

		//$rpassword = $_POST["rpassword"];

			if($add1 == '')
			{
				$err_msg = 'Please enter street address';
				$flag=1;
			}
			if($add2 == '')
			{
				$err_msg = 'Please enter street address 2';
				$flag=1;
			}
			if($city == '')
			{
				$err_msg = 'Please enter city';
				$flag=1;
			}
			if($postcode == '')
			{
				$err_msg = 'Please enter postcode';
				$flag=1;
			}
			/*if($phno == '')
			{
				$err_msg = 'Please enter phone number';
				$flag=1;
			}
			elseif ( !is_numeric($phno)) {
				$err_msg = 'Please enter numeric digit in phone number';
				$flag=1;
			}*/


			if($apassword == '')
			{
				$err_msg = 'Please enter password';
				$flag=1;
			}




		if($flag != 1 && $current_password == base64_encode($apassword)) {


				$sql_address_update = "UPDATE ".TABLE_USERS." SET address1='".$add1."', address2='".$add2."', city='".$city."', zip='".$postcode."' WHERE user_id=".$user_id;
				mysql_query($sql_address_update);
				$succ_msg = 'Address successfully updated';
				//$flag =2;

		}


	}

		?>

		<form name="frmaddress" id="addressForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" style="display:none;">

	<table width="450" border="0" cellspacing="0" cellpadding="0" class="white_box form_box">
   	 <tr>
      <td>

    <!--  <?php
		if(strtolower($_SERVER['REQUEST_METHOD']) == 'post' && $_POST["btnAddressUpdate"]=='Save') {
		?>
			<div style="height: 25px; width: auto; margin: 10px; padding: 5px; border: 1px dashed <?php if ($flag == 1) {echo "red";} else {echo "green"; } ?>;">
				<?php if($flag==1) { ?>
				<label style="color: #CC0000; font-weight: bold;"><?=$msg?></label>
				<?php } ?>
				<?php if($flag==2) { ?>
				<label style="color: #006600; font-weight: bold;"><?=$msg?></label>
				<?php }	?>
			</div>
		<?php }	?>    -->

  <table width="450" border="0" align="left" cellpadding="3" cellspacing="3">

          <tr>
            <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="200">Address Line 1</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><input type="text" name="add1" id="add1" value="<?php if(isset($_POST["btnAddressUpdate"])) { echo $_POST["add1"];}else{ echo $add1;} ?>" class="text_box12"/></td>
                <td>&nbsp;</td>
              </tr>

              <tr>
                <td>Address Line 2</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><input type="text" name="add2" id="add2" value="<?php if(isset($_POST["btnAddressUpdate"])) { echo $_POST["add2"];}else{ echo $add2;} ?>" class="text_box12"/></td>
                <td>&nbsp;</td>
              </tr>

              <tr>
                <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="40%">City:</td>
                    <td width="60%">Postcode:</td>
                  </tr>
                  <tr>
                    <td><input type="text" name="city" id="city" value="<?php if(isset($_POST["btnAddressUpdate"])) { echo $_POST["city"];}else{ echo $city;} ?>" class="text_box11"/></td>
                    <td><input type="text" name="postcode" id="postcode" value="<?php if(isset($_POST["btnAddressUpdate"])) { echo $_POST["postcode"];}else{ echo $postcode;} ?>" class="text_box11"/></td>
                  </tr>
                </table></td>
              </tr>

           <!--     <tr>
                <td width="51%">Postcode</td>
                <td width="49%">&nbsp;</td>
              </tr>
              <tr>
                <td><input type="text" name="postcode" id="postcode" value="<?php if(isset($_POST["btnAddressUpdate"])) { echo $_POST["postcode"];}else{ echo $postcode;} ?>" class="text_box11"/></td>
                <td>&nbsp;</td>
              </tr>

             <tr>
                <td width="51%">Phone No.:</td>
                <td width="49%">&nbsp;</td>
              </tr>
              <tr>
                <td><input type="text" name="phno" id="phno" value="<?php if(isset($_POST["btnAddressUpdate"])) { echo $_POST["phno"];}else{ echo $phno;} ?>" class="text_box12"/></td>
                <td>&nbsp;</td>
              </tr> -->
            </table>
            </td>
          </tr>

          <tr>
            <td><!-- To save these new settings, please enter your Jumblr password --></td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>Password</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><input type="password" name="password" class="text_box11"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="submit" name="btnAddressUpdate" class="save_btn_small" value="Save"/>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="button" name="cancel" class="cancel_btn" value="Cancel" onclick="cancelFields(this); return false;"/></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><table width="300" border="0" align="left" cellpadding="0" cellspacing="0">
             <!-- <tr>
                <td><input type="submit" name="btnAddressUpdate" class="save_btn_small" value="Save"/></td>
                <td><input type="button" name="cancel" class="cancel_btn" value="Cancel" onclick="cancelFields(this); return false;"/></td>
              </tr> -->
           </table></td>
          </tr>
      </table></td>
    </tr>
  </table>
		</form>


		<table class="account_table" id="email">
			<tr>
				<td width="160"><strong>Email</strong></td>
				<td width="160"> <?php echo $email; ?></td>
				<td class="right_align"><a onclick="editFields(this); return false;" href="">Edit</a></td>
			</tr>
		</table>
				<?php


	if(strtolower($_SERVER['REQUEST_METHOD']) == 'post' && $_POST["btnEmailUpdate"]=='Save')
	{
		$flag = 0;
		$err_msg ='';

		//$image = $_FILES["image"]["name"];

		$email = $_POST["nemail"];

		$epassword = $_POST["password"];

		//$rpassword = $_POST["rpassword"];

			if($email == '')
			{
				$err_msg = 'Please enter email address';
				$flag=1;
			}
			/*if($epassword == '')
			{
				$err_msg = 'Please enter password';
				$flag=1;
			}*/



		if($flag != 1) {	// && $current_password == base64_encode($epassword)


				$sql_email_update = "UPDATE ".TABLE_USERS." SET email='".$email."' WHERE user_id=".$user_id;
				mysql_query($sql_email_update);
				$succ_msg = 'Email address changes has been saved.';
				//$flag =2;

		}


	}

		?>

		<form name="frmemail" id="emailForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" style="display:none;">
			<input type="hidden" name="tab_no" value="3">
     	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="edit_table">
   	 <tr>
      <td>

      <!-- <?php
		if(strtolower($_SERVER['REQUEST_METHOD']) == 'post' && $_POST["btnEmailUpdate"]=='Save') {
		?>
			<div style="height: 25px; width: auto; margin: 10px; padding: 5px; border: 1px dashed <?php if ($flag == 1) {echo "red";} else {echo "green"; } ?>;">
				<?php if($flag==1) { ?>
				<label style="color: #CC0000; font-weight: bold;"><?=$msg?></label>
				<?php } ?>
				<?php if($flag==2) { ?>
				<label style="color: #006600; font-weight: bold;"><?=$msg?></label>
				<?php }	?>
			</div>
		<?php }	?> -->

     <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">

          <tr>
            <td>
            <div class="error"><?php if ($flag == 1) echo $err_msg; ?></div>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="51%">Current Email </td>
              </tr>
              <tr>
                <td><input type="text" name="email" id="email" disabled="disabled" readonly="readonly" value="<?php if(isset($_POST["btnEmailUpdate"])) { echo $_POST["email"];}else{ echo $email;} ?>" class="edit_txtbox edit_360px"/></td>
              </tr>
              <tr>
                <td width="49%">New Email</td>
              </tr>
              <tr>
                <td><input type="text" name="nemail" id="nemail" value="<?php if(isset($_POST["btnEmailUpdate"])) { echo $_POST["nemail"];}else{ echo $nemail;} ?>" class="edit_txtbox edit_360px"/></td>
              </tr>
            </table>
            </td>
          </tr>


          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <!--<tr>
                <td>Password</td>
                <td>&nbsp;</td>
              </tr>-->
              <tr>
               <td> <!-- <input type="password" name="password" class="text_box11"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                  <input type="submit" name="btnEmailUpdate" class="save_btn_small" value="Save"/>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="button" name="cancel" class="cancel_btn" value="Cancel" onclick="cancelFields(this); return false;"/></td>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><table width="300" border="0" align="left" cellpadding="0" cellspacing="0">
           <!--   <tr>
                <td><input type="submit" name="btnEmailUpdate" class="save_btn_small" value="Save"/></td>
                <td><input type="button" name="cancel" class="cancel_btn" value="Cancel" onclick="cancelFields(this); return false;"/></td>
              </tr> -->
           </table></td>
          </tr>
      </table></td>
    </tr>
  </table>
		</form>


		<!-- <table class="account_table" id="phno">
			<tr>
				<td width="160"><strong>Phone</strong></td>
				<td width="160"> <?php echo $phno; ?></td>
				<td class="right_align"><a onclick="editFields(this); return false;" href="">Edit</a></td>
			</tr>
		</table>  -->

		<?php


	if(strtolower($_SERVER['REQUEST_METHOD']) == 'post' && $_POST["btnPhnoUpdate"]=='Save')
	{
		$flag = 0;
		$err_msg ='';

		//$image = $_FILES["image"]["name"];

		$phno = $_POST["phno"];
		$nphno = $_POST["nphno"];

		$phpassword = $_POST["password"];

		//$rpassword = $_POST["rpassword"];

			if($nphno == '')
			{
				$err_msg = 'Please enter phone number';
				$flag=1;
			}
			elseif ( !is_numeric($nphno)) {
				$err_msg = 'Please enter numeric digit in phone number';
				$flag=1;
			}
			/*if($phpassword == '')
			{
				$err_msg = 'Please enter password';
				$flag=1;
			}*/



		if($flag != 1) {		// && $current_password == base64_encode($phpassword)


				$sql_email_update = "UPDATE ".TABLE_USERS." SET phone_no='".$nphno."' WHERE user_id=".$user_id;
				mysql_query($sql_email_update);
				$succ_msg = 'Phone number changes has been saved.';
				//$flag =2;

		}


	}

		?>

		<form name="frmphno" id="phnoForm" method="post" action="<?php echo SITE_URL; ?>customer-account.php?tab=account" enctype="multipart/form-data" style="display:none;">
			<input type="hidden" name="tab_no" value="3">

	<table width="1005" border="0" cellspacing="0" cellpadding="0" class="edit_table">
   	 <tr>
      <td>

      <!--<?php
		if(strtolower($_SERVER['REQUEST_METHOD']) == 'post' && $_POST["btnPhnoUpdate"]=='Save') {
		?>
			<div style="height: 25px; width: auto; margin: 10px; padding: 5px; border: 1px dashed <?php if ($flag == 1) {echo "red";} else {echo "green"; } ?>;">
				<?php if($flag==1) { ?>
				<label style="color: #CC0000; font-weight: bold;"><?=$msg?></label>
				<?php } ?>
				<?php if($flag==2) { ?>
				<label style="color: #006600; font-weight: bold;"><?=$msg?></label>
				<?php }	?>
			</div>
		<?php }	?> -->

     <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">

          <tr>
            <td>
            <div class="error"><?php if ($flag == 1) echo $err_msg; ?></div>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="51%">Current phone number</td>
                <td width="49%">&nbsp;</td>
              </tr>
              <tr>
                <td><input type="text" name="phno" id="phno" readonly="readonly" disabled="disabled" value="<?php if(isset($_POST["btnPhnoUpdate"])) { echo $_POST["phno"];}else{ echo $phno;} ?>" class="edit_txtbox edit_360px"/></td>
                <td>&nbsp;</td>
              </tr>
               <tr>
                <td width="51%">New phone number</td>
                <td width="49%">&nbsp;</td>
              </tr>
              <tr>
                <td><input type="text" name="nphno" id="nphno" value="<?php if(isset($_POST["btnPhnoUpdate"])) { echo $_POST["nphno"];}else{ echo $nphno;} ?>" class="edit_txtbox edit_360px"/></td>
                <td>&nbsp;</td>
              </tr>
            </table>
            </td>
          </tr>

          <tr>
            <td><!-- To save these new settings, please enter your Jumblr password --></td>
          </tr>
         <!--  <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
             <tr>
                <td width="51%">Password</td>
                <td width="49%">&nbsp;</td>
              </tr>
              <tr>
                <td><input type="password" name="password" class="text_box12"/></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          </tr>-->
          <tr>
            <td><table width="300" border="0" align="left" cellpadding="0" cellspacing="0">
              <tr>
                <td><input type="submit" name="btnPhnoUpdate" class="save_btn_small" value="Save"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="cancel" class="cancel_btn" value="Cancel" onclick="cancelFields(this); return false;"/></td>
                <td></td>
              </tr>
            </table></td>
          </tr>
      </table></td>
    </tr>
  </table>
		</form>



		<table class="account_table" id="pass">
			<tr>
				<td width="160"><strong>Password</strong></td>
				<td width="160"> ***************</td>
				<td class="right_align"><a onclick="editFields(this); return false;" href="">Edit</a></td>
			</tr>
      	</table>

  <?php


	if(strtolower($_SERVER['REQUEST_METHOD']) == 'post' && $_POST["btnPassUpdate"]=='Save')
	{
		$flag = 0;
		$err_msg ='';

		//$image = $_FILES["image"]["name"];

		$new_password = $_POST["password"];
		$rpassword = $_POST["rpassword"];

		$ppassword = $_POST["ppassword"];
			if($new_password == '')
			{
				$err_msg = 'Please enter new password';
				$flag=1;
			}
			if($rpassword == '')
			{
				$err_msg = 'Please retype new password';
				$flag=1;
			}
			if($ppassword == '')
			{
				$err_msg = 'Please enter password';
				$flag=1;
			}
			if ($current_password != base64_encode($ppassword)) {
				$err_msg_red = 'Your password is not correct!';
				//$flag=1;
				$err_flag=1;
			}



		if($flag != 1 && $err_flag != 1) {	// && $current_password == base64_encode($ppassword)


				$sql_pass_update = "UPDATE ".TABLE_USERS." SET password='".base64_encode($new_password)."' WHERE user_id=".$user_id;
				mysql_query($sql_pass_update);
				$succ_msg = 'Password changes has been saved.';
				//$flag =2;

		}


	}

		?>

      <form name="frmpass" id="passForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" style="display:none;">
		<input type="hidden" name="tab_no" value="3">

	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="edit_table" >
   	 <tr>
      <td>

		<!--<?php
		if(strtolower($_SERVER['REQUEST_METHOD']) == 'post' && $_POST["btnPassUpdate"]=='Save') {
		?>
			<div style="height: 25px; width: auto; margin: 10px; padding: 5px; border: 1px dashed <?php if ($flag == 1) {echo "red";} else {echo "green"; } ?>;">
				<?php if($flag==1) { ?>
				<label style="color: #CC0000; font-weight: bold;"><?=$msg?></label>
				<?php } ?>
				<?php if($flag==2) { ?>
				<label style="color: #006600; font-weight: bold;"><?=$msg?></label>
				<?php }	?>
			</div>
		<?php }	?> -->
      <div id="pass_error_loc" class="error"><?php if ($err_flag == 1) {echo $err_msg_red;} ?></div>
     <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">

          <tr>
            <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
               <tr>
            <td width="51%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="51%">Current password</td>
                <td width="49%">&nbsp;</td>
              </tr>
              <tr>
                <td><input type="password" name="ppassword" class="edit_txtbox edit_360px" <?php if ($err_flag == 1) {echo 'style="border: 1px solid red;"';} ?>/></td>
                <td>&nbsp;</td>
              </tr>
          </table></td>
          </tr>
              <tr>
                <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="50%">New password </td>
                      <td width="50%">Confirm new password </td>
                    </tr>
                    <tr>
                      <td><input type="password" name="password" id="password" class="edit_txtbox"/></td>
                      <td><input type="password" name="rpassword" id="rpassword" class="edit_txtbox" onkeyup="javascript: return passMatch(); "/></td>
                    </tr>
                  </table></td>
              </tr>


            <!--  <tr>
                <td width="51%">Retype Password </td>
                <td width="49%">&nbsp;</td>
              </tr>
              <tr>
                <td><input type="password" name="rpassword" id="rpassword" class="text_box11"/></td>
                <td>&nbsp;</td>
              </tr> -->
            </table>
            </td>
          </tr>

          <tr>
            <td><!-- To save these new settings, please enter your Jumblr password --></td>
          </tr>

          <tr>
            <td><table width="300" border="0" align="left" cellpadding="0" cellspacing="0">
              <tr>
                <td><input type="submit" name="btnPassUpdate" class="save_btn_small" value="Save"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="button" name="cancel" class="cancel_btn" value="Cancel" onclick="cancelFields(this); return false;"/></td>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          </tr>
      </table></td>
    </tr>
  </table>
		</form>
<table style="border:none;" class="account_table" id="unsubscribe">
			<tr>
				<td colspan="3"><a onclick="javascript:  UnsubAll();" style="cursor: pointer;"><b>Unsubscribe from all Jumblr emails</b></a></td>
				<div id="unsubs_msg_loc"></div>
			</tr>
      	</table>

      	<form action="<?php echo SITE_URL.'customer-account.php?usucc=You\'ve unsubscribed from all emails&tab=subscriptions'; ?>" method="post" name="frm_unsub_all">
      		<input type="hidden" name="unsub_all" value="unsub_all" id="unsub_all">
      	</form>

      	<script type="text/javascript">
      		function UnsubAll() {
      			confirm('Are you sure you want to unsubscribe from all emails?');
      			document.frm_unsub_all.submit();
      		}
      	</script>

      	<?php
      		if (isset($_POST['unsub_all']) && $_POST['unsub_all'] == 'unsub_all') {


				$sql_delete = "DELETE FROM ".TABLE_USER_SUBSCRIPTION." WHERE user_id = $user_id";
				$result_delete = mysql_query($sql_delete);

      		}
      	?>
<script type="text/javascript">
function passMatch() {
	var newPass = document.getElementById('password').value;
	var newRPass = document.getElementById('rpassword').value;
	if (newPass != newRPass) {
		document.getElementById('pass_error_loc').innerHTML = "The password does not match!";
		document.getElementById('password').Style.border = "1px solid red";
		document.getElementById('rpassword').Style.border = "1px solid red";
		return false;
	}
	else {
		document.getElementById('pass_error_loc').innerHTML = "";
		document.getElementById('password').Style.border = "none";
		document.getElementById('rpassword').Style.border = "none";
	}
}

</script>

	<div class="main_box" >

	<?php
		$sql_extra_details = "SELECT * FROM getdeals_users WHERE user_id = $user_id";
		$extra_details = mysql_fetch_array(mysql_query($sql_extra_details));

		$likes = explode(',',$extra_details[likes]);
		//var_dump($extra_details);
	?>

    	<div class="title">Additional Informations (so we know you better)</div>
    	<form action="<?php echo $_SERVER[PHP_SELF]; ?>" method="post" name="">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="account_table2" style="border:0px;">
          <tr>
            <td colspan="2"><b>How old are you?</b></td>
          </tr>
          <tr>
            <td width="20"><input type="radio" name="radioage" id="radioage" value="18-25" <?php echo ($extra_details['age_range'] == '18-25'? "checked='checked'":""); ?>></td>
            <td>18-25</td>
          </tr>
          <tr>
            <td><input type="radio" name="radioage" id="radioage" value="26-55" <?php echo ($extra_details['age_range'] == '26-55'? "checked='checked'":""); ?>></td>
            <td>26-55</td>
          </tr>
          <tr>
            <td><input type="radio" name="radioage" id="radioage" value="36-45" <?php echo ($extra_details['age_range'] == '36-45'? "checked='checked'":""); ?>></td>
            <td>36-45</td>
          </tr>
          <tr>
            <td><input type="radio" name="radioage" id="radioage" value="46-55" <?php echo ($extra_details['age_range'] == '46-55'? "checked='checked'":""); ?>></td>
            <td>46-55</td>
          </tr>
          <tr>
            <td><input type="radio" name="radioage" id="radioage" value="55+" <?php echo ($extra_details['age_range'] == '55+'? "checked='checked'":""); ?>></td>
            <td>55+</td>
          </tr>


          <tr>
            <td colspan="2"><b>What do you like doing today?</b></td>
          </tr>
          <tr>
            <td><input type="checkbox" name="chklike[]" id="checkbox" value="Eating out" <?php echo (in_array('Eating out',$likes) == TRUE? "checked='checked'":""); ?>></td>
            <td>Eating out</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="chklike[]" id="checkbox" value="Going to comedy" <?php echo (in_array('Going to comedy',$likes) == TRUE? "checked='checked'":""); ?>></td>
            <td>Going to comedy</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="chklike[]" id="checkbox" value="Going to music gigs" <?php echo (in_array('Going to music gigs',$likes) == TRUE? "checked='checked'":""); ?>></td>
            <td>Going to music gigs</td>
          </tr>
           <tr>
            <td><input type="checkbox" name="chklike[]" id="checkbox" value="Going to the cinema" <?php echo (in_array('Going to the cinema',$likes) == TRUE? "checked='checked'":""); ?>></td>
            <td>Going to the cinema</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="chklike[]" id="checkbox" value="Going to the theare" <?php echo (in_array('Going to the theare',$likes) == TRUE? "checked='checked'":""); ?>></td>
            <td>Going to the theare</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="chklike[]" id="checkbox" value="Having my haircut / beauty treatments" <?php echo (in_array('Having my haircut / beauty treatments',$likes) == TRUE? "checked='checked'":""); ?>></td>
            <td>Having my haircut / beauty treatments</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="chklike[]" id="checkbox" value="Scoffin takeaways" <?php echo (in_array('Scoffin takeaways',$likes) == TRUE? "checked='checked'":""); ?>></td>
            <td>Scoffin takeaways </td>
          </tr>
          <tr>
            <td><input type="checkbox" name="chklike[]" id="checkbox" value="Shopping locally" <?php echo (in_array('Shopping locally',$likes) == TRUE? "checked='checked'":""); ?>></td>
            <td>Shopping locally </td>
          </tr>
          <tr>
            <td><input type="checkbox" name="chklike[]" id="checkbox" value="Watching or playing sports" <?php echo (in_array('Watching or playing sports',$likes) == TRUE? "checked='checked'":""); ?>></td>
            <td>Watching or playing sports</td>
          </tr>

          <tr>
            <td colspan="2"><b>What is your education status?</b></td>
          </tr>
          <tr>
            <td><input type="radio" name="radioedu" id="radioedu" value="Undergraduate Dergee" <?php echo ($extra_details['education'] == 'Undergraduate Dergee'? "checked='checked'":""); ?>></td>
            <td>Undergraduate Dergee</td>
          </tr>
          <tr>
            <td><input type="radio" name="radioedu" id="radioedu" value="Graduate dergee" <?php echo ($extra_details['education'] == 'Graduate dergee'? "checked='checked'":""); ?>></td>
            <td>Graduate dergee</td>
          </tr>
          <tr>
            <td><input type="radio" name="radioedu" id="radioedu" value="6th from college" <?php echo ($extra_details['education'] == '6th from college'? "checked='checked'":""); ?>></td>
            <td>6th from college</td>
          </tr>
          <tr>
            <td><input type="radio" name="radioedu" id="radioedu" value="Apprentices" <?php echo ($extra_details['education'] == 'Apprentices'? "checked='checked'":""); ?>></td>
            <td>Apprentices</td>
          </tr>
          <tr>
            <td><input type="radio" name="radioedu" id="radioedu" value="Vocational Course" <?php echo ($extra_details['education'] == 'Vocational Course'? "checked='checked'":""); ?>></td>
            <td>Vocational Course</td>
          </tr>
          <tr>
            <td><input type="radio" name="radioedu" id="radioedu" value="School leaver" <?php echo ($extra_details['education'] == 'School leaver'? "checked='checked'":""); ?>></td>
            <td>School leaver</td>
          </tr>


          <tr>
            <td colspan="2"><b>What is your income?</b></td>
          </tr>
          <tr>
            <td><input type="radio" name="radioincome" id="radioincome" value="Less than &pound;19,000" <?php echo ($extra_details['income'] == 'Less than 19,000'? "checked='checked'":""); ?>></td>
            <td>Less than <?php echo getSettings(currency_symbol);?>19,000</td>
          </tr>
          <tr>
            <td><input type="radio" name="radioincome" id="radioincome" value="&pound;20,000 - &pound;26,000" <?php echo ($extra_details['income'] == '20,000 - 26,000'? "checked='checked'":""); ?>></td>
            <td><?php echo getSettings(currency_symbol);?>20,000 - <?php echo getSettings(currency_symbol);?>26,000</td>
          </tr>
          <tr>
            <td><input type="radio" name="radioincome" id="radioincome" value="&pound;27,000 - &pound;34,000" <?php echo ($extra_details['income'] == '27,000 - 34,000'? "checked='checked'":""); ?>></td>
            <td><?php echo getSettings(currency_symbol);?>27,000 - <?php echo getSettings(currency_symbol);?>34,000</td>
          </tr>
          <tr>
            <td><input type="radio" name="radioincome" id="radioincome" value="&pound;35,000 - &pound;44,000" <?php echo ($extra_details['income'] == '35,000 - 44,000'? "checked='checked'":""); ?>></td>
            <td><?php echo getSettings(currency_symbol);?>35,000 - <?php echo getSettings(currency_symbol);?>44,000</td>
          </tr>
          <tr>
            <td><input type="radio" name="radioincome" id="radioincome" value="&pound;45,000 - &pound;69,000" <?php echo ($extra_details['income'] == '45,000 - 69,000'? "checked='checked'":""); ?>></td>
            <td><?php echo getSettings(currency_symbol);?>45,000 - <?php echo getSettings(currency_symbol);?>69,000</td>
          </tr>
          <tr>
            <td><input type="radio" name="radioincome" id="radioincome" value="Over &pound;70,000" <?php echo ($extra_details['income'] == 'Over 70,000'? "checked='checked'":""); ?>></td>
            <td>Over <?php echo getSettings(currency_symbol);?>70,000</td>
          </tr>


           <tr>
            <td colspan="2"><b>What is your marital status?</b></td>
          </tr>
          <tr>
            <td><input type="radio" name="radiomstatus" id="radiomstatus" value="Single" <?php echo ($extra_details['m_status'] == 'Single'? "checked='checked'":""); ?>></td>
            <td>Single</td>
          </tr>
          <tr>
            <td><input type="radio" name="radiomstatus" id="radiomstatus" value="Married" <?php echo ($extra_details['m_status'] == 'Married'? "checked='checked'":""); ?>></td>
            <td>Married</td>
          </tr>
          <tr>
            <td><input type="radio" name="radiomstatus" id="radiomstatus" value="Living with partner" <?php echo ($extra_details['m_status'] == 'Living with partner'? "checked='checked'":""); ?>></td>
            <td>Living with partner</td>
          </tr>
          <tr>
            <td><input type="radio" name="radiomstatus" id="radiomstatus" value="Separated / divorced / widowed" <?php echo ($extra_details['m_status'] == 'Separated / divorced / widowed'? "checked='checked'":""); ?>></td>
            <td>Separated / divorced / widowed</td>
          </tr>


          <tr>
            <td colspan="2"><b>What is your work status?</b></td>
          </tr>
          <tr>
            <td><input type="radio" name="radiowstatus" id="radiowstatus" value="Full time" <?php echo ($extra_details['work_status'] == 'Full time'? "checked='checked'":""); ?>></td>
            <td>Full time</td>
          </tr>
          <tr>
            <td><input type="radio" name="radiowstatus" id="radiowstatus" value="Student" <?php echo ($extra_details['work_status'] == 'Student'? "checked='checked'":""); ?>></td>
            <td>Student</td>
          </tr>
          <tr>
            <td><input type="radio" name="radiowstatus" id="radiowstatus" value="Retired / unemployed" <?php echo ($extra_details['work_status'] == 'Retired / unemployed'? "checked='checked'":""); ?>></td>
            <td>Retired / unemployed</td>
          </tr>
          <tr>
            <td><input type="radio" name="radiowstatus" id="radiowstatus" value="Household keeper" <?php echo ($extra_details['work_status'] == 'Household keeper'? "checked='checked'":""); ?>></td>
            <td>Household keeper</td>
          </tr>

          <tr>
            <td colspan="2" style="padding:8px 0 0 5px;"><input type="submit" name="btnExtraUpdate" class="save_btn_small_details" value="Save Details"/></td>
          </tr>

        </table>
		</form>

		<?php
			if ($_POST['btnExtraUpdate'] && $_POST['btnExtraUpdate'] == "Save Details") {

				foreach ($_POST['chklike'] as $value) {
					$like  .= $value.',';
				}

				$age = $_POST['radioage'];
				//$like = $_POST['chklike'];
				$edu = $_POST['radioedu'];
				$income = $_POST['radioincome'];
				$mstatus = $_POST['radiomstatus'];
				$wstatus = $_POST['radiowstatus'];

				$sql_extra_update = "UPDATE ".TABLE_USERS." SET age_range='".$age."', education='".$edu."', income='".$income."', likes='".$like."', m_status='".$mstatus."', work_status='".$wstatus."' WHERE user_id=".$user_id;
				mysql_query($sql_extra_update);
				$succ_msg1 = 'Your details have been updated.';
				header('location:'.SITE_URL.'customer-account.php?usucc='.$succ_msg1.'&tab=account');

			}

		?>


    </div>

	</div>
	<!-- 3 ends here  -->


	<div class="TabbedPanels1" id="myaccount_4" style="display:none;">
		<div class="title"><span class="float_left">Royal Points</span> <span class="float_right" style="font-size:15px;">
			<img alt="" src="images/star.png" height="18" width="17" style="margin: 0 0 0 0; float:left;" align="absmiddle">&nbsp;Royal Points: <strong style="color:#217CED;">0</strong></span>
		</div>

		<div class="content_box3">
          <h4>What is Royal Points?</h4>
          <p>
            At Jumblr we want to give our customers more than  just a great deal. We give our customers royal points and all of our members  are eligible to the royal points reward. It works in a simple yet effective way  to that you don&rsquo;t even notice. Whenever you return to <a href="http://www.Jumblr.com">www.Jumblr.com</a> and buy a deal then our  system will credited your account with 10 royal points. When your account royal  points reach 100 then you will get 25% discount on any deal so it&rsquo;s like double  discount.</p>
          <p><strong>Example:</strong><br />
           You have bought lots of deals and your account royal  points is 100 and you buy a Samsung TV deal which costs <?php echo getSettings(currency_symbol);?>100.00. But since you  have 100 royal points you only have to pay <?php echo getSettings(currency_symbol);?>75.00 instead of <?php echo getSettings(currency_symbol);?>100.00  (<?php echo getSettings(currency_symbol);?>;100.00/100*25%). However there is one tiny limitation, your account cannot go  above 100 royal points.</p>

          <h4>How long is my royal points valid until?</h4>
         <p> Once your account has reached 100 royal points then you have  45 days to use it on any deal. After 45 days is you haven&rsquo;t used your points  then it will automatically go back to &ldquo;0&rdquo; (ZERO) so be sure to use it.</p>


          <h4>Can I use my royal points on anything?</h4>
          <p>Yes! You can use your royal points on any deal featured on Jumblr.</p>

		  <p><span style="color:red;">IMPORTANT:</span> We will automatically reduct the 25% of the  original price of the deal if you have 100 royal points.</p>


       </div>


	</div>
	<!-- 4 ends here  -->

	<div class="TabbedPanels1" id="myaccount_5" style="display:none;">
	<div class="title">Subscriptions<span id="subs_msg_loc" style="margin-left: 100px;"></span></div>
    <div class="content_box3">
	<h4>My daily emails</h4>

	<!--<table class="myaccount" id="noti">
			<tr>
				<td style="float:left; width: 160px; margin: 0 auto;"><p>Notifications</p></td>
				<td style="float:left; width: 170px; margin: 0 auto;"><p>Test</p></td>
				<td style="float:right; width: 30px; margin: 0 30px;"><p><a onclick="editFields(this); return false;" href="">Edit</a></p></td>
			</tr>
     </table>-->



     <table class="myaccount" id="noti" style="width:100%;">
			<?php
			//SELECT * FROM ".TABLE_USER_SUBSCRIPTION." WHERE user_id = $user_id
			$country = 225;
			$show_city = mysql_query("
									SELECT *
									FROM getdeals_user_subscriptions
									INNER JOIN getdeals_cities ON getdeals_user_subscriptions.city_id = getdeals_cities.city_id
									WHERE user_id =$user_id
									AND country_id =$country
									GROUP BY city_name ASC
			");
			$show_city_num_row = mysql_num_rows($show_city);

			/*SELECT * FROM getdeals_user_subscriptions INNER JOIN getdeals_cities ON getdeals_user_subscriptions.city_id=getdeals_cities.city_id WHERE user_id = 11 AND country_id= 225 GROUP BY city_name ASC*/

			/* */
			$get_national_deal = mysql_num_rows(mysql_query("SELECT * FROM ".TABLE_USER_SUBSCRIPTION." WHERE user_id = $user_id AND city_id = -1"));

		if ($show_city_num_row <= 0 && $get_national_deal != 1) {

	?>
    	<p>Not yet subscribed.</p>
    <?php } else { ?>
			<tr><p>I am currently subscribed to</p>
			  <td>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td><p>
					<?php
					//$city_id = $_GET['city_id'];
					/*$get_national_deal = mysql_num_rows(mysql_query("SELECT * FROM ".TABLE_USER_SUBSCRIPTION." WHERE user_id = $user_id AND city_id = -1"));
					if ($get_national_deal >= 1) {
						echo '<div class="list_box">National Deal</div>';
					}*/
				?>
				<?php while ($show_city_list = mysql_fetch_array($show_city)) {
						//$country = 225;
						//echo $sql_city = "SELECT * FROM ".TABLE_CITIES."  WHERE country_id = $country AND city_id = $show_city_list[city_id] GROUP BY city_name ASC";
						//$result_city = mysql_query($sql_city);
						//$row_city_1 = mysql_fetch_array($result_city);
					?>

					<div class="list_box"><?php echo $show_city_list['city_name']; ?></div>
				<?php } ?>
				</p></td>
				  </tr>
				</table>
				</td>
			</tr>
			<?php } // End else?>

			<tr>
				<td style="float:right; width: 30px; margin: 0 30px;"><p><a onclick="editFields(this); return false;" href="">Edit</a></p></td>
			</tr>

     </table>
  </div>

	<form name="frmnotification" id="notiForm" method="post" action="<?php echo SITE_URL; ?>customer-account.php?usucc=Your subscription settings has been updated." enctype="multipart/form-data" style="display:none;">

	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="purchase_history">
      <tr>
        <td>
           <div class="float_left" style="padding-right:84px;"><img src="images/green_thick.gif" alt="" class="float_left"/>Select the cities you want to recieve deal alerts for:</div>
           <div class="skinned-form-controls skinned-form-controls-mac">
	           <?php
					//$city_id = $_GET['city_id'];
					$get_national_deal = mysql_num_rows(mysql_query("SELECT * FROM ".TABLE_USER_SUBSCRIPTION." WHERE user_id = $user_id AND city_id = -1"));
				?>

	           <input type="checkbox"  name="nationaldeal" id="nationaldeal" value="-1" onclick="javascript: return ajaxReq(this.value);" <?php if ($get_national_deal >= 1) echo 'readonly="readonly" checked="checked" ' ?>/>
	           <span <?php if ($get_national_deal >= 1) echo 'readonly="readonly" checked="checked" ' ?>>National Deal</span>
	       </div>
        </td>
      </tr>
      <tr>
      	<td>
		<?php
			$user_id = $_SESSION['user_id'];
			$country = 225;

			$sql_city = "SELECT * FROM ".TABLE_CITIES."  WHERE country_id = $country GROUP BY city_name ASC";
			$result_city = mysql_query($sql_city);
		?>
        	<?php
					while($row_city = mysql_fetch_array($result_city)) {
				?>

				<?php
					//$city_id = $_GET['city_id'];
					$get_city = mysql_num_rows(mysql_query("SELECT * FROM ".TABLE_USER_SUBSCRIPTION." WHERE user_id = $user_id AND city_id = $row_city[city_id]"));
				?>


			<div class="deal_list skinned-form-controls skinned-form-controls-mac">

				<input type="checkbox" name="<?php echo $row_city["city_name"]; ?>" id="<?php echo $row_city["city_name"]; ?>" value="<?php echo $row_city["city_id"]; ?>" onclick="javascript: return ajaxReq(this.value);" <?php if ($get_city >= 1) echo 'readonly="readonly" checked="checked" ' ?>/>

				<span <?php if ($get_city >= 1) echo 'style="color: green"' ?>><?php echo $row_city["city_name"]; ?></span>
			</div>

            <?php } ?>

        </td>
      </tr>
      <tr>
      	<td style="border: none;">
      		<input type="submit" name="cancel" style="font-size: 18px; margin-left: -6px !important;" class="save_btn_small" value="Save" onclick="cancelFields(this); return false;"/>
      	</td>
      </tr>
    </table>

		</form>


	</div>
	<!-- 5 ends here  -->

	<div class="TabbedPanelsContent" id="myaccount_6" style="display:none;">
		<div class="title">Purchase History</div>
    <?php
		$sql_purchase_history = "SELECT * FROM ".TABLE_TRANSACTION." WHERE user_id = $_SESSION[fb_id]";
		$purchase_history_res = mysql_query($sql_purchase_history);
		$purchase_history_num = mysql_num_rows($purchase_history_res);
		$count = 0;

	?>

       <?php
       if ($purchase_history_num <= 0) {
		?>
		<!--<p style="font-family: Helvetica; font-size: 16px;">You haven&rsquo;t made any purchases yet!</p>-->
       <h4>You haven&rsquo;t made any purchases yet!</h4>
		<p style="font-family: Helvetica; font-size: 12px;">As  you purchase Jumblr deals, this page will contain a history of all purchased  items for your personal reference.</p>
		<?php
		}
		else {
       ?>
       <table width="100%" border="0" cellspacing="0" cellpadding="0" class="transactions_box3">
          <tr>
            <th style="width:114px;">Purchased date</th>
            <th style="width:114px;">Deal Number</th>
            <th style="width:114px;">Quantity</th>
            <th style="width:114px;">Jumblr Code</th>
            <th style="width:114px;">Savings</th>
            <th style="width:114px;">Price</th>
          </tr>
      </table>
       <table width="100%" border="0" cellspacing="0" cellpadding="0" class="purchase_history">

          <?php
          	while ($purchase_history_row = mysql_fetch_array($purchase_history_res)) {
			$deal_details = get_deal_details($purchase_history_row['deal_id']);
			$pur_date = $purchase_history_row["transaction_date"];
			$pur_date_formated = strftime("%d/%m/%Y", strtotime($pur_date));

			$start_date = reset(explode(" ",$deal_details["deal_start_time"]));
			$end_date = reset(explode(" ",$deal_details["deal_end_time"]));
			//$end_date_formated = strftime("%d %B %Y", strtotime($end_date));

			$start_date_formated = strftime("%d/%m/%Y",strtotime($start_date));
			$end_date_formated = strftime("%d/%m/%Y",strtotime($end_date));


			$count++;
          ?>

          <tr>
            <td style="width:114px;"><?php echo $pur_date_formated; ?></td>
            <td style="width:114px;">Deal Number <?php echo $count; ?></td>
            <td style="width:114px;"><?php echo $purchase_history_row['qty']; ?></td>
            <td style="width:114px;"><?php echo $purchase_history_row['coupon_code']; ?></td>
            <td style="width:114px;"><?php echo getSettings(currency_symbol);?><?php echo $deal_details['savings']; ?></td>
            <td style="width:114px;"><?php echo getSettings(currency_symbol);?><?php echo $purchase_history_row['amount']; ?></td>
          </tr>

          <?php } ?>

      </table>
		<?php } //End else ?>
	</div><!-- 6 ends here  -->

	<div class="TabbedPanelsContent" id="myaccount_7" style="display:none;">
		<div class="title">Add new Jumble!</div>
			<!-- Deal add form starts -->

			<script type="text/javascript">
				function divopen(id)
				{
					var i;
					for(i=1; i<=4; i++)
					{
						document.getElementById("dealtab_"+i).style.display = 'none';
					}
					document.getElementById("dealtab_"+id).style.display = 'block';
				}

				function numbersonly(e){
					var unicode=e.charCode? e.charCode : e.keyCode
					if (unicode!=8){ //if the key isn't the backspace key (which we should allow)
					if (unicode<48||unicode>57) //if not a number
					return false //disable key press
					}
				}

				function calculatedeal(boxname){
					retail=parseFloat(document.getElementById('retailvalue').value);
					discount=parseFloat(document.getElementById('customerdisc').value);
					merchant=parseFloat(document.getElementById('merchant_take').value);

					custpercent=parseFloat(document.getElementById('custpercent').value);
					merchantpercent=parseFloat(document.getElementById('merchantpercent').innerHTML);
					wakadealpercent=parseFloat(document.getElementById('wakadealpercent').innerHTML);

					if(retail<=0 || discount<=0 || merchant<=0 || isNaN(retail)==true || isNaN(discount)==true || isNaN(merchant)==true ){
					return false;
					}
					if(discount>retail-1){
					return false;
					}



					merchantpercent=100-wakadealpercent;
					document.getElementById('merchantpercent').innerHTML=merchantpercent;
					document.getElementById('mpercent').value=merchantpercent;


					if(retail>0){
							custvalue=retail*(custpercent/100);
							//document.getElementById('customerdisc').value=custvalue;
							discountprice=retail-discount;
							custpercent=(parseFloat(discountprice)/parseFloat(retail))*100;
							document.getElementById('custpercent').value=parseInt(custpercent);


							merchantvalue=discount*(merchantpercent/100);
							document.getElementById('merchant_take').value=merchantvalue.toFixed(2);

							wakadealvalue=discount*(wakadealpercent/100);

							document.getElementById('wakafee').value=wakadealvalue.toFixed(2);
							document.getElementById('wakadealfee').value=wakadealvalue.toFixed(2);

					totalv=parseFloat(merchantvalue)+parseFloat(wakadealvalue);

					document.getElementById('title1').innerHTML="$"+(totalv.toFixed(2))+" for $"+retail.toFixed(2)+" at "+document.getElementById('storename').value+"<br />"+custpercent.toFixed(2)+" % off "+document.getElementById('description').value;


					document.getElementById('title2').innerHTML="$"+(totalv.toFixed(2))+" for "+document.getElementById('description').value+" at "+document.getElementById('storename').value+"<br />"+custpercent.toFixed(2)+" % off ";

					document.getElementById('title11').value=document.getElementById('title1').innerHTML;
					document.getElementById('title22').value=document.getElementById('title2').innerHTML;



					}
				}
			</script>

			<?php

				/*
				 *
				 * Array
					(
					    [storename] =>
					    [retailvalue] => 20
					    [customerdisc] => 10
					    [custpercent] => 50
					    [merchant_take] => 6.50
					    [merchantpercent] => 65
					    [wakadealfee] => 3.50
					    [wakapercent] => 35
					    [description] => eg. food & drink or travel
					    [deal_cat] =>
					    [website] =>
					    [deal_start_time] =>
					    [deal_end_time] =>
					    [max_coupons] =>
					    [status] => 1
					    [offer_details] =>
					    [store_id] =>
					    [submit] => Submit
					)
				 *
				 */

				if ($_POST['submit'] == "Submit") {
					//echo '<pre>'.print_r($_SESSION, true).'</pre>';
					$data[title] = $_POST[title];
					$data[admin_id] = $_SESSION[fb_id];
					$data[deal_type] = 'user_deal';
					$data[full_price] = $_POST[retailvalue];
					$data[discounted_price] = $_POST[customerdisc];
					$data[savings] = $_POST[retailvalue] - $_POST[customerdisc];
					$data[discount] = $_POST[custpercent];
					$data[merchant_take] = $_POST[merchant_take];
					$data[merchantpercent] = $_POST[merchantpercent];
					$data[jumblr_comission] = $_POST[wakadealfee];
					$data[waka_percent] = $_POST[wakapercent];
					$data[description] = $_POST[description];
					$data[deal_cat] = $_POST[deal_cat];
					$data[city] = $_POST[city];
					$data[website] = $_POST[website];
					$data[deal_start_time] = date("Y-m-d G:i", strtotime($_POST[deal_start_time]));	//2012-07-24 00:00:00
					$data[deal_end_time] = date("Y-m-d G:i", strtotime($_POST[deal_end_time]));
					$data[max_coupons] = $_POST[max_coupons];
					$data[status] = $_POST[status];
					$data[offer_details] = $_POST[offer_details];
					$data[deal_image] = $_POST[files];
					$data[is_multi] = 'n';
					$data[place_lat] = $_POST['lat'];
					$data[place_lng] = $_POST['lng'];
					//$data[] = $_POST[store_id];
					//$data[] = $_POST[submit];
					//echo '<pre>'.print_r($data, true).'</pre>';
					if ($data[title] ==!'' || $data[full_price] ==!'' || $data[description] ==!'' || $data[deal_start_time] ==!'' || $data[deal_end_time] ==!'' || $data[max_coupons] ==!'' || $data[offer_details] ==!'') {
					$lstInsertID = $db->query_insert(TABLE_DEALS, $data);
					}
					$dataimg['deal_id']=$lstInsertID;
					$db->query_update(TABLE_DEAL_IMAGES, $dataimg, "deal_id='".$_SESSION["session_temp"]."'");
					$_SESSION['msg']="Deal is updated successfully.";
					//exit();
				}
			?>

<!--  --><form action="" method="post">
			<div id="dealtab_1" style="display:block">
				<div class="title_txt">Jumblr! <!--Now!--> helps you to be a part!</div>
				<div class="main_box">
				<div class="each_box">
				<img src="images/core.jpg" alt="" width="191" height="138"/>
				<strong>Step:1 Core Details</strong> <br />
				In this section Merchants have to provide the basic details related to a particular Deal.
				</div>
				<div class="each_box">
				<img src="images/details.jpg" alt="" width="191" height="138"/>
				<strong>Step:2 Deal Restriction</strong> <br />
				Deals Restriction i.e., whether the Deal is Active or Upcoming or Inactive are specified in this section accordingly.
				</div>
				<div class="each_box">
				<img src="images/last_stp.jpg" alt="" width="191" height="138"/>
				<strong>Step:3 Enticing Deal Description</strong> <br />
				Basic Description related to a Deal are fed herein.
				</div>
				<div class="clear"></div>
				</div>
				<div class="main_box">
				<ul class="list_txt">
				<li>Jumblr is easy to Use and enough user friendly</li>
				<li>Jumblr gives easy access to the Merchant as well as to the user section.</li>
				<li>Jumblr is easy to add Deals along with all the transactional functionalities.</li>
				<!--<li>Jumblr are </li>
				<li>Jumblr Now! gives you the power to stay bu new</li>-->
				</ul>
				<div class="clear"></div>
				</div>
				<div style="text-align: right;"><input type="button" name="next" value="Start" onclick="javascript: divopen(2)" class="submit" style="width:80px; height:30px; cursor:pointer;" /></div>
				<div class="clear"></div>
			</div>

			<div id="dealtab_2" style="display:none;">
				<div class="step_01 active" style="margin-left:15px;">Step 1</div><div class="step_01">Step 2</div><div class="step_01">Step 3</div>
				<div class="clear"></div>
				<div class="clear"></div>
				<fieldset class="fieldset">
				<legend>Core Details</legend>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
				<td>
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="cart_box" style="border:0px;">

				<tr class="gray_02">
				<?php
				$description=isset($row_deal['description'])?$row_deal['description']:'eg. food & drink or travel';
				?>
				<td align="right" ><strong>Title:</strong></td>
				<td style="padding-left:10px;"><input type="text" size="100" class="lf" name="description" id="description" value="<?php echo $description?>"  onkeyup="calculatedeal('')" onClick="if(this.defaultValue==this.value) this.value=''"      onblur="if (this.value=='') this.value=this.defaultValue"/></td>
				</tr>

				<tr class="gray_02">
				<td align="right" width="100"><strong>Price Details:</strong></td>
				<td><br />
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="cart_box" style="background:#f00;">
				<tr style="background-color:#000000;">
				<td style="padding:5px;">Regular Price</td>
				<td style="padding:5px;">Discount Price</td>
				<td style="padding:5px;">% Off</td>
				<td style="padding:5px;">Merchant's Take</td>
				<td style="padding:5px;">Jumblr Fee</td>
				</tr>
				<?php


				$sql = "SELECT * FROM `".TABLE_SETTING."` WHERE name='dailydeal_fee'";
				$fee = $db->query_first($sql);
				$retailvalue=isset($row_deal['full_price'])?$row_deal['full_price']:20;
				$customerdisc=isset($row_deal['discounted_price'])?$row_deal['discounted_price']:10;
				$custpercent=isset($row_deal['custpercent'])?$row_deal['custpercent']:50;
				$merchant_take=isset($row_deal['merchant_take'])?$row_deal['merchant_take']:7.5;
				$merchantpercent=isset($row_deal['merchantpercent'])?$row_deal['merchantpercent']:75;
				$waka_percent=isset($row_deal['waka_percent'])?$row_deal['waka_percent']:$fee['value'];
				$wakadeal_comission=isset($row_deal['wakadeal_comission'])?$row_deal['wakadeal_comission']:2.5;
				?>
				<tr style="background-color:#F3F3F3">
				<input type="hidden" value="<?php echo $row_stores['store_name'];?>" name="storename"  id="storename" />
				<td class="dealcalctxtbox"><?php echo $currency; ?>
				<input type="text" id="retailvalue" name="retailvalue" value="<?php echo $retailvalue?>" class="dealcalcbox"  onkeyup="calculatedeal('retail')" onBlur="calculatedeal('retail')" onKeyPress="return numbersonly(event)" style="height:20px;"/><br /><span id="err_retailvalue"></span></td>
				<td class="dealcalctxtbox"><?php echo $currency; ?>
				<input type="text" id="customerdisc" name="customerdisc" class="dealcalcbox" style="height:20px;"  value="<?php echo $customerdisc?>" onKeyUp="calculatedeal('customer')" onBlur="calculatedeal('customer')" onKeyPress="return numbersonly(event)" /><span id="err_customerdisc"></span></td>
				<td style="padding:4px; text-align:center"><input type="text" id="custpercent" value="<?php echo $custpercent?>" name="custpercent" size="2" readonly="" class="dealcalcbox" style="height:20px;">
				%</td>
				<td class="dealcalctxtbox"><?php echo $currency; ?>
				<input type="text" id="merchant_take"  name="merchant_take"  size="5"  value="<?php echo $merchant_take?>"  readonly="" class="dealcalcbox" style="height:20px;"/>
				<input type="hidden" name="merchantpercent" id="mpercent" value="<?php echo $merchantpercent?>" class="dealcalcbox" style="height:20px;"/>
				<span id="merchantpercent">75</span>%</td>
				<td style="padding:4px; text-align:center"><?php echo $currency; ?>
				<input type="text" value="<?php echo $wakadeal_comission?>" readonly="" id="wakafee"  size="5" class="dealcalcbox" style="height:20px;">
				&nbsp;&nbsp;&nbsp; <span  id="wakadealpercent"><?php echo $waka_percent?></span>%
				<input type="hidden" name="wakadealfee" id="wakadealfee" value="<?php echo $wakadeal_comission?>" />
				<input type="hidden" name="wakapercent" id="wakapercent" value="<?php echo $waka_percent?>" />
				</td>
				</tr>
				</table></td>
				</tr>

				<tr class="gray_02">
				<td align="right" style="vertical-align:top"><strong># Available:</strong></td>
				<td><input type="text" name="max_coupons" id="max_coupons" size="10" value="<?php echo stripslashes($row_deal['max_buy']);?>" class="lf"/></td>
				</tr>

				<tr class="gray_02">
				<td align="right" style="vertical-align:top"><strong>Choose your deal's title:</strong></td>
				<td style="border:0px;">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:0px;">
				<tr>
				<td  style="text-align:right; vertical-align:top; width:10px; border:0px; border-bottom:1px solid #fff;"><input type="radio" value="title1" id="title11"   name="title" onClick="this.value=document.getElementById('title1').innerHTML;document.getElementById('title22').checked=false" <?php if(!empty($row_deal['title'])){ echo "checked";}?>  /></td>
				<td style="border:0px; border-bottom:1px solid #fff;"><span id='title1' ><?php echo $currency; ?>10 for <?php echo $currency; ?>20 at Kates Cars<br />50% off desc test cx sdfsd</span><br />
				<br />
				</td>
				</tr>
				<tr>
				<td style="text-align:right; vertical-align:top; width:10px; border:0px;"><input type="radio" value="title2" id="title22"  name="title" onClick="this.value=document.getElementById('title2').innerHTML;document.getElementById('title11').checked=false" <?php if(!empty($row_deal['title2'])){ echo "checked";}?>/></td>
				<td style="border:0px;"><span id='title2' ><?php echo $currency; ?>10 for <?php echo $currency; ?>20 at Kates Cars<br />
				50% off desc test cx sdfsd</span></td>
				</tr>
				</table></td>
				</tr>
				<tr class="gray_02">
				<td align="right" style="vertical-align:top"><strong>Deal Category:</strong></td>
				<td> <select style="width:226px;" name="deal_cat" class="dropdown" id="deal_cat" onChange="getCity('<?php echo SITE_URL;?>findsubcat?cat_id='+this.value)" size="1">
				<option value="">-- Select --</option>
				<?php

				$sql_categories=mysql_query("select cat_name,cat_id from " .TABLE_CATEGORIES." where parent_id=0 order by cat_name asc");
				while($row_categories=mysql_fetch_array($sql_categories))
				{
				?>

				<option value="<?php echo $row_categories[cat_id];?>" <?php if($row_categories[cat_id]==$row_deal[deal_cat]) { echo "selected"; }?>><?php echo $row_categories[cat_name];?></option>
				<?php
				}
				?>
				</select></td>
				</tr>
				<tr class="gray_02">
				<td align="right" style="vertical-align:top"><strong>Website:</strong></td>
				<td><input type="text" name="website" id="website" size="54" value="<?php echo stripslashes($row_deal[website]);?>" class="lf"/></td>
				</tr>
				<tr class="gray_02">
				<td align="right" style="vertical-align:top"><strong>Deal Start Time:</strong></td>
				<td><!--<input type="text" name="deal_start_time" id="my_date_field" size="20" value="<?php //if(!empty($row_deal['deal_start_time'])){echo date("Y-m-d H:i",strtotime($row_deal['deal_start_time']));}?>" class="lf"/>-->
				<!--  --><input type="text" name="deal_start_time" id="date" size="20" value="<?php if(!empty($row_deal['deal_start_time'])){echo date("Y-m-d 03:00",strtotime($row_deal['deal_start_time']));}?>" class="lf" onclick='fPopCalendar("date")' />
				<script type="text/javascript">
			 		var j = jQuery.noConflict();
			 		jQuery('#date').datetimepicker();
				</script>
				</td>
				</tr>
				<tr class="gray_02">
				<td align="right" style="vertical-align:top"><strong>Deal End Time:</strong></td>
				<td><!--<input type="text" name="deal_end_time" id="my_date_field2" size="20" value="<?php  //if(!empty($row_deal['deal_end_time'])){echo date("Y-m-d H:i",strtotime($row_deal['deal_end_time']));}?>" class="lf"/>-->
				<input type="text" name="deal_end_time" id="date1" size="20" value="<?php  if(!empty($row_deal['deal_end_time'])){echo date("Y-m-d H:i",strtotime($row_deal['deal_end_time']));}?>" class="lf" onclick='fPopCalendar("date1")' />
				<script type="text/javascript">
			 		var j = jQuery.noConflict();
			 		jQuery('#date1').datetimepicker();
				</script>
				</td>
				</tr>
				<!--
				<tr class="gray_02">
				<td align="right" style="vertical-align:top"><strong>Max Buy:</strong></td>
				<td><input type="text" name="max_coupons" id="max_coupons" size="10" value="<?php echo stripslashes($row_deal['max_buy']);?>" class="lf"/></td>
				</tr>
				 -->
				 <tr class="gray_02">
				<td align="right" style="vertical-align:top"><strong>Location:</strong></td>
				<td>
					<select name="city" class="dropdown" id="city" size="1">
							<option value="">-- Select --</option>
							<!-- <option value="-1" <?php if($row_deals[best_deal]=='y') { echo "selected"; }?>>National Deal</option> -->
                                <?php

								echo $sql_city = mysql_query("select * FROM " .TABLE_CITIES." where status = 1 order by city_name asc");
								while($row_city = mysql_fetch_array($sql_city))
								{
							?>

									<option value="<?php echo $row_city[city_id];?>" <?php if($row_city[city_id]==$row_deals[city]) { echo "selected"; }?>><?php echo $row_city[city_name];?></option>
							<?php
								}
							?>

                	</select>
				</td>
				</tr>
				<tr class="gray_02">
				<td colspan="2" align="center" style="padding-left: 300px;"><input type="button" name="back" value="Back" onclick="javascript: divopen(1)" class="submit" style="width:80px; height:30px; cursor:pointer;" />
				<input type="button" name="next" value="Next" onclick="javascript: divopen(3); init();" class="submit" style="width:80px; height:30px; cursor:pointer;" onmouseover="return checkcore();" />
				</tr>
				</table>
				</td>
				</tr>
				</table>
				</fieldset>
			</div>

			<div id="dealtab_3" style=" display:none">

				<div class="step_01 active" style="margin-left:15px;">Step 1</div><div class="step_01 active">Step 2</div><div class="step_01">Step 3</div>
				<div class="clear"></div>

				<fieldset class="fieldset">
				<legend>Deal Restriction</legend>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
				<td>
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="cart_box" style="border:0px;">
				<tr class="gray_02">
				<td align="right" style="vertical-align:top"><strong>Status:</strong></td>
				<td>
				<select name="status" id="status" class="NFSelect" style="width:226px;">
				<option value="1" <?php if($row_deal['status']=='1'){echo "Selected";}?>>Active</option>
				<option value="0" <?php if($row_deal['status']=='0'){echo "Selected";}?>>Inactive</option>
				<option value="2" <?php if($row_deal['status']=='2'){echo "Selected";}?>>Upcoming</option>
				<option value="3" <?php if($row_deal['status']=='3'){echo "Selected";}?>>End</option>
				</select>
				</td>

				</tr>
				<tr class="gray_02">
				<td align="right" style="vertical-align:top"><strong>Location:</strong></td>
				<td>
				 <div id="mapCanvas" style="width: 700px;"></div>
				 <div id="displaycsv" style="margin-top:10px;overflow:auto;padding:10px;border:0px solid ;"></div>
				<input type="hidden" name="lat" id="lat" value="0"/>
				<input type="hidden" name="lng" id="lng" value="0"/>
				</td></tr>

				<tr class="gray_02">
				<td colspan="2" align="center" style="padding-left: 300px;"><input type="button" name="back" value="Back" onclick="javascript: divopen(2)" class="submit" style="width:80px; height:30px; cursor:pointer;" />
				<input type="button" name="next" value="Next" onclick="javascript: divopen(4)" class="submit" style="width:80px; height:30px; cursor:pointer;" />
				</tr>

				</table>
				</td>
				</tr>
				</table>

				</fieldset>

			</div>

			<div id="dealtab_4" style="display:none" >

				<div class="step_01 active" style="margin-left:15px;">Step 1</div><div class="step_01 active">Step 2</div><div class="step_01 active">Step 3</div>
				<div class="clear"></div>

				<fieldset class="fieldset">

				<legend>Enticing Deal Description</legend>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
				<td>
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="cart_box" style="border:0px;">
				<tr class="gray_02">
				<td align="right" style="vertical-align:top"><strong>Details:</strong></td>
				<td><?php
				$oFCKeditor = new FCKeditor('offer_details');
				$oFCKeditor->BasePath = 'fckeditor/';
				$oFCKeditor->Value = stripslashes($row_deal['offer_details']) ;
				$oFCKeditor->Width = '100%' ;
				$oFCKeditor->Height = '200' ;
				$oFCKeditor->ToolbarSet = 'Basic';
				$oFCKeditor->Create();
				?>	</td>

				</tr>

				<tr class="gray_02">
				<td colspan="2" align="center" style="padding-left: 300px;">  <input type="hidden" class="submit" name="store_id" value="<?php echo $store_id?>" />
				<!--
				<input type="button" name="back" value="Back" onclick="javascript: divopen(3)" class="submit" style="width:80px; height:30px; cursor:pointer;" />
				<input type="submit" name="submit" id="submit" value="Preview" class="submit" style="width:80px; height:30px; cursor:pointer;" />
				-->
				</td></tr>

				</table>
				</td>
				</tr>
				</table>

				</fieldset>
				<!-- </form>-->
				<script>
				calculatedeal();
				</script>
				<br/><br/>
				<div style="padding-left:250px; position: absolute;">
					<input type="button" style="width:80px; height:30px; cursor:pointer;" class="submit" onclick="javascript: divopen(3)" value="Back" name="back">
					<input type="submit" name="submit" id="submit" value="Submit" class="submit" style="width:80px; height:30px; cursor:pointer;" />
				</div>
				<br/><br/>

				</form>


				<fieldset class="fieldset">
				<legend><a original-title="Provide your webmail email address and password below to get all the contacts. All those imported contact will be shown at the above textbox." class="tips" href="javascript: void(0);"><img width="12" vspace="4" height="12" align="middle" src="images/question.png">Add Picture</a></legend>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
				<td>
				<div>
				<span style=" font:bold 14px/26px Arial, Helvetica, sans-serif; padding: 10px 0 8px 0; display: inline-block;"><strong>Upload Files:</strong></span>


				<!-- <iframe src="uploader/example/uploader" width="600" frameborder="0" scrolling="no"></iframe>-->
				<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/themes/base/jquery-ui.css" id="theme">
				<link rel="stylesheet" href="<?php echo SITE_URL?>siteadmin/js/uploader/jquery.fileupload-ui.css">

				<div id="fileupload">
				<form action="<?php echo SITE_URL;?>upload.php" method="POST" enctype="multipart/form-data">


				<div class="fileupload-buttonbar">
				<label class="fileinput-button">
				<span><strong>Add files...</strong></span>
				<input type="file" name="files[]" multiple>
				</label>
				<button type="submit" class="start">Start upload</button>
				<button type="reset" class="cancel">Cancel upload</button>
				<button type="button" class="delete">Delete files</button>
				</div>


				</form>
				<div class="fileupload-content">
				<table class="files"></table>
				<div class="fileupload-progressbar"></div>
				</div>
				</div>
				<script id="template-upload" type="text/x-jquery-tmpl">
				<tr class="template-upload{{if error}} ui-state-error{{/if}}">
				<td class="preview"></td>
				<td class="name">${name}</td>
				<td class="size">${sizef}</td>
				{{if error}}
				<td class="error" colspan="2">Error:
				{{if error === 'maxFileSize'}}File is too big
				{{else error === 'minFileSize'}}File is too small
				{{else error === 'acceptFileTypes'}}Filetype not allowed
				{{else error === 'maxNumberOfFiles'}}Max number of files exceeded
				{{else}}${error}
				{{/if}}
				</td>
				{{else}}
				<td class="progress"><div></div></td>
				<td class="start"><button>Start</button></td>
				{{/if}}
				<td class="cancel"><button>Cancel</button></td>
				</tr>
				</script>
				<script id="template-download" type="text/x-jquery-tmpl">
				<tr class="template-download{{if error}} ui-state-error{{/if}}">
				{{if error}}
				<td></td>
				<td class="name">${name}</td>
				<td class="size">${sizef}</td>
				<td class="error" colspan="2">Error:
				{{if error === 1}}File exceeds upload_max_filesize (php.ini directive)
				{{else error === 2}}File exceeds MAX_FILE_SIZE (HTML form directive)
				{{else error === 3}}File was only partially uploaded
				{{else error === 4}}No File was uploaded
				{{else error === 5}}Missing a temporary folder
				{{else error === 6}}Failed to write file to disk
				{{else error === 7}}File upload stopped by extension
				{{else error === 'maxFileSize'}}File is too big
				{{else error === 'minFileSize'}}File is too small
				{{else error === 'acceptFileTypes'}}Filetype not allowed
				{{else error === 'maxNumberOfFiles'}}Max number of files exceeded
				{{else error === 'uploadedBytes'}}Uploaded bytes exceed file size
				{{else error === 'emptyResult'}}Empty file upload result
				{{else}}${error}
				{{/if}}
				</td>
				{{else}}
				<td class="preview">
				{{if thumbnail_url}}
				<a href="${url}" target="_blank"><img src="${thumbnail_url}"></a>
				{{/if}}
				</td>
				<td class="name">
				<a href="${url}"{{if thumbnail_url}} target="_blank"{{/if}}>${name}</a>
				</td>
				<td class="size">${sizef}</td>
				<td colspan="2"></td>
				{{/if}}
				<td class="delete">
				<button data-type="${delete_type}" data-url="${delete_url}">Delete</button>
				</td>
				</tr>
				</script>
				<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
				<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>
				<script src="//ajax.aspnetcdn.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js"></script>
				<script src="<?php echo SITE_URL?>siteadmin/js/uploader/jquery.iframe-transport.js"></script>
				<script src="<?php echo SITE_URL?>siteadmin/js/uploader/jquery.fileupload.js"></script>
				<script src="<?php echo SITE_URL?>siteadmin/js/uploader/jquery.fileupload-ui.js"></script>
				<script src="<?php echo SITE_URL?>siteadmin/js/uploader/application.js"></script>

				<!-- END OF FORM SECTION -->

				</div>
				<br /><br />

				</td>
				</tr>

				</table>

				</fieldset>


			</div>

		<!-- </form> -->




			<!-- Deal add formends -->

	</div>
	<!-- 7 ends here  -->

	<div class="TabbedPanelsContent" id="myaccount_8">
		<div class="title">Past Jumbles</div>
	<?php
		$sql_past_jmblr = "SELECT tt.coupon_code,td.title,td.discounted_price,tt.transaction_date,tt.transaction_status,usr.name,usr.profile_url,img.file FROM ".TABLE_TRANSACTION." tt LEFT JOIN ". TABLE_DEALS." td on td.deal_id=tt.deal_id LEFT JOIN ". TABLE_FB_USER." usr on td.admin_id = usr.fb_id LEFT JOIN ".TABLE_DEAL_IMAGES." img on td.deal_id=img.deal_id WHERE td.admin_id = $_SESSION[fb_id]"." AND td.deal_type = 'user_deal'";
		$sql_cur = "SELECT * FROM ".TABLE_SETTING." WHERE id=8";

		$cur_res = mysql_query($sql_cur);
		$cur=mysql_fetch_row($cur_res);

		//$_SESSION[fb_id]
		//echo $sql_past_jmblr;
		$past_jmblr_res = mysql_query($sql_past_jmblr);
		$past_jmblr_num = mysql_num_rows($past_jmblr_res);

		if ($past_jmblr_num <= 0) {
	?>
		<h4>You haven&rsquo;t bought a deal yet.</h4>
		<p>There is no deal by you.</p>
	<?php
		}
		else {

		$count = 0;

		while ($orders_row = mysql_fetch_array($past_jmblr_res)) {


			$count++;

	?>
	<!-- loop start -->
		<div class="TabbedPanelsContent27" id="myaccount_1">
         <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
			<th style="width:20px;">Deal No</th>
			<th style="width:100px;">Deal Images </th>
			<th style="width:100px;">Deal Title </th>

			<th style="width:100px;">Deal Price </th>
			<th style="width:100px;">Deal Status </th>
			<th style="width:100px;">Purchase Date </th>
			<th style="width:150px;">Buyer</th>
          </tr>
		  <tr><td>&nbsp;</td></tr>
           <tr>
             <td style="width:150px;"><?php echo $count; ?></td>
			 <td style="width:100px;"><img src="<?php echo UPLOAD_PATH.$orders_row['file']; ?>" height="60" width="60"/></td>
             <td style="width:100px;"><?php echo $orders_row['title']; ?></td>

			 <td style="width:100px;"><?php echo $cur[2].$orders_row['discounted_price']; ?></td>
			 <td style="width:100px;"><?php echo $orders_row['transaction_status']; ?></td>
			 <td style="width:100px;"><?php echo $orders_row['transaction_date']; ?></td>

			<td style="width:100px;"><a href="<?php echo $orders_row['profile_url']; ?>"><?php echo $orders_row['name']; ?></a></td>
          </tr>
          </table>


       </div>
	   <!-- loop ends -->
<?php
		} // End while
		}	// End else
?>

    </div>

	<!-- 8 ends here  -->
  </div>


<script type="text/javascript">

$('#tickallcity').click(function(){
	$("INPUT[type='checkbox']").each(function(){
        	if (this.checked == false) {
			this.checked = true;
		} else {
			this.checked = false;
		}
	});
});

</script>

<script type="text/javascript">
function ajaxReq(str)
{
var xmlhttp;
//alert(str); die();
if (str.length==0)
  {
  document.getElementById("subs_msg_loc").innerHTML="";
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
    document.getElementById("subs_msg_loc").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","ajax_city_subscription.php?city_id="+str,true);
xmlhttp.send();
}

</script>





<!--
<label><b>Change Profile Picture</b></label> <?php
if($image == '')
{
	?> <img src="images/user_sidebar.png"
	style="height: 60px; width: 60px;" /><br />
<br />
	<?php
}
else
{
	?> <img src="<?php echo PROFILE_IAMGE_PATH.$image;?>"
	style="height: 60px; width: 60px;" /><br />
<br />
	<?php
}
?> <input type="file" name="image" id="image" value=""
	style="width: 220px; height: 25px;" /><br />
<br />
<br />
<br />
 -->
<?php
		if($_REQUEST['tab_no'] != "")
		{
	?>
			<script type="text/javascript" language="javascript">
			for(i=1; i<=5; i++)
			{
				document.getElementById("myaccount_"+i).style.display = "none";

			}
			document.getElementById("myaccount_"+<?=$_REQUEST['tab_no']?>).style.display = "block";

			</script>
	<?php
		}
	?>

<div class="clear"></div>
		<!--<?php
		if(strtolower($_SERVER['REQUEST_METHOD']) == 'post' && ($_POST["btnNameUpdate"]=='Save' || $_POST["btnAddressUpdate"]=='Save' || $_POST["btnPhnoUpdate"]=='Save' || $_POST["btnEmailUpdate"]=='Save' || $_POST["btnPassUpdate"]=='Save')) {
		?>
			<div style="height: 40px; width: auto; margin: 10px; margin-left: 120px; margin-right: 5px; padding: 10px 10px 0 10px; border: 1px solid <?php if ($err_msg != "") {echo "none";} else {echo "none"; } ?>;">
				<?php if($err_msg != "") { ?>
				<label style="color: #191919; font: bold 20px/26px Arial, Helvetica, sans-serif;"><img src="images/cross.gif" align="top" style=" float:left; margin:0 5px 0 0;"><?=$err_msg?></label>
				<?php } ?>
				<?php if($succ_msg != "") { ?>
				<label style="color: #191919; font: bold 20px/26px Arial, Helvetica, sans-serif;"><img src="images/tick_mark.gif" align="top" style=" float:left; margin:0 5px 0 0;"><?=$succ_msg?></label>
				<?php }	?>
			</div>
		<?php } ?>-->


	<?php
		if(strtolower($_SERVER['REQUEST_METHOD']) == 'post' && ($_POST["btnNameUpdate"]=='Save' || $_POST["btnAddressUpdate"]=='Save' || $_POST["btnPhnoUpdate"]=='Save' || $_POST["btnEmailUpdate"]=='Save' || $_POST["btnPassUpdate"]=='Save')) {
			if($succ_msg != "") {
				header('location:'.SITE_URL.'customer-account.php?usucc='.$succ_msg);
				}
		}
	?>



</div>

<div class="clear"></div>
</div>
<div class="bot_about"></div>
</div>
</div>
<?php //include ('include/sidebar-login.php'); ?>
</div></div><br/>

<?php
include("include/footer.php");
include 'recommendation_popup.php';

if ($_GET['tab'] == 'subscriptions') {
	echo '<script type="text/javascript">show_tab(5)</script>';
}
else if ($_GET['tab'] == 'account') {
	echo '<script type="text/javascript">show_tab(3)</script>';
}
else if ($_GET['tab'] == 'vouchers') {
	echo '<script type="text/javascript">show_tab(1)</script>';
}
else if ($_GET['tab'] == 'purchase') {
	echo '<script type="text/javascript">show_tab(6)</script>';
}
else if ($_GET['tab'] == 'credit') {
	echo '<script type="text/javascript">show_tab(2)</script>';
}
else if ($_GET['tab'] == 'royal') {
	echo '<script type="text/javascript">show_tab(4)</script>';
}
else if ($_GET['tab'] == 'jumble') {
	echo '<script type="text/javascript">show_tab(7)</script>';
}
else if ($_GET['tab'] == 'past_jumble') {
	echo '<script type="text/javascript">show_tab(8)</script>';
}


?>