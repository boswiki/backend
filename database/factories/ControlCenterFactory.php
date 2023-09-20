<?php

namespace Database\Factories;

use Domain\Common\Models\Address;
use Domain\Stations\Models\ControlCenter;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

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
            'name' => fake()->company(),
            'location' => DB::raw('ST_SRID(Point('.fake()->longitude().', '.fake()->latitude().'), 4326)'),
            'address_id' => Address::factory()
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (ControlCenter $controlCenter) {
            $controlCenter->address()->save(Address::factory()->make());
        });
    }
}
