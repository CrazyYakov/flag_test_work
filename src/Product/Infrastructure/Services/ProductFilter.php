<?php

declare(strict_types=1);

namespace Marketplace\Product\Infrastructure\Services;

use Marketplace\Product\Core\Ports\FilterContract;

readonly class ProductFilter implements FilterContract
{
    public function __construct(
        protected ?float $price,
        protected ?string $search,
    ) {}

    public function apply(): array
    {
        $options = [
            'attributesToSearchOn' => [
                'price',
                'title',
            ],
        ];

        if ($this->search !== null) {
            $options['search'] = $this->search;
        }

        if ($this->price !== null) {
            $options['filter'] = [
                'price = ' . $this->price,
            ];
        }

        return $options;
    }
}
