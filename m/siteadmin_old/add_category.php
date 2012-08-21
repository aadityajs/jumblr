<?php
include("include/header.php");

$admin_id=intval($_SESSION['admin_id']);
$sql = "SELECT admin_name FROM `".TABLE_ADMIN."`  WHERE admin_id='$admin_id'";
$record = $db->query_first($sql);

$admin_id5=intval($_REQUEST['id']);

$cat_id2=intval($_REQUEST['id']);

if($_REQUEST[mode]=="edit")
{
	$cat_id=intval($_REQUEST['id']);
	$row_deals=mysql_fetch_array(mysql_query("select * from ".TABLE_CATEGORIES." where cat_id='$cat_id'"));
}

if($_REQUEST[mode]=="delete")
{
	$cat_id=intval($_REQUEST['id']);
	mysql_query("delete from ".TABLE_CATEGORIES." where cat_id='$cat_id'");
	header("location:show_categories.php?msg=3");	
}

if(isset($_REQUEST['submit']))
{	
	$cat_id=intval($_REQUEST['id']);
	$date_added=date("Y-m-d");	
	$data['parent_id']=0;
	$data['cat_name']=$_POST['cat_name'];
	$data['status']=1;
	$data['date_added']=$date_added;
	
	
	if(file_exists($_FILES['image']['tmp_name'])){
		$file=$_FILES['image']['name'];
		move_uploaded_file($_FILES['image']['tmp_name'],"../category_image/".$_FILES['image']['name']);
		$data['image']=$file;
		
	}
	if($_REQUEST['mode']=="edit")
	{	
		$db->query_update(TABLE_CATEGORIES, $data, "cat_id='$cat_id'");
		header("location:show_categories.php?msg=2");	
	}
	else
	{
		$db->query_insert(TABLE_CATEGORIES, $data);
		header("location:show_categories.php?msg=1");
	}
}
?>

    
    <div class="main_content">
    
      <?php include("include/top_menu.inc.php");?>                    
                    
    <div class="center_content">  
    
   		<?php require("include/left_menu.php"); ?>        
    
    <div class="right_content">  
	
		 
		 <div class="form">
		 
		 
		 <?php
				if($_REQUEST['mode']=="edit")
				{
		?>
					<h1>Edit Deal Category</span></h1>
					<form method="post" action="?id=<?php echo $cat_id2;?>&mode=edit" enctype="multipart/form-data" class="niceform2">
			
		<?php
				}
				else
				{
		?>
					<h1>Add Deal Category</span></h1>
					<form method="post" action="" enctype="multipart/form-data" class="niceform2">					
			
		<?php
				}
		?>
         
                <fieldset>
				
                    <dl>
                        <dt><label for="email">Category Name:</label></dt>
                        <dd><input type="text" name="cat_name" id="cat_name" size="54" value="<?php echo stripslashes($row_deals[cat_name]);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>
					
					<dl>
                        <dt><label for="email">Category Name:</label></dt>
                        <dd><?php if(!empty($row_deals['image'])){?><img src="../category_image/<?php echo stripslashes($row_deals['image']);?>" width="50"><?php }?>
						
						<br /><input type="file" name="image" /></dd>
                    </dl>
					
					
                     <dl class="submit">
                    <input type="submit" name="submit" id="submit" value="Submit" />
                     </dl>
					 
                </fieldset>
                
         </form>
         </div>
		 
     </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->  
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    	<?php require("include/footer.inc.php"); ?>   

