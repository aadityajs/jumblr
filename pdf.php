<?php
ob_start();
//	 && $_REQUEST['price'] != ""  && $_REQUEST['valid'] != ""  && $_REQUEST['img'] != ""

//if ($_REQUEST['deal_title'] != "" && $_REQUEST['c_code'] != ""  && $_REQUEST['price'] != ""  && $_REQUEST['valid'] != ""  && $_REQUEST['img'] != "" ) {

	$deal_title = strip_tags(htmlentities($_REQUEST['deal_title']));
	$c_code = $_REQUEST['c_code'];
	$price = $_REQUEST['price'];
	$s_valid = $_REQUEST['s_valid'];
	$e_valid = $_REQUEST['e_valid'];
	$img = $_REQUEST['img'];

//}

$html = '

<table width="760" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
    <td align="center" valign="top"><img src="images/pdf_img/headerbg1.jpg" alt="" width="860" height="95" /></td>
  </tr>
  <tr>
 <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-bottom:1px solid #5e5e5e; border-left:1px solid #5e5e5e; border-right:1px solid #5e5e5e;">
      <tr>
        <td><table width="750" border="0" align="center" cellpadding="0" cellspacing="0" style="margin:30px;">
          <tr>
            <td align="left" valign="top" style="font-family:Courier New, Courier, monospace; text-align:left; line-height:19px; color:#000; font-size:20px; font-weight: normal; font-smooth: always; padding-bottom:10px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="74%" height="180" align="left" valign="top"  style="font-family: Arial, Helvetica, sans-serif;"><p><strong>This GeeLaza Deal Entiies The Bearer To:</strong></p><br /> <p style="font-size:14px; color:#626262;">'.$deal_title.' (Worth &pound;'.$price.') </p><br />
                    <p style="font-size:16px; color:#4e4e4e; font-weight: bold;">GeeLaza value: &pound;39.98</p></td>
                  <td width="26%" align="center" valign="middle"><img src="'.$img.'" width="233" height="178" /></td>
                </tr>
            </table></td>
          </tr>          
          <tr>
       <td align="left" valign="top"  style="line-height:28px; color:#000; font-size:18px; font-weight: normal; font-smooth: always; text-align:center; vertical-align:middle; border-bottom:1px dashed #7f7f7f; letter-spacing: 1px; border-top:1px dashed #7f7f7f; padding:10px 0; font-family: "CopperplateGothicLightRegular";"><center>
<p style="font-family: "CopperplateGothicLightRegular";">YOUR GEELAZA CODE: <span style="font-family: \'CalibriBold\'; font-size:18px; color:#000000; padding:10px 0; line-height:30px; font-weight: bold;">'.$c_code.'</span><br /><span style="font-size:18px;">Valid from: '.$s_valid.' to '.$e_valid.'</span></p>
</center></td>
          </tr>
          <tr>
            <td align="left" valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">                
                <tr>
                  <td style="font-family: Arial, Helvetica, sans-serif; text-align:left; line-height:22px; color:#474747; font-size:13px; font-weight: normal; padding:15px 0;">
                  	<b>How To Redeem:</b><br/>
                   <span style="font-family: Arial, Helvetica, sans-serif; text-align:left; line-height:18px; color:#474747; font-size:13px; font-weight: normal; font-smooth:always; padding:15px 0;">To redeem, just visit http://www.example.co.uk/index/main_main order and once you get there, enter you GeeLaza Code (copy it from above) at the checkout stage. See fine print for voucher activation details. See the rules for all deals at: www.geelaza.com/universal-fine-print.</span><br />
<br />
<br />
This is how it works
                   </td>
                </tr>
                <tr>
                	<td>
                    	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="width:100%; margin:0 auto;">
                          <tr>
                            <td><img src="images/pdf_img/1.jpg" alt=""  /></td>
                            <td style="color:#00b0f0; font-size:12px; white-space:nowrap;">Copy voucher code</td>
                            <td><img src="images/pdf_img/2.jpg" alt="" /></td>
                            <td style="color:#00b0f0; font-size:12px; white-space:nowrap;">Enter code into the voucher field <br />  on the deal offerers website</td>                            
                            <td><img src="images/pdf_img/3.jpg" alt=""  /></td>
                            <td style="color:#00b0f0; font-size:12px;">Redeem and enjoy</td>
                          </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                  <td   style="font-family:Arial, Helvetica, sans-serif; text-align:left; line-height:18px; color:#626262; font-size:14px; font-weight: normal; font-smooth:always; padding:15px 0;">
                    <b>Fine print </b><br />
                    One per person.<br />
                    May buy multiples as gifts.<br />
                    Voucher valid for 2 months.<br />
                    Postage costs an additional £3.99.<br />
                    Please allow 28 days for delivery after redeeming your deal.</td>
                </tr>
            </table></td>
          </tr>         
          <tr>
            <td height="40" align="left" valign="middle" style="font-family: Arial, Helvetica, sans-serif; text-align:left; line-height:18px; color:#000; font-size:11px; font-weight: normal; font-smooth: always; border-bottom:1px dashed #7f7f7f; border-top:1px dashed #7f7f7f; padding:10px 0"><span style="color:#505050">Your GeeLaza deal is unique to you; it has a unique GeeLaza code. It is very important that you keep it safe. Your GeeLaza deal can only be used once, so ensure that it is you who uses it. Treat your GeeLaza deals like you would treat your credit card, do NOT let anybody copy it.</span></td>
          </tr>          
          <tr>
            <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; text-align:left; line-height:18px; color:#000; font-size:13px; font-weight: normal; font-smooth: always;">&nbsp;</td>
          </tr>
            <tr>
            <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; text-align:left; line-height:18px; color:#000;  font-size:12px; font-weight: normal; font-smooth: always;"><p style="color:#666666"><b>Got any questions?</b><br />
             <span style="color:#666666">Email us: support@geelaza.com</span><br /><br />
               <span style="color:#666666;  font-size:9px;">Right to cancel</span><br />
              <span style="color:#666666;  font-size:9px;">Once we send you the GeeLaza, you may cancel the transaction at any time within 5 working days from the day after the day that you receive the GeeLaza (where a working day is any day that is not a Saturday, Sunday or public holiday). If you do want to cancel, you must do so by sending us an email to tell us you are cancelling to: support@geelaza.com - always provided of course that you have not yet redeemed the Voucher. Alternatively you can fill out the online Refund form on our site.</span></p></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  </table>
 
