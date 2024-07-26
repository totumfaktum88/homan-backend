<?php

namespace Database\Factories\Location;

use App\Models\Location\City;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location\City>
 */
class CityFactory extends Factory
{
    protected $model = City::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'displayed_name' => $this->faker->city(),
            'geo_lat' => $this->faker->latitude,
            'geo_lng' => $this->faker->longitude,
        ];
    }
}
