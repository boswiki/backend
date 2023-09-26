<?php

namespace Domain\Stations\Models;

use Database\Factories\DistrictFactory;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Support\Traits\HasLocation;

class District extends Model
{
    use HasFactory, HasUuids, HasLocation;

    protected $hidden = [
      'location', 'border', 'bounding_box'
    ];

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'date',
        'description' => 'array'
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
}
