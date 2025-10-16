<?php

declare(strict_types=1);

namespace Marketplace\Order\Infrastructure\Interfaces;

use Illuminate\Contracts\Database\Eloquent\Builder;

interface SorterInterface
{
    public function apply(Builder $builder): Builder;
}
