#!/usr/bin/env bash

scriptdir="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null 2>&1 && pwd )"
projectpath="$(pwd)/."
projectname="$1"

if [ -z "$projectname" ]
then
    echo "No application name provided as first argument, quitting!"
    exit 1
fi

echo "Creating application '$projectname' in '$projectpath'"
if [ -z "$(ls -A $projectpath)" ]
then
    # Create named project in named path
    laravel new $projectname

    # Move all named path contents to current working directory 
    mv $projectname/* $projectname/.* $projectpath

    # Remove (the now empty) named directory
    rm -r $projectname
else
    echo "Project already exists in '$projectpath', won't re-create."
fi

echo "Running \"Permission setup\""
bash -c "$scriptdir/fixpermissions.sh"