<?php

declare(strict_types=1);

namespace Marketplace\Order\Infrastructure\Services;

enum OrderSorterEnum: string
{
    case CREATED_AT = 'created_at';
}
