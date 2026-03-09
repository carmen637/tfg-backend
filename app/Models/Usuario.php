<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'apellidos',
        'dni',
        'email',
        'password',
        'telefono',
        'foto_perfil',
        'localidad',
        'nivel',
        'posicion',
        'fecha_nacimiento',
        'biografia',
        'pie_golpeo',
        'tipo_partido_preferido',
        'horario_preferente',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'password' => 'hashed',
    ];

    // Relaciones
    public function partidosCreados()
    {
        return $this->hasMany(Partido::class, 'creador_id');
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class, 'usuario_id');
    }

    public function equiposPermanentes()
    {
        return $this->belongsToMany(EquipoPermanente::class, 'miembros_equipo', 'jugador_id', 'equipo_id');
    }

    public function ligasOrganizadas()
    {
        return $this->hasMany(Liga::class, 'organizador_id');
    }
}