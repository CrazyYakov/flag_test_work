<?php

declare(strict_types=1);

namespace Marketplace\Order\Core\Domain\Values\Enums;

enum OrderStatusEnum: int
{
     case ON_PAYMENT = 1;

     case PAID = 2;

     case CANCELED = 3;

    public function label(): string
    {
        return match ($this) {
            self::ON_PAYMENT => 'На оплату',
            self::PAID => 'Оплачено',
            self::CANCELED => 'Отменен',
        };
     }
}
