<?php

namespace Marketplace\Order\Presentation\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read array $data
 */
class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'data.payment_method_id' => [
                'int',
                'required',
                'exists:payment_methods,id'
            ],
        ];
    }
}
