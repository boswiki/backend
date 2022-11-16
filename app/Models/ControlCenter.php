<?php

namespace App\Models;

use App\Concerns\HasAddresses;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ControlCenter extends Model
{
    use HasFactory, HasAddresses;

    public function stations(): HasMany
    {
        return $this->hasMany(Station::class);
    }
}
