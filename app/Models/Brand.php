<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'group_id'];

    // Bandeira pertence a um grupo econômico
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    // Uma bandeira possui muitas unidades
    public function units(): HasMany
    {
        return $this->hasMany(Unit::class);
    }

    // Obtém colaboradores através das unidades
    public function collaborators()
    {
        return $this->hasManyThrough(
            Collaborator::class,
            Unit::class,
            'brand_id',
            'unit_id',
            'id',
            'id'
        );
    }
}