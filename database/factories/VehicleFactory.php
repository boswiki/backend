<?php

namespace Database\Factories;

use Domain\Common\Models\Category;
use Domain\Common\Models\Organisation;
use Domain\Users\Models\User;
use Domain\Vehicles\Models\Vehicle;
use Domain\Vehicles\Models\VehicleFitter;
use Domain\Vehicles\Models\VehicleManufacturer;
use Domain\Vehicles\Models\VehicleType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Vehicles\Models\Vehicle>
 */
class VehicleFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Vehicle::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'uuid' => Str::uuid()->toString(),
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
