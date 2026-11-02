<?php

namespace Marketplace\Product\Presentation\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property-read float|null $filter_price
 * @property-read string $sort_price_dir
 */
class ProductFilterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, string|list<string>|ValidationRule>
     */
    public function rules(): array
    {
        return [
            'filter_price' => [
                'float',
            ],
            'sort_price_dir' => [
                'string',
                Rule::in(['asc', 'desc']),
            ],
        ];
    }
}
