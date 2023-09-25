<?php

namespace Database\Factories;

use Domain\Common\Models\Address;
use Domain\Stations\Models\ControlCenter;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
            'name' => 'Leitstelle ' . $this->faker->city(),
            'location' => DB::raw('ST_SRID(Point('.$this->faker->longitude().', '.$this->faker->latitude().'), 4326)'),
        ];
    }
}
