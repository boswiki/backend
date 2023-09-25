<?php

namespace App\Api\Controllers;

use App\Controller;
use Domain\Stations\Actions\ShowStations;
use Domain\Stations\Models\Station;
use Domain\Stations\Resources\StationIndexResource;
use Domain\Stations\Resources\StationResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\select;

class StationController extends Controller
{
    public function index(Request $request)
    {

        $stations = Station::query()
            ->select('*')
            ->paginate(30);

        return StationIndexResource::collection($stations);
    }

    public function show(Request $request, Station $station)
    {

//        $district = DB::table('districts')->where('id', $station->district_id)->first();
//        $address = DB::table('addresses')->where('id', $station->address_id)->first();
//        $stationType = DB::table('station_types')->where('id', $station->station_type_id)->first();
//        $controlCenter = DB::table('control_centers')->where('id', $station->control_center_id)->first();
//
//        $station->setRelation('district', $district);
//        $station->setRelation('address', $address);
//        $station->setRelation('stationType', $stationType);
//        $station->setRelation('controlCenter', $controlCenter);
//
////        dd($station);
//
//        dd($district, $station->toArray());

        $station->load('district', 'address', 'stationType', 'controlCenter');
        return StationResource::make($station);
    }
}
