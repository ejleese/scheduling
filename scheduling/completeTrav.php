<?php
// completeTrav.php
// usage: called by sched_complete.js
// purpose: calls script that calls filepro report that moves traveler 
//					Open list to Completed list
// author: Eric Leese 9/11/13

$rec = $_GET['rec'];
$trav = $_GET['trav'];
$type = $_GET['type'];

passthru("/appl/www/cgi-bin/sched_completeTrav.sh '$rec' '$trav' '$type'");
?>
