<?php
ob_start();
session_start();
require("config.inc.php");
if(!isset($_REQUEST['msg'])){
$_REQUEST['msg']='';
}
		require("class/Database.class.php");
		$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
		$db->connect();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Merchant Login Panel</title>
<link rel="stylesheet" type="text/css" href="siteadmin/style.css" />
<script type="text/javascript" src="siteadmin/js/jquery6.min.js"></script>
<script type="text/javascript" src="siteadmin/js/ddaccordion.js"></script>


<script type="text/javascript" src="siteadmin/jconfirmaction.jquery.js"></script>
<script type="text/javascript">

	$(document).ready(function() {
		$('.ask').jConfirmAction();
	});

</script>

<script language="javascript" type="text/javascript" src="siteadmin/js/niceforms.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="siteadmin/js/niceforms-default.css" />

</head>
<body>

<?php
	if($_POST["submit"]=='Log In') {
	$email = $_POST["username"];
	$password = $_POST["password"];

	if ($email == "" || $password == "") {
		$_SESSION['errmsg']="Invalid login details";
		header("location:merchant_employee_login.php");
		exit;
	}

	$sql_merchant = "SELECT * FROM ".TABLE_USERS." WHERE email='".$email."' and password='".base64_encode($password)."' and reg_type='merchant'";
	$result_merchant = mysql_query($sql_merchant);
	$count_merchant = mysql_num_rows($result_merchant);
	if($count_merchant>0)
	{
		$row_merchant = mysql_fetch_array($result_merchant);
		$user_id = $row_merchant["user_id"];
		$_SESSION["muser_id"] = $user_id;
		header('location:merchant_home.php');
		exit;
	}
	else
	{
		$_SESSION['errmsg']="Invalid login details";
		header("location:merchant_employee_login.php");
		exit;
	}
}

?>
<style>
.msghead{
width:600px; height:75px; margin:0px auto ;
}
</style>
<div id=""><!-- main_container -->

	<div class="header_login">
    <div style="width:595px; margin: 0px auto; float: left; background:#09070D;"><a href="#"><img src="siteadmin/images/logo.png" alt="" title="" border="0" /></a></div>
    </div>
		<div class="msghead">
		<?php
				if($_SESSION['errmsg']){
				echo '<div class="error_box" style="font-size:12px; width: 513px;">'.$_SESSION['errmsg'].'</div>' ;
				$_SESSION['errmsg']="";
				}if($_SESSION['msg']){
				echo '<div class="valid_box" style="font-size:12px; width: 513px;">'.$_SESSION['msg'].'</div>' ;
				$_SESSION['msg']="";
				}

				?>
		</div>
         <div class="login_form" style="margin: 80px 0px 0px 370px;">

         <h3>Merchant Login </h3>

         <form action="" method="post" class="niceform2">

                <fieldset style="background:none;">



                    <dl>
                        <dt style="text-align: right;"><label for="email">Username:</label></dt>
                        <dt><input type="text" name="username" id="username" size="54" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;"/></dt>
                    </dl>
                    <dl>
                        <dt style="text-align: right;"><label for="password">Password:</label></dt>
                        <dt><input type="password" name="password" id="password" size="54" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;"/></dt>
                    </dl>

                   <!-- <dl>
                        <dt><label></label></dt>
                        <dd>
                    <input type="checkbox" name="interests[]" id="" value="" /><label class="check_label">Remember me</label>
                        </dd>
                    </dl>-->

                     <dl class="submit">
                    <input type="submit" name="submit" id="submit" value="Log In" class="login_btn" style="padding-bottom: 5px;"/>
                     </dl>

					<!--  <dl>
                        <dt style="text-align: right;"><label for="password"></label></dt>
                        <dd><span style="padding:5px;">New Merchant User?    <a href="merchant_signup.php">Register Here</a></span>
						<span style="padding:5px;">Merchant Owner? <a href="merchant.php">Login Here</a></span></dd>
                    </dl> -->
                </fieldset>

         </form>
         </div>

    <div class="footer_login">



    </div>

</div>
</body>
</html>