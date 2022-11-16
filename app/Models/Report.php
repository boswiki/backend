<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Report extends Model
{
    use HasFactory;

    public function reportable(): MorphTo
    {
        return $this->morphTo();
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
