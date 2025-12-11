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

    // Obtém todos os registros de auditoria criados por este usuário
    public function audits()
    {
        return $this->hasMany(Audit::class);
    }

    // Retorna o último registro de auditoria do usuário
    public function getLastActivityAttribute()
    {
        return $this->audits()->latest()->first();
    }
}