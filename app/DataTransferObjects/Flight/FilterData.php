<?php

namespace App\DataTransferObjects\Flight;

use Spatie\LaravelData\Data;

class FilterData extends Data
{
    public function __construct(
        public int $departure_city_id,
        public int $arrival_city_id,
        public string $departure_time,
        public string $inbound_time,
        public bool $one_way_trip
    ) {}
}
