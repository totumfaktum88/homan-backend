<?php

namespace App\Http\Resources\Booking;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
        //return [
        //    'passengers' => PassengerResource::collection($this->whenLoaded('passengers')),
        //    'flights' => FlightResource::collection($this->whenLoaded('flights')),
        //];
    }
}
