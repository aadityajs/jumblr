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
		 
					<h2>All Deal Items</h2>
					
				
					
					<?php				
					if($_REQUEST['msg']=="3")
					{				
					?>		
						<div class="valid_box">Deal Item Successfully Added</div>
							
					<?php
						}
					?>
					
					<?php				
					if($_REQUEST['msg']=="4")
					{				
					?>		
						<div class="valid_box">Deal Item Successfully Updated</div>
							
					<?php
						}
					?>
                    
<table width="100%" cellpadding="0" cellspacing="0" border="0" class="rounded_box">
    <thead>
    	<tr>
        	<!--<th></th>-->
            <th>Item Name</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Deal name</th>
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
	$deal_id=$_REQUEST['id'];
	if(!empty($deal_id)){$subq=" and deal_id='$deal_id'";}
	$sql="select * from ".TABLE_DEALS_ITEM ." where 1=1 ". $subq;

	$sqlStrAux = "SELECT count(*) as total FROM ".TABLE_DEALS_ITEM." where 1=1 ".$subq;


	$aux = mysql_fetch_assoc(mysql_query($sqlStrAux));
	$query = mysql_query($sql.$limit);

	if($aux['total']>0){
			$p = new pagination;
			$p->Items($aux['total']);
			$p->limit($items);
			$p->target("?id=".$deal_id);
			$p->currentPage($page);
			
			$p->calculate();
			$p->changeClass("pagination");
			
			  

	
			while($row_items=mysql_fetch_array($query))
			{				
							
?>
	
    	<tr>
        	<!--<td><input type="checkbox" name="" /></td>-->			
            <td><?php echo stripslashes($row_items['title']);?></td>
            <td><?php echo stripslashes($row_items['qty']);?></td>
            <td>$<?php echo stripslashes($row_items['full_price']);?></td>
            <td><?php 
			$deal=mysql_fetch_object(mysql_query("select deal_id,title from ".TABLE_DEALS." where deal_id='$row_items[deal_id]'"));
			echo $deal->title;
			?></td>

            <td><a href="add_deal_item.php?mode=edit&id=<?php echo $row_items[item_id];?>"><img src="images/user_edit.png" alt="" title="" border="0" /></a></td>
            <td><a href="add_deal_item.php?mode=delete&id=<?php echo $row_items[item_id];?>" class="ask"><img src="images/trash.png" alt="" title="" border="0" onClick='return confirm("Are you sure to delete this deal item?")' /></a></td>
			
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

