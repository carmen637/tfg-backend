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
        Schema::create('pistas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 255);
            $table->text('direccion');
            $table->decimal('latitud', 10, 8);
            $table->decimal('longitud', 11, 8);
            $table->string('localidad', 100);
            $table->string('telefono', 20)->nullable();
            $table->decimal('precio_por_hora', 6, 2);
            $table->enum('tipo_superficie', ['cesped_natural', 'cesped_artificial', 'tierra', 'cemento'])->nullable();
            $table->integer('capacidad')->nullable();
            $table->boolean('vestuario')->default(false);
            $table->boolean('parking')->default(false);
            $table->boolean('iluminacion')->default(false);
            $table->boolean('techada')->default(false);
            $table->time('horario_apertura')->nullable();
            $table->time('horario_cierre')->nullable();
            $table->text('descripcion')->nullable();
            $table->text('imagen')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pistas');
    }
};
