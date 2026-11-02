<?php

namespace Marketplace\Order\Presentation\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Marketplace\Order\Core\Domain\Aggregates\Order;

/**
 * @property-read Order $resource
 */
class OrderResource extends JsonResource
{
    /**
     * @var array<string, string>
     */
    public $with = [
        'message' => 'order',
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
            'full_price' => $this->resource->getFullPrice(),
            'count' => $this->resource->getCount(),
            'products' => ReservedProductResource::collection($this->resource->productList),
        ];
    }
}
