<?php
include("include/header.php");


$admin_id=intval($_SESSION['admin_id']);
$sql = "SELECT admin_name FROM `".TABLE_ADMIN."` WHERE admin_id='$admin_id'";
$record = $db->query_first($sql);

?>


    <div class="main_content">

      <?php include("include/top_menu.inc.php");?>

    <div class="center_content">

   		<?php require("include/left_menu.php"); ?>

    <div class="right_content">

					<h2>All Deal Categories</h2>

					<?php
					if($_REQUEST['msg']=="1")
					{
					?>
						<div class="valid_box">Deal Category  Successfully Added</div>

					    <?php
						}
					?>

					<?php
					if($_REQUEST['msg']=="2")
					{
					?>
						<div class="valid_box">Deal Category Successfully Updated</div>

					    <?php
						}
					?>

					<?php
					if($_REQUEST['msg']=="3")
					{
					?>
						<div class="valid_box">Deal Category Successfully Deleted</div>

					    <?php
						}
					?>

<table width="100%" cellpadding="0" cellspacing="0" border="0" class="rounded_box">
    <thead>
    	<tr>
        	<!--<th></th>-->
            <th>Category Name</th>
            <th>Category Icon</th>
            <!--<th>Date Added</th>-->
            <th>Edit</th>
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

	if($_REQUEST['sort_by']=="mcategory")
	{
		$sql=" group by mcategory order by mcategory asc";
		$target="?sort_by=mcategory";
	}
	elseif($_REQUEST['sort_by']=="mtype")
	{
		$where=" group by mtype order by mtype asc";
		$target="?sort_by=mtype";
	}
	elseif($_REQUEST['sort_by']=="date_added")
	{
		$where=" order by date_added desc";
		$target="?sort_by=date_added";
	}
	elseif($_REQUEST['type']=="subcat")
	{
		$where=" where parent_id!=0";
		$target="?type=subcat";
	}
	else
	{
		$where=" where parent_id=0";
		$target="";
	}

	$sql="select * from ".TABLE_CATEGORIES." where parent_id=0";
	$sqlStrAux = "SELECT count(*) as total FROM ".TABLE_CATEGORIES." where parent_id=0";

/*	$sql="select * from ".TABLE_CATEGORIES."$where";
	$sqlStrAux = "SELECT count(*) as total FROM ".TABLE_CATEGORIES."$where";*/

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
            <td><?php echo stripslashes($row_deals['cat_name']);?></td>
            <td><img alt="" src="../images/category_image/<?php echo stripslashes($row_deals['image']);?>" height="40" width="40"> </td>
            <?php /*?><td><?php echo strftime("%d %b %Y", strtotime($row_deals['date_added'])); ?></td><?php */?>
            <td><a href="add_category.php?mode=edit&id=<?php echo $row_deals[cat_id];?>"><img src="images/user_edit.png" alt="" title="" border="0" /></a></td>
            <td><a href="add_category.php?mode=delete&id=<?php echo $row_deals[cat_id];?>" class="ask"><img src="images/trash.png" alt="" title="" border="0" onClick='return confirm("Are you sure to delete this merchant?")' /></a></td>
        </tr>

    	 <?php
			}
		?>

		<?php
		}
		else
		{
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

