<?php

namespace Marketplace\Product\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property-read float|null $filter_price
 * @property-read string $sort_price_dir
 */
class ProductFilterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'filter_price' => [
                'float',
            ],
            'sort_price_dir' => [
                'string',
                Rule::in(['asc', 'desc'])
            ]
        ];
    }
}
