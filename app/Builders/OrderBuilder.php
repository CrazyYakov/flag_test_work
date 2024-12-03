<?php

namespace App\Builders;

use App\Services\BuilderHelper\CommandBuilder;
use App\Services\BuilderHelper\ConfigBuilder;
use Illuminate\Database\Eloquent\Builder;

class OrderBuilder extends Builder
{
    use CommandBuilder;

    protected function configBuilder(): ConfigBuilder
    {
        $configBuilder = new ConfigBuilder();

        $configBuilder->setConfigOrder('created_at', 'orderByCreatedAt');

        $configBuilder->setConfigFilter('status', 'whereStatus');

        return $configBuilder;
    }

    public function orderByCreatedAt(string $direction = 'asc'): static
    {
        return $this->orderBy('created_at', $direction);
    }

    public function whereStatus($status): static
    {
        return $this->where('status', $status);
    }
}
