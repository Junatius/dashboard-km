FROM php:7.4-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Set document root to /var/www/html
WORKDIR /var/www/html

# Copy the application code
COPY . /var/www/html/

# Set proper permissions (optional, for development)
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Configure Apache
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html|' /etc/apache2/sites-available/000-default.conf \
 && sed -i 's|AllowOverride None|AllowOverride All|' /etc/apache2/apache2.conf
