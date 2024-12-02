<?php

namespace App\Providers;

use App\Services\Repositories\Interfaces\CartRepositoryInterface;
use App\Services\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Repositories\CartRepository;
use App\Services\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            abstract: UserRepositoryInterface::class,
            concrete: UserRepository::class
        );

        $this->app->bind(
            abstract: CartRepositoryInterface::class,
            concrete: CartRepository::class
        );
    }

}
