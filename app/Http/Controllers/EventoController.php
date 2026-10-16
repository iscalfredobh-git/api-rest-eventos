<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function index()
    {
        return response()->json(Evento::all(), 200);
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'ubicacion' => 'required|string|max:255',
        ]);

        $evento = Evento::create($datos);

        return response()->json($evento, 201);
    }

    public function show(Evento $evento)
    {
        return response()->json($evento, 200);
    }

    public function update(Request $request, Evento $evento)
    {
        $datos = $request->validate([
            'titulo' => 'sometimes|required|string|max:255',
            'descripcion' => 'sometimes|nullable|string',
            'fecha_inicio' => 'sometimes|required|date',
            'fecha_fin' => 'sometimes|nullable|date',
            'ubicacion' => 'sometimes|required|string|max:255',
        ]);

        $evento->update($datos);

        return response()->json($evento, 200);
    }

    public function destroy(Evento $evento)
    {
        $evento->delete();

        return response()->noContent();
    }
}
