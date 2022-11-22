<?php

namespace Database\Factories;

use App\Domain\Stations\Models\Station;
use App\Domain\Users\Models\User;
use App\Domain\Vehicles\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domain\Common\Models\Report>
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
