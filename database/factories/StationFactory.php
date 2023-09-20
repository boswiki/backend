<?php

namespace Database\Factories;

use Domain\Common\Models\Address;
use Domain\Stations\Models\District;
use Domain\Stations\Models\Station;
use Domain\Stations\Models\StationType;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Stations\Models\Station>
 */
class StationFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Station::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->company(),
            'uuid' => Str::uuid()->toString(),
            'status' => fake()->randomElement([
                'proposed',
                'pending',
                'verified',
                'archived'
            ]),
            'website' => fake()->url(),
            'location' => DB::raw('ST_SRID(Point('.fake()->longitude().', '.fake()->latitude().'), 4326)'),
            'user_id' => User::factory(),
            'station_type_id' => StationType::factory(),
            'district_id' => District::factory(),
            'description' => json_encode([
                'text' => fake()->text()
            ]),
            'address_id' => Address::factory()->state([
                'addressable_type' => 'Domain\Stations\Models\Station',
            ])
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Station $station) {
            $station->address()->save(Address::factory()->make());
        });
    }
}
