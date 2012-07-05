<?php
include("include/header.php");

$admin_id=intval($_SESSION['admin_id']);
$sql = "SELECT admin_name FROM `".TABLE_ADMIN."` WHERE admin_id='$admin_id'";
$record = $db->query_first($sql);


if (isset($_REQUEST['status']) && !empty($_REQUEST['status'])) {
	$where .=" and status ='".$_REQUEST['status']."'	";
}

	//$where .='and deal_type="dailydeal" ';
	$items = 10;
	$page = 1;

	if(isset($_GET['page']) and is_numeric($_GET['page']) and $page = $_GET['page'])
			$limit = " LIMIT ".(($page-1)*$items).",$items";
		else
			$limit = " LIMIT $items";

	$today=date("Y-m-d");

	$sql="select * from ".TABLE_REFUND_REQUEST ." where 1=1 ".$where." order by date asc";
	$sqlStrAux = "SELECT count(*) as total FROM ".TABLE_REFUND_REQUEST." where 1=1 ".$where;

	$aux = mysql_fetch_assoc(mysql_query($sqlStrAux));
	$query = mysql_query($sql.$limit);



if(isset($_REQUEST['status']) && isset($_REQUEST['req_id']) &&  $_REQUEST['status']==2){

	$sql="UPDATE ".TABLE_REFUND_REQUEST." set status='".$_REQUEST['status']."' where id='".$_REQUEST['req_id']."'";
	mysql_query($sql);
	$_SESSION['msg']="User request successfully accepted.";
	header("location:show_refund_requests.php");
	exit;


}elseif(isset($_REQUEST['status']) && isset($_REQUEST['req_id']) &&  $_REQUEST['status']==-1){

		$sql="UPDATE ".TABLE_REFUND_REQUEST." set status='".$_REQUEST['status']."' where id='".$_REQUEST['req_id']."'";
		//echo $sql="DELETE FROM".TABLE_REFUND_REQUEST." where id='".$_REQUEST['req_id']."'";
		mysql_query($sql);
		$_SESSION['msg']="User request successfully discarded.";
		header("location:show_refund_requests.php");
		exit;

}
?>



    <div class="main_content">

      <?php include("include/top_menu.inc.php");?>

    <div class="center_content">

   		<?php require("include/left_menu.php"); ?>

    <div class="right_content">

					<h2>All Refund Requests</h2>

<?php
				if($_SESSION['errmsg']){
				echo '<div class="error_box" style="font-size:12px;">'.$_SESSION['errmsg'].'</div>' ;
				$_SESSION['errmsg']="";
				}if($_SESSION['msg']){
				echo '<div class="valid_box" style="font-size:12px;">'.$_SESSION['msg'].'</div>' ;
				$_SESSION['msg']="";
				}

				?>


