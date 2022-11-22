<?php

namespace App\Domain\Vehicles\Models;

use App\Domain\Common\Models\Category;
use App\Domain\Common\Models\Favorite;
use App\Domain\Common\Models\Organisation;
use App\Domain\Common\Models\Report;
use App\Domain\Stations\Models\Station;
use App\Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Vehicle extends Model
{
    use HasFactory;

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
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

    public function station(): BelongsTo
    {
        return $this->belongsTo(Station::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function vehicleFitter(): BelongsTo
    {
        return $this->belongsTo(VehicleFitter::class);
    }

    public function vehicleManufacturer(): BelongsTo
    {
        return $this->belongsTo(VehicleManufacturer::class);
    }

    public function vehicleType(): HasOne
    {
        return $this->hasOne(VehicleType::class);
    }
}
