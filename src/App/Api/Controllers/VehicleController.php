<?php

namespace App\Api\Controllers;

use App\Controller;
use Domain\Stations\Actions\ListStations;
use Domain\Stations\Actions\ShowStation;
use Domain\Stations\Models\Station;
use Domain\Stations\Resources\StationResource;
use Domain\Vehicles\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index(Request $request, ListVehicles $action)
    {
        return $action->execute($request);
    }

    public function show(Station $station, ShowStation $action): StationResource
    {
        return $action->execute($station);
    }

    // ADDITIONAL ROUTES
    public function vehicles(Request $request, $stationId)
    {
        return Vehicle::query()
            ->with(['vehicleFitter', 'vehicleManufacturer', 'vehicleType'])
            ->where('station_id', $stationId)
            ->get();
    }
}
