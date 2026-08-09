<?php

namespace App\Http\Controllers;

use App\Models\Ubicacion;
use Illuminate\Http\Request;

class UbicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ubicaciones = Ubicacion::orderBy('nombre')->paginate(10);

        return view('ubicaciones.index', compact('ubicaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ubicaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
        ]);

        Ubicacion::create($validated);

        return redirect()->route('ubicaciones.index')
            ->with('success', 'Ubicación creada correctamente.');
    }

    public function edit(Ubicacion $ubicacion)
    {
        return view('ubicaciones.edit', compact('ubicacion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ubicacion $ubicacion)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
        ]);
        
        $ubicacion->update($validated);

        return redirect()->route('ubicaciones.index')
            ->with('success', 'Ubicación actualizada correctamente.');
    }

    public function destroy(Ubicacion $ubicacion)
    {
        $ubicacion->update(['activo' => false]);

        return redirect()->route('ubicaciones.index')
            ->with('success', 'Ubicación desactivada correctamente.');
    }
}
