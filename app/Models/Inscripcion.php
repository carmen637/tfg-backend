<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $table = 'inscripciones';

    protected $fillable = [
        'usuario_id',
        'partido_id',
        'estado',
        'fecha_cancelacion',
        'nota',
    ];

    protected $casts = [
        'fecha_cancelacion' => 'datetime',
    ];

    // Relaciones
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function partido()
    {
        return $this->belongsTo(Partido::class, 'partido_id');
    }
}
