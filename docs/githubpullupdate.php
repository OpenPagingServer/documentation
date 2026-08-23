<?php

$secret = getenv('GITHUB_WEBHOOK_SECRET');

if (!$secret) {
    http_response_code(500);
    exit;
}

$payload = file_get_contents('php://input');
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';

if ($signature === '') {
    http_response_code(401);
    exit;
}

$expected = 'sha256=' . hash_hmac('sha256', $payload, $secret);

if (!hash_equals($expected, $signature)) {
    http_response_code(403);
    exit;
}

$event = $_SERVER['HTTP_X_GITHUB_EVENT'] ?? '';

if ($event !== 'push') {
    http_response_code(204);
    exit;
}

exec('cd /opt/documentation && git pull && mkdocs build >/dev/null 2>&1', $output, $exitCode);

if ($exitCode !== 0) {
    http_response_code(500);
    exit;
}

http_response_code(204);
exit;
