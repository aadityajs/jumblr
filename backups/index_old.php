<?php include("include/header.php");?>
<?php
error_reporting(0);
?>
	<div style="margin-top: 10px;" id="maincontainer">
		<!--start body-->
		<div id="body">		
			<!--start body left-->
			<div class="body_left" style="width:226px;">
				<div id="categoryBox" style="width:225px; background:none;">                    
					<div class="left_link">
						<ul>
					<?php
					if(!isset($_GET["cat_id"]))
					{
						?>	
						<li class="all"><a href="<?= SITE_URL ?>" class="here">All</a></li>
						<?php
					}
					else
					{
						?>
						<li class="all"><a href="<?= SITE_URL ?>">All</a></li>
						<?php
					}

					$count_category = 1;
					$sql_category = "select * from ".TABLE_CATEGORIES." where parent_id=0";
					
					$result_category = mysql_query($sql_category);
					while($row_category = mysql_fetch_array($result_category))
					{
					
						if($count_category == 1)
						{
							if($_GET["cat_id"] == $row_category["cat_id"])
							{
								?>	
								<li class="dining"><a href="<?= SITE_URL ?>?cat_id=<?php echo $row_category["cat_id"];?>" class="here"><?php echo $row_category["cat_name"];?></a></li>
								<?php
							}
							else
							{
								?>
								<li class="dining"><a href="<?= SITE_URL ?>?cat_id=<?php echo $row_category["cat_id"];?>"><?php echo $row_category["cat_name"];?></a></li>
								<?php
							}
						
						
						}
						if($count_category == 2)
						{
							if($_GET["cat_id"] == $row_category["cat_id"])
							{
								?>	
								<li class="fine"><a href="<?= SITE_URL ?>?cat_id=<?php echo $row_category["cat_id"];?>" class="here"><?php echo $row_category["cat_name"];?></a></li>
								<?php
							}
							else
							{
								?>	
								<li class="fine"><a href="<?= SITE_URL ?>?cat_id=<?php echo $row_category["cat_id"];?>"><?php echo $row_category["cat_name"];?></a></li>
								<?php
							}
						}
						if($count_category == 3)
						{
						
							if($_GET["cat_id"] == $row_category["cat_id"])
							{
								?>	
								<li class="fitness"><a href="<?= SITE_URL ?>?cat_id=<?php echo $row_category["cat_id"];?>" class="here"><?php echo $row_category["cat_name"];?></a></li>
								<?php
							}
							else
							{
								?>	
								<li class="fitness"><a href="<?= SITE_URL ?>?cat_id=<?php echo $row_category["cat_id"];?>"><?php echo $row_category["cat_name"];?></a></li>
								<?php
							}
						
						}
						if($count_category == 4)
						{
						
							if($_GET["cat_id"] == $row_category["cat_id"])
							{
								?>	
								<li class="beauty"><a href="<?= SITE_URL ?>?cat_id=<?php echo $row_category["cat_id"];?>" class="here"><?php echo $row_category["cat_name"];?></a></li>
								<?php
							}
							else
							{
								?>	
								<li class="beauty"><a href="<?= SITE_URL ?>?cat_id=<?php echo $row_category["cat_id"];?>"><?php echo $row_category["cat_name"];?></a></li>
								<?php
							}
						
						}
						if($count_category == 5)
						{
						
							if($_GET["cat_id"] == $row_category["cat_id"])
							{
								?>	
								<li class="gateways"><a href="<?= SITE_URL ?>?cat_id=<?php echo $row_category["cat_id"];?>" class="here"><?php echo $row_category["cat_name"];?></a></li>
								<?php
							}
							else
							{
								?>	
								<li class="gateways"><a href="<?= SITE_URL ?>?cat_id=<?php echo $row_category["cat_id"];?>"><?php echo $row_category["cat_name"];?></a></li>
								<?php
							}
						
						}

						$count_category++;
					}
					?>	
							
							
						</ul>
                        
                      <div class="clear"></div>  
				    </div>


              </div>				
			 <?php include("include/sidebar.php");?>
		  </div>
			<!--end body left-->
			
			<!--start body right-->
			<div class="body_right">
			<?php
			
				if(isset($_GET["cat_id"]))
				{
					$sql_deal = "SELECT * FROM ".TABLE_DEALS." WHERE deal_cat=".$_GET["cat_id"]; 
				}
				else
				{
					$sql_deal = "SELECT * FROM ".TABLE_DEALS; 
				}
				
				
				$result_deal = mysql_query($sql_deal);
				$count_deal = mysql_num_rows($result_deal);
				
				if($count_deal >0)
				{
					$count_loop = 0;
					while($row_deal = mysql_fetch_array($result_deal))
					{
					$deal_id = $row_deal["deal_id"];
					$store_id = $row_deal["store_id"];
					
					$sql_store = "SELECT * FROM ".TABLE_STORES." WHERE store_id=".$store_id;
					$result_store = mysql_query($sql_store);
					$row_store = mysql_fetch_array($result_store);
					$store_name = $row_store["store_name"];
					
					$sql_image = "SELECT file FROM ".TABLE_DEAL_IMAGES." WHERE deal_id=".$deal_id;
					$result_image = mysql_query($sql_image);
					$row_image = mysql_fetch_array($result_image);
					$img_file = $row_image["file"];
					
					
					$title = $row_deal["title"];
					$arr_title = explode("<br>",$title);
					$head_ttl = $arr_title[1];
					
					/*
					$head_a = explode("%",$head_ttl);
					$head_b = $head_a[0];
					$head_c = explode(".",$head_b);
					if($head_c[1]=='00')
					$head_d = $head_c[0];
					else
					$head_d = $head_b;
					
					echo $head_d;
					*/
					
				?>
				  <div id="mainDealBox">
					<div class="blackheader_bg">
						  <div class="headerLeft">
								<h1 style="font-size:24px;"><?php echo $head_ttl;?></h1>
						  </div>
						  <div class="clear"></div>
					   <div class="dealContent">
					   <p class="priceTag"><?php echo strip_tags($row_deal["title"]); ?></p>
<!--							<ul>
								<li style="width:96px;">
								<p class="blue_txt">Price:</p>
								<p class="priceTag">$<?php //echo $row_deal["full_price"]; ?></p>
								</li>
								<li style="width: 110px;">
								<p><span class="blue_txt">Discount:</span><span class="value_txt"><?php //echo $row_deal["custpercent"]; ?>%</span></p>
								<p style="padding-top: 3px;"><span class="blue_txt">Value:</span><span class="value_txt">$<?php //echo $row_deal["discounted_price"]; ?></span></p>
								</li>
								<li style="padding: 0px 10px 0 10px; width: 307px;" class="desc_txt"><p>Only $<?php //echo $row_deal["discounted_price"]; ?> for a relaxation package at <?php //echo $store_name; ?>!</p></li>
							</ul>
-->					   </div>
					  <div id="viewDeal_btn">
							  <a href="<?php echo SITE_URL; ?>product-details.php?deal_id=<?php echo $deal_id; ?>"><img src="images/viewdeal_btn.png" alt="" width="127" height="99" /></a> </div>
						</div>
					   <!-- <div class="clear"></div> -->
					  <div class="dealimg"><img src="<?php echo UPLOAD_PATH.$img_file; ?>" alt="" width="671" height="333" /></div>
					  <div class="clear"></div>
					  
					  <?php
					  if($count_loop == 0)
					  {
						  ?>
							<div id="dealof">Deal of the day</div>
						  <?php
					  }
					  ?>					
					  
					 </div> 
					<br/>
				  <?php
				  $count_loop++;
				  }
			  }
			  else
			  {
				  ?>
				  
						<div style="height:30px;padding-top:15px;padding-left:20px;background-color:#999999;">
							<font style="color:#000066; font-weight:bold; font-size:16px;">No Deal Found</font>
						</div>
						
				  <?php
			  }
			  ?>
			  </div>
			  
			  
			  <div class="clear"></div>
			  <!--
			  <div id="blackBox">
						<h1>More Deals on Food & Drink</h1>
					</div>
			<div class="clear"></div>
			  <div id="contentBox">
			  <!--list view start-->
			  <!--		<div id="listView">
						<div class="listtop">
							<H1>List View</H1>
						</div>
						<div class="clear"></div>
						<div class="middBox">
							<div id="listDeal">
								<div class="imgBox"><img src="images/item1.gif" alt="" width="57" height="53" /></div>
								<div class="rightCont">
									<p><span class="dealtitle"><a href="#">$14 for $20 at 9th Avenue Grill</a></span></p>
									<p style="padding-bottom: 5px;" class="border_bottom">0.3 miles away</p>
									<p>Remaining : #Today  7.30pm – 11am</p>
								</div>
							</div>
							<div class="clear"></div>
							<div id="listDeal">
								<div class="imgBox"><img src="images/item1.gif" alt="" width="57" height="53" /></div>
								<div class="rightCont">
									<p><span class="dealtitle"><a href="#">$14 for $20 at 9th Avenue Grill</a></span></p>
									<p style="padding-bottom: 5px;" class="border_bottom">0.3 miles away</p>
									<p>Remaining : #Today  7.30pm – 11am</p>
								</div>
							</div>
							<div class="clear"></div>
							<div id="listDeal">
								<div class="imgBox"><img src="images/item1.gif" alt="" width="57" height="53" /></div>
								<div class="rightCont">
									<p><span class="dealtitle"><a href="#">$14 for $20 at 9th Avenue Grill</a></span></p>
									<p style="padding-bottom: 5px;" class="border_bottom">0.3 miles away</p>
									<p>Remaining : #Today  7.30pm – 11am</p>
								</div>
							</div>
							<div class="clear"></div>
							<div id="listDeal">
								<div class="imgBox"><img src="images/item1.gif" alt="" width="57" height="53" /></div>
								<div class="rightCont">
									<p><span class="dealtitle"><a href="#">$14 for $20 at 9th Avenue Grill</a></span></p>
									<p style="padding-bottom: 5px;" class="border_bottom">0.3 miles away</p>
									<p>Remaining : #Today  7.30pm – 11am</p>
								</div>
							</div>
							<div class="clear"></div>
							<div id="listDeal">
								<div class="imgBox"><img src="images/item1.gif" alt="" width="57" height="53" /></div>
								<div class="rightCont">
									<p><span class="dealtitle"><a href="#">$14 for $20 at 9th Avenue Grill</a></span></p>
									<p style="padding-bottom: 5px;" class="border_bottom">0.3 miles away</p>
									<p>Remaining : #Today  7.30pm – 11am</p>
								</div>
							</div>
							<div class="clear"></div>
							<div id="listDeal">
								<div class="imgBox"><img src="images/item1.gif" alt="" width="57" height="53" /></div>
								<div class="rightCont">
									<p><span class="dealtitle"><a href="#">$14 for $20 at 9th Avenue Grill</a></span></p>
									<p style="padding-bottom: 5px;" class="border_bottom">0.3 miles away</p>
									<p>Remaining : #Today  7.30pm – 11am</p>
								</div>
							</div>
						</div>
						
					</div>
				<!--list view end-->
<!--				<div id="map_View">
					<div><h1>Map View</h1></div>
					<div><img src="images/map.png" alt="" width="365" height="443" /></div>
				</div>
			  </div>
-->              <div class="clear"></div>
  <!--            <div id="blackBox">
						<h1>How it works</h1>
					</div>
<!--               <div id="contentBox" style="background: none; background-color: #f3f3f3;">
                   <div class="howitBox">
                   <div class="howitBox_left">1</div>
                   <div class="howitBox_right">
                   <h1>Nostrud exerci tation ullamcorper</h1>
                   Wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate
                   </div>
                   </div>
                   <div class="clear"></div>
                   <div class="howitBox">
                   <div class="howitBox_left">2</div>
                   <div class="howitBox_right">
                   <h1>Tation ullamcorper</h1>
                   Wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate
                   </div>
                   </div>
                   <div class="clear"></div>
                   <div style="background:none;" class="howitBox">
                   <div class="howitBox_left">3</div>
                   <div class="howitBox_right">
                   <h1>Exerci tation ullamcorper</h1>
                   Wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate
                   </div>
                   </div>
               </div>
-->			</div>
			<!--end body right-->				
		</div>		
		<!--end body-->	
			 <div class="clear"></div>
	<?php include("include/footer.php");?>