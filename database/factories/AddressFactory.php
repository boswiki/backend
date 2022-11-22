<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domain\Common\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'street' => fake()->streetName(),
            'number' => fake()->randomNumber(2),
            'zip' => fake()->randomNumber(5),
            'county' => fake()->country(),
            'country' => fake()->country(),
        ];
    }
}
