<?php

namespace App\Models;

use App\Models\Pivot\ProductInCart;
use App\Models\Pivot\ReservedProduct;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 * @property float $price
 * @property null|ReservedProduct $reservedProduct
 * @property null|ProductInCart $productInCart
 */
class Product extends Model
{
    /** @use HasFactory<ProductFactory> */
    use HasFactory;
    use Searchable;

    protected $casts = [
        'price' => 'float',
    ];
}
