<?php

namespace App\Services\BuilderHelper;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use OutOfRangeException;

class ConfigBuilder
{
    private array $configFilter;
    private array $configOrder;

    public function __construct(array $configFilter = [], array $configOrder = [])
    {
        $this->configFilter = $configFilter;
        $this->configOrder = $configOrder;
    }

    public function setConfigFilter(string $key, string $method): static
    {
        $this->configFilter[$key] = $method;

        return $this;
    }

    public function setConfigOrder(string $key, string $method): static
    {
        $this->configOrder[$key] = $method;

        return $this;
    }


    public function getMethodFilter($key): string
    {
        if (array_key_exists($key, $this->configFilter)) {
            throw new OutOfRangeException("Method filter By [$key] not found");
        }

        return $this->configFilter[$key];
    }

    public function getMethodOrder($key): string
    {
        if (array_key_exists($key, $this->configOrder)) {
            throw new OutOfRangeException("Method order By [$key] not found");
        }

        return $this->configOrder[$key];
    }

    public function handle(Builder $builder, DataBuilderInterface $dataBuilder): Builder
    {
        Arr::map(
            $dataBuilder->getFilters(),
            fn($value, $key) => call_user_func([$builder, $this->getMethodFilter($key), $value])
        );

        Arr::map(
            $dataBuilder->getSorts(),
            fn($value, $key) => call_user_func([$builder, $this->getMethodOrder($key), $value])
        );

        return $builder;

    }
}
