<?php

declare(strict_types=1);

namespace Marketplace\Product\Infrastructure\Interfaces;

use Illuminate\Contracts\Database\Eloquent\Builder;

interface FilterInterface
{
    public function apply(Builder $builder): Builder;
}
