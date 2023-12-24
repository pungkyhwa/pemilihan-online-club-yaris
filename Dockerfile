# Gunakan image PHP Official
FROM php:8.2-fpm

#set work dir
WORKDIR /var/www

# Install dependensi yang dibutuhkan
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Install dan aktifkan ekstensi PHP yang diperlukan
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy composer.json dan composer.lock, kemudian jalankan install
COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader

# Copy seluruh proyek
COPY . .

# Generate autoloader
RUN composer dump-autoload

# Set permission untuk storage dan bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chown -R www-data:www-data public
RUN chown -R www-data:www-data /var/www/public
RUN chown -R www-data:www-data /var/www/storage
RUN chmod -R +rwx public
RUN chmod -R +rwx storage
RUN chown -R www-data:www-data storage/logs
RUN chmod -R 755 storage/logs
# Expose port 9000 dan jalankan PHP-FPM
EXPOSE 9000
CMD ["php-fpm"]