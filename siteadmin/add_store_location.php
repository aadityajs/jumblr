<?php
include("include/header.php");
$store_id=($_REQUEST['store_id']);

if($_REQUEST[mode]=="edit")
{
	$location_id=intval($_REQUEST['location_id']);
	
	$row_stores=mysql_fetch_array(mysql_query("select * from ".TABLE_STORES_LOCATION." where location_id='$location_id'"));
}

if($_REQUEST[mode]=="delete")
{
	$location_id=intval($_REQUEST['location_id']);
	mysql_query("delete from ".TABLE_STORES_LOCATION." where location_id='$location_id'");
	
	$_SESSION['msg']="Location is deleted successfully";
	header("location:show_store_location.php?store_id=".$store_id);	
}

if(isset($_REQUEST['submit']))
{	
	
	
	$store_id=($_REQUEST['store_id']);
	$data['address1']=$_POST['address1'];
	$data['location_name']=stripslashes($_POST['location_name']);
	$data['address1']=stripslashes($_POST['address1']);
	$data['address2']=stripslashes($_POST['address2']);
	$data['city']=stripslashes($_POST['city']);
	$data['state']=stripslashes($_POST['state']);
	$data['zip']=stripslashes($_POST['zip']);
	$data['phone']=stripslashes($_POST['phone']);
	
	$data['store_id']=$store_id;
	

	
	
	if($_REQUEST['mode']=="edit")
	{	
		$location_id=($_REQUEST['location_id']);
		$db->query_update(TABLE_STORES_LOCATION, $data, "location_id='$location_id'");
		$_SESSION['msg']='Store Location is updated successfully';
		header("location:show_store_location.php?store_id=".$store_id);	
		exit;
	}
	else
	{
		
		
		$location_id=$db->query_insert(TABLE_STORES_LOCATION, $data);
		
		if($location_id)
		{
		$_SESSION['msg']='Store location is created successfully';
		header("location:show_store_location.php?store_id=".$store_id);	
		exit;
		}
		else
		{
		$_SESSION['errmsg']="Unable to create store location";
		header("location:show_store_location.php?store_id=".$store_id);	
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
		 
		
					<h1>Add Store Location</h1>
					<form method="post" action="" enctype="multipart/form-data" class="niceform2">
					<input type="hidden" name="location_id" value="<?php echo $_REQUEST['location_id']?>" />
					<input type="hidden" name="mode" value="<?php echo  $_REQUEST['mode']?>" />
     			    <input type="hidden" name="store_id" value="<?php echo $_REQUEST['store_id']?>" />
                <fieldset>
				
                    <dl>
                        <dt><label for="email">Location Name:</label></dt>
                        <dd>
						<input type="text" name="location_name" id="location_name" size="54" value="<?php echo $row_stores[location_name]?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" />
						
						</dd>
                    </dl>
					
					<dl>
                        <dt><label for="email">Address1:</label></dt>
                        <dd>
						<input type="text" name="address1" id="address1" size="54" value="<?php echo $row_stores[address1]?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" />
						
						</dd>
                    </dl>
					
					<dl>
                        <dt><label for="email">Address2:</label></dt>
                        <dd>
						<input type="text" name="address2" id="address2" size="54" value="<?php echo $row_stores[address2]?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" />
						
						</dd>
                    </dl>
					
					<dl>
                        <dt><label for="email">City:</label></dt>
                        <dd>
						<input type="text" name="city" id="city" size="54" value="<?php echo $row_stores[city]?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" />
						
						</dd>
                    </dl>
					
					<dl>
                        <dt><label for="email">State:</label></dt>
                        <dd>
						<input type="text" name="state" id="state" size="54" value="<?php echo $row_stores[state]?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" />
						
						</dd>
                    </dl>
					
					<dl>
                        <dt><label for="email">Zip:</label></dt>
                        <dd>
						<input type="text" name="zip" id="zip" size="54" value="<?php echo $row_stores[zip]?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" />
						
						</dd>
                    </dl>
					
					<dl>
                        <dt><label for="email">Phone:</label></dt>
                        <dd>
						<input type="text" name="phone" id="phone" size="54" value="<?php echo $row_stores[phone]?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" />
						
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

