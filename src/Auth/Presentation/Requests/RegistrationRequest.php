<?php

namespace Marketplace\Auth\Presentation\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property string $email
 * @property string $password
 * @property string $name
 */
class RegistrationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
                Rule::unique('users'),
                'max:255'
            ],
            'password' => [
                'required',
                'string',
                'confirmed',
                'min:6',
            ],
            'name' => [
                'required',
                'string',
                'max:255'
            ]
        ];
    }
}
