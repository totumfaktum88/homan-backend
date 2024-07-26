<?php

namespace App\Services;

use App\Http\Resources\Booking\BookingResource;
use App\Models\Booking;
use App\Services\Abstracts\RepositoryService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use Spatie\LaravelData\Data;

class BookingService extends RepositoryService
{
    protected bool $responseMode = true;

    public function getModel(): string {
        return Booking::class;
    }

    public function getResource(): string {
        return BookingResource::class;
    }

    public function store(Data $data): Model|JsonResource {
        $this->setResponseMode(false);

        $model = parent::store($data);

        $this->storeRelations($model, $data);

        $this->setResponseMode(true);

        return $this->responseMode ? new BookingResource($model) : $model;
    }

    public function storeRelations(Model $model, Data $data) {
        foreach($data->passengers as $passenger) {
            $passengerModel = $model->passengers()->create($passenger);

            foreach($passenger['flights'] as $flight) {
                $model->flights()->create([...$flight, 'passenger_id' => $passengerModel->id]);
            }
        }
    }
}
