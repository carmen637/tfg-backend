<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquipoPermanente extends Model
{
    protected $table = 'equipos_permanentes';

    protected $fillable = [
        'nombre',
        'escudo',
        'capitan_id',
        'localidad',
        'descripcion',
    ];

    // Relaciones
    public function capitan()
    {
        return $this->belongsTo(Usuario::class, 'capitan_id');
    }

    public function miembros()
    {
        return $this->hasMany(MiembroEquipo::class, 'equipo_id');
    }

    public function jugadores()
    {
        return $this->belongsToMany(Usuario::class, 'miembros_equipo', 'equipo_id', 'jugador_id');
    }

    public function clasificaciones()
    {
        return $this->hasMany(ClasificacionLiga::class, 'equipo_id');
    }

    public function resultadosComoEquipo1()
    {
        return $this->hasMany(ResultadoPartido::class, 'equipo_1_id');
    }

    public function resultadosComoEquipo2()
    {
        return $this->hasMany(ResultadoPartido::class, 'equipo_2_id');
    }
}
