<?php

namespace App\Contracts;

use App\Contracts\Data\FilterData;
use App\Contracts\Data\ModelData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\LaravelData\Data;

interface RepositoryContract
{
    public function perPage(): int;

    public function getModel(): string;

    public function getResource(): string;

    public function toResource(Model $model): JsonResource;

    public function toCollection(Collection $collection): AnonymousResourceCollection;

    public function query(): Builder;

    public function filterBy(Data $filters): Builder;

    public function list(Data $filters): LengthAwarePaginator|AnonymousResourceCollection;

    public function store(Data $data): Model | JsonResource;

    public function update(Model $model, ModelData $data): Model | JsonResource;

    public function delete(Model $model): bool | JsonResponse;
}
