<?php

namespace Domain\Users\Models;

use Database\Factories\PunishmentFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Punishment extends Model
{
    use HasFactory, HasUuids;

    protected static function newFactory()
    {
        return PunishmentFactory::new();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
