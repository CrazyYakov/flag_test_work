<?php

namespace App\Http\Requests\Order;

use App\Services\BuilderHelper\DataBuilderInterface;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest implements DataBuilderInterface
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
