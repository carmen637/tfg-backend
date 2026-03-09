<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pista extends Model
{
    protected $table = 'pistas';

    protected $fillable = [
        'nombre',
        'direccion',
        'latitud',
        'longitud',
        'localidad',
        'telefono',
        'precio_por_hora',
        'tipo_superficie',
        'capacidad',
        'vestuario',
        'parking',
        'iluminacion',
        'techada',
        'horario_apertura',
        'horario_cierre',
        'descripcion',
        'imagen',
    ];

    protected $casts = [
        'latitud' => 'decimal:8',
        'longitud' => 'decimal:8',
        'precio_por_hora' => 'decimal:2',
        'vestuario' => 'boolean',
        'parking' => 'boolean',
        'iluminacion' => 'boolean',
        'techada' => 'boolean',
        'horario_apertura' => 'datetime:H:i',
        'horario_cierre' => 'datetime:H:i',
    ];

    // Relaciones
    public function partidos()
    {
        return $this->hasMany(Partido::class, 'pista_id');
    }
}
