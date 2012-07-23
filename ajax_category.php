<?php
require("config.inc.php");
require("class/Database.class.php");
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();
error_reporting(E_ERROR && E_STRICT);
session_start();
print_r($_SESSION);

$cat_id = $_REQUEST['cat_id'];
$details = mysql_escape_string($_REQUEST['details']);

	$date = time();

	//if (isset($_SESSION['fb_id'])) {
		echo $sql_contact = "INSERT INTO ".TABLE_DEAL_GROUP." VALUES ('','$cat_id','$_SESSION[fb_id]','$_SESSION[user_id]','','0','$details','$date','1')";
		//mysql_query($sql_contact);
	//}


?>
