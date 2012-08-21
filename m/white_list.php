<?php include("include/header.php");?>
<?php
error_reporting(E_ERROR && E_STRICT);
?>

<?php
$page_id = 2;
$sql_page = "SELECT * FROM ".TABLE_PAGES." WHERE status = 1 AND page_id = '".$page_id."' LIMIT 0, 1";
$qr = mysql_query($sql_page);
$page_res = mysql_fetch_array(mysql_query($sql_page));


?>

<div class="howitwork">
<div class="how_top21">
<p>How do I whitelist GeeLaza in my email account?</p>
</div>
<div class="clear"></div>
<div class="how_mid21">
<p>Add GeeLaza to your address book to ensure you receive our emails.</p>
<p><span>Find your web-based email subscriber below, and follow the step-by-step instructions on how to add info@geelaza.com, b2b@geelaza.com and voucher@geelaza.com to your safe sender list.</span></p><br/>
<p><span>If your email provider is not listed below, please contact them directly.</span></p><br/>
</div>
<div class="clear"></div>
<div class="how_bot21">
<style type="text/css">
.here {
	background: none repeat scroll 0 0 #FFFFFF;
    border-color: #CCCCCC #CCCCCC #FFFFFF;
    border-style: solid;
    border-width: 1px;
    color: #333333;
    display: inline-block;
    font: 12px/32px Arial,Helvetica,sans-serif;
    height: 32px;
    padding: 0 22px;
    text-decoration: none;
}

</style>

<script type="text/javascript" language="javascript">
	<!--
		function show_tab(ID)
		{
			for(i=1; i<=7; i++)
			{
				document.getElementById("myaccount_"+i).style.display = "none";
				/*document.getElementById("tab_"+i).style.backgroundPosition = "";
				document.getElementById("stab_"+i).style.backgroundPosition = "";
				document.getElementById("stab_"+i).style.color = "";
				document.getElementById("tab_"+i).style.color = "";*/
				$('#tab_'+i).removeClass('here');
				/*if (i == 2) {
					document.getElementById("myaccount_"+i+"_b").style.display = "none";
					}*/

			}
			document.getElementById("myaccount_"+ID).style.display = "block";
			/*document.getElementById("tab_"+ID).style.backgroundPosition = "0% -29px";
			document.getElementById("stab_"+ID).style.backgroundPosition = "100% -29px";
			document.getElementById("tab_"+ID).style.color = "#000";
			document.getElementById("stab_"+ID).style.color = "#000";*/

			$('#tab_'+ID).addClass('here');

			/*if (ID == 2) {
				document.getElementById("myaccount_"+ID+"_b").style.display = "block";
				}*/

		}

		//-->
	</script>




<div style="width:946px; float: left; margin: 0 auto 0 2px;">
   	<div class="tabs21">
		<a href="javascript: show_tab(1);" id="tab_1" style="text-decoration: none; margin-right: 8px;">AOL Webmail</a>
		<a href="javascript: show_tab(2);" id="tab_2" style="text-decoration: none; margin-right: 8px;">Yahoo</a>
		<a href="javascript: show_tab(3);" id="tab_3" style="text-decoration: none; margin-right: 8px;">Windows Live Hotmail</a>
		<a href="javascript: show_tab(4);" id="tab_4" style="text-decoration: none; margin-right: 8px;">Google Mail</a>
		<a href="javascript: show_tab(5);" id="tab_5" style="text-decoration: none; margin-left: 8px;">EarthLink</a>
		<a href="javascript: show_tab(6);" id="tab_6" style="text-decoration: none; margin-left: 8px;">Microsoft Outlook 2003/2007</a>
		<a href="javascript: show_tab(7);" id="tab_7" style="text-decoration: none; margin-left: 8px;">AOL Users</a>
		<!-- <a href="javascript: show_tab(6);" id="tab_6">Temp</a> -->
      </div>
    <!--<div class="TabbedPanels">
      <ul>
        <li><a href="javascript: show_tab(1);" id="tab_1">My Order</a></li>
        <li><a href="javascript: show_tab(2);" id="tab_2">My Credit</a></li>
        <li><a href="javascript: show_tab(3);" id="tab_3">General</a></li>
        <li><a href="javascript: show_tab(4);" id="tab_4">Security</a></li>
        <li><a href="javascript: show_tab(5);" id="tab_5">Subscriptions</a></li>
       </ul>
	 </div>-->
    <div class="TabbedPanels1 dealbg_right" id="myaccount_1">
		<div><img src="images/aol.gif" border="0" alt="" width="182" height="44" /></div>
		<div class="clear"></div>
		<div class="tab_inner">
		<p><strong>AOL <span style="font-weight: bold;">&reg;</span> Webmail users:</strong><br/>
		1. Open your email message.<br/>
		2. Click on 'More Details' at the top of your email message.<br/>
		3. Hover mouse over the From address.<br/>
		4. our email address is automatically placed in the email field in the "Add Contact" pop-up box.<br/>
		5. Add additional contact information.<br/>
		6. Click on 'Add Contact'.<br/>
		7. Our email address will be automatically entered into your AOL Address Book.<br/>
