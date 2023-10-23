<?php

namespace Domain\Vehicles\Resources;

use Domain\Common\Resources\AddressResource;
use Domain\Stations\Resources\StationTypeResource;
use Domain\Users\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'constructionYear' => $this->construction_year,
            'crewCount' => $this->crew_count
        ];
    }
}
