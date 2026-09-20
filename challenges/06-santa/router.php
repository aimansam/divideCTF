<?php
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Block all /api/* except /api/secret.php
if (str_starts_with($uri, '/api/') && $uri !== '/api/secret.php') {
    http_response_code(403);
    echo "Forbidden";
    exit;
}

// Map /api/secret.php to the real file in app/api/secret.php
if ($uri === '/api/secret.php') {
    require __DIR__ . '/api/secret.php';
    exit;
}

// Let PHP serve existing static files directly
$file = __DIR__ . $uri;
if ($uri !== '/' && is_file($file)) {
    return false;
}

// Default route -> index.php
require __DIR__ . '/index.php';
