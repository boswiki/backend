<?php

namespace App\Domain\Stations\Models;

use App\Domain\Common\Concerns\HasAddresses;
use App\Domain\Common\Models\Category;
use App\Domain\Common\Models\Favorite;
use App\Domain\Common\Models\Organisation;
use App\Domain\Common\Models\Report;
use App\Domain\Users\Models\User;
use App\Domain\Vehicles\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Station extends Model
{
    use HasFactory, HasAddresses;

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
        return $this->morphMany(Favorite::class, 'favoriteable');
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