';

//echo $html;

/*$html = '

<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="18%" bgcolor="#000000"><img src="images/logo.gif" width="171" height="107" /></td>
    <td width="82%" bgcolor="#0E0E0E">&nbsp;</td>
  </tr>
</table>

<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="26%" align="center" valign="middle"  style="border-bottom:1px solid black;"><h3><span style="font-family: Verdana, Arial, Helvetica, sans-serif"><span style="font-family: Arial, Helvetica, sans-serif"><span style="font-size: medium"></span></span></span></h3></td>
    <td width="35%" align="center" valign="middle" style="border-bottom:1px solid black;"><h3 style="font-family: Arial, Helvetica, sans-serif;font-size: medium;font-weight: bold;">Deal Information </h3></td>
    <td width="21%" align="center" valign="middle" style="border-bottom:1px solid black;"><h3 style="font-family: Arial, Helvetica, sans-serif;font-size: medium;font-weight: bold;">Coupon Code </h3></td>
    <td width="18%" align="center" valign="middle" style="border-bottom:1px solid black;"><h3 style="font-family: Arial, Helvetica, sans-serif;font-size: medium;font-weight: bold;">Price</h3></td>
  </tr>
  <tr>
    <td style="border-right: none;">&nbsp;</td>
    <td valign="top"  style="border-right:0;">&nbsp;</td>
    <td valign="top"  style="border-right:0;">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td style="border-right: none;"><div align="center" style="font-family: Arial, Helvetica, sans-serif; font-size: small;"><img src="'.$img.'" width="182" height="108" /></div></td>
    <td valign="top"  style="border-right:0;">

		<a href="http://aditya/getdeals/index.php?action=view&amp;id=60" style="font-family: Arial, Helvetica, sans-serif; font-size: small;"> <strong>'.$deal_title.'</strong></a>	</td>
    <td valign="top"  style="border-right:0;"><div align="center"><span style="font-family: Arial, Helvetica, sans-serif; font-size: small;">'.$c_code.'</span></div></td>
    <td valign="top"><div align="center"><span style="font-family: Arial, Helvetica, sans-serif; font-size: small;">Price of Deal: &pound; '.$price.' </span></div></td>
  </tr>
  <tr>
    <td style="border-bottom:1px solid black;">&nbsp;</td>
    <td valign="top" style="border-bottom:1px solid black;">&nbsp;</td>
    <td colspan="2" valign="top" style="font: 11px/20px Tahoma, Arial, Helvetica, sans-serif; color: red; border-bottom:1px solid black;">Valid untill '.$valid.'</td>
  </tr>
</table>
<br />
<br />
<br />
<p>On '.date("F j, Y, g:i a").'</p>

';*/


//==============================================================
//==============================================================
//==============================================================


include("plugin/mpdf/mpdf.php");

$mpdf=new mPDF();

$mpdf->WriteHTML($html);
$mpdf->Output();
exit;

//==============================================================
//==============================================================
//==============================================================


?>
<style>
@font-face {
    font-family: 'CalibriBold';
    src: url('fonts/calibrib-webfont.eot');
    src: url('fonts/calibrib-webfont.eot?#iefix') format('embedded-opentype'),
         url('fonts/calibrib-webfont.woff') format('woff'),
         url('fonts/calibrib-webfont.ttf') format('truetype'),
         url('fonts/calibrib-webfont.svg#CalibriBold') format('svg');
    font-weight: normal;
    font-style: normal;
	

}

@font-face {
    font-family: 'CopperplateGothicLightRegular';
    src: url('fonts/coprgtl-webfont.eot');
    src: url('fonts/coprgtl-webfont.eot?#iefix') format('embedded-opentype'),
         url('fonts/coprgtl-webfont.woff') format('woff'),
         url('fonts/coprgtl-webfont.ttf') format('truetype'),
         url('fonts/coprgtl-webfont.svg#CopperplateGothicLightRegular') format('svg');
    font-weight: normal;
    font-style: normal;

}

.copper{
font-family: 'CopperplateGothicLightRegular';
font-size: 38px;
}
</style>