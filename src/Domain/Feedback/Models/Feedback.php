<?php

namespace Domain\Feedback\Models;

use Database\Factories\FeedbackFactory;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feedback extends Model
{
    use HasFactory, HasUuids;

    protected static function newFactory()
    {
        return FeedbackFactory::new();
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
