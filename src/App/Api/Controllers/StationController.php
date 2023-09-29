<?php

namespace App\Api\Controllers;

use App\Controller;
use Domain\Stations\Models\Station;
use Domain\Stations\Resources\StationIndexResource;
use Domain\Stations\Resources\StationResource;
use Illuminate\Http\Request;
use MatanYadaev\EloquentSpatial\Objects\Point;

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
        )->additional([
            'nearbyStations' =>
                Station::query()
                    ->select('id', 'name')
                    ->whereDistance(
                        'location',
                        $point = new Point($station->location->latitude, $station->location->longitude, 4326),
                        '<',
                        8000
                    )
                    ->withDistanceSphere('location', $point, 'distanceInMeters')
                    ->orderByDistance('location', $point, 'asc')
                    ->where('id', '!=', $station->id)
                    ->limit(10)
                    ->get()
        ]);
    }
}
