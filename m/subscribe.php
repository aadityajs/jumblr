<?php
include("include/subscribe_header.php");

if(strtolower($_SERVER['REQUEST_METHOD'])=='post')
{
	$cookie_val = $_COOKIE["subscribe"];
	$arr = explode("|",$cookie_val);
	$email = $arr[0];
	$city_id = $arr[1];
	
	$date = date('Y-m-d');
	$sql_subscription = "INSERT INTO ".TABLE_NEWSLETTERS."(email,city,status) VALUES('".$email."','".$city_id."','1','".$date."')";
	mysql_query($sql_subscription);
	
	header('location:index.php?city='.$city_id);
}

?>
	<!--<link href="<?php echo SITE_URL?>css/base.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo SITE_URL?>js/city.js"></script>-->

<script type="text/javascript" src="<?php echo SITE_URL?>js/jquery-1.3.1.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL?>js/jquery.scrollTo.js"></script>

<script>
var validation =0;
$(document).ready(function() {

	$('a.panel').click(function () {

		$('a.panel').removeClass('selected');
		$(this).addClass('selected');
		
		current = $(this);

		if(validation==0)
		{
			$('#subcribewrapper').scrollTo($(this).attr('href'), 1000);		
		}
		
		return false;
	});

	$(window).resize(function () {
		resizePanel();
	});
	
});

function resizePanel() {

	width = $(window).width();
	height = $(window).height();

	mask_width = width * $('.item').length;
		
	$('#debug').html(width  + ' ' + height + ' ' + mask_width);
		
	$('#subcribewrapper, .item').css({width: width, height: height});
	$('#mask').css({width: mask_width, height: height});
	$('#wrapper').scrollTo($('a.selected').attr('href'), 0);
		
}

</script>

<style>

#subcribewrapper {
	width:100%;
	height:100%;
	position:absolute;
	top:0;left:0;
	/*background-color:#ccc;*/
	overflow:hidden;
}

	#mask {
		width:500%;
		height:100%;
		
	}

	.item {
		width:20%;
		height:100%;
		float:left;
		/*background-color:#ddd;*/
	}
	
	
	.subcontent {
		width:501px;
		height:360px;
		top:8%;
		margin:0 auto;
		/*background-color:#aaa;*/
		position:relative;
	}
	
	

</style>
<script>
function validate(id)
{
	if(id=='p1')
	{
		var getSelectedIndex = document.select_city.city.selectedIndex;	
		var val = document.select_city.city[getSelectedIndex].value;
		if(val=='')
		{
			document.getElementById('city_check').innerHTML = '<label style="color:red;font-weight:bold;">Please select a city</label>';
			validation = 1;
			return false;
		}
		else
		{
			document.getElementById('city_check').innerHTML = '';
			validation = 0;
			return true;
		}
	}
	if(id=='p2')
	{
		var getSelectedIndex = document.select_city.city.selectedIndex;	
		var city_val = document.select_city.city[getSelectedIndex].value;
		
		var val =document.getElementById("email").value;
		if(val=='')
		{
			document.getElementById('email_check').innerHTML = '<label style="color:red;font-weight:bold;">Please enter email ID</label>';
			validation = 1;
			return false;
		}
		else if (city_val == '') {
			document.getElementById('city_check').innerHTML = '<label style="color:red;font-weight:bold;">Please select a city</label>';
			validation = 1;
			return false;
		}
		else
		{
			document.getElementById('email_check').innerHTML = '';
			validation = 0;
			return true;
		}
	}
	
}
function getSubscribeValues(id)
{
	var city_id;
	var email;
	var cookieValue;
	if(id=='city_submit')
	{
		var getSelectedIndex = document.select_city.city.selectedIndex;	
		city_id = document.select_city.city[getSelectedIndex].value;
		setCookie("subscribe",city_id,20);
	}
	
	if(id=='subscribe_email')
	{
		email = document.getElementById("email").value;
		var value = getCookie("subscribe");
		cookieValue = email+'|'+value;
		setCookie("subscribe",cookieValue,20);
	}
	
	
}
/* ---------------- Create cookie and set cookie ---------------------------- */
function setCookie(cookieName,cookieValue,nDays) 
{
	var today = new Date();
	var expire = new Date();
	if (nDays==null || nDays==0) nDays=1;
	expire.setTime(today.getTime() + 3600000*24*nDays);
	document.cookie = cookieName+"="+escape(cookieValue) + ";expires="+expire.toGMTString();
}
function getCookie (name) 
{
	var arg = name + "=";
	var alen = arg.length;
	var clen = document.cookie.length;
	var i = 0;
	while (i < clen) 
	{
		var j = i + alen;
		if (document.cookie.substring(i, j) == arg) 
		{
			return getCookieVal (j);
		}
		i = document.cookie.indexOf(" ", i) + 1;
		if (i == 0) break; 
	}
	return null;
}
function getCookieVal (offset) 
{
  var endstr = document.cookie.indexOf (";", offset);
  if (endstr == -1) { endstr = document.cookie.length; }
  return unescape(document.cookie.substring(offset, endstr));
}
/* --------------------------------------------------- */

