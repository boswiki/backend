<?php

namespace Database\Factories;

use App\Domain\Common\Models\Category;
use App\Domain\Common\Models\Organisation;
use App\Domain\Users\Models\User;
use App\Domain\Vehicles\Models\VehicleFitter;
use App\Domain\Vehicles\Models\VehicleManufacturer;
use App\Domain\Vehicles\Models\VehicleType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domain\Vehicles\Models\Vehicle>
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
