<?php

namespace Domain\Stations\Models;

use Database\Factories\DistrictFactory;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Objects\Polygon;

class District extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'date',
        'description' => 'array',
        'location' => Point::class,
        'border' => Polygon::class,
        'bounding_box' => Polygon::class,
    ];

    protected static function newFactory()
    {
        return DistrictFactory::new();
    }

    public function stations(): HasMany
    {
        return $this->hasMany(Station::class);
    }

    public function users(): BelongsToMany
    {
        return $this
            ->belongsToMany(User::class)
            ->as('users')
            ->using(StationUser::class);
    }

    public function controlCenters(): HasMany
    {
        return $this->hasMany(ControlCenter::class);
    }
}
