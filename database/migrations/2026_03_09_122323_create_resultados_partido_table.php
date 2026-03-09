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
        Schema::create('resultados_partido', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partido_id')->constrained('partidos')->onDelete('cascade');
            $table->foreignId('equipo_1_id')->constrained('equipos_permanentes');
            $table->foreignId('equipo_2_id')->constrained('equipos_permanentes');
            $table->integer('goles_equipo_1')->nullable();
            $table->integer('goles_equipo_2')->nullable();
            $table->timestamps();
            
            $table->unique('partido_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resultados_partido');
    }
};
