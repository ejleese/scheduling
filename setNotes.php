<?php
// setNotes.php
// usage: called by sched_reprioritize.js
// purpose: changes hold notes
// author: Eric Leese 8/1/14

$notes = "\"".$_GET['notes']."\"";
$rec = $_GET['rec'];

#system("echo \"$rec $notes\" | mutt -s setNotes.php ericl@borisch.com");

#$theCommand="/appl/fp/dreport scheduling -fp setnotes -sr 1 -u -r $rec -rw \"$notes\" >> /dev/null";

#system("echo \"$theCommand\" | mutt -s command ericl@borisch.com");

#system($theCommand);

system("/appl/fp/dreport scheduling -fp setnotes -sr 1 -u -r $rec -rw \"$notes\" >> /dev/null");

#system("cat $TMPFILE"); 
#system("rm -f $TMPFILE");

?>
