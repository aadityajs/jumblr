<?php
include("include/header.php");
error_reporting(0);


$admin_id=intval($_SESSION['admin_id']);
$sql = "SELECT admin_name FROM `".TABLE_ADMIN."` WHERE admin_id='$admin_id'";
$record = $db->query_first($sql);

if($_REQUEST['search_str']!="")
{
	$where=" where first_name like '%$_REQUEST[search_str]%' or last_name like '%$_REQUEST[search_str]%' or email like '%$_REQUEST[search_str]%' and status = 'violated'";
	$target="?srchstr=$_REQUEST[search_str]";
	$export_to="csv.php?srchstr=$_REQUEST[search_str]";
}


elseif(($_REQUEST['date_from']!="") && ($_REQUEST['date_to']!=""))
{
	$date_from=strftime("%Y-%m-%d", strtotime($_REQUEST['date_from']));
	$date_to=strftime("%Y-%m-%d", strtotime($_REQUEST['date_to']));
	$where=" where date_added between '$date_from' and '$date_to' and status = 'violated'";
	$target="?date_from=$date_from&date_to=$date_to";
	$export_to="csv.php?date_from=$date_from$date_to=$date_to";
}
elseif(($_REQUEST['date_from']!="") && ($_REQUEST['date_to']==""))
{
	$date_from=strftime("%Y-%m-%d", strtotime($_REQUEST['date_from']));
	$where=" where date_added>='$date_from' and status = 'violated'";
	$target="?date_from=$date_from";
	$export_to="csv.php?date_from=$date_from";
}
elseif(($_REQUEST['date_from']=="") && ($_REQUEST['date_to']!=""))
{
	$date_to=strftime("%Y-%m-%d", strtotime($_REQUEST['date_to']));
	$where=" where date_added<='$date_to' and status = 'violated'";
	$target="?date_to=$date_to";
	$export_to="csv.php?date_to=$date_to";
}
else
{
	$where=" where status = 'violated'";
	$target="";
	$export_to="csv.php";
}

if(isset($_REQUEST['status']) && isset($_REQUEST['u_id']) &&  $_REQUEST['status']==2){

	echo $sql="UPDATE ".TABLE_FB_USER_VIOLATION." set status='".$_REQUEST['status']."' where fb_id='".$_REQUEST['u_id']."'";
	mysql_query($sql);
	$_SESSION['msg']="User status successfully updated .";
	header("location:show_violated_users.php");
	exit;


}elseif(isset($_REQUEST['status']) && isset($_REQUEST['u_id']) &&  $_REQUEST['status']==1){


		echo $sql="UPDATE ".TABLE_FB_USER." set status='".$_REQUEST['status']."' where fb_id='".$_REQUEST['u_id']."'";
		mysql_query($sql);
		$_SESSION['msg']="User status successfully updated .";
		header("location:show_violated_users.php");
		exit;

}

?>


<style>
div.pagination {
width:320px;
clear:both;
padding:10px 0 10px 0;
margin:0px;
text-align:center;
float:left;
clear:both;
font-size:11px;
}

div.pagination a {
padding: 2px 5px 2px 5px;
margin-right: 2px;
border: 1px solid #52bfea;
text-decoration: none;
color: #52bfea;
}
div.pagination a:hover, div.pagination a:active {
border:1px solid #52bfea;
color: #fff;
background-color: #52bfea;
}
div.pagination span.current {
padding: 2px 5px 2px 5px;
margin-right: 2px;
border: 1px solid #52bfea;
font-weight: bold;
background-color: #52bfea;
color: #FFF;
}
div.pagination span.disabled {
padding: 2px 5px 2px 5px;
margin-right: 2px;
border: 1px solid #f3f3f3;
color: #ccc;
}

</style>



    <div class="main_content">

      <?php include("include/top_menu.inc.php");?>

    <div class="center_content">

   		<?php require("include/left_menu.php"); ?>

    <div class="right_content">

						<table class="normal" cellpadding="0" cellspacing="0" border="0" width="100%">

								<form name="sorting" id="sorting" method="post">

								<tr>

									<td>Search Violated Users:
										<input type="text" name="search_str" id="search_str" size="30" value="" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" />

										<input class="button" type="submit" value="Search" name="submit" />
									<a href="<?php echo $export_to?>">Export To CSV</a></td>

								</tr>

								</form>


								<form name="sorting2" id="sorting2" method="post">

								<!--<tr>

									<td>Registration Date Between :
										From: <input type="text" name="date_from" id="my_date_field2" size="15" value="" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" />
										<span id="cal1"><img src="zpcal/themes/icons/calendar1.gif" style="cursor:pointer"/></span>
								 <script type="text/javascript">
								  var cal = new Zapatec.Calendar.setup({

								  inputField:"my_date_field2",
								  ifFormat:"%Y-%m-%d %H:%M",
								  button:"cal1",
								  showsTime:false

								  });

								 </script>
										</dd>


										To: <input type="text" name="date_to" id="my_date_field3" size="15" value="" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" />
										<span id="cal2"><img src="zpcal/themes/icons/calendar1.gif" style="cursor:pointer"/></span>
								 <script type="text/javascript">
								  var cal = new Zapatec.Calendar.setup({

								  inputField:"my_date_field3",
								  ifFormat:"%Y-%m-%d %H:%M",
								  button:"cal2",
								  showsTime:false

								  });

								 </script>
										</dd>

										<input class="button" type="submit" value="Search" name="submit2" />
									</td>

								</tr>-->

								</form>


								<tr><td>&nbsp;</td></tr>

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

								</tr>

								--></form>

								<tr><td>&nbsp;</td></tr>

						</table>

					<h2>All Violated/Reported Users</h2>

