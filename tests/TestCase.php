<?php

namespace Tests;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use InvalidArgumentException;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    protected function getRandomUser(): User
    {
        return User::factory()->create();
    }

    protected function getRandomProduct(): Product
    {
        return Product::factory()->create();
    }
}
