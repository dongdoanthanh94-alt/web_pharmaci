<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

/**
 * Call the Spring API using the JWT held in the server-side PHP session.
 *
 * @throws RuntimeException when cURL is unavailable or the API request fails.
 * @return array{status:int, body:array<mixed>|string|null}
 */
function pharmacy_api_request(string $method, string $path, ?array $payload = null): array
{
    if (!function_exists('curl_init')) {
        throw new RuntimeException('PHP cURL extension is required to call the PharmaCare API.');
    }

    $path = '/' . ltrim($path, '/');
    $headers = ['Accept: application/json'];
    if ($payload !== null) {
        $headers[] = 'Content-Type: application/json';
    }
    if (!empty($_SESSION['access_token'])) {
        $headers[] = 'Authorization: Bearer ' . $_SESSION['access_token'];
    }

    $handle = curl_init(BACKEND_API_URL . $path);
    if ($handle === false) {
        throw new RuntimeException('Unable to initialize the API request.');
    }

    curl_setopt_array($handle, [
        CURLOPT_CUSTOMREQUEST => strtoupper($method),
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CONNECTTIMEOUT => 5,
        CURLOPT_TIMEOUT => 15,
    ]);
    if ($payload !== null) {
        $json = json_encode($payload, JSON_THROW_ON_ERROR);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $json);
    }

    $rawBody = curl_exec($handle);
    if ($rawBody === false) {
        $message = curl_error($handle);
        curl_close($handle);
        throw new RuntimeException('PharmaCare API request failed: ' . $message);
    }

    $status = (int) curl_getinfo($handle, CURLINFO_RESPONSE_CODE);
    curl_close($handle);
    $decoded = json_decode($rawBody, true);

    return [
        'status' => $status,
        'body' => json_last_error() === JSON_ERROR_NONE ? $decoded : $rawBody,
    ];
}
