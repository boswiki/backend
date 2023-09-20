<?php

namespace Domain\Stations\Resources;

use Domain\Common\Resources\AddressResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StationTypeResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
