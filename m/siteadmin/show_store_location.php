<?php
include("include/header.php");

$store_id=isset($_REQUEST['store_id'])?$_REQUEST['store_id']:'';
if(empty($store_id)){
$_SESSION['errmsg']="Please select a Store";	
header("location:show_stores.php");

exit;
}
?>

    
    <div class="main_content">
    
      <?php include("include/top_menu.inc.php");?>                    
                    
    <div class="center_content">  
    
   		<?php require("include/left_menu.php"); ?>        
    
    <div class="right_content">  
		 
					<h2>All Store Location </h2>
					
				<?php 
				if($_SESSION['errmsg']){
				echo '<div class="error_box" style="font-size:12px;">'.$_SESSION['errmsg'].'</div>' ;
				$_SESSION['errmsg']="";
				}if($_SESSION['msg']){
				echo '<div class="valid_box" style="font-size:12px;">'.$_SESSION['msg'].'</div>' ;
				$_SESSION['msg']="";
				}
				
				?>
     <div style="float:right"><a href="add_store_location.php?mode=add&store_id=<?php echo $store_id?>">Add Location</a></div>                 
<table width="100%" cellpadding="0" cellspacing="0" border="0" class="rounded_box">
    <thead>
    	<tr>
        	<!--<th></th>-->
            <th>Location Name </th>
			<th>Address </th>
            <th>City</th>
            
            <th>Action</th>
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
			
	
						
	
		$where=" Where store_id='$store_id' ";
		$target="";
	
	
	$sql="select * from ".TABLE_STORES_LOCATION."$where order by location_id desc";
	$sqlStrAux = "SELECT count(*) as total FROM ".TABLE_STORES_LOCATION."$where order by location_id desc";

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
	
			while($row_stores=mysql_fetch_array($query))
			{
				
							
?>
	
    	<tr>
        	<!--<td><input type="checkbox" name="" /></td>-->			
            <td><?php echo stripslashes($row_stores['location_name']);?></td>
			<td><?php echo stripslashes($row_stores['address1']);?></td>
            <td><?php echo stripslashes($row_stores['city']);?></td>
           
            <td><a href="add_store_location.php?mode=edit&store_id=<?php echo $row_stores['store_id']?>&location_id=<?php echo $row_stores['location_id'];?>"><img src="images/user_edit.png" alt="" title="" border="0" /></a> 
			<a href="add_store_location.php?mode=delete&store_id=<?php echo $row_stores['store_id']?>&location_id=<?php echo $row_stores['location_id'];?>" class="ask"><img src="images/trash.png" alt="" title="" border="0" onClick='return confirm("Are you sure to delete this Location?")' /></a>
			
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
