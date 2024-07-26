<?php

namespace Database\Factories;

use App\Models\Flight;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flight>
 */
class FlightFactory extends Factory
{
    protected $dateYearDiff = 1;
    protected $minFlightTime = 2;
    protected $maxFlightTime = 8;

    protected $model = Flight::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $departureTime = $this->faker->dateTime(now()->addYears($this->dateYearDiff)->format('Y-m-d H:i:s'));

        return [
            'departure_time' => $this->faker->dateTime(),
            'arrival_time' => Carbon::create($departureTime)->addHours($this->faker->numberBetween($this->minFlightTime, $this->maxFlightTime)),
            'cancelled' => $this->faker->boolean()
        ];
    }
}
