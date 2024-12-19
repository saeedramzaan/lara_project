<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['mapi/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    
    'allowed_origins' => [
        'http://localhost:3000',
        'http://localhost:19006',
        'create-react-app-git-main-saeed-ramzans-projects.vercel.app',
    ], // Specify your allowed origins

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],
    'allowedHeaders' => ['Content-Type', 'Authorization', 'X-Requested-With'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,

];
