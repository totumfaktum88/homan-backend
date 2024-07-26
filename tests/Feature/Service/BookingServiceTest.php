<?php

namespace Service;

use App\DataTransferObjects\Booking\StoreData;
use App\Enums\Booking\AgeEnum;
use App\Enums\Booking\GenderEnum;
use App\Models\Airplane;
use App\Models\Airport;
use App\Models\Flight;
use App\Models\Location\City;
use App\Models\User;
use App\Services\BookingService;
use Tests\TestCase;

class BookingServiceTest extends TestCase
{
    protected $startDate = '2024-05-01 00:00:00';
    protected $endDate = '2024-05-20 23:59:59';

    public function createFlights() {
        $user = User::factory(1)->create()->first();
        $cities = City::query()->inRandomOrder()->limit(2)->get();
        $airportA = Airport::factory(1)->set('city_id', $cities->first()->id)->create()->first();
        $airportB = Airport::factory(1)->set('city_id', $cities->last()->id)->create()->first();

        $airplaneA = Airplane::factory(1)->create()->first();
        $airplaneB = Airplane::factory(1)->create()->first();

        return [$cities, $airportA, $airportB, $airplaneA, $airplaneB, $user];
    }

    public function test_basic_create(): void
    {
        [$cities, $airportA, $airportB, $airplaneA, $airplaneB, $user] = $this->createFlights();

        $from = new \DateTime($this->startDate);
        $to = new \DateTime($this->endDate);

        $flightA = Flight::factory(1)
            ->set('departure_airport_id', $airportA->id)
            ->set('arrival_airport_id', $airportB->id)
            ->set('airplane_id', $airplaneA->id)
            ->set('departure_time', $from->setTime(10,00))
            ->set('arrival_time', $from->setTime(13,00))
            ->create()->first();

        $flightB = Flight::factory(1)
            ->set('departure_airport_id', $airportB->id)
            ->set('arrival_airport_id', $airportA->id)
            ->set('airplane_id', $airplaneB->id)
            ->set('departure_time', $to->setTime(8,00))
            ->set('arrival_time', $to->setTime(11,00))
            ->create()->first();


        $service = app(BookingService::class);

        $data = StoreData::from([
            'user_id' => $user->id,
            'departure_city_id' => $cities->first()->id,
            'inbound_city_id' => $cities->last()->id,
            'one_way_trip' => false,
            'departure_date' => $from->format('Y-m-d'),
            'inbound_date' => $to->format('Y-m-d'),
            'passengers' => [
                [
                    'first_name' => 'Elek',
                    'last_name' => 'Teszt',
                    'age' => AgeEnum::adult->value,
                    'gender' => GenderEnum::male->value,
                    'flights' => [
                        [
                            'flight_id' => $flightA->id,
                            'row_number' => 1,
                            'seat_letter' => 'A',
                            'baggage_weight' => 10
                        ],
                        [
                            'flight_id' => $flightB->id,
                            'row_number' => 1,
                            'seat_letter' => 'A',
                            'baggage_weight' => 10
                        ]
                    ]
                ]
            ],
        ]);

        $model = $service->setResponseMode(false)->store($data);

        $this->assertModelExists($model);
        $this->assertEquals(1, $model->passengers()->count());
        $this->assertEquals(2, $model->flights()->count());
    }
}
