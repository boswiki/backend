<?php

namespace Database\Factories;

use Domain\Common\Models\Address;
use Domain\Common\Models\Organisation;
use Domain\Stations\Models\ControlCenter;
use Domain\Stations\Models\District;
use Domain\Stations\Models\Station;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Common\Models\Address>
 */
class AddressFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $addressable = [
          Station::class,
          District::class,
          Organisation::class,
          ControlCenter::class
        ];

        return [
            'uuid' => Str::uuid()->toString(),
            'street' => fake()->streetName(),
            'number' => fake()->randomNumber(2),
            'city' => fake()->city(),
            'county' => fake()->country(),
            'country' => fake()->country(),
            'zip' => fake()->randomNumber(5),
            'addressable_type' => $addressableType = fake()->randomElement($addressable),
            'addressable_id' => $addressableType::factory()->create()->id,
        ];
    }
}
