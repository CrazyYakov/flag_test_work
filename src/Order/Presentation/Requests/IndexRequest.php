<?php

namespace Marketplace\Order\Presentation\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read int|null $filter_status
 * @property-read string $sort_created_at
 */
class IndexRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'filter_status' => [
                'int'
            ],
            'sort_created_at' => [
                'string'
            ]
        ];
    }
}
