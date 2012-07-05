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
?>

<body>

	<div style="margin-top: 10px;" id="maincontainer">
    
		    <?php include("merchant_menu_section.php"); ?>
           
		   
			<div class="main_box white_bg">
			<div class="clear"></div>


             <div class="main_box">
             
              <div id="TabbedPanels2" class="TabbedPanels2">
              <ul class="TabbedPanelsTabGroup2">
                <li class="TabbedPanelsTab2" tabindex="0">Daily Deals</li>
                <li class="TabbedPanelsTab2" tabindex="0">Now Deals</li>
              </ul>
              <div class="TabbedPanelsContentGroup2">
				<div class="TabbedPanelsContent2">
				<h1>My Daily Deal Earning</h1> 
					<table width="100%" border="0" cellspacing="2" cellpadding="2" class="transactions_box">
					  <tr>
					   
						<th width="200">Deal</th>
						<th>CouponCode</th>
						<th>Qty </th>
						<th>Amount</th>
						<th>Transaction Date</th>
						<th>Transaction Id</th>
						<th>Redeem Status</th>
						
						
					  </tr>
					  <?php
					  if($aux['total']>0){
					   foreach($row_deals as $data){
					   $deal=get_deal_details($data['deal_id']);
					   if($deal['deal_type']=='dailydeal'){
					   ?>
					  <tr class="gray_02">
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
				</div>
				<div class="TabbedPanelsContent2">
				<h1>My Now Deal Earning</h1> 	 		 		
				<table width="100%" border="0" cellspacing="2" cellpadding="2" class="transactions_box">
				<tr>
				
				<th width="200">Deal</th>
				<th>CouponCode</th>
				<th>Qty </th>
				<th>Amount</th>
				<th>Transaction Date</th>
				<th>Transaction Id</th>
				<th>Redeem Status</th>
				
				
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
				</div>
			   <div class="clear"></div> 
                  </div>
                  
                </div>
               <div class="clear"></div>
              </div>

		</div>
		</div>
<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
</script>
<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels2");
</script>
</body>
</html>
