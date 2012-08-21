<?php 
ob_start();
session_start();
if($_SESSION['memp_user_id']=="")
{
	header("location:merchant_employee_login.php");
}
include("fckeditor/fckeditor.php");
require("config.inc.php");
require("class/Database.class.php");
require_once('class/Thumbnail.class.php');
require("class/SimpleLargeXMLParser.class.php");
require("class/pagination.class.php");
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);			
$db->connect();
mysql_query("SET CHARACTER SET utf8"); 

$user_id=intval($_SESSION['memp_user_id']);
$sql = "SELECT employee_name,store_name FROM `".TABLE_MERCHANTS."` WHERE mid='$user_id'";
$record = $db->query_first($sql);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::<?php echo TITLE;?>:: Merchant Administrator Panel</title>
<link rel="stylesheet" type="text/css" href="css/merchantstyle.css" />

<script type="text/javascript" src="siteadmin/js/jquery6.min.js"></script>
<script type="text/javascript" src="siteadmin/js/ddaccordion.js"></script>
<script type="text/javascript">




ddaccordion.init({ //top level headers initialization
	headerclass: "expandable", //Shared CSS class name of headers group that are expandable
	contentclass: "categoryitems", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [0], //index of content(s) open by default [index1, index2, etc]. [] denotes no content
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", "openheader"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["suffix", "<img src='images/plus.gif' class='statusicon' />", "<img src='images/minus.gif' class='statusicon' />"], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})

ddaccordion.init({ //2nd level headers initialization
	headerclass: "subexpandable", //Shared CSS class name of sub headers group that are expandable
	contentclass: "subcategoryitems", //Shared CSS class name of sub contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click" or "mouseover
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [], //index of content(s) open by default [index1, index2, etc]. [] denotes no content
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["opensubheader", "closedsubheader"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["none", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})



</script>
<style type="text/css">



</style>
<script language="javascript" type="text/javascript" src="siteadmin/js/niceforms.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="siteadmin/js/niceforms-default.css" />

<link rel="stylesheet" type="text/css" media="all" href="siteadmin/niceforms-default.css" />
<script type='text/javascript' src="siteadmin/zpcal/utils/zapatec.js"></script>
   <script type="text/javascript" src="siteadmin/zpcal/src/calendar.js"></script>
   <script type="text/javascript" src="siteadmin/zpcal/lang/calendar-en.js"></script>
   <link href="siteadmin/zpcal/website/css/zpcal.css" rel="stylesheet" type="text/css">
   <link href="siteadmin/zpcal/themes/aqua.css" rel="stylesheet" type="text/css">

</head>
<body>
<div id="main_container">
	<div class="header">
<div class="logo"><a href="#"><img src="siteadmin/images/logo.png" width="145px" height="58px" alt="" title="" border="0" /></a></div>
    
     <div class="right_header">Welcome <?php echo $record['email'];?> | <a href="elogout.php" class="logout">Logout</a></div>
   
    </div>
	
	 <div class="main_content">
	 
	   <?php include("employee_top_menu.inc.php");?>                    
                    
    <div class="center_content">  
    
   		<?php require("employee_left_menu.php"); ?>        
    
    <div class="right_content">  
	
	

		
