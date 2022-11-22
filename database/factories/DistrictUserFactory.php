<?php

namespace Database\Factories;

use App\Domain\Stations\Models\District;
use App\Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domain\Stations\Models\StationUser>
 */
class DistrictUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'district_id' => District::factory()
        ];
    }
}
