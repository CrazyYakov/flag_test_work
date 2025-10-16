<?php

declare(strict_types=1);

namespace Marketplace\Payment\Infrastructure\Repositories;

use App\Models\PaymentMethod as PaymentMethodModel;
use Marketplace\Payment\Core\Domain\Entities\PaymentMethod;
use Marketplace\Payment\Core\Domain\Values\List\PaymentMethodList;
use Marketplace\Payment\Infrastructure\Interfaces\PaymentMethodRepositoryInterface;

class PaymentMethodRepository implements PaymentMethodRepositoryInterface
{
    public function all(): PaymentMethodList
    {
        return new PaymentMethodList(
            PaymentMethodModel::query()
                ->get()
                ->map(
                    fn (PaymentMethodModel $paymentMethod) => new PaymentMethod($paymentMethod->id, $paymentMethod->title)
                )
                ->all()
        );
    }
}
