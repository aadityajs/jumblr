<?php
include("include/header.php");

?>

    
    <div class="main_content">
    
      <?php include("include/top_menu.inc.php");?>                    
                    
    <div class="center_content">  
    
   		<?php require("include/left_menu.php"); ?>        
    
    <div class="right_content">  
		 
					<h2>All Settings </h2>
					
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
        	<!--<th></th>-->
            <th>Name </th>
            <th>Value</th>
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
						
	
	
	$sql="select * from ".TABLE_SETTING;
	$sqlStrAux = "SELECT count(*) as total FROM ".TABLE_SETTING;

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
        		
            <td><?php echo stripslashes($row_deals['name']);?></td>
            <td><?php echo stripslashes($row_deals['value']);?></td>
            <td><a href="settings.php?mode=edit&id=<?php echo $row_deals[id];?>"><img src="images/user_edit.png" alt="" title="" border="0" /></a></td>
            <td><a href="settings.php?mode=delete&id=<?php echo $row_deals[id];?>" class="ask"><img src="images/trash.png" alt="" title="" border="0" onClick='return confirm("Are you sure to delete this setting?")' /></a></td>
        </tr>
        
    	 <?php

			}			
		?>
		
				<tr><td colspan="4"><?php $p->show();?></td></tr>
	
		<?php
		}
		else
		{
			echo "No Data Found";
		}
?>
        
    </tbody>
</table>

		 
     </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->  
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    	<?php require("include/footer.inc.php"); ?>   

