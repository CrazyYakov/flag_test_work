<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductInCartResource extends JsonResource
{
    public $with = [
        'message' => 'Product in Cart'
    ];

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => $this->productInCart->price,
            'count' => $this->productInCart->count
        ];
    }
}
