<?php

declare(strict_types=1);

namespace Marketplace\Cart\Infrastructure\Repositories;

use App\Models\Product as ProductModel;
use Marketplace\Cart\Core\Domain\Entities\Product;
use Marketplace\Cart\Infrastructure\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function getById(int $id): Product
    {
        return transform(
            ProductModel::findOrFail($id),
            fn(ProductModel $product) => new Product($product->id, $product->price)
        );
    }
}
