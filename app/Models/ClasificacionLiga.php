<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClasificacionLiga extends Model
{
    protected $table = 'clasificaciones_liga';

    protected $fillable = [
        'liga_id',
        'equipo_id',
        'puntos',
        'partidos_jugados',
        'victorias',
        'empates',
        'derrotas',
        'goles_favor',
        'goles_contra',
        'diferencia_goles',
    ];

    // Relaciones
    public function liga()
    {
        return $this->belongsTo(Liga::class, 'liga_id');
    }

    public function equipo()
    {
        return $this->belongsTo(EquipoPermanente::class, 'equipo_id');
    }
}
