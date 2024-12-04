<?php

use App\Services\Payments\Methods\Bank;
use App\Services\Payments\Methods\BetaBank;

return [
    'token_key' => env('PAYMENT_TOKEN_KEY'),
    'alg' => 'HS256',

    'methods' => [
        'bank' => [
            'class' => Bank::class,
            'title' => 'Bank'
        ],
        'beta_bank' => [
            'class' => BetaBank::class,
            'title' => 'Beta Bank'
        ],
    ]
];
