<?php include("include/header.php");?>
<?php
error_reporting(E_ERROR && E_STRICT);

?>

	<!-- Tabs links include -->
<link href="css/tabs/faq_jquery.ui.all.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="js/tabs/jquery-1.5.1.js"></script>
<script type="text/javascript" src="js/tabs/jquery.ui.core.js"></script>
<script type="text/javascript" src="js/tabs/jquery.ui.widget.js"></script>
<script type="text/javascript" src="js/tabs/jquery.ui.tabs.js"></script>
<script type="text/javascript" src="js/thickbox.js"></script>
<link href="css/tabs/faq_demos.css" rel="stylesheet" type="text/css"/>
<script>
$(function() {
	$( "#tabs" ).tabs();
});
</script>

<!--------- Tab links end---------->
<?php 

$faq_tab_sql = "SELECT * FROM ".TABLE_FAQS_CATEGORY." WHERE status = 1";
$faq_tab_res = mysql_query($faq_tab_sql);
$faq_tab_num_row = mysql_num_rows($faq_tab_sql); 
$tab_count = 0;
?>
<div class="deal_info">
<div class="clear"></div>
<div class="midbg">
<div class="today_deal">
<!--<div class="top_about">
&nbsp;
</div>-->
<!--<div style="background:none; border:none; overflow: hidden; margin-top: -1px;" id="tabs">-->
<div style="background:none; border:none; overflow: hidden; margin-top: 5px;" id="tabs">
		<ul style="-moz-border-radius: 0; border-radius: 0; margin-left: 8px; margin-right: 5px;">
		<?php 
			while ($faq_tab_row = mysql_fetch_array($faq_tab_res)) {
			$tab_count++;
		?>
			<li style="-moz-border-radius: 0; border-radius: 0;"><a href="#tabs-<?php echo $faq_tab_row['category_id']; ?>"><?php echo $faq_tab_row['question']; ?></a></li>
			
		<?php } ?>
			
		</ul>
		
		<?php 
			$faq_tab_sql = "SELECT * FROM ".TABLE_FAQS_CATEGORY." WHERE status = 1";
			$faq_tab_res = mysql_query($faq_tab_sql);
			while ($faq_tab_row = mysql_fetch_array($faq_tab_res)) {
				$faq_tab_content_sql = "SELECT * FROM ".TABLE_FAQS." WHERE status = 1 AND category_id = $faq_tab_row[category_id]";
				$faq_tab_content_res = mysql_query($faq_tab_content_sql);
				$faq_tab_content_num_rows = mysql_num_rows($faq_tab_content_sql); 
				while ($faq_tab_content_row = mysql_fetch_array($faq_tab_content_res)) { 
				$tab_content_count++;
		?>
		<div id="tabs-<?php echo $faq_tab_row['category_id']; ?>">
        <div id="faq_ani">
			<?php 
				echo '<h4 style="padding-bottom: 10px;">'.$faq_tab_content_row['question'].'</h4>'; 
				echo $faq_tab_content_row['answer'];
			?>
            </div>
		</div>
		<?php 
				}
			}
		?>
		
		
		
		
</div>
<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="40" /></div>

</div>
</div>
<div class="bot_about"></div>
</div>
</div>
</div>
<?php include ('include/sidebar.php');?>

<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
<?php include ('include/footer.php'); ?>