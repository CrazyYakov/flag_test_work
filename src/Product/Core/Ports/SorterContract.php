<?php

declare(strict_types=1);

namespace Marketplace\Product\Core\Ports;

interface SorterContract
{
    /**
     * @return array<string, mixed>
     */
    public function apply(): array;
}
