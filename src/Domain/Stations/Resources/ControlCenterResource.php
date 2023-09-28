<?php

namespace Domain\Stations\Resources;

use Domain\Common\Resources\AddressResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ControlCenterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'latitude' => $this->location->latitude,
            'longitude' => $this->location->longitude,
            'address' => AddressResource::make($this->address),
            'district' => [
                'name' => $this->district->name
            ]
        ];
    }
}
