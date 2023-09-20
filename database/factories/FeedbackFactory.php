<?php

namespace Database\Factories;

use Domain\Feedback\Enums\Feedback;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Feedback\Models\Feedback>
 */
class FeedbackFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Feedback::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'type' => fake()->randomElement([
                Feedback::OTHER,
                Feedback::IDEA,
                Feedback::BUG,
                Feedback::PRAISE
            ]),
            'content' => fake()->realText(),
            'user_id' => User::factory()
        ];
    }
}
