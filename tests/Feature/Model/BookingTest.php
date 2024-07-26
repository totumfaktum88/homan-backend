<?php

namespace Model;

use App\Models\Airplane;
use App\Models\Airport;
use App\Models\Booking;
use App\Models\Flight;
use App\Models\Location\City;
use App\Models\User;
use Carbon\Carbon;
use Tests\TestCase;

class BookingTest extends TestCase
{
    protected function createAllRelations()
    {
        $user = User::factory(1)->create()->first();
        $cities = City::query()->inRandomOrder()->limit(2)->get();
        $airportA = Airport::factory(1)->set('city_id', $cities->first()->id)->create()->first();
        $airportB = Airport::factory(1)->set('city_id', $cities->last()->id)->create()->first();

        $airplaneA = Airplane::factory(1)->create()->first();
        $airplaneB = Airplane::factory(1)->create()->first();

        $flightA = Flight::factory(1)
            ->set('departure_airport_id', $airportA->id)
            ->set('arrival_airport_id', $airportB->id)
            ->set('airplane_id', $airplaneA->id)
            ->create()->first();
        $flightB = Flight::factory(1)
            ->set('departure_airport_id', $airportA->id)
            ->set('arrival_airport_id', $airportB->id)
            ->set('airplane_id', $airplaneB->id)
            ->create()->first();

        return [$user, $flightA, $flightB];
    }


    public function test_create_booking(): void
    {
        $user = User::factory(1)->create()->first();

        $data = [
            'user_id' => $user->id
        ];

        $dataKeys = array_keys($data);

        $model = Booking::create($data);
        $modelData = array_filter($model->toArray(), fn($i, $k) => in_array($k, $dataKeys), ARRAY_FILTER_USE_BOTH);

        $this->assertEquals($data, $modelData);
    }

    public function test_create_booking_through_user_relation(): void
    {
        [$user, $flightA, $flightB] = $this->createAllRelations();

        $model = $user->bookings()->create();

        $this->assertModelExists($model);
    }

    public function test_create_booking_with_one_passenger(): void
    {
        [$user, $flightA, $flightB] = $this->createAllRelations();

        $model = $user->bookings()->create();

        $this->assertModelExists(
            $model->passengers()->create([
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'gender' => 'male',
                'age' => 'adult'
            ])
        );

        $this->assertEquals(1, $model->passengers()->count());
    }

    public function test_create_booking_with_one_passenger_one_flight(): void
    {
        [$user, $flightA, $flightB] = $this->createAllRelations();

        $model = $user->bookings()->create();

        $passenger = $model->passengers()->create([
            'booking_id' => $model->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'gender' => 'male',
            'age' => 'adult'
        ]);

        $this->assertModelExists(
            $model->flights()->create([
                'booking_id' => $model->id,
                'passenger_id' => $passenger->id,
                'flight_id' => $flightA->id,
                'row_number' => 1,
                'seat_letter' => 'A',
                'baggage_weight' => 0,
            ])
        );


        $this->assertEquals(1, $model->flights()->count());
    }
}
