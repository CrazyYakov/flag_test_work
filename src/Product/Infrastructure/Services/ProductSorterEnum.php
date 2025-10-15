<?php

declare(strict_types=1);

namespace Marketplace\Product\Infrastructure\Services;

enum ProductSorterEnum: string
{
    case TITLE = 'title';
    case PRICE = 'price';
}
