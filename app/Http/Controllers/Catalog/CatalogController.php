<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Requests\Catalog\IndexRequest;
use App\Http\Transformers\Categories\CategoryTransformer;
use App\Http\Controllers\Controller;
use App\Services\CatalogService;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;
use Spatie\RouteAttributes\Attributes\Get;

class CatalogController extends Controller
{
    public function __construct(protected CatalogService $catalogService)
    {
    }

    #[Get('catalog')]
    #[OA\Get(
        path: '/catalog',
        description: 'Get catalog',
        summary: 'Get catalog',
        tags: ['Catalog'],
        responses: [
            new OA\Response(
                response: 200, description: 'Success',
                content: new OA\MediaType('application/json',
                    schema: new OA\Schema(
                        properties: [
                            new OA\Property(
                                property: 'status',
                                type: 'int',
                                example: 200
                            ),
                            new OA\Property(
                                property: 'success',
                                type: 'string',
                                example: true
                            ),
                            new OA\Property(
                                property: 'data',
                                type: 'array',
                                items: new OA\Items(
                                    ref: '#/components/schemas/Category'
                                )
                            ),
                        ],
                        type: 'object',
                    ),
                )),
        ]
    )]
    public function index(IndexRequest $request): JsonResponse
    {
        $categories = $this->catalogService->index($request->getData());

        return responder()->success($categories, new CategoryTransformer())->respond();
    }
}
