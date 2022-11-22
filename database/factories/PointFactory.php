<?php

namespace Database\Factories;

use App\Domain\Common\Models\Organisation;
use App\Domain\Stations\Models\Station;
use App\Domain\Users\Models\User;
use App\Domain\Vehicles\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domain\Points\Models\Point>
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
