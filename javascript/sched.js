// sched.js
// purpose: submit prod_login.html form data and retrieve info from filepro
//					to fill in the rest of the form
// author: Eric Leese 9/10/13 

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

// fetch traveler info using PHP
// input: traveler number entered by user
function fetchTravInfo(travnum)
{
  //fetch data
	var http = getHTTPObject();  // create the http object
  var return_value = true;

	http.onreadystatechange = function()
	{
		if (http.readyState == 4)
		{
			results = http.responseText.split(","); // split delimited response into array
			if (results[0] == "?") 
			{
				if (lang=="SP")
					alert("Error: no existe el Traveler / RPN: " + travnum);
				else
					alert("Error: No such Traveler / RPN: " + travnum); 
				return_value = false;
			}
			else
			{
				document.getElementById('assynum').value = results[0];
				document.getElementById('qty').value = results[1];
				document.getElementById('hot').value = results[2];	
			}
		}
	}
//	var nocachevar = Date.now(); // not supported in IE 8
	var nocachevar = new Date().getTime();
	http.open("GET", "/scheduling/getTrav.php?trav=" + escape(travnum) + "&nocache="+nocachevar, false);
	http.send(null);

	return return_value;

}
 
// make sure data on form is correct before submission
function validateFetchTrav()
{
	var varTravnum = document.getElementById('travnum').value; // value in trav# box
  
  varTravnum = varTravnum.split(' ').join(''); // remove spaces, mainly for leading spaces
  document.getElementById('travnum').value = varTravnum; // fill with despaced value

  if (varTravnum == "" || varTravnum == null)
	{
		if (lang=="SP")
			alert("Debe introducer el traveler / RPN primero");
		else
			alert("Must enter a traveler/RPN number first.");
		exit_Fail();
		return;
	}
	
	var result = fetchTravInfo(varTravnum);
	if (result == false)
	{
		exit_Fail();
		return;
	}

	document.getElementById('travnum').disabled = true;

	if (varTravnum.length == "9")	//traveler; highlight Add button
	{
		document.getElementById('btn_fetch_trav').disabled=true;
   	document.getElementById('assynum').disabled=true;
		document.getElementById('btn_trav_add').disabled=false;
		document.getElementById('btn_trav_add').focus();
		exit_Success();
	}
	else	// RPN; move to Qty entry
	{
   	document.getElementById('travnum').disabled=true;
		document.getElementById('btn_fetch_trav').disabled=true;
		document.getElementById('qty').disabled=false;
   	document.getElementById('qty').focus();
   	document.getElementById('btn_trav_add').disabled=false;
		exit_Success();
	}
}

// validate qty field
function validateQty()
{
  var qty = parseInt(document.getElementById('qty').value);
	
	if(qty <= 0 || isNaN(qty) == true)
	{
		if (lang=="SP")
			alert("Debe poner una cantidad mayor a cero.");
		else
			alert("Must enter quantity greater than zero.");
		document.getElementById('qty').focus();
		
		return false; 
	}
}

// add form info to active  list
function submitTrav(type,typelong)
{
	// verify not already on list
	// run dreport to add to scheduling file 

	//sanity check, make sure there's still a trav/assy/qty
	
	var travnum = document.getElementById('travnum').value;
	var qty = parseInt(document.getElementById('qty').value);
  var assynum = document.getElementById('assynum').value;

	if (validateQty() == false) return false;

	if (travnum == "" || travnum == null || isNaN(qty) || assynum == "" || assynum == null)
	{
		if (lang=="SP")
			alert("Error: los campos de Traveler/Ensamble/Cantidad deben ser llenados");
		else
			alert("Error: Traveler/Assy/Qty fields must be filled in.");
		return false;
	}
	document.getElementById('travnum').disabled=true;

  //fetch data
	var http2 = getHTTPObject();  // create the http object
  var return_value = true;

	http2.onreadystatechange = function()
	{
		if (http2.readyState == 4)	
	{
			var results = http2.responseText.split(","); // split delimited response into array
			if (results[0] != "success") 
			{
				if (lang=="SP")
					alert("Error: no se puede agregar " + travnum + " al " + typelong + " schedule!\n\n" + results[0]);
				else
					alert("Error: Unable to add " + travnum + " to "+typelong+" schedule!\n\n" + results[0]); 
				return_value = false;
			}
			else
			{
				if (lang=="SP")
					alert(travnum + " agregado al " + typelong + " schedule.");
				else
					alert(travnum + " added to " +typelong+" schedule.");
				resetForm();
				return_value = true;
			}
		}
	}
//  var nocachevar = Date.now(); // not supported in IE 8
	var nocachevar = new Date().getTime();

	var lang = $.cookie('lang_cookie');

	http2.open("GET", "/scheduling/addTrav.php?trav="+escape(travnum)+"&qty="+escape(qty)+"&nocache="+nocachevar+"&sched="+type+"&lang="+lang, false);
	http2.send(null);

	return return_value;
}

// exit the traveler# check, it failed - kick user back into trav# field
// returns false
function exit_Fail()
{
//	document.getElementById('travnum').value = "";
  document.getElementById('travnum').focus();
	return false;
}

// exit, successful
// returns true
function exit_Success()
{
	return true;
}

//reset form - typical reset button isn't resetting all button disables
function resetForm()
{
	// reset entry fields
	document.getElementById('travnum').value = "";
  document.getElementById('assynum').value = "";
  document.getElementById('qty').value = "";
  document.getElementById('hot').value = "";

	//reset enabled/disabled status
	document.getElementById('travnum').disabled = false;
  document.getElementById('assynum').disabled = true;
  document.getElementById('qty').disabled = true;
  document.getElementById('hot').disabled = true;

  //reset buttons
	document.getElementById('btn_fetch_trav').disabled = false;
  document.getElementById('btn_trav_add').disabled = true;
  document.getElementById('btn_reset').disabled = false;

	//refocus on travnum field
	document.getElementById('travnum').focus();
}

function sanitize(inVal)
{
	if (/\W/.test(inVal.value))
	{ 
		if (lang=="SP")
		{
		var txt="solo caracteres alfanum\u00e9ricos";
		alert(txt);
		}
		else
			alert("alphanumeric input only");
		return false;
	} 
	return true;
}
