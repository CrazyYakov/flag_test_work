<?php

namespace App\Services\BuilderHelper;

interface DataBuilderInterface
{
    public function getFilters(): array;

    public function getSorts(): array;
}
