<?php

declare(strict_types=1);

namespace Marketplace\Cart\Presentation\View;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;
use Marketplace\Cart\Core\Domain\Entities\ProductCart;
use Marketplace\Cart\Core\Domain\Values\List\ProductInCartList;

class ProductInCartListView implements Arrayable
{
    public function __construct(
        private ProductInCartList $productInCartList
    ) {}

    public function toArray(): array
    {
        return Arr::map(iterator_to_array($this->productInCartList), function (ProductCart $productCart) {
            return [
                'id' => $productCart->id,
                'title' => $productCart->title,
                'price' => $productCart->price,
                'count' => $productCart->count,
            ];
        });
    }
}
