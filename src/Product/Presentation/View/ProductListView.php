<?php

declare(strict_types=1);

namespace Marketplace\Product\Presentation\View;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;
use Marketplace\Product\Core\Domain\Entities\Product;
use Marketplace\Product\Core\Domain\Values\Lists\ProductList;

class ProductListView implements Arrayable
{
    public function __construct(
        private ProductList $productList
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return Arr::map(iterator_to_array($this->productList), function (Product $product) {
            return [
                'id' => $product->id,
                'title' => $product->title,
                'price' => $product->price,
            ];
        });
    }
}
