<?php

namespace App\Services\BuilderHelper;

use Illuminate\Database\Eloquent\Builder;
use LogicException;

trait CommandBuild
{
    public function build(DataBuilderInterface $dataBuilder): Builder
    {
        return $this->configBuilder()->handle($this, $dataBuilder);
    }

    protected function configBuilder(): ConfigBuilder
    {
        throw new LogicException('Please implement the configCommand method on your Builder.');
    }
}
