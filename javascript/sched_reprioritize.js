// sched_reprioritize.js
// purpose: used to reprioritize an open traveler on schedule list
// usage:   called via html generated in filepro scheduling/open
// author:  ejl 9/23/2013

var gPostLoginRedirect;
var passRecNum; // make visible so i can pass from clkLogin to AjaxLoginPost
var theType;
var theDesc;
var hotval_orig;
var hotval_new;

var lang=$.cookie('lang_cookie'); 

function clkLogin(showhide, recnum, type, desc, hotval, postLoginRedirect) 
{
	passRecNum = recnum;
  theType = type;
  theDesc = desc;
  if (hotval == "Y") hotflag=true;
	else hotflag=false;
	hotval_orig = hotval;

	if(showhide == "show")
	{
		document.getElementById('newpri').value="";
		document.getElementById('loginPass').value="";
		if (hotflag==true) 
			document.getElementById('hottog').checked=true;
		else
			document.getElementById('hottog').checked=false;
		document.getElementById('popupbox').style.visibility="visible";
		document.getElementById('newpri').focus()
		gPostLoginRedirect=postLoginRedirect;
	} 
	
	else if(showhide == "hide"){
		passRecNum="";
    theType="";
    theDesc="";
		document.getElementById('popupbox').style.visibility="hidden";
	}
}

function ajaxLoginPost() {

	var hotval_changed=false;

	if (document.getElementById("hottog").checked==true) hotval_new="Y";
	else hotval_new = "N";

  if (hotval_new != hotval_orig) hotval_changed=true;

  var newpri = document.getElementById("newpri");
	var loginClk = document.getElementById("loginClk");
	var loginPass = document.getElementById("loginPass");
  var recnum = passRecNum;

	if (lang=="SP")
	{
		var text1="Debe poner la nueva prioridad o material caliente";
		var text2="Debe poner su # de empleado";
		var text3="Debe poner su Contrase\u00f1a";
	}
	else
	{
		text1="Must provide new priority or hot value";
		text2="Must provide clock #";
		text3="Must provide password";
	}

  if( newpri.value == "" && hotval_changed != true) { alert(text1); return;}
	if( loginClk.value == "" ) { alert(text2); return; }
	if( loginPass.value == "" ) { alert(text3); return; }
	var http = getHTTPObject(); // create the HTTP Object
	http.onreadystatechange = function() {
		if (http.readyState == 4) {
			results = http.responseText.split(","); // split the comma delimited response into an array
			var errMsg = results[0];
			if(errMsg == "success") {
				if( gPostLoginRedirect != null && gPostLoginRedirect != "" )
				{
					window.location = gPostLoginRedirect;
				} else {
					clkLogin("hide");
					window.location.reload(true);					
				}
			}
			else {
				alert(errMsg);
			}
		}
	}
	var clkvalue=encodeURIComponent(loginClk.value);
	var passvalue=encodeURIComponent(loginPass.value);
  var privalue=encodeURIComponent(newpri.value);
  var hotvalue;
	if (document.getElementById('hottog').checked==true) hotvalue="Y";
	else hotvalue="N";
  var nocachevar = new Date().getTime();
	var parameters="recnum="+recnum+"&newpri="+privalue+"&loginClk="+clkvalue+"&loginPass="+passvalue+"&hotPass="+hotvalue+"&nocache="+nocachevar;
	http.open("GET", "/scheduling/getLogin.php?"+parameters, false); // open request
	http.send(null); // send request

}

function getHTTPObject()
{
  var xmlhttp;

  if (!xmlhttp & typeof XMLHttpRequest != 'undefined')
  {
    try { xmlhttp = new XMLHttpRequest();}
    catch(e) { xmlhttp = false;}
  }
  return xmlhttp;
}
