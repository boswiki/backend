<?php

namespace App\Api\Controllers;

use App\Actions\Stations\ListStations;
use App\Actions\Stations\ShowStation;
use App\Controller;
use Domain\Stations\Models\Station;
use Domain\Stations\Resources\StationIndexResource;
use Domain\Stations\Resources\StationResource;
use Illuminate\Http\Request;
use MatanYadaev\EloquentSpatial\Objects\Point;

class StationController extends Controller
{
    public function index(Request $request, ListStations $action)
    {
        return $action->execute($request);
    }

    public function show(Station $station, ShowStation $action): StationResource
    {
        return $action->execute($station);
    }
}