If you encounter any problems. <a href="http://help.aol.co.uk/help/microsites/microsite.do/">contact AOL Support.</a></p>
		</div>
    </div>	<!-- 1 ends here  -->
	<div class="TabbedPanels1 dealbg_right" id="myaccount_2" style="display:none;">
		<div><img src="images/yahoo_mail.gif" border="0" alt="" width="182" height="44" /></div>
		<div class="clear"></div>
		<div class="tab_inner">
		<p><strong>Yahoo <span style="font-weight: bold;">&reg;</span> Users:</strong><br/>
		1. Open your email message.<br/>
		2. Click on 'Add' icon next to Form address.<br/>
		3. One email address is automatically placed in the email field in the 'Add Contact' pop-up box.<br/>
		4. Add additional contact information.<br/>
		5. Click on 'Save'.<br/>
		6. Our email address will be automatically entered into your Yahoo! Address Book.<br/><br/>
If you encounter any problems, <a href="http://help.yahoo.com/l/uk/yahoo/helpcentral/">contact Yahoo Support.</a></p>
	</div>
    </div><!-- 2 ends here  -->
	<div class="TabbedPanels1 dealbg_right" id="myaccount_3" style="display:none;">
	<div><img src="images/hot_mail.gif" border="0" alt="" width="182" height="44" /></div>
	<div class="clear"></div>
	<div class="tab_inner">
    <p><strong>Window Like Hotmail <span style="font-weight: bold;">&reg;</span> User:</strong><br/>
	1. Open your email message.<br/>
	2. Click on 'Mark as safe' at the top of your email message.<br/>
	3. Our email address will be automatically entered into your Safe sender list.<br/><br/>
    If you encounter any problems. <a href="http://explore.live.com/windows-live-hotmail-how-do-i-faq">Window Live Hotmail Support.</a></p>
	</div>
	</div>
	<!-- 3 ends here  -->
	<div class="TabbedPanels1 dealbg_right" id="myaccount_4" style="display:none;">
	<div><img src="images/google.gif" border="0" alt="" width="182" height="44" /></div>
	<div class="clear"></div>
	<div class="tab_inner">
    <p><strong>Google Mail <span style="font-weight: bold;">&reg;</span> User:</strong><br/>
	1. Open your email message.<br/>
	2. Click on down arrow next to 'Reply' on top right of the message.<br/>
	3. From drop menu click on 'Add to Contact List'.<br/>
	4. Our email address will be automatically entered into your contacts list.<br/><br/>
    If you encounter any problems. <a href="http://support.google.com/?hl=en-GB">Google Support.</a></p>
	</div>
	</div>
	<!-- 4 ends here  -->
	<div class="TabbedPanels1 dealbg_right" id="myaccount_5" style="display:none;">
	<div><img src="images/earth_link.gif" border="0" alt="" width="182" height="44" /></div>
	<div class="clear"></div>
	<div class="tab_inner">
    <p><strong>EarthLink <span style="font-weight: bold;">&reg;</span> User:</strong><br/>
	1. Open your email message.<br/>
	2. Click your mailbox's "Message" menu and choose "Add Senders" to your Address Book.<br/>
	3. Your email message will be automatically entered into your EarthLink Address Book.<br/><br/>
    If you encounter any problems. <a href="http://support.earthlink.net/">contact EarthLink Support.</a></p>
	</div>
	</div>
	<!-- 5 ends here  -->
	<div class="TabbedPanels1 dealbg_right" id="myaccount_6" style="display:none;">
	<div><img src="images/office.gif" border="0" alt="" width="105" height="126" /></div>
	<div class="clear"></div>
	<div class="tab_inner">
    <p><strong>Microsoft Outlook 2003/2007 <span style="font-weight: bold;">&reg;</span> User:</strong><br/>
	1. Open your email message.<br/>
	2. Click on 'Actions' from the menu bar.<br/>
	3. Click on 'Junk E-mail' from drop down menu<br/>
	4. Click on 'Add Sender to Safe Senders List'.<br/>
	5. Our email address will be automatically entetrd into your Safe senders list.<br/>
	6, Click on 'Junk E-mail' from drop down menu.<br/><br/>
    If you encounter any problems. <a href="http://support.microsoft.com/?ln=en-gb">contact  Outlook Support.</a></p>
	</div>
	</div><!-- 6 ends here  -->
   <div class="TabbedPanels1 dealbg_right" id="myaccount_7" style="display:none;">
	<div><img src="images/aol_mail01.gif" border="0" alt="" width="182" height="44" /></div>
	<div class="clear"></div>
	<div class="tab_inner">
    <p><strong>AOL <span style="font-weight: bold;">&reg;</span> User:</strong><br/>
	1. Open your email message.<br/>
	2. Click on the 'Add Address' icon.<br/>
	3. Our email addrss is automatically placed in the name and email field in the "Add Contact" pop-up box Verity the information is correct and then...<br/>
	4. Click the Save button.<br/>
	5. Your email message will be automatically entered into your AOL Address Book.<br/><br/>

    If you encounter any problems. <a href="http://help.aol.co.uk/help_uk/microsites/mshome.jsp">contact AOL Support.</a></p>
	</div>
	</div><!-- 7 ends here  -->
	<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="40"/></div>
  </div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php include 'recommendation_popup.php';?>
<?php include ('include/footer.php'); ?>