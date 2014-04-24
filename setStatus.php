<?php
//setStatus.php
//set status

$PID=getmypid();
$TMPFILE="/tmp/setStatus$PID";
$REC=$_GET['rec'];
$STATUS=$_GET['status'];

//system("echo \"$REC $STATUS\" | mutt -s setStatus.php ericl@borisch.com");

system("/appl/fp/dreport scheduling -fp setstatus -sr 1 -u -r $REC -rw $STATUS -rx \"$TMPFILE\" >> /dev/null");

system("cat $TMPFILE");
system("rm -f $TMPFILE"); 
