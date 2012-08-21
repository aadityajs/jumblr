<?php 
error_reporting(E_ERROR && E_STRICT);
include("include/header.php");
session_start();
ob_start();
?>

<?php 
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
?>
<?php 

if ($_GET['item'] != "")  {
	$prod_id = $_GET['item'];
	
	$sql_prod = "SELECT * FROM ".TABLE_DEALS." WHERE status >= 1 AND deal_id = '".$prod_id."' LIMIT 0, 1";
	$prod_res = mysql_fetch_array(mysql_query($sql_prod));
	
	
	/*$sql_todays_buy = "SELECT SUM(qty) FROM ".TABLE_TRANSACTION." WHERE deal_id = ".$today_res['deal_id'];
	$total_buy = mysql_fetch_array(mysql_query($sql_todays_buy));
	
	$sql_todays_image = "SELECT * FROM ".TABLE_DEAL_IMAGES." WHERE deal_id = ".$today_res['deal_id'];
	$todays_image = mysql_fetch_array(mysql_query($sql_todays_image));*/
}

?>

<div class="howitwork">
<div class="how_top">
<p>YOUR ORDER</p>
</div>
<div class="clear"></div>
<div class="clear"></div>
<div class="how_bot">

   <div class="white-container" style="width:93%; margin: 15px auto 0 auto; background:#fff;">	
			<div>
               <div class="start_savings"></div>
            	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="cart_box2">
                  <tr>
                    <td colspan="4" style="font: bold 15px/26px Arial, Helvetica, sans-serif;"><strong></strong></td>                   
                  </tr>
                  <tr>
                    <th width="530"><strong>Products Information</strong></th>
                    <th width="100"><strong>Quantity</strong></th>
                    <th width="40"><strong></strong></th>
                    <th width="120"><strong>Price</strong></th>
                    <th width="40"><strong></strong></th>
                    <th width="200"><strong>Total</strong></th>
                  </tr>
                  <tr class="gray_01">
                    <td><?php echo strip_tags($prod_res['title']); ?></td>
                    <td>
                    	<select name="amount" id="" onchange="ajaxReq(this.value);">
						<?php for ($i = 1; $i <= 30; $i++) { ?>
						<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						<?php } ?>
						</select>
                    </td>
                     <td>x</td>
                    <td>&pound; <?php echo strip_tags($prod_res['discounted_price']); ?></td>
                    <td>=</td>
                    <td><div id="total_price">&pound; <?php echo strip_tags($prod_res['discounted_price']); ?></div></td>
                  </tr>
                 
                  <tr>
                    <td colspan="3" style="font: bold 15px/26px Arial, Helvetica, sans-serif; text-align:right;">Total Cost = </td>
                    <td style="font: bold 15px/26px Arial, Helvetica, sans-serif; text-align:right; text-align:left; padding-left:10px;">
                    	<div id="big_total_price">&pound; <?php echo strip_tags($prod_res['discounted_price']); ?></div> 
                    	<?php //echo $_SESSION['total_price']; ?>
                    </td>
                  </tr>
                </table>
            </div>		
			
	    </div>

 <div class="white-container" style="width:93%; margin: 15px auto 0 auto; background:#fff;">	
 
		<div style="width:620px; margin-right:0px; float:left;">
            <form name="cust_login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"  onsubmit="javascript: return ValidateLoginForm();" style="margin:0px; padding:0px;">
            <!--<h6 style="margin: -22px 0 6px 0; background:none; z-index: 1000;">Already have an Account?</h6>-->
            <!-- Login form starts --> 
            
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="loginBoxnew2">
              <tr>
                <td class="lb_top2">&nbsp;</td>
              </tr>
              <tr>
                <td class="lb_mid2"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="blue_box" style="width:100%; background: none; border: none;">
                   <tr>
                     <td>
                    
                     <table width="600" border="0" align="center" cellpadding="3" cellspacing="3">
                         <tr>
                         <td colspan="3"><p style="line-height: 20px; font-size: 20px; font-family: Georgia, 'Times New Roman', Times, serif; color: #363636; margin-bottom:-10px; padding-top: 10px;">Already have an Account?</p>
                            
                            <?php
            
                            if($flag == 1)
                            {
                                ?>
                                <div style="width:100%; height:auto; background-color:transparent;padding-top:4px; padding-left:0px;">
                                <label style="color:red;"><?php //echo "* ".$msg; ?>(-) Email address or password  is incorrect!</label>
                                </div>
                                <?php
                            }
                            ?>
                         </td>
                       </tr>
                       <tr>
                         <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                           <tr>
                             <td width="51%">Email Address</td>
                             <td width="49%">Password</td>
                           </tr>
                           <tr>
                             <td>
                             <div id='cust_login_lemail_errorloc' class="error"></div>
                             <input type="text" name="lemail" id="lemail" onblur="javascript: return validateEmail(this.value);"  value="<?php //if(isset($_POST) && $flag==1){ echo $_POST["lemail"];} ?>"class="text_box1" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/></td>
                             <td>
                             <div id='cust_login_lpassword_errorloc' class="error"></div>
                             <input type="password" name="lpassword" id="lpassword" class="text_box1" <?php if ($flag ==1) {echo 'style="border:1px solid red;"';} ?>/></td>
                           </tr>
                         </table></td>
                       </tr>
                       <tr>
                         <td width="127"><input type="submit" name="btnLogin" value="Log In" class="log_in" style="cursor:pointer; font-size:20px;" /></td>
                         <td width="22"><!--<input type="checkbox" name="checkbox" value="checkbox"/>--></td>
                         <td width="451"><!--Login automatically--></td>
                       </tr>
                       <tr>
                         <td colspan="3" class="forgot_password"><a href="<?php echo SITE_URL; ?>forgetpassword.php" style="color: blue; font-size:9px; font-family:Arial, Helvetica, sans-serif; ">Forgot your password?</a> </td>
                       </tr>
                     </table>
                
                     </td>
                   </tr>
                   <tr>
                   <td style="padding: 0 0 0 13px;"><span class="black_text" style="color:#3A3B3D;"><img src="images/spacer.gif" alt="" width="8" height="1"/>if you have an account on Facebook you can use it to log in.</span>
            <?php if ($cookie) { ?>
            <fb:login-button scope="email" autologoutlink="true" onlogin="window.location.reload()"></fb:login-button>
            <?php unset($_SESSION['fbuser']); ?> 
            <?php } else { ?><br />
            <span style="padding-left: 22px;"><fb:login-button scope="email" autologoutlink="true">Connect</fb:login-button></span>
            <?php } ?>
            <br/><br/></td>
                   </tr>
                 </table></td>
              </tr>
              <tr>
                <td class="lb_bottom2">&nbsp;</td>
              </tr>
            </table>
            <!-- Login form ends -->      
            </form>
        <div class="clear"></div>
        </div>
            
           <div class="how_right" style="float:right; margin: 15px 0 0 0;">
            <div class="right_grey">
            <p>What we say is what we do </p>
            </div>
            <div class="right_grey">
            <div><span>Quakty merchants - All our deals are handipicked by our GetDeala team to give the quality you deserve. </span></div>
            <div><img src="images/spacer.gif" alt="" width="1" height="18"/></div>
            </div>
            <div class="right_grey">
            <div><span>No lies - you have signed up for great deals, then thats what we will bring to you only.</span></div>
            <div><img src="images/spacer.gif" alt="" width="1" height="18"/></div>
            </div>
    </div>

                <div class="clear"></div>
                <h6 style="margin: 15px 0 15px 0; background:none; font-size:24px; text-align:left;" >Register Now</h6>
                <div class="register_box2">
                
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td style="vertical-align:top; padding:0px;">
                     <table width="100%" border="0" cellspacing="0" cellpadding="0" class="leftfrom">    
                    <tr>
                    <td style="padding:0px;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                    <td colspan="2"><h6 style="float:left; line-height:0px; padding:16px 0 16px 0;">Address</h6> <span style="float:right; margin:0 15px 0 0;">( required field <span class="red">*</span>)</span></td>
                    </tr>
                    <tr>
                        <td colspan="2">Title <span class="red">*</span></td>
                      </tr>
                      <tr>
                        <td width="50%"><select name="select" id="select">
                          <option>Please Select</option>
                        </select>        </td>
                        <td width="68%">&nbsp;</td>
                      </tr>      
                      <tr>      </tr>
                     <tr>
                            <td width="50%">First Name<span class="red">*</span></td>
                            <td width="50%">Last Name<span class="red">*</span></td>
                          </tr>
                          <tr>
                            <td><input type="text" name="textfield22" class="text_box123 size_140"/></td>
                            <td><input type="text" name="textfield23" class="text_box123 size_140"/></td>
                          </tr>
                          
                      <tr>
                        <td colspan="2">Street Address <span class="red">*</span></td>
                      </tr>
                      <tr>
                        <td colspan="2"><input type="text" name="textfield222" class="text_box123"/></td>
                      </tr>
                      <tr>
                        <td colspan="2">Street Address2<span class="red"></span></td>
                      </tr>
                      <tr>
                        <td colspan="2"><input type="text" name="textfield222" class="text_box123"/></td>
                      </tr>
                      <tr>
                        <td>Town City <span class="red">*</span></td>
                        <td>Country <span class="red">*</span></td>
                      </tr>
                      <tr>
                        <td><input type="text" name="textfield226" class="text_box123 size_140"/></td>
                        <td><input type="text" name="textfield227" class="text_box123 size_140"/></td>
                      </tr>
                      <tr>
                        <td colspan="2">Email Address <span class="red">*</span></td>
                      </tr>
                      <tr>
                        <td colspan="2"><input type="text" name="textfield3" class="text_box123"/></td>
                      </tr>
                      <tr>
                        <td colspan="2">Phone No <span class="red">*</span></td>
                      </tr>
                      <tr>
                        <td colspan="2"><input type="text" name="textfield4" class="text_box123"/></td>
                      </tr>
                       <tr>
                        <td colspan="2">Date of Birth <img src="images/question.png" alt="" /></td>
                      </tr>
                      <tr>
                        <td width="32%" colspan="2">
                        <select name="select" id="select">
                          <option>Day</option>
                        </select> 
                        <select name="select" id="select">
                          <option>Month</option>
                        </select>  
                        <select name="select" id="select">
                          <option>Year</option>
                        </select>        </td>
                      </tr>
                      <tr>
                        <td>Password <span class="red">*</span></td>
                        <td>Confirm Password <span class="red">*</span></td>
                      </tr>
                      <tr>
                        <td><input type="text" name="textfield226" class="text_box123 size_140"/></td>
                        <td><input type="text" name="textfield227" class="text_box123 size_140"/></td>
                      </tr>
                      <tr>
                       <td style="font-size:11px;" colspan="2">
                            <span style="float:left; line-height:20px; padding-right:10px;">Have Facebook Account? Use it to sign to GetLazz</span> <span style="float:left;"><img src="images/login.gif" alt="" /></span></td>
                       </tr>
                       <tr>
                       <td colspan="2">&nbsp;
                             </td>
                       </tr>
                    </table></td>
                    </tr>
                     </table>
                    </td>
                    <td style="vertical-align:top;  padding:0px;">
                     <table width="100%" border="0" cellspacing="0" cellpadding="0" class="leftfrom" style="float:right; height:636px;">
                    <tr>
                    <td style="vertical-align:top;  padding:0px;">    
                
                <!-- Payment table starts -->   
                   
                    <table width="100%" border="0" cellspacing="0" cellpadding="0"> 
                     <tr>
                        <td colspan="2"><h6 style="float:left; line-height:0px; padding:16px 0 16px 0;">payment Information</h6> </td>
                     </tr>
                      <tr>
                        <td width="100%" colspan="2">Credit/Debit Card <span class="red">*</span></td>
                      </tr>
                      <tr>
                        <td><input type="text" name="textfield4" class="text_box123 size_140" /></td>
                        <td><input type="text" name="textfield4" class="text_box123 size_140"/></td>
                      </tr>
                      <tr>
                        <td width="100%" colspan="2">Card No<img src="images/question.png" alt="" /></td>
                      </tr>
                      <tr>
                        <td colspan="2">
                         <input type="text" name="textfield4" class="text_box123 " style="width:90px;"/>
                         <input type="text" name="textfield4" class="text_box123 " style="width:90px;"/>
                         <input type="text" name="textfield4" class="text_box123 " style="width:90px;"/>
                         <input type="text" name="textfield4" class="text_box123 " style="width:88px;"/>        </td>
                      </tr>  
                       <tr>
                            <td width="40%">Security Code <img src="images/question.png" alt="" /></td>
                            <td width="50%">Expiry Date<span class="red">*</span></td>
                          </tr>
                          <tr>
                            <td><input type="text" name="textfield22" class="text_box123 size_140" /></td>
                            <td><select name="select2" id="select2">
                              <option>01</option>
                                        </select>
                              <select name="select2" id="select2">
                                <option>2011</option>
                                            </select></td>
                          </tr>    
                      <tr>
                        <td><input type="radio" name="payment_system" id="radio" value="radio" />
                          Maestro <img src="images/payment_icon01.png" alt="" width="22" height="14" /></td>
                        <td style="font-size:11px;"><span class="blue">*</span> Your Policy is assured </td>
                      </tr>    
                      <tr>
                        <td colspan="2"><input type="radio" name="payment_system" id="amex" value="radio2" />
                          Amirican Express <img src="images/payment_icon02.png" alt="" width="22" height="14" /> </td>
                      </tr>
                       <tr>
                        <td><input type="radio" name="payment_system" id="paypal" value="paypal" />
                          Paypal </td>
                        <td style="font-size:11px;"><span class="blue">*</span> Shop with confidence with getLaza </td>
                      </tr>
                      <tr>
                        <td><img src="images/payment_icon03.png" alt="" width="128" height="18" /></td>
                        <td style="font-size:11px;"><span class="blue">*</span>  get amazing deals Discounted price</td>
                      </tr>
                      <tr>
                        <td colspan="2" style="font-size:11px;">how all this mistaken idea of <a href="#">pleasure and</a> praising pain Policy is assured</td>
                      </tr>
                       <tr>
                        <td colspan="2">
                            <?php
		                    //$amount = $_SESSION['total_price'];
		                    $user_id = $_SESSION["user_id"];
		                    
		                    $deal_id = $prod_res['deal_id'];
		                    //$qty = $_SESSION['qty'];
		                    $trn_date = date("Y-m-d H:i:s");
		                   
		                    
		                    echo $message="<form action=\"https://www.sandbox.paypal.com/cgi-bin/webscr\" method=\"post\">
		                    <input type=\"hidden\" name=\"notify_url\" value=\"http://unifiedinfotech.net/getdeals/paypal_ipn.php\">
		                    <input type=\"hidden\" name=\"cmd\" value=\"_xclick\">
		                    <input type=\"hidden\" name=\"business\" value=\"santan_1313669535_biz@unifiedwebdevelopment.com\">
		                    <input type=\"hidden\" name=\"item_name\" value=\"Paypal test service\">
		                    <input type=\"hidden\" id=\"frm_paypal_total_qty\" name=\"item_number\" value=\"LDC-PTS\">
		                    <input type=\"hidden\" id=\"frm_paypal_total_price\" name=\"amount\" value=\"$prod_res[discounted_price]\">
		                    <input type=\"hidden\" name=\"page_style\" value=\"Primary\">
		                    <input type=\"hidden\" name=\"no_shipping\" value=\"1\">
		                    <input type=\"hidden\" name=\"return\" value=\"http://unifiedinfotech.net/getdeals/thankyou.php\">
		                    <input type=\"hidden\" name=\"cancel_return\" value=\"http://unifiedinfotech.net/getdeals/cancel.php\">
		                    <input type=\"hidden\" name=\"no_note\" value=\"1\">
		                    <input type=\"hidden\" name=\"currency_code\" value=\"USD\">
		                    <input type=\"hidden\" name=\"custom\" value=\"".$user_id.",".$deal_id.",".$trn_date."\"> <p>            
		                    <p>
		                    <input type=\"submit\" name=\submit\" value=\"Buy Deal\" class=\"reset_btn2\" style=\"cursor:pointer; font-size:20px;\">
		                    </p>
		                    </form>";
		                    //<input type=\"submit\" name=\submit\" value=\"Pay\">
		                   
		                    
		                    ?>
                            <!--<input type="submit" name="submit" value="Buy Deal" class="reset_btn2" style="cursor:pointer; font-size:20px;" />-->
                             
                          </td>
                      </tr>
                      <tr>
                        <td colspan="2">&nbsp;
                           
                          </td>
                      </tr>
                    </table>    
                    
                    <!-- Payment table ends -->
                    
                    </td>
                    </tr> 
                  </table>
                    </td>
                  </tr>
                </table>
                  
                  <div>&nbsp;</div>
                </div>
                            
            	
			<div class="white-tl"></div>
			<div class="white-bl"></div>
			<div class="white-tr"></div>
			<div class="white-br"></div>
	    </div>
    <div>&nbsp;</div>
   
<div class="clear"></div>
</div>
<div class="curve_bot"></div> 
</div>










<script type="text/javascript">

function total_price(qty) {
	var single_price = <?php echo strip_tags($prod_res['discounted_price']); ?>;
	//alert (single_price);
	var total_price = single_price*qty;
	
	document.getElementById('total_price').innerHTML = '&pound; '+total_price;
}


function ajaxReq(str)
{
var xmlhttp;
//alert(str); die();
if (str.length==0)
  { 
  document.getElementById("total_price").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("total_price").innerHTML=xmlhttp.responseText;
    document.getElementById("big_total_price").innerHTML=xmlhttp.responseText;
    document.getElementById("frm_paypal_total_price").value=xmlhttp.responseText;
    document.getElementById("frm_paypal_total_qty").value=str;
    }
  }
xmlhttp.open("GET","ajax_payment.php?qty="+str+"&id="+<?php echo $prod_id; ?>,true);
xmlhttp.send();
}

</script>



</div>
</div>
</div>
</div>
<?php include ('include/footer.php'); ?>