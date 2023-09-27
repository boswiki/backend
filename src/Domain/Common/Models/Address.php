<?php

namespace Domain\Common\Models;

use Database\Factories\AddressFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Address extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [];

    protected static function newFactory()
    {
        return AddressFactory::new();
    }

    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }
}
