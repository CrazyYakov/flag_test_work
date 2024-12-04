<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservedProductResource extends JsonResource
{
    public $with = [
        'message' => 'reserved product'
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
            'price' => $this->reservedProduct->price,
            'count' => $this->reservedProduct->count
        ];
    }
}
