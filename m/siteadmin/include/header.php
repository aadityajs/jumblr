<?php
ob_start();
session_start();
date_default_timezone_set('Europe/London');
if($_SESSION['admin_id']=="")
{
	header("location:index.php");
}
include("../fckeditor/fckeditor.php");
require("../config.inc.php");
require("../class/Database.class.php");
require_once('../class/Thumbnail.class.php');
require("../class/SimpleLargeXMLParser.class.php");
require("../class/pagination.class.php");
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();
mysql_query("SET CHARACTER SET utf8");

$admin_id=intval($_SESSION['admin_id']);
$sql = "SELECT admin_name FROM `".TABLE_ADMIN."` WHERE admin_id='$admin_id'";
$record = $db->query_first($sql);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::<?php echo TITLE;?>:: Administrator Panel</title>
<link rel="stylesheet" type="text/css" href="style.css" />

	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
  	 <!----><script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
  	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>


		<script type="text/javascript" src="js/jquery-1.6.4.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-timepicker-addon.js"></script>

		<link rel="stylesheet" media="all" type="text/css" href="css/jquery-ui-1.8.16.custom.css" />
		<link rel="stylesheet" media="all" type="text/css" href="css/custom-timer.css" />
		<link rel="stylesheet" media="all" type="text/css" href="css/places.css" />


<!--<script type="text/javascript" src="js/jquery6.min.js"></script>-->
<script type="text/javascript" src="js/ddaccordion.js"></script>


<link rel="stylesheet" href="../css/lat-long-drag_1.css" type="text/css" media="screen" />
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="../js/lat-long-drag_1.js"></script>	
<script type="text/javascript" src="../js/lat-long-drag_all.js"></script>	   


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

<script language="javascript" type="text/javascript" src="js/niceforms.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="js/niceforms-default.css" />

<link rel="stylesheet" type="text/css" media="all" href="niceforms-default.css" />
 <script type='text/javascript' src="zpcal/utils/zapatec.js"></script>
   <script type="text/javascript" src="zpcal/src/calendar.js"></script>
   <script type="text/javascript" src="zpcal/lang/calendar-en.js"></script>
   <link href="zpcal/website/css/zpcal.css" rel="stylesheet" type="text/css">
   <link href="zpcal/themes/aqua.css" rel="stylesheet" type="text/css">
   <!-- -->









</head>
<body  onload="startTime()">
<div id="main_container">
	<div class="header">
<div class="logo"><a href="<?php echo SITE_URL; ?>siteadmin/home.php"><img src="images/logo.png" alt="" title="" border="0" style="margin-top:-30px"/></a></div>

<!-- Clock code starts -->
<div id="clock" style="color: #55C9EE; font: normal 16px/45px Arial; width: auto; height: 40px; float: left; margin-top: 10px; ">

<script type="text/javascript">

//Depending on whether your page supports SSI (.shtml) or PHP (.php), UNCOMMENT the line below your page supports and COMMENT the one it does not:
//Default is that SSI method is uncommented, and PHP is commented:

//var currenttime = '<!--#config timefmt="%B %d, %Y %H:%M:%S"--><!--#echo var="DATE_LOCAL" -->' //SSI method of getting server date
var currenttime = '<?php print date("F d, Y H:i:s", time()); ?>' //PHP method of getting server date

///////////Stop editting here/////////////////////////////////

var montharray=new Array("January","February","March","April","May","June","July","August","September","October","November","December")
var serverdate=new Date(currenttime)

function padlength(what){
var output=(what.toString().length==1)? "0"+what : what
return output
}

function displaytime(){
serverdate.setSeconds(serverdate.getSeconds()+1)
var datestring=montharray[serverdate.getMonth()]+" "+padlength(serverdate.getDate())+", "+serverdate.getFullYear()
var timestring=padlength(serverdate.getHours())+":"+padlength(serverdate.getMinutes())+":"+padlength(serverdate.getSeconds())
document.getElementById("servertime").innerHTML=" "+timestring+" BST" 		// datestring+" "+timestring
}

window.onload=function(){
setInterval("displaytime()", 1000)
}

</script>

<b> Current Server Time:</b> <span id="servertime"></span>


</div>
<!-- Clock code ends -->

<div class="clear"></div>
<div style="color: #55C9EE; font: normal 16px/15px Arial; width: auto; height: 20px;  margin:-40px 0 0 183px;"><b>Current Server Date: </b><?php echo date("Y-m-d"); ?></div>


     <div class="right_header" style=" vertical-align:top; margin-top:-60px;">Welcome <?php echo $record['admin_name'];?>  &nbsp;| <a href="logout.php" class="logout">Logout</a></div>

    </div>