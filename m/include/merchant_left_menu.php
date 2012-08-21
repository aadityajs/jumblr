<div class="left_content">

	
	
	
	<div class="arrowlistmenu">

		
		
		
		<div class="menuheader expandable">Daily Deals</div>
		<ul class="categoryitems">
			<li><a href="<?php echo SITE_URL;?>merchant_adddailydeal">Create a  <b>Daily Deal</b></a></li>
			<li><a href="<?php echo SITE_URL;?>merchant_dailydealactive">Active Deals</a></li>
			<li><a href="<?php echo SITE_URL;?>merchant_dailydealclosed">Closed Deals</a></li>
			
		</ul>
		
		<div class="menuheader expandable">Now Deals</div>
		<ul class="categoryitems">
			<li><a href="<?php echo SITE_URL;?>merchant_addnowdeal">Create a  <b>Now Deal</b></a></li>
			<li><a href="<?php echo SITE_URL;?>merchant_nowdealactive">Active Deals</a></li>
			<li><a href="<?php echo SITE_URL;?>merchant_nowdealclosed">Closed Deals</a></li>
			
		</ul>
		<div class="menuheader expandable">My Earning</div>
		<ul class="categoryitems">
			<li><a href="<?php echo SITE_URL;?>merchant_dailydealearning">Daily Deals</a></li>
			<li><a href="<?php echo SITE_URL;?>merchant_nowdealearning">Now Deals</a></li>
		</ul>
		<div class="menuheader expandable">Redeem Value</div>
		<ul class="categoryitems">
			<li><a href="<?php echo SITE_URL;?>merchant_redeem_coupon">Redeem</a></li>
			<li><a href="<?php echo SITE_URL;?>merchant_bulkredeem_coupon">Redeem Bulk Coupon</a></li>
			<li><a href="<?php echo SITE_URL;?>merchant_unredeem_coupon">Unredeem Coupon</a></li>
		</ul>
		<div class="menuheader expandable">Business Profile</div>
		<ul class="categoryitems">
			<li><a href="<?php echo SITE_URL;?>merchant_companyinfo">Company Information</a></li>
			<li><a href="<?php echo SITE_URL;?>merchant_storelocation">Locations</a></li>
			<li><a href="<?php echo SITE_URL;?>merchant_paymentinfo">Payment Information</a></li>
		</ul>
		
		<div class="menuheader expandable">My Feedback</div>
		<ul class="categoryitems">
			
			
		</ul>
		
		<div class="menuheader expandable">User Control</div>
		<ul class="categoryitems">
			<li><a href="<?php echo SITE_URL;?>add_admin">Add Admin</a></li>
			<li><a href="<?php echo SITE_URL;?>show_admin">Show Admin</a></li>	
			
		</ul>
		
	
		
		
		
		
	<div style="clear:both"></div>
	</div>
	<div style="clear:both"></div>
	
	<div class="leftprog">
		<?php 
	
$profile_arr=getprofile_array();

 $totalpro=count($profile_arr);
$done=0;
foreach($profile_arr as $key=>$arr){
if($arr==1)
$done=$done+1;
}

 $progress=round(($done*100)/$totalpro);
	?>
<div>
<p><b>Your Profile is <?php echo $progress?>% complete.</b></p>

<p>Follow the steps below to reach completion. A complete profile increases conversion. 	</p>
</div>

	<div <?php if($profile_arr['store_name']==0){echo "class='profile_noprog'";}else{echo "class='profile_prog'";}?>>1.<a href="#">Add Business Name</a></div>
<div <?php if($profile_arr['website']==0){echo "class='profile_noprog'";}else{echo "class='profile_prog'";}?>>2.<a href="#">Add your official website</a></div>
<div <?php if($profile_arr['primary_location']==0 || $profile_arr['location']==0){echo "class='profile_noprog'";}else{echo "class='profile_prog'";}?>>3.<a href="#">Please add your location</a></div>
<div <?php if($profile_arr['phone']==0){echo "class='profile_noprog'";}else{echo "class='profile_prog'";}?>>4.<a href="#">Please add your business phone</a></div>
<div <?php if($profile_arr['category_id']==0){echo "class='profile_noprog'";}else{echo "class='profile_prog'";}?>>5.<a href="#">Please select a category</a></div>
<div <?php if($profile_arr['profile_image']==0){echo "class='profile_noprog'";}else{echo "class='profile_prog'";}?>>6.<a href="#">Add 3 images</a></div>
<div <?php if($profile_arr['business_desc']==0 || $profile_arr['product_recommend']==0 || $profile_arr['experience']==0 || $profile_arr['stand_out']==0 || $profile_arr['why_not_come']==0 ){echo "class='profile_noprog'";}else{echo "class='profile_prog'";}?>>7.<a href="#">Questions in business profile</a></div>
<div <?php if($profile_arr['twitterpage']==0){echo "class='profile_noprog'";}else{echo "class='profile_prog'";}?>>8.<a href="#">Add your Twitter page</a></div>
<div <?php if($profile_arr['chq_address1']==0 || $profile_arr['chq_address2']==0 || $profile_arr['chq_city']==0 || $profile_arr['chq_state']==0 || $profile_arr['chq_zip']==0 || $profile_arr['chq_country']==0 || $profile_arr['chq_payable']==0){echo "class='profile_noprog'";}else{echo "class='profile_prog'";}?>>9.<a href="#">Add your remittance address</a></div>
<div <?php if($profile_arr['facebookpage']==0){echo "class='profile_noprog'";}else{echo "class='profile_prog'";}?>>10.<a href="#">Add your Facebook page</a></div>
<div <?php if($profile_arr['site_review']<=0){echo "class='profile_noprog'";}else{echo "class='profile_prog'";}?>>11.<a href="#">Add a link to your reviews</a></div>
	</div>

	
</div>