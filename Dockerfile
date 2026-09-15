FROM php:8.2-apache

# Enable Apache mod_rewrite for clean URLs
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . /var/www/html/

# Clean up unwanted folders if any
RUN rm -rf "New folder" ".git"

# Set proper permissions for Apache
RUN chown -R www-data:www-data /var/www/html

# Render / cloud dynamic port script
RUN printf '#!/bin/sh\nPORT="${PORT:-80}"\nsed -i "s/80/$PORT/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf\nexec apache2-foreground\n' > /usr/local/bin/entrypoint.sh \
    && chmod +x /usr/local/bin/entrypoint.sh

ENV PORT=80
EXPOSE 80

CMD ["/usr/local/bin/entrypoint.sh"]
