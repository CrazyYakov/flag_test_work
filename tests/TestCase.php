<?php

namespace Tests;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use InvalidArgumentException;

abstract class TestCase extends BaseTestCase
{
    protected function getRandomUser(): User
    {
        try {
            return User::query()->take(10)->get()->random();
        } catch (InvalidArgumentException) {
            return User::factory(10)->create()->random();
        }
    }

    protected function getRandomProduct(): Product
    {
        try {
            return Product::query()->take(10)->get()->random();
        } catch (InvalidArgumentException) {
            return Product::factory(10)->create()->random();
        }
    }
}
