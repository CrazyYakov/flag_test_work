<?php

namespace Marketplace\Profile\Infrastructure\Interfaces;

use Marketplace\Profile\Core\Domain\Entities\Product;

interface ProductRepositoryInterface
{
    public function getById(int $id): Product;
}
