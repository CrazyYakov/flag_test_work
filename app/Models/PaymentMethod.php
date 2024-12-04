<?php

namespace App\Models;

use App\Services\Payments\Methods\PaymentMethodInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $title
 * @property string $class
 */
class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'class'
    ];

    protected $hidden = [
        'class'
    ];

    public $timestamps = false;

    public function getClass(): PaymentMethodInterface
    {
        return app($this->class);
    }
}
