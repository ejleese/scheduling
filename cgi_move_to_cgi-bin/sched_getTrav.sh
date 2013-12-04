#!/bin/sh
# sched_getTrav.sh
# usage  : called from /scheduling/getTrav.php
#	       : returns xml type data to html form without form SUBMIT
# purpose: calls filepro report to fetch traveler data

#echo "In sched_getTrav.sh $$ $1" | mutt -s "sched_getTrav.sh" ericl@borisch.com

. /usr/local/appl/www/cgi-bin/fpsetenv.bat

/appl/fp/dreport scheduling -fp getTrav2 -u -sr 1 -r "$$" -rx "$1" >> /dev/null

cat /appl/fpmerge/sched_$$.pout
rm /appl/fpmerge/sched_$$.pout

