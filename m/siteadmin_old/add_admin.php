<?php
include("include/header.php");


$admin_id=intval($_SESSION['admin_id']);
$sql = "SELECT admin_name FROM `".TABLE_ADMIN."`  WHERE admin_id='$admin_id'";
$record = $db->query_first($sql);

$admin_id5=intval($_REQUEST['id']);

if($_REQUEST[mode]=="edit")
{
	$admin_id2=intval($_REQUEST['id']);
	$row_deals=mysql_fetch_array(mysql_query("select * from ".TABLE_ADMIN." where admin_id='$admin_id2'"));
}

if($_REQUEST[mode]=="delete")
{
	$adminid=intval($_REQUEST['id']);
	mysql_query("delete from ".TABLE_ADMIN." where admin_id='$adminid'");
	header("location:show_admin.php");	
}

if($_REQUEST[mode]=="status")
{
	$adminid=intval($_REQUEST['id']);
	$row_status=mysql_fetch_array(mysql_query("select status from ".TABLE_ADMIN." where admin_id='$adminid'"));
	
	if($row_status[status]==1)
	{
		mysql_query("update ".TABLE_ADMIN." set status=0 where admin_id='$adminid'");
	}
	else
	{
		mysql_query("update ".TABLE_ADMIN." set status=1 where admin_id='$adminid'");
	}
	
	header("location:show_admin.php");
	
}



if(isset($_REQUEST['submit']))
{
	$adminid=intval($_REQUEST['id']);
	if(isset($_POST['admin_name'])){
	$data['admin_name']=$_POST['admin_name'];
	}
	
	$data['email']=$_POST['adminemail'];
	
	$data['privileges']=implode(",",$_POST['privileges']);
	if(!empty($_POST['admin_password']) && $_POST['admin_password']==$_POST['admin_cpassword'])
	$data['admin_password']=md5($_POST['admin_password']);
	
	$data['status']=1;
	$data['date_added']="NOW()";
	
	if($_REQUEST['mode']=="edit")
	{
	$adminid=intval($_REQUEST['id']);
	if(isset($_POST['admin_name'])){
	$udata['admin_name']=$_POST['admin_name'];
	}
	
	$udata['email']=$_POST['adminemail'];
	
	if(!empty($_POST['admin_password']) && $_POST['admin_password']==$_POST['admin_cpassword'])
	$udata['admin_password']=md5($_POST['admin_password']);
	
	$udata['status']=1;
	//$udata['date_added']="NOW()";
		
		
		$db->query_update(TABLE_ADMIN, $udata, "admin_id='$adminid'");
		header("location:show_admin.php?msg=1");
	
	}
	else
	{
		$db->query_insert(TABLE_ADMIN, $data);
		header("location:show_admin.php?msg=2");
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
					<h1>Edit Admin User</span></h1>
					<form method="post" action="?id=<?php echo $admin_id5;?>&mode=edit" enctype="multipart/form-data" class="niceform2">
			
		<?php
				}
				else
				{
		?>
					<h1>Add Admin User</span></h1>
					<form method="post" action="" enctype="multipart/form-data" class="niceform2">
					
			
		<?php
				}
		?>
         
                <fieldset>
				<?php if($row_deals[admin_name]!='admin'){?>
                    <dl>
                        <dt><label for="email">Admin Name:</label></dt>
                        <dd><input type="text" name="admin_name" id="admin_name" size="54" value="<?php echo stripslashes($row_deals[admin_name]);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>
					<?php } ?>
					<dl>
                        <dt><label for="email">Admin Email:</label></dt>
                        <dd><input type="text" name="adminemail" id="adminemail" size="54" value="<?php echo stripslashes($row_deals[email]);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>
					
                    <dl>
                        <dt><label for="password">Password:</label></dt>
                        <dd><input type="password" name="admin_password" id="admin_password" size="54" value="" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>
					
					<dl>
                        <dt><label for="email">Confirm Password:</label></dt>
                        <dd><input type="password" name="admin_cpassword" id="admin_cpassword" size="54" value="" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>
					
						<?php if($row_deals[admin_name]!='admin'){
	// All Priviledes //
	// manage_user,manage_deal,manage_admin,manage_merchant,manage_dealcategory,manage_city,manage_staticpage,manage_faq						
							
						$privileges=explode(",",$row_deals[privileges]);
						?>
					<dl>
                        <dt><label for="email">Admin Role:</label></dt>
                        <dd>
						<input type="checkbox" name="privileges[]" value="manage_user" <?php if(in_array("manage_user",$privileges)){echo "checked";}?>/> Manage User
						<input type="checkbox" name="privileges[]" value="manage_deal" <?php if(in_array("manage_deal",$privileges)){echo "checked";}?>/> Manage Deal
						<input type="checkbox" name="privileges[]" value="manage_admin" <?php if(in_array("manage_admin",$privileges)){echo "checked";}?>/> Manage Admin <br />
						<input type="checkbox" name="privileges[]" value="manage_merchant" <?php if(in_array("manage_merchant",$privileges)){echo "checked";}?>/> Manage Merchant User
						<input type="checkbox" name="privileges[]" value="manage_dealcategory" <?php if(in_array("manage_dealcategory",$privileges)){echo "checked";}?>/> Manage Deal Category
						<input type="checkbox" name="privileges[]" value="manage_city" <?php if(in_array("manage_city",$privileges)){echo "checked";}?>/> Manage City<br />
						<input type="checkbox" name="privileges[]" value="manage_staticpage" <?php if(in_array("manage_staticpage",$privileges)){echo "checked";}?>/> Manage StaticPage
						<input type="checkbox" name="privileges[]" value="manage_faq" <?php if(in_array("manage_faq",$privileges)){echo "checked";}?>/> Manage FAQ
						</dd>
                    </dl>
					
				
					
					<?php } ?>
					
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

