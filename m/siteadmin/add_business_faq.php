<?php
include("include/header.php");

if($_REQUEST[mode]=="delete")
{
	$category_id=intval($_REQUEST['id']);
	mysql_query("delete from ".TABLE_BUSINESS_FAQS." where bfaq_id='$category_id'");
	header("location:show_business_faqs.php");
}


if(isset($_REQUEST['submit']))
{

	$category_id=intval($_REQUEST['id']);
	$data['bquestion']=$_POST['question'];
	$data['banswer']=$_POST['answer'];
	$data['status']=1;
	$data['date_added']=date("Y-m-d");

	if(($_REQUEST['mode']=="edit") || ($_REQUEST['mode']=="view"))
	{

		$db->query_update(TABLE_BUSINESS_FAQS, $data, "bfaq_id='$category_id'");

	}
	else
	{
		$db->query_insert(TABLE_BUSINESS_FAQS, $data);
	}

	header("location:show_business_faqs.php");

}

?>


<script language="javascript">

		function validation()
		{
			var question = document.getElementById('question').value;
			var answer = document.getElementById('answer').value;
			var str="";

			if(question=="")
			{
				document.getElementById('err1').innerHTML="Enter Question";
				str+="errmsg";
			}
			else
			{
				document.getElementById('err1').innerHTML="";

			}

			if(answer=="")
			{
				document.getElementById('err2').innerHTML="Enter Answer";
				str+="errmsg";
			}
			else
			{
				document.getElementById('err2').innerHTML="";
			}

			if(str!="")
			{
				return false;
			}
			else
			{
				return true;
			}

		}

		</script>


<?php
			$admin_id=intval($_SESSION['admin_id']);
			$sql = "SELECT admin_name FROM `".TABLE_ADMIN."` WHERE admin_id='$admin_id'";
			$record = $db->query_first($sql);

			if($_REQUEST['mode']=="edit")
			{
				echo $category_id = intval($_REQUEST['id']);
				$row_deals=mysql_fetch_array(mysql_query("select * from ".TABLE_BUSINESS_FAQS." where bfaq_id='$category_id'"));
			}

	?>


    <div class="main_content">

      <?php include("include/top_menu.inc.php");?>

    <div class="center_content">

   		<?php require("include/left_menu.php"); ?>

    <div class="right_content">




					<?php
						if($_REQUEST['mode']=="edit")
						{
					?>
							<h1>Edit Business FAQ </span></h1>
							<form method="post" action="?id=<?php echo $category_id;?>&mode=edit" enctype="multipart/form-data" onSubmit="return validation()">

					<?php
						}
						else
						{
					?>
							<h1>Add Business FAQ</span></h1>
							<form method="post" enctype="multipart/form-data" onSubmit="return validation()">

					<?php
						}
					?>

										<!-- Fieldset -->
										<fieldset>

											<p>
												<label for="dropdown">Question: </label>
												<input class="lf" name="question" id="question" type="text" value="<?php echo stripslashes($row_deals[bquestion])?>" size="80"/>
												<span class="validate_error" id="err1"></span>
											</p>

											<p>
														<label for="lf">Answer: </label>

														<?php

														$oFCKeditor = new FCKeditor('answer');
														$oFCKeditor->BasePath = '../fckeditor/';
														$oFCKeditor->Value = stripslashes($row_deals['banswer']) ;
														$oFCKeditor->Width = '100%' ;
														$oFCKeditor->Height = '400' ;

														$oFCKeditor->ToolbarSet = 'Default';
														$oFCKeditor->Create();
													?>
														<span class="validate_error" id="err2"></span>
													</p>

											<p align="center">
												<input class="button" type="submit" value="Submit" name="submit" />
												<!--<input class="button" type="reset" value="Reset" />-->
											</p>
										</fieldset>
										<!-- End of fieldset -->

									</form>



     </div><!-- end of right content-->


  </div>   <!--end of center content -->

    <div class="clear"></div>
    </div> <!--end of main content-->

    	<?php require("include/footer.inc.php"); ?>

