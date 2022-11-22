<?php

namespace Database\Factories;

use App\Domain\Common\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domain\Vehicles\Models\VehicleType>
 */
class VehicleTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->randomElement([
                'HLF 20',
                'LF 10',
                'RTW'
            ]),

            'parent_id' => '1',
            'category_id' => Category::factory()
        ];
    }
}
