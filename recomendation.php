<?php
include("include/header.php");
include_once "fbmain.php";
?>
<?php
	if(!isset($_COOKIE["subscribe"]))
	header("location:".SITE_URL);
?>
<div id="container">
<div id="leftcol">
<div class="deal_info">
<div class="green_curv10"></div>
<div class="clear"></div>
<div class="green_curv30">
<div class="today_deal">
<div class="register_box1">


<div class="clear"></div>



<div class="today_deal" style="width:660px; margin: 0 auto; padding:0px;">

<h6 style="margin:0; background:#fff; padding:0 0 6px 0; line-height:46px; font-size:25px; height:auto; white-space:normal;">Recommend us and we will top up your credit</h6>
 <div class="content_box3">
    Why not surprise your friends with unbeatable deals in your city while earning easy cash at the same time?
    We love our customers so therefore we will reward you &pound;5 worth of credit for every new customer you bring our way (see details below)
</div>

<div class="heading_txt2">This is how it works:</div>
<p class="center_align">
	<img src="images/recomand.gif" alt="" width="522" height="171"/></p>

<div class="content_box2" style="width:660px; border:1px solid #edeced; margin:0px; background:none; padding-top:10px;">
	<h1 style="width:100%; text-align:center;">Get going and invite your friends</h1>
	<ul style="width:48%; float:left; margin-left:15px;">
    	<li class="right_align newBtn_ani" style="padding:15px 25px;">
        	<a href="<?php echo SITE_URL; ?>customer-register.php?ref=recomendation"><!--<img src="images/btn_01.gif" alt="" width="166" height="45"/>--></a>        </li>
        <li>
        	<b style="font-size:12px;">Log in and receive your recommendation link.</b> <br />You dont have an account yet? <a href="<?php echo SITE_URL;?>customer-register.php" style="text-decoration:underline;">Sign up here</a></li>
    </ul>
    <ul style="width:48%; float:right;">
        <li class="newLogin_ani" style="padding:15px 0;">
        	<a href="<?php echo SITE_URL; ?>customer-login.php?ref=recomendation"><!--<img src="images/btn_02.gif" alt="" width="113" height="45"/>--></a>        </li>
    	<li>
        	<b style="font-size:12px;">Pass on your personal link </b> <br /> You can pass on the link via e-mail or on your Website, Facebook or by any other means necessary.
        </li>
    </ul>
  <div class="clear"></div>
 </div>

<h1 style="width:100%; padding:15px 0; text-align:left; font-family: Candara, Arial, Helvetica, sans-serif; font-size: 21px; color:#444540;">OK, but how does GeeLaza credits work?</h1>

 <div class="content_box2" style="margin:0px; width:660px; background:none; padding:10px 0;">
        	<b style="text-align:left; font-family: Candara, Arial, Helvetica, sans-serif; font-size: 14px; color:#444540;"> Why recommend deals?</b><br /> Recommending deals has many benefits but most importantly, we will credited you with &pound;5.00 which means you can get your next deal at even greater discounted price. The main reason we like our users to recommend deals is because we feel god to know that all people who are interested in buying our deals are aware of the deal. Help your friends and families to save money on great deals too!
</div>

 <div class="content_box2" style="margin:0px; width:660px; background:none; padding:10px 0;">
        	<b style="text-align:left; font-family: Candara, Arial, Helvetica, sans-serif; font-size: 14px; color:#444540;"> How can I recommend GeeLaza to my friends who havent heard of GeeLaza?</b><br /> We provide our users with easy recommendation facilities to allow them to tell friends without doing much. Every deal that we feature on GeeLaza are assigned with a special link which you can send to your friends using Facebook, Twitter or Email.<br /><br /> Whoever you recommend GeeLaza to, they will have 48 hours to create an account on GeeLaza and buy any deal for the first time. If they don't then they will NOT receive the credits.
</div>
<div class="content_box2" style="margin:0px; width:660px;  background:none; padding:10px 0;">
<b style="font-size:13px; text-align:left; font-family: Candara, Arial, Helvetica, sans-serif; font-size: 14px; color:#444540;">How long is my account credit valid until?</b><br /> You have 3 months to use your credit. After the 3 months your unused credit will be no longer be valid to use.
</div>

<div class="content_box2" style="margin:0px; width:660px;  background:none; padding:10px 0;">
<b style="font-size:13px; text-align:left; font-family: Candara, Arial, Helvetica, sans-serif; font-size: 14px; color:#444540;">How can I spend my credits?</b><br /> You can use your credit on any deal you want. You will have to redeem your credit on the payment page otherwise the credit will not be rewarded towards your deal price. If you have recommended us to many people then there may be situation where your account credit is more than the deal price so in this case, whatever is left over can be used on your deal unless it has expired.
</div>

</div>







</div>
</div>
</div>
<div class="green_curv20"></div>
</div>
</div>

<?php include ('include/sidebar-login.php'); ?>
</div>

<?php include("include/footer.php");?>