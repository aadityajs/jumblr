<?php
include("include/header.php");
$mode=isset($_REQUEST['mode'])?$_REQUEST['mode']:'add';



if($mode=="edit")
{
	$id=intval($_REQUEST['id']);
	$row_deals=mysql_fetch_array(mysql_query("select * from ".TABLE_SETTING." where id='$id'"));
}

include("../fckeditor/fckeditor.php");

if($mode=="delete")
{
	$id=intval($_REQUEST['id']);
	mysql_query("delete from ".TABLE_SETTING." where id='$id'");
	header("location:show_pages.php");
}

if(isset($_REQUEST['submit']))
{
	$id=intval($_REQUEST['id']);
	$data['value']=$_POST['value'];
	$data['name']=$_POST['name'];


	if($mode=="edit")
	{
		$db->query_update(TABLE_SETTING, $data, "id='$id'");
		$_SESSION['msg']="Setting is updated successfully";
		header("location:show_settings.php");
		exit;
	}
	else
	{
		$db->query_insert(TABLE_SETTING, $data);
		$_SESSION['msg']="Setting is created successfully";
		header("location:show_settings.php");
		exit;
	}
}
?>


    <div class="main_content">

      <?php include("include/top_menu.inc.php");?>

    <div class="center_content">

   		<?php require("include/left_menu.php"); ?>

    <div class="right_content">


		 <div class="form">



					<h1>Set Values</span></h1>
					<form method="post" action="" enctype="multipart/form-data" class="niceform2">
					<input type="hidden" name="mode" value="<?php echo $mode?>" />
					<input type="hidden" name="id" value="<?php echo $id?>" />

                <fieldset>

					<?php if ($_GET[mode] != 'edit') { ?>
                    <dl>
                        <dt><label for="email">Setting Name:</label></dt>
                        <dd><input type="text" name="name" id="name" size="54" value="<?php echo stripslashes($row_deals[name]);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>
					<?php } else { ?>
					<dl>
						<input type="hidden" name="name" id="name" size="54" value="<?php echo stripslashes($row_deals[name]);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" />
                        <dt><label for="email">Edit Setting for: </label></dt>
                        <dd><label style="border: 1px solid #CCCCCC; height: 25px; background:#ececec; padding: 8px;" ><?php echo stripslashes($row_deals[name]);?></label> (Readonly)</dd>
                    </dl>
					<?php } ?>
					 <dl>
                        <dt><label for="email">Setting Value:</label></dt>
                        <dd>
						<input type="text" name="value" id="value" size="54" value="<?php echo stripslashes($row_deals[value]);?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" />
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

