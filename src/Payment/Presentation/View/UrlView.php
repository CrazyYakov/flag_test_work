<?php

declare(strict_types=1);

namespace Marketplace\Payment\Presentation\View;

use Illuminate\Contracts\Support\Arrayable;

class UrlView implements Arrayable
{
    public function __construct(
        public string $url
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'url' => $this->url
        ];
    }
}
