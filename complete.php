<?php
// complete.php
// show completed list
// Eric Leese

$sched=$_GET['sched'];
$desc=$_GET['desc'];
$ver=$_GET['version'];
$lang=$_GET['lang'];

#exec("echo '$sched $desc $ver $lang' | mutt -s complete.php ericl@borisch.com");

passthru("/appl/www/cgi-bin/sched_complete '$sched' '$desc' '$ver' '$lang'");
?>
