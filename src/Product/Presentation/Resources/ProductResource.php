<?php

namespace Marketplace\Product\Presentation\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Marketplace\Product\Core\Domain\Entities\Product;

/**
 * @property-read Product $product
 */
class ProductResource extends JsonResource
{
    public $with = [
        'status' => 'success',
        'message' => 'product',
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
        ];

    }
}
