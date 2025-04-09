<?php

return [
    'paths' => ['api/*', 'login', 'logout', 'sanctum/csrf-cookie'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['https://quiz-frontend-sage.vercel.app'],
    'allowed_headers' => ['*'],
    'supports_credentials' => true,
];
