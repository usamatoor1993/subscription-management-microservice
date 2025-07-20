<?php

namespace App\Models;

use App\Enums\UserRoleEnum;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', 
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'role'              => UserRoleEnum::class, 
    ];

    
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

  
    public function isAdmin(): bool
    {
        return $this->role === UserRoleEnum::ADMIN;
    }
}
