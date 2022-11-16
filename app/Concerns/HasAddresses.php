<?php

namespace App\Concerns;

use App\Models\Address;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasAddresses
{
    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }
}
