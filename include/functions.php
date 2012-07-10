<?php
/************* Function For Truncating A String Without cutting It In Between A Word Starts *********************/
function truncate_string($details,$max)
{
    if(strlen($details)>$max)
    {
        $details = substr($details,0,$max);
        $i = strrpos($details," ");
        $details = substr($details,0,$i);
        $details = $details."... ";
    }
    return $details;
}
/**************************************** Ends ********************************/

/************************* Code for generating Random AlphaNumeric Text Starts ***************************/

function str_rand($length = 8, $seeds = 'alphanum')
{
	// Possible seeds
	$seedings['alpha'] = 'abcdefghijklmnopqrstuvwqyz';
	$seedings['numeric'] = '0123456789';
	$seedings['alphanum'] = 'abcdefghijklmnopqrstuvwqyz0123456789';
	$seedings['hexidec'] = '0123456789abcdef';

	// Choose seed
	if (isset($seedings[$seeds]))
	{
		$seeds = $seedings[$seeds];
	}

	// Seed generator
	list($usec, $sec) = explode(' ', microtime());
	$seed = (float) $sec + ((float) $usec * 100000);
	mt_srand($seed);

	// Generate
	$str = '';
	$seeds_count = strlen($seeds);

	for ($i = 0; $length > $i; $i++)
	{
		$str .= $seeds{mt_rand(0, $seeds_count - 1)};
	}

	return $str;
}

/************************* Code for generating Random AlphaNumeric Text Ends ***************************/

function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

function get_deal_details($deal_id){
$deal=mysql_fetch_array(mysql_query("SELECT * FROM ".TABLE_DEALS." where deal_id='$deal_id'"));
return $deal;
}
function get_merchant_details($deal_id){
$sql="SELECT * FROM ".TABLE_DEALS_MERCHANT." JOIN ".TABLE_DEALS." on(".TABLE_DEALS_MERCHANT.".deal_id=".TABLE_DEALS.".deal_id) where 1=1 and  ".TABLE_DEALS_MERCHANT.".deal_id='".$deal_id."'";
$m_deal=mysql_fetch_array(mysql_query($sql));

$res=mysql_fetch_array(mysql_query("SELECT * FROM ".TABLE_USERS." where user_id='".$m_deal['user_id']."'"));
return $res;
}

function get_deal_category($deal_id){
$deal=get_deal_details($deal_id);
$sql="SELECT * FROM ".TABLE_CATEGORIES." where cat_id='".$deal['deal_cat']."' ";
$cat=mysql_fetch_array(mysql_query($sql));
return $cat;

}

function get_store_details($deal_id){
$sql="SELECT * FROM ".TABLE_DEALS_MERCHANT." JOIN ".TABLE_DEALS." on(".TABLE_DEALS_MERCHANT.".deal_id=".TABLE_DEALS.".deal_id) where 1=1 and  ".TABLE_DEALS_MERCHANT.".deal_id='".$deal_id."'";
$m_deal=mysql_fetch_array(mysql_query($sql));
$res=mysql_fetch_array(mysql_query("SELECT * FROM ".TABLE_STORES." where merchant_id='".$m_deal['user_id']."'"));
return $res;

}



