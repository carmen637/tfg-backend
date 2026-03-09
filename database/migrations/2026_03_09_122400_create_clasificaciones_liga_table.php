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
        Schema::create('clasificaciones_liga', function (Blueprint $table) {
            $table->id();
            $table->foreignId('liga_id')->constrained('ligas')->onDelete('cascade');
            $table->foreignId('equipo_id')->constrained('equipos_permanentes')->onDelete('cascade');
            $table->integer('puntos')->default(0);
            $table->integer('partidos_jugados')->default(0);
            $table->integer('victorias')->default(0);
            $table->integer('empates')->default(0);
            $table->integer('derrotas')->default(0);
            $table->integer('goles_favor')->default(0);
            $table->integer('goles_contra')->default(0);
            $table->integer('diferencia_goles')->default(0);
            $table->timestamps();
            
            $table->unique(['liga_id', 'equipo_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clasificaciones_liga');
    }
};
