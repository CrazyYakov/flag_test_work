<?php

namespace Marketplace\Cart\Presentation\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Marketplace\Cart\Core\Domain\Entities\ProductCart;

/**
 * @property-read ProductCart $resource
 */
class ProductInCartResource extends JsonResource
{
    public $with = [
        'status' => 'success',
        'message' => 'Product in Cart',
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
            'count' => $this->resource->count,
        ];
    }
}
