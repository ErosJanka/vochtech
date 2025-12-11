<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Collaborator extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'cpf',
        'unit_id'
    ];

    /**
     * Get the unit that owns the collaborator.
     */
    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    /**
     * Format CPF for display.
     *
     * @return string
     */
    public function getCpfFormattedAttribute(): string
    {
        if (!$this->cpf) {
            return '';
        }

        $cpf = preg_replace('/[^0-9]/', '', $this->cpf);
        
        if (strlen($cpf) === 11) {
            return substr($cpf, 0, 3) . '.' .
                   substr($cpf, 3, 3) . '.' .
                   substr($cpf, 6, 3) . '-' .
                   substr($cpf, 9, 2);
        }

        return $this->cpf;
    }

    /**
     * Get the brand through unit.
     *
     * @return mixed
     */
    public function brand()
    {
        return $this->unit->brand ?? null;
    }

    /**
     * Get the group through unit and brand.
     *
     * @return mixed
     */
    public function group()
    {
        if ($this->unit && $this->unit->brand) {
            return $this->unit->brand->group;
        }
        
        return null;
    }

    public function scopeSearch($query, $search)
    {
        // Permite buscar por nome ou email
        if ($search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
        }
        
        return $query;
    }

    /**
     * Scope a query to filter by unit.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $unitId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByUnit($query, $unitId)
    {
        if ($unitId) {
            return $query->where('unit_id', $unitId);
        }
        
        return $query;
    }
}