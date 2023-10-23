<?php

namespace Domain\Vehicles\Actions;

use Domain\Vehicles\Models\Vehicle;
use Domain\Vehicles\Resources\VehicleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ListVehicles
{
    public function execute(string $stationId): AnonymousResourceCollection
    {
        return VehicleResource::collection(
            Vehicle::query()
                ->select('id', 'name', 'construction_year', 'crew_count', 'station_id')
                ->where('station_id', $stationId)
                ->get()
        );
    }
}
