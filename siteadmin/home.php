<?php
include("include/header.php");

$admin_id=intval($_SESSION['admin_id']);
$sql = "SELECT admin_name FROM `".TABLE_ADMIN."` WHERE admin_id='$admin_id'";
$record = $db->query_first($sql);

include("../fckeditor/fckeditor.php");

if(!isset($_REQUEST['mode'])){$_REQUEST['mode']='';}

if($_REQUEST['mode']=="edit")
{
	$deal_id=intval($_REQUEST['id']);
	$row_deals=mysql_fetch_array(mysql_query("select * from ".TABLE_DEALS." where deal_id='$deal_id'"));
}

if($_REQUEST['mode']=="delete")
{
	$deal_id=intval($_REQUEST['id']);
	mysql_query("delete from ".TABLE_DEALS." where deal_id='$deal_id'");
	header("location:show_deals.php");
}

?>


    <div class="main_content">

      <?php include("include/top_menu.inc.php");?>

    <div class="center_content">

   		<?php include("include/left_menu.php"); ?>

    <div class="right_content">


		<h1 style="border-bottom: 2px solid #5ACBEE;">Welcome, <?php echo $record['admin_name'];?></h1>
			<div style="clear: both;"></div>
		 <div style="border: 1px solid #5ACBEE; padding: 5px; margin: 10px; width: 380px; height: 170px; float: left">
		 	<h2 style="border-bottom: 1px dashed #5ACBEE; margin: 0;">Users</h2>
		 	<?php
		 		$user_count = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM ".TABLE_USERS));
		 		$active_user_count = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM ".TABLE_USERS." WHERE status = 1"));
		 		$inactive_user_count = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM ".TABLE_USERS." WHERE status <> 1"));
		 	?>
			<p><strong> Total Users:</strong> <?php echo $user_count[0]; ?> users</p>
			<p><strong> Active Users:</strong> <?php echo $active_user_count[0]; ?> users</p>
			<p><strong> Inactive Users:</strong> <?php echo $inactive_user_count[0]; ?> users</p>
		 </div>


		 <div style="border: 1px solid #5ACBEE; padding: 5px; margin: 10px; width: 380px; height: 170px; float: left">
		 	<h2 style="border-bottom: 1px dashed #5ACBEE; margin: 0;">Merchants</h2>
		 	<?php
		 		$mer_user_count = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM ".TABLE_USERS." WHERE reg_type = 'merchant' OR reg_type = 'temp_merchant'"));
		 		$mer_active_user_count = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM ".TABLE_USERS." WHERE reg_type = 'merchant'"));
		 		$mer_inactive_user_count = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM ".TABLE_USERS." WHERE reg_type = 'temp_merchant'"));
		 	?>
			<p><strong> Total Merchants:</strong>  <?php echo $mer_user_count[0]; ?> merchants</p>
			<p><strong> Active Merchants:</strong> <?php echo $mer_active_user_count[0]; ?> merchants</p>
			<p><strong> Pending Merchant Requests:</strong> <?php echo $mer_inactive_user_count[0]; ?> merchants</p>
		 </div>

		 <div style="clear: both;"></div>

		<div style="border: 1px solid #5ACBEE; padding: 5px; margin: 10px; width: 380px; height: 170px; float: left">
		 	<h2 style="border-bottom: 1px dashed #5ACBEE; margin: 0;">Transactions</h2>
		 	<?php
		 		$tran_count = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM ".TABLE_TRANSACTION." WHERE transaction_status = 'success'"));
		 		$tran_sum_amt = mysql_fetch_array(mysql_query("SELECT SUM(amount) FROM ".TABLE_TRANSACTION." WHERE transaction_status = 'success'"));
		 		$tran_sum_qty = mysql_fetch_array(mysql_query("SELECT SUM(qty) FROM ".TABLE_TRANSACTION." WHERE transaction_status = 'success'"));
		 		$tran_count = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM ".TABLE_TRANSACTION." WHERE transaction_status = 'success'"));
		 	?>
			<p><strong> Total Number of Transactions:</strong>  <?php echo $tran_count[0]; ?> transactions</p>
			<p><strong> Total Amount:</strong> &pound;<?php echo $tran_sum_amt[0]; ?> (GBP).</p>
			<p><strong> Total Qty.:</strong> <?php echo $tran_sum_qty[0]; ?> units.</p>
		 </div>

		 <div style="border: 1px solid #5ACBEE; padding: 5px; margin: 10px; width: 380px; height: 170px; float: left">
		 	<h2 style="border-bottom: 1px dashed #5ACBEE; margin: 0;">Deals & Cities</h2>
		 	<?php
		 		$deal_count = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM ".TABLE_DEALS." WHERE status <> 0"));
		 		$city_count = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM ".TABLE_CITIES." WHERE status = 1"));
		 		$tran_sum_qty = mysql_fetch_array(mysql_query("SELECT SUM(qty) FROM ".TABLE_TRANSACTION." WHERE transaction_status = 'success'"));
		 		$tran_count = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM ".TABLE_TRANSACTION." WHERE transaction_status = 'success'"));

		 	?>
			<p><strong> Total Deals:</strong> <?php echo $deal_count[0]; ?> deals.</p>
			<p><strong> Total City:</strong> <?php echo $city_count[0]; ?> cities.</p>
			<!-- <p><strong> Running Deals:</strong> </p>
			<p><strong> Closed Deals:</strong> </p> -->
		 </div>

		 <div style="clear: both;"></div>
		<!-- Refund request start -->

		<!-- <div style="border: 1px solid #5ACBEE; padding: 5px; margin: 10px; height: auto;">
			<h2 style="border-bottom: 1px dashed #5ACBEE; margin: 0;">Refund Requests</h2>

			<?php

				$today=date("Y-m-d");

				$sql="select * from ".TABLE_REFUND_REQUEST ." where 1=1 ".$where." order by date asc LIMIT 0, 5";
				$sqlStrAux = "SELECT count(*) as total FROM ".TABLE_REFUND_REQUEST." where 1=1 ".$where;

				$aux = mysql_fetch_assoc(mysql_query($sqlStrAux));
				$query = mysql_query($sql.$limit);


			?>


			<table width="100%" cellpadding="0" cellspacing="0" border="0" class="rounded_box">
			    <thead>
			    	<tr>
			            <th>Req. id</th>
			            <th>Coupon Code</th>
			            <th>Email</th>
			            <th>Status</th>
			            <th>Accept</th>
			            <th>Discard</th>
			        </tr>
			    </thead>

			    <tbody>

				<?php
				$req_count = 1;

				if($aux['total']>0){


						while($row_deals=mysql_fetch_array($query))
						{

							$sql_users = mysql_query("SELECT * FROM ".TABLE_REFUND_REQUEST." WHERE status = 1");
							$user_name = mysql_fetch_array($sql_users);
							$user_full_name = $user_name[0].' '.$user_name[1];

			?>

			    	<tr>
			            <td><?php echo $req_count; $req_count++; ?></td>
			            <td><?php echo $row_deals['code'];?></td>
			            <td><?php echo $row_deals['email'];?></td>
			            <td><?php if ($row_deals['status'] ==1) {echo '<span style="color:red;"><b>Requested</b></span>';} elseif($row_deals['status'] ==2) { echo '<span style="color:green;"><b>Accepted</b></span>';} else {echo '<span style="color:#c3c3c3;"><b>Discarded</b></span>';} ?></td>

						<td><a href='show_refund_requests.php?status=2&req_id=<?php echo $row_deals['id']?>'><img src="images/unblock.png" width="20" /></a></td>
						<td><a href='show_refund_requests.php?status=-1&req_id=<?php echo $row_deals['id']?>'><img src="images/block.png" width="20" /></a></td>

			        </tr>

			    	 <?php
						}
					?>

					<?php
					}else{
						echo "No Data Found";
					}
			?>

			    </tbody>
			</table>

			<?php
					if($aux['total']>0)
					{
			?>
						 <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="padding: 8px 0;">
						   <tr>
						   <td><?php //$ps->show();?></td>
						   </tr>
						 </table>
				<?php
					}
					?>


		</div> -->

		<!--  Refund request ends -->
		<div style="clear: both;"></div>



		 <div style="border: 1px solid #5ACBEE; padding: 5px; margin: 10px; height: auto;">
			<h2 style="border-bottom: 1px dashed #5ACBEE; margin: 0;">Enquries</h2>

								<form name="sorting3" id="sorting3" method="post">

						<table width="100%" cellpadding="0" cellspacing="0" border="0" class="rounded_box">
						    <thead>
						    	<tr>
						    		<th>Ticket No.</th>
						            <th>Name</th>
									<th>Phone No</th>
									<th>Email</th>
									<th width="180px">Details</th>
						           <!--  <th>Date</th> -->
						            <th>Delete</th>
						        </tr>
						    </thead>

						    <tbody>

						<?php

						$items = 3;
						$page = 1;

						if(isset($_GET['page']) and is_numeric($_GET['page']) and $page = $_GET['page'])
								$limit = " LIMIT ".(($page-1)*$items).",$items";
							else
								$limit = " LIMIT $items";

						$today=date("Y-m-d");

						if(isset($_REQUEST['preference']) || isset($_REQUEST['subscription'])){

						$sql="SELECT * FROM `".TABLE_USERS."`
						left join ".TABLE_USER_SUBSCRIPTION." on (".TABLE_USERS.".user_id=".TABLE_USER_SUBSCRIPTION.".user_id) left join ".TABLE_USER_PREFERENCE." on (".TABLE_USERS.".user_id=".TABLE_USER_PREFERENCE.".user_id) left join ".TABLE_CITIES." on(".TABLE_USER_SUBSCRIPTION.".city_id=".TABLE_CITIES.".city_id) left join ".TABLE_CATEGORIES." on(".TABLE_USER_PREFERENCE.".category_id=".TABLE_CATEGORIES.".cat_id) where ".TABLE_CITIES.".city_name like '%".$_REQUEST['subscription']."%' and ".TABLE_CATEGORIES.".cat_name like '%".$_REQUEST['preference']."%' and ".TABLE_USERS.".reg_type<>'merchant' group by first_name";

						//$sql = "SELECT * FROM getdeals_contact";


						$sqlStrAux = "SELECT count(*) as total FROM `".TABLE_USERS."`
						left join ".TABLE_USER_SUBSCRIPTION." on (".TABLE_USERS.".user_id=".TABLE_USER_SUBSCRIPTION.".user_id) left join ".TABLE_USER_PREFERENCE." on (".TABLE_USERS.".user_id=".TABLE_USER_PREFERENCE.".user_id) left join ".TABLE_CITIES." on(".TABLE_USER_SUBSCRIPTION.".city_id=".TABLE_CITIES.".city_id) left join ".TABLE_CATEGORIES." on(".TABLE_USER_PREFERENCE.".category_id=".TABLE_CATEGORIES.".cat_id)  where ".TABLE_CITIES.".city_name like '%".$_REQUEST['subscription']."%' and ".TABLE_CATEGORIES.".cat_name like '%".$_REQUEST['preference']."%' and ".TABLE_USERS.".reg_type<>'merchant' group by first_name";




						}else{
						$sql="select * from getdeals_contact ".$where." order by date desc";
						$sqlStrAux = "SELECT count(*) as total FROM getdeals_contact".$where;
						}

						$aux = mysql_fetch_assoc(mysql_query($sqlStrAux));
						$query1 = mysql_query($sql.$limit);

						if($aux['total']>0){

								$p = new pagination;

								$p->Items($aux['total']);
								$p->limit($items);
								$p->target($target);
								$p->currentPage($page);
								$p->calculate();

								$p->changeClass("pagination");


								while($row_deals=mysql_fetch_array($query1))
								{
						?>

						    	<tr>
						        	<!--<td><input type="checkbox" name="" /></td>-->
						            <td>#<?php echo $row_deals['ticket_no'];?></td>
									<td><?php echo $row_deals['name'];?></td>
									<td><?php echo $row_deals['ph_no'];?></td>
						            <td><?php echo $row_deals['email'];?></td>
						            <td><?php echo $row_deals['details'];?></td>
									<!-- <td><?php echo $row_deals['date'];?></td> -->
						            <td><a href="show_users_enquery.php?mode=delete&id=<?php echo $row_deals['id'];?>" class="ask"><img src="images/trash.png" alt="" title="" border="0" onClick='return confirm("Are you sure to delete this user?")' /></a></td>
						        </tr>

						    	 <?php

								 $users[]=$row_deals['user_id'];
									}

									$_SESSION['ids']=serialize($users);
								?>

								<?php
								}else{
									echo "No Data Found";
								}


						?>

						    </tbody>
						</table>


						<?php
								if($aux['total']>0)
								{
							?>
									 <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="padding: 8px 0;">
									   <tr>
									   <td><?php echo $p->show();?></td>
									   </tr>
									 </table>
							<?php
								}
							?>






		 </div>
<div style="clear: both;"></div>
     </div><!-- end of right content-->


  </div>   <!--end of center content -->

    <div class="clear"></div>
    </div> <!--end of main content-->

    	<?php require("include/footer.inc.php"); ?>

