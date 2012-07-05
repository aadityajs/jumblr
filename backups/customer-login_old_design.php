<?php
include("include/header.php");
?>
<div id="container">
<div id="leftcol">
<div class="deal_info">
<div class="top_about">
<p>Customer Sign In</p>
</div>
<div class="clear"></div>
<div class="midbg">
<div class="today_deal">
<div class="blue_text">Existing User</div>
<div class="clear"></div>
<div class="black_text">Geelaza allows your business whether its a small, medium or big business to reach new customers and take your business to the next level. we have a great relation with our handpicked merchants and customers as we are doing something that keeps everyone happy. It's that simple.</div>
<div class="clear"></div>
<div class="customer_box">
<div class="customer_left">
<img src="images/1pic.gif" alt="" width="77" class="wrap" height="84"/><p>Growing your business now</p></div>
<div class="customer_left">
<img src="images/2pix.gif" alt="" width="85" class="wrap" height="84"/>
<p>Getting more customers</p></div>
<div class="customer_right">
<img src="images/3pic.gif" alt="" width="120" class="wrap" height="89"/>
<p>Getting more revenues</p></div>
</div>
<div class="clear"></div>
<div class="register_box">
<?php
	$flag = 0;
	if(strtolower($_SERVER['REQUEST_METHOD']) == 'post')
	{
		$email = $_POST["email"];
		$password = $_POST["password"];
				
		if($flag == 0)
		{
			if($email == '')
			{
				$msg = 'Please enter email';
				$flag = 1;
			}
		}
		
		if($flag == 0)
		{
			if($password == '')
			{
				$msg = 'Please enter password';
				$flag = 1;
			}
		}
		
		if($flag == 0)
		{
			$password = md5($password);
			$sql_select = "SELECT * FROM ".TABLE_USERS." WHERE email="."'".$email."' and password="."'".$password."'";
			$result_select = mysql_query($sql_select);
			$count_select = mysql_num_rows($result_select);
			if($count_select >0)
			{
				$row_select = mysql_fetch_array($result_select);
				$user_id = $row_select["user_id"];
				$_SESSION["user_id"] = $user_id;
				header('Location: '.SITE_URL.'customer-account.php');
			}
			else
			{
				$msg = 'Invalid login';
				$flag = 1;
			}
		}
		
	}


?>



<?php

if($flag == 1)
{
	?>
	<div style="width:345px; height:25px; background-color:transparent;padding-top:4px; padding-left:30px;">
	<label style="color:#CC0000;"><?php echo "* ".$msg; ?></label>
	</div>
	<?php
}
?>



<form name="cust_login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">


<table class="registered_bg">
	<tr>
		<td>Email</td>
		<td>Password</td>
	</tr>
	
	<tr>
		<td><input type="text" name="email" id="email" value="<?php if(isset($_POST) && $flag==1){ echo $_POST["email"];} ?>"class="text_box1"/></td>
		<td><input type="password" name="password" id="password" class="text_box1"/></td>
	</tr>
	
	<tr>
		<td colspan="2"><br/><input type="submit" name="btnRegister" value="Login" class="reset_btn" style="cursor:pointer;" /><br/><br/></td>
	</tr>
	
</table>

</form>
</div>
</div>
</div>
</div>
</div>
<?php include ('include/sidebar.php'); ?>
</div>
<?php include("include/footer.php");?>