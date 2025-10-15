<?php

use App\Services\Payments\Methods\AlphaBank;
use App\Services\Payments\Methods\BetaBank;

return [
    'token_key' => env('PAYMENT_TOKEN_KEY'),
    'alg' => 'HS256',

    'methods' => [
        'bank' => [
            'class' => AlphaBank::class,
            'title' => 'Bank'
        ],
        'beta_bank' => [
            'class' => BetaBank::class,
            'title' => 'Beta Bank'
        ],
    ]
];