<?php if (empty($_GET['id'])) { ?>
 <form method="post">
<table class="normal" cellpadding="0" cellspacing="0" border="0" width="100%">
		<tr>
		<td>Filter Transactions:
    	<select name="status" id="status">
			<option value="">All Transactions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
			<option value="2">Success Transactions</option>
			<option value="1">Pending Transactions</option>
			<option value="-1">Discarded Transactions</option>

		</select>
		<input type="submit" name="search" value="Search" />
   		</td>
		</tr>
		<tr><td>&nbsp;</td></tr>

</table>

<!--
  <table width="90%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td>Category:<select name="category">
	<option value="">---Select---</option>
	<?php
	$dealcat=mysql_query("SELECT * FROM ".TABLE_CATEGORIES);
	while($catrow=mysql_fetch_array($dealcat)){
		?>
	<option value="<?php echo $catrow['cat_id']?>" <?php if($catrow['cat_id']==$_REQUEST['category']){ echo "selected" ;}?>><?php echo $catrow['cat_name']?></option>
		<?php }?>
	</select></td>
    <td>City:<select name="city">
	<option value="">---Select---</option>
	<?php
	$dealcity=mysql_query("SELECT * FROM ".TABLE_CITIES);
	while($cityrow=mysql_fetch_array($dealcity)){
		?>
	<option value="<?php echo $cityrow['city_name']?>" <?php if($cityrow['city_name']==$_REQUEST['city']){ echo "selected" ;}?>><?php echo $cityrow['city_name']?></option>
		<?php }?>
	</select></td>
    <td><input type="submit" name="search" value="Search" /></td>
  </tr>
</table>
 -->
   </form>



<table width="100%" cellpadding="0" cellspacing="0" border="0" class="rounded_box">
    <thead>
    	<tr>
        	<!--<th></th>-->
            <th>Req. id</th>
            <th>Coupon Code</th>
            <th>Email</th>
            <th>Status</th>
            <th>Accept</th>
            <th>Discard</th>
            <!--
            <th>Edit</th>
            <th>Delete</th>-->
        </tr>
    </thead>

    <tbody>

	<?php
	$req_count = 1;

	if($aux['total']>0){
			$p = new pagination;
			$p->Items($aux['total']);
			$p->limit($items);
			$p->target($target);
			$p->currentPage($page);
			$p->calculate();
			$p->changeClass("pagination");

			while($row_deals=mysql_fetch_array($query))
			{

				$sql_users = mysql_query("SELECT * FROM ".TABLE_REFUND_REQUEST." WHERE status = 1");
				$user_name = mysql_fetch_array($sql_users);
				$user_full_name = $user_name[0].' '.$user_name[1];

?>

    	<tr>
        	<!--<td><input type="checkbox" name="" /></td>-->
            <td><?php echo $req_count; $req_count++; ?></td>
            <td><?php echo $row_deals['code'];?></td>
            <td><?php echo $row_deals['email'];?></td>
            <td><?php if ($row_deals['status'] ==1) {echo '<span style="color:red;"><b>Requested</b></span>';} elseif($row_deals['status'] ==2) { echo '<span style="color:green;"><b>Accepted</b></span>';} else {echo '<span style="color:#c3c3c3;"><b>Discarded</b></span>';} ?></td>

			<td><a href='show_refund_requests.php?status=2&req_id=<?php echo $row_deals['id']?>'><img src="images/unblock.png" width="20" /></a></td>
			<td><a href='show_refund_requests.php?status=-1&req_id=<?php echo $row_deals['id']?>'><img src="images/block.png" width="20" /></a></td>

           <!-- <td><a href="add_deal.php?mode=edit&id=<?php echo $row_deals[deal_id];?>"><img src="images/user_edit.png" alt="" title="" border="0" /></a></td>
            <td><a href="add_deal.php?mode=delete&id=<?php echo $row_deals[deal_id];?>" class="ask"><img src="images/trash.png" alt="" title="" border="0" onClick='return confirm("Are you sure to delete this deal?")' /></a></td>
			-->
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
			<!-- <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="padding: 8px 0;">
			  <tr><td colspan="6" align="center"><input type="button" onclick="javascript:location.href='send_email.php'" value="Send Email"/></td></tr>
			 </table> -->
			 <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="padding: 8px 0;">
			   <tr>
			   <td><?php $p->show();?></td>
			   </tr>
			 </table>
	<?php
		}
		?>

<?php } else {

	$deal_id = $_GET['id'];
	$sql_trn_deal = "SELECT * FROM ".TABLE_DEALS." WHERE deal_id = $deal_id";
	$trn_deal_details = mysql_fetch_array(mysql_query($sql_trn_deal));

	$sql_trn_deal_image = "SELECT * FROM ".TABLE_DEAL_IMAGES." WHERE deal_id = ".$deal_id;
	$trn_deal_image = mysql_fetch_array(mysql_query($sql_trn_deal_image));
	?>

<style type="text/css">
.previous_deal1 {
    background: none repeat scroll 0 0 #FFFFFF;
    border: 1px solid #E7E7E6;
    float: none;
    height: 230px;
    margin: 10px 8px 0 70px;
    overflow: hidden;
    width: 684px;
}
.clear {
    clear: both;
    line-height: 0;
}
.previous_left1 {
    background: none repeat scroll 0 0 #FFFFFF;
    border: 0 none;
    float: left;
    height: auto;
    margin: 4px 0 0 9px;
    width: 280px;
}
.previous_right1 {
    background: none repeat scroll 0 0 #FFFFFF;
    border: 0 none;
    float: left;
    height: auto;
    margin: 4px 0 0 9px;
    width: 375px;
}
.previous_rightbox {
    background: url("../images/rightbg.gif") no-repeat scroll left top transparent;
    border: 0 none;
    float: right;
    height: 71px;
    margin: 0 0 0 8px;
    width: 375px;
}
.left_green2 {
    background: url("../images/green_bg2.gif") repeat-x scroll left top #C4F1D3;
    border: 1px solid #CCCCCC;
    float: left;
    height: 50px;
    margin: 9px 0 0 9px;
    text-align: center;
    width: 66px;
}
div#sold_deal {
    background: url("../images/sold_deal1.png") no-repeat scroll left top transparent;
    float: left;
    height: 53px;
    margin: 0 0 0 189px;
    position: absolute;
    width: 100px;
    z-index: 1000;
}
.left_green2 span {
    color: #606060;
    font: bold 18px/28px Arial,Helvetica,sans-serif;
    margin: 0;
    padding: 0;
    text-align: center;
    vertical-align: middle;
}
.left_green2 p {
    color: #26221E;
    font: bold 12px/22px Arial,Helvetica,sans-serif;
    margin: 0;
    padding: 0;
    text-align: center;
    vertical-align: middle;
}
.previous_deal1 p {
    color: #414141;
    font: 14px/16px Arial,Helvetica,sans-serif;
    margin: 0;
    padding: 5px 7px;
}
div#sold_deal p {
    color: #FFFFFF;
    font: bold 16px/18px Tahoma,Arial,Helvetica,sans-serif;
    margin: 0;
    padding: 10px 0 0 20px;
    text-align: center;
    vertical-align: middle;
}
</style>


