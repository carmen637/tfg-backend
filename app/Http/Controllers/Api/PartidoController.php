<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Partido;
use Illuminate\Http\Request;

class PartidoController extends Controller
{
    //Listar todos los partidos

    public function index(Request $request){
        $query = Partido::query();

        if($request->has('tipo_partido')){
            $query->where('tipo_partido', $request->tipo_partido);
        }
        if($request->has('fecha')){
            $query->whereDate('fecha', $request->fecha);
        }
        if($request->has('estado')){
            $query->where('estado', $request->estado);
        }
        if($request->has('localidad')){
            $query->whereHas('pista', function($q) use ($request){
                $q->where('localidad', 'LIKE', '%' . $request->localidad . '%');
            });
        }

        $partidos = $query->with(['pista', 'creador'])->get();

        return response()->json([
            'partidos' => $partidos,
            'total' => $partidos->count(),
        ], 200);
    }

    //Mostrar un solo partido
    public function show($id){
        $partido = Partido::with(['pista', 'creador', 'inscripciones'])->find($id);

        if(!$partido){
            return response()->json([
                'message' => 'Partido no encontrado',
            ], 404);
        }

        return response()->json([
            'partido' => $partido,
        ], 200);

    }

    //Crear un nuevo partido
    public function store(Request $request){

    $request->validate([
        'tipo_partido' => 'required|in:casual,liga',
        'fecha' => 'required|date|after_or_equal:today',
        'hora' => 'required|date_format:H:i',
        'duracion' => 'nullable|integer|min:30',
        'pista_id' => 'required|exists:pistas,id',
        'jugadores_requeridos' => 'nullable|integer|min:2',
        'precio_total' => 'nullable|numeric|min:0',
        'descripcion' => 'nullable|string|max:255',
    ]);

        $partido = Partido::create([
            'tipo_partido' => $request->tipo_partido,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'duracion' => $request->duracion ?? 90,
            'pista_id' => $request->pista_id,
            'creador_id' => $request->user()->id,
            'liga_id' => $request->liga_id,
            'jugadores_requeridos' => $request->jugadores_requeridos,
            'precio_total' => $request->precio_total,
            'estado' => 'abierto',
            'descripcion' => $request->descripcion,
        ]);


        return response()->json([
            'message' => 'Partido creado exitosamente',
            'partido' => $partido,
        ], 201);

    }

    //Actualizar un partido existente
    public function update(Request $request, $id){
        $partido = Partido::find($id);

        if (!$partido) {
            return response()->json([
                'message' => 'Partido no encontrada',
            ], 404);
        }

        $request->validate([
            'tipo_partido' => 'sometimes|in:casual,liga',
            'fecha' => 'sometimes|date|after_or_equal:today',
            'hora' => 'sometimes|date_format:H:i',
            'duracion' => 'sometimes|integer|min:30',
            'pista_id' => 'sometimes|exists:pistas,id',
            'jugadores_requeridos' => 'nullable|integer|min:2',
            'precio_total' => 'nullable|numeric|min:0',
            'estado' => 'sometimes|in:abierto,completo,en_curso,finalizado,cancelado',
            'descripcion' => 'nullable|string|max:255',
        ]);

        $partido->update($request->all());

        return response()->json([
            'message' => 'Partido actualizado correctamente',
            'partido' => $partido->fresh(),
        ], 200);

    }

    //Eliminar un partido
    public function destroy($id){
        $partido = Partido::find($id);

        if(!$partido){
            return response()->json([
                'message' => 'Partido no encontrado',
            ], 404);
        }

        $partido->delete();

        return response()->json([
            'message' => 'Partido eliminado correctamente',
        ], 200);
    }
}
