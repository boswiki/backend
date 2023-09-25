<?php

namespace Support\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

trait HasLocation
{

    protected static function bootHasLocation()
    {
        static::addGlobalScope('longitudeAndLatitude', function (Builder $builder) {
            $builder->select()->addSelect([
                DB::raw('ST_X(location) as latitude'),
                DB::raw('ST_Y(location) as longitude')
            ]);
        });
    }

    public function getLatitudeAttribute($value)
    {
        return $this->attributes['latitude'] ?? null;
    }

    public function getLongitudeAttribute($value)
    {
        return $this->attributes['longitude'] ?? null;
    }
}
