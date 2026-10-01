#!/bin/bash
set -e

echo "=== Railway Entrypoint Starting ==="
echo "DATABASE_URL present: ${DATABASE_URL:+YES}"
echo "DATABASE_URL value: ${DATABASE_URL:-NOT_SET}"

# Parse DATABASE_URL and write individual DB vars to .env (more reliable than DATABASE_URL)
if [ -n "$DATABASE_URL" ]; then
    echo "Parsing DATABASE_URL..."
    # DATABASE_URL format: mysql://user:pass@host:port/dbname
    # Remove mysql:// prefix
    DB_URL="${DATABASE_URL#mysql://}"
    
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
    
    echo "Parsed: host=$DB_HOST port=$DB_PORT db=$DB_NAME user=$DB_USER"
    
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
    
    echo "Written DB config to .env"
else
    echo "WARNING: DATABASE_URL not set!"
fi

# Ensure no SQLite config remains
sed -i "/^DB_CONNECTION=sqlite/d" .env
sed -i "/^DB_DATABASE=.*sqlite/d" .env

# Verify .env has correct DB config
echo "=== Final .env DB config ==="
grep -E "^DB_" .env || echo "NO DB CONFIG FOUND!"

# Generate APP_KEY if missing
if ! grep -q '^APP_KEY=base64:' .env 2>/dev/null; then
    echo "Generating APP_KEY..."
    APP_KEY=$(php -r "echo base64_encode(random_bytes(32));")
    sed -i "/^APP_KEY=/d" .env
    echo "APP_KEY=base64:${APP_KEY}" >> .env
fi

# Clear all caches
echo "Clearing caches..."
php artisan config:clear 2>/dev/null || true
php artisan route:clear 2>/dev/null || true
php artisan view:clear 2>/dev/null || true

# Run migrations
echo "Running migrations..."
php artisan migrate --force 2>/dev/null || true

# Start Apache
echo "Starting Apache..."
exec apache2-foreground