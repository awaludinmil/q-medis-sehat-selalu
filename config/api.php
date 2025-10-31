<?php

return [
    'base_url' => env('API_BASE_URL', 'http://localhost:8000'),
    'timeout' => (int) env('API_TIMEOUT', 5),
    'poll_ms' => (int) env('API_POLL_MS', 5000),

    'frontend_url' => env('FRONTEND_URL', 'http://localhost:5173'),
    'backend_google_redirect' => env('BACKEND_GOOGLE_REDIRECT', 'http://localhost:8000/auth/google/redirect'),
    'backend_google_callback' => env('BACKEND_GOOGLE_CALLBACK', 'http://localhost:8000/auth/google/callback'),
];
