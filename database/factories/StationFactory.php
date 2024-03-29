<?php

namespace Database\Factories;

use Domain\Stations\Models\ControlCenter;
use Domain\Stations\Models\District;
use Domain\Stations\Models\Station;
use Domain\Stations\Models\StationType;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use MatanYadaev\EloquentSpatial\Enums\Srid;
use MatanYadaev\EloquentSpatial\Objects\Point;

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
            'name' => $this->faker->fireStationName(),
            'status' => $this->faker->randomElement([
                'draft',
                'pending',
                'verified',
                'archived',
            ]),
            'website' => $this->faker->url(),
            'location' => new Point($this->faker->latitude, $this->faker->longitude, Srid::WGS84->value),
            'description' => json_encode([
                'text' => $this->faker->text(),
            ]),
            'user_id' => User::factory(),
            'station_type_id' => StationType::factory(),
            'district_id' => District::factory(),
            'control_center_id' => ControlCenter::factory(),
            'osm_id' => 'node/'.$this->faker->uuid(),
        ];
    }
}
