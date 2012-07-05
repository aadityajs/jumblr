<?php include("include/header.php");?>
<?php
error_reporting(E_ERROR && E_STRICT);
?>

<?php
/** Function to validate email with PHP
 * @author Aditya Jyoti Saha
 *
 * */
function ValidateEmail($email) {
	//$email = "someone@example.com";

	if(eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) {
	  //echo "Valid email address.";
	  return TRUE;
	}
	else {
	  //echo "Invalid email address.";
	  return FALSE;
	}
}
?>

<?php

	if ($_GET['unsub_email'] != "") {
			
			$sql_select = "SELECT * FROM ".TABLE_USERS." WHERE email= '$_GET[unsub_email]'";
			$result_select = mysql_fetch_array(mysql_query($sql_select));
		
			$user_id = $result_select['user_id'];
		$unsub_user_sql = "DELETE FROM ".TABLE_USER_SUBSCRIPTION." WHERE user_id = $user_id";
		mysql_query($unsub_user_sql);
	}

?>


<div id="container">
<div id="leftcol">
<div class="deal_curve1">
<div class="top_curve1"></div>
<div class="clear"></div>
<div class="mid_curve1">
<div class="signup_box1">


	<p class="reset" style="padding: 0 0 0 15px; line-height: 10px; margin: 0px 0 0 0;">
		Your e-mail address has been unsubscribed successfully from GeeLaza newsletter.
	</p>




</div>
</div>
<div class="bot_curve1"></div>
</div>

<!-- deal box ends -->

</div>
<?php include ('include/sidebar.php');?>
</div>
</div></div>
<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
<?php include ('include/footer.php'); ?>