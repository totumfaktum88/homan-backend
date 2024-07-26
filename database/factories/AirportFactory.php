<?php

namespace Database\Factories;

use App\Models\Airport;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Airport>
 */
class AirportFactory extends Factory
{
    protected $model = Airport::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'displayed_name' => $this->faker->company(),
            'geo_lat' => $this->faker->latitude(),
            'geo_lng' => $this->faker->longitude(),
        ];
    }
}
