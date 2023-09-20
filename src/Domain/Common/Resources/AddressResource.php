<?php

namespace Domain\Common\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'street' => $this->street,
            'number' => $this->number,
            'city' => $this->city,
            'county' => $this->county,
            'country' => $this->country,
            'zip' => $this->zip,
        ];
    }
}
