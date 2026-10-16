<?php
declare(strict_types=1);

http_response_code(501);
header('Content-Type: text/plain; charset=utf-8');
echo 'OTP sign-in is not enabled: configure an SMS provider and the backend authentication flow first.';
