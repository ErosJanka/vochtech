<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audits', function (Blueprint $table) {
            $table->id();
            // Usuário que realizou a ação
            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('set null');
            // Tipo de modelo auditado (Ex: App\Models\Group)
            $table->string('auditable_type');
            // ID da entidade auditada
            $table->unsignedBigInteger('auditable_id');
            // Tipo de ação (created, updated, deleted)
            $table->string('action');
            // Dados anteriores em formato JSON
            $table->json('old')->nullable();
            // Dados novos em formato JSON
            $table->json('new')->nullable();
            $table->timestamps();
            
            // Índices para melhor performance nas buscas
            $table->index(['auditable_type', 'auditable_id']);
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audits');
    }
};