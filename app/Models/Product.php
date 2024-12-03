<?php

namespace App\Models;

use App\Builders\ProductBuilder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property float $price
 * @property ReservedProduct $reservedProduct
 */
class Product extends Model
{
    protected static string $builder = ProductBuilder::class;

    protected $fillable = [
        'price',
    ];
}