function getprofile_array(){

$progress_stores=mysql_fetch_array(mysql_query("SELECT * FROM ".TABLE_STORES." where merchant_id='".$_SESSION['muser_id']."'"));

$merchant=mysql_fetch_array(mysql_query("SELECT * FROM ".TABLE_USERS." where reg_type='merchant' and user_id='".$_SESSION['muser_id']."'"));



$profile_arr=array('store_name'=>0, 'category_id'=>0, 'primary_location'=>0, 'phone'=>0, 'website'=>0, 'twitterpage'=>0,
'facebookpage'=>0, 'business_desc'=>0, 'product_recommend'=>0, 'experience'=>0, 'stand_out'=>0, 'why_not_come'=>0, 'chq_address1'=>0, 'chq_address2'=>0, 'chq_city'=>0,
 'chq_state'=>0, 'chq_zip'=>0, 'chq_country'=>0, 'chq_payable'=>0,'location'=>0,'profile_image'=>0,'site_review'=>0);

!empty($progress_stores['store_name'])? $profile_arr['store_name']=1:$profile_arr['store_name']=0;
!empty($progress_stores['category_id'])? $profile_arr['category_id']=1:$profile_arr['category_id']=0;
!empty($progress_stores['category_id'])? $profile_arr['address1']=1:$profile_arr['address1']=0;

!empty($progress_stores['primary_location'])? $profile_arr['primary_location']=1:$profile_arr['primary_location']=0;


!empty($progress_stores['phone'])? $profile_arr['phone']=1:$profile_arr['phone']=0;
!empty($progress_stores['website'])? $profile_arr['website']=1:$profile_arr['website']=0;
!empty($progress_stores['twitterpage'])? $profile_arr['twitterpage']=1:$profile_arr['twitterpage']=0;
!empty($progress_stores['facebookpage'])? $profile_arr['facebookpage']=1:$profile_arr['facebookpage']=0;
!empty($progress_stores['business_desc'])? $profile_arr['business_desc']=1:$profile_arr['business_desc']=0;
!empty($progress_stores['product_recommend'])? $profile_arr['product_recommend']=1:$profile_arr['product_recommend']=0;
!empty($progress_stores['experience'])? $profile_arr['experience']=1:$profile_arr['experience']=0;
!empty($progress_stores['stand_out'])? $profile_arr['stand_out']=1:$profile_arr['stand_out']=0;
!empty($progress_stores['why_not_come'])? $profile_arr['why_not_come']=1:$profile_arr['why_not_come']=0;
!empty($progress_stores['chq_address1'])? $profile_arr['chq_address1']=1:$profile_arr['chq_address1']=0;
!empty($progress_stores['chq_address2'])? $profile_arr['chq_address2']=1:$profile_arr['chq_address2']=0;
!empty($progress_stores['chq_city'])? $profile_arr['chq_city']=1:$profile_arr['chq_city']=0;

!empty($progress_stores['chq_state'])? $profile_arr['chq_state']=1:$profile_arr['chq_state']=0;
!empty($progress_stores['chq_zip'])? $profile_arr['chq_zip']=1:$profile_arr['chq_zip']=0;
!empty($progress_stores['chq_country'])? $profile_arr['chq_country']=1:$profile_arr['chq_country']=0;
!empty($progress_stores['chq_payable'])? $profile_arr['chq_payable']=1:$profile_arr['chq_payable']=0;


$locationnum=mysql_num_rows(mysql_query("SELECT * FROM ".TABLE_STORES_LOCATION." where  store_id='".$progress_stores['store_id']."'"));
$locationnum>0? $profile_arr['location']=1:$profile_arr['location']=0;

$profileimg=mysql_num_rows(mysql_query("SELECT * FROM ".TABLE_STORES_PROFILEIMG." where  store_id='".$progress_stores['store_id']."'"));
$profileimg>=3? $profile_arr['profile_image']=1:$profile_arr['profile_image']=0;


$sitereview=mysql_num_rows(mysql_query("SELECT * FROM ".TABLE_STORES_REVIEW." where  store_id='".$progress_stores['store_id']."'"));
$sitereview>0? $profile_arr['site_review']=1:$profile_arr['site_review']=0;

return $profile_arr;

}


function repeat_days($currentDate,$lastdate,$days){
		$i=1;


		$resdate=array();


		while ($currentDate <= $lastdate){

			 $day = substr(strtoupper(date('l',$currentDate)),0,2);

				if(in_array($day,$days)){

				$resdate[]=date("Y-m-d H:i",$currentDate);
				}

			$currentDate= strtotime(date("Y-m-d H:i", $currentDate) . " +1 day");
			$i++;

		}

		return $resdate;
}

/** Welcome Email to the new registerar.
 * @author Aditya Jyoti Saha
 *
 **/
