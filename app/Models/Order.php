<?php

namespace App\Models;

use App\Builders\OrderBuilder;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected static string $builder = OrderBuilder::class;

    protected $fillable = [

    ];
}
