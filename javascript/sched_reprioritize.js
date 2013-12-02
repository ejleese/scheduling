// sched_reprioritize.js
// purpose: used to reprioritize an open traveler on schedule list
// usage:   called via html generated in filepro scheduling/open
// author:  ejl 9/23/2013

function reprioritize(recnum,newpri)
{

  var http = getHTTPObject();  // create the http object
  http.onreadystatechange = function()
  {
    if (http.readyState == 4)
    {
      results = http.responseText.split(","); // split delimited response in
      if (results[0] != "success")
      {
        alert("Error: Unable to reprioritize traveler/RPN " + travnum+"\n\n"+results[0]);
      }
			else
			{
				alert("Traveler/RPN "+travnum+" successfully reprioritized.");
			}
    }
  }
//  var nocachevar = Date.now(); // not supported in IE8
	var nocachevar = new Date().getTime();
  http.open("GET", "/scheduling/repriorTrav.php?rec="+recnum+"&newpri="+escape(newpri)+"&nocache="+nocachevar, false);
  http.send(null);

	return true;

}

var gPostLoginRedirect;
var passRecNum; // make visible so i can pass from clkLogin to AjaxLoginPost
var theType;
var theDesc;

function clkLogin(showhide, recnum, type, desc, postLoginRedirect) 
{
	passRecNum = recnum;
  theType = type;
  theDesc = desc;

	if(showhide == "show")
	{
		document.getElementById('newpri').value="";
		document.getElementById('loginPass').value="";
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
  var newpri = document.getElementById("newpri");
	var loginClk = document.getElementById("loginClk");
	var loginPass = document.getElementById("loginPass");
  var recnum = passRecNum;
  if( newpri.value == "") { alert("Must provide new priority"); return;}
	if( loginClk.value == "" ) { alert("Must provide clock #"); return; }
	if( loginPass.value == "" ) { alert("Must provide password"); return; }
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
//					document.getElementById('loggedIn').style.display="block";
//					document.getElementById('loginLink').style.display="none";
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
  var nocachevar = new Date().getTime();
	var parameters="recnum="+recnum+"&newpri="+privalue+"&loginClk="+clkvalue+"&loginPass="+passvalue+"&nocache="+nocachevar;
//	http.open("POST", "/cgi-bin/sched_login", false); // open request
	http.open("GET", "/scheduling/getLogin.php?"+parameters, false); // open request
//	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
//	http.send(parameters); // send request
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

