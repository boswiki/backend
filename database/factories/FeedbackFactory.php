<?php

namespace Database\Factories;

use App\Domain\Feedback\Enums\Feedback;
use App\Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domain\Feedback\Models\Feedback>
 */
class FeedbackFactory extends Factory
{
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
