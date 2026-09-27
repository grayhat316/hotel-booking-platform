#!/bin/bash
set -e

# Run migrations if they haven't been run yet
php artisan migrate --force 2>/dev/null || true

# Start Apache in foreground
exec apache2-foreground
