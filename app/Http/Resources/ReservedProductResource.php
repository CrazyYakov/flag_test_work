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
            'title' => $this->product->title,
            'price' => $this->price,
            'count' => $this->count
        ];
    }
}
