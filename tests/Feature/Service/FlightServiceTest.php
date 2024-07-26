<?php

namespace Service;

use App\DataTransferObjects\Flight\FilterData;
use App\Models\Airplane;
use App\Models\Airport;
use App\Models\Flight;
use App\Models\Location\City;
use App\Models\User;
use App\Services\FlightService;
use Carbon\Carbon;
use Tests\TestCase;

class FlightServiceTest extends TestCase
{
    protected $startDate = '2024-05-01 00:00:00';
    protected $endDate = '2024-05-20 23:59:59';

    public function createFlights() {
        $cities = City::query()->inRandomOrder()->limit(2)->get();
        $airportA = Airport::factory(1)->set('city_id', $cities->first()->id)->create()->first();
        $airportB = Airport::factory(1)->set('city_id', $cities->last()->id)->create()->first();

        $airplaneA = Airplane::factory(1)->create()->first();
        $airplaneB = Airplane::factory(1)->create()->first();

        $period = new \DatePeriod(
            new \DateTime($this->startDate),
            new \DateInterval('P1D'),
            new \DateTime($this->endDate)
        );

        foreach($period as $item) {
            Flight::factory(1)
                ->set('departure_airport_id', $airportA->id)
                ->set('arrival_airport_id', $airportB->id)
                ->set('airplane_id', $airplaneA->id)
                ->set('departure_time', $item->setTime(10,00))
                ->set('arrival_time', $item->setTime(13,00))
                ->create();

            Flight::factory(1)
                ->set('departure_airport_id', $airportB->id)
                ->set('arrival_airport_id', $airportA->id)
                ->set('airplane_id', $airplaneB->id)
                ->set('departure_time', $item->setTime(8,00))
                ->set('arrival_time', $item->setTime(11,00))
                ->create();
        }

        return [$cities];
    }

    public function test_filters(): void
    {
        [$cities] = $this->createFlights();

        $service = app(FlightService::class);

        $travelPeriod = 1;

        $randomStart = new \DateTime('@' .rand(strtotime($this->startDate), strtotime($this->endDate)));

        $filters = FilterData::from([
            'departure_city_id' => $cities->first()->id,
            'arrival_city_id' =>  $cities->last()->id,
            'departure_time' => $randomStart->format('Y-m-d'),
            'inbound_time' => $randomStart->add(new \DateInterval('P'.$travelPeriod.'D'))->format('Y-m-d'),
            'one_way_trip' => false
        ]);

        $this->assertEquals(2, $service->filterBy($filters)->count());

        $filters->one_way_trip = true;

        $this->assertEquals(1, $service->filterBy($filters)->count());
    }
}
