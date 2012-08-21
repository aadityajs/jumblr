<?php
include("include/header.php");

						
	$items = 10;
	$page = 1;
	
	if(isset($_GET['page']) and is_numeric($_GET['page']) and $page = $_GET['page'])
			$limit = " LIMIT ".(($page-1)*$items).",$items";
		else
			$limit = " LIMIT $items";
			
	$today=date("Y-m-d");
			
	if(isset($_POST['search']))
	{
	$where=" and	admin_name like '%".$_POST['search_str']."%' or email like '%".$_POST['search_str']."%' ";
		
		
		}
	if(isset($_POST['datesearch']))
	{
		if(isset($_POST['date_from'])){
		$datefrom=$_POST['date_from'];
		}else{
		$datefrom=date('Y-m-d H:i');
		}
		if(isset($_POST['date_to'])){
		$dateto=$_POST['date_to'];
		}else{
		$dateto=date('Y-m-d H:i');
		}
		
		$where=" and	date_added between '".$datefrom."' and '".$dateto."' ";
		
		
		}
	
	
	$sql="select * from ".TABLE_ADMIN." where 1=1 ".$where;
	$sqlStrAux = "SELECT count(*) as total FROM ".TABLE_ADMIN." where 1=1 ".$where;

	$aux = mysql_fetch_assoc(mysql_query($sqlStrAux));
	$query = mysql_query($sql.$limit);
?>
    
    <div class="main_content">
    
      <?php include("include/top_menu.inc.php"); ?>                    
                    
    <div class="center_content">  
    
   		<?php require("include/left_menu.php"); ?>        
    
    <div class="right_content">  
		 
					<h2>All Admin Users </h2>
					
					<?php				
					if($_REQUEST['msg']=="1")
					{				
					?>		
						<div class="valid_box">Admin User Successfully Added</div>
							
					<?php
						}
					?>
					
					<?php				
					if($_REQUEST['msg']=="2")
					{				
					?>		
						<div class="valid_box">Admin User Details Successfully Updated</div>
							
					<?php
						}
					?>
  	<table class="normal" cellpadding="0" cellspacing="0" border="0" width="100%">
								
								
								
								<tr>
								
									<td>
									<form name="sorting" id="sorting" method="post">
									Search Admin Users:
										<input type="text" name="search_str" id="search_str" size="30" value="<?php echo $_REQUEST['search_str']?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" />
																							
										<input class="button" type="submit" value="Search" name="search" />
									</form></td>
									
								</tr>
								
								
								
								<tr><td>&nbsp;</td></tr>
								
								
								
								<!--<tr>
								
									<td>
									<form name="sorting2" id="sorting2" method="post">
									Registration Date Between :
										From: <input type="text" name="date_from" id="my_date_field2" size="15" value="<?php echo $_REQUEST['date_from']?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" />
										<span id="cal1"><img src="zpcal/themes/icons/calendar1.gif" style="cursor:pointer"/></span>
								 <script type="text/javascript">
								  var cal = new Zapatec.Calendar.setup({
								  
								  inputField:"my_date_field2",
								  ifFormat:"%Y-%m-%d %H:%M",
								  button:"cal1",
								  showsTime:false
								
								  });
								  
								 </script>
										</dd>
												
						
										To: <input type="text" name="date_to" id="my_date_field3" size="15" value="<?php echo $_REQUEST['date_to']?>" style="border: 1px solid #CCCCCC; height: 25px; background:#ececec;" />
										<span id="cal2"><img src="zpcal/themes/icons/calendar1.gif" style="cursor:pointer"/></span>
								 <script type="text/javascript">
								  var cal = new Zapatec.Calendar.setup({
								  
								  inputField:"my_date_field3",
								  ifFormat:"%Y-%m-%d %H:%M",
								  button:"cal2",
								  showsTime:false
								
								  });
								  
								 </script>
										</dd>
																			
										<input class="button" type="submit" value="Search" name="datesearch" />
										</form>
									</td>
									
								</tr>
								
								
								--></table>                  
<table width="100%" cellpadding="0" cellspacing="0" border="0" class="rounded_box"> 
    <thead>
    	<tr>
            <th>Admin Name</th>
            <th>Date Added</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
        
    <tbody>
	
	<?php


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
							
?>
	
    	<tr>
        	<!--<td><input type="checkbox" name="" /></td>-->			
            <td><?php echo stripslashes($row_deals['admin_name']);?></td>
            <td><?php echo strftime("%d %b %Y", strtotime($row_deals['date_added'])); ?></td>
            <td><a href="add_admin.php?mode=edit&id=<?php echo $row_deals[admin_id];?>"><img src="images/user_edit.png" alt="" title="" border="0" /></a></td>
            <td>
			<?php if($row_deals[admin_name]!='admin'){?>
			<a href="add_admin.php?mode=delete&id=<?php echo $row_deals[admin_id];?>" class="ask"><img src="images/trash.png" alt="" title="" border="0" onClick='return confirm("Are you sure to delete this admin user?")' /></a>
			<?php }?>
			</td>
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
			   <td><?php $p->show();?></td>
			   </tr>
			 </table>
	<?php
		}
	?>	 

		 
     </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->  
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    	<?php require("include/footer.inc.php"); ?>   

