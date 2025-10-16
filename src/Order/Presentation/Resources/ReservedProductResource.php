<?php

namespace Marketplace\Order\Presentation\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Marketplace\Order\Core\Domain\Entities\Product;

/**
 * @property-read Product $resource
 */
class ReservedProductResource extends JsonResource
{
    public $with = [
        'message' => 'reserved product',
        'status' => 'success',
    ];

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'price' => $this->resource->price,
            'quantity' => $this->resource->quantity
        ];
    }
}
