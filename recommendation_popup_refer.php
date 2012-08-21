<?php
$sql_count = "SELECT td.deal_id,td.title,td.discounted_price,td.discount,td.savings,img.file FROM ".TABLE_DEALS." td LEFT JOIN ".TABLE_DEAL_IMAGES." img on td.deal_id=img.deal_id WHERE td.deal_end_time>='".date("Y-m-d G:i:s")."'";


		$sql_count_res = mysql_query($sql_count);
	 $sql_count_num = mysql_num_rows($sql_count_res);
	$i=0;
 while ($ref_deal = mysql_fetch_array($sql_count_res)) {

$curent_recom_deal_id = $ref_deal['deal_id'];
			$i++;
?>



<div style="display: none;">

		<div  id="refer<?php echo $i; ?>" style="width:701px;height:px;overflow:auto; background-color: transparent;">
			<?php //if (isset($_SESSION['user_id'])) { ?>
				<div class="deal_recomm">
				<div class="top_recomm">
				<p>Recommend now to your friends<?php //echo $sql_count_num?></p>
				</div>
				<div class="clear"></div>
				<div style="border-bottom: 3px solid #7fd7fb;"></div>
				<div class="clear"></div>
				<div class="recomm_mid">

		<?php

	//echo $_POST['deal_count'];

	//echo $_POST['RecomendSubmit'].$_POST['deal_count'];

	//echo '+++++++++++++++'.$_POST['RecomendSubmit'.$_POST['deal_count']];
	//print_r($_POST);
				if ( $_POST['RecomendSubmit'.$_POST['deal_count']]== "Tell them"){
		//print_r($_POST);
				  $recom_deal_id = $_POST['recomdealid'.$_POST['deal_count']];

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

						';



					// Recomendation tracker code for calculating Credits

					$r_emails = explode(',',$_POST['femail'.$_POST['deal_count']]);
					$today = date("Y-m-d");
					//var_dump($r_emails); r_id 	r_email 	r_user 	r_date
					foreach ($r_emails as $r_email) {
						$r_email = trim($r_email);
						$token = base64_encode($r_email);

						$sql_mail_id = "SELECT * FROM ".TABLE_RECOM_TRACKER." WHERE r_email='".$r_email."'";
						$chk_mail_res = mysql_query($sql_mail_id);
						 $count_mail = mysql_num_rows($chk_mail_res);
						$template_recom .= '<tr><td valign="top" style="color:#14131b; font-family:Arial, Helvetica, sans-serif; line-height:26px; font-size:15px; font-weight:normal; padding:0 0 0 6px;"><a href="'.SITE_URL.'customer-login.php?token='.$token.'" style="color:#009CE8;"> Click the link to sign up and get 20% discount on your purchase </a></td></tr>';
						if($count_mail>0)
						{

						}
						else
						{
						 //$_SESSION['user_id'];
						 $recom_tracker_sql = "INSERT INTO jumblr_recom_tracker(r_email,r_user,r_date) VALUES ('$r_email','$_SESSION[user_id]','$today')";
						mysql_query($recom_tracker_sql);
						}
					}

					$template_recom .= '<tr>
										  <td style="color:#4f4437; font-family:Arial, Helvetica, sans-serif; line-height:17px; font-size:11px; font-weight:normal; padding:8px 0 0 6px;">If you purchase this deal within 48 hours of opening a Jumblr account,  will get 20% discount automatically on every purchase to your friend\'s Jumblr account, so you can both enjoy great saving! You will hear nothing else from us as a result of this referral. You have not been added to any database and there is no need to ask for removal. <br/>See our <a href="'.SITE_URL.'page.php?page=Privacy Policy" style="font-size: 12px; text-decoration: underline; color:#4f4437;">Privacy Policy</a>.</td>
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
												<td width="25" valign="top"><a href="'.getSettings(fb).'"><img src="'.SITE_URL.'images/reg_newsletter/icon_01.png" alt="" /></a></td>
												<td width="9" valign="top"><img src="'.SITE_URL.'images/reg_newsletter/spacer.gif" alt="" width="2" height="1" /></td>
												<td width="25" valign="top"><a href="'.getSettings(twit).'"><img src="'.SITE_URL.'images/reg_newsletter/icon_02.png" alt="" /></a></td>
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
											<a href="'.SITE_URL.'customer-login.php" style="padding:0 4px; color:#5b6cd9; font-family:Arial, Helvetica, sans-serif; line-height:18px; font-size:14px;text-align:center; text-decoration:none;">Join Us</a>

											<a href="'.SITE_URL.'merchant.php" style="padding:0 4px; color:#5b6cd9; font-family:Arial, Helvetica, sans-serif; line-height:18px; font-size:14px;text-align:center; text-decoration:none;">Run Deal With Us</a>                   </td>
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
						</table>';
					//$fmsg = $_POST['fmsg'];
					//$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$headers .= "From: Jumblr Referral<rewards@Jumblr.com>";
					$femail = $_POST['femail'.$_POST['deal_count']];
					$sub = ucwords($user_name)." has invited you to join Jumblr";

						$sql_mail_id = "SELECT * FROM ".TABLE_CREDITS_VAULT." WHERE user_id='".$femail."'";
						$chk_mail_res = mysql_query($sql_mail_id);
						$count_mail = mysql_num_rows($chk_mail_res);
						if($count_mail>0)
						{
							header('location: '.SITE_URL);
							exit();
						}
						else
						{
							@mail($femail, $sub, $template_recom, $headers);
							header('location: '.SITE_URL);
							exit();
							}


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
	/*if ($_SESSION['current_deal_id']) {
		$curent_recom_deal_id = $_SESSION['current_deal_id'];
	}else{

		$curent_recom_deal_id = $ref_deal['deal_id'];
	}*/



	//echo $curent_recom_deal_id.'+++++++++'.$today_res['deal_id'];
?>


		<form action="" name="" method="post" onsubmit="return validateRecom('<?php echo $i?>');">
		<input type="hidden" name="recomdealid<?php echo $i?>" id="recomdealid<?php echo $i?>" value="<?php if ($_GET['nd'] == "National deals") { echo $today_res['deal_id']; } else { echo $curent_recom_deal_id;} ; ?>">

				<div class="invita_deal">
				<div><p>Your invitation message:<?php //echo $curent_recom_deal_id;?></p><div class="error_orange10" id="msgErr"></div></div>
				<div class="clear"></div>

				<div class="massage">

				<div class="massage_left">
				<textarea name="fmsg<?php echo $i?>" id="fmsg<?php echo $i?>" class="textarea2">
Hi,
I would like to recommend this deal.
Take care!
Your friend.</textarea></div>
				<div class="massage_right">
				<div><img src="images/dollar.jpg" alt="" width="168" height="108" /></div>
				<div>

				</div>
				</div>
				</div>
				</div>
				<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
				<div style="border-bottom: 3px solid #7fd7fb;"></div>
				<div class="clear"></div>
				<div class="invita_deal">
				<div>
				<p class="red">Please type your families, friends email address below<span style="padding: 0 6px; margin:0;"></span></p>
					<span>(separate email address with comma or semicolon)</span>
					<div class="error_orange10" id="emailErr"></div>
				</div>
				<div class="clear"></div>
				<div class="massage">
				<div style="float:left; width: auto; margin: 0 auto;">
					<input type="text" name="femail<?php echo $i?>" id="femail<?php echo $i?>" value="<?php if ($_SESSION['recomEmails']) echo $_SESSION['recomEmails']; unset($_SESSION['recomEmails']); ?>" class="mailbox"/>

					<input type="hidden" name="deal_count" value="<?php echo $i?>" />
					<input type="submit" name="RecomendSubmit<?php echo $i?>" class="tellbtn" value="Tell them"/>
				</div>

				</form></div>
				</div>

				<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
				<div style="border-bottom: 3px solid #7fd7fb;"></div>
				<div class="clear"></div>

<?php




	?>


				<div class="clear"></div>



				<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
				</div>
				<div class="clear"></div>
				<!--<div style="border-bottom: 3px solid #7fd7fb;"></div>-->
			<!--	--><div class="recomm_bot"></div>
				</div>

			<!-- opi -->



			<!-- opi -->


			<?php //} else { ?>


			<?php //} ?>
		</div>

	</div>



<?php } ?>

			<script type="text/javascript">
				function validateRecom(val) {

					//alert('hiiiiiiii');
					var msg = document.getElementById('fmsg'+val).value;
					var email_list = document.getElementById('femail'+val).value;
					//var deal = document.getElementById('recomdealid'+val).value;
					//alert(document.getElementById('deal_count').value);
					if (msg == '') {
						document.getElementById('msgErr').innerHTML = "Enter message<br><br>";
						return false;
					}
					 if (email_list == '') {
						document.getElementById('emailErr').innerHTML = "Enter enter a valid email address used by your friends e. g. jhohn@hotmail.co.uk";
						return false;
					}


				}

			</script>
