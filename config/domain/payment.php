<?php

return [
    'methods' => [
        'alpha_bank' => [
            'data' => [
                'title' => 'Alpha Bank',
                'slug' => 'alpha_bank',
                'class' => \Marketplace\Payment\Infrastructure\Services\Banks\AlphaBank::class,
            ],

            'token_key' => env('ALPHA_BANK_PAYMENT_TOKEN_KEY'),
            'alg' => 'HS256',
        ],
        'beta_bank' => [
            'data' => [
                'title' => 'Beta Bank',
                'slug' => 'beta_bank',
                'class' => \Marketplace\Payment\Infrastructure\Services\Banks\BetaBank::class,
            ],

            'token_key' => env('BETA_BANK_PAYMENT_TOKEN_KEY'),
            'alg' => 'HS256',
        ],
    ]
];
