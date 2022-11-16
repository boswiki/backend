<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ControlCenter>
 */
class ControlCenterFactory extends Factory
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
            'location' => DB::raw('ST_SRID(Point('.fake()->longitude().', '.fake()->latitude().'), 4326)'),
        ];
    }
}
