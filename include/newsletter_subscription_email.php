<?php
ob_start();
session_start();

require("../config.inc.php");
require("../class/Database.class.php");
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();
header("Content-Type: text/html; charset=iso-8859-1");

$imagePath = SITE_URL."images/newsletter_succ_images/";
?>

<?php
	$city = end(explode('|', $_COOKIE['subscribe']));

	//$deal_sql = "SELECT * FROM ".TABLE_DEALS." WHERE status >= 1 AND deal_end_time LIKE '".date("Y-m-d")."%' AND city = $city  LIMIT 0, 1";
	echo $deal_sql = "SELECT * FROM ".TABLE_DEALS." WHERE status >= 1 AND deal_end_time LIKE '".date("Y-m-d")."%' LIMIT 0, 1";
	$deal_sql_details = mysql_fetch_array(mysql_query($deal_sql));

	$sql_deal_image = "SELECT * FROM ".TABLE_DEAL_IMAGES." WHERE deal_id = ".$deal_sql_details['deal_id'];
	$deal_image = mysql_fetch_array(mysql_query($sql_deal_image));

//	echo $deal_image['file'];

	//var_dump($deal_sql_details);



$template = '<table border="0" cellspacing="0" cellpadding="0" width="620" style="vertical-align:top; width:620px; margin:0 auto;">
  <tr>
    <td background="'.$imagePath.'box1_top.png"><img src="'.$imagePath.'spacer.gif" width="620" height="10" alt="" /></td>
  </tr>
   <tr>
    <td valign="top" align="left" background="'.$imagePath.'bg_p.gif">
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top" align="left">
        	<table border="0" cellspacing="0" cellpadding="0" width="620" style="vertical-align:top; width:620px;">
          <tr>
            <td width="10" valign="top" style="vertical-align:top; width:10px;"><img src="'.$imagePath.'spacer.gif" width="10" height="1" alt="" /></td>
            <td width="171" height="76" align="left" valign="top" style="vertical-align:top; text-align:left; width:171px; height:76px; line-height:0px;">
            	<img src="'.$imagePath.'logo.png" width="164" height="72" alt="" />
            </td>
			<td width="350" valign="top" style="vertical-align: middle; text-align: center; width:350px; color:#fff; font-family:Times New Roman, Arial, Helvetica, sans-serif; line-height:26px; font-size:40px; font-weight:normal; padding:12px 10px 0 6px;">Welcome to GeeLaza</td>
          </tr>
      </table>
        </td>
      </tr>
      <tr>
         <td height="15" valign="top" style="vertical-align:top; height:15px; line-height:0px;"><img src="'.$imagePath.'spacer.gif" width="1" height="15" alt="" /></td>
     </tr>
      <tr>
         <td height="15" valign="top" style="vertical-align:top; height:15px; line-height:0px;"><img src="'.$imagePath.'box2_top.png" width="620" height="15" alt="" /></td>
     </tr>
      <tr>
        <td valign="top" background="'.$imagePath.'box2_middle.png"><table width="620" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td><table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td valign="top" style="color:#14131b; font-family:Arial, Helvetica, sans-serif; line-height:20px; font-size:13px; font-weight:normal; padding:0 0 0 6px;"><p>Thanks for subscribing to GeeLaza to receive incredible discount deals straight to your inbox.</p>
                    <p>Here\'s todays deal for your city.</p>
                  <p>Right now we\'re in the process of expanding to cover the whole country so if your area<br />
                    doesn\'t get deal immediately don\'t worry, we\'ll have deals there soon.</p>
                  <p>Please add <a href="#">deals@geelaza.com</a> to your address book or safe sender list so our emails get to your inbox</p>
                  <p>We hope you enjoy your daily deals.</p>
                  <p>The GeeLaza Team, </p></td>
              </tr>
              <tr>
                <td valign="top" style="color:#14131b; font-family:Arial, Helvetica, sans-serif; line-height:26px; font-size:15px; font-weight:normal; padding:0 0 0 6px;">&nbsp;</td>
              </tr>
              <tr>
                <td height="8"><img src="'.$imagePath.'spacer.gif" alt="" width="1" height="8" /></td>
              </tr>
              <tr>
                <td style="background: #ddedcc; color:#14131b; font-family: Arial, Helvetica, sans-serif; line-height:26px; font-size:12px; font-weight:bold;  padding:0 8px;">Today\'s Deal in West London</td>
              </tr>
              <tr>
                <td valign="top">&nbsp;</td>
              </tr>
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="10" valign="top"><img src="'.$imagePath.'spacer.gif" alt="" width="10" height="1" /></td>
                      <td width="231" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td height="90" valign="top" background="'.$imagePath.'price_bg.png"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td valign="top" align="center" style="padding:8px 0 10px 15px; color:#00cb46; font-family:Arial, Helvetica, sans-serif; line-height:24px; font-size:26px; font-weight: bold; text-align:center;">$105.96</td>
                                </tr>
                                <tr>
                                  <td valign="top" align="center" style="padding:8px 0 10px 15px; color:#fff; font-family:Arial, Helvetica, sans-serif; line-height:24px; font-size:24px; font-weight:bold; text-align:center;"><a href="'.SITE_URL.'index.php?action=view&id='.$deal_sql_details['deal_id'].'" style="color:#fff;">View Now !</a></td>
                                </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td height="5"><img src="'.$imagePath.'spacer.gif" alt="" width="1" height="5" /></td>
                          </tr>
                          <tr>
                            <td valign="top" height="67" background="'.$imagePath.'timer_bg.png"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td valign="top" align="center" width="76" style="padding:8px 0 5px 0; color:#000; font-family:Arial, Helvetica, sans-serif; line-height:24px; font-size:12px; font-weight:bold; text-align:center;">Value</td>
                                  <td valign="top" align="center" width="75" style="padding:8px 0 5px 2px; color:#000; font-family:Arial, Helvetica, sans-serif; line-height:24px; font-size:12px; font-weight:bold; text-align:center;">Discount</td>
                                  <td valign="top" align="center" width="78" style="padding:8px 4px 5px 0; color:#000; font-family:Arial, Helvetica, sans-serif; line-height:24px; font-size:12px; font-weight:bold; text-align:center;">Your Save</td>
                                </tr>
                                <tr>
                                  <td valign="top" align="center" style="padding:0 0 0 0; color:#000; font-family:Arial, Helvetica, sans-serif; line-height:16px; font-size:16px; font-weight:bold; text-align:center;">&pound;'.strip_tags($deal_sql_details['full_price']).'</td>
                                  <td valign="top" align="center" style="padding:0 0 0 2px; color:#000; font-family:Arial, Helvetica, sans-serif; line-height:16px; font-size:16px; font-weight:bold; text-align:center;">'.intval($deal_sql_details['discounted_price']*100/$deal_sql_details['full_price']).'%</td>
                                  <td valign="top" align="center" style="padding:0 4px 0 0; color:#000; font-family:Arial, Helvetica, sans-serif; line-height:16px; font-size:16px; font-weight:bold; text-align:center;">&pound;'.strip_tags($today_res['full_price'] - $today_res['discounted_price']).'</td>
                                </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td height="5"><img src="'.$imagePath.'spacer.gif" alt="" width="1" height="5" /></td>
                          </tr>
                      </table></td>
                      <td width="42" valign="top"><img src="'.$imagePath.'spacer.gif" alt="" width="8" height="1" /></td>
                      <td width="305" valign="top"><img src="'.UPLOAD_PATH.$deal_image['file'].'" alt="" width="288" height="189" vspace="8" /></td>
                      <td width="12" valign="top"><img src="'.$imagePath.'spacer.gif" alt="" width="10" height="1" /></td>
                    </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td style="padding-top:10px 0 0 0;"><table width="608" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td bgcolor="#d1d1d1" style="padding:0 4px 0 10px; color:#000; font-family:Arial, Helvetica, sans-serif; line-height:16px; font-size:12px; font-weight: normal; border-top: 3px solid #000000;"><p>This message was sent by GeeLaza UK.</p>
                  <p>You are receiving this email because you have an existing relationship with <a href="#" style="color:#2d92ba; text-decoration: none;">http://www.geelaza.com/.</a> If you no<br />
                    longer wish to receive emails from us. you can <a href="'.SITE_URL.'unsubscribe_newsletter.php?unsub_email='.$email.'" style="color:#2d92ba; text-decoration:none;">unsubscribe</a></p></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
        </tr>
         <tr>
         <td height="15" valign="top" style="vertical-align:top; height:15px; line-height:0px;"><img src="'.$imagePath.'box2_bottom.png" width="620" height="16" alt="" /></td>
     </tr>
    </table>
    </td>
   </tr>
   <tr>
    <td><img src="'.$imagePath.'box1_bottom.png" /></td>
  </tr>
</table>';


//echo $template;
?>