function RegistrationEmail($to) {

	$Template = '

			<table width="704" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
			  <tr>
			    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
			      <tr>
			        <td><img src="'.SITE_URL.'images/spacer.gif" alt="" width="1" height="8" /></td>
			      </tr>
			      <tr>
			        <td><table width="630" border="0" align="center" cellpadding="0" cellspacing="0">
			          <tr>
			            <td width="422" bgcolor="#ffffff"><img src="'.SITE_URL.'images/logo.png" alt="" width="143" height="59" /></td>
			            <td width="178" align="left" valign="top" bgcolor="#FFFFFF" style="font-family: Arial, Helvetica, sans-serif; padding-top: 7px; font-size: 13px; line-height: 20px; color: #5c5c5c; font-weight: normal;">Newsletter date:: 24/11/2011</td>
			          </tr>
			        </table></td>
			      </tr>
			    </table></td>
			  </tr>
			  <tr>
			    <td><table width="650" border="0" align="center" cellpadding="3" cellspacing="3" bgcolor="#FFFFFF">
			      <tr>
			        <td style="font-family: Arial, Helvetica, sans-serif; padding-left: 10px; font-size: 16px; line-height: 20px; color: #73c3e4; font-weight: bold;">Welcome to GeeLaza!</td>
			      </tr>
			      <tr>
			    <td><table width="650" border="0" align="center" cellpadding="0" cellspacing="0" style="background-color: #feffe9; border: 3px solid #7ad5fc;">
			        <tr>
			          <td style="font-family: Arial, Helvetica, sans-serif; padding-left: 10px; font-size: 13px; line-height: 20px; color: #b3cf5b; font-weight: bold;">Hey Qsia!</td>
			        </tr>
			        <tr>
			          <td style="font-family: Arial, Helvetica, sans-serif; padding-left: 10px; font-size: 13px; line-height: 17px; color: #000; font-weight: bold;">Thank you for becoming a GeeLaza member! Each day. We will send you amazing deals to your email address
			(123nana@hotmail.com) From today onwards you won,t miss any daily deals. We hope you have a great experience
			with GeeLaza. </td>
			        </tr>
			        <tr>
			          <td>&nbsp;</td>
			        </tr>
			      </table></td>
			      </tr>
			      <tr>
			      <td style="font-family: Arial, Helvetica, sans-serif; padding-left: 10px; padding-top: 10px; font-size: 12px; line-height: 20px; color: #3c3c3c; font-weight: bold;">How does it works?<br />

			1) Buy a deal - Buy one of our amazing deals by clicking on "BUY THIS DEAL" button and you
			will receive a email with instructions on how to redeem your voucher.<br /><br />

			2) Share it - Spread the word when you buy something so others can save as well. Don\'t forget to recomment the deal and get some cash.<br /><br />

			3) Redeem it - You will get your voucher within 48 hours after the deal rens out. You can redeem it online or print it.<br /><br />

			4) Enjoy your deal - it is time to see the better and new side of your city and live your life like its
			meant to  be.<br /><br />

			enjoy,<br /><br />


			If you need help or have any questions, contact us. we want to thank you once for registering with us and enjoy your life with Geelaza!</td>
			      </tr>
			      <tr>
			        <td style="font-family: Arial, Helvetica, sans-serif; padding-left: 10px; padding-top: 10px; font-size: 16px; line-height: 20px; color: #000; font-weight: bold;">The GeeLaza Team</td>
			      </tr>
			      <tr>
			        <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; padding-left: 10px; padding-top: 10px; font-size: 16px; line-height: 20px; color: #3c3c3c; font-weight: bold;"><table width="600" border="0" cellspacing="0" cellpadding="0">
			          <tr>
			            <td><table width="650" border="0" align="left" cellpadding="0" cellspacing="0">
			              <tr>
			                <td width="340" align="left" valign="top"><table width="310" border="0" align="left" cellpadding="0" cellspacing="0" style="background-color: #f4f4f4; border: 4px solid #70d3fc;">
			                  <tr>
			                    <td><table width="254" border="0" align="center" cellpadding="0" cellspacing="0">
			                      <tr>
			                        <td colspan="2" style="font-family: Arial, Helvetica, sans-serif; padding-left: 5px; padding-bottom: 10px; padding-top: 10px; font-size: 12px; line-height: 20px; color: #3c3c3c; font-weight: bold;">Samsung LED/LCD HD   1080p 3D Television</td>
			                      </tr>
			                      <tr>
			                        <td colspan="2"><img src="'.SITE_URL.'images/techno.jpg" alt="" width="252" height="172" /></td>
			                      </tr>
			                      <tr>
			                        <td width="126" bgcolor="#cccccc" style="border-right: 2px solid #bfbfbf; font-family: Arial, Helvetica, sans-serif; padding-left: 5px; text-align: center; vertical-align: middle; padding-bottom: 4px; padding-top: 4px; font-size: 12px; line-height: 20px; color: #3c3c3c; font-weight: bold;">Price:<br />
			                            <span style="font-family: Arial, Helvetica, sans-serif; padding-left: 0; padding-bottom: 10px; padding-top: 10px; font-size: 16px; line-height: 20px; color: #3c3c3c; font-weight: bold;">&pound;580</span></td>
			                        <td width="126" bgcolor="#cccccc" style="border-right: 2px solid #bfbfbf; font-family: Arial, Helvetica, sans-serif; padding-left: 5px; text-align: center; vertical-align: middle; padding-bottom: 4px; padding-top: 4px; font-size: 12px; line-height: 20px; color: #3c3c3c; font-weight: bold;">Discount:<br />
			                            <span style="font-family: Arial, Helvetica, sans-serif; padding-left: 0; padding-bottom: 10px; padding-top: 10px; font-size: 16px; line-height: 20px; color: #3c3c3c; font-weight: bold;">17%</span></td>
			                      </tr>
			                      <tr>
			                        <td colspan="2" width="230" style="font-family: Arial, Helvetica, sans-serif; padding-left: 0px; text-align: left; vertical-align: middle; padding-bottom: 4px; padding-top: 4px; font-size: 12px; line-height: 16px; color: #3c3c3c; font-weight: normal;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin molestie,   lacus ac vulputate pharetra, elit lorem porttitor tortor, ut porttitor   tortor urna et turpis. ...<a href="#" style="color:#6abce0; text-decoration:none;">Read more</a></td>
			                      </tr>
			                      <tr>
			         <td colspan="2" style="border-bottom: 3px solid #77d4fc;"><img src="'.SITE_URL.'images/spacer.gif" alt="" width="1" height="8" /></td>
			                      </tr>
			                        <tr>
			                        <td width="126" style="font-family: Arial, Helvetica, sans-serif; padding-left: 5px; text-align: left; vertical-align: middle; padding-bottom: 4px; padding-top: 4px; font-size: 12px; line-height: 20px; color: #8c8c8c; font-weight: bold;">Deal Ends:<br />
			                            <span style="font-family: Arial, Helvetica, sans-serif; padding-left: 0; padding-bottom: 10px; padding-top: 10px; font-size: 16px; line-height: 20px; color: #8c8c8c; font-weight: bold;">14:23 PM</span></td>
			                   <td width="126" align="center"><a href="#"><img src="'.SITE_URL.'images/check_btn.gif" alt="" width="91" height="30" border="0" /></a></td>
			                      </tr>
			                    </table></td>
			                  </tr>
			                </table></td>
			                <td width="310" align="left" valign="top"><table width="310" border="0" cellspacing="0" cellpadding="0" style="background-color: #f4f4f4; border: 4px solid #70d3fc;">
			                  <tr>
			                    <td><table width="254" border="0" align="center" cellpadding="0" cellspacing="0">
			                        <tr>
			                          <td colspan="2" style="font-family: Arial, Helvetica, sans-serif; padding-left: 5px; padding-bottom: 10px; padding-top: 10px; font-size: 12px; line-height: 20px; color: #3c3c3c; font-weight: bold;">Samsung LED/LCD HD   1080p 3D Television</td>
			                        </tr>
			                        <tr>
			                          <td colspan="2"><img src="'.SITE_URL.'images/ramada.jpg" alt="" width="252" height="172" /></td>
			                        </tr>
			                        <tr>
			                          <td width="126" bgcolor="#cccccc" style="border-right: 2px solid #bfbfbf; font-family: Arial, Helvetica, sans-serif; padding-left: 5px; text-align: center; vertical-align: middle; padding-bottom: 4px; padding-top: 4px; font-size: 12px; line-height: 20px; color: #3c3c3c; font-weight: bold;">Price:<br />
			                              <span style="font-family: Arial, Helvetica, sans-serif; padding-left: 0; padding-bottom: 10px; padding-top: 10px; font-size: 16px; line-height: 20px; color: #3c3c3c; font-weight: bold;">&pound;580</span></td>
			                          <td width="126" bgcolor="#cccccc" style="border-right: 2px solid #bfbfbf; font-family: Arial, Helvetica, sans-serif; padding-left: 5px; text-align: center; vertical-align: middle; padding-bottom: 4px; padding-top: 4px; font-size: 12px; line-height: 20px; color: #3c3c3c; font-weight: bold;">Discount:<br />
			                              <span style="font-family: Arial, Helvetica, sans-serif; padding-left: 0; padding-bottom: 10px; padding-top: 10px; font-size: 16px; line-height: 20px; color: #3c3c3c; font-weight: bold;">17%</span></td>
			                        </tr>
			                        <tr>
			                          <td colspan="2" width="230" style="font-family: Arial, Helvetica, sans-serif; padding-left: 0px; text-align: left; vertical-align: middle; padding-bottom: 4px; padding-top: 4px; font-size: 12px; line-height: 16px; color: #3c3c3c; font-weight: normal;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin molestie,   lacus ac vulputate pharetra, elit lorem porttitor tortor, ut porttitor   tortor urna et turpis. ...<a href="#" style="color:#6abce0; text-decoration:none;">Read more</a></td>
			                        </tr>
			                        <tr>
			         <td colspan="2" style="border-bottom: 3px solid #77d4fc;"><img src="'.SITE_URL.'images/spacer.gif" alt="" width="1" height="8" /></td>
			                        </tr>
			                        <tr>
			                          <td width="126" style="font-family: Arial, Helvetica, sans-serif; padding-left: 5px; text-align: left; vertical-align: middle; padding-bottom: 4px; padding-top: 4px; font-size: 12px; line-height: 20px; color: #8c8c8c; font-weight: bold;">Deal Ends:<br />
			                              <span style="font-family: Arial, Helvetica, sans-serif; padding-left: 0; padding-bottom: 10px; padding-top: 10px; font-size: 16px; line-height: 20px; color: #8c8c8c; font-weight: bold;">14:23 PM</span></td>
			                          <td width="126" align="center"><a href="#"><img src="'.SITE_URL.'images/check_btn.gif" alt="" width="91" height="30" border="0" /></a></td>
			                        </tr>
			                    </table></td>
			                  </tr>
			                </table></td>
			              </tr>
			            </table></td>
			          </tr>
			        </table></td>
			      </tr>
			      <tr>
			        <td>
					<table width="650" border="0" align="center" cellpadding="0" cellspacing="0"  style="background-color: #f4f4f4; border: 4px solid #70d3fc;">
			          <tr>
			            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
			              <tr>
			                <td width="36%"><table width="234" border="0" align="left" cellpadding="0" cellspacing="0" style="padding-left: 8px; padding-bottom: 10px; padding-top: 10px;">
			                  <tr>
			                    <td colspan="2"><img src="'.SITE_URL.'images/lake.jpg" alt="" width="234" height="158" /></td>
			                  </tr>
			                  <tr>
			                    <td width="126" bgcolor="#cccccc" style="border-right: 2px solid #bfbfbf; font-family: Arial, Helvetica, sans-serif; padding-left: 5px; text-align: center; vertical-align: middle; padding-bottom: 4px; padding-top: 4px; font-size: 12px; line-height: 20px; color: #3c3c3c; font-weight: bold;">Price:<br />
			                        <span style="font-family: Arial, Helvetica, sans-serif; padding-left: 0; padding-bottom: 10px; padding-top: 10px; font-size: 16px; line-height: 20px; color: #3c3c3c; font-weight: bold;">&pound;580</span></td>
			                    <td width="126" bgcolor="#cccccc" style="border-right: 2px solid #bfbfbf; font-family: Arial, Helvetica, sans-serif; padding-left: 5px; text-align: center; vertical-align: middle; padding-bottom: 4px; padding-top: 4px; font-size: 12px; line-height: 20px; color: #3c3c3c; font-weight: bold;">Discount:<br />
			                        <span style="font-family: Arial, Helvetica, sans-serif; padding-left: 0; padding-bottom: 10px; padding-top: 10px; font-size: 16px; line-height: 20px; color: #3c3c3c; font-weight: bold;">17%</span></td>
			                  </tr>
			                </table></td>
			                <td width="64%" align="left" valign="top">
							<table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top: 7px; padding-left: 6px; padding-right: 6px;">

							<tr>
							<td colspan="2" style="font-family: Arial, Helvetica, sans-serif; padding-left: 0; padding-bottom: 5px; padding-top: 3px; font-size: 16px; line-height: 20px; color: #3c3c3c; font-weight: bold;"><a href="#" style="color: #333333; text-decoration:none;">Scotlant: Minibreak for two with Breakfast and Wine for 99 at The Oban caledonian Hotel</a></td>
							</tr>
			                  <tr>
			                    <td colspan="2" style="font-family: Arial, Helvetica, sans-serif; padding-left: 0px; text-align: left; vertical-align: middle; padding-bottom: 4px; padding-top: 4px; font-size: 12px; line-height: 16px; color: #3c3c3c; font-weight: normal;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin molestie,   lacus ac vulputate pharetra, elit lorem porttitor tortor, ut porttitor   tortor urna et turpis. ...<a href="#" style="color:#6abce0; text-decoration:none;">Read more</a></td>
			                  </tr>
			                  <tr>
			                    <td colspan="2">&nbsp;</td>
			                  </tr>
			                  <tr>
			                    <td width="297"  style="font-family: Arial, Helvetica, sans-serif; padding-left: 0; padding-bottom: 10px; padding-top: 10px; font-size: 18px; line-height: 20px; color: #8c8c8c; font-weight: bold;">Deal ends : 16:23 PM </td>
			                    <td width="111"><a href="#"><img src="'.SITE_URL.'images/check_btn.gif" alt="" width="91" height="30" border="0" /></a></td>
			                  </tr>
			                </table></td>
			              </tr>
			            </table></td>
			          </tr>
			        </table></td>
			      </tr>
			      <tr>
			        <td><img src="'.SITE_URL.'images/spacer.gif" alt="" width="1" height="2" /></td>
			      </tr>
			      <tr>
			        <td><table width="650" border="0" align="center" cellpadding="0" cellspacing="0"  style="background-color: #f4f4f4; border: 4px solid #70d3fc;">
			          <tr>
			            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
			                <tr>
			                  <td width="36%"><table width="234" border="0" align="left" cellpadding="0" cellspacing="0" style="padding-left: 8px; padding-bottom: 10px; padding-top: 10px;">
			                      <tr>
			                        <td colspan="2"><img src="'.SITE_URL.'images/sunney.jpg" alt="" width="234" height="158" /></td>
			                      </tr>
			                      <tr>
			                        <td width="126" bgcolor="#cccccc" style="border-right: 2px solid #bfbfbf; font-family: Arial, Helvetica, sans-serif; padding-left: 5px; text-align: center; vertical-align: middle; padding-bottom: 4px; padding-top: 4px; font-size: 12px; line-height: 20px; color: #3c3c3c; font-weight: bold;">Price:<br />
			                            <span style="font-family: Arial, Helvetica, sans-serif; padding-left: 0; padding-bottom: 10px; padding-top: 10px; font-size: 16px; line-height: 20px; color: #3c3c3c; font-weight: bold;">&pound;580</span></td>
			                        <td width="126" bgcolor="#cccccc" style="border-right: 2px solid #bfbfbf; font-family: Arial, Helvetica, sans-serif; padding-left: 5px; text-align: center; vertical-align: middle; padding-bottom: 4px; padding-top: 4px; font-size: 12px; line-height: 20px; color: #3c3c3c; font-weight: bold;">Discount:<br />
			                            <span style="font-family: Arial, Helvetica, sans-serif; padding-left: 0; padding-bottom: 10px; padding-top: 10px; font-size: 16px; line-height: 20px; color: #3c3c3c; font-weight: bold;">17%</span></td>
			                      </tr>
			                  </table></td>
			                  <td width="64%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top: 7px; padding-left: 6px; padding-right: 6px;">
			                      <tr>
			                        <td colspan="2" style="font-family: Arial, Helvetica, sans-serif; padding-left: 0; padding-bottom: 5px; padding-top: 3px; font-size: 16px; line-height: 20px; color: #3c3c3c; font-weight: bold;"><a href="#" style="color: #333333; text-decoration:none;">Scotlant: Minibreak for two with Breakfast and Wine for 99 at The Oban caledonian Hotel</a></td>
			                      </tr>
			                      <tr>
			                        <td colspan="2" style="font-family: Arial, Helvetica, sans-serif; padding-left: 0px; text-align: left; vertical-align: middle; padding-bottom: 4px; padding-top: 4px; font-size: 12px; line-height: 16px; color: #3c3c3c; font-weight: normal;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin molestie,   lacus ac vulputate pharetra, elit lorem porttitor tortor, ut porttitor   tortor urna et turpis. ...<a href="#" style="color:#6abce0; text-decoration:none;">Read more</a></td>
			                      </tr>
			                      <tr>
			                        <td colspan="2">&nbsp;</td>
			                      </tr>
			                      <tr>
			                        <td width="297"  style="font-family: Arial, Helvetica, sans-serif; padding-left: 0; padding-bottom: 10px; padding-top: 10px; font-size: 18px; line-height: 20px; color: #8c8c8c; font-weight: bold;">Deal ends : 16:23 PM </td>
			                        <td width="111"><a href="#"><img src="'.SITE_URL.'images/check_btn.gif" alt="" width="91" height="30" border="0" /></a></td>
			                      </tr>
			                  </table></td>
			                </tr>
			            </table></td>
			          </tr>
			        </table></td>
			      </tr>
			      <tr>
			       <td style="border-bottom: 3px solid #77d4fc;"><img src="'.SITE_URL.'images/spacer.gif" alt="" width="1" height="8" /></td>
			      </tr>
			      <tr>
			        <td style="font-family: Arial, Helvetica, sans-serif; padding-left: 10px; padding-bottom: 10px; padding-top: 10px; font-size: 12px; line-height: 16px; color: #3c3c3c; font-weight: bold;">please add deals &copy; geelaza.com to your address book or sender list so our emails get to your inbox.</td>
			      </tr>
			    </table></td>
			  </tr>
			  <tr>
			    <td><table width="670" border="0" align="center" cellpadding="0" cellspacing="0" style="padding: 8px 0 0 0;">
			      <tr>
			        <td width="516" bgcolor="#ddedcc" style="font-family: Arial, Helvetica, sans-serif; padding-left: 10px; padding-bottom: 10px; padding-top: 10px; font-size: 12px; line-height: 16px; color: #3c3c3c; font-weight: normal;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. <a href="#" style="color:#FF0000; text-decoration:none;">more read</a></td>
			        <td width="115" align="left" valign="top" bgcolor="#ddedcc" style="padding-top: 10px;"><table width="130" border="0" cellspacing="0" cellpadding="0">
			          <tr>
			            <td width="69" style="font-family: Arial, Helvetica, sans-serif; padding-left: 10px; padding-bottom: 10px; padding-top: 10px; font-size: 12px; line-height: 16px; color: #3c3c3c; font-weight: bold;">Follow us:</td>
			            <td width="22"><img src="'.SITE_URL.'images/facebook.png" alt="" width="17" height="18" /></td>
			            <td width="24"><img src="'.SITE_URL.'images/twitter.png" alt="" width="17" height="18" /></td>
			          </tr>
			        </table></td>
			      </tr>
			      <tr>
			        <td colspan="2" style="font-family: Arial, Helvetica, sans-serif; text-align: center; padding-left: 10px; padding-bottom: 10px; padding-top: 10px; font-size: 12px; line-height: 16px; color: #3c3c3c; font-weight: bold;">You have received this email because you have subscribed to GeeLaza deal newsletter. You can unsubscribe
			by clicking <a href="#" style="color:#FF0000;">here</a>.</td>
			      </tr>
			      <tr>
			        <td colspan="2" bgcolor="#FFFFFF" style="font-family: Arial, Helvetica, sans-serif; text-align: center; padding-left: 10px; padding-bottom: 10px; padding-top: 10px; font-size: 12px; line-height: 16px; color: #3c3c3c; font-weight: bold;"><a href="#" style="color: #333333; text-decoration: none;">&copy; GeeLaza.com</a> | <a href="#" style="color: #333333; text-decoration: none;">Terms & Conditions</a> | <a href="#" style="color: #333333; text-decoration: none;">About GeeLaza</a></td>
			      </tr>
			    </table></td>
			  </tr>
			</table>

	';

