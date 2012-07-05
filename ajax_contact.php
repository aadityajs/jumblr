<?php
require("config.inc.php");
require("class/Database.class.php");
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();
error_reporting(E_ERROR && E_STRICT);
session_start();


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

if ((isset($_POST['details'])) && (strlen(trim($_POST['details'])) > 0)) {
	$details = stripslashes(strip_tags($_POST['details']));
} else {$details = 'No details entered';}

$ticket = str_rand($length = 6, $seeds = 'numeric');
ob_start();
?>
<html>
<head>
<style type="text/css">
</style>
</head>
<body>
<!-- <table width="550" border="0" cellspacing="2" cellpadding="2">
  <tr bgcolor="#eeffee">
    <td>Name</td>
    <td><?=$name;?></td>
  </tr>
  <tr bgcolor="#eeeeff">
    <td>Email</td>
    <td><?=$email;?></td>
  </tr>
  <tr bgcolor="#eeffee">
    <td>Enquery Tepe</td>
    <td><?=$enquery;?></td>
  </tr>
  <tr bgcolor="#eeeeff">
    <td>Phone</td>
    <td><?=$phno;?></td>
  </tr>
    <tr bgcolor="#eeffee">
    <td>Details</td>
    <td><?=$details;?></td>
  </tr>
</table> -->

<table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top"><table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="531" style="font-family: Arial, Helvetica, sans-serif; text-align:right; line-height:24px; color:#999999; font-size:12px; font-weight: normal;">This message has come from the Geelaza customer service team</td>
        <td>&nbsp;</td>
        <td width="90" style="font-family: Arial, Helvetica, sans-serif; line-height:20px; color:#2a1d2f; font-size:12px; font-weight: bold;">Ticket #<?php echo $ticket; ?></td>
      </tr>
      <tr>
        <td colspan="3" style="border-top: 4px solid #7fd7fc;">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3" style="font-family: Arial, Helvetica, sans-serif; text-align:left; line-height:24px; color:#000; font-size:12px; font-weight: normal;">
          <p>Hi there, and we thank you for writing to GeeLaza.<br />
          </p>
          <p>This is a automated reply to let you know that we have received your request. We will get back to you shortly.</p>
          <p>Thanks again,<br />
          </p>
          <p>The GeeLaza Customer Service Team<br />
          </p>
          <p>Your request is monitored and here's a reminder of what your ticket was about.<br />
          </p>
          <p style="font-family: Arial, Helvetica, sans-serif; letter-spacing: 1px; line-height:20px; color:#2a1d2f; font-size:12px; font-weight: bold;">------------------------------------------------------------------------------------------------------------------------------------------------------</p>
          <p><strong><?=$email;?>, <?php echo date('M-d h:m'); ?> (BST):</strong></p>
          <p><?=$details;?></p></td>
      </tr>
      <tr>
        <td colspan="3" style="border-top: 4px solid #7fd7fc;">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
      </tr>

    </table></td>
  </tr>
</table>

</body>
</html>

<?
$body = ob_get_contents();
$date = date('M-d h:m');
	$sql_contact = "INSERT INTO getdeals_contact VALUES ('','$name','$ticket','$email','$phno','$details',1,'$date')";
	mysql_query($sql_contact);

	$to = $email;
	$subject = 'Request Received: (ticket #'.$ticket.')';
	$content = $body;

	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= "From: GeeLaza Support<support@geelaza.com>". "\r\n" ;

	  mail($to,$subject,$content,$headers);
	  exit;
?>