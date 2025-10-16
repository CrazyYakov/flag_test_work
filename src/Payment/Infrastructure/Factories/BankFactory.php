<?php

declare(strict_types=1);

namespace Marketplace\Payment\Infrastructure\Factories;

use Marketplace\Payment\Core\Domain\Values\Enums\PaymentMethodEnum;
use Marketplace\Payment\Infrastructure\Interfaces\PaymentMethodInterface;
use Marketplace\Payment\Infrastructure\Services\Banks\AlphaBank;
use Marketplace\Payment\Infrastructure\Services\Banks\BetaBank;

class BankFactory
{
    public function create(PaymentMethodEnum $paymentMethod): PaymentMethodInterface
    {
        return match ($paymentMethod) {
            PaymentMethodEnum::ALPHA_BANK => app(AlphaBank::class),
            PaymentMethodEnum::BETA_BANK => app(BetaBank::class),
        };
    }
}
