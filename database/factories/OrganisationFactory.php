<?php

namespace Database\Factories;

use App\Domain\Common\Models\Address;
use App\Domain\Common\Models\Category;
use App\Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domain\Common\Models\Organisation>
 */
class OrganisationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->company(),
            'website' => fake()->url(),
            'abbreviation' => fake()->name(),
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'address_id' => Address::factory()
        ];
    }
}
