<?php

return [
    'paths' => ['api/*', 'login', 'logout', 'sanctum/csrf-cookie'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['https://kaleidoscopic-torrone-44fa05.netlify.app'],
    'allowed_headers' => ['*'],
    'supports_credentials' => false,
];
