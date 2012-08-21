<?php
include("include/header.php");


if($_REQUEST[mode]=="delete")
{
	$faq_id=intval($_REQUEST['id']);
	mysql_query("delete from ".TABLE_FAQS." where faq_id='$faq_id'");
	header("location:show_faqs.php");	
}


if(isset($_REQUEST['submit']))
{
	
	$faq_id=intval($_REQUEST['id']);
	
	$data['category_id']=$_POST['category_id'];
	$data['question']=$_POST['question'];
	$data['answer']=$_POST['answer'];
	$data['status']=1;
	$data['date_added']=date("Y-m-d");
	
	if(($_REQUEST['mode']=="edit") || ($_REQUEST['mode']=="view"))
	{
	
		$db->query_update(TABLE_FAQS, $data, "faq_id='$faq_id'");
	
	}
	else
	{
		$db->query_insert(TABLE_FAQS, $data);
	}
	
	header("location:show_faqs.php");
	
}

?>



<script language="javascript">
		
		function validation()
		{
			var question = document.getElementById('question').value;
			//var answer = document.getElementById('answer').value;
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
			
			/*if(answer=="")
			{
				document.getElementById('err2').innerHTML="Enter Answer";
				str+="errmsg";
			}
			else
			{
				document.getElementById('err2').innerHTML="";
			}*/

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
			
			if($_REQUEST[mode]=="edit")
			{
				$faq_id=intval($_REQUEST['id']);
				$row_deals=mysql_fetch_array(mysql_query("select * from ".TABLE_FAQS." where faq_id='$faq_id'"));
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
							<h1>Edit FAQ </span></h1>
							<form method="post" action="?id=<?php echo $faq_id;?>&mode=edit" enctype="multipart/form-data" onSubmit="return validation()">
					
					<?php
						}
						else
						{
					?>
							<h1>Add FAQ </span></h1>
							<form method="post" enctype="multipart/form-data" onSubmit="return validation()">
							
					<?php
						}
					?>
										
										<!-- Fieldset -->
										<fieldset>
									
									
											<p>
												<label for="dropdown">Tab: </label>
												<select name="category_id" id="category_id">
												<?php 
												$sql = $sql="select * from ".TABLE_FAQS_CATEGORY." Where status='1' ";
												$cat = $db->fetch_all_array($sql);
												foreach($cat as $category){
												if($row_deals['category_id']==$category['category_id']){
												?>
												<option value="<?php echo $category['category_id']?>" selected="selected"><?php echo $category['question']?></option>
												<?php }else{?>
												<option value="<?php echo $category['category_id']?>" ><?php echo $category['question']?></option>
												<?php }}?>
												</select>
												<span class="validate_error" id="err0"></span>
											</p>
											
											
											<p>
												<label for="dropdown">Question: </label>
												<input class="lf" name="question" id="question" type="text" value="<?php echo stripslashes($row_deals[question])?>" size="80"/>
												<span class="validate_error" id="err1"></span>
											</p>																				
											
											<p>
														<label for="lf">Answer: </label>
														
														<?php	
														
														$oFCKeditor = new FCKeditor('answer');
														$oFCKeditor->BasePath = '../fckeditor/';
														$oFCKeditor->Value = stripslashes($row_deals['answer']) ;
														$oFCKeditor->Width = '100%' ;
														$oFCKeditor->Height = '200' ;
														
														$oFCKeditor->ToolbarSet = 'Basic';
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

