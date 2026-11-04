<?php

declare(strict_types=1);

namespace Marketplace\Product\Core\Ports;

interface FilterContract
{
    /**
     * @return array<string, mixed>
     */
    public function apply(): array;
}
