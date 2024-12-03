<?php

namespace App\Services\Repositories\Interfaces;

use App\Models\Product;
use App\Services\BuilderHelper\DataBuilderInterface;

interface ProductRepositoryInterface
{
    public function getById(int $id): Product;

    public function get(DataBuilderInterface $dataBuilder);
}
