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
            'id' => $this->uuid,
            'name' => $this->name,
            'website' => $this->website,
            'address' => AddressResource::make($this->address),
            'stationType' => StationTypeResource::make($this->stationType),
//            FIXME: throws some utf8 error
//            'district' => $this->district,
            'createdAt' => $this->created_at->diffForHumans()
        ];
    }
}
