<?php

// When running in Docker (Laravel Sail), use the service name 'elasticsearch'
// Otherwise, use 'localhost' for local development outside Docker
$defaultHost = env('LARAVEL_SAIL') ? 'elasticsearch' : 'localhost';

return [
    'hosts' => [
        env('ELASTICSEARCH_HOST', $defaultHost) . ':' . env('ELASTICSEARCH_PORT', 9200),
    ],
];
