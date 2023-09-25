<?php

namespace Support\Faker;

use Faker\Provider\Base;

class VehicleProvider extends Base
{
    public function vehicleRadioName(): string
    {
        $name = fake()->randomElement([
            'Florian',
            'Rotkreuz',
            'Herkules',
            'Johanniter',
            'Malteser',
            'Küstenwache',
            'Otto',
            'Vara',
            'Viktor',
        ]);

        $city = fake()->city();

        $numberPattern = fake()->randomElement([
            fake()->numberBetween(1, 99) . '/' . fake()->numberBetween(1, 99),
            fake()->numberBetween(1, 99) . '/' . fake()->numberBetween(1, 99) . '/' . fake()->numberBetween(1, 9),
        ]);

        return $name . ' ' . $city . ' ' . $numberPattern;
    }
}
