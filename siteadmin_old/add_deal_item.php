<?php
include("include/header.php");

$mid=intval($_SESSION['mid']);
$sql = "SELECT merchant_name FROM `".TABLE_MERCHANTS."`  WHERE mid='$mid'";
$record = $db->query_first($sql);

include("../fckeditor/fckeditor.php");

if($_REQUEST[mode]=="edit")
{
	$item_id=intval($_REQUEST['id']);
	$row_item=mysql_fetch_array(mysql_query("select * from ".TABLE_DEALS_ITEM." where item_id='$item_id'"));
	
	
	
}

if($_REQUEST[mode]=="delete")
{
	$item_id=intval($_REQUEST['id']);
	mysql_query("delete from ".TABLE_DEALS_ITEM." where item_id='$item_id'");
	header("location:show_deal_item.php?id=".$_REQUEST['id']);				
}





if(isset($_REQUEST['submit']))
{
	$data['deal_id']=$_POST['deal_id'];
	$data['title']=$_POST['title'];
	$data['qty']=$_POST['qty'];
	$data['full_price']=$_POST['full_price'];
	$data['discount_price']=$_POST['discount_price'];
	$data['stock_status']=$_POST['stock_status'];
				
					
	if($_REQUEST['mode']=="edit")
	{				
		$item_id=intval($_REQUEST['id']);
		$db->query_update(TABLE_DEALS_ITEM, $data, "item_id='$item_id'");
		header("location:show_deals.php?msg=4");	

	}
	else
	{
		$primary_id=$db->query_insert(TABLE_DEALS_ITEM, $data);
		header("location:show_deals.php?msg=3");	
	}
		
	
}
$_SESSION["session_temp"] =uniqid();
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
					<h1>Edit Deal Item</span></h1>
					<form method="post" action="?id=<?php echo $item_id;?>&mode=edit" enctype="multipart/form-data" class="niceform2">
			
		<?php
				}
				else
				{
		?>
					<h1>Add Deal Item</span></h1>
					<form method="post" action="" enctype="multipart/form-data" class="niceform2">
					
			
		<?php
				}
		?>
         
                <fieldset>
				
				
					
					<dl>
                        <dt><label for="gender">Select Deal :</label></dt>
                        <dd>
                            <select name="deal_id" class="dropdown" id="deal_id"  size="1">
								<option value="">-- Select --</option>
                                <?php												
														
									$sql_deal=mysql_query("select deal_id,title from " .TABLE_DEALS." where 1=1 and item_type='multiple'  order by deal_id desc");
									while($all_deal=mysql_fetch_array($sql_deal))
									{												
								?>
								
										<option value="<?php echo $all_deal[deal_id];?>" <?php if($all_deal[deal_id]==$row_item[deal_id]) { echo "selected"; }?>><?php echo substr($all_deal[title],0,50);?></option>
								<?php
									}
								?>			
                            </select>
                        </dd>
                    </dl>
					
					
				
                    <dl>
                        <dt><label for="email">Item Name:</label></dt>
                        <dd><input type="text" name="title" id="title" size="54" value="<?php echo stripslashes($row_item[title]);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>
                    
					<dl>
                        <dt><label for="password">Quantity in stock:</label></dt>
                        <dd><input type="text" name="qty" id="qty" size="54" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" value="<?php echo $row_item['qty']?>" /></dd>
                    </dl>
				
				
                    <dl>
                        <dt><label for="password">Original Price:</label></dt>
                        <dd><input type="text" name="full_price" id="full_price" size="54" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" value="<?php echo $row_item[full_price]?>" /></dd>
                    </dl>
					
					<dl>
                        <dt><label for="email">Discount Price:</label></dt>
                        <dd><input type="text" name="discount_price" id="discount_price" size="54" value="<?php echo stripslashes($row_item[discount_price]);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>
                    
					
					  <dl>
                        <dt><label for="password">Display Stock Status?</label></dt>
                        <dd>Limited:
						<?php												
							if($row_item['stock_status']=="limited")
							{
						?>
								<input type="radio" value="limited" name="stock_status" id="stock_status" checked="checked" >
						<?php
							}else{
							?>
							<input type="radio" value="limited" name="stock_status" id="stock_status" >
							<?php }?>
							
							Available:
						<?php	if($row_item['stock_status']=="available")
							{
						?>
								<input type="radio" value="available" name="stock_status" id="stock_status" checked="checked">
								
								<?php }else{?>
								<input type="radio" value="available" name="stock_status" id="stock_status">
								<?php }?>
						
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

