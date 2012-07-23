<?php
require("config.inc.php");
require("class/Database.class.php");
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();
error_reporting(E_ERROR && E_STRICT);
session_start();
print_r($_SESSION);

$deal_id = $_REQUEST['deal_id'];
$details = mysql_escape_string($_REQUEST['details']);

	$date = time();

	if (isset($_SESSION['fb_id'])) {
		echo $sql_contact = "INSERT INTO ".TABLE_DEAL_GROUP." VALUES ('','$deal_id','$_SESSION[fb_id]','$_SESSION[user_id]','','0','$details','$date','1')";
		mysql_query($sql_contact);
	}

/*
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
*/
?>
