FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo_mysql pdo_sqlite mbstring exif pcntl bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Install dependencies
COPY --chown=www-data:www-data . .
RUN composer install --no-dev --optimize-autoloader --no-scripts 2>/dev/null || composer install --no-dev --optimize-autoloader

# Create .env if it doesn't exist
RUN if [ ! -f .env ]; then \
    cp .env.example .env && \
    php -r "file_put_contents('.env', str_replace('APP_KEY=', 'APP_KEY=' . base64_encode(random_bytes(32)), file_get_contents('.env')));"; \
    fi

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Enable Apache rewrite module
RUN a2enmod rewrite

# Create SQLite database if using sqlite
RUN mkdir -p /var/www/html/database && \
    touch /var/www/html/database/database.sqlite && \
    chmod 666 /var/www/html/database/database.sqlite

# Expose port
EXPOSE 80

# Run migrations
RUN php artisan migrate:fresh --force 2>/dev/null || true

# Clear and cache config
RUN php artisan config:cache && php artisan route:cache 2>/dev/null || true
