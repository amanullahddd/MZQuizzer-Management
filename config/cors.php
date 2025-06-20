<?php

// 'paths' => ['api/*', 'sanctum/csrf-cookie'],
// 'allowed_origins' => ['*'],
return [
    'paths' => ['api/*', 'get-data-by-param/*', '*'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['*', 'file://'],
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];
