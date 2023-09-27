<?php

namespace App\Api\Controllers;

use App\Controller;
use Domain\Common\Models\Address;
use Domain\Stations\Models\Station;
use Domain\Users\Models\User;
use Domain\Vehicles\Models\Vehicle;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function __invoke(Request $request)
    {
        return [
            ['name' => 'Wachen', 'value' => Station::query()->count()],
            ['name' => 'Adressen', 'value' => Address::query()->count()],
            ['name' => 'Nutzer', 'value' => User::query()->count()],
            ['name' => 'Fahrzeuge', 'value' => Vehicle::query()->count()],
        ];
    }
}
