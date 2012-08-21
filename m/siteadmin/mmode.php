<?php
include("include/header.php");

?>


    <div class="main_content">

      <?php include("include/top_menu.inc.php");?>

    <div class="center_content">

   		<?php require("include/left_menu.php"); ?>

    <div class="right_content">

	<?php
	if($_REQUEST['msg']=="1")
	{
	?>
		<div class="valid_box">Site Update Successfull</div>

	<?php
	}
	?>


	<?php
		if(isset($_POST['mMode']) && $_POST['mMode'] != "" && $_POST['mModeSubmit'] == "Submit") {

		echo $mModeSql = "UPDATE ".TABLE_SETTING." SET `value` = $_POST[mMode] WHERE `name` = 'm_mode';";
		mysql_query($mModeSql);
		header("location:".SITE_URL."siteadmin/mmode.php?msg=1");
		}

		$mModeSelectSql = "SELECT * FROM ".TABLE_SETTING." WHERE `name` = 'm_mode';";
		$mModeSelectRes = mysql_fetch_array(mysql_query($mModeSelectSql));

	?>

					<h2>Site Maintenance</h2>
					<br>
				<div align="left">
				<fieldset>
					<legend style="color: #000;"><b>Website</b></legend>
					<form action="" method="post">
						<label><input type="radio" name="mMode" value="1" <?php echo ($mModeSelectRes[value] == 1? "checked=checked": ""); ?>> On Maintenance</label>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label><input type="radio" name="mMode" value="0" <?php echo ($mModeSelectRes[value] == 0? "checked=checked": ""); ?>> Live</label>
						<br><br>
						<input type="submit" name="mModeSubmit" value="Submit">
					</form>
				</fieldset>
				</div>


     </div><!-- end of right content-->


  </div>   <!--end of center content -->

    <div class="clear"></div>
    </div> <!--end of main content-->

    	<?php require("include/footer.inc.php"); ?>

