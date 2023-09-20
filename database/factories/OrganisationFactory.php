<?php

namespace Database\Factories;

use Domain\Common\Models\Address;
use Domain\Common\Models\Category;
use Domain\Common\Models\Organisation;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Common\Models\Organisation>
 */
class OrganisationFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Organisation::class;

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
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Organisation $organisation) {
            $organisation->address()->save(Address::factory()->make());
        });
    }
}
