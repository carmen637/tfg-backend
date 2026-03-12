<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Partido;
use App\Models\Inscripcion;
use Illuminate\Http\Request;


class InscripcionController extends Controller
{
    //Inscribirse a un partido

    public function inscribirse(Request $request, $partidoId){
        $usuario = $request->user();
        $partido = Partido::find($partidoId);

        if(!$partido){
            return response()->json([
                'message' => 'Partido no encontrado',
            ], 404);
        }

        if($partido->estado !== 'abierto'){
            return response()->json([
                'message' => 'Este partido ya no esta abierto para inscribirse'
            ], 400);
        }

        if($partido->creador_id === $usuario->id){
            return response()->json([
                'message' => 'Tu has creado este partido, no puedes inscribirte a tu propio partido'
            ], 400);
        }

        $yaInscrito = Inscripcion::where('partido_id', $partidoId)->where('usuario_id', $usuario->id)->exists();
        if($yaInscrito){
            return response()->json([
                'message' => 'Ya estas aputado'
            ], 400);
        }
        if($partido->jugadores_requeridos){
            $inscritos = Inscripcion::where('partido_id', $partidoId)->count();

            if($inscritos >= ($partido->jugadores_requeridos - 1)){
                return response()->json([
                    'message' => 'Este partido ya esta completo'
                ], 400);
            }
        }

        $inscripcion = Inscripcion::create([
            'partido_id' => $partidoId,
            'usuario_id' => $usuario->id,
        ]);

        if($partido->jugadores_requeridos){
            $totalInscritos = Inscripcion::where('partido_id', $partidoId)->count();

            if($totalInscritos >= ($partido->jugadores_requeridos)){
                $partido->update(['estado' => 'completo']);
            }
        }
        return response()->json([
            'message' => "Te has inscrito al partido",
            'inscripcion' => $inscripcion,
        ], 201);
    }

    public function cancelarInscripcion(Request $request, $partidoId){
        $usuario = $request->user();

        $inscripcion = Inscripcion::where('partido_id', $partidoId)->where('usuario_id', $usuario->id)->first();

        if(!$inscripcion){
            return response()->json([
                'message' => "No estas inscrito en este partido"
            ], 404);
        }

        $partido = Partido::find($partidoId);

        if($partido && in_array($partido->estado, ['en_curso', 'finalizado'])){
            return response()->json([
                'message' => 'No puedes cancelar este partido'
            ], 400);
        }

        $inscripcion->delete();

        if($partido && $partido->estado === 'completo'){
            $partido->update(['estado' => 'abierto']);
        }
        return response()->json([
            'message' => 'Incripción cancelada correctamente'
        ], 200);
    }

    public function verInscritos($partidoId){
        $partido = Partido::find($partidoId);

        if(!$partido){
            return response()->json([
                'message' => 'Partido no encontrado'
            ], 404);
        }

        $inscripciones = Inscripcion::where('partido_id', $partidoId)->with('usuario:id,nombre,apellidos,email,nivel,posicion')->get();

        $creador = $partido->creador;

        return response()->json([
            'partido_id' => $partidoId,
            'creador' => [
                'id' => $creador->id,
                'nombre' => $creador->nombre,
                'apellidos' => $creador->apellidos,
                'email' => $creador->email,
                'nivel' => $creador->nivel,
                'posicion' => $creador->posicion
            ],
            'inscritos' => $inscripciones,
            'total_jugadores' => $inscripciones->count() + 1,
            'plazas_disponibles' => $partido->jugadores_requeridos ? ($partido->jugadores_requeridos - $inscripciones->count() - 1) : null,
        ], 200);
    }

}
