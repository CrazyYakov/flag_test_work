<?php

namespace Marketplace\Cart\Infrastructure\Interfaces;

use Marketplace\Cart\Core\Domain\Entities\Product;

interface ProductRepositoryInterface
{
    public function getById(int $id): Product;
}
