<?php

declare(strict_types=1);

namespace Marketplace\Cart\Core\Domain\Values\Enums;

enum OrderStatusEnum: int
{
     case ON_PAYMENT = 1;

     case PAID = 2;

     case CANCELED = 3;
}
