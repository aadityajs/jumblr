<?php
include("include/header.php");

if(isset($_REQUEST['is_previous']) && isset($_REQUEST['deal_id']) &&  $_REQUEST['is_previous']=='y'){

	$sql="UPDATE ".TABLE_DEALS." set is_previous='".$_REQUEST['is_previous']."' where deal_id='".$_REQUEST['deal_id']."'";
	mysql_query($sql);
	$_SESSION['msg']="Deal is in previous deals .";
	header("location:show_previous_deals.php");
	exit;


}elseif(isset($_REQUEST['is_previous']) && isset($_REQUEST['deal_id']) &&  $_REQUEST['is_previous']=='n'){


		$sql="UPDATE ".TABLE_DEALS." set is_previous='".$_REQUEST['is_previous']."' where deal_id='".$_REQUEST['deal_id']."'";
		mysql_query($sql);
		$_SESSION['msg']="Deal is removed from previous deals .";
		header("location:show_previous_deals.php");
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

	$omit_sql_today = "SELECT * FROM ".TABLE_DEALS." WHERE status >= 1 AND deal_end_time LIKE '".date("Y-m-d")."%' LIMIT 0, 1";
	$omit_today_res = mysql_fetch_array(mysql_query($omit_sql_today));

	//$show_sql="SELECT * FROM ".TABLE_TRANSACTION." WHERE transaction_status = 'success' AND deal_id != '".$omit_today_res['deal_id']."'";
	//$sqlStrAux = "SELECT count(*) as total FROM ".TABLE_TRANSACTION." where 1=1 AND transaction_status = 'success'";
	$show_sql="SELECT * FROM ".TABLE_DEALS." WHERE status = 1 AND deal_id != '".$omit_today_res['deal_id']."'";
	$sqlStrAux = "SELECT count(*) as total FROM ".TABLE_DEALS." where 1=1 AND status = 1";

	$aux = mysql_fetch_assoc(mysql_query($sqlStrAux));
	$query = mysql_query($show_sql.$limit);
?>



    <div class="main_content">

      <?php include("include/top_menu.inc.php");?>

    <div class="center_content">

   		<?php require("include/left_menu.php"); ?>

    <div class="right_content">

					<h2>Previous Deals</h2>

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
            <th>Org. Price</th>
            <th>Dealed</th>
            <th>Merchant</th>
            <th>Show/Hide</th>
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
			//echo $row_deals['deal_id'];
			$deal_details = get_deal_details($row_deals['deal_id']);
			$merchant=get_merchant_details($row_deals['deal_id']);
			$category=get_deal_category($row_deals['deal_id']);
			//var_dump($category);
?>

    	<tr>
        	<!--<td><input type="checkbox" name="" /></td>-->
            <td><?php echo stripslashes($deal_details['title']);?></td>
            <td>&pound;<?php echo stripslashes($deal_details['full_price']);?></td>
            <td>&pound;<?php echo stripslashes($deal_details['discounted_price']);?></td>
            <td><?php echo $merchant['company_name'];?></td>
			<!--<td><?php echo $category['cat_name'];?></td>-->
            <?php if($deal_details['is_previous']=='y'){ ?>
			<td><a href='show_previous_deals.php?is_previous=n&deal_id=<?php echo $row_deals['deal_id']?>'><img src="images/unblock.png" width="20" /></a></td>
			<?php }else{?>
			<td><a href='show_previous_deals.php?is_previous=y&deal_id=<?php echo $row_deals['deal_id']?>'><img src="images/block.png" width="20" /></a></td>
			<?php }?>

        </tr>

    	 <?php
			}
		?>

		<?php
		} else {
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
