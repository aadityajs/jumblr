<?php
include("include/m_header.php");
?>
<?php
error_reporting(E_ERROR && E_STRICT);
?>
<?php
if(!isset($_SESSION["muser_id"]))
{
	header('location:merchant.php');
}
else
{
/*$mode=isset($_REQUEST['mode'])?$_REQUEST['mode']:'add';
$deal_id=isset($_REQUEST['deal_id'])?$_REQUEST['deal_id']:'';

$user_id=intval($_SESSION['merchantid']);
$sql = "SELECT first_name,last_name,company_name FROM `".TABLE_USERS."` WHERE user_id='$user_id'";
$record = $db->query_first($sql);
if($mode=="edit")
{

	$row_deal=mysql_fetch_array(mysql_query("select * from ".TABLE_DEALS." where deal_id='$deal_id'"));

	$row_img=mysql_query("select * from ".TABLE_DEAL_IMAGES." where deal_id='$deal_id'");

}
*/

include("update_redemption.php");

if(strtolower($_SERVER['REQUEST_METHOD'])=='post' and $_POST["submit"]=='Attach PayPal')
{
 	$sqlupdate = mysql_query("update ".TABLE_MERCHANTS." set paypal_id='".$_REQUEST['paypal_email']."' where mid=".$_SESSION['muser_id']."");
	header("location:merchant_home.php");
	exit;
}

/*-------------------------------------------------------------------------------

	Update Merchant Profile

 --------------------------------------------------------------------------------*/
if(strtolower($_SERVER['REQUEST_METHOD'])=='post' and $_POST["submit"]=='Update')
{


	$mer_data = array();
	$mer_data['store_name'] = $_POST["company_name"];
	$mer_data['employee_name'] = $_POST["employee_name"];
	$mer_data['address1']     = $_POST["address1"];
	$mer_data['city']        = $_POST["city"];
	$mer_data['zip']        = $_POST["zip"];
	$mer_data['state']      = $_POST["state"];
	$mer_data['password']     = base64_encode($_POST["password"]);
	//$mer_data['cpassword']     = base64_encode($_POST["cpassword"]);
	$mer_data['email']        = $_POST["email"];
	$mer_data['phone']     = $_POST["phone_no"];
	$mer_data['website']      = $_POST["website"];
	$mer_data['paypal_id'] = $_POST["paypal_email"];
	$user_id                  = $_SESSION["muser_id"];
//print_r($mer_data);
	if($mer_data['password'] == base64_encode($_POST["cpassword"]) && $mer_data['password'] != '')
	{
		# update table table users
		$db->query_update(TABLE_MERCHANTS, $mer_data, "mid='$user_id'");
		header('location:merchant_home.php');
		exit;
	}
}







$mode=isset($_REQUEST['mode'])?$_REQUEST['mode']:'add';
$deal_id=isset($_REQUEST['deal_id'])?$_REQUEST['deal_id']:'';

$user_id=intval($_SESSION['muser_id']);
$sql = "SELECT * FROM `".TABLE_MERCHANTS."` WHERE mid='$user_id'";
$record = $db->query_first($sql);
if($mode=="edit")
{

	$row_deal=mysql_fetch_array(mysql_query("select * from ".TABLE_DEALS." where deal_id='$deal_id'"));

	$row_img=mysql_query("select * from ".TABLE_DEAL_IMAGES." where deal_id='$deal_id'");

}

if($mode=="delete")
{

	mysql_query("delete from ".TABLE_DEALS." where deal_id='$deal_id'");

	$fileq=mysql_query("SELECT * FROM ".TABLE_DEAL_IMAGES." where deal_id='".$deal_id."'");
		while($frow=mysql_fetch_array($fileq)){
		@unlink("files/".$frow['file']);
		@unlink("thumbnails/".$frow['file']);
		}
		mysql_query("delete from ".TABLE_DEAL_IMAGES." where deal_id='$deal_id'");

	$_SESSION['msg']="Deal is deleted successfully";
	header("location:merchant_home.php");
	exit;
}

if(strtolower($_SERVER['REQUEST_METHOD'])=='post' and $_POST["submit"]=='Submit') {

	$data['deal_cat']=$_POST['deal_cat'];
	$data['store_id']=$_POST['store_id'];
	$data['location_id']=$_POST['location_id'];
	$data['city_id']=$_POST['city'];
	$data['title']=$_POST['title'];
	$data['description']=$_POST['description'];

	$data['full_price']=$_POST['retailvalue'];
	//$data['discounted_price']=$_POST['discounted_price'];
	$data['discounted_price']=$_POST['customerdisc'];
	//$data['wakadeal_comission']=$_POST['wakadealfee'];


	$data['custpercent']=$_POST['custpercent'];
	$data['merchant_take']=$_POST['merchant_take'];
	$data['merchantpercent']=$_POST['merchantpercent'];
	$data['waka_percent']=$_POST['wakapercent'];

	$data['deal_start_time']=$_POST['deal_start_time']." "."03:00:00";
	$data['deal_end_time']=$_POST['deal_end_time']." "."11:59:00";
	$data['status']=$_POST['status'];
	$data['mid']=$_POST['mid'];



	$data['coupon_expiry']=$_POST['coupon_expiry'];
	$data['max_buy']=$_POST['max_coupons'];


	$data['date_added']=date("Y-m-d");
	$data['address1']=$_POST['address1'];




	$data['offer_details']=$_POST['offer_details'];
	$data['website']=$_POST['website'];
	$data['item_type']=$_POST['item_type'];
	$data['brand']=$_POST['brand'];
	$data['deal_type']='dailydeal';

/*if($data['deal_cat']=='' || $data['title']==''  ){
	$_REQUEST['errmsg']="Please enter valid details for a deal";
	header("location:merchantadddeal.php");
	exit;
	}*/

	$data['item_control_type']=$_POST['item_control_type'];
	$data['referral_no']=$_POST['referral_no'];
	$data['referral_value']=$_POST['referral_value'];
	$data['preview']=2;

	/********************** Code for Getting Latitude and Longitude Starts *********************/

	$address1=str_replace(" ","+",$_POST['address1']);
	$address2=str_replace(" ","+",$_POST['address2']);
	$city=str_replace(" ","+",$_POST['city']);
	$state=str_replace(" ","+",$_POST['state']);

	$concat_address=$address1."+".$address2."+".$city;


/********************** Code for Getting Latitude and Longitude Ends *********************/
		/* --------------------mail to similar users -----------------*/
		$usersql=mysql_query("SELECT * FROM ".TABLE_USERS." where password<>''");

		while($userrow=mysql_fetch_array($usersql)){
			$city=$db->fetch_all_array("SELECT city_name as city FROM ".TABLE_CITIES." JOIN ".TABLE_USER_SUBSCRIPTION." on(".TABLE_CITIES.".city_id=".TABLE_USER_SUBSCRIPTION.".city_id) and ".TABLE_USER_SUBSCRIPTION.".user_id='".$userrow['user_id']."'");
			$category=$db->fetch_all_array("SELECT cat_id as category FROM ".TABLE_CATEGORIES." JOIN ".TABLE_USER_PREFERENCE." on(".TABLE_CATEGORIES.".cat_id=".TABLE_USER_PREFERENCE.".category_id) and ".TABLE_USER_PREFERENCE.".user_id='".$userrow['user_id']."'");


				foreach($city as $usercity){
					if($usercity['city_name']==$_POST['city']){
					$usermail[]=$userrow['email'];
					}
				}

				foreach($category as $usercat){
					if($usercat['category']==$_POST['deal_cat']){
					$usermail[]=$userrow['email'];
					}
				}

			}
				$to  = implode(",",array_unique($usermail));


				$subject = $_POST['brand']." from Jumblr.com ";
				$txt = "New offer is created in your city ".$_POST['city']."<br />";
				$txt .= " Offer :<b>".$_POST['title']."</b><br/>";

				$sql="SELECT * FROM ".TABLE_ADMIN." where admin_name='admin'";
				$admin=$db->query_first($sql);

				$txt .= " Please visit the link :".SITE_URL."city/".str_replace(" ","-",trim(strtolower($_POST['city'])))."/offer/".str_replace(" ","-",trim(strtolower($_POST['brand'])))."<br/>";
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= "From: Jumblr.com<".$admin['email'].">". "\r\n" ;

				$status=@mail($to,$subject,$txt,$headers);

				//echo ">>>>>>>>>>>>>>>>>>>>>>>>>>>>>>";
				//die();



	if($mode=="edit")
	{

		$db->query_update(TABLE_DEALS, $data, "deal_id='$deal_id'");

		$dataimg['deal_id']=$deal_id;

		$db->query_update(TABLE_DEAL_IMAGES, $dataimg, "deal_id='".$_SESSION["session_temp"]."'");

		$mdata['user_id']=$_POST['mid'];
		$mdata['deal_id']=$deal_id;
		$db->query_update(TABLE_DEALS_MERCHANT, $mdata, "deal_id='$deal_id'");




		$_SESSION['msg']="Deal is updated successfully.";
		//header("location:merchantdealactive.php");
		header("location:merchant_home.php?deal_id=$_REQUEST[deal_id]");
		exit;

	}
	else
	{

	if(date('Y-m-d H:i',strtotime($data['deal_start_time']))>date('Y-m-d H:i')){
		$data['status']=2;
		}else{
		$data['status']=1;
		}
		//echo ">>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>";
		//print "<pre>";
		//print_r($data);



		$primary_id=$db->query_insert(TABLE_DEALS, $data);
		//die();
		$mdata['user_id']=$_POST['mid'];
		$mdata['deal_id']=$primary_id;
		$db->query_insert(TABLE_DEALS_MERCHANT, $mdata);

		$dataimg['deal_id']=$primary_id;



		$db->query_update(TABLE_DEAL_IMAGES, $dataimg, "deal_id='".$_SESSION["session_temp"]."'");


		$_SESSION['msg']="Deal is added successfully.";
		header("location:merchantpreview.php?deal_id=$mdata[deal_id]");
		exit;
	}


}



$row_stores=mysql_fetch_array(mysql_query("SELECT * FROM ".TABLE_STORES." where merchant_id='".$_SESSION['merchantid']."'"));
$merchant=mysql_fetch_array(mysql_query("SELECT * FROM ".TABLE_USERS." where reg_type='merchant' and user_id='".$_SESSION['merchantid']."'"));
$store_id=$row_stores['store_id'];

if($_REQUEST['mode']=='edit' || $_REQUEST['mode']=='delete'){
$_SESSION["session_temp"] =$deal_id;
}else{
$_SESSION["session_temp"] =uniqid();
}



?>

	<script language="Javascript" type="text/javascript">
        function lodetab(tab) {
            //alert(tab);
                window.location.href = "<?php echo SITE_URL; ?>merchant_home.php"+tab;
                window.location.reload();
        }
    </script>

<div id="container">
<div class="deal_info">

<div class="top_about">
	<p>Wecome to Merchant Panel</p>
</div>
<div class="clear"></div>

<div class="bot_about" style="height:auto;">

	<div id="tabs">
		<ul>
			<li><a href="#tabs-1">Dashboard</a></li>
			<li><a href="#tabs-2">Payment</a></li>
			<li><a href="#tabs-3">Account</a></li>
			<li><a href="#tabs-4">Deals</a></li>
			<li><a href="#tabs-5">Earnings</a></li>
			<li><a href="#tabs-6">Reedem Value</a></li>
			<li><a href="#tabs-7">Users</a></li>
		</ul>

		<div id="tabs-1">

				<div class="main_box">


				<div id="introduction_banner" class="clearfix">
				<div class="introduction_banner_left_01"><h2>Nemo enim ipsam voluptatem quia</h2><p>
				No one rejects, dislikes, or avoids pleasure itself
				</p>
				<p>
				Nemo enim ipsam voluptatem quia voluptas sit aspernatur
				<strong>dit aut fugit, sed quia consequuntur magni</strong>
				</p>
				</div>
				<!-- <div class="introduction_banner_right_01">
				<a class="cta_btn" href="merchant_adddeal.php">Create a New! Deal</a>

				</div> -->
				<!--<a class="intro_close" href="#"><img src="images/user_logout.png" alt="Close_announcements"></a>-->
				<div class="clear"></div>
				</div>

				<div class="main_box">
				<ul class="deals_box">
				<li>
				<h4>Deals</h4>
				<ul>
				<li class="deals">
				<p style="width:70px; float: left;"><img src="images/deals_box_icon1.png" alt=""></p>
				<p style="width:120px; float: left;">
				<a href="javascript: void(0);" onclick="javascript: lodetab('#tabs-4');">Daily deals</a><br />
				<!-- <a href="merchant_adddeal.php">Daily deals</a><br /> -->
				Manage your daily deals.
				</p>
				</li>
				<!-- <li class="deals">
				<p style="width:70px; float: left;"><img src="images/deals_box_icon3.png" alt=""></p>
				<p style="width:120px; float: left;">
				<a href="#">Daily deals</a><br />
				Manage your daily deals.
				</p>
				</li> -->
				</ul>
				</li>
				</ul>

				<ul class="deals_box">
				<li>
				<h4>Tools</h4>
				<ul>
				<li class="deals">
				<p style="width:70px; float: left;"><img src="images/deals_box_icon2.png" alt=""></p>
				<p style="width:120px; float: left;">
				<a href="javascript: void(0);" onclick="javascript: lodetab('#tabs-6');">Redeem Value</a><br />
				<!-- <a href="merchant_redeem_coupon.php">Redeem Value</a><br /> -->
				Track and Enter Jumblr Redemptions.
				</p>
				</li>
				<!-- <li class="deals">
				<p style="width:70px; float: left;"><img src="images/deals_box_icon3.png" alt=""></p>
				<p style="width:120px; float: left;">
				<a href="#">Daily deals</a><br />
				Manage your daily deals.
				</p>
				</li> -->
				</ul>
				</li>
				</ul>

				<ul class="deals_box">
				<li>
				<h4>Account</h4>
				<ul>
				<li class="deals">
				<p style="width:70px; float: left;"><img src="images/deals_box_icon3.png" alt=""></p>
				<p style="width:120px; float: left;">
				<a href="javascript: void(0);" onclick="javascript: lodetab('#tabs-3');">Personal Account</a><br />
				<!-- <a href="merchant_account.php">Personal Account</a><br /> -->
				Update your personal information..
				</p>
				</li>
				<!-- <li class="deals">
				<p style="width:70px; float: left;"><img src="images/deals_box_icon3.png" alt=""></p>
				<p style="width:120px; float: left;">
				<a href="merchant_receive.php">Daily deals</a><br />
				Receive Payment.
				</p>
				</li> -->
				</ul>
				</li>
				</ul>

				<div class="clear"></div>
				</div>


				<!--<label style="margin-left: 200px; font:26px/16px bold Arial, Helvetica, sans-serif ;">Welcome to Merchant panel</label>-->

				<div class="clear"></div>
				</div>



		</div>

		<div id="tabs-2">

			<div class="form"  style="border:1px solid #cccbc8; padding:8px; width:97%;">

			<div class="ttle_txt" style="background:none; padding-left:0px;">Receive Payment</div>
			<?php
				$user_id = $_SESSION["muser_id"];
				$sql_user = "SELECT * FROM ".TABLE_MERCHANTS." WHERE mid=".$user_id;
				$result_user = mysql_query($sql_user);
				$row_user = mysql_fetch_array($result_user);
			?>
			<div class="form_left">
			<div class="form">
			<div style="line-height:26px; text-align: center; padding:20px 0;"><span style="color:#0066CC;font:normal 20px/26px Arial, Helvetica, sans-serif;">Please put your PayPal Account id at below and update the settings to receive your payment.If you dont have a <a href="https://www.paypal.com" target="_blank">PayPal</a> id please create one.</span></div>
			<div class="clear"></div>
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="return validation()">
			<p>
			<label for="fullname" style="font-weight:900;color:#666666;">PayPal Email:</label>
			<input class="lf" type="text" name="paypal_email" id="paypal_email" size="54" value="<?php echo stripslashes($row_user[paypal_id]);?>" />
			</p>
			<p>
			<input type="submit" name="submit" id="submit" value="Attach PayPal" class="submit" style="margin:5px 0 0 190px; cursor:pointer;" />
			</p>
			</form>
			</div>
			</div>


			</div>

		</div>

		<div id="tabs-3">
								<div id="tab1s">
								<div class="ttle_txt" style="background:none; padding-left:0px;">Merchant Account</div>
									<ul>
										<li><a href="#tab1s-1">Merchant Account</a></li>
										<li><a href="#tab1s-2">Edit Merchant Account</a></li>
									</ul>

									<div id="tab1s-1">

										<?php
										$user_id = $_SESSION["muser_id"];
										$sql_user = "SELECT * FROM ".TABLE_MERCHANTS." WHERE mid=".$user_id;
										$result_user = mysql_query($sql_user);
										$row_user = mysql_fetch_array($result_user);
										?>

										<div class="form2">
										<form name="merchant" method="post" action="merchantaccount.php" style="padding-top:8px;">

										<p>
										<label for="fullname">Company Name:</label>
										<?php echo stripslashes($row_user['store_name']);?><br />
										<span class="validate_error" style="color:#FF0000" id="err1"></span>
										</p>
										<div class="clear"></div>

										<p>
										<label for="name">Merchant Name:</label>
										<?php echo stripslashes($row_user['employee_name']);?><br />
										<span class="validate_error" style="color:#FF0000" id="err1"></span>
										</p>
										<div class="clear"></div>

										<p class="gray_02">
										<label for="fullname">Company Address:</label>
										<?php echo $row_user['address1']; ?>
										</p>
										<div class="clear"></div>

										<p>
										<label for="email">Company City:</label>
										<?php echo stripslashes($row_user['city']);?>
										</p>

										<div class="clear"></div>
										<p class="gray_02">
										<label for="fullname">Company State:</label>
										<?php echo stripslashes($row_user['state']);?>
										</p>
										<div class="clear"></div>



										<p class="gray_02">
										<label for="fullname">Company Zipcode: </label>
										<?php echo $row_user['zip']; ?>
										</p>

										<div class="clear"></div>
										<?php /*?><p class="gray_02">
										<label for="fullname">Password: </label>
										<?php echo $row_deals['password']; ?>
										<span class="validate_error" id="err2"></span>
										</p>
										<div class="clear"></div><?php */?>
										<p>
										<label for="fullname">Email/Merchant LoginId: </label>
										<?php echo $row_user['email']; ?>
										<span class="validate_error" id="err4"></span>
										</p>
										<div class="clear"></div>
										<p class="gray_02">
										<label for="fullname">Phone Number:</label>
										<?php echo stripslashes($row_user['phone']);?>
										</p>
										<div class="clear"></div>
										<p>
										<label for="fullname">Website:</label>
										<?php echo stripslashes($row_user['website']); ?>
										</p>
										<div class="clear"></div>
										<p class="gray_02">
										<label for="fullname">Paypal Email:</label>
										<?php echo stripslashes($row_user['paypal_id']); ?>
										</p>
										<div class="clear"></div>
										<!--<p>
										<input type="submit" name="submit" id="submit" value="Edit" class="submit" style="margin:5px 0 0 220px;" />
										</p>-->

										</form>
										</div>

									</div>





									<div class="form2">
									<div id="tab1s-2">
										<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" onSubmit="return validation()">
										<p>
										<label for="fullname">Company Name:</label>
										<input type="text" class="lf" name="company_name" id="company_name" size="54" value="<?php echo stripslashes($row_user[store_name]);?>" /><br />
										<span class="validate_error" style="color:#FF0000" id="err1"></span>
										</p>

										<p>
										<label for="fullname">Merchant Name:</label>
										<input type="text" class="lf" name="employee_name" id="employee_name" size="54" value="<?php echo stripslashes($row_user[employee_name]);?>" /><br />
										<span class="validate_error" style="color:#FF0000" id="err1"></span>
										</p>

										<p>
										<label for="fullname">Company Address:</label>
										<input type="text" class="lf" name="address1" id="address1" size="54" value="<?php echo $row_user[address1]?>" />
										</p>

<!--										<p>
										<label for="email">Company Address 2:</label>
										<input type="text" class="lf" name="address2" id="address2" size="54" value="<?php// echo stripslashes($row_user[address2]);?>" />
										</p>
-->
										<p>
										<label for="email">Company City:</label>
										<select name="city">
										<?php $city=$db->fetch_all_array("SELECT * FROM ".TABLE_CITIES." where status='1' group by city_name order by city_name asc");

										foreach($city as $cityitem){
										?>
										<?php if($row_user['city']==$cityitem['city_name']){?>
										<option value="<?php echo $cityitem['city_name']?>" selected="selected"><?php echo $cityitem['city_name']?></option>
										<?php }else{?>
										<option value="<?php echo $cityitem['city_name']?>"><?php echo $cityitem['city_name']?></option>
										<?php }?>
										<?php }?>
										</select>
										</p>

										<p>
										<label for="fullname">Company State:</label>
										<input type="text" class="lf" name="state" id="state" size="54" value="<?php echo stripslashes($row_user[state]);?>" />
										</p>

<!--										<p>
										<label for="email">Company Country:</label>
										<select name="country" class="dropdown" id="country" size="1">
										<option value="">-- Select --</option>
										<?php

										//$sql_categories=mysql_query("select * from " .TABLE_COUNTRIES." order by country_name asc");
										//while($row_categories=mysql_fetch_array($sql_categories))
										//{
										?>

										<option value="<?php //echo $row_categories[country_id];?>" <?php //if($row_categories[country_id]==$row_user[country]) { echo "selected"; }?>><?php ///echo $row_categories[country_name];?></option>
										<?php
										//}
										?>
										</select>
										</p>
-->

										<p>
										<label for="fullname">Company Zipcode: </label>
										<input class="lf" name="zip" id="zip" type="text" value="<?php echo $row_user[zip]?>" />
										</p>


										<p>
										<label for="fullname">Password: </label>
										<input class="lf" name="password" id="password" type="password"  />
										<span class="validate_error" id="err2"></span>
										</p>



										<p>
										<label for="fullname">Confirm Password: </label>
										<input class="lf" name="cpassword" id="cpassword" type="password" />
										<span class="validate_error" id="err3"></span>
										</p>


										<p>
										<label for="fullname">Email/Merchant LoginId: </label>
										<input class="lf" name="email" id="email" type="text" value="<?php echo $row_user[email]?>" />
										<span class="validate_error" id="err4"></span>
										</p>

										<p>
										<label for="fullname">Phone Number:</label>
										<input class="lf" type="text" name="phone_no" id="phone_no" size="54" value="<?php echo stripslashes($row_user[phone]);?>" />
										</p>

										<?php /*?><p>
										<label for="fullname">FAX:</label>
										<input class="lf" type="text" name="fax" id="fax" size="54" value="<?php echo stripslashes($row_deals[fax]);?>" />
										</p><?php */?>

										<p>
										<label for="fullname">Website:</label>
										<input class="lf" type="text" name="website" id="website" size="54" value="<?php echo stripslashes($row_user[website]);?>"  />
										</p>


										<p>
										<label for="fullname">Paypal Email:</label>
										<input class="lf" type="text" name="paypal_email" id="paypal_email" size="54" value="<?php echo stripslashes($row_user[paypal_id]);?>" />
										</p>


										<p>
										<input type="submit" name="submit" id="submit" value="Update" class="submit" style="margin:5px 0 0 220px;" />
										</p>
										<!--</fieldset>-->
										<!-- End of fieldset -->
										</form>
									</div>
									<div class="clear"></div>
									</div>
								</div>


		</div>

			<style>
			.dealcalcbox{
			width:40px; height:25px; border:1px solid #cccccc; padding:2px;
			}

			.dealcalctxtbox{
			padding:4px; border-right:1px solid #000000;text-align:center
			}
			</style>


			<script language="javascript" type="text/javascript">

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


			function divopen(ID)
			{
			for(i=1; i<=4; i++)
			{
				document.getElementById("tab_"+i).style.display = 'none';
			}
			document.getElementById("tab_"+ID).style.display = '';

			}


			</script>

		<div id="tabs-4">

		<div id="tab3s">
		<div class="ttle_txt" style="background:none; padding-left:0px;">Deals Management</div>
		<ul>
			<li><a href="#tab3s-1">Add Daily Deal</a></li>
			<li><a href="#tab3s-2">Active Deals</a></li>
			<li><a href="#tab3s-3">Closed Deals</a></li>
		</ul>

		<div id="tab3s-1">

				<div id="tab_1" style="display:block">
				<div class="title_txt">Jumblr! <!--Now!™--> helps you to be a part!</div>
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
				<li>Jumblr Now!™ gives you the power to stay bu new</li>-->
				</ul>
				<div class="clear"></div>
				</div>
				<div style="text-align: right;"><input type="button" name="next" value="Start" onclick="javascript: divopen(2)" class="submit" style="width:80px; height:30px; cursor:pointer;" /></div>
				<div class="clear"></div>
				</div>


				<div id="tab_2" style="display:none">
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
				<td align="right" width="100"><strong>Set Deal Value:</strong></td>
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
				<?php
				$description=isset($row_deal['description'])?$row_deal['description']:'eg. food & drink or travel';
				?>
				<td align="right" ><strong>Description:</strong></td>
				<td style="padding-left:10px;"><input type="text" size="50" class="lf" name="description" id="description" value="<?php echo $description?>"  onkeyup="calculatedeal('')" onClick="if(this.defaultValue==this.value) this.value=''"      onblur="if (this.value=='') this.value=this.defaultValue"/></td>
				</tr>
				<tr class="gray_02">
				<td align="right" style="vertical-align:top"><strong>Choose your deal's title:</strong></td>
				<td style="border:0px;">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:0px;">
				<tr>
				<td  style="text-align:right; vertical-align:top; width:10px; border:0px; border-bottom:1px solid #fff;"><input type="radio" value="title1" id="title11"   name="title" onClick="this.value=document.getElementById('title1').innerHTML;document.getElementById('title22').checked=false" <?php if(!empty($row_deal['title'])){ echo "checked";}?>  /></td>
				<td style="border:0px; border-bottom:1px solid #fff;"><span id='title1' ><?php echo $currency; ?>10 for <?php echo $currency; ?>20 at Kates Cars<br />
				50% off desc test cx sdfsd</span><br />
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
				<script>
				//$('#my_date_field').datetimepicker();
				</script>
				<input type="text" name="deal_start_time" id="date" size="20" value="<?php if(!empty($row_deal['deal_start_time'])){echo date("Y-m-d 03:00",strtotime($row_deal['deal_start_time']));}?>" class="lf" onclick='fPopCalendar("date")' />
				<?php
				/*$myCalendar = new tc_calendar("date2", true, false);
				$myCalendar->setIcon("calendar/images/iconCalendar.gif");
				$myCalendar->setDate(date("d"), date("m"), date("Y"));
				$myCalendar->setPath("calendar/");
				$myCalendar->setYearInterval(1970, 2020);
				$myCalendar->dateAllow("2008-05-13", "2015-03-01", false);
				$myCalendar->disabledDay("sat");
				$myCalendar->disabledDay("sun");
				$myCalendar->writeScript();*/
				?>
				</td>
				</tr>
				<tr class="gray_02">
				<td align="right" style="vertical-align:top"><strong>Deal End Time:</strong></td>
				<td><!--<input type="text" name="deal_end_time" id="my_date_field2" size="20" value="<?php  //if(!empty($row_deal['deal_end_time'])){echo date("Y-m-d H:i",strtotime($row_deal['deal_end_time']));}?>" class="lf"/>-->
				<script>
				//$('#my_date_field2').datetimepicker();
				</script>
				<input type="text" name="deal_end_time" id="date1" size="20" value="<?php  if(!empty($row_deal['deal_end_time'])){echo date("Y-m-d H:i",strtotime($row_deal['deal_end_time']));}?>" class="lf" onclick='fPopCalendar("date1")' />
				</td>
				</tr>
				<tr class="gray_02">
				<td align="right" style="vertical-align:top"><strong>Max Buy:</strong></td>
				<td><input type="text" name="max_coupons" id="max_coupons" size="10" value="<?php echo stripslashes($row_deal['max_buy']);?>" class="lf"/></td>
				</tr>
				<tr class="gray_02">
				<td colspan="2" align="center" style="padding-left: 300px;"><input type="button" name="back" value="Back" onclick="javascript: divopen(1)" class="submit" style="width:80px; height:30px; cursor:pointer;" />
				<input type="button" name="next" value="Next" onclick="javascript: divopen(3)" class="submit" style="width:80px; height:30px; cursor:pointer;" onmouseover="return checkcore();" />
				</tr>
				</table>
				</td>
				</tr>
				</table>
				</fieldset>
				</div>


				<div id="tab_3" style=" display:none">

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
				<td colspan="2" align="center" style="padding-left: 300px;"><input type="button" name="back" value="Back" onclick="javascript: divopen(2)" class="submit" style="width:80px; height:30px; cursor:pointer;" />
				<input type="button" name="next" value="Next" onclick="javascript: divopen(4)" class="submit" style="width:80px; height:30px; cursor:pointer;" />
				</tr>

				</table>
				</td>
				</tr>
				</table>

				</fieldset>

				</div>

				<div id="tab_4" style="display:none">

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
				</form>
				<script>
				calculatedeal();
				</script>

				<fieldset class="fieldset">
				<legend>Add Picture</legend>
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
				<div style="padding-left:250px;"><input type="submit" name="submit" id="submit" value="Submit" class="submit" style="width:80px; height:30px; cursor:pointer;" /></div>
				</td>
				</tr>
				</table>

				</fieldset>

				</div>


		</div>


		<div id="tab3s-2">

			<?php
			$muser_id=intval($_SESSION['muser_id']);
			$sql = "SELECT first_name,last_name,company_name FROM `".TABLE_USERS."` WHERE user_id='$muser_id'";
			$record = $db->query_first($sql);

			$sql = "SELECT * FROM `".TABLE_STORES."` WHERE merchant_id='$muser_id'";
			$store = $db->query_first($sql);


			$items = 5;
			$page = 1;

			if(isset($_GET['page']) and is_numeric($_GET['page']) and $page = $_GET['page'])
			$limit = " LIMIT ".(($page-1)*$items).",$items";
			else
			$limit = " LIMIT $items";




			$sqlStrAux ="select count(*) as total from ".TABLE_DEALS." where deal_type='dailydeal' and status=0  and store_id='".$store['store_id'] ."' ";
			$row_deals=$db->fetch_all_array("select * from ".TABLE_DEALS." where deal_type='dailydeal' and status=0 and store_id='".$store['store_id'] ."' $limit");
			$aux = mysql_fetch_assoc(mysql_query($sqlStrAux));


			$p = new pagination;
			$p->Items($aux['total']);
			$p->limit($items);
			$p->target($target);
			$p->currentPage($page);
			$p->calculate();
			$p->changeClass("pagination");
			if($_SESSION['errmsg']){
			echo '<div class="error_box" style="font-size:12px;">'.$_SESSION['errmsg'].'</div>' ;
			$_SESSION['errmsg']="";
			}if($_SESSION['msg']){
			echo '<div class="valid_box" style="font-size:12px;">'.$_SESSION['msg'].'</div>' ;
			$_SESSION['msg']="";
			}
			?>

			<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="cart_box">
			<tr>
			<th>Title</th>
			<th>Start Date</th>
			<th>Closed On</th>
			<th>Units Sold </th>
			<th>Units Redeemed</th>
			<th>Your Earnings (based on redemption)</th>
			<th>Action</th>

			</tr>
			<?php
			if($aux['total']>0){
			foreach($row_deals as $data){?>
			<tr class="gray_02">
			<td><?php if(!empty($data['title'])){echo $data['title'];}else{echo $data['title2'];}?></td>
			<td><?php echo date("Y-m-d H:i",strtotime($data['deal_start_time']))?></td>
			<td><?php echo date("Y-m-d H:i",strtotime($data['deal_end_time']))?></td>
			<td>-</td>
			<td>-</td>
			<td>-</td>
			<td><a href="#">Edit</a> <a href="#">Delete</a></td>
			</tr>

			<?php }?>

			<tr><td colspan="6" align="center"> <div align="center" style=" margin-left:150px;"><?php echo $p->show();?></div></td></tr>
			<?php }?>
			</table>

			<?php
			if(empty($store['store_status'])){

			?>
			<div class="formcenteralighed">
			<!--<h3>You don't have any Groupon Store deals yet! <a href="<?php //echo SITE_URL;?>create_store">Create Store Now</a></h3>--></div>


			<?php }?>

		</div>


		<div id="tab3s-3">
			<?php
			$muser_id=intval($_SESSION['muser_id']);
			$sql = "SELECT first_name,last_name,company_name FROM `".TABLE_USERS."` WHERE user_id='$muser_id'";
			$record = $db->query_first($sql);

			$sql = "SELECT * FROM `".TABLE_STORES."` WHERE merchant_id='$muser_id'";
			$store = $db->query_first($sql);


			$items = 5;
			$page = 1;

			if(isset($_GET['page']) and is_numeric($_GET['page']) and $page = $_GET['page'])
			$limit = " LIMIT ".(($page-1)*$items).",$items";
			else
			$limit = " LIMIT $items";




			$sqlStrAux ="select count(*) as total from ".TABLE_DEALS." where deal_type='dailydeal' and status=0  and store_id='".$store['store_id'] ."' ";
			$row_deals=$db->fetch_all_array("select * from ".TABLE_DEALS." where deal_type='dailydeal' and status=0 and store_id='".$store['store_id'] ."' $limit");
			$aux = mysql_fetch_assoc(mysql_query($sqlStrAux));


			$p = new pagination;
			$p->Items($aux['total']);
			$p->limit($items);
			$p->target($target);
			$p->currentPage($page);
			$p->calculate();
			$p->changeClass("pagination");
			if($_SESSION['errmsg']){
			echo '<div class="error_box" style="font-size:12px;">'.$_SESSION['errmsg'].'</div>' ;
			$_SESSION['errmsg']="";
			}if($_SESSION['msg']){
			echo '<div class="valid_box" style="font-size:12px;">'.$_SESSION['msg'].'</div>' ;
			$_SESSION['msg']="";
			}
			?>

			<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="cart_box">
			<tr>
			<th>Title</th>
			<th>Start Date</th>
			<th>Closed On</th>
			<th>Units Sold </th>
			<th>Units Redeemed</th>
			<th>Your Earnings (based on redemption)</th>
			<th>Action</th>

			</tr>
			<?php
			if($aux['total']>0){
			foreach($row_deals as $data){?>
			<tr class="gray_02">
			<td><?php if(!empty($data['title'])){echo $data['title'];}else{echo $data['title2'];}?></td>
			<td><?php echo date("Y-m-d H:i",strtotime($data['deal_start_time']))?></td>
			<td><?php echo date("Y-m-d H:i",strtotime($data['deal_end_time']))?></td>
			<td>-</td>
			<td>-</td>
			<td>-</td>
			<td><a href="#">Edit</a> <a href="#">Delete</a></td>
			</tr>

			<?php }?>

			<tr><td colspan="6" align="center"> <div align="center" style=" margin-left:150px;"><?php echo $p->show();?></div></td></tr>
			<?php }?>
			</table>

			<?php
			if(empty($store['store_status'])){

			?>
			<div class="formcenteralighed">
			<!--<h3>You don't have any Groupon Store deals yet! <a href="<?php //echo SITE_URL;?>create_store">Create Store Now</a></h3>--></div>


			<?php }?>

		</div>


		</div>







		</div>

		<div id="tabs-5">
		<?php
				$muser_id=intval($_SESSION['muser_id']);
				$sql = "SELECT * FROM `".TABLE_MERCHANTS."` WHERE mid='$muser_id'";
				$record = $db->query_first($sql);

				$sql = "SELECT * FROM `".TABLE_STORES."` WHERE merchant_id='$muser_id'";
				$store = $db->query_first($sql);


				$items = 5;
				$page = 1;

				if(isset($_GET['page']) and is_numeric($_GET['page']) and $page = $_GET['page'])
				$limit = " LIMIT ".(($page-1)*$items).",$items";
				else
				$limit = " LIMIT $items";




				$sqlStrAux ="select count(*) as total, SUM(amount) as totsum from ".TABLE_TRANSACTION." where merchant_id='$muser_id' and transaction_status='success'  ";
				//echo "select * from ".TABLE_TRANSACTION." where merchant_id='$muser_id' and transaction_status='success' order by tran_id desc $limit";
				$row_deals=$db->fetch_all_array("select * from ".TABLE_TRANSACTION." where merchant_id='$muser_id' and transaction_status='success' order by tran_id desc $limit");
				$aux = mysql_fetch_assoc(mysql_query($sqlStrAux));


				$p = new pagination;
				$p->Items($aux['total']);
				$p->limit($items);
				$p->target($target);
				$p->currentPage($page);
				$p->calculate();
				$p->changeClass("pagination");
		?>

                   <div class="form" style="border:1px solid #cccbc8; padding:8px; width:97%;">
                    <div class="ttle_txt" style="background:none; padding-left:0px;">Deal Earning</div>
                     <div class="form_left">

					<table width="100%" border="0" cellspacing="2" cellpadding="2" class="cart_box">
					  <tr>

						<th width="100">Deal</th>
						<th>CouponCode</th>
						<th>Qty </th>
						<th>Amount</th>
						<th>Transaction Date</th>
						<th>Transaction Id</th>
						<th>Redeem Status</th>


					  </tr>
					  <?php
					  if($aux['total']>0){
					   foreach($row_deals as $data){
					   $deal=get_deal_details($data['deal_id']);
					   if($deal['deal_type']=='dailydeal'){
					   ?>
					  <tr class="gray_02">
						<td><?php if(!empty($deal['title'])){echo $deal['title'];}else{echo $deal['title2'];}?></td>
						<td><?php echo $data['coupon_code']?></td>
						<td><?php echo $data['qty']?></td>
						<td>$<?php echo $data['amount']?></td>
						<td><?php echo $data['transaction_date']?></td>
						<td><?php echo $data['transaction_id']?></td>
						<td><?php if($data['redeem_status']==0){echo "Not Redeemed";}else{echo "Redeemed";}?></td>
					  </tr>
					  <?php $total=$total+$data['amount'];?>
					  <?php }}?>
					  <tr><td colspan="7" align="right"> <div align="right" style="float:right;">Total Earning: $<?php echo $total;?></div></td></tr>
					  <tr><td colspan="7" align="center"> <div align="center" style=" margin-left:150px;"><?php echo $p->show();?></div></td></tr>
					  <?php }?>
					</table>

						<div class="clear"></div>


                     </div>

                    <div class="clear"></div>

                   </div>
		</div>

		<div id="tabs-6">
			<div id="tab2s">
			<div class="ttle_txt" style="background:none; padding-left:0px;">Deal Redemption</div>
				<ul>
					<li><a href="#tab2s-1">Coupon Redemption</a></li>
					<li><a href="#tab2s-2">Reedem Bulk Coupon</a></li>
					<li><a href="#tab2s-3">Unredeem coupon</a></li>
				</ul>

				<div class="form2">
				<div id="tab2s-1">
							<div class="form_left">
							<style>
							fieldset {
							border: medium solid #cccccc;
							clear: both;
							padding:2px;
							width:630px;

							}
							fieldset legend {
							font-size:16px;

							}
							.dealcalcbox{
							width:40px; height:25px; border:1px solid #cccccc; padding:2px;
							}
							</style>
							<!--<h1><?php //echo $record['store_name'];?></h1>-->
							<form method="post" >
							<!--<legend  title="Primary Location">Coupon Redemption </legend>-->
							<table width="100%" border="0" cellspacing="2" cellpadding="2" class="cart_box" style="border:0px;">

							<tr  class="gray_02">
							<td><strong>Bill Total</strong></td>
							<td><input type="text" name="total_amount"  id="total_amount" class="lf"/></td>
							</tr>
							<tr>
							<td><strong>Redemption Code</strong></td>
							<td>&nbsp;<input type="text" name="coupon_code"  id="coupon_code" class="lf"/></td>
							</tr>
							<tr class="gray_02">
							<td></td>
							<td><input type="submit" value="Redeem"  id="submitSingle" name="submitSingle" class="submit"/></td>
							</tr>
							</table>
							</form>
							<div class="clear"></div>
							</div>
				</div>
						<div id="tab2s-2">
						<div class="form_left">
						<style>
							fieldset {
							border: medium solid #cccccc;
							clear: both;
							padding:2px;
							width:630px;

							}
							fieldset legend {
							font-size:16px;

							}
							.dealcalcbox{
							width:40px; height:25px; border:1px solid #cccccc; padding:2px;
							}
						</style>

						  <form method="post" >
						  <table width="100%" border="0" cellspacing="2" cellpadding="2" class="cart_box">
								<tr class="gray_02">
								<td>Redemption Code (seperated by comma ,)</td>
								<td><textarea name="coupon_code" id="coupon_code" cols="40"></textarea></td>
								</tr>
								<tr>
								<td></td>
								<td>&nbsp;<input type="submit" value="Redeem" class="submit" id="submitBulk" name="submitBulk"/></td>
								</tr>
							</table>
						  </form>
						<div class="clear"></div>
						</div>
						</div>


						<div id="tab2s-3">
						<div class="form_left">
						<form method="post" onSubmit="return checkAlert();">
							<input type="hidden" name="location" value="<?php echo $location['location_id'];?>" />
							<table width="100%" border="0" cellspacing="2" cellpadding="2" class="cart_box">
							<tr class="gray_02">
							<td>Redemption Code</td>
							<td><input type="text" name="coupon_code"  id="coupon_code"/></td>
							</tr>
							<tr>
							<td></td>
							<td>&nbsp;<input type="submit" class="submit" value="Unredeem"  id="submitUnredeem" name="submitUnredeem"/></td>
							</tr>
							</table>
						</form>
						<div class="clear"></div>
						</div>
						</div>

				</div>

				<div class="form2">
				<div id="tab2s-2">

				</div>
				</div>

				<div class="form2">
				<div id="tab2s-3">

				</div>
				</div>

			</div>
		</div>


		<div id="tabs-7">
			<div id="tab4s">
			<div class="ttle_txt" style="background:none; padding-left:0px;">User Management</div>
				<ul>
					<li><a href="#tab4s-1">User Accounts</a></li>
					<li><a href="#tab4s-2">Create User</a></li>
				</ul>

				<div id="tab4s-1">
					Display all user added by this Merchant.
				</div>
				<div class="clear"></div>
				<div id="tab4s-2">
					<div style="border:0px solid #cccbc8; padding:0px; width:auto;">

		<!-- user add form starts -->

		<div class="form">

					<?php
					if(isset($_REQUEST['submitUser']) && $_REQUEST['submitUser'] == "Submit")
					{
					// mid 	muser_id 	location_id 	job_title 	 date_added

						//$user_id=intval($_REQUEST['id']);

						$data['employee_name']=$_POST['employee_name'];
						if(isset($_POST['cpassword'])){
						$data['password']=base64_encode($_POST['cpassword']);
						}
						$data['parent_id']=$_SESSION["muser_id"];
						$data['email']=$_POST['email'];
						$data['privileges']=implode(",",$_POST['privileges']);
						$data['store_name']=$_POST['company_name'];
						$data['address1']=$_POST['address1'];
						$data['country']=$_POST['country'];
						$data['city']=$_POST['city'];
						$data['state']=$_POST['state'];
						$data['zip']=$_POST['zip'];
						$data['phone']=$_POST['phone'];
						$data['website']=$_POST['website'];
						$data['about']=$_POST['about'];
						$data['here_from']=$_POST['here_from'];
						$data['business_type']=$_POST['business_type'];
						$data['paypal_id']=$_POST['paypal_email'];
						$data['status']='merchant_maintainer';


						/*
						 * $data['work_zipcode']=$_POST['work_zipcode'];
						$data['gender']=$_POST['gender'];
						$data['age_range']=$_POST['age_range'];
						$data['reg_ip']=$_SERVER['REMOTE_ADDR'];
						$data['reg_type']='merchant';

						$data['address2']=$_POST['address2'];

						$data['fax']=$_POST['fax'];
						 */

						if($_REQUEST['mode']=="edit")
						{
							$date_modified=date("Y-m-d H:i:s");
							$data['date_modified']=$date_modified;
							//$db->query_update(TABLE_MERCHANTS, $data, "mid='$user_id'");

						}
						else
						{
							$date_added=date("Y-m-d");
							$data['date_added']=$date_added;
							//echo '<pre>'.print_r($data, true).'</pre>';
							//$user_id=$db->query_insert(TABLE_MERCHANTS, $data);

						}

						//header("location:show_merchant_users.php");

					}

					?>

					<?php
						if($_REQUEST['mode']=="edit")
						{
					?>
							<form method="post" action="?id=<?php echo $user_id;?>&mode=edit" enctype="multipart/form-data" onSubmit="return validation()">

					<?php
						}
						else
						{
					?>
							<form method="post" enctype="multipart/form-data" onSubmit="return validation()">

					<?php
						}
					?>

										<!-- Fieldset -->
										<fieldset style="border: 1px solid #CCCCCC; clear: both; padding: 2px; width: 610px;">

									<?php
										if($_REQUEST['mode']=="edit")
										{
									?>
											<legend style="font-size: 12px;">Edit Account</legend>

									<?php
										}
										else
										{
									?>
											<legend style="font-size: 12px;">Create Account</legend>

									<?php
										}
									?>

										<!-- 	<dl>
												<dt><label for="company_name">Company Name:</label></dt>
												<dd>
													<input type="text" name="company_name" id="company_name" size="54" value="<?php echo stripslashes($row_deals[store_name]);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /><br />
												<span class="validate_error" style="color:#FF0000" id="err1"></span>
												</dd>
											</dl> -->

											<dl>
												<dt><label for="job_type">Merchant Name:</label></dt>
												<dd>
													<input type="text" name="employee_name" id="employee_name" class="lf" size="39" value="<?php echo stripslashes($row_deals[employee_name]);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /><br />
												<span class="validate_error" style="color:#FF0000" id="err1"></span>
												</dd>
											</dl>

										<!--	<dl>
												<dt><label for="address1">Company Address:</label></dt>
												<dd><input type="text" name="address1" id="address1" size="54" value="<?php echo $row_deals[address1]?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
											</dl>

											 <dl>
												<dt><label for="email">Company Address 2:</label></dt>
												<dd><input type="text" name="address2" id="address2" size="54" value="<?php echo stripslashes($row_deals[address2]);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
											</dl>

											<dl>
												<dt><label for="city">Company City:</label></dt>
												<dd>
												<select name="city">
												<option value="">-- Select --</option>
												<?php $city=$db->fetch_all_array("SELECT * FROM ".TABLE_CITIES." where status='1' group by city_name order by city_name asc");

												foreach($city as $cityitem){
												?>
												<?php if($row_deals[city]==$cityitem['city_name']){?>
												<option value="<?php echo $cityitem['city_name']?>" selected="selected"><?php echo $cityitem['city_name']?></option>
												<?php }else{?>
												<option value="<?php echo $cityitem['city_name']?>"><?php echo $cityitem['city_name']?></option>
												<?php }?>
												<?php }?>
												</select>
												</dd>
											</dl>

											<dl>
												<dt><label for="state">Company State:</label></dt>
												<dd><input type="text" name="state" id="state" size="54" value="<?php echo stripslashes($row_deals[state]);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
											</dl>
											<dl>
											<dt><label for="country">Company Country:</label></dt>

											<select name="country" class="dropdown" id="country" size="1">
													<option value="">-- Select --</option>
													<?php

														$sql_categories=mysql_query("select * from " .TABLE_COUNTRIES." order by country_name asc");
														while($row_categories=mysql_fetch_array($sql_categories))
														{
													?>

															<option value="<?php echo $row_categories[country_id];?>" <?php if($row_categories[country_id]==$row_deals[country]) { echo "selected"; }?>><?php echo $row_categories[country_name];?></option>
													<?php
														}
													?>
												</select>
									</dl>


											<dl>
												<dt><label for="zip">Company Zipcode: </label></dt>
												<dd><input class="lf" name="zip" id="zip" type="text" value="<?php echo $row_deals[zip]?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;"/>
												</dd>
											</dl>-->

											<dl>
												<dt><label for="password">Password: </label></dt>
												<dd><input class="lf" name="password" id="password" type="password" size="54" value="" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;"/>
												<span class="validate_error" id="err2"></span></dd>
											</dl>



											<dl>
												<dt><label for="cpassword">Confirm Password: </label></dt>
												<dd><input class="lf" name="cpassword" id="cpassword" type="password" value="" size="54" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;"/>
												<span class="validate_error" id="err3"></span></dd>
											</dl>


											<dl>
												<dt><label for="email">User Email: </label></dt>
												<dd><input class="lf" name="email" id="email" type="text" size="54" value="<?php echo $row_deals[email]?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;"/>
												<span class="validate_error" id="err4"></span></dd>
											</dl>

										<dl>
											<dt><label for="phone">Phone:</label></dt>
											<dd><input type="text" name="phone" id="phone" class="lf" size="54" value="<?php echo stripslashes($row_deals[phone]);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
										</dl>

									<!-- 	<dl>
											<dt><label for="website">Website:</label></dt>
											<dd><input type="text" name="website" id="website" size="54" value="<?php echo stripslashes($row_deals[website]);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
										</dl>


										<dl>
											<dt><label for="paypal_email">Paypal Email:</label></dt>
											<dd><input type="text" name="paypal_email" id="paypal_email" size="54" value="<?php echo stripslashes($row_deals[paypal_id]);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
										</dl> -->

										<dl>
										<?php
											// All Priviledes //
											// manage_user,manage_deal,manage_admin,manage_merchant,manage_dealcategory,manage_city,manage_staticpage,manage_faq
											$privileges=explode(",",$row_deals[privileges]);
										?>
											<dt><label for="privileges">Permission:</label></dt>
											<dd>
											<input type="checkbox" name="privileges[]" value="manage_deal" <?php if(in_array("manage_deal",$privileges)){echo "checked";}?>/> Manage Deal <br />
											<input type="checkbox" name="privileges[]" value="manage_store" <?php if(in_array("manage_store",$privileges)){echo "checked";}?>/> Manage Store <br />
											</dd>
										</dl>

										<dl>
											<dt><label for="about">Note:</label></dt>
											<dd><textarea name="about" id="about" class="lf"  rows="10" cols="70" style="border: 1px solid #CCCCCC; background:#ececec; width: 530px; height: 200px;" /><?php echo stripslashes($row_deals[about]);?></textarea></dd>
										</dl>


											  <dl>
												<input type="submit" name="submitUser" id="submitUser" value="Submit" class="submit" style="margin-left: 300px;"/>
												 </dl>
											</fieldset>
										<!-- End of fieldset -->
									</form>



         </div>

		<!-- user add form ends -->
		</div>
				</div>

			</div>
		</div>

	</div>



</div>
</div>

</div> <!-- container end -->






</div>
</div>
<?php //include ('include/sidebar.php'); ?>

<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
</div></div>
<div style="clear:both"></div>
<?php include ('include/footer.php');
}
?>