<?php

namespace App\Builders;

use App\Services\BuilderHelper\CommandBuild;
use App\Services\BuilderHelper\ConfigBuilder;
use Illuminate\Database\Eloquent\Builder;

class ProductBuilder extends Builder
{
    use CommandBuild;

    public function configBuilder(): ConfigBuilder
    {
        $configCommand = new ConfigBuilder();

        $configCommand->setConfigFilter('price', 'wherePrice');

        $configCommand->setConfigOrder('price', 'orderByPrice');

        return $configCommand;
    }

    public function orderByPrice(string $direction = 'asc'): static
    {
        return $this->orderBy('price', $direction);
    }

    public function wherePrice(array $price): static
    {
        return $this->whereBetween('price', $price);
    }
}
