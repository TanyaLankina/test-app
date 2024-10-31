<?php

namespace App\Http\Requests\Catalog;

use App\DTO\IndexData;
use App\Http\Requests\IndexRequest as BaseIndexRequest;
use Illuminate\Validation\Rule;

class IndexRequest extends BaseIndexRequest
{
    public function additionalRules(): array
    {
        return [
            'sorting.id' => ['filled', 'in:asc,desc'],
            'sorting.createdAt' => ['filled', 'in:asc,desc'],
            'sorting.updatedAt' => ['filled', 'in:asc,desc'],
            'sorting.order' => ['filled', 'in:asc,desc'],
        ];
    }

    public function getData(): IndexData
    {
        return IndexData::from($this->validated());
    }
}
