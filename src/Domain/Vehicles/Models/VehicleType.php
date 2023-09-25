<?php

namespace Domain\Vehicles\Models;

use Database\Factories\VehicleTypeFactory;
use Domain\Common\Models\Category;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class VehicleType extends Model
{
    use HasFactory, HasUuids;

    protected static function newFactory()
    {
        return VehicleTypeFactory::new();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function parent(): HasOne
    {
        return $this->hasOne(self::class, 'parent_id');
    }
}
