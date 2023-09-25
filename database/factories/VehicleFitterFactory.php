<?php

namespace Database\Factories;

use Domain\Users\Models\User;
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
            'user_id' => User::factory(),
            'name' => $this->faker->company(),
            'email' => $this->faker->companyEmail(),
            'website' => $this->faker->url()
        ];
    }
}
