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
        Schema::create('equipos_permanentes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100)->unique();
            $table->text('escudo')->nullable();
            $table->foreignId('capitan_id')->constrained('usuarios');
            $table->string('localidad', 100);
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos_permanentes');
    }
};