<?php
include("include/header.php");

	?>

    <div class="main_content">

      <?php include("include/top_menu.inc.php");?>

    <div class="center_content">

   		<?php require("include/left_menu.php"); ?>

    <div class="right_content">


					<h1>All Business FAQs</h1>

					<!--
						Select Tab to show :
					<select name="category_id" id="category_id" onchange="location.href='show_faqs.php?category_id='+this.value">
												<option value="">All Tabs</option>
												<?php
												$sql = $sql="select * from ".TABLE_FAQS_CATEGORY." Where status='1' ";
												$cat = $db->fetch_all_array($sql);
												foreach($cat as $category){
												if($_REQUEST['category_id']==$category['category_id']){
												?>
												<option value="<?php echo $category['category_id']?>" selected="selected"><?php echo $category['question']?></option>
												<?php }else{?>
												<option value="<?php echo $category['category_id']?>" ><?php echo $category['question']?></option>
												<?php }}?>
												</select>

					 -->

					<table class="rounded_box" cellpadding="0" cellspacing="0" border="0" width="100%">
						<thead>
							<tr>
								<th>Question</th>
								<th>Answer</th>
								<th>Date Added</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>

	<?php

	$items = 10;
	$page = 1;

	if(isset($_GET['page']) and is_numeric($_GET['page']) and $page = $_GET['page'])
			$limit = " LIMIT ".(($page-1)*$items).",$items";
		else
			$limit = " LIMIT $items";

	$today=date("Y-m-d");

	if($_REQUEST['sort_by']=="mcategory")
	{
		$sql=" group by mcategory order by mcategory asc";
		$target="?sort_by=mcategory";
	}
	elseif($_REQUEST['sort_by']=="mtype")
	{
		$where=" group by mtype order by mtype asc";
		$target="?sort_by=mtype";
	}
	elseif($_REQUEST['sort_by']=="date_added")
	{
		$where=" order by date_added desc";
		$target="?sort_by=date_added";
	}
	elseif(!empty($_REQUEST['bfaq_id']))
	{
		$where=" Where bfaq_id='".$_REQUEST['bfaq_id']."'";
		$target="";
	}
	else
	{
		$where="";
		$target="";
	}

	$sql="select * from ".TABLE_BUSINESS_FAQS."$where";
	$sqlStrAux = "SELECT count(*) as total FROM ".TABLE_BUSINESS_FAQS."$where";

	$aux = mysql_fetch_assoc(mysql_query($sqlStrAux));
	$query = mysql_query($sql.$limit);

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
				if($row_deals[status]==1)
				{
					$status="block";
				}
				elseif($row_deals[status]==0)
				{
					$status="unblock";
				}

				if(strlen($row_deals['banswer'])>30)

				{
					$answer=strip_tags(stripslashes(substr($row_deals['banswer'],0,30)));
					$answer.="...";
				}
				else
				{
					$answer=strip_tags(stripslashes($row_deals['banswer']));
				}


?>
					<tr>
						<td><?php echo stripslashes($row_deals['bquestion']);?></td>
						<td><?php echo $answer;?></td>
						<td><?php echo strftime("%d %b %Y", strtotime($row_deals['date_added']));?></td>
						<td><a href="add_business_faq.php?mode=edit&id=<?php echo $row_deals[bfaq_id];?>"><img src="images/user_edit.png" alt="" title="Edit FAQ" border="0" /></a> |
						<a href="add_business_faq.php?mode=delete&id=<?php echo $row_deals[bfaq_id];?>"><img src="images/trash.png" border="0" width="10" height="10" title="Delete FAQ" onClick='return confirm("Are you sure to delete this FAQ?")'></a></td>
				  </tr>

		<?php
			}
		?>

		<tr><td colspan="4"><?php $p->show();?></td></tr>

		<?php
		}else
			echo "No Data Found";
?>

						</tbody>
				   </table>

					<hr />



     </div><!-- end of right content-->


  </div>   <!--end of center content -->

    <div class="clear"></div>
    </div> <!--end of main content-->

    	<?php require("include/footer.inc.php"); ?>

