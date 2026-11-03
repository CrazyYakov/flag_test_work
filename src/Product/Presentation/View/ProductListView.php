<?php

declare(strict_types=1);

namespace Marketplace\Product\Presentation\View;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;
use Marketplace\Product\Core\Domain\Entities\Product;
use Marketplace\Product\Core\Domain\Values\Lists\ProductList;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;

/**
 * @implements Arrayable<string, mixed>
 */
#[Schema(
    schema: 'productListView',
    type: 'properties',
    properties: [
        new Property(
            property: 'id',
            type: 'int'
        ),
        new Property(
            property: 'title',
            type: 'string'
        ),
        new Property(
            property: 'price',
            type: 'float'
        ),
    ]
)]
class ProductListView implements Arrayable
{
    public function __construct(
        private ProductList $productList
    ) {}

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
