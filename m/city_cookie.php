<?php
require("config.inc.php");
require("class/Database.class.php");
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();
session_start();

if ($_GET['city'] != "" ) {

		$chnaged_city = $_GET['city'];

		$cookie_val = $_COOKIE["subscribe"];
		$arr = explode("|",$cookie_val);

		$email = $arr[0];
		$arr[1] = $chnaged_city;
		$city_id = $arr[1];
		$new_cookie_val = implode('|', $arr);
		setcookie('subscribe', $new_cookie_val, time()+3600*24);
		//header('location:'.SITE_URL);

		$sql_today = "SELECT * FROM ".TABLE_DEALS." WHERE status >= 1 AND deal_end_time >= '".date("Y-m-d")."' AND city = $chnaged_city LIMIT 0, 1";
		$today_res = mysql_fetch_array(mysql_query($sql_today));
		$_SESSION['current_deal_id'] = $today_res['deal_id'];

		$country = 225;
		$city_name_data = mysql_fetch_array(mysql_query("SELECT * FROM ".TABLE_CITIES."  WHERE city_id = $chnaged_city"));
		$city_name = strtolower($city_name_data['city_name']);
		$city_name = str_replace(' ', '-', $city_name);

		if ($_GET['newssucc'] != "" && $_GET['city'] != "") {
				header('location:'.SITE_URL.'?newssucc='.$_SESSION['newssucc']);
				//echo "hi";
			}
			else {
				//header('location:'.SITE_URL);
				//header('location:'.SITE_URL.'deals/'.$city_name.'/'.$chnaged_city);
				header('location:'.SITE_URL.$city_name);	// .'/'.$chnaged_city
			}
		unset($_SESSION['newssucc']);

		//echo "hi";
	}




?>