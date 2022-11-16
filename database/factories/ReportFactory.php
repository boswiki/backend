<?php

namespace Database\Factories;

use App\Models\Station;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $reportable = $this->reportable();

        return [
            'content' => fake()->realText(),
            'user_id' => User::factory(),
            'reportable_id' => $reportable->factory(),
            'reportable_type' => $reportable
        ];
    }

    public function reportable()
    {
        return fake()->randomElement([
            Vehicle::class,
            Station::class,
        ]);
    }
}
