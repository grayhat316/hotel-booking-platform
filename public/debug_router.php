<?php
$publicPath = getcwd();
$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? ''
);
echo "publicPath: " . $publicPath . "\n";
echo "uri: " . $uri . "\n";
echo "fullPath: " . $publicPath . $uri . "\n";
echo "fileExists: " . (file_exists($publicPath . $uri) ? 'YES' : 'NO') . "\n";
echo "is_file: " . (is_file($publicPath . $uri) ? 'YES' : 'NO') . "\n";
phpinfo(INFO_GENERAL);
