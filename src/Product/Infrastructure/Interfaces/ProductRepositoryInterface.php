<?php

namespace Marketplace\Product\Infrastructure\Interfaces;

use Marketplace\Product\Core\Domain\Entities\Product;
use Marketplace\Product\Core\Domain\Values\Lists\ProductList;

interface ProductRepositoryInterface
{
    public function getById(int $id): Product;

    public function get(FilterInterface $filter, SorterInterface $sorter): ProductList;
}
