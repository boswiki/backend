<?php

namespace Database\Factories;

use Domain\Common\Models\Favorite;
use Domain\Stations\Models\Station;
use Domain\Users\Models\User;
use Domain\Vehicles\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Common\Models\Favorite>
 */
class FavoriteFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Favorite::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $favorable = $this->favorable();

        return [
            'user_id' => User::factory(),
            'favorable_id' => $favorable::factory(),
            'favorable_type' => $favorable,
        ];
    }

    public function favorable()
    {
        return $this->faker->randomElement([
            Vehicle::class,
            Station::class,
        ]);
    }
}