//	echo $Template;

	if (isset($Template)) {
				//$to  = $to;

				$subject = "Welcome to GeeLaza.com ";

				$sql="SELECT * FROM ".TABLE_ADMIN." where admin_name='admin'";
				$admin=$db->query_first($sql);

				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= "From: GeeLaza.com<admin@geelaza.com>". "\r\n" ;

				@mail($to,$subject,$Template,$headers);
	}


}

/** get_credits() to get credits of a user
 * @author Aditya Jyoti Saha
 *
 **/
function get_credits($u_id) {
	$sql = "SELECT SUM(credit) FROM ".getdeals_credits." WHERE user = $u_id";
	$credits = mysql_fetch_array(mysql_query($sql));
	return $credits[0];

}

/**
 * Check if user is logged in or not.
 * @name isLogin()
 * @author Aditya Jyoti Saha
 */
function isLogin() {
	if (!isset($_SESSION['fb_id'])) {
		header("location:".SITE_URL."customer-login.php");
		exit();
	}
}

/** Function to validate email with PHP
 * @author Aditya Jyoti Saha
 *
 * */
function ValidateEmail($email) {
	//$email = "someone@example.com";

	if(eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) {
	  //echo "Valid email address.";
	  return TRUE;
	}
	else {
	  //echo "Invalid email address.";
	  return FALSE;
	}
}

