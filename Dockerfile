FROM php:8.2-apache

# Install extensions
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

# Copy all files
COPY . .

# Create required directories
RUN mkdir -p bootstrap/cache storage/framework/cache/data storage/framework/views storage/framework/sessions storage/logs database storage/app/public uploads/rooms uploads/foods uploads/services uploads/gallery

# Create .env from .env.example if it doesn't exist
RUN if [ ! -f .env ]; then cp .env.example .env; fi

# Generate APP_KEY if missing
RUN if ! grep -q '^APP_KEY=base64:' .env; then \
    APP_KEY=$(php -r "echo base64_encode(random_bytes(32));") && \
    sed -i "s/^APP_KEY=.*/APP_KEY=base64:${APP_KEY}/" .env; \
fi

# Install dependencies (production only)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Create SQLite database
RUN mkdir -p database && touch database/database.sqlite

# Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database && \
    chmod 775 /var/www/html/storage/app/public /var/www/html/uploads && \
    chmod 666 /var/www/html/database/database.sqlite

# Enable Apache mod_rewrite and fix MPM conflict
RUN a2enmod rewrite && \
    a2dismod mpm_event mpm_worker 2>/dev/null || true && \
    a2enmod mpm_prefork

EXPOSE 80

# Use entrypoint to run migrations and start Apache
COPY entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/entrypoint.sh
ENTRYPOINT ["entrypoint.sh"]
