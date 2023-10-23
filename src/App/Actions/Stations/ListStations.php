<?php

namespace App\Actions\Stations;

use Domain\Stations\Models\Station;
use Domain\Stations\Resources\StationIndexResource;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Pipeline;
use MatanYadaev\EloquentSpatial\SpatialBuilder;

class ListStations
{
    public function execute(Request $request)
    {
        return StationIndexResource::collection(
            Pipeline::send(
                Station::query()
                    ->select('id', 'name', 'created_at', 'status')
                    ->with('address')
            )
                ->through([
                    \App\Filters\ByName::class
                ])
                ->thenReturn()
                ->paginate(30)
        );
    }
}
