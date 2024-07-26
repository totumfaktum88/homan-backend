<?php

namespace Database\Factories\Location;

use App\Models\Location\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location\Country>
 */
class CountryFactory extends Factory
{
    protected $model = Country::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'displayed_name' => $this->faker->country(),
            'code' => $this->faker->countryCode(),
            'geo_lat' => $this->faker->latitude,
            'geo_lng' => $this->faker->longitude,
        ];
    }
}
