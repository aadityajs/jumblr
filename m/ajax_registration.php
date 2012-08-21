<?php
require("config.inc.php");
require("class/Database.class.php");
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();
error_reporting(E_ERROR && E_STRICT);


if ($_GET['email']) {

	$email = $_GET['email'];

	if (ValidateEmail ($email) == TRUE) {

			$sql_select = "SELECT * FROM ".TABLE_MERCHANTS." WHERE email="."'".$email."'";
			$result_select = mysql_query($sql_select);
			$count_select = mysql_num_rows($result_select);

			//echo "------".$count_select;

			if($count_select > 0)
			{
				echo 'Email address already exists';
			}
	}
	else {
		echo 'Invalid email address';
	}


}



?>