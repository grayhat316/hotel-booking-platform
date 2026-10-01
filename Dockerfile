FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libsqlite3-dev \
    pkg-config \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql pdo_sqlite mbstring exif pcntl bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files first for better caching
COPY composer.json composer.lock ./

# Install PHP dependencies (production only)
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Copy all application files
COPY . .

# Create required directories
RUN mkdir -p \
    bootstrap/cache \
    storage/framework/cache/data \
    storage/framework/views \
    storage/framework/sessions \
    storage/logs \
    database \
    storage/app/public \
    uploads/rooms \
    uploads/foods \
    uploads/services \
    uploads/gallery

# Fix Apache MPM - disable ALL other MPMs, enable ONLY prefork
# Remove all MPM load modules from apache2.conf and mods-enabled
RUN a2dismod mpm_event mpm_worker mpm_prefork 2>/dev/null; \
    # Remove any MPM LoadModule lines from apache2.conf
    sed -i '/LoadModule mpm_/d' /etc/apache2/apache2.conf; \
    # Remove any MPM config files from mods-enabled
    rm -f /etc/apache2/mods-enabled/mpm_*.conf /etc/apache2/mods-enabled/mpm_*.load 2>/dev/null; \
    # Enable ONLY prefork
    a2enmod mpm_prefork; \
    a2enmod rewrite

# Copy and setup entrypoint
COPY entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/entrypoint.sh

# Expose port
EXPOSE 80

# Use entrypoint
ENTRYPOINT ["entrypoint.sh"]