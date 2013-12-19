#!/bin/sh
# sched_completeTrav.sh
# purpose: move traveler from Open list to Completed list
# usage: called in scheduling/prc.open (accessed via link on 
#					intranet.borisch.local/cgi-bin/sched_open)
# author: eric leese 9/20/13

#echo "In sched_completeTrav.sh: $$ $1 $2 $3" | mutt -s "sched_completeTrav.sh" ericl@borisch.com

. /usr/local/appl/www/cgi-bin/fpsetenv.bat

LANG=$4
export LANG

echo "In sched_completeTrav.sh: $$ $1 $2 $3 $4" | mutt -s "sched_completeTrav.sh" ericl@borisch.com

/appl/fp/dreport scheduling -fp completeTrav -u -sr 1 -r "$$" -rw "$1" -rx "$2" -ry "$3" >> /dev/null

# $$=pid  $1=rec $2=trav $3=type

cat /appl/fpmerge/schedcomplete_$$.pout
rm /appl/fpmerge/schedcomplete_$$.pout

