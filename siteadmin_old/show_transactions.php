<?php
include("include/header.php");

$admin_id=intval($_SESSION['admin_id']);
$sql = "SELECT admin_name FROM `".TABLE_ADMIN."` WHERE admin_id='$admin_id'";
$record = $db->query_first($sql);


if (isset($_REQUEST['status']) && !empty($_REQUEST['status'])) {
	$where .=" and transaction_status ='".$_REQUEST['status']."'	";
}	
	//$where .='and deal_type="dailydeal" ';						
	$items = 10;
	$page = 1;
	
	if(isset($_GET['page']) and is_numeric($_GET['page']) and $page = $_GET['page'])
			$limit = " LIMIT ".(($page-1)*$items).",$items";
		else
			$limit = " LIMIT $items";
			
	$today=date("Y-m-d");
	
	$sql="select * from ".TABLE_TRANSACTION ." where 1=1 ".$where." order by transaction_date desc";
	$sqlStrAux = "SELECT count(*) as total FROM ".TABLE_TRANSACTION." where 1=1 ".$where;

	$aux = mysql_fetch_assoc(mysql_query($sqlStrAux));
	$query = mysql_query($sql.$limit);
	
?>


    
    <div class="main_content">
    
      <?php include("include/top_menu.inc.php");?>                    
                    
    <div class="center_content">  
    
   		<?php require("include/left_menu.php"); ?>        
    
    <div class="right_content">  
		 
					<h2>All Transactions</h2>
					
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
		<td>Filter Transactions:
    	<select name="status" id="status" onchange="return ajaxReq(this.value);">
			<option value="">All Transactions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
			<option value="success" >Success Transactions</option>
			<!--<option value="0" >Inactive</option>-->
			<option value="fail" >Failed Transactions</option>
			<option value="pending" >Pending Transactions</option>
			
		</select>
		<input type="submit" name="search" value="Search" />
   		</td>
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
            <th>T. id</th>
            <!--<th>Checkout</th>-->
            <th>Coupon Code</th>
            <th>User</th>
            <th>Qty</th>
            <th>Deal</th>
            <th>Amount ($)</th>
            <th>Date</th>
            <th>Status</th><!--
            <th>Edit</th>
            <th>Delete</th>-->
            <th>Items</th>
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

				$sql_users = mysql_query("SELECT first_name, last_name FROM ".TABLE_USERS." WHERE user_id = '".$row_deals['user_id']."'");
				$user_name = mysql_fetch_array($sql_users);
				$user_full_name = $user_name[0].' '.$user_name[1]; 
							
?>
	
    	<tr>
        	<!--<td><input type="checkbox" name="" /></td>-->
            <td><?php echo $row_deals['transaction_id'];?></td>
            <!--<td><?php echo $row_deals['checkout_type'];?></td>-->
            <td><?php echo $row_deals['coupon_code'];?></td>
            <td><?php echo $user_full_name;?></td>
            <td><?php echo $row_deals['qty'];?></td>
            <td><?php echo $row_deals['deal_id'];?></td>
            <td><?php echo $row_deals['amount'];?></td>
            <td><?php echo $row_deals['transaction_date'];?></td>
            <td><?php echo $row_deals['transaction_status'];?></td>
            
           <!-- <td><a href="add_deal.php?mode=edit&id=<?php echo $row_deals[deal_id];?>"><img src="images/user_edit.png" alt="" title="" border="0" /></a></td>
            <td><a href="add_deal.php?mode=delete&id=<?php echo $row_deals[deal_id];?>" class="ask"><img src="images/trash.png" alt="" title="" border="0" onClick='return confirm("Are you sure to delete this deal?")' /></a></td>
			-->
			<td><a href="show_transactions.php?id=<?php echo $row_deals[tran_id];?>">View Items</a></td>
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
