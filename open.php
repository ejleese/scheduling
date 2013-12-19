<?php
// open.php
// show open list
// Eric Leese

$sched=$_GET['sched'];
$desc=$_GET['desc'];
$lang=$_GET['lang'];

//exec("echo 'in open.php $lang' | mutt -s open.php ericl@borisch.com");

passthru("/appl/www/cgi-bin/sched_open '$sched' '$desc' '$lang'");
?>
