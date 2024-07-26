<?php

namespace Model;

use App\Models\Airplane;
use App\Models\Airport;
use App\Models\Location\City;
use App\Models\Location\Country;
use Tests\TestCase;

class AirplaneTest extends TestCase
{
    protected function getDummyData() {
        return [
            'type' => 'Boeing 737',
            'available_seats' => 450,
            'row_count' => 45,
            'seat_count' => 10,
            'seat_order' => [3, 4, 3],
            'max_baggage_weight' => 80000,
            'max_baggage_count' => 400
        ];
    }

    public function test_create_airport(): void {
        $data = $this->getDummyData();

        $dataKeys = array_keys($data);

        $model = Airplane::create($data);
        $modelData = array_filter($model->toArray(), fn($i, $k) => in_array($k, $dataKeys), ARRAY_FILTER_USE_BOTH);

        $this->assertEquals($data, $modelData);
    }

    public function test_create_by_factory(): void {

    }

    public function test_available_seats(): void {

    }

    public function test_seat_orders(): void {

    }
}
