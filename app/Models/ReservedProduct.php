<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property float $price
 * @property int $count
 */
class ReservedProduct extends Pivot
{
    public $incrementing = true;
}
