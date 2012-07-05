<?php
include("include/merchantheader.php");

if($_SESSION['merchantid'] == "")
{
	header("location:login.php?mererr=1");
}
else
{
$password = md5($_REQUEST['password']);
$row_deals = mysql_fetch_array(mysql_query("select * from ".TABLE_DEALS." where deal_id=".$_REQUEST['deal_id']." and store_id=".$_SESSION['merchantid'].""));

/*if($_REQUEST['submit'] == "Edit")
{
	header("location:merchanteditaccount.php?merchantid=".$_SESSION['merchantid']."");
}*/

if($_REQUEST['submit'] == "Save" && $_REQUEST['deal_id'] != '')
{
	$sqlupdate = mysql_query("update ".TABLE_DEALS." set preview=1 where deal_id=".$_REQUEST['deal_id']."");
	header("location:merchantdealactive.php");
}
?>
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function goBack()
  {
  window.history.back()
  }
</script>		
		<!--start body-->
		<div id="body">		
			<!--start body left-->
			<div class="left_02">			  
               <div class="box1">
                  <div class="box1_top"></div>
                    <div class="box1_middle">
					
						<div style="background:none;"><?php include("merchant_menu_section.php"); ?></div>
                         <div class="clear"></div>	
						
					
                   <div class="form" style="border:1px solid #cccbc8; padding:8px; width:97%;">
                   <!--<div class="ttle_txt" style="background:none; padding:0 0 5px 0; border:0px;">Merchant Account</div>-->
                    <div class="form_left" style=" border:0px;">
					
						<div class="form2">		 							
									<form name="merchant" method="post" style="padding-top:8px;">
																						
									<p class="gray_01">
										<label for="fullname">Deal Name:</label>
										<?php echo stripslashes($row_deals['title']);?><br />
										<span class="validate_error" style="color:#FF0000" id="err1"></span>
									</p>
									<div class="clear"></div>	
									<p class="gray_02">
										<label for="fullname">Deal Description:</label>
										<?php echo stripslashes($row_deals['description']); ?>
									</p>
									<div class="clear"></div>	
									<?php
									$sqlmerchant = mysql_fetch_array(mysql_query("select * from ".TABLE_USERS." where user_id=".$row_deals['store_id'].""));
									?>
									<p class="gray_01">
										<label for="email">Merchant:</label>
										<?php echo stripslashes($sqlmerchant['company_name']);?>
									</p>
									<div class="clear"></div>	
								   <p class="gray_02">
										<label for="email">Website:</label>
										<?php echo stripslashes($row_deals['website']);?>
									</p>
									<div class="clear"></div>						
									<p class="gray_01">
										<label for="fullname">Offer Details:</label>
										<?php echo strip_tags(stripslashes($row_deals['offer_details']));?>
									</p>
									<div class="clear"></div>	
									<p class="gray_02">
									<label for="email">Full Price:</label>
									<?php
									$sqlcountry = mysql_fetch_array(mysql_query("select * from ".TABLE_COUNTRIES." where country_id=".$row_deals['country'].""));
									?>
									<?php echo $currency; ?><?php echo stripslashes($row_deals['full_price']);?>						
									</p>
									<div class="clear"></div>
									<p class="gray_01">
										<label for="fullname">Discounted Price:</label>
										<?php echo $currency; ?><?php echo stripslashes($row_deals['discounted_price']); ?>
									</p>	
									<div class="clear"></div>
									<p class="gray_02">
										<label for="fullname">Customer Percentage:</label>
										<?php echo stripslashes($row_deals['custpercent']); ?>%
									</p>	
									<div class="clear"></div>
									<p class="gray_01">
										<label for="fullname">Merchant Take:</label>
										<?php echo $currency; ?><?php echo stripslashes($row_deals['merchant_take']); ?>
									</p>	
									<div class="clear"></div>
									<p class="gray_02">
										<label for="fullname">Merchant Take Percentage:</label>
										<?php echo stripslashes($row_deals['merchantpercent']); ?>%
									</p>	
									<div class="clear"></div>
									<p class="gray_02">
										<label for="fullname">Deal Friend Take Percentage:</label>
										<?php echo stripslashes($row_deals['waka_percent']); ?>%
									</p>	
									<div class="clear"></div>
									<p class="gray_01">
										<label for="fullname">Deal Start Time:</label>
										<?php echo stripslashes($row_deals['deal_start_time']); ?>
									</p>	
									<div class="clear"></div>
									<p class="gray_02">
										<label for="fullname">Deal End Time:</label>
										<?php echo stripslashes($row_deals['deal_end_time']); ?>
									</p>	
									<div class="clear"></div>
									<p class="gray_01">
										<label for="fullname">Deal Status:</label>
										<?php
										if($row_deals['status']==1)
										{
										echo "Active";
										}
										elseif($row_deals['status']==0)
										{
										echo "Inactive";
										}
										elseif($row_deals['status']==2)
										{
										echo "Upcoming";
										}
										elseif($row_deals['status']==3)
										{
										echo "End";
										}	
										?>
										<?php //echo stripslashes($row_deals['status']); ?>
									</p>	
									<div class="clear"></div>
									<p class="gray_02">
										<label for="fullname">Deal Added:</label>
										<?php echo stripslashes($row_deals['date_added']); ?>
									</p>	
									<div class="clear"></div>
									<div class="clear"></div>
									<p class="gray_01">
										<label for="fullname">Deal Modified:</label>
										<?php echo stripslashes($row_deals['date_modified']); ?>
									</p>	
									<div class="clear"></div>
									<?php /*?><p>
										<label for="fullname">Company Zipcode: </label>
										<?php echo $row_deals['zip']; ?>
									</p>
									
									<div class="clear"></div>	
								   <p class="gray_01">
										<label for="fullname">Password: </label>
										<?php echo $row_deals['password']; ?>
										<span class="validate_error" id="err2"></span>
									</p>
									<div class="clear"></div>	
									<p>
										<label for="fullname">Email/Merchant LoginId: </label>
										<?php echo $row_deals['email']; ?>
										<span class="validate_error" id="err4"></span>
									</p>
									<div class="clear"></div>	
									<p class="gray_01">
										<label for="fullname">Phone Number:</label>
										<?php echo stripslashes($row_deals['phone_no']);?>
									</p>
									<div class="clear"></div>	
									<p>
										<label for="fullname">Website:</label>
										<?php echo stripslashes($row_deals['website']); ?>
									</p>
									<div class="clear"></div>	
									<p class="gray_01">
										<label for="fullname">Paypal Email:</label>
										<?php echo stripslashes($row_deals['paypal_email']); ?>
									</p><?php */?>
									<p class="gray_01" align="center">
										<input type="submit" name="submit" value="Save" class="submit" style="width:80px; height:30px; cursor:pointer;" />
										<input type="button" name="back" value="Back" onclick="goBack()"class="submit" style="width:80px; height:30px; cursor:pointer;" />
									</p>
									<div class="clear"></div>	
									<!--<p>
									  <input type="submit" name="submit" id="submit" value="Edit" class="submit" style="margin:5px 0 0 220px;" />
									</p>-->
									
									</form>
         					  </div>
                        
						
		 				 <div class="clear"></div>
                     </div>
					 
                     <!--<div class="form_right">
                        	<p><img src="images/form_img2.png" alt="" /></p>
                            <p><strong>circumstances occur in which toil</strong></p>
                            <p> cupiditate non provident,Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae </p>
                       <p><strong>Connect With facebook</strong></p>                          
                            <div><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
                            <div><img src="images/connect2.png" alt="" style="margin:4px 0 0 2px;"/></div>	
                            <div><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
                     </div>-->
                                              
                    <div class="clear"></div>
                   </div>
                    	                      
                      <div class="clear"></div>
                    </div>
                    <div class="box1_bottom"></div>
                  <div class="clear"></div>	                
                </div>
                                              			
			 <div class="clear"></div>
			</div>
			<!--end body left-->
			
			<!--start body right-->
			<?php include("include/newsfeed.php"); ?>
		    <!--end body right-->
							
		 <div class="clear"></div>
		</div>		
		<!--end body-->	
		 <div style="height:90px;"></div>
		<?php include("include/bottomfooter.php"); ?>			
		
	  <div class="clear"></div>
	</div>
</div>
<!--end maincontainer-->
<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
</script>
<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels2");
</script>

<script type="text/javascript">
var TabbedPanels3 = new Spry.Widget.TabbedPanels("TabbedPanels3");
</script>
<script type="text/javascript">
$(document).ready(function() {
try {
		$("#websites1").msDropDown({mainCSS:'dd2'});
		//alert($.msDropDown.version);
		//$.msDropDown.create("body select");
		$("#ver").html($.msDropDown.version);
		} catch(e) {
			alert("Error: "+e.message);
		}
})
</script>

</body>
</html>
<?php } ?>