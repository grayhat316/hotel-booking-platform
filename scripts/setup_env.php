<?php

// Auto-generate .env if it doesn't exist (for deployments without .env file)
if (!file_exists(__DIR__ . '/.env')) {
    $env = '';
    $env .= "APP_NAME=Laravel\n";
    $env .= "APP_ENV=production\n";
    $env .= "APP_KEY=" . 'base64:' . base64_encode(random_bytes(32)) . "\n";
    $env .= "APP_DEBUG=false\n";
    $env .= "APP_URL=" . (getenv('APP_URL') ?: 'http://localhost') . "\n";
    $env .= "LOG_CHANNEL=stack\n";
    $env .= "DB_CONNECTION=sqlite\n";
    $env .= "DB_DATABASE=" . __DIR__ . "/database/database.sqlite\n";
    $env .= "CACHE_DRIVER=file\n";
    $env .= "SESSION_DRIVER=file\n";
    $env .= "QUEUE_CONNECTION=sync\n";
    $env .= "FILESYSTEM_DISK=local\n";
    $env .= "PUSHER_APP_ID=\n";
    $env .= "PUSHER_APP_KEY=\n";
    $env .= "PUSHER_APP_SECRET=\n";

    file_put_contents(__DIR__ . '/.env', $env);

    // Also create the SQLite database if it doesn't exist
    $dbPath = __DIR__ . '/database/database.sqlite';
    if (!file_exists(dirname($dbPath))) {
        mkdir(dirname($dbPath), 0755, true);
    }
    if (!file_exists($dbPath)) {
        touch($dbPath);
    }
}
