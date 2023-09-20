<?php

namespace Domain\Stations\Models;

use Database\Factories\ControlCenterFactory;
use Domain\Common\Concerns\HasAddresses;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ControlCenter extends Model
{
    use HasFactory, HasAddresses;

    protected static function newFactory()
    {
        return ControlCenterFactory::new();
    }

    public function stations(): HasMany
    {
        return $this->hasMany(Station::class);
    }
}
