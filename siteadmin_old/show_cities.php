<?php
include("include/header.php");

?>

    
    <div class="main_content">
    
      <?php include("include/top_menu.inc.php");?>                    
                    
    <div class="center_content">  
    
   		<?php require("include/left_menu.php"); ?>        
    
    <div class="right_content">  
		 
					<h2>All Cities </h2>
					
					<?php				
					if($_REQUEST['msg']=="1")
					{				
					?>		
						<div class="valid_box">City Successfully Added</div>
							
					    <?php
						}
					?>
					
					<?php				
					if($_REQUEST['msg']=="2")
					{				
					?>		
						<div class="valid_box">City Successfully Updated</div>
							
					    <?php
						}
					?>
					<?php				
					if($_REQUEST['msg']=="3")
					{				
					?>		
						<div class="valid_box">Duplicate City, not added</div>
							
					    <?php
						}
					?>
                    
<table width="100%" cellpadding="0" cellspacing="0" border="0" class="rounded_box">
    <thead>
    	<tr>
        	<!--<th></th>-->
            <th>City Name </th>
			<th>City Pic </th>
            <th>Country Name</th>
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
	else
	{
		$where="";
		$target="";
	}
	
	$sql="select * from ".TABLE_CITIES."$where";
	$sqlStrAux = "SELECT count(*) as total FROM ".TABLE_CITIES."$where";

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
				$sql_category=mysql_query("select * from ".TABLE_COUNTRIES." where country_id='$row_deals[country_id]'");
				$row_category=mysql_fetch_array($sql_category);
							
?>
	
    	<tr>
        	<!--<td><input type="checkbox" name="" /></td>-->			
            <td><?php echo stripslashes($row_deals['city_name']);?></td>
			<td>
			<?php if(isset($row_deals['city_pic']) AND $row_deals['city_pic']!=""){ ?>
			<img src="../uploads/city_images/thumb/<?php echo $row_deals['city_pic'];?>" height="50" width="70" />
			<?php } ?>
			</td>
            <td><?php echo stripslashes($row_category['country_name']);?></td>
            <td><a href="add_city.php?mode=edit&id=<?php echo $row_deals['city_id'];?>"><img src="images/user_edit.png" alt="" title="" border="0" /></a></td>
            <td><a href="add_city.php?mode=delete&id=<?php echo $row_deals['city_id'];?>" class="ask"><img src="images/trash.png" alt="" title="" border="0" onClick='return confirm("Are you sure to delete this city?")' /></a></td>
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
