<?php

namespace App\Http\Requests;

use App\Services\BuilderHelper\DataBuilderInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductFilterRequest extends FormRequest implements DataBuilderInterface
{
    public function rules(): array
    {
        return [
            'filter_price' => [
                'string',
            ],
            'sort_price' => [
                'string',
                Rule::in(['asc', 'desc'])
            ]
        ];
    }

    public function getFilterPrice(): ?array
    {
        return $this->has('filter_price') ? explode(',', $this->get('filter_price')) : null;
    }

    public function getFilters(): array
    {
        return array_filter([
            $this->has('filter_price') ? explode(',', $this->get('filter_price')) : null
        ]);
    }

    public function getSorts(): array
    {
        return array_filter([
            $this->get('sort_price')
        ]);
    }
}