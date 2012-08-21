<?php
include("include/header.php");

if($_REQUEST[mode]=="edit")
{
	$page_id=intval($_REQUEST['id']);
	$row_deals=mysql_fetch_array(mysql_query("select * from ".TABLE_PAGES." where page_id='$page_id'"));
}

include("../fckeditor/fckeditor.php");

if($_REQUEST[mode]=="delete")
{
	$page_id=intval($_REQUEST['id']);
	mysql_query("delete from ".TABLE_PAGES." where page_id='$page_id'");
	header("location:show_pages.php");	
}

if(isset($_REQUEST['submit']))
{	
	$page_id=intval($_REQUEST['id']);
	$data['title']=$_POST['title'];
	$data['desc']=$_POST['desc'];
	$data['status']=1;
	$data['date_added']=date("Y-m-d");
	
	if($_REQUEST['mode']=="edit")
	{	
		$db->query_update(TABLE_PAGES, $data, "page_id='$page_id'");
		header("location:show_pages.php?msg=2");		
	}
	else
	{
		$db->query_insert(TABLE_PAGES, $data);
		header("location:show_pages.php?msg=1");
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
					<h1>Edit Static Page</span></h1>
					<form method="post" action="?id=<?php echo $page_id;?>&mode=edit" enctype="multipart/form-data" class="niceform2">
			
		<?php
				}
				else
				{
		?>
					<h1>Add Static Page</span></h1>
					<form method="post" action="" enctype="multipart/form-data" class="niceform2">					
			
		<?php
				}
		?>
         
                <fieldset>
				
                    <dl>
                        <dt><label for="email">Page Title:</label></dt>
                        <dd><input type="text" name="title" id="title" size="54" value="<?php echo stripslashes($row_deals[title]);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>
					
					 <dl>
                        <dt><label for="email">Page Content:</label></dt>
                        <dd>
						<?php									
							$oFCKeditor = new FCKeditor('desc');
							$oFCKeditor->BasePath = '../fckeditor/';
							$oFCKeditor->Value = stripslashes($row_deals['desc']) ;
							$oFCKeditor->Width = '100%' ;
							$oFCKeditor->Height = '400' ;
							$oFCKeditor->Create();
						?>							
						</dd>
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

