<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pista;
use Illuminate\Http\Request;

class PistaController extends Controller
{
    /**
     * Listar todas las pistas
     */
    public function index(Request $request)
    {
        $query = Pista::query();

        // Filtrar por localidad si se proporciona
        if ($request->has('localidad')) {
            $query->where('localidad', 'LIKE', '%' . $request->localidad . '%');
        }

        // Filtrar por tipo de superficie si se proporciona
        if ($request->has('tipo_superficie')) {
            $query->where('tipo_superficie', $request->tipo_superficie);
        }

        $pistas = $query->get();

        return response()->json([
            'pistas' => $pistas,
            'total' => $pistas->count(),
        ], 200);
    }

    /**
     * Mostrar una pista específica
     */
    public function show($id)
    {
        $pista = Pista::find($id);

        if (!$pista) {
            return response()->json([
                'message' => 'Pista no encontrada',
            ], 404);
        }

        return response()->json([
            'pista' => $pista,
        ], 200);
    }

    /**
     * Crear una nueva pista
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string',
            'latitud' => 'required|numeric|between:-90,90',
            'longitud' => 'required|numeric|between:-180,180',
            'localidad' => 'required|string|max:100',
            'precio_por_hora' => 'required|numeric|min:0',
            'tipo_superficie' => 'nullable|in:cesped_natural,cesped_artificial,tierra,cemento',
            'capacidad' => 'nullable|integer|min:1',
            'vestuario' => 'nullable|boolean',
            'parking' => 'nullable|boolean',
            'iluminacion' => 'nullable|boolean',
            'techada' => 'nullable|boolean',
            'horario_apertura' => 'nullable|date_format:H:i',
            'horario_cierre' => 'nullable|date_format:H:i',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|string',
            'telefono' => 'nullable|string|max:20',
        ]);

        $pista = Pista::create($request->all());

        return response()->json([
            'message' => 'Pista creada exitosamente',
            'pista' => $pista,
        ], 201);
    }

    /**
     * Actualizar una pista existente
     */
    public function update(Request $request, $id)
    {
        $pista = Pista::find($id);

        if (!$pista) {
            return response()->json([
                'message' => 'Pista no encontrada',
            ], 404);
        }
        

        $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'direccion' => 'sometimes|string',
            'latitud' => 'sometimes|numeric|between:-90,90',
            'longitud' => 'sometimes|numeric|between:-180,180',
            'localidad' => 'sometimes|string|max:100',
            'precio_por_hora' => 'sometimes|numeric|min:0',
            'tipo_superficie' => 'nullable|in:cesped_natural,cesped_artificial,tierra,cemento',
            'capacidad' => 'nullable|integer|min:1',
            'vestuario' => 'nullable|boolean',
            'parking' => 'nullable|boolean',
            'iluminacion' => 'nullable|boolean',
            'techada' => 'nullable|boolean',
            'horario_apertura' => 'nullable|date_format:H:i',
            'horario_cierre' => 'nullable|date_format:H:i',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|string',
            'telefono' => 'nullable|string|max:20',
        ]);

        $pista->update($request->all());

        return response()->json([
            'message' => 'Pista actualizada exitosamente',
            'pista' => $pista,
        ], 200);
    }

    /**
     * Eliminar una pista
     */
    public function destroy($id)
    {
        $pista = Pista::find($id);

        if (!$pista) {
            return response()->json([
                'message' => 'Pista no encontrada',
            ], 404);
        }

        $pista->delete();

        return response()->json([
            'message' => 'Pista eliminada exitosamente',
        ], 200);
    }
}
