<?php

namespace Database\Factories;

use Domain\Common\Models\Category;
use Domain\Stations\Models\StationType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Stations\Models\StationType>
 */
class StationTypeFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = StationType::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'uuid' => Str::uuid()->toString(),
            'name' => fake()->company(),
            'description' => '[]',
            'category_id' => Category::factory(),
        ];
    }
}
