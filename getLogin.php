<?php
// getLogin.php
// usage: called by sched_reprioritize.js
// purpose: calls script that calls filepro report that validates login 
//					prior to allowing priority changes
// author: Eric Leese 10/4/13

$recnum = $_GET['recnum'];
$newpri = $_GET['newpri'];
$user = $_GET['loginClk'];
$pwd = $_GET['loginPass'];
$hot = $_GET['hotPass'];

passthru("/appl/www/cgi-bin/sched_login '$recnum' '$newpri' '$user' '$pwd' '$hot'");
//passthru("/appl/www/cgi-bin/sched_login");
?>
