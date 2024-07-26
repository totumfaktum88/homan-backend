<?php

namespace Tests\Feature\Model;

use App\Models\Airport;
use App\Models\Location\City;
use Tests\TestCase;

class AirportTest extends TestCase
{
    protected function getDummyData() {
        return [
            'displayed_name' => 'Liszt Ferenc Nemzetközi Repülőtér',
            'geo_lat' => 47.438516,
            'geo_lng' => 19.2514502
        ];
    }

    public function test_create_airport(): void {
        $city = City::query()->inRandomOrder()->first();

        $data = [
            'city_id' => $city->id,
            ...$this->getDummyData()
        ];

        $dataKeys = array_keys($data);

        $model = Airport::create($data);
        $modelData = array_filter($model->toArray(), fn($i, $k) => in_array($k, $dataKeys), ARRAY_FILTER_USE_BOTH);

        $this->assertEquals($data, $modelData);
    }

    public function test_create_by_factory(): void
    {
        $city = City::query()->inRandomOrder()->first();

        $model = Airport::factory(1)->set('city_id', $city->id)->create()->first();

        $this->assertModelExists($model);
    }

    public function test_create_through_city_relation(): void {
        $city = City::query()->inRandomOrder()->first();;

        $city->airports()->create(Airport::factory(1)->make()->first()->toArray());

        $this->assertEquals(1, $city->airports()->count());
    }
}
