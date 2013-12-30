<!-- prod_login.php - Product Login screen for scheduling website -->
<!-- purpose: used to add a traveler/rpn to the appropriate schedule -->
<!-- author: Eric Leese 9/10/13 -->

<!DOCTYPE html>

<!-- get schedule type from passed parameter ("?sched=xxx") -->
<?php $type=$_GET['sched']; ?>
<?php include 'include/schedule_types.php'; ?>
<?php $type_long=getDesc($type); ?>
<?php include 'include/languageToggle.php'; ?><br>

<?php
	$lang=$_COOKIE["lang_cookie"];
 
	if ($lang=="SP")
		$title="Introduzca el producto";
	else $title="Product Login";
?>

<!-- TODO: redirect if $type is UNKNOWN -->

  <head runat="server">
  	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" /> 

		<!-- load necessary functions and style sheets -->
		<script language="JavaScript" type="text/javascript" src="/scheduling/javascript/sched.js"></script>
    <link rel="stylesheet" type="text/css" href="/scheduling/include/headermenustyle.css">
    <link rel="stylesheet" type="text/css" href="/scheduling/include/generalstyle.css">

 	</head>
  <title>
		<?php echo $title . " (" . $type_long . ")" ?>

	</title>

  <body onLoad="self.focus(); document.getElementById('travnum').focus();
								document.getElementById('btn_trav_add').disabled=true">

		<div align="center">

		<!-- show menu at top for Product Login, Completed, Open pages -->
    <?php include 'include/menu.html' ?>

		<h1>

			<?php 
				if ($lang == "SP")
					$text="Introduzca el producto";	
				else $text="Product Login";
				echo $text . "(" . $type_long . ")";
			?>

		</h1>
    <hr>   

		<!-- display Product Login form -->
<?php
if ($lang=="SP")
{
	$text1="Introduzca el traveler / RPN:  ";
	$text2="Obtenga informaci&#243n del traveler/RPN";
	$text3="Ensamble:  ";
	$text4="Cantidad:  ";
	$text5="Caliente?  ";
	$text6="Agregar a la lista";
	$text7="Limpiar la forma";
	$text8="Nota: aseg&uacuterese de poner el traveler correcto / RPN antes de presionar el bot&oacuten \"Agregar a la lista\"";
}
else
{
	$text1="Scan or Enter traveler / RPN:  ";
	$text2="Get Trav / RPN info";
	$text3="Assembly:  ";
	$text4="Qty:  ";
	$text5="Hot?  ";
	$text6="Add to Tracking List";
	$text7="Reset Form";
	$text8="Note: Make sure you have the correct traveler / RPN before hitting the \"Add to Tracking List\" button";
}
?>

  <form id="prod_login" runat="server">

  <div align="center" style='font-size:25px'><?php echo $text1 ?>
	<input type="text" id="travnum" onfocus="this.style.border='5px groove red'" onblur="this.style.border='1px solid gray'" onkeypress="return sanitize(this);">

	<input type='button' id='btn_fetch_trav' value='<?php echo $text2 ?>' onclick='return validateFetchTrav()'>
	</div><br><br><br>
  <?php echo $text3 ?><input type="text" id="assynum" disabled="true">
  <?php echo $text4 ?><input type="text" id="qty" disabled="true" onfocus="this.style.border='5px groove red'" onblur="this.style.border='1px solid gray'">
  <?php echo $text5 ?><input type="text" id="hot" disabled="true">
  <br><br>
	<input type='button' id='btn_trav_add' value='<?php echo $text6 ?>' onclick='submitTrav(<?php echo "\"" . $type . "\"" ?>, <?php echo "\"" . $type_long . "\"" ?>)'>
	<input type='button' id='btn_reset' value='<?php echo $text7 ?>' onclick='resetForm()'>
	<br><br>
	<?php echo $text8 ?>

  </form>
	
    </div>
  </body>
</html>
