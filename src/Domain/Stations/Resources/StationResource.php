<?php

namespace Domain\Stations\Resources;

use Domain\Common\Resources\AddressResource;
use Domain\Users\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StationResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'name' => $this->name,
            'website' => $this->website,
            'latitude' => $this->location->latitude,
            'longitude' => $this->location->longitude,
            'createdAt' => $this->created_at?->diffForHumans(),
            'description' => $this->description,

            // RELATIONS
            'address' => AddressResource::make($this->address),
            'stationType' => StationTypeResource::make($this->stationType),
            'vehicles' => $this->vehicles,
            'controlCenter' => $this->controlCenter,
            'district' => $this->district,
            'author' => UserResource::make($this->author),
        ];
    }
}
