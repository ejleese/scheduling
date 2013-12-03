#!/bin/sh
# sched_addTrav.sh
# purpose: add traveler to schedule
# usage: called in script/sched.js -> addTrav.php
# author: eric leese 9/17/13

#echo "In sched_addTrav.sh: $$ $1 $2 $3" | mutt -s "sched_addTrav.sh" ericl@borisch.com

. /usr/local/appl/www/cgi-bin/fpsetenv.bat

/appl/fp/dreport scheduling -fp addTrav -u -sr 1 -r "$$" -rx "$1" -ry "$2" -rz "$3" >> /dev/null
# $$=pid  $1=travnum  $2=qtyin  $3=type
cat /appl/fpmerge/schedsrcadd_$$.pout
rm /appl/fpmerge/schedsrcadd_$$.pout
