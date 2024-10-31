<?php

namespace App\Http\Requests;

use App\DTO\IndexData;
use Illuminate\Foundation\Http\FormRequest;

/**
 * properties.
 *
 * @property int $page
 * @property int $perPage
 * @property bool $paginate
 * @property array $sorting
 * @property array $filtering
 */
class IndexRequest extends FormRequest
{
    final public function rules(): array
    {
        $rules = $this->additionalRules();

        return $this->injectPaginationRules($rules);
    }

    final protected function prepareForValidation(): void
    {
        $this->injectDefaultPaginationValues();
    }

    protected function additionalRules(): array
    {
        return [];
    }

    protected function injectPaginationRules(array $rules = []): array
    {
        $rules['page'] = ['filled', 'integer', 'min:1'];
        $rules['perPage'] = ['filled', 'integer', 'min:1'];
        $rules['paginate'] = ['required', 'boolean'];
        $rules['sorting'] = ['nullable', 'array'];
        $rules['filtering'] = ['nullable', 'array'];
        $rules['searching'] = ['nullable', 'array'];

        return $rules;
    }

    protected function injectDefaultPaginationValues(): void
    {
        $this->merge([
            'page' => data_get($this, 'page', 1),
            'perPage' => data_get($this, 'perPage', 15),
            'paginate' => data_get($this, 'paginate', true),
            'sorting' => data_get($this, 'sorting', []),
            'filtering' => data_get($this, 'filtering', []),
            'searching' => data_get($this, 'searching', []),
        ]);
    }

    public function getData(): IndexData
    {
        return IndexData::from($this->validated());
    }
}
