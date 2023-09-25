<?php

namespace Domain\Stations\Models;

use Database\Factories\ControlCenterFactory;
use Domain\Common\Concerns\HasAddresses;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Support\Traits\HasLocation;

class ControlCenter extends Model
{
    use HasFactory, HasAddresses, HasUuids, HasLocation;

    protected $hidden = ['location'];

    protected static function newFactory()
    {
        return ControlCenterFactory::new();
    }

    public function stations(): HasMany
    {
        return $this->hasMany(Station::class);
    }
}
