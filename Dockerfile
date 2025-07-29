FROM php:8.3.0-apache

# Cài đặt các dependencies hệ thống
RUN apt-get update -y && apt-get install -y \
    openssl \
    zip \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev

# Cài đặt các PHP extensions cần thiết
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    gd \
    zip \
    mbstring \
    exif \
    pcntl \
    bcmath \
    soap

# Bật mod rewrite cho Apache
RUN a2enmod rewrite

# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Thiết lập thư mục làm việc
WORKDIR /var/www/html

# Copy source code vào container
COPY . .

# Cài đặt các dependencies của Laravel
RUN composer install --ignore-platform-reqs

# Cấp quyền cho thư mục storage
RUN chown -R www-data:www-data /var/www/html/storage
RUN chmod -R 775 storage bootstrap/cache

# Expose port 80
EXPOSE 80
