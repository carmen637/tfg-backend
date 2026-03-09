<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquipoCasual extends Model
{
    protected $table = 'equipos_casual';

    protected $fillable = [
        'usuario_id',
        'partido_id',
        'equipo',
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
