<?php

// Auto-generate .env if it doesn't exist (for deployment environments)
$envPath = __DIR__ . '/../.env';
if (!file_exists($envPath) || filesize($envPath) === 0) {
    $appKey = 'base64:' . base64_encode(random_bytes(32));
    
    // Detect the app URL from the actual request
    $appUrl = 'http://localhost';
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
        $appUrl = 'https://' . $_SERVER['HTTP_HOST'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
        $appUrl = 'https://' . $_SERVER['HTTP_HOST'];
    } elseif (isset($_SERVER['HTTP_HOST'])) {
        $appUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'];
    }
    
    // Check for Railway-specific URL
    $railwayUrl = getenv('RAILWAY_STATIC_URL') ?: getenv('RAILWAY_APP_URL');
    if ($railwayUrl) {
        $appUrl = $railwayUrl;
    }

    $env = <<<ENV
APP_NAME=Laravel
APP_ENV=production
APP_KEY={$appKey}
APP_DEBUG=false
APP_URL={$appUrl}
LOG_CHANNEL=stack
LOG_LEVEL=debug
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120
MEMCACHED_HOST=127.0.0.1
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="\${APP_NAME}"
AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false
PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1
VITE_APP_NAME="\${APP_NAME}"
ENV;

    @file_put_contents($envPath, $env);
}

// Ensure SQLite database exists
$dbPath = __DIR__ . '/../database/database.sqlite';
if (!file_exists(dirname($dbPath))) {
    @mkdir(dirname($dbPath), 0755, true);
}
if (!file_exists($dbPath)) {
    @touch($dbPath);
}
