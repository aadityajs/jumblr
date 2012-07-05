<?php
ob_start();
session_start();
if(!isset($_SESSION['ids'])){
header("location:show_users.php");
}

include("../fckeditor/fckeditor.php");


if($_SESSION['admin_id']=="")
{
	header("location:index.php");
}
require("../config.inc.php");
require("../class/Database.class.php");
require_once('../class/Thumbnail.class.php');
require("../class/SimpleLargeXMLParser.class.php");
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);			
$db->connect();
mysql_query("SET CHARACTER SET utf8"); 

$admin_id=intval($_SESSION['admin_id']);
$sql = "SELECT admin_name FROM `".TABLE_ADMIN."`  WHERE admin_id='$admin_id'";
$record = $db->query_first($sql);

$userids=unserialize($_SESSION['ids']);
foreach($userids as $uid){
$q=mysql_fetch_object(mysql_query("SELECT * from ".TABLE_USERS." where user_id='$uid'"));
$usermail .=$q->email.",";
}


if(isset($_REQUEST['submit']))
{	
	$usermail=$_POST['users'];
	$subject=$_POST['subject'];	
	$message=$_POST['message'];	
	
	
				// multiple recipients
			$to  = $usermail; // note the comma
			
			
			
			// message
			$messagebody = '
			<html>
			<head>
			  <title>Premium City.com Newsletter</title>
			</head>
			<body>
			
			  '.$message.'
			</body>
			</html>
			';
			
			// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			// Additional headers
			$headers .= 'To: ';
			$headerusermail=explode(",",$useremail);
			foreach($headerusermail as $useremail){
			$mailquery=mysql_fetch_object(mysql_query("SELECT first_name,last_name,email from ".TABLE_USERS." where email='".$useremail."'"));
			
			$headers .= $mailquery->first_name." ".$mailquery->last_name.'<'.$mailquery->email.'>,';
			
			}
			$headers .="\r\n";
			$headers .= 'From: GeeLaza.com <'.$record['email'].'>' . "\r\n";
			
			
			// Mail it
			$status=@mail($to, $subject, $message, $headers);
	
			if($status){
			$msg='<div class="valid_box">Message sent successfully to the users</div>';
			}
			else{
			$msg='<div class="error_box">Message not sent  to the users</div>';
			}
	
	


}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::<?php echo TITLE;?>:: Administrator Panel</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="clockp.js"></script>
<script type="text/javascript" src="clockh.js"></script> 
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="ddaccordion.js"></script>
<script type="text/javascript">
ddaccordion.init({
	headerclass: "submenuheader", //Shared CSS class name of headers group
	contentclass: "submenu", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", ""], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["suffix", "<img src='images/plus.gif' class='statusicon' />", "<img src='images/minus.gif' class='statusicon' />"], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})
</script>

<script language="javascript" src="../js/prototype-1.6.0.2.js"></script>
<script language="javascript" src="../js/prototype-base-extensions.js"></script>
<script language="javascript" src="../js/prototype-date-extensions.js"></script>
<script language="javascript" src="../js/datepicker.js"></script>
<link rel="stylesheet" href="../css/datepicker.css"></script>

<script type="text/javascript" src="jconfirmaction.jquery.js"></script>
<script type="text/javascript">
	
	$(document).ready(function() {
		$('.ask').jConfirmAction();
	});
	
</script>

<script language="javascript" type="text/javascript" src="niceforms.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="niceforms-default.css" />

</head>
<body>

<div id="main_container">

	<div class="header">
<div class="logo"><a href="#"><img src="images/logo.png" width="145px" height="58px" alt="" title="" border="0" /></a></div>
    
     <div class="right_header">Welcome <?php echo $record['admin_name'];?> | <a href="logout.php" class="logout">Logout</a></div>
    <div id="clock_a"></div>
    </div>
    
    <div class="main_content">
    
      <?php include("include/top_menu.inc.php");?>                    
                    
    <div class="center_content">  
    
   		<?php require("include/left_menu.php"); ?>        
    
    <div class="right_content"> 	
		 
		 <div class="form">		 
		 
		
		
					<h1>Send Email </h1>
					<form method="post" action="" enctype="multipart/form-data" class="niceform2">
					
			<?php echo $msg?>
		
                <fieldset>
				
                    <dl>
                        <dt><label for="email">Users:</label></dt>
                        <dd>
						
							<textarea name="users" id="users" cols="45" rows="5"><?php echo $usermail?></textarea>	
						
						</dd>
                    </dl>
					<dl>
                        <dt><label for="password">Subject:</label></dt>
                        <dd><input type="text" name="subject" id="subject" size="54" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>
					
					
                    <dl>
                        <dt><label for="password">Message:</label></dt>
                        <dd>
						<?php									
							$oFCKeditor = new FCKeditor('message');
							$oFCKeditor->BasePath = '../fckeditor/';
							$oFCKeditor->Value = stripslashes($row_deals['description']) ;
							$oFCKeditor->Width = '100%' ;
							$oFCKeditor->Height = '200' ;
							$oFCKeditor->ToolbarSet = 'Basic';
							$oFCKeditor->Create();
						?>		
						
						</dd>
                    </dl>
					
					
                     <dl class="submit">
                    <input type="submit" name="submit" id="submit" value="Send" />
                     </dl>
					 
                </fieldset>
                
         </form>
         </div>
		 
     </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->  
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    	<?php require("include/footer.inc.php"); ?>   

</div>		
</body>
</html>