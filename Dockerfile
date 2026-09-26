FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    libcurl4-openssl-dev \
    && docker-php-ext-install pdo_mysql pdo_sqlite mbstring exif pcntl bcmath gd curl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application
COPY . .

# Install dependencies (production)
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copy production env file
RUN cp .env.production .env || true

# Ensure SQLite database exists
RUN mkdir -p database && touch database/database.sqlite && chmod 666 database/database.sqlite

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Enable Apache rewrite
RUN a2enmod rewrite

# Clear and cache config
RUN php artisan config:cache 2>/dev/null || true

EXPOSE 80
