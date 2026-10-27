<?php

declare(strict_types=1);

namespace Marketplace\Product\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Marketplace\Product\Core\Ports\ProductRepositoryContract;
use Marketplace\Product\Infrastructure\Repositories\ProductRepository;

class ProductServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->bind(
            abstract: ProductRepositoryContract::class,
            concrete: ProductRepository::class
        );
    }
}
