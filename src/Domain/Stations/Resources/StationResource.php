<?php

namespace Domain\Stations\Resources;

use Domain\Common\Resources\AddressResource;
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
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'address' => AddressResource::make($this->address),
            'stationType' => StationTypeResource::make($this->stationType),
            'vehicles' => $this->vehicles,
            'controlCenter' => $this->controlCenter,
            'district' => $this->district,
            'createdAt' => $this->created_at?->diffForHumans()
        ];
    }
}
