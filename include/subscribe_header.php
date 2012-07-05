<?php
ob_start();
session_start();
require("config.inc.php");
require("class/Database.class.php");
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);			
$db->connect();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta http-equiv="imagestoolbar" content="no" />
	<title>Welcome to our site</title>
	<link href="css/getdeals_style.css" rel="stylesheet" type="text/css" />
	
		
	<!--<link href="css/base.css" rel="stylesheet" type="text/css" />-->
	
	<link href="css/nav.css" rel="stylesheet" type="text/css" />
     <script type="text/javascript" src="js/city.js"></script>
	 
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/jquery.dd.js"></script>
		<script type="text/javascript" src="js/jquery.bxSlider.js"></script>
		 <script src="js/overlib.js"></script>
		
		<link rel="stylesheet" type="text/css" href="css/dd.css" />
		<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>

		--><!--<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css"/>-->
</head>

<body>
<div id="maindiv">

<div id="header">
	<div class="header_left" style="margin-left:570px;"><a href="<?= SITE_URL ?>"><img src="images/logo.gif" alt="" width="181" height="107" border="0"/></a></div>
</div>
</div>				
