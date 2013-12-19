<?php
// getTrav.php
// usage: called by sched.js
// purpose: calls script that calls filepro report to fetch traveler data
// author: Eric Leese 9/11/13

$trav = $_GET['trav'];
$lang = $_GET['lang'];

passthru("/appl/www/cgi-bin/sched_getTrav.sh '$trav' '$lang'");
?>
