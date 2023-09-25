<?php

namespace Database\Factories;

use Domain\Users\Models\Punishment;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Users\Models\Punishment>
 */
class PunishmentFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Punishment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'reason' => $this->faker->realText(),
            'expires_in' => $this->faker->date(),
            'user_id' => User::factory()
        ];
    }
}
