<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    protected $table = 'partidos';

    protected $fillable = [
        'tipo_partido',
        'fecha',
        'hora',
        'duracion',
        'pista_id',
        'creador_id',
        'liga_id',
        'jugadores_requeridos',
        'precio_total',
        'goles_equipo_a',
        'goles_equipo_b',
        'estado',
        'descripcion',
    ];

    protected $casts = [
        'fecha' => 'date',
        'hora' => 'datetime:H:i',
        'precio_total' => 'decimal:2',
    ];

    // Relaciones
    public function pista()
    {
        return $this->belongsTo(Pista::class, 'pista_id');
    }

    public function creador()
    {
        return $this->belongsTo(Usuario::class, 'creador_id');
    }

    public function liga()
    {
        return $this->belongsTo(Liga::class, 'liga_id');
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class, 'partido_id');
    }

    public function equiposCasual()
    {
        return $this->hasMany(EquipoCasual::class, 'partido_id');
    }

    public function resultado()
    {
        return $this->hasOne(ResultadoPartido::class, 'partido_id');
    }
}
