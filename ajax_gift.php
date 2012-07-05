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

if ((isset($_POST['details'])) && (strlen(trim($_POST['details'])) > 0)) {
	$details = stripslashes(strip_tags($_POST['details']));
} else {$details = 'No details entered';}


	$_SESSION['gift_mail'] == $email;
	$_SESSION['gift_msg'] == $details;
	$_SESSION['gift_name'] == $name;
?>
