<?php
/**
 * Create .env from .env.example if it doesn't exist,
 * and generate APP_KEY if missing.
 * This is called during composer install/deploy.
 */

$baseDir = __DIR__ . '/../';
$envPath = $baseDir . '.env';

if (!file_exists($envPath)) {
    // Copy from .env.example
    $example = $baseDir . '.env.example';
    if (file_exists($example)) {
        copy($example, $envPath);
    } else {
        // Create minimal .env
        $content = "APP_KEY=\n";
        file_put_contents($envPath, $content);
    }
}

// Read .env content
$env = file_get_contents($envPath);

// Generate APP_KEY if missing
if (!preg_match('/^APP_KEY=base64:.+$/m', $env) && !preg_match('/^APP_KEY=$/m', $env)) {
    // APP_KEY line exists but doesn't have base64 format
    $env = preg_replace('/^APP_KEY=.+$/m', 'APP_KEY=base64:' . base64_encode(random_bytes(32)), $env);
} elseif (!preg_match('/^APP_KEY=/m', $env)) {
    // No APP_KEY line at all
    $env .= "\nAPP_KEY=base64:" . base64_encode(random_bytes(32)) . "\n";
} else {
    // APP_KEY= line exists but is empty
    $env = preg_replace('/^APP_KEY=$/m', 'APP_KEY=base64:' . base64_encode(random_bytes(32)), $env);
}

file_put_contents($envPath, $env);

// Create SQLite database if it doesn't exist
$dbPath = $baseDir . 'database/database.sqlite';
$dbDir = dirname($dbPath);
if (!is_dir($dbDir)) {
    mkdir($dbDir, 0755, true);
}
if (!file_exists($dbPath)) {
    touch($dbPath);
}
