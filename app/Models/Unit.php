<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unit extends Model
{
    use HasFactory;

    // Campos que podem ser preenchidos via mass assignment
    protected $fillable = [
        'nome_fantasia',
        'razao_social',
        'cnpj',
        'brand_id'
    ];

    // Uma unidade pertence a uma bandeira
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    // Uma unidade possui muitos colaboradores
    public function collaborators(): HasMany
    {
        return $this->hasMany(Collaborator::class);
    }

    // Formata CNPJ para exibição (XX.XXX.XXX/XXXX-XX)
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

    // Obtém o grupo através da bandeira
    public function group()
    {
        return $this->brand->group ?? null;
    }

    // Conta quantos colaboradores tem nesta unidade
    public function getCollaboratorsCountAttribute(): int
    {
        return $this->collaborators()->count();
    }
}