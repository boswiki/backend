<?php

namespace Domain\Vehicles\Models;

use Database\Factories\VehicleFitterFactory;
use Domain\Common\Concerns\HasAddresses;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VehicleFitter extends Model
{
    use HasAddresses, HasFactory, HasUuids;

    protected static function newFactory()
    {
        return VehicleFitterFactory::new();
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
