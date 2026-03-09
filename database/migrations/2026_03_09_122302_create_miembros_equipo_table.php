
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
        Schema::create('miembros_equipo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipo_id')->constrained('equipos_permanentes')->onDelete('cascade');
            $table->foreignId('jugador_id')->constrained('usuarios')->onDelete('cascade');
            $table->integer('dorsal')->nullable();
            $table->enum('rol', ['capitan', 'jugador', 'suplente'])->default('jugador');
            $table->string('posicion', 50)->nullable();
            $table->enum('estado', ['activo', 'inactivo', 'suspendido', 'expulsado'])->default('activo');
            $table->date('fecha_alta')->useCurrent();
            $table->date('fecha_baja')->nullable();
            $table->timestamps();
            
            $table->unique(['equipo_id', 'jugador_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('miembros_equipo');
    }
};