<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('audits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('set null');
            $table->string('auditable_type'); // Ex: App\Models\Group
            $table->unsignedBigInteger('auditable_id'); // ID da entidade
            $table->string('action'); // created, updated, deleted
            $table->json('old')->nullable(); // Dados antigos
            $table->json('new')->nullable(); // Dados novos
            $table->timestamps();
            
            // Índices para melhor performance
            $table->index(['auditable_type', 'auditable_id']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audits');
    }
};