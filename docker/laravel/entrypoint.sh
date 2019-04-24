#!/usr/bin/env bash

SCRIPTDIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null 2>&1 && pwd )"
RUNDIR="$( pwd )"

action_command="$1"
action_file="$SCRIPTDIR/${action_command}.sh"

# Set Workdir
echo "Running at $RUNDIR"
cd $RUNDIR

# Run appropriate command
if [ -f "${action_file}" ]
then
    # Ignore the first given parameter for this script (the bash script name)
    shift

    # Will run the bash script and pass all extra parameters 
    fullcommand="${action_file} \"$*\""

    # Actually run the command
    bash -c "${fullcommand}"
else
    # Run something else
    bash -c "$*"
fi
