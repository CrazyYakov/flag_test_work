<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property float $price
 * @property int $count
 */
class ProductInCart extends Pivot
{
    public $incrementing = true;
}
