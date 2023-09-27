<?php

namespace Domain\Stations\Models;

use Database\Factories\ControlCenterFactory;
use Domain\Common\Concerns\HasAddresses;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;

class ControlCenter extends Model
{
    use HasAddresses, HasFactory, HasSpatial, HasUuids;

    protected $guarded = [];

    protected $casts = [
        'location' => Point::class,
    ];

    protected static function newFactory()
    {
        return ControlCenterFactory::new();
    }

    public function stations(): HasMany
    {
        return $this->hasMany(Station::class);
    }
}
