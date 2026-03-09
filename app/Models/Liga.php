<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Liga extends Model
{
    protected $table = 'ligas';

    protected $fillable = [
        'nombre',
        'organizador_id',
        'fecha_inicio',
        'fecha_fin',
        'max_equipos',
        'localidad',
        'tipo_liga',
        'estado',
        'precio_inscripcion',
        'premio',
        'imagen',
        'descripcion',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'precio_inscripcion' => 'decimal:2',
    ];

    // Relaciones
    public function organizador()
    {
        return $this->belongsTo(Usuario::class, 'organizador_id');
    }

    public function partidos()
    {
        return $this->hasMany(Partido::class, 'liga_id');
    }

    public function clasificaciones()
    {
        return $this->hasMany(ClasificacionLiga::class, 'liga_id');
    }
}
