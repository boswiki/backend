<?php

namespace Database\Factories;

use Domain\Stations\Models\ControlCenter;
use Illuminate\Database\Eloquent\Factories\Factory;
use MatanYadaev\EloquentSpatial\Enums\Srid;
use MatanYadaev\EloquentSpatial\Objects\Point;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Stations\Models\ControlCenter>
 */
class ControlCenterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = ControlCenter::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => 'Leitstelle '.$this->faker->city(),
            'location' => new Point($this->faker->latitude, $this->faker->longitude, Srid::WGS84->value),
            'website' => $this->faker->url(),
            'osm_id' => 'node/'.$this->faker->uuid(),
        ];
    }
}
