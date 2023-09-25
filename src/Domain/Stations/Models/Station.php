<?php

namespace Domain\Stations\Models;

use Database\Factories\StationFactory;
use Domain\Common\Concerns\HasAddresses;
use Domain\Common\Models\Category;
use Domain\Common\Models\Favorite;
use Domain\Common\Models\Organisation;
use Domain\Common\Models\Report;
use Domain\Users\Models\User;
use Domain\Vehicles\Models\Vehicle;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;
use Support\Traits\HasLocation;

class Station extends Model
{
    use HasFactory, HasAddresses, HasUuids, HasLocation;

    protected $hidden = ['location'];

    protected $casts = [
        'created_at' => 'date',
        'description' => 'array'
    ];

    protected static function newFactory()
    {
        return StationFactory::new();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function controlCenter(): BelongsTo
    {
        return $this->belongsTo(ControlCenter::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function favorites(): MorphMany
    {
        return $this->morphMany(Favorite::class, 'favorable');
    }

    public function organisation(): BelongsTo
    {
        return $this->belongsTo(Organisation::class);
    }

    public function report(): MorphMany
    {
        return $this->morphMany(Report::class, 'reportable');
    }

    public function stationType(): BelongsTo
    {
        return $this->belongsTo(StationType::class);
    }

    public function users(): BelongsToMany
    {
        return $this
            ->belongsToMany(User::class)
            ->as('users')
            ->using(StationUser::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }
}
