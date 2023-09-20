<?php

namespace Database\Factories;

use Domain\Vehicles\Models\VehicleFitter;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Vehicles\Models\VehicleManufacturer>
 */
class VehicleFitterFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = VehicleFitter::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'uuid' => Str::uuid()->toString(),
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
