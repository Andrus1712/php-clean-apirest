FROM php:8.2-fpm

RUN docker-php-ext-install pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY config/php.ini /usr/local/etc/php/conf.d/custom.ini

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www/html

CMD ["php-fpm"]
