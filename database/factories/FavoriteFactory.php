<?php

namespace Database\Factories;

use App\Models\Station;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Favorite>
 */
class FavoriteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $favoriteable = $this->favoriteable();

        return [
            'user_id' => User::factory(),
            'favoriteable_id' => $favoriteable::factory(),
            'favoriteable_type' => $favoriteable,
        ];
    }

    public function favoriteable()
    {
        return fake()->randomElement([
            Vehicle::class,
            Station::class,
        ]);
    }
}
