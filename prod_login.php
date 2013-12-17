<!-- prod_login.php - Product Login screen for scheduling website -->
<!-- purpose: used to add a traveler/rpn to the appropriate schedule -->
<!-- author: Eric Leese 9/10/13 -->

<html>

<!-- get schedule type from passed parameter ("?sched=xxx") -->
<?php $type=$_GET['sched']; ?>
<?php include 'include/schedule_types.php'; ?>
<?php $type_long=getDesc($type); ?>
<!-- TODO: redirect if $type is UNKNOWN -->

  <head runat="server">
		<!-- load necessary functions and style sheets -->
		<script language="JavaScript" type="text/javascript" src="/scheduling/javascript/sched.js"></script> <!-- data validation and fetching -->
    <link rel="stylesheet" type="text/css" href="/scheduling/include/headermenustyle.html">
    <link rel="stylesheet" type="text/css" href="/scheduling/include/generalstyle.html">
 	</head>
  <title>
		<?php echo "Product Login ($type_long)"; ?>
  </title>

  <body onLoad="self.focus(); document.getElementById('travnum').focus();
								document.getElementById('btn_trav_add').disabled=true">

		<div align="center">

		<!-- show menu at top for Product Login, Completed, Open pages -->
		<?php include 'include/languageToggle.php'; ?><br>
    <?php include 'include/menu.html' ?>

		<h1>
		<script>
			if ($.cookie('lang_cookie')=="SP")
				var text="Introduzca el producto";
			else text="Product Login";

			document.write(text + "(<?php echo $type_long; ?>)");
		</script>
		</h1>
    <hr>   

		<!-- display Product Login form -->

<script>

// form done within javascript because I'm not sure how else to get at the javascript variables for the text. can't use PHP here

  document.write("<form id=\"prod_login\" runat=\"server\">");

	var lang=$.cookie('lang_cookie');
  if (lang=="SP")
    var text="Introduzca el traveler / RPN:  ";
   else text="Scan or Enter traveler / RPN:  ";

  document.write("<div align=\"center\" style='font-size:25px'>"+text);
	document.write("  <input type=\"text\" id=\"travnum\" onfocus=\"this.style.border='5px groove red'\" onblur=\"this.style.border='1px solid gray'\" onkeypress=\"return sanitize(this);\">");

  if (lang=="SP")
    text="Obtenga informaci&#243n del traveler/RPN";
   else text="Get Trav / RPN info";

	document.write("  <input type=\"button\" id=\"btn_fetch_trav\" value=\""+text+"\" onclick=\"return validateFetchTrav()\">");
	document.write("</div><br><br><br>");

  if (lang=="SP")
		text="Ensamble:  ";
	else text="Assembly:  ";

  document.write(text+"<input type=\"text\" id=\"assynum\" disabled=\"true\">  ");

	if (lang=="SP")
		text="Cantidad:  ";
	else text="Qty:  ";

  document.write(text+"<input type=\"text\" id=\"qty\" disabled=\"true\" onfocus=\"this.style.border='5px groove red'\" onblur=\"this.style.border='1px solid gray'\">  ");

	if (lang=="SP")
		text="Caliente?  ";
	else text="Hot?  ";

  document.write(text+"<input type=\"text\" id=\"hot\" disabled=\"true\">  ");
  document.write("<br><br>");
      
	if (lang=="SP")
		text="Agregar a la lista";
	else text="Add to Tracking List";

	document.write("<input type=\"button\" id=\"btn_trav_add\" value=\""+text+"\" onclick=\"submitTrav('<?php echo $type ?>', '<?php echo $type_long ?>')\">");

	if (lang=="SP")
		text="Limpiar la forma";
	else text="Reset Form";

	document.write("<input type=\"button\" id=\"btn_reset\"    value=\""+text+"\" onclick=\"resetForm()\">");
	document.write("<br><br>");

	if (lang=="SP")
		text="Nota: aseg&uacuterese de poner el traveler correcto / RPN antes de presionar el bot&oacuten \"Agregar a la lista\"";
	else text="Note: Make sure you have the correct traveler / RPN before hitting the \"Add to Tracking List\" button";

	document.write(text);

  document.write("</form>");
	
</script>

    </div>
  </body>
</html>
