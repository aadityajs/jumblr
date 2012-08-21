<?php
include("include/m_header.php");

$muser_id=intval($_SESSION['muser_id']);
$sql = "SELECT first_name,last_name,company_name FROM `".TABLE_USERS."` WHERE user_id='$muser_id'";
$record = $db->query_first($sql);

$sql = "SELECT * FROM `".TABLE_STORES."` WHERE merchant_id='$muser_id'";
$store = $db->query_first($sql);

$items = 5;
$page = 1;

if(isset($_GET['page']) and is_numeric($_GET['page']) and $page = $_GET['page'])
		$limit = " LIMIT ".(($page-1)*$items).",$items";
	else
		$limit = " LIMIT $items";



	
		$sqlStrAux ="select count(*) as total from ".TABLE_DEALS." where deal_type='nowdeal' and status=0   and store_id='".$store['store_id']."'";
		$row_deals=$db->fetch_all_array("select * from ".TABLE_DEALS." where deal_type='nowdeal' and status=0  and store_id='".$store['store_id']."' $limit");
		$aux = mysql_fetch_assoc(mysql_query($sqlStrAux));	
		
		
		$p = new pagination;
		$p->Items($aux['total']);
		$p->limit($items);
		$p->target($target);
		$p->currentPage($page);
		$p->calculate();
		$p->changeClass("pagination");
		
		







				if($_SESSION['errmsg']){
				echo '<div class="error_box" style="font-size:12px;">'.$_SESSION['errmsg'].'</div>' ;
				$_SESSION['errmsg']="";
				}if($_SESSION['msg']){
				echo '<div class="valid_box" style="font-size:12px;">'.$_SESSION['msg'].'</div>' ;
				$_SESSION['msg']="";
				}
				
				?>
				
	
	<h1>Closed ! Now Deal</h1> 	 		 		
	<table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr class="closeddealrow_head">
    <td width="200">Title</td>
    <td>Start Date</td>
    <td>Closed On</td>
    <td>Units Sold </td>
	 <td>Units Redeemed</td>
    <td>Your Earnings (based on redemption)</td>
	
	
  </tr>
  <?php
  if($aux['total']>0){
   foreach($row_deals as $data){?>
  <tr class="closeddealrow_data">
	<td><?php if(!empty($data['title'])){echo $data['title'];}else{echo $data['title2'];}?></td>
	<td><?php echo date("Y-m-d H:i",strtotime($data['deal_start_time']))?></td>
	<td><?php echo date("Y-m-d H:i",strtotime($data['deal_end_time']))?></td>
	<td>-</td>
	<td>-</td>
	<td>-</td>
  </tr>
  
  <?php }?>
  
  <tr><td colspan="6" align="center"> <div align="center" style=" margin-left:150px;"><?php echo $p->show();?></div></td></tr>
  <?php }?>
</table>
	
		
	
	
   
    <?php 
	
	if(empty($store['store_status'])){
	
	?>
	<div class="formcenteralighed">
	<h3>You don't have any Groupon Store deals yet! <a href="<?php echo SITE_URL;?>create_store">Create Store Now</a></h3></div>
	
	
	<?php }?>
   
	
    	<?php require("include/merchant_footer.inc.php"); ?>   

