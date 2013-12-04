#!/bin/sh
# sched_repriorTrav.sh
# purpose: change priority on traveler in Open list
# usage: called in scheduling/prc.open (accessed via link on 
#					intranet.borisch.local/cgi-bin/sched_open)
# author: eric leese 10/1/13

#echo "In sched_repriorTrav.sh: $$ $1 $2 $3" | mutt -s "sched_repriorTrav.sh" ericl@borisch.com

. /usr/local/appl/www/cgi-bin/fpsetenv.bat

/appl/fp/dreport scheduling -fp repriorTrav -u -sr 1 -r "$$" -rw "$1" -rx "$2" -ry "$3" >> /dev/null

# $$=pid  $1=rec $2=trav $3=type

cat /appl/fpmerge/schedprior_$$.pout
rm /appl/fpmerge/schedprior_$$.pout

