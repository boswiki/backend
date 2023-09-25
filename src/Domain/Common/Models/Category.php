<?php

namespace Domain\Common\Models;

use Database\Factories\CategoryFactory;
use Domain\Stations\Models\Station;
use Domain\Stations\Models\StationType;
use Domain\Vehicles\Models\Vehicle;
use Domain\Vehicles\Models\VehicleType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory, HasUuids;

    protected static function newFactory()
    {
        return CategoryFactory::new();
    }

    public function stations(): HasMany
    {
        return $this->hasMany(Station::class);
    }

    public function stationTypes(): HasMany
    {
        return $this->hasMany(StationType::class);
    }

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }

    public function vehicleTypes(): HasMany
    {
        return $this->hasMany(VehicleType::class);
    }

    public function organisations(): HasMany
    {
        return $this->hasMany(Organisation::class);
    }
}
