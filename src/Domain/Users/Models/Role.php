<?php

namespace Domain\Users\Models;

use Database\Factories\RoleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return RoleFactory::new();
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
