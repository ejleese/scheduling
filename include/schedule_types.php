<!-- schedule_types.php -->
<!-- purpose: translate 3 letter schedule type codes into long desc -->
<!-- usage: included at the top of prod_login.php to deal with passed param -->
<!-- Note: DO NOT DUPLICATE ANY TYPE CODES BETWEEN THE TWO SCHEDULES! (to make easier to merge later if needed) -->

<?php include '/appl/fp/lib/phpsetvar.php'; ?>
<?php

# key-value pair format: "XXX"=>"Description_Text"
# where "XXX" is a unique, 3-character department abbreviation, and
# where "Description_Text" is the description of that department.
# Note: Use underscores rather than spaces (passed as parameter)
# The order of pairs determines order they show up on scheduling.php list

# DO NOT duplicate abbreviations found in _NOG schedule below!
$schedules_GR= array(
                  "SRC"=>"Source",
                  "TSD"=>"Test_Defense",
                  "TSA"=>"Test_Aerospace",
                  "SOL"=>"Select_Solder",
                  "WSO"=>"Wave_Solder",
                  "COT"=>"Coating",
                  "CAC"=>"Cut_and_Clinch",
                  "NPN"=>"NPN",
                  "GRO"=>"RO",
                  "MSK"=>"Masking");

# DO NOT duplicate abbreviations found in _GR schedule above!
$schedules_NOG= array(
                  "SRN"=>"Source_Nogales",
                  "CON"=>"Coating_Nogales",
                  "AON"=>"AOI_Nogales",
                  "GRN"=>"G10_L3AR_Nogales",
                  "GSN"=>"G10_L3AS_Nogales",
                  "TSN"=>"Test_Nogales");

if ($PFLOC == "NOG") 
	$schedules = $schedules_NOG;
else
	$schedules = $schedules_GR; 

function getDesc($type)
{
 	global $schedules; 
  $return_val=$schedules[$type];
	if ($return_val == null) return "UNKNOWN";
	else return $return_val;	
}

function genList()
{
	global $schedules;

	
	echo "<table class='headertable'>";

	foreach ($schedules as $type=>$type_long)
	{
		echo "<tr><td><a href='/scheduling/prod_login.php?sched=",$type,"'>",$type_long,"</a></td></tr>";
	}

	echo "</table>";	

	return true;
}
?>

