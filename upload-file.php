<?php
session_start();
require("config.inc.php");
require("class/Database.class.php");
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);			
$db->connect();
mysql_query("SET CHARACTER SET utf8");


$uploaddir = './upload_files/profile_image/'; 
$filename=uniqid().basename($_FILES['uploadfile']['name']);
$file = $uploaddir .$filename ; 
 
if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) { 

	
	mysql_query("INSERT INTO ".TABLE_STORES_PROFILEIMG." (  `file`, `tempid`) VALUES ('$filename', '".$_SESSION[tmpid]."');");
  $imgid=mysql_insert_id();
 
 echo $imgid;
  
} else {
	echo -1;
}
?>