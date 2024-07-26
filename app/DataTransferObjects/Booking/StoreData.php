<?php

namespace App\DataTransferObjects\Booking;

use Spatie\LaravelData\Data;

class StoreData extends Data
{
    public function __construct(
        public int $user_id,
        public int $departure_city_id,
        public int $inbound_city_id,
        public int $one_way_trip,
        public string $departure_date,
        public string $inbound_date,
        public array $passengers
    ) {}
}
