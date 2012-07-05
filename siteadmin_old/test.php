<?php
ob_start();
session_start();
if($_SESSION['admin_id']=="")
{
	header("location:index.php");
}
require("../config.inc.php");
require("../site_config.php");

$siteurl=SITE_URL;

$admin_id=intval($_SESSION['admin_id']);
$sql = "SELECT admin_name FROM `".TABLE_ADMIN."`  WHERE admin_id='$admin_id'";
$record = $db->query_first($sql);
$sql = "SELECT * FROM `".TABLE_USERS."` ";
$user11 = $db->fetch_all_array($sql);
print_r($user11);

if($_REQUEST[mode]=="edit")
{
	$funds_id=intval($_REQUEST['id']);
	$row_deals=mysql_fetch_array(mysql_query("select * from ".TABLE_FUNDS." where funds_id='$funds_id'"));
}

if($_REQUEST[mode]=="delete")
{
	$funds_id=intval($_REQUEST['id']);
	mysql_query("delete from ".TABLE_FUNDS." where funds_id='$funds_id'");
	header("location:show_email_settings.php?msg=3");	
}

if(isset($_REQUEST['submit']))
{
	$data['desc']=$_POST['desc'];
	$data['user_email']=$_POST['user_email'];
	$data['fund_amount']=$_POST['fund_amount'];
	$data['date_added']=date("Y-m-d");
	
	if($_REQUEST['mode']=="edit")
	{	
		$db->query_update(TABLE_FUNDS, $data, "funds_id='$funds_id'");
		$funds_id=$funds_id;
		$link ='<a href="$siteurl/approve_fund.php?id=$funds_id">Approval Link</a>';
	}
	else
	{
				if(!empty($_POST['user_email'])){
					$email=explode(";",$_POST['user_email']);
				
				
				}elseif(isset($_POST['city'])){
				
					$mailquery=mysql_query("SELECT first_name,last_name,email from ".TABLE_USERS." where city='".$_POST['city']."'");
					
					while($mailrow=mysql_fetch_array($mailquery)){
				
					$email[]=$mailrow['email'];
				
					}
				
				}elseif(isset($_POST['selectcity'])){
				
						foreach($_POST['selectcity'] as $city){
						
						$mailquery=mysql_query("SELECT first_name,last_name,email from ".TABLE_USERS." where city='".$city."'");
					
								while($mailrow=mysql_fetch_array($mailquery)){
							
								$email[]=$mailrow['email'];
							
								}
						
						}
				
				}
				
				foreach($email as $usermail){
					
					$data['user_email']=$usermail;
					$funds_id=$db->query_insert(TABLE_FUNDS, $data);
					$link .='<a href="$siteurl/approve_fund.php?id=$funds_id">Approval Link</a><br /><br />';
					
					}
	}	
	
	
	if(!empty($link)){
	$to=" jeremy@grouploot.co.uk,carlwebster@grouploot.co.uk";
	
	$subject="Fund Approval Needed";
	
	$message = <<<DEMO
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Add Fund Approval</title>
	</head>
	
	<body>
	<table border="0" cellspacing="0" cellpadding="0" width="620" bgcolor="#f7f7f7" style="vertical-align:top; width:620px;margin:0 auto; border: 1px solid #e3e3e3; ">
	  <tr>
		<td height="0" valign="top" style="vertical-align:top; height:0px; line-height:0px;">
			<table border="0" cellspacing="0" cellpadding="0" width="620" bgcolor="#000" style="vertical-align:top; width:620px;">
			  <tr>
				<td width="10" valign="top" style="vertical-align:top; width:10px;"><img src="$siteurl/images/spacer.gif" width="10" height="1" alt="" /></td>
				<td width="261" height="106" align="left" valign="top" style="vertical-align:top; text-align:left; width:261px; height:106px; line-height:0px;"><img src="$siteurl/images/logo.png" width="261" height="106" alt="" /></td>
				<td width="350" valign="top" style="vertical-align:top; width:350px;"><img src="$siteurl/images/spacer.gif" width="350" height="1" alt="" /></td>
			  </tr>
		  </table>
		</td>
	  </tr>
	  <tr>
		<td height="5" valign="top" style="vertical-align:top; height:5px; line-height:0px;"><img src="$siteurl/images/spacer.gif" width="1" height="5" alt="" /></td>
	  </tr>
		  <tr>
			<td height="0" valign="top" style="vertical-align:top; height:0px; line-height:0px;">
				<table border="0" cellspacing="0" cellpadding="0" width="620"  style="vertical-align:top; width:620px;">
				 <tr>
					<td height="5" valign="top" style="vertical-align:top; height:5px; line-height:0px;"><img src="$siteurl/images/spacer.gif" width="1" height="5" alt="" /></td>
				  </tr>
				  <tr>
					<td height="0" valign="top" style="vertical-align:top; height:0px; line-height:0px;">
						<table border="0" cellspacing="0" cellpadding="0" width="620"  style="vertical-align:top; width:620px;">
						  <tr>
							<td width="10" valign="top" style="vertical-align:top; width:10px; line-height:0px;"><img src="$siteurl/images/spacer.gif" width="10" height="1" alt="" /></td>
							<td width="240" valign="top" style="vertical-align:top; width:240px;">
								
								<table border="0" cellspacing="0" cellpadding="0" width="auto" style="vertical-align:top;">
								  <tr>
									<td valign="top" height="15" style="vertical-align:top; line-height:15px; height:15px; color:#666666; font: normal 12px/15px Arial, Helvetica, sans-serif;">You have added &pound;$_POST[fund_amount] to $_POST[user_email]</td>
								  </tr>
								   <tr>
									   <td height="8" valign="top" style="vertical-align:top; height:8px; line-height:0px;"><img src="$siteurl/images/spacer.gif" width="1" height="8" alt="" /></td>
								  </tr>
								  
								  
								  <tr>
									<td valign="top" height="15" style="vertical-align:top; line-height:15px; height:15px; color:#666666; font: normal 12px/15px Arial, Helvetica, sans-serif;">Please click on the link below to approve the fund to the intended user</td>
								  </tr>
								   <tr>
									   <td height="8" valign="top" style="vertical-align:top; height:8px; line-height:0px;"><img src="$siteurl/images/spacer.gif" width="1" height="8" alt="" /></td>
								  </tr>
								  
								   <tr>
									<td valign="top" height="15" style="vertical-align:top; line-height:15px; height:15px; color:#666666; font: normal 12px/15px Arial, Helvetica, sans-serif;">$link</td>
								  </tr>
								   <tr>
									   <td height="8" valign="top" style="vertical-align:top; height:8px; line-height:0px;"><img src="$siteurl/images/spacer.gif" width="1" height="8" alt="" /></td>
								  </tr>
																					 
								</table>
								
							</td>
	
							 <td width="30" valign="top" style="vertical-align:top; width:30px;"><img src="$siteurl/images/spacer.gif" width="30" height="1" alt="" /></td>
							
						  </tr>
						</table>
					</td>
				</tr>
				<tr>
				<td height="5" valign="top" style="vertical-align:top; height:5px; line-height:0px;"><img src="$siteurl/images/spacer.gif" width="1" height="5" alt="" /></td>
			  </tr>
			 
			</table>
		</td>
	  </tr> 
	  
	  <tr>
			<td height="0" valign="top" style="vertical-align:top; height:0px; line-height:0px;"><table border="0" cellspacing="0" cellpadding="0" width="620"  style="vertical-align:top; width:620px;">
			  <tr>
				<td height="5" valign="top" style="vertical-align:top; height:5px; line-height:0px;"><img src="$siteurl/images/spacer.gif" width="1" height="5" alt="" /></td>
			  </tr>
			  <tr>
				<td height="1" valign="top" style="vertical-align:top; height:1px; line-height:0px; border-bottom:1px solid #e3e3e3;"><img src="$siteurl/images/spacer.gif" width="1" height="1" alt="" /></td>
			  </tr>
			</table></td>
	  </tr>
	   
	  <tr>
		<td height="15" valign="top" style="vertical-align:top; height:15px; background: #222222; color:#fff; padding: 6px 8px; font: normal 12px/15px Arial, Helvetica, sans-serif;">You are receiving this email because you have added a fund for $_POST[user_email]</td>
	  </tr> 
	  
	  <tr>
		<td height="15" valign="top" style="vertical-align:top; height:15px; background: #222222; color:#fff; padding: 6px 8px; font: normal 12px/15px Arial, Helvetica, sans-serif;">If you do not want to approve this fund, please click on <a href="$siteurl/approve_fund.php?id=$funds_id&status=no" style="color:#fff;">Disapprove</a></td>
	  </tr> 
	  
	</table>
	
	</body>
	</html>
	DEMO;

	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$headers .= "To:<$to>" . "\r\n";
	$headers .= 'From: GroupLoot.co.uk<info@GroupLoot.co.uk>' . "\r\n";
	mail($to, $subject, $message, $headers);
	
	}
	else{
	header("location:show_funds.php?msg=4");	
	}
	
	if($_REQUEST['mode']=="edit")
	{	
		header("location:show_funds.php?msg=2");	
	}
	else
	{
		header("location:show_funds.php?msg=1");
	}	
	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::<?php echo TITLE;?>:: Administrator Panel</title>
<link href='../images/favicon.ico' rel='SHORTCUT ICON' />
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
		 
					<h1>Add Fund </h1>

					<form method="post" action="" enctype="multipart/form-data" class="niceform2">

                <fieldset>
				
                    <dl>
                        <dt><label for="email"><strong>Description</strong>:</label></dt>
                        <dd><textarea cols="10" rows="20" name="desc" id="desc" style="border: 1px solid #CCCCCC; height: 150px; background:#ececec; width:350px;"><?php echo $row_deals[desc];?></textarea></dd>
                    </dl>
                    <dl>
                        <dt><label for="password">User Email (Use ; for multiple fund add):</label></dt>
                        <dd><input type="text" name="user_email" id="user_email" size="54" value="<?php echo $row_deals[user_email]?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>
					<?php if($_REQUEST[mode]!="edit") {
					
					
					?>
					<dl>
                        <dt><label for="password">Or Select City:</label></dt>
                        <dd>
						
						<select name="city" class="dropdown" id="city" size="1">
								<option value="">-- Select --</option>
								
                                <?php												
														
									$sql_cities=mysql_query("select city_name from " .TABLE_CITIES." order by city_name asc");
									while($row_cities=mysql_fetch_array($sql_cities))
									{												
								?>
								
										<option value="<?php echo $row_cities[city_name];?>"><?php echo $row_cities[city_name];?></option>
								<?php
									
									}
								?>			
                            </select>
						</dd>
                    </dl>
					
					<dl>
                        <dt><label for="password">Or Select Few Cities:</label></dt>
                        <dd>
		
								
                                <?php												
									$i=1;					
									$sql_cities=mysql_query("select city_name from " .TABLE_CITIES." order by city_name asc");
									while($row_cities=mysql_fetch_array($sql_cities))
									{												
								?>
								
										<input type="checkbox" name="selectedcity[]" value="<?php echo $row_cities[city_name];?>"><?php echo $row_cities[city_name];?>&nbsp;
								<?php
								$i++;
									if($i>4){echo "<br />";$i=1;}
									}
								?>			
                           
						</dd>
                    </dl>
					<?php }?>
					<dl>
                        <dt>
                          <label for="email">Fund Amount(&pound;):</label>
                        </dt>
                        <dd><input type="text" name="fund_amount" id="fund_amount" size="54" value="<?php echo stripslashes($row_deals[fund_amount]);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>

                     <dl class="submit">
                    <input type="submit" name="submit" id="submit" value="Submit" />
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