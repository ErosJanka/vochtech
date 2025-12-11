<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // Se estiver usando Sanctum
// use Laravel\Passport\HasApiTokens; // Se estiver usando Passport

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    // use HasApiTokens; // Se estiver usando API

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
        'password' => 'hashed',
    ];

    /**
     * Get all audits performed by the user.
     */
    public function audits()
    {
        return $this->hasMany(Audit::class);
    }

    /**
     * Get the last activity of the user.
     */
    public function getLastActivityAttribute()
    {
        return $this->audits()->latest()->first();
    }
}