<div class="previous_deal1">
<div class="clear"><img src="../images/spacer.gif" alt="" width="1" height="8" /></div>
<div class="previous_left1"><img src="<?php echo UPLOAD_PATH.$trn_deal_image['file']; ?>" alt="" width="280" height="187"/></div>
<div class="previous_right1">
<div class="previous_rightbox">
<div class="clear"></div>
<div class="left_green2">
<p style="font: bold 12px/12px Arial,Helvetica,sans-serif;">Value</p>
<span style="text-align:center;"><?php echo '&pound;'.$trn_deal_details['full_price']; ?></span>
</div>
<div class="left_green2">
<div id="sold_deal"><p>Price<br/>&pound;<?php echo $trn_deal_details['discounted_price']; ?></p></div>
<p style="font: bold 12px/12px Arial,Helvetica,sans-serif;">Discount</p>
<span style="text-align:center;"><?php echo intval($trn_deal_details['discounted_price']*100/$trn_deal_details['full_price']); ?>%</span>
</div>
<div class="left_green2">
<p style="font: bold 12px/12px Arial,Helvetica,sans-serif;">You Save</p>
<span style="text-align:center;"><?php echo '&pound;'. ($trn_deal_details['full_price'] - $trn_deal_details['discounted_price']); ?></span>
</div>
</div>
<div class="clear"></div>
<div><p><strong><a href="<?php echo SITE_URL; ?>?action=sold&id=<?php echo $trn_deal_details['deal_id']; ?>" target="_blank"><?php echo truncate_string($trn_deal_details['title'], 100); ?></a></strong></p></div>
</div>
</div>

<?php } 	// endif ?>

     </div><!-- end of right content-->


  </div>   <!--end of center content -->

    <div class="clear"></div>
    </div> <!--end of main content-->

    	<?php require("include/footer.inc.php"); ?>
