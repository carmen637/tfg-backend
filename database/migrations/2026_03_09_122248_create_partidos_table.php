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
        Schema::create('partidos', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo_partido', ['casual', 'liga']);
            $table->date('fecha');
            $table->time('hora');
            $table->integer('duracion')->default(90);
            $table->foreignId('pista_id')->constrained('pistas');
            $table->foreignId('creador_id')->constrained('usuarios');
            $table->foreignId('liga_id')->nullable()->constrained('ligas');
            $table->integer('jugadores_requeridos')->nullable();
            $table->decimal('precio_total', 6, 2)->nullable();
            $table->integer('goles_equipo_a')->nullable();
            $table->integer('goles_equipo_b')->nullable();
            $table->enum('estado', ['abierto', 'completo', 'en_curso', 'finalizado', 'cancelado'])->default('abierto');
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partidos');
    }
};
