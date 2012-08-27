<?php
include("include/header.php");

$admin_id=intval($_SESSION['admin_id']);
$sql = "SELECT admin_name FROM `".TABLE_ADMIN."` WHERE admin_id='$admin_id'";
$record = $db->query_first($sql);

if(isset($_POST['search_str']) && !empty($_REQUEST['search_str'])){

$where =" and title like '%".$_POST['search_str']."%'";

}
if(isset($_REQUEST['category']) && !empty($_REQUEST['category'])){
	$where .=" and deal_cat ='".$_REQUEST['category']."'	";
	}
if(isset($_REQUEST['city']) && !empty($_REQUEST['city'])){
	$where .=" and city ='".$_REQUEST['city']."'	";
	}
if (isset($_REQUEST['status']) && !empty($_REQUEST['status'])) {
	$where .=" and status ='".$_REQUEST['status']."'	";
}
	$where .='and deal_type="dailydeal" ';
	$items = 10;
	$page = 1;

	if(isset($_GET['page']) and is_numeric($_GET['page']) and $page = $_GET['page'])
			$limit = " LIMIT ".(($page-1)*$items).",$items";
		else
			$limit = " LIMIT $items";

	$today=date("Y-m-d");

	$sql="select * from ".TABLE_DEALS ." where 1=1 ".$where." order by deal_id desc";
	$sqlStrAux = "SELECT count(*) as total FROM ".TABLE_DEALS." where 1=1 ".$where;

	$aux = mysql_fetch_assoc(mysql_query($sqlStrAux));
	$query = mysql_query($sql.$limit);

	// select multi deal if has


?>



    <div class="main_content">

      <?php include("include/top_menu.inc.php");?>

    <div class="center_content">

   		<?php require("include/left_menu.php"); ?>

    <div class="right_content">

					<h2>All Daily Deals</h2>

<?php
				if($_SESSION['errmsg']){
				echo '<div class="error_box" style="font-size:12px;">'.$_SESSION['errmsg'].'</div>' ;
				$_SESSION['errmsg']="";
				}if($_SESSION['msg']){
				echo '<div class="valid_box" style="font-size:12px;">'.$_SESSION['msg'].'</div>' ;
				$_SESSION['msg']="";
				}

				?>



 <form method="post">
<table class="normal" cellpadding="0" cellspacing="0" border="0" width="100%">
		<tr>
		<td>
		Search Deal:
		<input type="text" name="search_str" id="search_str" size="30" value="<?php echo $_REQUEST['search_str']?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" />

		</td>
		<td>Filter Deals:
    	<select name="status" id="status" onchange="return ajaxReq(this.value);">
			<option value="">All Deals&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
			<option value="1" >Active</option>
			<!--<option value="0" >Inactive</option>-->
			<option value="2" >Pending</option>
			<option value="3" >Closed</option>
		</select>
   		</td>
   		<td><input type="submit" name="search" value="Search" /></td>
		</tr>
		<tr><td>&nbsp;</td></tr>

</table>

<!--
  <table width="90%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td>Category:<select name="category">
	<option value="">---Select---</option>
	<?php
	$dealcat=mysql_query("SELECT * FROM ".TABLE_CATEGORIES);
	while($catrow=mysql_fetch_array($dealcat)){
		?>
	<option value="<?php echo $catrow['cat_id']?>" <?php if($catrow['cat_id']==$_REQUEST['category']){ echo "selected" ;}?>><?php echo $catrow['cat_name']?></option>
		<?php }?>
	</select></td>
    <td>City:<select name="city">
	<option value="">---Select---</option>
	<?php
	$dealcity=mysql_query("SELECT * FROM ".TABLE_CITIES);
	while($cityrow=mysql_fetch_array($dealcity)){
		?>
	<option value="<?php echo $cityrow['city_name']?>" <?php if($cityrow['city_name']==$_REQUEST['city']){ echo "selected" ;}?>><?php echo $cityrow['city_name']?></option>
		<?php }?>
	</select></td>
    <td><input type="submit" name="search" value="Search" /></td>
  </tr>
</table>
 -->
   </form>

<table width="100%" cellpadding="0" cellspacing="0" border="0" class="rounded_box">
    <thead>
    	<tr>
        	<!--<th></th>-->
            <th>Deal Name</th>
            <th>Deal City</th>
            <th>Deal Status</th>
            <th>Price</th>
            <th>Start</th>
            <th>End</th>
            <th>Edit</th>
            <th>Delete</th>
            <!--<th>Items</th>-->
        </tr>
    </thead>

    <tbody>

	<?php


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
			if ($row_deals['is_multi'] == 'y') {
			$sql_is_multi = "SELECT * FROM ".TABLE_MULTI_DEALS." WHERE deal_id = ".$row_deals['deal_id'];
			$is_multi = mysql_fetch_array(mysql_query($sql_is_multi));
	}
				$showdealcity=mysql_fetch_array(mysql_query("SELECT * FROM ".TABLE_CITIES." WHERE city_id = '$row_deals[city]'"));
?>

    	<tr>
        	<!--<td><input type="checkbox" name="" /></td>-->
            <td><?php echo stripslashes($row_deals['title']);?></td>
            <td><?php echo ($row_deals['city'] == -1)? (($row_deals['in_sidebar'] == 'y')? "National deal (SD)" : "National deal (MD)" ) : (($row_deals['in_sidebar'] == 'y')? $showdealcity['city_name']." (SD)" : $showdealcity['city_name']." (MD)" ); ?></td>
            <td><?php if($row_deals['status']=='1'){echo "active";}elseif($row_deals['status']=='2'){echo "Upcoming";}else{echo "Closed";}?></td>
            <td><?php echo getSettings(currency_symbol);?><?php echo ($row_deals['is_multi'] == 'n' ? $row_deals['discounted_price'] : $is_multi['multi_deal_item_price'].' (Multi Deal)'); ?></td>
            <td><?php echo date("d/m/Y G:i", strtotime($row_deals['deal_start_time']));?></td>
            <td><?php echo date("d/m/Y G:i", strtotime($row_deals['deal_end_time']));?></td>

            <td><a href="add_deal.php?mode=edit&id=<?php echo $row_deals[deal_id];?>"><img src="images/user_edit.png" alt="" title="" border="0" /></a></td>
            <td><a href="add_deal.php?mode=delete&id=<?php echo $row_deals[deal_id];?>" class="ask"><img src="images/trash.png" alt="" title="" border="0" onClick='return confirm("Are you sure to delete this deal?")' /></a></td>
			<!--<td><a href="show_deals_item.php?id=<?php echo $row_deals[deal_id];?>">View Items</a></td> -->
       </tr>

    	 <?php
			}
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
			   <tr>
			   <td><?php $p->show();?></td>
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
