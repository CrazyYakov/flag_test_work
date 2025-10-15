<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\ObserverProvider::class,
    App\Providers\RepositoryServiceProvider::class,

    Marketplace\Auth\Infrastructure\Providers\ProfileServiceProvider::class,
    Marketplace\Product\Infrastructure\Providers\ProductServiceProvider::class,
];
