<?php

use Marketplace\Payment\Infrastructure\Services\Banks\AlphaBank;
use Marketplace\Payment\Infrastructure\Services\Banks\BetaBank;

return [
    'token_key' => env('PAYMENT_TOKEN_KEY'),
    'alg' => 'HS256',

    'methods' => [
        'alpha_bank' => [
            'class' => AlphaBank::class,
            'title' => 'Alpha Bank'
        ],
        'beta_bank' => [
            'class' => BetaBank::class,
            'title' => 'Beta Bank'
        ],
    ]
];
