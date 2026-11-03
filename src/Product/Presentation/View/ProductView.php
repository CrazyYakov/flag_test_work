<?php

declare(strict_types=1);

namespace Marketplace\Product\Presentation\View;

use Illuminate\Contracts\Support\Arrayable;
use Marketplace\Product\Core\Domain\Entities\Product;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;

/**
 * @implements Arrayable<string, mixed>
 */
#[Schema(
    schema: 'productView',
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
class ProductView implements Arrayable
{
    public function __construct(
        private Product $product
    ) {}

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'id' => $this->product->id,
            'title' => $this->product->title,
            'price' => $this->product->price,
        ];
    }
}
