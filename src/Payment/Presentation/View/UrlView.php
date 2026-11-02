<?php

declare(strict_types=1);

namespace Marketplace\Payment\Presentation\View;

use Illuminate\Contracts\Support\Arrayable;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;

/**
 * @implements Arrayable<string, mixed>
 */
#[Schema(
    schema: 'UrlView',
    properties: [
        new Property(
            property: 'url',
            type: 'string',
        )
    ]
)]
class UrlView implements Arrayable
{
    public function __construct(
        public string $url
    ) {}

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'url' => $this->url,
        ];
    }
}
