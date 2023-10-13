FROM richarvey/nginx-php-fpm:latest

# Copy your application files into the container
COPY . .

# Set environment variables
ENV SKIP_COMPOSER=1
ENV WEBROOT=/var/www/html/public
ENV PHP_ERRORS_STDERR=1
ENV RUN_SCRIPTS=1
ENV REAL_IP_HEADER=1
ENV APP_ENV=production

# Set APP_DEBUG to true
ENV APP_DEBUG=true

ENV LOG_CHANNEL=stderr
ENV COMPOSER_ALLOW_SUPERUSER=1

# Set the permissions for storage and bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage
RUN chown -R www-data:www-data /var/www/html/bootstrap/cache

# Optionally, set permissions with chmod (if needed)
RUN chmod -R 777 /var/www/html/storage
RUN chmod -R 777 /var/www/html/bootstrap/cache

# Define the command to run when the container starts
CMD ["/start.sh"]

