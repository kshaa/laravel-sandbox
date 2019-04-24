FROM atillay/lemp-php

# Install Laravel
RUN composer global require laravel/installer

# Add composer binaries (laravel) to $PATH
ENV PATH="${PATH}:/root/.composer/vendor/bin"

# Workdir - same as for atillay/lemp-php

# Set up docker entrypoint
COPY . /var/dockerbin/
RUN chmod +x /var/dockerbin/entrypoint.sh
ENTRYPOINT ["/var/dockerbin/entrypoint.sh"]
CMD ["php-fpm"]