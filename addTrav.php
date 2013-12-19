<?php 
// addTrav.php
// usage: called by sched.js
// purpose: calls script that calls filepro report to add a traveler 
//					to the active schedule
// author: Eric Leese 9/11/13

//exec("echo 'in addTrav.php' | mutt -s 'addTrav.php' ericl@borisch.com");

$trav = $_GET['trav'];
$qty = $_GET['qty'];
$sched = $_GET['sched'];
$lang= $_GET['lang'];

exec("echo '$lang' | mutt -s 'addTrav.php' ericl@borisch.com");

passthru("/appl/www/cgi-bin/sched_addTrav.sh '$trav' '$qty' '$sched' '$lang'");
?>
