<?php

namespace Database\Factories;

use App\Domain\Common\Models\Address;
use App\Domain\Stations\Models\District;
use App\Domain\Stations\Models\StationType;
use App\Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domain\Stations\Models\Station>
 */
class StationFactory extends Factory
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
            'website' => fake()->url(),
            'location' => DB::raw('ST_SRID(Point('.fake()->longitude().', '.fake()->latitude().'), 4326)'),
            'user_id' => User::factory(),
            'station_type_id' => StationType::factory(),
            'district_id' => District::factory(),
            'address_id' => Address::factory()
        ];
    }
}
