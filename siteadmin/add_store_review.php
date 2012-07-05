<?php
include("include/header.php");
$store_id=($_REQUEST['store_id']);

if($_REQUEST[mode]=="edit")
{
	$review_id=intval($_REQUEST['review_id']);
	
	$row_stores=mysql_fetch_array(mysql_query("select * from ".TABLE_STORES_REVIEW." where review_id='$review_id'"));
}

if($_REQUEST[mode]=="delete")
{
	$review_id=intval($_REQUEST['review_id']);
	mysql_query("delete from ".TABLE_STORES_REVIEW." where review_id='$review_id'");
	
	$_SESSION['msg']="Review is deleted successfully";
	header("location:show_store_review.php?store_id=".$store_id);	
}

if(isset($_REQUEST['submit']))
{	
	
	
	$store_id=($_REQUEST['store_id']);
	$data['site']=$_POST['site'];
	$data['comment']=stripslashes($_POST['comment']);
	$data['store_id']=$store_id;
	

	
	
	if($_REQUEST['mode']=="edit")
	{	
		$review_id=($_REQUEST['review_id']);
		$db->query_update(TABLE_STORES_REVIEW, $data, "review_id='$review_id'");
		$_SESSION['msg']='Store review is updated successfully';
		header("location:show_store_review.php?store_id=".$store_id);	
		exit;
	}
	else
	{
		
		
		$review_id=$db->query_insert(TABLE_STORES_REVIEW, $data);
		
		if($review_id)
		{
		$_SESSION['msg']='Store review is created successfully';
		header("location:show_store_review.php?store_id=".$store_id);	
		exit;
		}
		else
		{
		$_SESSION['errmsg']="Unable to create store review";
		header("location:show_store_review.php?store_id=".$store_id);	
		exit;
		}
	}	

}

?>

    <div class="main_content">
    
      <?php include("include/top_menu.inc.php");?>                    
                    
    <div class="center_content">  
    
   		<?php require("include/left_menu.php"); ?>        
    
    <div class="right_content"> 	
		 
		 <div class="form">		 
		 
		
					<h1>Add Store Review </h1>
					<form method="post" action="" enctype="multipart/form-data" class="niceform2">
					<input type="hidden" name="review_id" value="<?php echo $_REQUEST['review_id']?>" />
					<input type="hidden" name="mode" value="<?php echo  $_REQUEST['mode']?>" />
     			    <input type="hidden" name="store_id" value="<?php echo $_REQUEST['store_id']?>" />
                <fieldset>
				
                    <dl>
                        <dt><label for="email">Store Site:</label></dt>
                        <dd>
						<input type="text" name="site" id="site" size="54" value="<?php echo $row_stores[site]?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" />
						
						</dd>
                    </dl>
					
					
					<dl>
                        <dt><label for="password">Comment:</label></dt>
                        <dd><textarea  rows="5" cols="35" name="comment"><?php echo $row_stores[comment]?></textarea></dd>
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