/**
 * Get the setting paramiter.
 * @param str $param
 */
function getSettings($param) {
	$sqlSettings = "SELECT * FROM ".TABLE_SETTING." WHERE name = '$param'";
	$settings = mysql_fetch_array(mysql_query($sqlSettings));
	return $settings['value'];
}

function getUserDetails($userId) {
	if ($userId == '') {
		$userId = $_SESSION['user_id'];
	}
	$sqlUserDetails = "SELECT * FROM ".TABLE_FB_USER." WHERE user_id = $userId";
	$userDetails = mysql_fetch_array(mysql_query($sqlUserDetails));
	return $userDetails;
}

/**
 * Measure compiatablity rating of logged in user with other users<br/><br/>
 * <b>SET Theorem</b><br/>A = {a1, a2, a3, a4, a5, a6}<br/>
 * B = {b1, b2, a1, a2}<br/>B -> A = 2/4 = 50%<br/>A -> B = 2/6 = 33.33%<br/><br/><b>Weighted Average Method</b><br/>(A*Wmu+B*Wmo)/(Wmu+Wmo)
 * @author Aditya Jyoti Saha
 * @param $user_id
 **/
function comp_user($user_id) {
	$loginUserId = $_SESSION['user_id'];
	$loginUserFbId = $_SESSION['fb_id'];

	$currentUser = getUserDetails();
	$currentUserMusic = explode(',', $currentUser['music']);
	$currentUserMusic_count = count($currentUserMusic);

	$currentUserMovie = explode(',', $currentUser['movies']);
	$currentUserMovie_count = count($currentUserMovie);

	//var_dump($currentUserLikes);
	//echo '------------------------------------------------------------<br><br><br>';

	$sqlUser = "SELECT id, user_id, fb_id, name, likes FROM ".TABLE_FB_USER." WHERE user_id = $user_id";
	$UserRow = mysql_fetch_array(mysql_query($sqlUser));

	//echo '<pre>'.print_r($UserRow['likes'], true).'</pre>';

	$comp_user_rating = array_change_key_case(explode(',', $UserRow['music']), CASE_LOWER );
	$comp_user_rating_count = count($comp_user_rating);

	//var_dump($comp_user_rating);
	//echo '------------------------------------------------------------<br><br><br>';

	/*	Used for SET Theorem & Squared Average method
	 * $i = 0;
		foreach ($comp_user_rating as $value) {
			if (in_array($value, $currentUserLikes)) {
				//echo $value.'<br/>';
			}
			$matched = $i++;
		}
	 */
	//if ($matched <= 0) : $matched = 1; endif;

	$comp_rate = (($currentUserMusic_count*getSettings(weight_music))+($currentUserMovie_count*getSettings(weight_movie)))/(getSettings(weight_music)+getSettings(weight_movie)); // Using Weighted Average
	//$comp_rate = round($matched*100/$comp_user_rating_count); // Using SET Theorem
	//$comp_rate = round(((sqrt($comp_user_rating_count) + sqrt($currentUserLikes_count))* $matched)/100);	// (67+33*66) // Using Sqaured average

	//echo '================'.$comp_rate;
	return $comp_rate;
}


/**
 *
 * Get the id from the URL sent using GET method
 * @author Aditya Jyoti Saha
 * @param string $var
 * @uses Pass the $_Get variable name in $var
 */
function GetIdFromUrl($var) {
	$maskedVar = '?'.$var.'-';
	$url = $_SERVER['REQUEST_URI'];
	$id = end(explode($maskedVar, $url));
	return $id;
}


?>