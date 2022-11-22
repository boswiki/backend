<?php

namespace Database\Factories;

use App\Domain\Stations\Models\Station;
use App\Domain\Users\Models\User;
use App\Domain\Vehicles\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domain\Common\Models\Favorite>
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
