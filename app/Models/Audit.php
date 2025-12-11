<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Audit extends Model
{
    use HasFactory;

    // Define quais campos podem ser preenchidos via mass assignment
    protected $fillable = [
        'user_id',
        'auditable_type',
        'auditable_id',
        'action',
        'old',
        'new',
    ];

    // Converte JSON para array automaticamente
    protected $casts = [
        'old' => 'array',
        'new' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function auditable(): MorphTo
    {
        return $this->morphTo();  // Funciona com qualquer modelo (Group, Brand, Unit, Collaborator)
    }

    public function scopeAction($query, $action)
    {
        return $query->where('action', $action);
    }

    /**
     * Scope a query to filter by auditable type.
     */
    public function scopeAuditableType($query, $type)
    {
        return $query->where('auditable_type', $type);
    }

    // Retorna nome da ação em português para exibição
    public function getActionNameAttribute(): string
    {
        // Retorna em português para exibição na UI
        return match($this->action) {
            'created' => 'Criado',
            'updated' => 'Atualizado',
            'deleted' => 'Excluído',
            default => ucfirst($this->action),
        };
    }

    // Retorna apenas o nome do modelo sem namespace (Ex: "Group" em vez de "App\Models\Group")
    public function getModelNameAttribute(): string
    {
        return class_basename($this->auditable_type);
    }
}