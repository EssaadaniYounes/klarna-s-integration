<?php

return [
    'gateway' => env('PAYMENT_GATEWAY', 'klarna'),

    'credentials' => [
        'klarna' => [
            'api_key' => env('KLARNA_API_KEY'),
            'api_secret' => env('KLARNA_API_SECRET'),
        ],
    ]
];