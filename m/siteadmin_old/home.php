<?php
include("include/header.php");

$admin_id=intval($_SESSION['admin_id']);
$sql = "SELECT admin_name FROM `".TABLE_ADMIN."` WHERE admin_id='$admin_id'";
$record = $db->query_first($sql);

include("../fckeditor/fckeditor.php");

if(!isset($_REQUEST['mode'])){$_REQUEST['mode']='';}

if($_REQUEST['mode']=="edit")
{
	$deal_id=intval($_REQUEST['id']);
	$row_deals=mysql_fetch_array(mysql_query("select * from ".TABLE_DEALS." where deal_id='$deal_id'"));
}

if($_REQUEST['mode']=="delete")
{
	$deal_id=intval($_REQUEST['id']);
	mysql_query("delete from ".TABLE_DEALS." where deal_id='$deal_id'");
	header("location:show_deals.php");				
}

?>

    
    <div class="main_content">
    
      <?php include("include/top_menu.inc.php");?>                    
                    
    <div class="center_content">  
 
   		<?php include("include/left_menu.php"); ?>        

    <div class="right_content">  
	
		 
		 Welcome, <?php echo $record['admin_name'];?>
		 
     </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->  
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    	<?php require("include/footer.inc.php"); ?>   

