<?php

namespace Marketplace\Product\Core\Ports;

use Marketplace\Product\Core\Domain\Entities\Product;
use Marketplace\Product\Core\Domain\Values\Lists\ProductList;

interface ProductRepositoryContract
{
    public function getById(int $id): Product;

    public function get(FilterContract $filter, SorterContract $sorter): ProductList;
}
