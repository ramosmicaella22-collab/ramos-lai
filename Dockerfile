FROM php:8.2-apache

WORKDIR /var/www/html

# Install MySQL PDO driver
RUN docker-php-ext-install pdo_mysql mysqli

COPY . /var/www/html/

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set LavaLust public folder as Apache document root
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf \
    /etc/apache2/conf-available/*.conf

# Allow .htaccess and rewrite rules
RUN printf '%s\n' \
    '<Directory /var/www/html/public>' \
    '    Options Indexes FollowSymLinks' \
    '    AllowOverride All' \
    '    Require all granted' \
    '</Directory>' \
    > /etc/apache2/conf-available/lavalust.conf

RUN a2enconf lavalust

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]