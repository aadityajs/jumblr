
<div class="tabs">
<?php
$page = basename($_SERVER['REQUEST_URI']);
?>
<a href="<?= SITE_URL ?>merchant_adddailydeal" <?=($page == 'merchant_adddailydeal')? 'class="here"' : ''?>>Daily Deals</a>
<a href="<?= SITE_URL ?>merchant_addnowdeal" <?=($page == 'merchant_addnowdeal')? 'class="here"' : ''?>>Now Deals</a>
<a href="<?= SITE_URL ?>merchant_dailydealearning" <?=($page == 'merchant_dailydealearning')? 'class="here"' : ''?>>My Earnings</a>
<a href="<?= SITE_URL ?>merchant_redeem_coupon" <?=($page == 'merchant_redeem_coupon')? 'class="here"' : ''?>>Redeem Value</a>
<a href="#" onclick="changeClass(this.id);">My Feedback</a>
<a href="#" onclick="changeClass(this.id);">User Control</a>
<a href="#" onclick="changeClass(this.id);">Business Profile</a>
</div>
