<?php





function email_send_dummy(string $to, string $subject, string $body, array $meta = []): bool {
    $dir = __DIR__ . '/../storage';
    if (!is_dir($dir)) {
        @mkdir($dir, 0777, true);
    }
    $logFile = $dir . '/email.log';

    $payload = [
        'ts' => date('c'),
        'to' => $to,
        'subject' => $subject,
        'body' => $body,
        'meta' => $meta,
    ];

    return (bool)file_put_contents($logFile, json_encode($payload, JSON_UNESCAPED_UNICODE) . PHP_EOL, FILE_APPEND);
}

