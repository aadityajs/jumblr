<?php
include("include/header.php");

$admin_id=intval($_SESSION['admin_id']);
$sql = "SELECT admin_name FROM `".TABLE_ADMIN."` WHERE admin_id='$admin_id'";
$record = $db->query_first($sql);

if($_REQUEST['search_str']!="")
{
	$where=" where first_name like '%$_REQUEST[search_str]%' or last_name like '%$_REQUEST[search_str]%' or email like '%$_REQUEST[search_str]%'  and reg_type='merchant'";
	$target="?srchstr=$_REQUEST[search_str]";
	$export_to="csv.php?srchstr=$_REQUEST[search_str]";
}


elseif(($_REQUEST['date_from']!="") && ($_REQUEST['date_to']!=""))
{
	$date_from=strftime("%Y-%m-%d", strtotime($_REQUEST['date_from']));
	$date_to=strftime("%Y-%m-%d", strtotime($_REQUEST['date_to']));
	$where=" where date_added between '$date_from' and '$date_to'  and reg_type='merchant'";
	$target="?date_from=$date_from&date_to=$date_to";
	$export_to="csv.php?date_from=$date_from$date_to=$date_to";
}
elseif(($_REQUEST['date_from']!="") && ($_REQUEST['date_to']==""))
{
	$date_from=strftime("%Y-%m-%d", strtotime($_REQUEST['date_from']));
	$where=" where date_added>='$date_from'  and reg_type='merchant'";
	$target="?date_from=$date_from";
	$export_to="csv.php?date_from=$date_from";
}
elseif(($_REQUEST['date_from']=="") && ($_REQUEST['date_to']!=""))
{
	$date_to=strftime("%Y-%m-%d", strtotime($_REQUEST['date_to']));
	$where=" where date_added<='$date_to'  and reg_type='merchant'";
	$target="?date_to=$date_to";
	$export_to="csv.php?date_to=$date_to";
}
else
{
	$where="  where reg_type='temp_merchant'";
	$target="";
	$export_to="csv.php";
}


