<?php

namespace App\Domain\Vehicles\Models;

use App\Domain\Common\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class VehicleType extends Model
{
    use HasFactory;

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function parent(): HasOne
    {
        return $this->hasOne(self::class, 'parent_id');
    }
}
