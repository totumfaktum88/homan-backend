<?php

namespace App\Services;

use App\DataTransferObjects\Flight\FilterData;
use App\Http\Resources\Booking\BookingResource;
use App\Http\Resources\Booking\FlightResource;
use App\Models\Booking;
use App\Models\Flight;
use App\Services\Abstracts\RepositoryService;
use Illuminate\Database\Eloquent\Builder;
use Nnjeim\World\World;
use Spatie\LaravelData\Data;

class FlightService extends RepositoryService
{
    public function getModel(): string {
        return Flight::class;
    }

    public function getResource(): string {
        return FlightResource::class;
    }

    public function getFilterData(): string {
        return FilterData::class;
    }

    public function filterBy(Data $filters): Builder {
        $query = parent::query()->where(function($query) use($filters) {
            $query->whereHas('departureAirport', fn($query) => $query->where('city_id', $filters->departure_city_id))
                ->whereHas('arrivalAirport', fn($query) => $query->where('city_id', $filters->arrival_city_id))
                ->whereDate('departure_time', $filters->departure_time);
        });

        if (!$filters->one_way_trip) {
            $query->orWhere(function($query) use($filters) {
                $query->whereHas('departureAirport', fn($query) => $query->where('city_id', $filters->arrival_city_id))
                    ->whereHas('arrivalAirport', fn($query) => $query->where('city_id', $filters->departure_city_id))
                    ->whereDate('departure_time', $filters->inbound_time);
            });
        }

        return $query;
    }
}
