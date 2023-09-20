<?php

namespace Database\Factories;

use Domain\Stations\Models\District;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Stations\Models\District>
 */
class DistrictFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = District::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'uuid' => Str::uuid()->toString(),
            'name' => fake()->country(),
            'bounding_box' => DB::raw('ST_PolygonFromText("POLYGON((10 10, 10 20, 20 20, 20 10, 10 10))")'),
            'border' => DB::raw('ST_PolygonFromText("POLYGON((10 10, 10 20, 20 20, 20 10, 10 10))")'),
            'location' => DB::raw('ST_SRID(Point(' . fake()->numberBetween(-180, 180) . ', ' . fake()->numberBetween(-90, 90) . '), 4326)'),
        ];
    }
}
