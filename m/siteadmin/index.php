<?php
ob_start();
session_start();
require("../config.inc.php");
if(!isset($_REQUEST['msg'])){
$_REQUEST['msg']='';
}
if (isset($_SESSION['admin_id'])) {
	header('location:'.SITE_URL.'siteadmin/home.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::<?php echo TITLE;?>:: Administrator Panel</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="js/jquery6.min.js"></script>
<script type="text/javascript" src="js/ddaccordion.js"></script>
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

<script type="text/javascript" src="jconfirmaction.jquery.js"></script>
<script type="text/javascript">

	$(document).ready(function() {
		$('.ask').jConfirmAction();
	});

</script>

<script language="javascript" type="text/javascript" src="js/niceforms.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="js/niceforms-default.css" />

</head>
<body>

<?php
	if(isset($_POST['submit']))
	{
		require("../class/Database.class.php");
		$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
		$db->connect();
		$username=$_POST['username'];
		$password=md5($_POST['password']);
		$sql = "SELECT * FROM `".TABLE_ADMIN."` WHERE admin_name='$username' and admin_password='$password' and status=1";
		$record = $db->query_first($sql);
		if($db->affected_rows > 0)
		{
			$_SESSION['admin_id']=$record['admin_id'];
			header("location:home.php");
		}
		else
		{
			header("location:index.php?msg=err");
		}

	}
?>

<div id="main_container">

	<div class="header_login">
    <div style="width:auto; float: right; margin: 150px 0px 0px 370px; position: absolute; border: 0px solid red;">
    <a href="<?php echo SITE_URL; ?>"><img src="images/logo.png" alt="" title="" border="0" /></a></div>
    </div>

         <div class="login_form" style="margin-top: 150px;">

         <h3>Administrator Panel Login</h3>

         <!--<a href="#" class="forgot_pass">Forgot password</a> -->

         <form action="" method="post" class="niceform2">

                <fieldset style="background:none;">

				<?php
					if($_REQUEST['msg']=="err")
					{
				?>
						<div class="error_box">Invalid Username/Password</div>

				<?php
					}
				?>

                    <dl>
                        <dt style="text-align: right; width: 100px;"><label for="email">Username:</label></dt>
                        <dd style=" width: 400px;"><input type="text" name="username" id="username" size="54" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;"/></dd>
                    </dl>
                    <dl>
                        <dt style="text-align: right; width: 100px;"><label for="password">Password:</label></dt>
                        <dd style=" width: 400px;"><input type="password" name="password" id="password" size="54" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;"/></dd>
                    </dl>

                   <!-- <dl>
                        <dt><label></label></dt>
                        <dd>
                    <input type="checkbox" name="interests[]" id="" value="" /><label class="check_label">Remember me</label>
                        </dd>
                    </dl>-->

                     <dl class="submit">
                    <input type="submit" name="submit" id="submit" value="Log In" class="login_btn" style="padding-bottom: 5px; margin-left: -50px; width: 100px;"/>
                     </dl>

                </fieldset>

         </form>
         </div>

    <div class="footer_login">



    </div>

</div>
</body>
</html>