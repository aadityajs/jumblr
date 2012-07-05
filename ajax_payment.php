<?php
session_start();
ob_start();
require("config.inc.php");
require("class/Database.class.php");
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();


if ($_GET['id'] != "" && $_GET['qty'] != "")  {
	$prod_id = $_GET['id'];
	$prod_qty = $_GET['qty'];
	$multi_deal_id = $_GET['mid'];

	$sql_prod = "SELECT * FROM ".TABLE_DEALS." WHERE status >= 1 AND deal_id = '".$prod_id."' LIMIT 0, 1";
	$prod_res = mysql_fetch_array(mysql_query($sql_prod));

	// select multi deal if has
	/* */
	if ($prod_res['is_multi'] == 'y') {
	$sql_is_multi = "SELECT * FROM getdeals_multi_deals WHERE deal_id = ".$prod_res['deal_id']." AND multi_deal_id = ".$multi_deal_id;
	$is_multi = mysql_fetch_array(mysql_query($sql_is_multi));

	$total_price = $prod_qty * $is_multi['multi_deal_item_price'];
	$formatted_total_price = sprintf("%01.2f", $total_price);
	$formatted_total_price = number_format($formatted_total_price, 2);
	echo $formatted_total_price;
	$_SESSION['total_price'] = $formatted_total_price;
	}
	else {

	$total_price = $prod_qty * $prod_res['discounted_price'];
	$formatted_total_price = sprintf("%01.2f", $total_price);
	$formatted_total_price = number_format($formatted_total_price, 2);
	echo $formatted_total_price;
	$_SESSION['total_price'] = $formatted_total_price;
	}


}

?>
