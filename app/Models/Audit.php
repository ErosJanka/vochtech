<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Audit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'auditable_type',
        'auditable_id',
        'action',
        'old',
        'new',
    ];

    protected $casts = [
        'old' => 'array',
        'new' => 'array',  // JSON é automaticamente convertido para array
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the auditable model (Group, Brand, Unit, or Collaborator).
     */
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

    /**
     * Get readable action name.
     */
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

    /**
     * Get the auditable model name without namespace.
     */
    public function getModelNameAttribute(): string
    {
        return class_basename($this->auditable_type);
    }
}