<table width="100%" cellpadding="0" cellspacing="0" border="0" class="rounded_box">
    <thead>
    	<tr>
    		<th>Profile</th>
            <th>Full Name</th>
			<th>Email</th>
			<th>Sex</th>
			<th>Violations</th>
            <th>Date Added</th>
            <th>Status</th>
            <th>Delete</th>
        </tr>
    </thead>

    <tbody>

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
left join ".TABLE_USER_SUBSCRIPTION." on (".TABLE_USERS.".user_id=".TABLE_USER_SUBSCRIPTION.".user_id) left join ".TABLE_USER_PREFERENCE." on (".TABLE_USERS.".user_id=".TABLE_USER_PREFERENCE.".user_id) left join ".TABLE_CITIES." on(".TABLE_USER_SUBSCRIPTION.".city_id=".TABLE_CITIES.".city_id) left join ".TABLE_CATEGORIES." on(".TABLE_USER_PREFERENCE.".category_id=".TABLE_CATEGORIES.".cat_id) where ".TABLE_CITIES.".city_name like '%".$_REQUEST['subscription']."%' and ".TABLE_CATEGORIES.".cat_name like '%".$_REQUEST['preference']."%' and ".TABLE_USERS.".reg_type<>'merchant' group by first_name";




$sqlStrAux = "SELECT count(*) as total FROM `".TABLE_USERS."`
left join ".TABLE_USER_SUBSCRIPTION." on (".TABLE_USERS.".user_id=".TABLE_USER_SUBSCRIPTION.".user_id) left join ".TABLE_USER_PREFERENCE." on (".TABLE_USERS.".user_id=".TABLE_USER_PREFERENCE.".user_id) left join ".TABLE_CITIES." on(".TABLE_USER_SUBSCRIPTION.".city_id=".TABLE_CITIES.".city_id) left join ".TABLE_CATEGORIES." on(".TABLE_USER_PREFERENCE.".category_id=".TABLE_CATEGORIES.".cat_id)  where ".TABLE_CITIES.".city_name like '%".$_REQUEST['subscription']."%' and ".TABLE_CATEGORIES.".cat_name like '%".$_REQUEST['preference']."%' and ".TABLE_USERS.".reg_type<>'merchant' group by first_name";




}else{
//select count(fb_id), fb_id, by_fb_id, id, date, status from jumblr_fb_user_violation where status = 'violated' group by fb_id order by cv desc
$sql="select count(fb_id) as cv, fb_id, by_fb_id, id, date, status from ".TABLE_FB_USER_VIOLATION."$where group by fb_id order by cv desc";
$sqlStrAux = "SELECT count(*) as total FROM ".TABLE_FB_USER_VIOLATION."$where";
}

$aux = mysql_fetch_assoc(mysql_query($sqlStrAux));
$query1 = mysql_query($sql.$limit);

if($aux['total']>0){

		$p = new pagination;

		$p->Items($aux['total']);
		$p->limit($items);
		$p->target($target);
		$p->currentPage($page);
		$p->calculate();

		$p->changeClass("pagination");


		while($row_deals=mysql_fetch_array($query1))
		{
			$fbDetails = getFbUserDetails($row_deals['fb_id']);
?>

    	<tr>
        	<!--<td><input type="checkbox" name="" /></td>-->
			<td><a href="<?php echo $fbDetails['profile_url'];?>"><img alt="" src="<?php echo $fbDetails['pic_square'];?>"></a></td>
            <td><a href="<?php echo $fbDetails['profile_url'];?>"><?php echo $fbDetails['name'];?></a></td>
			<td><a href="<?php echo $fbDetails['profile_url'];?>"><?php echo $fbDetails['email'];?></a></td>
            <td><?php echo $fbDetails['sex'];?></td>
            <td><span style="color: red; border: 1px solid red; border-radius: 20px; padding: 8px 12px 8px 12px;"><?php echo $row_deals['cv']; ?></span></td>
            <td><?php echo strftime("%d %b %Y", $row_deals['date']); ?></td>

			<?php if($row_deals['status']=='violated'){ ?>
			<td><a href='show_violated_users.php?status=2&u_id=<?php echo $row_deals['fb_id']?>' title="Make inactive"><img src="images/unblock.png" width="20" /></a></td>
			<?php }else{?>
			<td><a href='show_violated_users.php?status=1&u_id=<?php echo $row_deals['fb_id']?>' title="Make active"><img src="images/block.png" width="20" /></a></td>
			<?php }?>

			<!-- <td><a href="add_user.php?mode=edit&id=<?php echo $row_deals[fb_id];?>"><img src="images/user_edit.png" alt="" title="" border="0" /></a></td> -->
            <td><a href="add_user.php?mode=delete&id=<?php echo $row_deals[fb_id];?>" class="ask"><img src="images/trash.png" alt="" title="" border="0" onClick='return confirm("Are you sure to delete this user?")' /></a></td>
        </tr>

    	 <?php

		 	$users[]=$row_deals['fb_id'];
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


  </div>   <!--end of center content -->

    <div class="clear"></div>
    </div> <!--end of main content-->

    	<?php require("include/footer.inc.php"); ?>

