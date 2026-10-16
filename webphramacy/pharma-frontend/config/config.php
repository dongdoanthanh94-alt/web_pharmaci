<?php
declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE) {
    $isHttps = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
    session_name('pharmacare_session');
    session_set_cookie_params([
        'httponly' => true,
        'secure' => $isHttps,
        'samesite' => 'Lax',
        'path' => '/',
    ]);
    session_start();
}

define('BACKEND_API_URL', rtrim(getenv('BACKEND_API_URL') ?: 'http://localhost:8080/api', '/'));
define('APP_ENV', getenv('APP_ENV') ?: 'local');