if (isset($_REQUEST['reg_type']) && isset($_REQUEST['user_id']) &&  $_REQUEST['reg_type']=='temp_merchant'){

		$generated_raw_pass = str_rand($length = 12, $seeds = 'alphanum');
		$generated_pass = base64_encode($generated_raw_pass);

		$sql="UPDATE ".TABLE_USERS." set reg_type='merchant', password='$generated_pass' where user_id='".$_REQUEST['user_id']."'";
		mysql_query($sql);

		$merchant_data = mysql_fetch_array(mysql_query("SELECT * FROM ".TABLE_USERS." WHERE user_id='".$_REQUEST['user_id']."'"));


		$Template = '<table width="760" border="0" align="center" cellpadding="0" cellspacing="0" >
			  <tr>
			    <td align="center" valign="top"><img src="'.SITE_URL.'images/pdf_img/headerbg1.jpg" alt="" width="760" height="100" /></td>
			  </tr>
			  <tr>
			    <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-bottom:2px solid #000000; border-left:2px solid #000000; border-right:2px solid #000000;">
			        <tr>
			          <td><table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
			              <tr>
			                <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; text-align:left; line-height:19px; color:#000; font-size:12px; font-weight: normal; font-smooth: always;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
			                    <tr>
			                      <td height="180" align="left" valign="top"  style="font-family:Arial, Helvetica, sans-serif;  font-size:12px;"><p>Hi,<br>
			                          <br>
			                          After going through the information that you submitted to  us, we have reached a decision and we are happy to open you a merchant account  on GeeLaza.<br>
			                          <br>
			                          Becoming partners with GeeLaza has many benefits from  growing your revenue, paying no up-front costs, being able to advertise to a wider target of potential customers and many more.<br>
			                          <br>
			                          It is time for you to get started!</p></td>
			                    </tr>
			                  </table></td>
			              </tr>
			              <tr>
			                <td align="left" valign="top" style="border-top: 1px dashed #666666;">&nbsp;</td>
			              </tr>
			              <tr>
			                <td align="left" valign="top"  style="font-family:Arial, Helvetica, sans-serif; text-align:left; line-height:15px; color:#000; font-size:12px; font-weight: normal; font-smooth: always; text-align:left; vertical-align:middle;"><p><strong>Your merchant account details:</strong></p>
			                  <p>Click on this link <a href="'.SITE_URL.'merchant-host.app">www.unifiedinfotech.net/getdeals/merchant-host.app</a> and then use your details below to log in.<br>
			                    <br>
			                    <strong>Merchant ID:</strong> <a href="mailto:'.$merchant_data['email'].'">'.$merchant_data['email'].'</a><br>
			                    <br>
			                    <strong>Temporary password:</strong> '.$generated_raw_pass.' (As soon as you log in,  please change your password and keep it safe)<br>
			                    <br>
			                  </p></td>
			              </tr>
			              <tr>
			                <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
			                    <tr>
			                      <td style="border-top: 1px dashed #666666;">&nbsp;</td>
			                    </tr>
			                    <tr>
			                      <td   style="font-family:Arial, Helvetica, sans-serif; text-align:left; line-height:18px; color:#000; font-size:12px; font-weight: normal; font-smooth: always;"><p>If you want more information about being a merchant then  visit our Business FAQ page (<a href="http://www.geelaza.com/business/FAQ">www.geelaza.com/business/FAQ</a>)</p>
			                        <p>OR<br>
			                          <br>
			                          If you have any issues or concern please contact us (<a href="http://www.geelaza.com/contact">www.geelaza.com/contact</a>)<br>
			                          Thank you,</p>
			                        The  GeeLaza Business Team</td>
			                    </tr>
			                  </table></td>
			              </tr>
			              <tr>
			                <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; text-align:left; line-height:18px; color:#000; font-size:13px; font-weight: normal; font-smooth: always;">&nbsp;</td>
			              </tr>
			              <tr>
			                <td align="left" valign="top">&nbsp;</td>
			              </tr>
			            </table></td>
			        </tr>
			      </table></td>
			  </tr>
			</table>
		';
		$subject = "Follow up on your GeeLaza inquiry";
		$admin_email=mysql_fetch_array(mysql_query("SELECT * FROM ".TABLE_ADMIN." where admin_name='admin'"));
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "From: GeeLaza Team<".$admin_email['email'].">". "\r\n" ;

		@mail($merchant_data['email'],$subject,$Template,$headers);

		$_SESSION['msg']="Merchant request accepted.";
		header("location:merchant_user_request.php");
		exit;

}
?>


    <div class="main_content">

      <?php include("include/top_menu.inc.php");?>

    <div class="center_content">

   		<?php require("include/left_menu.php"); ?>
