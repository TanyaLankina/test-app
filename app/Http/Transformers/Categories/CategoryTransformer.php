<?php

namespace App\Http\Transformers\Categories;

use App\Http\Transformers\Products\ProductTransformer;
use App\Models\Category;
use Flugg\Responder\Transformers\Transformer;
use OpenApi\Attributes as OA;

class CategoryTransformer extends Transformer
{
    #[OA\Schema(
        schema: 'Category',
        properties: [
            new OA\Property(
                property: 'id',
                type: 'int',
                example: 1
            ),
            new OA\Property(
                property: 'name',
                type: 'string',
                example: 'Категория'
            ),
            new OA\Property(
                property: 'order',
                type: 'int',
                example: 1
            ),
            new OA\Property(
                property: 'subcategories',
                type: 'array',
                items: new OA\Items(
                    properties: [
                        new OA\Property(
                            property: 'id',
                            type: 'int',
                            example: 2
                        ),
                        new OA\Property(
                            property: 'name',
                            type: 'string',
                            example: 'Категория 1'
                        ),
                        new OA\Property(
                            property: 'order',
                            type: 'int',
                            example: 0
                        ),
                        new OA\Property(
                            property: 'subcategories',
                            type: 'array',
                            items: new OA\Items(
                                ref: '#/components/schemas/Category'
                            )
                        ),
                        new OA\Property(
                            property: 'products',
                            type: 'array',
                            items: new OA\Items(
                                ref: '#/components/schemas/Product'
                            )
                        ),
                    ]
                ),
            ),
            new OA\Property(
                property: 'products',
                type: 'array',
                items: new OA\Items(
                    ref: '#/components/schemas/Product'
                )
            ),
        ],
        type: 'object',
    )]
    public function transform(Category $category): array
    {
        return [
            'id' => $category->id,
            'name' => $category->name,
            'order' => $category->order,
            'subcategories' => transformation(
                $category->subcategories,
                new CategoryTransformer()
            )->transform(),
            'products' => transformation(
                $category->products,
                new ProductTransformer())->transform()
        ];

    }
}
