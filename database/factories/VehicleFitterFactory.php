<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VehicleManufacturer>
 */
class VehicleFitterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->company(),
            'street' => fake()->streetName(),
            'street_number' => fake()->randomNumber(1),
            'zip' => fake()->randomNumber(5),
            'city' => fake()->city(),
            'email' => fake()->companyEmail(),
            'website' => fake()->url()
        ];
    }
}
