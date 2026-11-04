<?php

declare(strict_types=1);

namespace Marketplace\Product\Infrastructure\Services;

use Marketplace\Product\Core\Ports\SorterContract;

readonly class ProductSorter implements SorterContract
{
    public function __construct(
        private ProductSorterEnum $name,
        private ?string            $direction,
    ) {}

    public function apply(): array
    {
        if ($this->direction === null) {
            return [];
        }

        return [
            'sort' => [
                $this->name->value . ':' . $this->direction,
            ],
        ];
    }
}
