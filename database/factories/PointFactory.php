<?php

namespace Database\Factories;

use Domain\Common\Models\Organisation;
use Domain\Points\Models\Point;
use Domain\Stations\Models\Station;
use Domain\Users\Models\User;
use Domain\Vehicles\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Points\Models\Point>
 */
class PointFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Point::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $commentable = $this->commentable();

        return [
            'value' => $this->faker->randomNumber(3),
            'user_id' => User::factory(),
            'commentable_id' => $commentable::factory(),
            'commentable_type' => $commentable,
        ];
    }

    public function commentable()
    {
        return $this->faker->randomElement([
            Vehicle::class,
            Station::class,
            Organisation::class,
        ]);
    }
}
