<?php

declare(strict_types=1);

namespace Marketplace\Product\Core\Ports;

use Illuminate\Contracts\Database\Eloquent\Builder;

interface FilterContract
{
    public function apply(Builder $builder): Builder;
}
