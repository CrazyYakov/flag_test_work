<?php

namespace App\Http\Requests;

use App\Services\BuilderHelper\DataBuilderInterface;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest implements DataBuilderInterface
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
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

    public function getFilters(): array
    {
        return array_filter([
            'filter_status' => $this->get('filter_status')
        ]);
    }

    public function getSorts(): array
    {
        return array_filter([
            'sort_created_at' => $this->has('sort_created_at') ? $this->get('sort_created_at') : null
        ]);
    }
}
