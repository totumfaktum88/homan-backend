<?php

namespace App\Services\Abstracts;

use App\Contracts\Data\ModelData;
use App\Contracts\RepositoryContract;
use App\DataTransferObjects\ResponseData;
use App\Exceptions\Repository\DeleteFailedException;
use App\Exceptions\Repository\StoreFailedException;
use App\Exceptions\Repository\UpdateFailedException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Spatie\LaravelData\Data;

abstract class RepositoryService implements RepositoryContract
{
    protected bool $responseMode = false;

    public function setResponseMode(bool $mode): static {
        $this->responseMode = $mode;

        return $this;
    }

    public function perPage(): int {
        return 10;
    }

    public function toResource(Model $model): JsonResource {
        return new ($this->getResource())($model);
    }

    public function toCollection(Paginator|Collection $data): AnonymousResourceCollection {
        return $this->getResource()::collection($data);
    }

    public function toResponse(ResponseData $data) {
        return response()->json($data->toArray());
    }

    public function query(): Builder {
        return $this->getModel()::query();
    }

    function filterBy(Data $filters): Builder {
        return $this->query();
    }

    public function list(Data $filters): LengthAwarePaginator|AnonymousResourceCollection {
        $query = $this->filterBy($filters)->paginate($this->perPage());

        return $this->responseMode ?
            $this->toCollection($query) :
            $query;
    }

    public function store(Data $data): Model|JsonResource
    {
        try {
            //DB::beginTransaction();

            $model = $this->getModel()::create($data->toArray());

            //DB::commit();

            return $this->responseMode ? $this->toResource($model) : $model;
        } catch(\Exception $e) {
            //DB::rollBack();

            throw new StoreFailedException($e->getMessage());
        }
    }

    public function update(Model $model, ModelData $data): Model|JsonResource
    {
        try {
            DB::beginTransaction();

            $model = $model->update($data->toArray());

            DB::commit();

            return $this->responseMode ? $this->toResource($model) : $model;
        } catch(\Exception $e) {
            DB::rollBack();

            throw new UpdateFailedException($e->getMessage());
        }
    }

    public function delete(Model $model): bool|JsonResponse
    {
        $result = false;

        try {
            DB::beginTransaction();

            $result = $model->delete();

            DB::commit();

        } catch(\Exception $e) {
            DB::rollBack();

            throw new DeleteFailedException($e->getMessage());
        }

        return $this->responseMode ? $this->toResponse(new ResponseData($result)) : $result;
    }
}
