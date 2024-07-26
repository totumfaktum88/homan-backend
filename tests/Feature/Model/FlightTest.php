<?php

namespace Model;

use App\Models\Airplane;
use App\Models\Airport;
use App\Models\Flight;
use App\Models\Location\City;
use Carbon\Carbon;
use Tests\TestCase;

class FlightTest extends TestCase
{
    protected function getDummyData()
    {
        return [
            'departure_time' => Carbon::create('2024-08-01 08:00:00'),
            'arrival_time' =>  Carbon::create('2024-08-01 13:00:00'),
            'cancelled' => false
        ];
    }

    protected function createRelations()
    {
        $cities = City::query()->inRandomOrder()->limit(2)->get();
        $airportA = Airport::factory(1)->set('city_id', $cities->first()->id)->create()->first();
        $airportB = Airport::factory(1)->set('city_id', $cities->last()->id)->create()->first();

        $airplane = Airplane::factory(1)->create()->first();

        return [$airportA, $airportB, $airplane];
    }

    public function test_create(): void
    {
        [$airportA, $airportB, $airplane] = $this->createRelations();

        $data = [
            'departure_airport_id' => $airportA->id,
            'arrival_airport_id' => $airportB->id,
            'airplane_id' => $airplane->id,
            ...$this->getDummyData()
        ];

        $dataKeys = array_keys($data);

        $model = Flight::create($data);
        $modelData = array_filter($model->toArray(), fn($i, $k) => in_array($k, $dataKeys), ARRAY_FILTER_USE_BOTH);

        $this->assertEquals($data, $modelData);
    }

    public function test_create_by_factory(): void
    {
        [$airportA, $airportB, $airplane] = $this->createRelations();

        $model = Flight::factory(1)
            ->set('departure_airport_id', $airportA->id)
            ->set('arrival_airport_id', $airportB->id)
            ->set('airplane_id', $airplane->id)
            ->create()->first();

        $this->assertModelExists($model);
    }
}
