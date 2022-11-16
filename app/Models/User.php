<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    public function districts(): BelongsToMany
    {
        return $this
            ->belongsToMany(District::class)
            ->as('districts')
            ->using(StationUser::class);
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

    public function feedbacks(): HasMany
    {
        return $this->hasMany(Feedback::class);
    }

    public function punishments(): HasMany
    {
        return $this->hasMany(Punishment::class);
    }
}
