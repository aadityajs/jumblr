<?php 
ob_start();
session_start();
$merchant_id=$_REQUEST['merchant_id'];

					
require("../config.inc.php");
require("../class/Database.class.php");

$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);			
$db->connect();
mysql_query("SET CHARACTER SET utf8"); 

$sql="SELECT * FROM ".TABLE_STORES." where 1=1 and  ".TABLE_STORES.".merchant_id='".$merchant_id."'";
																									
$m_store=mysql_fetch_object(mysql_query($sql));



echo '<option value="">-- Select --</option>';
												
	
	$sql_stores=mysql_query("select location_id,location_name from " .TABLE_STORES_LOCATION." where 1=1 and store_id='".$m_store->store_id."' order by location_name asc");
	while($row_stores=mysql_fetch_array($sql_stores))
	{	
	
	
												
	
	
	echo '<option value="'.$row_stores[location_id].'" >'.$row_stores[location_name].'</option>';
	
	}
			