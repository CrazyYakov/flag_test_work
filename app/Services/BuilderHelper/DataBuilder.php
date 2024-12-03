<?php

namespace App\Services\BuilderHelper;

class DataBuilder implements DataBuilderInterface
{
    private array $filters;
    private array $sorts;

    public function __construct(array $filters = [], array $sorts = [])
    {
        $this->filters = $filters;
        $this->sorts = $sorts;
    }

    public function setFilter(string $key, mixed $value): static
    {
        $this->filters[$key] = $value;

        return $this;
    }

    public function setSort(string $key, mixed $value): static
    {
        $this->sorts[$key] = $value;

        return $this;
    }

    public function getFilters(): array
    {
        return $this->filters;
    }

    public function getSorts(): array
    {
        return $this->sorts;
    }
}
