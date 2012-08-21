<?php 
require("config.inc.php");
require("class/Database.class.php");
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);			
$db->connect();
error_reporting(E_ERROR && E_STRICT);
session_start();

if ($_GET['city_id']) {
	
	$user_id = $_SESSION['user_id'];
	$city_id = $_GET['city_id'];
	
	$sql_chk_city = mysql_num_rows(mysql_query("SELECT * FROM ".TABLE_USER_SUBSCRIPTION." WHERE user_id = $user_id AND city_id = $city_id"));
	
	//$get_city = mysql_num_rows(mysql_query("SELECT * FROM ".TABLE_USER_SUBSCRIPTION." WHERE user_id = $user_id AND city_id = $row_city[city_id]"));
	
	if ($sql_chk_city <= 0) {
	
		if ($city_id != '') {
		
				$sql_select = "INSERT INTO ".TABLE_USER_SUBSCRIPTION." VALUES ('', $user_id, $city_id)";
				$result_select = mysql_query($sql_select);
				//echo '"Your subscription have been updated"';
				
		}
	}
	else {
		if ($city_id != '') {
		
				$sql_delete = "DELETE FROM ".TABLE_USER_SUBSCRIPTION." WHERE user_id = $user_id AND city_id = $city_id";
				$result_delete = mysql_query($sql_delete);
				//echo '"Your unsubscription have been updated"';
		}
	}
	
}

?>