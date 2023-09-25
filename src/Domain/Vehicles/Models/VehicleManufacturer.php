<?php

namespace Domain\Vehicles\Models;

use Database\Factories\VehicleManufacturerFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VehicleManufacturer extends Model
{
    use HasFactory, HasUuids;

    protected static function newFactory()
    {
        return VehicleManufacturerFactory::new();
    }

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }
}
