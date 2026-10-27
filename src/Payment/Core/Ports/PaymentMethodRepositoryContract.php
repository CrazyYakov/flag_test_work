<?php

declare(strict_types=1);

namespace Marketplace\Payment\Core\Ports;

use Marketplace\Payment\Core\Domain\Values\List\PaymentMethodList;

interface PaymentMethodRepositoryContract
{
    public function all(): PaymentMethodList;
}
