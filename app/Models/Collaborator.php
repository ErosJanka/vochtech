<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Collaborator extends Model
{
    use HasFactory;

    // Campos que podem ser preenchidos via mass assignment
    protected $fillable = [
        'name',
        'email',
        'cpf',
        'unit_id'
    ];

    // Um colaborador pertence a uma unidade
    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    // Formata CPF para exibição (XXX.XXX.XXX-XX)
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

    // Obtém a bandeira através da unidade
    public function brand()
    {
        return $this->unit->brand ?? null;
    }

    // Obtém o grupo através da unidade e bandeira
    public function group()
    {
        if ($this->unit && $this->unit->brand) {
            return $this->unit->brand->group;
        }
        
        return null;
    }

    // Filtra colaboradores por nome ou email (busca genérica)
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
        }
        
        return $query;
    }

    // Filtra colaboradores por unidade
    public function scopeByUnit($query, $unitId)
    {
        if ($unitId) {
            return $query->where('unit_id', $unitId);
        }
        
        return $query;
    }
}