<?php

return [
    'paths' => ['api/*', 'login', 'logout', 'sanctum/csrf-cookie'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['https://your-react-site.netlify.app'],
    'allowed_headers' => ['*'],
    'supports_credentials' => false,
];
