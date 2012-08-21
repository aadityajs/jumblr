<?php
include("include/m_header.php");

$muser_id=intval($_SESSION['muser_id']);
$sql = "SELECT first_name,last_name,company_name FROM `".TABLE_USERS."` WHERE user_id='$user_id'";
$record = $db->query_first($sql);

$sql = "SELECT * FROM `".TABLE_STORES."` WHERE merchant_id='$muser_id'";
	$store = $db->query_first($sql);
	
	
$items = 5;
$page = 1;

if(isset($_GET['page']) and is_numeric($_GET['page']) and $page = $_GET['page'])
		$limit = " LIMIT ".(($page-1)*$items).",$items";
	else
		$limit = " LIMIT $items";



	
		$sqlStrAux ="select count(*) as total, SUM(amount) as totsum from ".TABLE_TRANSACTION." where merchant_id='$muser_id' and transaction_status='success'  ";
		$row_deals=$db->fetch_all_array("select * from ".TABLE_TRANSACTION." where merchant_id='$muser_id' and transaction_status='success' order by tran_id desc $limit");
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
				
	
	<h1>My Now Deal Earning</h1> 	 		 		
	<table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr class="closeddealrow_head">
   
    <td  width="200">Deal</td>
    <td>CouponCode</td>
    <td>Qty </td>
	 <td>Amount</td>
    <td>Transaction Date</td>
	<td>Transaction Id</td>
	<td>Redeem Status</td>
	
	
  </tr>
  <?php
  $total=0;
  if($aux['total']>0){
   foreach($row_deals as $data){
   $deal=get_deal_details($data['deal_id']);
   if($deal['deal_type']=='nowdeal'){
   ?>
  <tr class="closeddealrow_data">
	<td><?php if(!empty($deal['title'])){echo $deal['title'];}else{echo $deal['title2'];}?></td>
	<td><?php echo $data['coupon_code']?></td>
	<td><?php echo $data['qty']?></td>
	<td>$<?php echo $data['amount']?></td>
	<td><?php echo $data['transaction_date']?></td>
	<td><?php echo $data['transaction_id']?></td>
	<td><?php if($data['redeem_status']==0){echo "Not Redeemed";}else{echo "Redeemed";}?></td>
  </tr>
  <?php $total=$total+$data['amount'];?>
  <?php }}?>
  <tr><td colspan="7" align="right"> <div align="right" style="float:right;">Total Earning: $<?php echo $total;?></div></td></tr>
  <tr><td colspan="7" align="center"> <div align="center" style=" margin-left:150px;"><?php echo $p->show();?></div></td></tr>
  <?php }?>
</table>
	
		
	
	
   
    <?php 
	
		
	if(empty($store['store_status'])){
	
	?>
	<div class="formcenteralighed">
	<h3>You don't have any Groupon Store deals yet! <a href="<?php echo SITE_URL;?>create_store">Create Store Now</a></h3></div>
	
	
	<?php }?>
   
	
    	<?php require("include/merchant_footer.inc.php"); ?>   

