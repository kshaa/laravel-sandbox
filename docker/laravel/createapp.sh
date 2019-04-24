#!/usr/bin/env bash

projectpath="code"
projectname="$1"

if [ -z "$projectname" ]
then
    echo "No application name provided as first argument, quitting!"
    exit 1
fi

echo "Creating application '$projectname' in '$projectpath'"
if [ ! -d "$projectpath" ]
then
    laravel new $projectname
    mv $projectname $projectpath
else
    echo "Project already exists in '$projectpath', won't re-create."
fi

echo "Fixing application permissions"
chown -R www-data:www-data $projectpath
find $projectpath -type f -exec chmod 644 {} \;
find $projectpath -type d -exec chmod 755 {} \;