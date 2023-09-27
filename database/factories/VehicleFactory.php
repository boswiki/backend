<?php

namespace Database\Factories;

use Domain\Common\Models\Category;
use Domain\Common\Models\Organisation;
use Domain\Stations\Models\Station;
use Domain\Users\Models\User;
use Domain\Vehicles\Models\Vehicle;
use Domain\Vehicles\Models\VehicleFitter;
use Domain\Vehicles\Models\VehicleManufacturer;
use Domain\Vehicles\Models\VehicleType;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'name' => $this->faker->vehicleRadioName(),
            'description' => '[]',
            'construction_year' => $this->faker->year(),
            'commissioning_date' => $this->faker->date(),
            'decommissioning_date' => $this->faker->date(),
            'crew_count' => $this->faker->randomNumber(2),
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'station_id' => Station::factory(),
            'organisation_id' => Organisation::factory(),
            'vehicle_type_id' => VehicleType::factory(),
            'vehicle_manufacturer_id' => VehicleManufacturer::factory(),
            'vehicle_fitter_id' => VehicleFitter::factory(),
        ];
    }
}
