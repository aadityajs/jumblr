<?php
include("include/header.php");

if(isset($_REQUEST['best_deal']) && isset($_REQUEST['deal_id']) &&  $_REQUEST['best_deal']=='y'){

	$sql="UPDATE ".TABLE_DEALS." set best_deal='".$_REQUEST['best_deal']."' where deal_id='".$_REQUEST['deal_id']."'";
	mysql_query($sql);
	$_SESSION['msg']="Deal is featured .";
	header("location:show_bestdeals.php");
	exit;


}elseif(isset($_REQUEST['best_deal']) && isset($_REQUEST['deal_id']) &&  $_REQUEST['best_deal']=='n'){


		$sql="UPDATE ".TABLE_DEALS." set best_deal='".$_REQUEST['best_deal']."' where deal_id='".$_REQUEST['deal_id']."'";
		mysql_query($sql);
		$_SESSION['msg']="Deal is unfeatured .";
		header("location:show_bestdeals.php");
		exit;

}

if(isset($_REQUEST['in_sidebar']) && isset($_REQUEST['deal_id']) &&  $_REQUEST['in_sidebar']=='y'){

	$sql="UPDATE ".TABLE_DEALS." set in_sidebar='".$_REQUEST['in_sidebar']."' where deal_id='".$_REQUEST['deal_id']."'";
	mysql_query($sql);
	$_SESSION['msg']="Deal is in More deals .";
	header("location:show_bestdeals.php");
	exit;


}elseif(isset($_REQUEST['in_sidebar']) && isset($_REQUEST['deal_id']) &&  $_REQUEST['in_sidebar']=='n'){


		$sql="UPDATE ".TABLE_DEALS." set in_sidebar='".$_REQUEST['in_sidebar']."' where deal_id='".$_REQUEST['deal_id']."'";
		mysql_query($sql);
		$_SESSION['msg']="Deal is removed from More deals .";
		header("location:show_bestdeals.php");
		exit;

}

	if(isset($_POST['search_str']) && !empty($_REQUEST['search_str'])){

	$where =" and title like '%".$_POST['search_str']."%'";

	}

	if(isset($_REQUEST['category']) && !empty($_REQUEST['category'])){
	$where .=" and deal_cat ='".$_REQUEST['category']."'	";
	}
	if(isset($_REQUEST['city']) && !empty($_REQUEST['city'])){
	$where .=" and city ='".$_REQUEST['city']."'	";
	}


	$where .=" and status='1' ";

	$items = 10;
	$page = 1;

	if(isset($_GET['page']) and is_numeric($_GET['page']) and $page = $_GET['page'])
			$limit = " LIMIT ".(($page-1)*$items).",$items";
		else
			$limit = " LIMIT $items";

	$today=date("Y-m-d");

	$sql="select * from ".TABLE_DEALS ." Where 1=1 $where order by deal_id desc";
	$sqlStrAux = "SELECT count(*) as total FROM ".TABLE_DEALS." where 1=1 $where";

	$aux = mysql_fetch_assoc(mysql_query($sqlStrAux));
	$query = mysql_query($sql.$limit);
?>



    <div class="main_content">

      <?php include("include/top_menu.inc.php");?>

    <div class="center_content">

   		<?php require("include/left_menu.php"); ?>

    <div class="right_content">

					<h2>National Deals</h2>

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
								<input type="submit" name="search" value="Search" />

							</td>

						</tr>

						<tr><td>&nbsp;</td></tr>

			</table>


  <!--<table width="90%" border="0" cellspacing="2" cellpadding="2">
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
   --></form>
<table width="100%" cellpadding="0" cellspacing="0" border="0" class="rounded_box">
    <thead>
    	<tr>
        	<!--<th></th>-->
            <th>Deal Name</th>
            <th>Deal City</th>
            <th>Price</th>
            <th>Merchant</th>
			<th>Category</th>
            <th>National Deal</th>
            <th>More Deals</th>
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
			$merchant=get_merchant_details($row_deals['deal_id']);
			$category=get_deal_category($row_deals['deal_id']);
			$sql_show_city = "SELECT * FROM ".TABLE_CITIES." WHERE city_id = $row_deals[city]";
			$show_city = mysql_fetch_array(mysql_query($sql_show_city));
?>

    	<tr>
        	<!--<td><input type="checkbox" name="" /></td>-->
            <td><?php echo stripslashes($row_deals['title']);?></td>
            <td><?php echo ($row_deals[city] == '-1' ? 'National Deal' : stripslashes($show_city['city_name']));?></td>
            <td>&pound;<?php echo stripslashes($row_deals['full_price']);?></td>
            <td><?php echo $merchant['company_name'];?></td>
			<td><?php echo $category['cat_name'];?></td>
            <?php if($row_deals['best_deal']=='y'){ ?>
			<td><a href='show_bestdeals.php?best_deal=n&deal_id=<?php echo $row_deals['deal_id']?>'><img src="images/unblock.png" width="20" /></a></td>
			<?php }else{?>
			<td><a href='show_bestdeals.php?best_deal=y&deal_id=<?php echo $row_deals['deal_id']?>'><img src="images/block.png" width="20" /></a></td>
			<?php }?>

			 <?php if($row_deals['in_sidebar']=='y'){ ?>
			<td><a href='show_bestdeals.php?in_sidebar=n&deal_id=<?php echo $row_deals['deal_id']?>'><img src="images/unblock.png" width="20" /></a></td>
			<?php }else{?>
			<td><a href='show_bestdeals.php?in_sidebar=y&deal_id=<?php echo $row_deals['deal_id']?>'><img src="images/block.png" width="20" /></a></td>
			<?php }?>
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
