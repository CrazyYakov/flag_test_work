<?php

namespace App\Services\Repositories;

use App\Models\Product;
use App\Services\BuilderHelper\DataBuilderInterface;
class ProductRepository implements Interfaces\ProductRepositoryInterface
{
    public function getById(int $id): Product
    {
        return Product::query()->findOrFail($id);
    }

    public function get(DataBuilderInterface $dataBuilder)
    {
        return Product::query()->build($dataBuilder)->get();
    }
}
