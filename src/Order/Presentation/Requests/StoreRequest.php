<?php

namespace Marketplace\Order\Presentation\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read array<string, mixed> $data
 */
class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, string|list<string>|ValidationRule>
     */
    public function rules(): array
    {
        return [
            'data.payment_method_id' => [
                'int',
                'required',
                'exists:payment_methods,id',
            ],
        ];
    }
}
