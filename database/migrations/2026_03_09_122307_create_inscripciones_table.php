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
        Schema::create('inscripciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
            $table->foreignId('partido_id')->constrained('partidos')->onDelete('cascade');
            $table->enum('estado', ['activa', 'cancelada'])->default('activa');
            $table->timestamp('fecha_cancelacion')->nullable();
            $table->text('nota')->nullable();
            $table->timestamps();
            
            $table->unique(['usuario_id', 'partido_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscripciones');
    }
};