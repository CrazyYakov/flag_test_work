<?php

declare(strict_types=1);

namespace Marketplace\Order\Core\Ports;

use Illuminate\Contracts\Database\Eloquent\Builder;

interface SorterContract
{
    public function apply(Builder $builder): Builder;
}
