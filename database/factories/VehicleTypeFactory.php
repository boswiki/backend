<?php

namespace Database\Factories;

use Domain\Common\Models\Category;
use Domain\Vehicles\Models\VehicleType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Vehicles\Models\VehicleType>
 */
class VehicleTypeFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = VehicleType::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'uuid' => Str::uuid()->toString(),
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
