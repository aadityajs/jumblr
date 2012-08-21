<?php
include("include/header.php");
$status=isset($_REQUEST['status'])?$_REQUEST['status']:'';
$store_id=isset($_REQUEST['store_id'])?$_REQUEST['store_id']:'';
if($status=='2' || $status=='0' && !empty($store_id)){
	
	
	mysql_query("UPDATE ".TABLE_STORES." set store_status='$status' where store_id='$store_id'");
	$_SESSION['msg']="Store status is updated and store is Disapproved";
	header("location:show_stores.php");
	exit;
}
if($status=='1' && !empty($store_id)){
	
	
	mysql_query("UPDATE ".TABLE_STORES." set store_status='$status' where store_id='$store_id'");
	$_SESSION['msg']="Store status is updated and store is Approved";
	header("location:show_stores.php");
	exit;
}


if(isset($_POST['search'])){

$where =" and store_name like '%".$_POST['search_str']."%'";

}
if(isset($_REQUEST['category']) && !empty($_REQUEST['category'])){
	$where .=" and category_id ='".$_REQUEST['category']."'	";
	}	
	if(isset($_REQUEST['city']) && !empty($_REQUEST['city'])){
	$where .=" and city ='".$_REQUEST['city']."'	";
	}	


	$items = 10;
	$page = 1;
	
	if(isset($_GET['page']) and is_numeric($_GET['page']) and $page = $_GET['page'])
			$limit = " LIMIT ".(($page-1)*$items).",$items";
		else
			$limit = " LIMIT $items";
			
	
						
	
		
		$target="";
	
	
	$sql="select * from ".TABLE_STORES." where 1=1 $where order by store_id desc";
	$sqlStrAux = "SELECT count(*) as total FROM ".TABLE_STORES." where 1=1 $where order by store_id desc";

	$aux = mysql_fetch_assoc(mysql_query($sqlStrAux));
	$query = mysql_query($sql.$limit);
	
	
	
?>

    
    <div class="main_content">
    
      <?php include("include/top_menu.inc.php");?>                    
                    
    <div class="center_content">  
    
   		<?php require("include/left_menu.php"); ?>        
    
    <div class="right_content">  
		 
					<h2>All Stores </h2>
					
				<?php 
				if($_SESSION['errmsg']){
				echo '<div class="error_box" style="font-size:12px;">'.$_SESSION['errmsg'].'</div>' ;
				$_SESSION['errmsg']="";
				}if($_SESSION['msg']){
				echo '<div class="valid_box" style="font-size:12px;">'.$_SESSION['msg'].'</div>' ;
				$_SESSION['msg']="";
				}
				
				?>
		<form name="sorting" id="sorting" method="post">		
     	<table class="normal" cellpadding="0" cellspacing="0" border="0" width="100%">
				<tr>
				<td>
						
						Search Store:
							<input type="text" name="search_str" id="search_str" size="30" value="<?php echo $_REQUEST['search_str']?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" />
																				
							
						</td>
						
					</tr>
					<tr><td>&nbsp;</td></tr>
					</table>    
				
				<table width="90%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td>Category:<select name="category">
	<option value="">---Select---</option>
	<?php
	$dealcat=mysql_query("SELECT * FROM ".TABLE_STORE_CATEGORIES);
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
    <td><input class="button" type="submit" value="Search" name="search" /></td>
  </tr>
</table>
</form>
				
								             
<table width="100%" cellpadding="0" cellspacing="0" border="0" class="rounded_box">
    <thead>
    	<tr>
        	<th>Store Name </th>
			<th>Merchant </th>
            <th>Category</th>
            
            <th>Action</th>
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
	
			while($row_stores=mysql_fetch_array($query))
			{
				$sql_category=mysql_query("select * from ".TABLE_STORE_CATEGORIES." where cat_id='$row_stores[category_id]'");
				$row_category=mysql_fetch_array($sql_category);
				
				$sql_merchant=mysql_query("select * from ".TABLE_USERS." where user_id='$row_stores[merchant_id]'");
				$row_merchant=mysql_fetch_array($sql_merchant);
							
?>
	
    	<tr>
        	<!--<td><input type="checkbox" name="" /></td>-->			
            <td><?php echo stripslashes($row_stores['store_name']);?></td>
			<td>
			<?php echo $row_merchant['company_name']?>
			</td>
            <td><?php echo stripslashes($row_category['cat_name']);?></td>
           
            <td><a href="add_store.php?mode=edit&id=<?php echo $row_stores['store_id'];?>"><img src="images/user_edit.png" alt="" title="" border="0" /></a> 
			<a href="add_store.php?mode=delete&id=<?php echo $row_stores['store_id'];?>" class="ask"><img src="images/trash.png" alt="" title="" border="0" onClick='return confirm("Are you sure to delete this store?")' /></a>
			
			<?php if($row_stores['store_status']==1){?>
			<a href="show_stores.php?store_id=<?php echo $row_stores['store_id']?>&status=2"><img src="images/unblock.png" alt="" title="" border="0" width="20" /></a>
			<?php }else{?>
			<a href="show_stores.php?store_id=<?php echo $row_stores['store_id']?>&status=1"><img src="images/block.png" alt="" title="" border="0" width="20" /></a>
			<?php }?>
			<a href="show_store_location.php?store_id=<?php echo $row_stores['store_id'];?>" title="Store Location"><img src="images/store_location.png" alt="" title="Store Location" border="0" width="30" /></a> 
			<a href="show_store_review.php?store_id=<?php echo $row_stores['store_id'];?>" title="Store Review"><img src="images/review.png" alt="" title="Store Review" border="0" width="30" /></a> 
			</td>
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
