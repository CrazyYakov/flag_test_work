<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentMethodResource extends JsonResource
{
    public $with = [
        'message' => 'payment method'
    ];

    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
