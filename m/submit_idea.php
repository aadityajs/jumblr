<?php include("include/header.php");?>
<?php
error_reporting(E_ERROR && E_STRICT);
?>
<div id="container">
<div style="margin-top: 0;" id="leftcol">

<div class="deal_info">
<div class="top_about">
<p>Submit Ideas</p>
</div>
<div class="clear"></div>
<div class="midbg">
    <div class="today_deal">


<?php
	if ($_POST['submit']) {
	$date = date('M-d h:m');

	if ((isset($_POST['name'])) && (strlen(trim($_POST['name'])) > 0)) {
	$name = stripslashes(strip_tags($_POST['name']));
	} else {$name = 'No name entered';}

	if ((isset($_POST['email'])) && (strlen(trim($_POST['email'])) > 0)) {
		$email = stripslashes(strip_tags($_POST['email']));
	} else {$email = 'No email entered';}

	if ((isset($_POST['enquery'])) && (strlen(trim($_POST['enquery'])) > 0)) {
		$enquery = stripslashes(strip_tags($_POST['enquery']));
	} else {$enquery = 'No enquery selected';}

	if ((isset($_POST['phno'])) && (strlen(trim($_POST['phno'])) > 0)) {
		$phno = stripslashes(strip_tags($_POST['phno']));
	} else {$phno = 'No phone number given';}

	if ((isset($_POST['details'])) && (strlen(trim($_POST['enquery'])) > 0)) {
		$details = stripslashes(strip_tags($_POST['details']));
	} else {$details = 'No details entered';}

	$ticket = 'IDA-'.str_rand($length = 6, $seeds = 'numeric');




	$sql_contact = "INSERT INTO getdeals_contact VALUES ('','$name','$ticket','$email','$phno','$details',1,'$date')";
	mysql_query($sql_contact);


}
?>

<?php
if ( $_GET['submit'] == "done") {
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="popup_form" style="width:95%;">
      <tr>
        <td class="thank_you">Thank You</td>
      </tr>
      <tr>
        <td>We thank you for submitting your idea to us. Our team of experts will have a look at your idea based on the information you have submitted on the “ideas submission” form and we will contact you.
</td>
      </tr>
      <tr>
        <td>If we like your idea then will ask for more information before taking any further step to make sure it is the best for thing to do for our subscribers.
</td>
      </tr>
    </table>

    <div class="clear"><img src="images/spacer.gif" alt="" width="1" height="30" /></div>
<?php
} else { ?>

<form action="<?php echo SITE_URL; ?>submit_idea.php?submit=done" method="post" onsubmit="return validateForm();" name="ContactForm">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="popup_form" style="width:95%;">
      <tr>
        <td>If you have a idea for GeeLaza then we are more than happy to hear it and give you our feedback.  At GeeLaza, we are always trying different and new things to give our subscribers the most of our service.</td>
      </tr>
      <tr>
        <td>Please fill out the “Ideas submission” form below and we will contact you as soon as possible.</td>
      </tr>
      <tr>
        <td>Your full name <span class="">*</span></td>
      </tr>
      <tr>
        <td><input type="text" name="name" id="Cname" class="txt_box1" style="width:630px;"/>
            <div class="error_orange"  style="display: none;" for="name" id="Cname_error">This field is required.</div>
        </td>
      </tr>
      <tr>
        <td>Your email address <span class="">*</span></td>
      </tr>
      <tr>
        <td><input type="text" name="email" id="Ccont_email" class="txt_box1" style="width:630px;"/>
            <div class="error_orange"  style="display: none;" for="email" id="Cemail_error">This field is required.</div>
        </td>
      </tr>
      <tr>
        <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>What is your idea about? <span class="">*</span></td>
                <td>Contact telephone number <span class="">*</span></td>
              </tr>
               <tr>
                <td>
                    <div style="width:300px;" class="styled_select">
                    <select name="enquery" id="Cenquery" style="width:320px; color: #666666;">
                        <option value="">Select your Subject</option>
                        <option value="Deal">Deal</option>
                        <option value="Deal Timing">Deal Timing</option>
                        <option value="Marketing ">Marketing </option>
                        <option value="Other">Other (specific below)</option>
                        <option value="Users">Users</option>
                        <option value="Website">Website</option>
                    </select>
                    </div>
                    <div class="error_orange"  style="display: none;" for="enquery" id="Cenquery_error">This field is required.</div>
                </td>
                <td><input type="text" name="phno" id="Cphno" class="txt_box1" style="width:300px;"/>
                    <div class="error" for="phno" style="display: none;" id="Cphno_error">&nbsp;</div>
                </td>
              </tr>
            </table>
        </td>
      </tr>
      <tr>
        <td>Tell us more about the idea to help us make the best decision<span class="">*</span></td>
      </tr>
      <tr>
        <td>
            <textarea name="details" id="Cdetails" style="width:630px;"></textarea>
            <div class="error_orange"  style="display: none;" for="details" id="Cdetails_error">This field is required.</div>
        </td>
      </tr>
      <tr>
      <td><input type="submit" name="submit"  value=" " class="submit_btn0" id="submitBtn"></td>
      </tr>


    </table>
</form>
<?php } 	// end else ?>
<script type="text/javascript">
//validate and process form
// first hide any error messages
$('.error_orange').hide();

function validateForm() {
	var name = $("input#Cname").val();
	var email = $("input#Ccont_email").val();
	var enquery = $("select#Cenquery").val();
	var phno = $("input#Cphno").val();
	var details = $("textarea#Cdetails").val();

	if (name == "" || email == "" || enquery == "" || details == "") {
	  $("div#Cname_error").show();
	  $("div#Cemail_error").show();
	  $("div#Cenquery_error").show();
	  $("div#Cdetails_error").show();
	  //$("div#phno_error").show();
	 // $("input#name").focus();
	  return false;
	}
}

</script>

    <div class="clear"><img src="images/spacer.gif" alt="" width="1" height="5" /></div>
    </div>
</div>
<div class="bot_about"></div>
</div>



</div>
</div>
</div>
</div>
<?php include ('include/sidebar.php');?>
</div>
<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
<?php include ('include/footer.php'); ?>