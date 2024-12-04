<?php

namespace App\Http\Requests\Auth;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
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
