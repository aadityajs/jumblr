<?php
session_start();
require("config.inc.php");
require("class/Database.class.php");
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);			
$db->connect();
mysql_query("SET CHARACTER SET utf8");


$uploaddir = './upload_files/profile_image/'; 
$sql="SELECT * FROM ".TABLE_STORES_PROFILEIMG." where  imgid='".$_REQUEST['imgid']."'";
$img=$db->query_first($sql);

echo $img['file'];
?>