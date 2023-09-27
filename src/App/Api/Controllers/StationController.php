<?php

namespace App\Api\Controllers;

use App\Controller;
use Domain\Stations\Models\Station;
use Domain\Stations\Resources\StationIndexResource;
use Domain\Stations\Resources\StationResource;
use Illuminate\Http\Request;

class StationController extends Controller
{
    public function index(Request $request)
    {
        return StationIndexResource::collection(Station::query()->paginate(30));
    }

    public function show(Request $request, Station $station)
    {
        return StationResource::make(
            $station->load('author', 'district', 'address', 'stationType', 'controlCenter')
        );
    }
}
