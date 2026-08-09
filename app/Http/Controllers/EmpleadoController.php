<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empleados = Empleado::orderBy('nombre')->paginate(10);

        return view('empleados.index', compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('empleados.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'cargo' => 'nullable|string|max:100',
            'departamento' => 'nullable|string|max:100',
        ]);

        Empleado::create($validated);

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empleado $empleado)
    {
        return view('empleados.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empleado $empleado)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'cargo' => 'nullable|string|max:100',
            'departamento' => 'nullable|string|max:100',
        ]);

        $empleado->update($validated);

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empleado $empleado)
    {
        $empleado->update(['activo' => false]);

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado desactivado correctamente.');
    }
}
