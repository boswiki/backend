<?php

namespace App\Actions\Stations;

use Domain\Stations\Models\Station;
use Domain\Stations\Resources\StationResource;
use MatanYadaev\EloquentSpatial\Objects\Point;

class ShowStation {
    public function execute(Station $station)
    {
        return StationResource::make(
            $station->load(
                'author:id,first_name,last_name,username',
                'district:id,name',
                'address',
                'stationType:id,name',
                'controlCenter:id,name'
            )
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
