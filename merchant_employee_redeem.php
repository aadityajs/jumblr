<?php
include("include/m_emp_header.php");

$user_id=intval($_SESSION['memp_user_id']);
$sql = "SELECT employee_name,store_name FROM `".TABLE_MERCHANTS."` WHERE mid='$user_id'";
$record = $db->query_first($sql);


 
				if($_SESSION['errmsg']){
				echo '<div class="error_box" style="font-size:12px;">'.$_SESSION['errmsg'].'</div>' ;
				$_SESSION['errmsg']="";
				}if($_SESSION['msg']){
				echo '<div class="valid_box" style="font-size:12px;">'.$_SESSION['msg'].'</div>' ;
				$_SESSION['msg']="";
				}
				
				?>
				
		
		 
		<b> Welcome, <?php echo $record['employee_name'];?></b>
		
		 <h1><?php echo $record['store_name'];?></h1>
    
   
	
    	<?php require("include/employee_footer.inc.php"); ?>   

