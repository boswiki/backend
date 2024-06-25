<?php

namespace Domain\Stations\Actions;

use Domain\Stations\Models\Station;
use Domain\Stations\Resources\StationIndexResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Pipeline;

class ListStations
{
    public function execute(Request $request): AnonymousResourceCollection
    {
        return StationIndexResource::collection(
            Pipeline::send(
                Station::query()
                    ->select('id', 'name', 'created_at', 'status', 'location')
                    ->with('address')
            )
                ->through([
                    \App\Filters\ByName::class,
                ])
                ->thenReturn()
                ->paginate(30)
        );
    }
}
