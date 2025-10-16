<?php

declare(strict_types=1);

namespace Marketplace\Product\Presentation\View;

use Illuminate\Contracts\Support\Arrayable;
use Marketplace\Product\Core\Domain\Entities\Product;

class ProductView implements Arrayable
{
    public function __construct(
        private Product $product
    )
    {
    }

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
