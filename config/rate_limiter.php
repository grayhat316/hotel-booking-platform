<?php

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

return [
    'limiters' => [
        'api' => [
            'limit' => 60,
            'period' => 1,
        ],
    ],
];
