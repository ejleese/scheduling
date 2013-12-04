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
<<<<<<< HEAD
		<script language="JavaScript" type="text/javascript" src="/script/sched.js"></script> <!-- data validation and fetching -->
=======
		<script language="JavaScript" type="text/javascript" src="/scheduling/javascript/sched.js"></script> <!-- data validation and fetching -->
>>>>>>> c87e5577d72f48d2d0c9d250c27bfdeaab3f1f1f

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
    <?php include 'include/menu.html'; ?>

		<h1>
		<?php echo "Product Login ($type_long)"; ?>
		</h1>
    <hr>   

		<!-- display Product Login form -->

    <form id="prod_login" runat="server"> 
      <div align="center" style='font-size:25px'>Scan or Enter Traveler / RPN: 
			<input type="text" id="travnum" onfocus="this.style.border='5px groove red'" onblur="this.style.border='1px solid gray'" onkeypress="return sanitize(this);">
			<input type="button" id="btn_fetch_trav" value="Get Trav / RPN info" onclick="return validateFetchTrav()">
			</div><br><br><br>
      Assembly: <input type="text" id="assynum" disabled="true">
      Qty: <input type="text" id="qty" disabled="true" onfocus="this.style.border='5px groove red'" onblur="this.style.border='1px solid gray'">
      Hot Barcode? <input type="text" id="hot" disabled="true">
      <br><br>
      
			<input type="button" id="btn_trav_add" value="Add to Tracking List" onclick="submitTrav('<?php echo $type ?>', '<?php echo $type_long ?>')">
			<input type="button" id="btn_reset"    value="Reset form" onclick="resetForm()">
			<br><br>
			Note: Make sure you have the correct traveler/RPN before hitting the "Add to Tracking List" button!

    </form>

    </div>
  </body>
</html>
