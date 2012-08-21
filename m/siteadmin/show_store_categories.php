<?php
include("include/header.php");
?>
    
    <div class="main_content">
    
      <?php include("include/top_menu.inc.php");?>                    
                    
    <div class="center_content">  
    
   		<?php require("include/left_menu.php"); ?>        
    
    <div class="right_content">  
		 
					<h2>All Store Categories</h2>
					
					<?php 
				if($_SESSION['errmsg']){
				echo '<div class="error_box" style="font-size:12px;">'.$_SESSION['errmsg'].'</div>' ;
				$_SESSION['errmsg']="";
				}if($_SESSION['msg']){
				echo '<div class="valid_box" style="font-size:12px;">'.$_SESSION['msg'].'</div>' ;
				$_SESSION['msg']="";
				}
				
				?>
                    
<table width="100%" cellpadding="0" cellspacing="0" border="0" class="rounded_box">
    <thead>
    	<tr>
        	
            <th>Category Name</th>
           
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
			

		$where=" where parent_id=0";
		$target="";
	
	
	$sql="select * from ".TABLE_STORE_CATEGORIES." where parent_id=0";
	$sqlStrAux = "SELECT count(*) as total FROM ".TABLE_STORE_CATEGORIES." where parent_id=0";
	

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
	
			while($row_category=mysql_fetch_array($query))
			{
							
?>
	
    	<tr>
        	<!--<td><input type="checkbox" name="" /></td>-->			
            <td><?php echo stripslashes($row_category['cat_name']);?></td>
            <?php /*?><td><?php echo strftime("%d %b %Y", strtotime($row_category['date_added'])); ?></td><?php */?>
            <td><a href="add_store_category.php?mode=edit&id=<?php echo $row_category[cat_id];?>"><img src="images/user_edit.png" alt="" title="" border="0" /></a></td>
            <td><a href="add_store_category.php?mode=delete&id=<?php echo $row_category[cat_id];?>" class="ask"><img src="images/trash.png" alt="" title="" border="0" onClick='return confirm("Are you sure to delete this merchant?")' /></a></td>
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

