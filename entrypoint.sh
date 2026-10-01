#!/bin/bash
set -e

# Parse DATABASE_URL and write individual DB vars to .env (more reliable than DATABASE_URL)
if [ -n "$DATABASE_URL" ]; then
    # DATABASE_URL format: mysql://user:pass@host:port/dbname
    # Extract components
    DB_URL="$DATABASE_URL"
    
    # Remove mysql:// prefix
    DB_URL="${DB_URL#mysql://}"
    
    # Extract user:pass@host:port/dbname
    USER_PASS="${DB_URL%@*}"
    HOST_PORT_DB="${DB_URL#*@}"
    
    DB_USER="${USER_PASS%:*}"
    DB_PASS="${USER_PASS#*:}"
    DB_HOST="${HOST_PORT_DB%/*}"
    DB_NAME="${HOST_PORT_DB##*/}"
    DB_PORT="${DB_HOST##*:}"
    DB_HOST="${DB_HOST%:*}"
    
    # Default port
    [ -z "$DB_PORT" ] && DB_PORT=3306
    
    # Write to .env (overwrite any existing)
    sed -i "/^DB_CONNECTION=/d" .env
    sed -i "/^DB_HOST=/d" .env
    sed -i "/^DB_PORT=/d" .env
    sed -i "/^DB_DATABASE=/d" .env
    sed -i "/^DB_USERNAME=/d" .env
    sed -i "/^DB_PASSWORD=/d" .env
    sed -i "/^DATABASE_URL=/d" .env
    
    echo "DB_CONNECTION=mysql" >> .env
    echo "DB_HOST=${DB_HOST}" >> .env
    echo "DB_PORT=${DB_PORT}" >> .env
    echo "DB_DATABASE=${DB_NAME}" >> .env
    echo "DB_USERNAME=${DB_USER}" >> .env
    echo "DB_PASSWORD=${DB_PASS}" >> .env
fi

# Ensure no SQLite config remains
sed -i "/^DB_CONNECTION=sqlite/d" .env
sed -i "/^DB_DATABASE=.*sqlite/d" .env

# Clear all caches
php artisan config:clear 2>/dev/null || true
php artisan route:clear 2>/dev/null || true
php artisan view:clear 2>/dev/null || true

# Run migrations
php artisan migrate --force 2>/dev/null || true

# Start Apache
exec apache2-foreground