<?php

namespace Domain\Stations\Resources;

use Domain\Common\Resources\AddressResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StationIndexResource extends JsonResource
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
            'status' => $this->status,
            'address' => AddressResource::make($this->address),
            'createdAt' => $this->created_at?->diffForHumans(),
        ];
    }
}
