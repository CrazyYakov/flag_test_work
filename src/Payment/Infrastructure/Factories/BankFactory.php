<?php

declare(strict_types=1);

namespace Marketplace\Payment\Infrastructure\Factories;

use Marketplace\Payment\Core\Domain\Values\Enums\PaymentMethodEnum;
use Marketplace\Payment\Core\Ports\PaymentMethodContract;
use Marketplace\Payment\Infrastructure\Services\Banks\AlphaBank;
use Marketplace\Payment\Infrastructure\Services\Banks\BetaBank;

class BankFactory
{
    public function create(PaymentMethodEnum $paymentMethod): PaymentMethodContract
    {
        return match ($paymentMethod) {
            PaymentMethodEnum::ALPHA_BANK => app(AlphaBank::class),
            PaymentMethodEnum::BETA_BANK => app(BetaBank::class),
        };
    }
}
