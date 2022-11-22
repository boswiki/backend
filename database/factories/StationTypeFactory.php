<?php

namespace Database\Factories;

use App\Domain\Common\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domain\Stations\Models\StationType>
 */
class StationTypeFactory extends Factory
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
            'description' => '[]',
            'category_id' => Category::factory(),
        ];
    }
}
