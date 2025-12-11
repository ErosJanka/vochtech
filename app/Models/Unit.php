<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unit extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome_fantasia',
        'razao_social',
        'cnpj',
        'brand_id'
    ];

    /**
     * Get the brand that owns the unit.
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Get all collaborators for the unit.
     */
    public function collaborators(): HasMany
    {
        return $this->hasMany(Collaborator::class);
    }

    /**
     * Format CNPJ for display.
     *
     * @return string
     */
    public function getCnpjFormattedAttribute(): string
    {
        if (!$this->cnpj) {
            return '';
        }

        $cnpj = preg_replace('/[^0-9]/', '', $this->cnpj);
        
        if (strlen($cnpj) === 14) {
            return substr($cnpj, 0, 2) . '.' .
                   substr($cnpj, 2, 3) . '.' .
                   substr($cnpj, 5, 3) . '/' .
                   substr($cnpj, 8, 4) . '-' .
                   substr($cnpj, 12, 2);
        }

        return $this->cnpj;
    }

    /**
     * Get the group through brand.
     *
     * @return mixed
     */
    public function group()
    {
        return $this->brand->group ?? null;
    }

    /**
     * Get the count of collaborators.
     *
     * @return int
     */
    public function getCollaboratorsCountAttribute(): int
    {
        return $this->collaborators()->count();
    }
}