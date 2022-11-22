<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domain\Stations\Models\District>
 */
class DistrictFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->country(),
            'bounding_box' => [
                [fake()->latitude(), fake()->longitude()],
                [fake()->latitude(), fake()->longitude()]
            ],
            'border' => fake()->filePath(),
            'location' => DB::raw('ST_SRID(Point('.fake()->longitude().', '.fake()->latitude().'), 4326)'),
        ];
    }
}
