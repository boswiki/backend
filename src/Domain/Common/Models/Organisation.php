<?php

namespace Domain\Common\Models;

use Database\Factories\OrganisationFactory;
use Domain\Common\Concerns\HasAddresses;
use Domain\Stations\Models\Station;
use Domain\Users\Models\User;
use Domain\Vehicles\Models\Vehicle;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organisation extends Model
{
    use HasFactory, HasAddresses, HasUuids;

    protected static function newFactory()
    {
        return OrganisationFactory::new();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function stations(): HasMany
    {
        return $this->hasMany(Station::class);
    }
}
