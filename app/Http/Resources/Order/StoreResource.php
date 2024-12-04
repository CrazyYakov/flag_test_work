<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\ReservedProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
{
    public $with = [
        'message' => 'create order'
    ];

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'url' => $this->url,
            'full_price' => $this->full_price,
            'count' => $this->count,
            'products' => ReservedProductResource::collection($this->products),
        ];
    }
}