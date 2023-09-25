<?php

namespace Support\Faker;

use Faker\Provider\Base;

class FireStationProvider extends Base
{
    public function fireStationName(): string
    {
        return static::randomElement([
                'Freiwillige Feuerwehr',
                'Berufsfeuerwehr',
                'Werkfeuerwehr',
            ]) . ' ' . fake()->city();
    }
}
