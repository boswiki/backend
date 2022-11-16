<?php

namespace App\Models;

use App\Concerns\HasAddresses;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organisation extends Model
{
    use HasFactory, HasAddresses;

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
