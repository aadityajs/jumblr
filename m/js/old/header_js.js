	 function ajaxFunction(str)
	{
	
	   var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		 
	   if(str=="")
	   {
			document.getElementById('err4').innerHTML="Enter Email";
			return false;
			
	   }		
	   else if(reg.test(str) == false) 
	   {
		  document.getElementById('err4').innerHTML="Enter Valid Email";
		  return false;
	   }
	   else
	   {
			var ajaxRequest;  // The variable that makes Ajax possible!
			
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequest = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
			// Create a function that will receive data sent from the server
			ajaxRequest.onreadystatechange = function(){
				if(ajaxRequest.readyState == 4){
					var ajaxDisplay = document.getElementById('err4');
					ajaxDisplay.innerHTML = ajaxRequest.responseText;
				}
			}
			var queryString = "?email=" + str;
			ajaxRequest.open("GET", "subscribe.php" + queryString, true);
			ajaxRequest.send(null); 
		}
			 
		   }

function frmsubmit(str)
{
	window.location.href="deals.php?city="+str;
}

function echeck(str) 
{
	if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(str))
	{
		return (true);
	}
	else
	{
		return (false);
	}
}	

function GetXmlHttpObject()// initializes object for different browsers
{
  var objXMLHttp=null
  if (window.XMLHttpRequest)
  {
    objXMLHttp=new XMLHttpRequest()
  }
  else if (window.ActiveXObject)
  {
    objXMLHttp=new ActiveXObject("Microsoft.XMLHTTP")
  }
  return objXMLHttp
}

function check()
{
	var full_name=document.getElementById('full_name').value;
	var password=document.getElementById('password').value;
	var cpassword=document.getElementById('cpassword').value;
	var email=document.getElementById('email').value;
	var strr="";
	
	if(full_name=="")
	{
		document.getElementById('err4').style.display="";
		document.getElementById('err4').innerHTML="Enter your Name";
		strr+="msgerr";		
	}
	
	if(email=="")
	{
		document.getElementById('err1').style.display="";
		document.getElementById('err1').innerHTML="Enter E-mail address";
		strr+="msgerr";
	}
	else if(echeck(document.getElementById('email').value)==false)
	{
		document.getElementById('err1').style.display="";
		document.getElementById('err1').innerHTML='Please Enter Valid Email';
		strr+="msgerr";
	}
	
	if(password=="")
	{
		document.getElementById('err2').style.display="";
		document.getElementById('err2').innerHTML="Enter Password";
		strr+="msgerr";
	}
	if(cpassword=="")
	{
		document.getElementById('err3').style.display="";
		document.getElementById('err3').innerHTML="Confirm Password";
		strr+="msgerr";
	}
	if(password!=cpassword)
	{
		document.getElementById('err3').style.display="";
		document.getElementById('err3').innerHTML="Password Mismatch";
		strr+="msgerr";
	}
	
	if(strr!="")
	{
		return false;
	}
	else
	{
		/*document.getElementById('err1').innerHTML="";
		document.getElementById('errorregEmail').style.display="none";*/
		
		xmlHttp=GetXmlHttpObject();
		if (xmlHttp==null)
		{
		alert ("Your browser does not support HTTP Request");
		return;
		}
		var url="add_user.php?full_name="+full_name+"&password="+password+"&email="+email;
		xmlHttp.onreadystatechange=registercon; 
		xmlHttp.open("GET",url,true);
		xmlHttp.send(null);
	}

}

function registercon()
{
	if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
  	{
		var m=xmlHttp.responseText;

		if(m==1)
		{			
			document.getElementById('errordiv').style.display="";
			document.getElementById('err1').style.display="none";
			document.getElementById('err2').style.display="none";
			document.getElementById('err3').style.display="none";
			document.getElementById('errordiv').innerHTML="Successfully Registered";
		}
		else if(m==0)
		{			
			document.getElementById('errordiv').style.display="";
			document.getElementById('err1').style.display="none";
			document.getElementById('err2').style.display="none";
			document.getElementById('err3').style.display="none";
			document.getElementById('errordiv').innerHTML="Email Already Registered";
		}
		
  	}
}

function checklogin()
{
	var email2=document.getElementById('email2').value;
	var password2=document.getElementById('password2').value;

	if(email2=="" || password2=="")
	{
		document.getElementById('errordiv2').style.display="";
		document.getElementById('errordiv2').innerHTML="Enter Email & Password";
		return false;
	}
	else
	{
		document.getElementById('errordiv2').innerHTML="";
		document.getElementById('errordiv2').style.display="none";
		xmlHttp=GetXmlHttpObject();
		if (xmlHttp==null)
		{
		alert ("Your browser does not support HTTP Request");
		return;
		}
		var url="logincheck.php?email2="+email2+"&password2="+password2;
		xmlHttp.onreadystatechange=passwordcheck; 
		xmlHttp.open("GET",url,true);
		xmlHttp.send(null);
	}
}

function passwordcheck()// receive response value
{
  	if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
  	{
		var m2=xmlHttp.responseText;
		
		if(m2==0)
		{	
			document.getElementById('errordiv2').style.display="";
			document.getElementById('errordiv2').innerHTML='Invalid Email / password';
		}
		else if(m2==1)
		{			
			document.getElementById('errordiv2').style.display="none";
			window.location.href="my_account.php";
		}

  	}
}


function daily_subscription()
{
	var email3=document.getElementById('email3').value;
	var city_name=document.getElementById('city_name').value;

	var strng="";
	
	if(city_name=="")
	{
		document.getElementById('err5').style.display="";
		document.getElementById('err5').innerHTML="Select City";
		strr+="msgerr";
	}
		
	if(email3=="")
	{
		document.getElementById('err6').style.display="";
		document.getElementById('err6').innerHTML='Enter Email address';
		strng+="msgerr";
	}
	else if(echeck(document.getElementById('email3').value)==false)
	{
		document.getElementById('err6').style.display="";
		document.getElementById('err6').innerHTML='Please Enter Valid Email';
		strng+="msgerr";
	}
	
	if(strng!="")
	{
		return false;
	}
	else
	{
		
		document.getElementById('err6').style.display="none";
		document.getElementById('err5').style.display="none";
		xmlHttp=GetXmlHttpObject();
		if (xmlHttp==null)
		{
		alert ("Your browser does not support HTTP Request");
		return;
		}
		var url="daily_subscription.php?email3="+email3+"&city_name="+city_name;
		xmlHttp.onreadystatechange=dailysubs; 
		xmlHttp.open("GET",url,true);
		xmlHttp.send(null);
	}

}

function dailysubs()
{
	if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
  	{
		var m3=xmlHttp.responseText;

		if(m3==1)
		{			
			document.getElementById('errordiv3').style.display="";
			document.getElementById('err5').style.display="none";
			document.getElementById('err6').style.display="none";
			document.getElementById('errordiv3').innerHTML="Successfully Email Subscribed";
		}
		else if(m3==0)
		{			
			document.getElementById('errordiv3').style.display="";
			document.getElementById('errordiv3').innerHTML="Email Already Registered";
		}
		
  	}
}