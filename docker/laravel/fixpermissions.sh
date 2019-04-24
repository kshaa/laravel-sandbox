#!/usr/bin/env bash

projectpath="$(pwd)/."

echo "Fixing application permissions"

# Source reference - https://vijayasankarn.wordpress.com/2017/02/04/securely-setting-file-permissions-for-laravel-framework/

# Note: (Commented vs. actual permission code)
## On production we would add ubuntu to the www-group so ubuntu can also edit the files
## And we would leave others outside that www-group so no one else can edit the files
## But in development because of containerisation, we grant access to everyone for everything
## usermod -a -G www-data ubuntu

# General webapp permissions
chown -R www-data:www-data $projectpath

# Note: (No execute for files)
## No one has file execution permissions, because execution is done by the Web FastCGI process (PHP-FPM), which (as root) can execute anything
# find $projectpath -type f -exec chmod 644 {} \; # [Files] Allow Reading, writing for owner, allow reading for group/others
# find $projectpath -type d -exec chmod 755 {} \; # [Directories] Allow entering, reading, creating for owner, allow entering, listing for group/others
find $projectpath -type f -exec chmod 666 {} \; # [Files] Allow reading, writing for all
find $projectpath -type d -exec chmod 777 {} \; # [Directories] Allow entering, listing, creating for all