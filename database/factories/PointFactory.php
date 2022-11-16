<?php

namespace Database\Factories;

use App\Models\Organisation;
use App\Models\Station;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Point>
 */
class PointFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $commentable = $this->commentable();

        return [
            'value' => fake()->randomNumber(3),
            'user_id' => User::factory(),
            'commentable_id' => $commentable::factory(),
            'commentable_type' => $commentable,
        ];
    }

    public function commentable()
    {
        return fake()->randomElement([
            Vehicle::class,
            Station::class,
            Organisation::class,
        ]);
    }
}
