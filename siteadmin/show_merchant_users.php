<?php
include("include/header.php");

$admin_id=intval($_SESSION['admin_id']);
$sql = "SELECT admin_name FROM `".TABLE_ADMIN."` WHERE admin_id='$admin_id'";
$record = $db->query_first($sql);

if($_REQUEST['search_str']!="")
{
	$where=" where first_name like '%$_REQUEST[search_str]%' or last_name like '%$_REQUEST[search_str]%' or email like '%$_REQUEST[search_str]%'  and status='merchant'";
	$target="?srchstr=$_REQUEST[search_str]";
	$export_to="csv.php?srchstr=$_REQUEST[search_str]";
}


elseif(($_REQUEST['date_from']!="") && ($_REQUEST['date_to']!=""))
{
	$date_from=strftime("%Y-%m-%d", strtotime($_REQUEST['date_from']));
	$date_to=strftime("%Y-%m-%d", strtotime($_REQUEST['date_to']));
	$where=" where date_added between '$date_from' and '$date_to'  and status='merchant'";
	$target="?date_from=$date_from&date_to=$date_to";
	$export_to="csv.php?date_from=$date_from$date_to=$date_to";
}
elseif(($_REQUEST['date_from']!="") && ($_REQUEST['date_to']==""))
{
	$date_from=strftime("%Y-%m-%d", strtotime($_REQUEST['date_from']));
	$where=" where date_added>='$date_from'  and status='merchant'";
	$target="?date_from=$date_from";
	$export_to="csv.php?date_from=$date_from";
}
elseif(($_REQUEST['date_from']=="") && ($_REQUEST['date_to']!=""))
{
	$date_to=strftime("%Y-%m-%d", strtotime($_REQUEST['date_to']));
	$where=" where date_added<='$date_to'  and status='merchant'";
	$target="?date_to=$date_to";
	$export_to="csv.php?date_to=$date_to";
}
else
{
	$where="  where status='merchant'";
	$target="";
	$export_to="csv.php";
}

?>


    <div class="main_content">

      <?php include("include/top_menu.inc.php");?>

    <div class="center_content">

   		<?php require("include/left_menu.php"); ?>

    <div class="right_content">

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

					<h2>All Registered Users</h2>

<table width="100%" cellpadding="0" cellspacing="0" border="0" class="rounded_box">
    <thead>
    	<tr>
            <th>Full Name</th>
			<th>Phone No</th>
			<th>Email</th>
            <th>Date Added</th> <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>

    <tbody>
<script>

function sendemail(uid){
req=new XMLHttpRequest();
					req.open('GET',"send_access_merchant.php?user_id="+uid,false);
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
$sql="select * from ".TABLE_MERCHANTS.$where;
$sqlStrAux = "SELECT count(*) as total FROM ".TABLE_MERCHANTS."$where";
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
            <td><a href="view_user_details.php?id=<?php echo $row_deals['mid'];?>"><?php echo $row_deals['employee_name'];?></a></td>
			<td><?php echo $row_deals['phone'];?></td>
			<td><a href="view_user_details.php?id=<?php echo $row_deals['mid'];?>"><?php echo $row_deals['email'];?></a></td>
            <td><?php echo strftime("%d %b %Y", strtotime($row_deals['date_added'])); ?></td>
			<td><a href="add_merchant_user.php?mode=edit&id=<?php echo $row_deals[mid];?>"><img src="images/user_edit.png" alt="" title="" border="0" /></a></td>
            <td><a href="add_merchant_user.php?mode=delete&id=<?php echo $row_deals[mid];?>" class="ask"><img src="images/trash.png" alt="" title="" border="0" onClick='return confirm("Are you sure to delete this user?")' /></a>
			<a href="<?php echo SITE_URL; ?>siteadmin/merchant_user_request.php?email=<?php echo $row_deals[mid];?>" class="ask" title='Send Userid And Password to merchant'><img src="images/email.png" alt="" title="" border="0" title='Send Userid And Password to merchant' /></a>
			</td>
        </tr>

    	 <?php

		 $users[]=$row_deals['mid'];
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
	<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="padding: 8px 0;">
			  <tr><td colspan="6" align="center"><input type="button" onclick="javascript:location.href='send_email.php'" value="Send Email"/></td></tr>
			 </table>
			 <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="padding: 8px 0;">
			   <tr>
			   <td><?php echo $p->show();?></td>
			   </tr>
			 </table>
	<?php
		}
	?>




     </div><!-- end of right content-->


  </div>   <!--end of center content -->

    <div class="clear"></div>
    </div> <!--end of main content-->

    	<?php require("include/footer.inc.php"); ?>

