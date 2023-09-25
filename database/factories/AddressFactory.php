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
        return [
            'street' => $this->faker->streetName(),
            'number' => $this->faker->randomNumber(2),
            'city' => $this->faker->city(),
            'county' => $this->faker->country(),
            'country' => $this->faker->country(),
            'zip' => $this->faker->randomNumber(5),

            'addressable_id' => Station::factory(),
            'addressable_type' => function (array $attributes) {
                return Station::find($attributes['addressable_id'])->getMorphClass();
            }
        ];
    }

    public function forModel(string $model): Factory
    {
        $addressable = [
            'district' => District::class,
            'organisation' => Organisation::class,
            'control_center' => ControlCenter::class
        ];

        if (empty($addressable[$model])) {
            throw new \Exception('Cannot create Model for ' .  $model);
        };

        return $this->state(function (array $attributes) use ($addressable, $model){
            return [
                'addressable_id' => $addressable[$model]::factory(),
                'addressable_type' => function (array $attributes) use ($addressable, $model){
                    return $addressable[$model]::find($attributes['addressable_id'])->getMorphClass();
                }
            ];
        });
    }
}
