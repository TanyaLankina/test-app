<?php

namespace App\Http\Transformers\Products;

use App\Models\Product;
use Flugg\Responder\Transformers\Transformer;
use OpenApi\Attributes as OA;

class ProductTransformer extends Transformer
{
    #[OA\Schema(
        schema: 'Product',
        properties: [
            new OA\Property(
                property: 'id',
                type: 'int',
                example: 1
            ),
            new OA\Property(
                property: 'name',
                type: 'string',
                example: 'name'
            ),
            new OA\Property(
                property: 'price',
                type: 'object',
                example: 10000
            ),
            new OA\Property(
                property: 'order',
                type: 'int',
                example: 1
            ),
            new OA\Property(
                property: 'createdAt',
                type: 'datetime',
                example: '2024-01-29T13:16:48.000000Z'
            ),
            new OA\Property(
                property: 'updatedAt',
                type: 'datetime',
                example: '2024-01-29T13:16:48.000000Z'
            ),
        ],
        type: 'object',
    )]
    public function transform(Product $product): array
    {
        return [
            'id' => $product->id,
            'name' => $product->name,
            'order' => $product->order,
            'createdAt' => $product->created_at,
            'updatedAt' => $product->updated_at
        ];
    }
}
