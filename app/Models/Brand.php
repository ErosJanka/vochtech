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

    /**
     * Get the group that owns the brand.
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * Get all units for the brand.
     */
    public function units(): HasMany
    {
        return $this->hasMany(Unit::class);
    }

    /**
     * Get the collaborators through units.
     */
    public function collaborators()
    {
        return $this->hasManyThrough(
            Collaborator::class,
            Unit::class,
            'brand_id', // Foreign key on units table
            'unit_id',  // Foreign key on collaborators table
            'id',       // Local key on brands table
            'id'        // Local key on units table
        );
    }
}