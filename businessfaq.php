<?php
ob_start();
echo '<a name="top"></a>';
include("include/business_faq_header.php");
?>
<style>
.question a:hover {
	text-decoration: underline;
}
</style>
<div id="container">
<div id="leftcol">
<div class="deal_info">
<!--<div class="green_curv10"></div>-->
<div class="clear"></div>
<div class="green_curv30">
<div class="today_deal">
<div class="register_box1" style="width:100%;">

<h6 style="margin:0; background:#fff; padding:0 0 6px 15px; line-height:46px; font-size:28px;" >Do You Have Few Questions Before Joining Us?</h6>
<?php
	$bfaq_sql = "SELECT * FROM ".TABLE_BUSINESS_FAQS. " WHERE status = 1";
	$bfaq_res = mysql_query($bfaq_sql);
	$bfaq_num_rows = mysql_num_rows($bfaq_res);

	if ($bfaq_num_rows >= 0) {


	}


?>
<div class="geelaza_box">
    	<ul class="float_left" style="width:70%;">
          <?php
          	while ($bfaq_row = mysql_fetch_array($bfaq_res)) {
          ?>

            <li class="question"><a href="<?php echo "#".$bfaq_row['bquestion']; ?>">* <?php echo $bfaq_row['bquestion']; ?></a></li>

           <?php } ?>
        <!--
        	    <li>* How much does it cost to be featured on GeeLaza?</li>
            <li>* How does GeeLaza make money?</li>
            <li>* How do I get paid?</li>
            <li>* When will I be featured?</li>
            <li>* Who does the deal write-up?</li>
            <li>* Can I get the mailing list from you so I can use  it later?</li>

         -->
          </ul>
        <ul class="float_left" style="width:30%;">
        	<li><img src="images/help_icon.png" alt="" /></li>
        </ul>
      <div class="clear"></div>
	</div>
<?php
	$bfaq_sql = "SELECT * FROM ".TABLE_BUSINESS_FAQS. " WHERE status = 1";
	$bfaq_res = mysql_query($bfaq_sql);
	$bfaq_num_rows = mysql_num_rows($bfaq_res);

	if ($bfaq_num_rows >= 0) {


	}


?>
		<?php
          	while ($bfaq_row = mysql_fetch_array($bfaq_res)) {
          ?>

			<div class="content_box">
				<b><a name="<?php echo $bfaq_row['bquestion']; ?>"></a><?php echo $bfaq_row['bquestion']; ?></b><br />
				<?php echo $bfaq_row['banswer']; ?>
			</div>

           <?php } ?>

<!--

<div class="content_box" id="1">
	<b><a name="1"></a>What is GeeLaza?</b><br />
	GeeLaza offers daily deals on handpicked experiences that can be shared with friends and families. Our company technique is pretty straightforward: we treat all our customers the way we like to be treated. Our fantastic customer service and imagination has made GeeLaza a fast-growing company in the daily deals service category. All deals that are featured on GeeLaza are best of their kind.
</div>

<div class="content_box">
	<b>How much does it cost to be featured on GeeLaza?</b><br />
	The GeeLaza model has been developed to be an alternative to traditional advertising. Whereas most marketing methods (e.g. TV commercial, Print, Email) require upfront payment without providing any guarantee that your campaign will be successful, GeeLaza costs you nothing out-of-pocket.
</div>
<div class="content_box">
	<b>How does GeeLaza make money?</b><br />
	Very simple, we only make money if you do. When you work with GeeLaza, you’re investing only in the customers GeeLaza actually brings in. We keep a portion of the revenue from each GeeLaza sold and send you the rest.
</div>
<div class="content_box">
	<b>How do I get paid?</b><br />
	GeeLaza collects customer payment for you, distributes GeeLaza vouchers to those customers, and sends you a cheque.
</div>
<div class="content_box">
	<b>When will I be featured?</b><br />
	GeeLaza reserves the right to feature anything in our deal-line at anytime, just in case there are time-sensitive deals that come to our attention at the last minute. We use a various tools and techniques to determine the best placement for each feature, in order to make sure that the deal reaches maximum success. To make sure you have time to prepare your business and that all questions have been answered, we always contact you before we feature your business.
</div>
<div class="content_box">
	<b>Who does the deal write-up?</b><br />
	We take care of all the copy, and usually incorporate existing reviews from other blogs, websites, magazines, or newspapers. We do this to ensure that every GeeLaza deal is exciting, unique and unbeatable. This style of ours is very well known by our subscribers. It’s why most of our read our write-ups of the offer. That said, if there is some specific or unusual point you would like to include, you are more than welcome to suggest it to us.
</div>
<div class="content_box">
	<b>Can I get the mailing list from you so I can use it later?</b><br />
	We can’t give you our mailing for several reasons but most importantly our privacy policy restricts us from sharing our email list with third parties.
</div>

 -->

 <div class="main_box" style="width:660px; margin:20px auto 0 auto;">
	<span class="float_left" style="font:normal 12px/52px Arial, Helvetica, sans-serif; margin-right:8px; color:#00a2e8;"><b><a href="#top">Back Up</a></b> <img src="images/arrow_back.png" alt="" /></span>
    <span class="float_right"><a href="<?php echo SITE_URL; ?>merchant_login" class="apply_arrow1">&nbsp;</a></span>
    <span class="float_right" style="font:normal 12px/52px Arial, Helvetica, sans-serif; margin-right:8px;">Take one step beyond traditional marketing!</span>
 <div class="clear"></div>
</div>
<div class="clear"></div>
</div>





<br/><br/>
</div>
</div>
<!--<div class="green_curv20"></div>-->
</div>
</div>
<?php include ('include/business_faq_sidebar.php'); ?>
</div>
<?php include("include/footer.php");?>
