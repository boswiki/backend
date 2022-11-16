<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

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
