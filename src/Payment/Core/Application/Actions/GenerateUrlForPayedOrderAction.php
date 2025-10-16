<?php

declare(strict_types=1);

namespace Marketplace\Payment\Core\Application\Actions;

use Marketplace\Payment\Core\Domain\Values\Enums\PaymentMethodEnum;
use Marketplace\Payment\Infrastructure\Factories\BankFactory;

class GenerateUrlForPayedOrderAction
{
    public function __construct(
        private BankFactory $bankFactory,
    ) {}

    public function run(PaymentMethodEnum $paymentMethod, string $token): string
    {
        $payment = $this->bankFactory->create($paymentMethod);

        $orderId = $payment->decodeTokenAndTakeOrderId($token);

        return url('/api/orders/payed/' . $orderId);
    }
}