</script>
<div id="subcribewrapper">
  <div id="mask">
    <div id="item1" class="item"> <a name="item1"></a>
        <div class="subcontent">
          <div class="stepbg">
            <div class="steptop"></div>
            <div class="clear"></div>
            <div class="stepmid">
            <form name="select_city">
              <table width="450" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td align="center" valign="middle"><img src="images/step1.gif" alt="" width="76" height="69" /></td>
                  <td class="please"><!--Please select your city:--><img src="images/please.jpg" alt="" width="269" height="31" /></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><div id="city_check"></div></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>
                      <select name="city" id="city" class="text_select">
                        <option value="">Select city</option>
                        <?php
							$sql_cities = "SELECT * FROM ".TABLE_CITIES." GROUP BY city_name"; 
							$result_cities = mysql_query($sql_cities);
							while($row_cities = mysql_fetch_array($result_cities))
							{
								?>
                        <option value="<?php echo $row_cities["city_id"]; ?>"><?php echo $row_cities["city_name"]; ?></option>
                        <?php
							}
							?>
                      </select>
                 </td>
                </tr>
                 <tr>
                  <td align="center" valign="middle"><img src="images/step2.gif" alt="" width="76" height="69" /></td>
                  <td class="please"><!--Enter email address:--><img src="images/enteremail.jpg" alt="" width="269" height="31" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td><div id="email_check"></div><input type="text" class="text_fieldbg" name="email" id="email"/> </td>
                 </tr>
                 
                <tr>
                  <td>&nbsp;</td>
                  <td><a href="#item3" class="panel" onclick="validate('p1'); return validate('p2');">
                    <input type="submit" name="Submit" class="nextbtn" value="Submit" id="city_submit" onclick="getSubscribeValues(this.id);"/>
                  </a></td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2"><a href="#">Privacy Policy</a> | Already a member? <a href="#">Skip</a> | <a href="#">How it works</a><img src="images/spacer.gif" alt="" width="110" height="1"/><span>1/2</span></td>
                </tr>
              </table>
               </form>
            </div>
            <div class="stepbot"></div>
          </div>
          <div class="clear"></div>
          
          <!--<div class="stepbg1">
            <div class="steptop1"></div>
            <div class="clear"></div>
            <div class="stepmid1">
              <table width="340" border="0" align="center" cellpadding="1" cellspacing="1">
                <tr>
                  <td width="19"><img src="images/right_mark.gif" alt="" width="13" height="14" /></td>
                  <td width="321"><span>One email a day with at huge discounts on best brands.</span></td>
                </tr>
                <tr>
                  <td><img src="images/right_mark.gif" alt="" width="13" height="14" /></td>
                  <td><span>No spam ever. Unsubscribre with just one click</span></td>
                </tr>
                <tr>
                  <td><img src="images/right_mark.gif" alt="" width="13" height="14" /></td>
                  <td><span>It's time to see the better side of life.;</span></td>
                </tr>
              </table>
            </div>
            <div class="stepbot1"></div>
          </div>-->
          
        </div>
    </div>
   
    <div id="item3" class="item"> <a name="item3"></a>
        <div class="subcontent">
          <div class="stepbg">
            <div class="steptop"></div>
            <div class="clear"></div>
            <div style="padding-left:10px;" class="stepmid">
              <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <table width="450" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td style="padding: 10px 0 0 3px;" colspan="2"><strong>Thank you for subscribing, we hope you have a good time.</strong></td>
                  </tr>
                  <tr>
                    <td colspan="2">
                    
               <table width="100%" border="0" cellspacing="2" cellpadding="2"> 		  
                  <td colspan="2" align="center" valign="middle" style="color:#000; font: bold 14px/18px Calibri, Arial, Helvetica, sans-serif;"><img src="images/spacer.gif" alt="" width="1" height="7" /></td>
                  
              </tr>  
                  <tr>
                    <td width="3%" align="center" valign="middle"><img src="images/green_thick.gif" alt="" width="23" height="18" /></td>
                    <td width="90%" align="left" valign="middle" style="color:#000; font: normal 14px/28px Calibri, Arial, Helvetica, sans-serif;">One email a day with huge discounts on the best brands</td>
                  </tr>
                  <tr>
                    <td align="center" valign="middle"><img src="images/green_thick.gif" alt="" width="23" height="18" /></td>
                    <td align="left" valign="middle" style="color:#000; font: normal 14px/28px Calibri, Arial, Helvetica, sans-serif;">No spam ever, unsubscribe with just one click</td>
                  </tr>
                  <tr>
                    <td align="center" valign="middle"><img src="images/green_thick.gif" alt="" width="23" height="18" /></td>
                    <td align="left" valign="middle" style="color:#000; font: normal 14px/28px Calibri, Arial, Helvetica, sans-serif;">You signed up for quality deals and that's what we'll bring you</td>
                  </tr>      
                  <tr>
                    <td align="center" valign="top" style="color:#50b6d0;">
                      <!--<input type="checkbox" name="checkbox22" value="checkbox"/>-->
                    </span></td>
                    <td align="left" valign="top" style="font: bold 12px/17px Arial, Helvetica, sans-serif; color: #666666;">
                  </tr>
                </table>
                
                </td>
                  </tr>
                  <tr>
                    <td style="padding-left: 30px;" colspan="2"><input type="submit" class="dealbtn" name="Submit" value="See today's deal"/></td>
                  </tr>
                </table>
              </form>
            </div>
            <div class="stepbot"></div>
          </div>
        </div>
    </div>
  </div>
</div>
<div class="clear"></div>

</div>

</div>
</div>
</div>
<div class="clear"><img src="images/spacer.gif" alt="" width="1" height="10" /></div>
<?php //include ('include/footer.php'); ?>
