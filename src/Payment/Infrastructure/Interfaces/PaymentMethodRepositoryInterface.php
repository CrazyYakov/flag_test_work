<?php

declare(strict_types=1);

namespace Marketplace\Payment\Infrastructure\Interfaces;

use Marketplace\Payment\Core\Domain\Values\List\PaymentMethodList;

interface PaymentMethodRepositoryInterface
{
    public function all(): PaymentMethodList;
}
