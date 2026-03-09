<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MiembroEquipo extends Model
{
    protected $table = 'miembros_equipo';

    protected $fillable = [
        'equipo_id',
        'jugador_id',
        'dorsal',
        'rol',
        'posicion',
        'estado',
        'fecha_alta',
        'fecha_baja',
    ];

    protected $casts = [
        'fecha_alta' => 'date',
        'fecha_baja' => 'date',
    ];

    // Relaciones
    public function equipo()
    {
        return $this->belongsTo(EquipoPermanente::class, 'equipo_id');
    }

    public function jugador()
    {
        return $this->belongsTo(Usuario::class, 'jugador_id');
    }
}