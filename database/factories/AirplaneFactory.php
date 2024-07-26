<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Airplane>
 */
class AirplaneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => $this->faker->company(),
            'available_seats' => $this->faker->numberBetween(100, 400),
            'row_count' => $this->faker->numberBetween(25, 50),
            'seat_count' => $this->faker->numberBetween(6, 10),
            'seat_order' => $this->faker->shuffle([3,3], [3,3,3], [2, 4, 2], [3,4,3]),
            'max_baggage_weight' => $this->faker->numberBetween(15, 90),
            'max_baggage_count' => $this->faker->numberBetween(100, 700)
        ];
    }
}
