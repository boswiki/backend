<?php

namespace App\Api\Controllers;

use App\Controller;
use Domain\Common\Models\Address;
use Domain\Stations\Actions\ShowStations;
use Domain\Stations\Models\Station;
use Domain\Stations\Resources\StationIndexResource;
use Domain\Stations\Resources\StationResource;
use Domain\Users\Models\User;
use Domain\Vehicles\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\select;

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
