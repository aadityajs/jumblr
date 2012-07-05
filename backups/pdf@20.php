<?php
ob_start();
//	 && $_REQUEST['price'] != ""  && $_REQUEST['valid'] != ""  && $_REQUEST['img'] != "" 

if ($_REQUEST['deal_title'] != "" && $_REQUEST['c_code'] != ""  && $_REQUEST['price'] != ""  && $_REQUEST['valid'] != ""  && $_REQUEST['img'] != "" ) {
	
	$deal_title = htmlentities($_REQUEST['deal_title']);
	$c_code = $_REQUEST['c_code'];
	$price = $_REQUEST['price'];
	$valid = $_REQUEST['valid'];
	$img = $_REQUEST['img'];
	
}


$html = '

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

';

//echo $html;
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