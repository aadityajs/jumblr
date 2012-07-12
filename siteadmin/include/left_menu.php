<div class="left_content">
	<?php
	$adminsql="SELECT * FROM ".TABLE_ADMIN." where admin_id='".$_SESSION['admin_id']."'";
	$adminrole=mysql_fetch_array(mysql_query($adminsql));
	$rolearray=explode(",",$adminrole['privileges']);
	?>




	<div class="arrowlistmenu">

		<?php if(in_array("manage_deal",$rolearray)){?>
		<div class="menuheader expandable">Deal Management</div>
		<ul class="categoryitems">



			<!--<li><a href="#" class="subexpandable">Daily Deals</a>
			<ul class="subcategoryitems" style="margin-left: 15px">-->
			<li><a href="add_deal.php">Add Deal</a></li>
			<li><a href="show_deals.php">View Deal</a></li>

			<!--<li><a href="add_deal_item.php">Add Deal Item</a></li>-->
			<!-- <li><a href="show_bestdeals.php">National & More Deal</a></li>
			<li><a href="show_previous_deals.php">Previous Deal</a></li> -->


			</ul>
		<!--</li>

		--><!--<li><a href="#" class="subexpandable">Now Deals</a>
			<ul class="subcategoryitems" style="margin-left: 15px">
			<li><a href="add_nowdeal.php">Add Deal</a></li>
			<li><a href="show_nowdeals.php">View Deal</a></li>

			<li><a href="add_deal_item.php">Add Deal Item</a></li>
			</ul>
		</li>-->
		</ul>
		<?php }?>

		<?php if(in_array("manage_dealcategory",$rolearray)){?>
		<div class="menuheader expandable">Deal Category Management</div>
		<ul class="categoryitems">
			<li><a href="add_category.php">Add Deal Category</a></li>
			<li><a href="show_categories.php">View Deal Category</a></li>
		</ul>
		<?php }?>


		<?php if(in_array("manage_merchant",$rolearray)){?>
		<div class="menuheader expandable">Merchant User Management</div>
		<ul class="categoryitems">
			<li><a href="merchant_user_request.php">Merchant User Request's</a></li>
			<li><a href="add_merchant_user.php">Add Merchant User</a></li>
			<li><a href="show_merchant_users.php">View Merchant User</a></li>

		</ul>
		<?php }?>

		<?php if(in_array("manage_transactions",$rolearray)){?>
		<div class="menuheader expandable">Manage Transactions</div>
		<ul class="categoryitems">
			<li><a href="show_transactions.php">All Transactions</a></li>
			<!--<li><a href="show_transactions.php">Success Transactions</a></li>
			<li><a href="show_transactions.php">Failed Transactions</a></li>
			<li><a href="show_transactions.php">Hold Transactions</a></li>	-->

	</ul>
		<?php }?>

		<!-- <?php if(in_array("manage_withdraw_request",$rolearray)){?>
		<div class="menuheader expandable">Manage Refund Request</div>
		<ul class="categoryitems">
			<li><a href="show_refund_requests.php">All Request</a></li>
			<li><a href="#">Approved Request</a></li>
			<li><a href="#">Rejected Request</a></li>
			<li><a href="#">Success Request</a></li>
			<li><a href="#">Failed Request</a></li>
			<li><a href="#">New Fund Request</a></li>

		</ul>
		<?php } ?> -->

		<?php if(in_array("manage_user",$rolearray)){?>
		<div class="menuheader expandable">User Management</div>
		<ul class="categoryitems">
			<li><a href="add_user.php">Add User</a></li>
			<li><a href="show_users.php">View Users</a></li>
		</ul>
		<?php }?>

	<?php if(in_array("manage_admin",$rolearray)){?>
		<div class="menuheader expandable">Admin User Management</div>
		<ul class="categoryitems">
			<li><a href="add_admin.php">Add Admin User</a></li>
			<li><a href="show_admin.php">View Admin User</a></li>

		</ul>
		<?php }?>

		<?php if(in_array("manage_city",$rolearray)){?>
		<div class="menuheader expandable">City Management</div>
		<ul class="categoryitems">
			<li><a href="add_city.php">Add New City</a></li>
			<li><a href="show_cities.php">View City</a></li>
		</ul>
		<?php }?>


		 <?php if(in_array("manage_staticpage",$rolearray)){?>
		<div class="menuheader expandable">Content Management</div>
		<ul class="categoryitems">
			<!-- <li><a href="howitworks_page.php">How it Works</a></li> -->
			<li><a href="add_page.php">Add Page</a></li>
			<li><a href="show_pages.php">View Page</a></li>
			<!-- <li><a href="settings.php">Create Setting</a></li>
			<li><a href="show_settings.php">Show Setting</a></li> -->
		</ul>
		<?php }?>


		<!--<?php if(in_array("manage_faq",$rolearray)){?>
		<div class="menuheader expandable">FAQ Management</div>
		<ul class="categoryitems">
			<li><a href="add_faq.php">Add FAQ</a></li>
			<li><a href="show_faqs.php">Edit/Delete FAQ</a></li>

			<li><a href="add_faq_category.php">Add FAQ Tab</a></li>
			<li><a href="show_faqs_category.php">Edit/Delete FAQ Tab</a></li>

			<li><a href="add_business_faq.php">Add Business FAQ</a></li>
			<li><a href="show_business_faqs.php">View Business FAQ's</a></li>
		</ul>

		<div class="menuheader expandable">Customer Support</div>
		<ul class="categoryitems">
			<li><a href="show_users_enquery.php">Users Enquiry</a></li>

		</ul>
		<?php }?>-->




		<?php if(in_array("manage_store",$rolearray)){?>
		<!--<div class="menuheader expandable">Store Management</div>
		<ul class="categoryitems">
			<li><a href="show_stores.php">View Stores</a></li>
			<li><a href="add_store_category.php">Add Store Category</a></li>
			<li><a href="show_store_categories.php">View Store Categories</a></li>

		</ul>
		--><?php }?>






	<div style="clear:both"></div>
	</div>

</div>