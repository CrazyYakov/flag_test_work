<?php

declare(strict_types=1);

namespace Marketplace\Order\Core\Domain\Values\Enums;

enum PaymentMethodEnum: string
{
    case ALPHA_BANK = 'alpha_bank';

    case BETA_BANK = 'beta_bank';
}
