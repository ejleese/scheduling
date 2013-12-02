<!-- scheduling.php  -  main scheduling page -->
<!-- purpose: display menu for navigation -->
<!-- test 2 -->

<html>
<?php include 'include/schedule_types.php'; ?>

	<head>
		<link rel="stylesheet" type="text/css" href="/scheduling/include/generalstyle.html">
		<link rel="stylesheet" type="text/css" href="/scheduling/include/headermenustyle.html">
	</head>
	<title>Scheduling</title>
	<body>

		<div align="center">
			<h1>Select a Schedule below to view / edit</h1>

			<?php $genTable = genList(); ?>

		</div>
	</body>
</html>
