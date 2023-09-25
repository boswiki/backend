<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        \Illuminate\Database\Eloquent\Factories\Factory::guessFactoryNamesUsing(function (string $modelName) {
            return 'Database\\Factories\\' . class_basename($modelName) . 'Factory';
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'station' => 'Domain\Stations\Models\Station',
            'control_center' => 'Domain\Stations\Models\ControlCenter',
            'organisation' => 'Domain\Stations\Models\Organisation',
            'vehicle_fitters' => 'Domain\Vehicles\Models\VehicleFitter',
        ]);
    }
}
