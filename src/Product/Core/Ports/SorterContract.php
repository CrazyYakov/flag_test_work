<?php

declare(strict_types=1);

namespace Marketplace\Product\Core\Ports;

use Illuminate\Contracts\Database\Eloquent\Builder;

interface SorterContract
{
    public function apply(Builder $builder): Builder;
}
