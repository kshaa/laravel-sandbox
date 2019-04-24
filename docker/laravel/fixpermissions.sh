#!/usr/bin/env bash

projectpath="code"

echo "Fixing application permissions"
chown -R www-data:www-data $projectpath
find $projectpath -type f -exec chmod 644 {} \;
find $projectpath -type d -exec chmod 755 {} \;