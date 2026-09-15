FROM php:8.2-apache

# Enable Apache mod_rewrite for clean URLs
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . /var/www/html/

# Clean up unwanted folders if any
RUN rm -rf New folder .git

# Support dynamic PORT environment variable (Render, Heroku, etc.)
RUN sed -i 's/80//g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# Set proper permissions for Apache
RUN chown -R www-data:www-data /var/www/html

ENV PORT=80
EXPOSE 80

CMD [apache2-foreground]
