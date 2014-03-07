<?php
// getLoginExp.php
// usage: called by sched_reprioritize.js
// purpose: validates login and runs export report
// author: Eric Leese 3/4/14

$user = $_GET['loginClk'];
$pwd = $_GET['loginPass'];
$schedtype = $_GET['type'];
$report = strtoupper($_GET['report']);
$PID = getmypid();
$TMPFILE = "/tmp/scheduling-export_$schedtype$report$user.log";

//system("echo \"$user $pwd\" | mutt -s getLoginExp.php ericl@borisch.com");

system(". /appl/www/cgi-bin/fpsetenv.bat; /appl/fp/dreport scheduling -fp export -a -u -v export_s -r $PID -rw $pwd$user -rx $schedtype -ry $report >> /dev/null");
system("cat $TMPFILE"); 
system("rm -f $TMPFILE");

?>
