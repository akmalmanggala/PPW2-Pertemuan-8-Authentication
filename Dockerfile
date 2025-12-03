FROM php:8.3-fpm

# Install PHP extensions and required system libraries
RUN apt-get update \
    && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev libzip-dev zip unzip git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip \
    && rm -rf /var/lib/apt/lists/*

ENV COMPOSER_ALLOW_SUPERUSER=1

# Set working directory
WORKDIR /var/www

# Copy composer files first (for better caching)
COPY composer.json composer.lock ./

# Install composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Install PHP dependencies
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist

# Copy application files (except files in .dockerignore)
COPY . .

# Complete composer installation
RUN composer dump-autoload --optimize

# Create storage link
RUN php artisan storage:link || true

# Set permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

EXPOSE 9000

CMD ["php-fpm"]
