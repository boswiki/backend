<?php

namespace App\Api\Controllers;

use App\Controller;
use Domain\Stations\Actions\ShowStations;
use Domain\Stations\Models\Station;
use Domain\Stations\Resources\StationResource;
use Illuminate\Http\Request;

class StationController extends Controller
{
    public function index(Request $request)
    {
        return StationResource::collection(
            Station::query()
                ->paginate(30)
        );
    }

    public function show(Request $request, Station $station)
    {
        return StationResource::make($station->load('district', 'address', 'stationType'));
    }
}
