<?php

declare(strict_types=1);

namespace Marketplace\Payment\Presentation\View;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;
use Marketplace\Payment\Core\Domain\Entities\PaymentMethod;
use Marketplace\Payment\Core\Domain\Values\List\PaymentMethodList;

class PaymentMethodListView implements Arrayable
{
    public function __construct(
        private readonly PaymentMethodList $list
    ) {}

    public function toArray(): array
    {
        return Arr::map(iterator_to_array($this->list), function (PaymentMethod $paymentMethod) {
            return [
                'id' => $paymentMethod->id,
                'title' => $paymentMethod->title
            ];
        });
    }
}