<?php if (!$_GET['email']) { ?>
    <div class="right_content">

			<?php
				if($_SESSION['msg']){
				echo '<div class="valid_box" style="font-size:12px;">'.$_SESSION['msg'].'</div>' ;
				$_SESSION['msg']="";
				}
			?>

						<table class="normal" cellpadding="0" cellspacing="0" border="0" width="100%">

								<form name="sorting" id="sorting" method="post">

								<tr>

									<td>Search Registered Users:
										<input type="text" name="search_str" id="search_str" size="30" value="" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" />

										<input class="button" type="submit" value="Search" name="submit" />
									<a href="<?php echo $export_to?>">Export To CSV</a></td>

								</tr>

								</form>

								<tr><td>&nbsp;</td></tr>

								<form name="sorting2" id="sorting2" method="post">

						<!--		<tr>

									<td>Search Users Between Registration Date:
										From: <input type="text" name="date_from" id="my_date_field2" size="15" value="" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
						<script language="javascript">
							new Control.DatePicker('my_date_field2', {timePicker: true, timePickerAdjacent: true});
						</script>

										To: <input type="text" name="date_to" id="my_date_field3" size="15" value="" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
						<script language="javascript">
							new Control.DatePicker('my_date_field3', {timePicker: true, timePickerAdjacent: true});
						</script>
										<input class="button" type="submit" value="Search" name="submit2" />
									</td>

								</tr>-->

								</form>




								<form name="sorting3" id="sorting3" method="post">

								<!--<tr>

									<td>Search :
										Subscriptions:
												<select name="subscription">
												<option value="">-----Select -----</option>
												<?php $city=mysql_query("SELECT * FROM `".TABLE_CITIES."` ");
												while($row=mysql_fetch_array($city)){?>
												<option value="<?php echo $row['city_name']?>"><?php echo $row['city_name']?></option>
												<?php }?>
												</select>

										Preference:
											<select name="preference">
											<option value="">-----Select -----</option>
											<?php $city=mysql_query("SELECT * FROM `".TABLE_CATEGORIES."` ");
												while($row=mysql_fetch_array($city)){?>
												<option value="<?php echo $row['cat_name']?>"><?php echo $row['cat_name']?></option>
												<?php }?>
											</select>

										<input class="button" type="submit" value="Search" name="submit3" />
									</td>

								</tr>-->

								</form>

								<tr><td>&nbsp;</td></tr>

						</table>

					<h2>Merchant Request's</h2>

<table width="100%" cellpadding="0" cellspacing="0" border="0" class="rounded_box">
    <thead>
    	<tr>
            <th>Full Name</th>
			<th>Phone No</th>
			<th>Email</th>
            <th>Date</th>
            <th>Active</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>

    <tbody>
<script>

function sendemail(uid){
req=new XMLHttpRequest();
					req.open('GET',"send_merchant_request_notification.php?user_id="+uid,false);
					req.send(null);
							if(req.readyState==4){

							alert(req.responseText);
					}

	}
</script>
<?php

$items = 10;
$page = 1;

if(isset($_GET['page']) and is_numeric($_GET['page']) and $page = $_GET['page'])
		$limit = " LIMIT ".(($page-1)*$items).",$items";
	else
		$limit = " LIMIT $items";

$today=date("Y-m-d");

if(isset($_REQUEST['preference']) || isset($_REQUEST['subscription'])){

$sql="SELECT * FROM `".TABLE_USERS."`
left join ".TABLE_USER_SUBSCRIPTION." on (".TABLE_USERS.".user_id=".TABLE_USER_SUBSCRIPTION.".user_id) left join ".TABLE_USER_PREFERENCE." on (".TABLE_USERS.".user_id=".TABLE_USER_PREFERENCE.".user_id) left join ".TABLE_CITIES." on(".TABLE_USER_SUBSCRIPTION.".city_id=".TABLE_CITIES.".city_id) left join ".TABLE_CATEGORIES." on(".TABLE_USER_PREFERENCE.".category_id=".TABLE_CATEGORIES.".cat_id) where ".TABLE_CITIES.".city_name like '%".$_REQUEST['subscription']."%' and ".TABLE_CATEGORIES.".cat_name like '%".$_REQUEST['preference']."%' and ".TABLE_USERS.".reg_type='merchant' group by first_name";




$sqlStrAux = "SELECT count(*) as total FROM `".TABLE_USERS."`
left join ".TABLE_USER_SUBSCRIPTION." on (".TABLE_USERS.".user_id=".TABLE_USER_SUBSCRIPTION.".user_id) left join ".TABLE_USER_PREFERENCE." on (".TABLE_USERS.".user_id=".TABLE_USER_PREFERENCE.".user_id) left join ".TABLE_CITIES." on(".TABLE_USER_SUBSCRIPTION.".city_id=".TABLE_CITIES.".city_id) left join ".TABLE_CATEGORIES." on(".TABLE_USER_PREFERENCE.".category_id=".TABLE_CATEGORIES.".cat_id)  where ".TABLE_CITIES.".city_name like '%".$_REQUEST['subscription']."%' and ".TABLE_CATEGORIES.".cat_name like '%".$_REQUEST['preference']."%' and ".TABLE_USERS.".reg_type='merchant' group by first_name";




}else{
$sql="select * from ".TABLE_USERS.$where;
$sqlStrAux = "SELECT count(*) as total FROM ".TABLE_USERS."$where";
}

$aux = mysql_fetch_assoc(mysql_query($sqlStrAux));
$query = mysql_query($sql.$limit);

if($aux['total']>0){
		$p = new pagination;
		$p->Items($aux['total']);
		$p->limit($items);
		$p->target($target);
		$p->currentPage($page);
		$p->calculate();
		$p->changeClass("pagination");

		while($row_deals=mysql_fetch_array($query))
		{
?>

    	<tr>
        	<!--<td><input type="checkbox" name="" /></td>-->
            <td><a href="view_merchant_details.php?id=<?php echo $row_deals['user_id'];?>"><?php echo $row_deals['first_name'];?>&nbsp;<?php echo $row_deals['last_name'];?></a></td>
			<td><?php echo $row_deals['phone_no'];?></td>
			<td><?php echo $row_deals['email'];?></td>
            <td><?php echo strftime("%d %b %Y", strtotime($row_deals['date_added'])); ?></td>

			<?php if($row_deals['reg_type']=='temp_merchant'){ ?>
			<td><a href='merchant_user_request.php?reg_type=temp_merchant&user_id=<?php echo $row_deals['user_id']?>'><img src="images/unblock.png" width="20"></a></td>
			<?php }?>

			<td><a href="add_merchant_user.php?mode=edit&id=<?php echo $row_deals[user_id];?>"><img src="images/user_edit.png" alt="" title="" border="0" /></a></td>
            <td><a href="add_merchant_user.php?mode=delete&id=<?php echo $row_deals[user_id];?>" class="ask"><img src="images/trash.png" alt="" title="" border="0" onClick='return confirm("Are you sure to delete this user?")' /></a>
			<a href="<?php echo SITE_URL; ?>siteadmin/merchant_user_request.php?email=<?php echo $row_deals[user_id];?>" class="ask" title='Send Notification'><img src="images/email.png" alt="" title="" border="0" title='Send Notification' /></a>
			</td>
        </tr>

    	 <?php

		 $users[]=$row_deals['user_id'];
			}

			$_SESSION['ids']=serialize($users);
		?>

		<?php
		}else{
			echo "No Data Found";
		}
?>

    </tbody>
</table>


<?php
		if($aux['total']>0)
		{
	?>
	<!-- <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="padding: 8px 0;">
			  <tr><td colspan="6" align="center"><input type="button" onclick="javascript:location.href='send_email.php'" value="Send Email"/></td></tr>
			 </table> -->
			 <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="padding: 8px 0;">
			   <tr>
			   <td><?php echo $p->show();?></td>
			   </tr>
			 </table>
	<?php
		}
	?>




     </div><!-- end of right content-->
<?php } else { ?>
	<div class="right_content">

		<?php
			$admin_id=intval($_SESSION['admin_id']);
			$sql = "SELECT * FROM `".TABLE_ADMIN."`  WHERE admin_id='$admin_id'";
			$record = $db->query_first($sql);

			$uid = $_GET['email'];
			$q=mysql_fetch_object(mysql_query("SELECT * from ".TABLE_USERS." where user_id='$uid'"));
			$usermail .=$q->email.",";

			/*
			 * $userids=unserialize($_SESSION['ids']);
			foreach($userids as $uid){
			$q=mysql_fetch_object(mysql_query("SELECT * from ".TABLE_USERS." where user_id='$uid'"));
			$usermail .=$q->email.",";
			}
			 *
			 */


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
						  <title>GeeLaza.com</title>
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
						$msg='<div class="valid_box" style="width: 90%">Message sent successfully to the users</div>';
						}
						else{
						$msg='<div class="error_box" style="width: 90%">Message not sent  to the users</div>';
						}

			}

			?>


		 <div class="form">



					<h1>Send Email </h1>
					<form method="post" action="" enctype="multipart/form-data" class="niceform2">

			<?php echo $msg?>

                <fieldset>

                    <dl>
                        <dt><label for="email">Users:</label></dt>
                        <dd>

							<textarea name="users" id="users" cols="75" rows="3"><?php echo $usermail?></textarea>

						</dd>
                    </dl>
					<dl>
                        <dt><label for="password">Subject:</label></dt>
                        <dd><input type="text" name="subject" id="subject" size="100" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>


                    <dl>
                        <dt><label for="password">Message:</label></dt>
                        <dd>
						<?php
							$oFCKeditor = new FCKeditor('message');
							$oFCKeditor->BasePath = '../fckeditor/';
							$oFCKeditor->Value = stripslashes($row_deals['description']) ;
							$oFCKeditor->Width = '100%' ;
							$oFCKeditor->Height = '300' ;
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


	</div>

<?php } 	// end else $_GET['email'] ?>

  </div>   <!--end of center content -->

    <div class="clear"></div>
    </div> <!--end of main content-->

    	<?php require("include/footer.inc.php"); ?>

