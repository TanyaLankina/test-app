<?php

namespace App\Services;

use App\DTO\IndexData;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CatalogService
{
    public function index(IndexData $data): Collection|array
    {
        $categories = Category::query()->with([
            'products',
            'subcategories'
        ]);
        return $categories->get();
    }
}
