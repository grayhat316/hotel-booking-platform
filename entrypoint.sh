#!/bin/bash
set -e

# Write DATABASE_URL to .env at runtime (Railway provides it as env var)
if [ -n "$DATABASE_URL" ]; then
    if grep -q '^DATABASE_URL=' .env; then
        sed -i "s|^DATABASE_URL=.*|DATABASE_URL=${DATABASE_URL}|" .env
    else
        echo "DATABASE_URL=${DATABASE_URL}" >> .env
    fi
fi

# Also ensure DB_CONNECTION is mysql
if grep -q '^DB_CONNECTION=' .env; then
    sed -i 's|^DB_CONNECTION=.*|DB_CONNECTION=mysql|' .env
else
    echo "DB_CONNECTION=mysql" >> .env
fi

# Clear config cache so new env is picked up
php artisan config:clear 2>/dev/null || true

# Run migrations
php artisan migrate --force 2>/dev/null || true

# Start Apache
exec apache2-foreground