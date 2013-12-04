<?php
// repriorTrav.php
// usage: called by sched_reprior.js
// purpose: calls script that calls filepro report that changes traveler 
//					priority
// author: Eric Leese 9/11/13

$rec = $_GET['rec'];
$trav = $_GET['trav'];
$type = $_GET['type'];

passthru("/appl/www/cgi-bin/sched_repriorTrav.sh '$rec' '$trav' '$type'");
?>
