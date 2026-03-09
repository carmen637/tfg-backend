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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('apellidos', 100);
            $table->string('dni', 20)->nullable()->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('telefono', 20)->nullable();
            $table->text('foto_perfil')->nullable();
            $table->string('localidad', 100);
            $table->enum('nivel', ['principiante', 'intermedio', 'avanzado'])->default('principiante');
            $table->string('posicion', 50)->nullable();
            $table->date('fecha_nacimiento');
            $table->text('biografia')->nullable();
            $table->enum('pie_golpeo', ['derecho', 'izquierdo', 'ambos'])->nullable();
            $table->enum('tipo_partido_preferido', ['casual', 'liga', 'ambos'])->default('ambos');
            $table->set('horario_preferente', ['mañana', 'tarde', 'noche', 'fin_semana'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
