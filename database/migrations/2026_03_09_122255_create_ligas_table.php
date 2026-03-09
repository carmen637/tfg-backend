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
        Schema::create('ligas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 255);
            $table->foreignId('organizador_id')->constrained('usuarios');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->integer('max_equipos');
            $table->string('localidad', 100)->nullable();
            $table->enum('tipo_liga', ['eliminatoria', 'todos_contra_todos', 'mixta'])->default('todos_contra_todos');
            $table->enum('estado', ['inscripciones_abiertas', 'en_curso', 'finalizada', 'cancelada'])->default('inscripciones_abiertas');
            $table->decimal('precio_inscripcion', 6, 2)->nullable();
            $table->string('premio', 255)->nullable();
            $table->text('imagen')->nullable();
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ligas');
    }
};