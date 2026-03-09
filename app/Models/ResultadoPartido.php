<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultadoPartido extends Model
{
    protected $table = 'resultados_partido';

    protected $fillable = [
        'partido_id',
        'equipo_1_id',
        'equipo_2_id',
        'goles_equipo_1',
        'goles_equipo_2',
    ];

    // Relaciones
    public function partido()
    {
        return $this->belongsTo(Partido::class, 'partido_id');
    }

    public function equipo1()
    {
        return $this->belongsTo(EquipoPermanente::class, 'equipo_1_id');
    }

    public function equipo2()
    {
        return $this->belongsTo(EquipoPermanente::class, 'equipo_2_id');
    }
}
