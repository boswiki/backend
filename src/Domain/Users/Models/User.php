<?php

namespace Domain\Users\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\Factory;
use Database\Factories\UserFactory;
use Domain\Common\Models\Favorite;
use Domain\Feedback\Models\Feedback;
use Domain\Points\Models\Point;
use Domain\Stations\Models\District;
use Domain\Stations\Models\DistrictUser;
use Domain\Stations\Models\Station;
use Domain\Stations\Models\StationUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function newFactory(): Factory
    {
        return UserFactory::new();
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    public function districts(): BelongsToMany
    {
        return $this
            ->belongsToMany(District::class)
            ->as('districts')
            ->using(DistrictUser::class);
    }

    public function stations(): BelongsToMany
    {
        return $this
            ->belongsToMany(Station::class)
            ->as('stations')
            ->using(StationUser::class);
    }

    public function roles(): HasOne
    {
        return $this->hasOne(Role::class);
    }

    public function points(): HasMany
    {
        return $this->hasMany(Point::class);
    }

    public function feedback(): HasMany
    {
        return $this->hasMany(Feedback::class);
    }

    public function punishments(): HasMany
    {
        return $this->hasMany(Punishment::class);
    }
}
