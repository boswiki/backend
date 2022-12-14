<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Organisation;
use App\Models\User;
use App\Models\VehicleFitter;
use App\Models\VehicleManufacturer;
use App\Models\VehicleType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->randomElement([
                'Florian Freising 47/1',
                'Florian München 1/42/1',
                'Rotkreuz München 1/71/2',
            ]),
            'description' => '[]',
            'construction_year' => fake()->year(),
            'commissioning_date' => fake()->date(),
            'decommissioning_date' => fake()->date(),
            'crew_count' => fake()->randomNumber(2),

            'category_id' => Category::factory(),
            'organisation_id' => Organisation::factory(),
            'user_id' => User::factory(),
            'vehicle_manufacturer_id' => VehicleManufacturer::factory(),

            'vehicle_type_id' => VehicleType::factory(),
            'vehicle_subtype_id' => VehicleType::factory(),

            'vehicle_fitter_id' => fake()->randomElement(null, VehicleFitter::factory())
        ];
    }
}
