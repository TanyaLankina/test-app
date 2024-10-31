<?php

namespace App\DTO;

use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Optional;

#[MapOutputName(SnakeCaseMapper::class)]
class IndexData extends Data
{
    public int $page;

    public int $perPage;

    public bool|Optional $paginate;

    public array|Optional $sorting = [];

    public array|Optional $filtering = [];

    public array|Optional $searching = [];
}
