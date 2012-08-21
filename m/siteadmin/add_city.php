<?php
include("include/header.php");

$admin_id=intval($_SESSION['admin_id']);
$sql = "SELECT admin_name FROM `".TABLE_ADMIN."`  WHERE admin_id='$admin_id'";
$record = $db->query_first($sql);

if($_REQUEST[mode]=="edit")
{
	$city_id=intval($_REQUEST['id']);
	$row_deals=mysql_fetch_array(mysql_query("select * from ".TABLE_CITIES." where city_id='$city_id'"));
}

if($_REQUEST[mode]=="delete")
{
	$city_id=intval($_REQUEST['id']);
	mysql_query("delete from ".TABLE_CITIES." where city_id='$city_id'");
	header("location:show_cities.php?msg=3");	
}

if(isset($_REQUEST['submit']))
{	
	$city_id=intval($_REQUEST['id']);
	$date_added=date("Y-m-d");	
	$data['country_id']=$_POST['country_id'];
	$data['city_name']=$_POST['city_name'];
	$data['status']=1;
	$data['date_added']=$date_added;
	
	$data['description']=stripslashes($_POST['description']);
	
	if($_REQUEST['mode']=="edit")
	{	
		$db->query_update(TABLE_CITIES, $data, "city_id='$city_id'");
		header("location:show_cities.php?msg=2");	
	
	}
	else
	{
		$city_id=$db->query_insert(TABLE_CITIES, $data);
		$sql = mysql_num_rows(mysql_query("select * from ".TABLE_CITIES." where city_name='".$data['city_name']."'"));
		if($sql==0)
		header("location:show_cities.php?msg=1");
		else
		header("location:show_cities.php?msg=3");
	}	

}
if($_REQUEST['mode']=='edit' || $_REQUEST['mode']=='delete'){
$_SESSION["session_city"] =$city_id;
}else{
$_SESSION["session_city"] =uniqid();
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
					<h1>Edit City </span></h1>
					<form method="post" action="?id=<?php echo $city_id;?>&mode=edit" enctype="multipart/form-data" class="niceform2">
			
		<?php
				}
				else
				{
		?>
					<h1>Add City </h1>
					<form method="post" action="" enctype="multipart/form-data" class="niceform2">
					
			
		<?php
				}
		?>
         
                <fieldset>
				
                    <dl>
                        <dt><label for="email">Country Name:</label></dt>
                        <dd>
						
							<select name="country_id" class="dropdown" id="country_id" size="1">
								<option value="">-- Select --</option>
                                <?php												
														
									$sql_categories=mysql_query("select * from " .TABLE_COUNTRIES." order by country_name asc");
									while($row_categories=mysql_fetch_array($sql_categories))
									{												
								?>
								
										<option value="<?php echo $row_categories[country_id];?>" <?php if($row_categories[country_id]==$row_deals[country_id]) { echo "selected"; }?>><?php echo $row_categories[country_name];?></option>
								<?php
									}
								?>			
                            </select>			
						
						</dd>
                    </dl>
					
                    <dl>
                        <dt><label for="password">City Name:</label></dt>
                        <dd><input type="text" name="city_name" id="city_name" size="54" value="<?php echo $row_deals[city_name]?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" /></dd>
                    </dl>
					
					<dl>
                        <dt><label for="email">Description:</label></dt>
                        <dd>
						<?php									
							$oFCKeditor = new FCKeditor('description');
							$oFCKeditor->BasePath = '../fckeditor/';
							$oFCKeditor->Value = stripslashes($row_deals['description']) ;
							$oFCKeditor->Width = '100%' ;
							$oFCKeditor->Height = '500' ;
							//$oFCKeditor->ToolbarSet = 'Basic';
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
		 
		 <div>
		 <div class="clear"></div>
			<span style="font-weight:bold">Upload Files:</span>	
				
		
					<!-- <iframe src="uploader/example/uploader.php" width="600" frameborder="0" scrolling="no"></iframe>-->
					<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/themes/base/jquery-ui.css" id="theme">
					<link rel="stylesheet" href="js/uploader/jquery.fileupload-ui.css">
					
					<div id="fileupload">
						<form action="uploadcity.php" method="POST" enctype="multipart/form-data">
							<div class="fileupload-buttonbar">
								<label class="fileinput-button">
									<span>Add files...</span>
									<input type="file" name="files[]" multiple>
								</label>
								<button type="submit" class="start">Start upload</button>
								<button type="reset" class="cancel">Cancel upload</button>
								<button type="button" class="delete">Delete files</button>
							</div>
						</form>
						<div class="fileupload-content">
							<table class="files"></table>
							<div class="fileupload-progressbar"></div>
						</div>
					</div>
					<script id="template-upload" type="text/x-jquery-tmpl">
						<tr class="template-upload{{if error}} ui-state-error{{/if}}">
							<td class="preview"></td>
							<td class="name">${name}</td>
							<td class="size">${sizef}</td>
							{{if error}}
								<td class="error" colspan="2">Error:
									{{if error === 'maxFileSize'}}File is too big
									{{else error === 'minFileSize'}}File is too small
									{{else error === 'acceptFileTypes'}}Filetype not allowed
									{{else error === 'maxNumberOfFiles'}}Max number of files exceeded
									{{else}}${error}
									{{/if}}
								</td>
							{{else}}
								<td class="progress"><div></div></td>
								<td class="start"><button>Start</button></td>
							{{/if}}
							<td class="cancel"><button>Cancel</button></td>
						</tr>
					</script>
					<script id="template-download" type="text/x-jquery-tmpl">
						<tr class="template-download{{if error}} ui-state-error{{/if}}">
							{{if error}}
								<td></td>
								<td class="name">${name}</td>
								<td class="size">${sizef}</td>
								<td class="error" colspan="2">Error:
									{{if error === 1}}File exceeds upload_max_filesize (php.ini directive)
									{{else error === 2}}File exceeds MAX_FILE_SIZE (HTML form directive)
									{{else error === 3}}File was only partially uploaded
									{{else error === 4}}No File was uploaded
									{{else error === 5}}Missing a temporary folder
									{{else error === 6}}Failed to write file to disk
									{{else error === 7}}File upload stopped by extension
									{{else error === 'maxFileSize'}}File is too big
									{{else error === 'minFileSize'}}File is too small
									{{else error === 'acceptFileTypes'}}Filetype not allowed
									{{else error === 'maxNumberOfFiles'}}Max number of files exceeded
									{{else error === 'uploadedBytes'}}Uploaded bytes exceed file size
									{{else error === 'emptyResult'}}Empty file upload result
									{{else}}${error}
									{{/if}}
								</td>
							{{else}}
								<td class="preview">
									{{if thumbnail_url}}
										<a href="${url}" target="_blank"><img src="${thumbnail_url}"></a>
									{{/if}}
								</td>
								<td class="name">
									<a href="${url}"{{if thumbnail_url}} target="_blank"{{/if}}>${name}</a>
								</td>
								<td class="size">${sizef}</td>
								<td colspan="2"></td>
							{{/if}}
							<td class="delete">
								<button data-type="${delete_type}" data-url="${delete_url}">Delete</button>
							</td>
						</tr>
					</script>
					<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
					<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>
					<script src="//ajax.aspnetcdn.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js"></script>
					<script src="js/uploader/jquery.iframe-transport.js"></script>
					<script src="js/uploader/jquery.fileupload.js"></script>
					<script src="js/uploader/jquery.fileupload-ui.js"></script>
					<script src="js/uploader/application.js"></script>
					
					
					
					</div>
     </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->  
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    	<?php require("include/footer.inc.php"); ?>   

