// sched_complete.js
// purpose: used to 'complete' an open traveler on schedule list,
//					which moves it to the Closed list
// usage:   called via html generated in filepro scheduling/open
// author:  ejl 9/23/2013

var lang=$.cookie('lang_cookie');

function complete(recnum,travnum,type)
{

  var http = getHTTPObject();  // create the http object
  http.onreadystatechange = function()
  {
    if (http.readyState == 4)
    {
      results = http.responseText.split(","); // split delimited response in
      if (results[0] != "success")
      {
				if (lang=="SP")
					alert("Error: No se puede completar el traveler/RPN " + travnum+"\n\n"+results[0]); 
				else
        	alert("Error: Unable to Complete traveler/RPN " + travnum+"\n\n"+results[0]);
      }
			else
			{
				if (lang=="SP")
					alert("Traveler/RPN "+travnum+" completado exitosamente.");
				else
					alert("Traveler/RPN "+travnum+" successfully completed.");
			}
    }
  }
//  var nocachevar = Date.now(); // not supported in IE 8
  var nocachevar = new Date().getTime();
  http.open("GET", "/scheduling/completeTrav.php?rec="+recnum+"&trav="+escape(travnum)+"&type="+escape(type)+"&lang="+lang+"&nocache="+nocachevar, false);
  http.send(null);

	return true;

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

