<?php

namespace Database\Factories;

use Domain\Common\Models\Report;
use Domain\Stations\Models\Station;
use Domain\Users\Models\User;
use Domain\Vehicles\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Common\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Report::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $reportable = $this->reportable();

        return [
            'content' => $this->faker->realText(),
            'user_id' => User::factory(),
            'reportable_id' => $reportable->factory(),
            'reportable_type' => $reportable,
        ];
    }

    public function reportable()
    {
        return $this->faker->randomElement([
            Vehicle::class,
            Station::class,
        ]);
    }
}
