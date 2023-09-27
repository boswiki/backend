<?php

namespace App\Providers;

use Faker\Factory;
use Faker\Generator;
use Illuminate\Support\ServiceProvider;
use Support\Faker\FireStationProvider;
use Support\Faker\VehicleProvider;

class FakerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Generator::class, function () {
            $faker = Factory::create();

            $faker->addProvider(new FireStationProvider($faker));
            $faker->addProvider(new VehicleProvider($faker));

            return $faker;
        });
    }
}
