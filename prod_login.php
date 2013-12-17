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

var lang=$.cookie('lang_cookie');
if (lang=="SP")
{
	var text1="Introduzca el traveler / RPN:  ";
	var text2="Obtenga informaci&#243n del traveler/RPN";
	var text3="Ensamble:  ";
	var text4="Cantidad:  ";
	var text5="Caliente?  ";
	var text6="Agregar a la lista";
	var text7="Limpiar la forma";
	var text8="Nota: aseg&uacuterese de poner el traveler correcto / RPN antes de presionar el bot&oacuten \"Agregar a la lista\"";
}
else
{
	text1="Scan or Enter traveler / RPN:  ";
	text2="Get Trav / RPN info";
	text3="Assembly:  ";
	text4="Qty:  ";
	text5="Hot?  ";
	text6="Add to Tracking List";
	text7="Reset Form";
	text8="Note: Make sure you have the correct traveler / RPN before hitting the \"Add to Tracking List\" button";
}
</script>

  <form id="prod_login" runat="server">

  <div align="center" style='font-size:25px'><script>document.write(text1)</script>
	<input type="text" id="travnum" onfocus="this.style.border='5px groove red'" onblur="this.style.border='1px solid gray'" onkeypress="return sanitize(this);">

	<script>document.write("<input type='button' id='btn_fetch_trav' value='"+text2+"' onclick='return validateFetchTrav()'>")</script>
	</div><br><br><br>
  <script>document.write(text3)</script><input type="text" id="assynum" disabled="true">
  <script>document.write(text4)</script><input type="text" id="qty" disabled="true" onfocus="this.style.border='5px groove red'" onblur="this.style.border='1px solid gray'">
  <script>document.write(text5)</script><input type="text" id="hot" disabled="true">
  <br><br>
	<script>document.write("<input type='button' id='btn_trav_add' value='"+text6+"' onclick='submitTrav('<?php echo $type ?>', '<?php echo $type_long ?>')'>")</script>
	<script>document.write("<input type='button' id='btn_reset'    value='"+text7+"' onclick='resetForm()'>")</script>
	<br><br>
	<script>document.write(text8)</script>

  </form>
	
    </div>
  </body>
</html>
