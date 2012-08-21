/*
	Author:		Robert Hashemian (http://www.hashemian.com/)
	Modified by:	Munsifali Rashid (http://www.munit.co.uk/)
*/

/*
 * Wth Days
 * 
 */
/*
	Author:		Robert Hashemian (http://www.hashemian.com/)
	Modified by:	Munsifali Rashid (http://www.munit.co.uk/)
*/


function countdown(obj)
{
	this.obj		= obj;
	this.Div		= "clock";
	this.BackColor		= "white";
	this.ForeColor		= "black";
	this.TargetDate		= "12/31/2020 5:00 AM";
	this.CurDate		= "12/31/2020 5:00 AM";
	this.DisplayFormat	= "%%D%% Days, %%H%% Hours, %%M%% Minutes, %%S%% Seconds.";
	this.CountActive	= true;
	
	this.DisplayStr;

	this.Calcage		= cd_Calcage;
	this.CountBack		= cd_CountBack;
	this.Setup		= cd_Setup;
}

function cd_Calcage(secs, num1, num2)
{
	/*if (num2 == 24) {
	 s = (Math.floor(secs/num1)).toString();
		  //if (s.length < 2) s = ""+s;
		 //alert (s);
		  return (s);
	}
	else {*/
		 s = ((Math.floor(secs/num1))%num2).toString();
		  if (s.length < 2) s = s;
		  return (s);
	//}
}
function cd_CountBack(secs)
{
  this.DisplayStr = this.DisplayFormat.replace(/%%D%%/g,	this.Calcage(secs,86400,100000));
  this.DisplayStr = this.DisplayStr.replace(/%%H%%/g,		this.Calcage(secs,3600,24));
  this.DisplayStr = this.DisplayStr.replace(/%%M%%/g,		this.Calcage(secs,60,60));
  this.DisplayStr = this.DisplayStr.replace(/%%S%%/g,		this.Calcage(secs,1,60));

  document.getElementById(this.Div).innerHTML = this.DisplayStr;
  if (this.CountActive) setTimeout(this.obj +".CountBack(" + (secs-1) + ")", 990);
}
function cd_Setup()
{
	var dthen	= new Date(this.TargetDate);
  	var dnow	= new Date(this.CurDate);
	ddiff		= new Date(dthen-dnow);
	gsecs		= Math.floor(ddiff.valueOf()/1000);
	this.CountBack(gsecs);
}



/*
 *Without Days 
 * 
 *
function countdown(obj)
{
	this.obj		= obj;
	this.Div		= "clock";
	this.BackColor		= "white";
	this.ForeColor		= "black";
	this.TargetDate		= "12/31/2020 5:00 AM"; //2020-12-31 23:59:59
	this.CurDate		= "12/31/2020 5:00 AM";
	this.DisplayFormat	= "%%H%% Hours, %%M%% Minutes, %%S%% Seconds.";
	this.CountActive	= true;
	
	this.DisplayStr;

	this.Calcage		= cd_Calcage;
	this.CountBack		= cd_CountBack;
	this.Setup		= cd_Setup;
}

function cd_Calcage(secs, num1, num2)
{
	if(num2 == 24)
  		s = (Math.floor(secs/num1)).toString();
	else
		s = ((Math.floor(secs/num1))%num2).toString();
  if (s.length < 2) s = "0" + s;
  //alert(secs);
  return (s);
}
function cd_CountBack(secs)
{
	
  this.DisplayStr = this.DisplayFormat.replace(/%%H%%/g,	this.Calcage(secs,3600,24));
 // this.DisplayStr = this.DisplayStr.replace(/%%H%%/g,		this.Calcage(secs,3600,24));
  this.DisplayStr = this.DisplayStr.replace(/%%M%%/g,		this.Calcage(secs,60,60));
  this.DisplayStr = this.DisplayStr.replace(/%%S%%/g,		this.Calcage(secs,1,60));
//alert(this.DisplayStr);
  document.getElementById(this.Div).innerHTML = this.DisplayStr;
  if (this.CountActive) setTimeout(this.obj +".CountBack(" + (secs-1) + ")", 990);
}
function cd_Setup()
{
	var dthen	= new Date(this.TargetDate);
  	var dnow	= new Date(this.CurDate);
	ddiff		= new Date(dthen-dnow);
	gsecs		= Math.floor(ddiff.valueOf()/1000);
	gsecs		= Math.abs(gsecs);
	
	this.CountBack(gsecs);
}
*/