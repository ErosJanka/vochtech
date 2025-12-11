<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // ADICIONAR
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    use HasFactory; // ADICIONAR
    
    protected $fillable = ['name'];

    public function brands(): HasMany
    {
        return $this->hasMany(Brand::class);
    }
}