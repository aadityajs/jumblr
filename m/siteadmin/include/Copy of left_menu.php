<div class="left_content">

	
	<div class="sidebarmenu">
	<?php 
	$adminsql="SELECT * FROM ".TABLE_ADMIN." where admin_id='".$_SESSION['admin_id']."'";
	$adminrole=mysql_fetch_array(mysql_query($adminsql));
	$rolearray=explode(",",$adminrole['privileges']);
	?>
	<?php if(in_array("manage_user",$rolearray)){?>
	<a class="menuitem_red submenuheader" href="">User Management</a>
		<div class="submenu">
			<ul>
			<li><a href="add_user.php">Add User</a></li>
			<li><a href="show_users.php">View Users</a></li>
			<!--<li><a href="add_merchant_user.php">Add Merchant User</a></li>
			<li><a href="show_merchant_users.php">View Merchant Users</a></li>-->

			
			</ul>
		</div>
	<?php }?>
	<?php if(in_array("manage_admin",$rolearray)){?>		
		<a class="menuitem_red submenuheader" href="">Admin User Management</a>
		<div class="submenu">
			<ul>
			<li><a href="add_admin.php">Add Admin User</a></li>
			<li><a href="show_admin.php">View Admin User</a></li>
			
			</ul>
		</div>	
		<?php }?>
	
	<?php if(in_array("manage_deal",$rolearray)){?>
		<a class="menuitem_red submenuheader" href="">Deal Management</a>
		<div class="submenu">
			<ul>
			<li><a href="add_deal.php">Add Deal</a></li>
			<li><a href="show_deals.php">View Deal</a></li>
			
			<li><a href="add_deal_item.php">Add Deal Item</a></li>
			<li><a href="show_bestdeals.php">Make Featured Deal</a></li>
			</ul>
		</div>
		<?php }?>
		<?php if(in_array("manage_dealcategory",$rolearray)){?>
		<a class="menuitem_red submenuheader" href="">Deal Category Management</a>
		<div class="submenu">
			<ul>
			<li><a href="add_category.php">Add Deal Category</a></li>
			<li><a href="show_categories.php">View Deal Category</a></li>
			</ul>
		</div>
	<?php }?>
		
		<?php if(in_array("manage_merchant",$rolearray)){?>
		<a class="menuitem_red submenuheader" href="">Merchant User Management</a>
		<div class="submenu">
			<ul>
			<li><a href="add_merchant_user.php">Add Merchant User</a></li>
			<li><a href="show_merchant_users.php">View Merchant User</a></li>
			</ul>
		</div>
	<?php }?>
	
	<?php if(in_array("manage_store",$rolearray)){?>	
	<a class="menuitem_red submenuheader" href="">Store Management</a>
		<div class="submenu">
			<ul>
			<!--<li><a href="add_store.php">Add Store</a></li>-->
			<li><a href="show_stores.php">View Stores</a></li>
			<li><a href="add_store_category.php">Add Store Category</a></li>
			<li><a href="show_store_categories.php">View Store Categories</a></li>
			
			
			</ul>
		</div>
	<?php }?>
	
	<?php if(in_array("manage_city",$rolearray)){?>	
		<a class="menuitem_red submenuheader" href="">City Management</a>
		<div class="submenu">
			<ul>
			<li><a href="add_city.php">Add New City</a></li>
			<li><a href="show_cities.php">View City</a></li>
			</ul>
		</div>
	<?php }?>
	<?php if(in_array("manage_staticpage",$rolearray)){?>	
		<a class="menuitem_red submenuheader" href="">Content Management</a>
		<div class="submenu">
			<ul>
			<li><a href="add_page.php">Add Page</a></li>
			<li><a href="show_pages.php">View Page</a></li>
			<li><a href="settings.php">Setting</a></li>
			<li><a href="show_settings.php">Settings Setting</a></li>
			</ul>
		</div>
	<?php }?>
	<?php if(in_array("manage_faq",$rolearray)){?>
	<a class="menuitem_red submenuheader" href="">Manage FAQ </a>
		<div class="submenu">
			<ul>
			<li><a href="add_faq.php">Add FAQ</a></li>
			<li><a href="show_faqs.php">Edit/Delete FAQ</a></li>
			
			<li><a href="add_faq_category.php">Add FAQ Category</a></li>
			<li><a href="show_faqs_category.php">Edit/Delete FAQ Category</a></li>
			</ul>
		</div>
	<?php }?>	
		
			
	</div>
	
	
	
	
	
	
	
	<div class="arrowlistmenu">

		
		
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
		
		
		
		
		<?php if(in_array("manage_deal",$rolearray)){?>	
		<div class="menuheader expandable">Deal Management</div>
		<ul class="categoryitems">
			
			
			
			<li><a href="#" class="subexpandable">Daily Deals</a>
			<ul class="subcategoryitems" style="margin-left: 15px">
			<li><a href="add_deal.php">Add Deal</a></li>
			<li><a href="show_deals.php">View Deal</a></li>
			
			<li><a href="add_deal_item.php">Add Deal Item</a></li>
			<li><a href="show_bestdeals.php">Make Featured Deal</a></li>
			

			</ul>
		</li>
		
		<li><a href="#" class="subexpandable">Now Deals</a>
			<ul class="subcategoryitems" style="margin-left: 15px">
			<li><a href="add_deal.php">Add Deal</a></li>
			<li><a href="show_deals.php">View Deal</a></li>
			
			<li><a href="add_deal_item.php">Add Deal Item</a></li>
			</ul>
		</li>
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
			<li><a href="add_merchant_user.php">Add Merchant User</a></li>
			<li><a href="show_merchant_users.php">View Merchant User</a></li>
			
		</ul>
		<?php }?>	
		
	
		<?php if(in_array("manage_store",$rolearray)){?>
		<div class="menuheader expandable">Store Management</div>
		<ul class="categoryitems">
			<li><a href="show_stores.php">View Stores</a></li>
			<li><a href="add_store_category.php">Add Store Category</a></li>
			<li><a href="show_store_categories.php">View Store Categories</a></li>
			
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
			<li><a href="add_page.php">Add Page</a></li>
			<li><a href="show_pages.php">View Page</a></li>
			<li><a href="settings.php">Setting</a></li>
			<li><a href="show_settings.php">Settings Setting</a></li>
		</ul>
		<?php }?>	
		
		
		<?php if(in_array("manage_faq",$rolearray)){?>
		<div class="menuheader expandable">Manage FAQ</div>
		<ul class="categoryitems">
			<li><a href="add_faq.php">Add FAQ</a></li>
			<li><a href="show_faqs.php">Edit/Delete FAQ</a></li>
			
			<li><a href="add_faq_category.php">Add FAQ Category</a></li>
			<li><a href="show_faqs_category.php">Edit/Delete FAQ Category</a></li>
		</ul>
		<?php }?>	
		
		
	
		
	<div style="clear:both"></div>
	</div>
	
</div>