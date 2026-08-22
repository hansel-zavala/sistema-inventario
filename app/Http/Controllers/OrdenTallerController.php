<?php

namespace App\Http\Controllers;

use App\Models\OrdenTaller;
use App\Models\Equipo;
use Illuminate\Http\Request;

class OrdenTallerController extends Controller
{
    public function index(Request $request)
    {
        $query = OrdenTaller::with(['equipo', 'usuario']);

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        $ordenes = $query->latest('fecha_ingreso')->paginate(10)->withQueryString();

        return view('ordenes-taller.index', compact('ordenes'));
    }

    public function create()
    {
        // Solo se pueden ingresar al taller equipos que no estén ya en reparación o de baja
        $equipos = Equipo::where('estado', 'activo')->orderBy('nombre')->get();

        return view('ordenes-taller.create', compact('equipos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'equipo_id' => 'required|exists:equipos,id',
            'motivo' => 'required|string|max:255',
            'fecha_ingreso' => 'required|date',
            'observaciones' => 'nullable|string',
        ]);

        $validated['estado'] = 'en_espera';
        $validated['usuario_id'] = auth()->id();

        $orden = OrdenTaller::create($validated);

        // El equipo pasa a estado "en_reparacion" mientras está en el taller
        $orden->equipo->update(['estado' => 'en_reparacion']);

        return redirect()->route('ordenes-taller.index')
            ->with('success', 'Orden de taller registrada correctamente.');
    }

    public function edit(OrdenTaller $ordenTaller)
    {
        return view('ordenes-taller.edit', ['orden' => $ordenTaller]);
    }

    public function update(Request $request, OrdenTaller $ordenTaller)
    {
        $validated = $request->validate([
            'motivo' => 'required|string|max:255',
            'estado' => 'required|in:en_espera,en_reparacion,finalizado',
            'fecha_salida' => 'nullable|date',
            'observaciones' => 'nullable|string',
        ]);

        // Si se marca como finalizado, exigimos fecha de salida
        if ($validated['estado'] === 'finalizado' && empty($validated['fecha_salida'])) {
            $validated['fecha_salida'] = now()->format('Y-m-d');
        }

        $ordenTaller->update($validated);

        // Sincronizamos el estado del equipo según el estado de la orden
        if ($validated['estado'] === 'finalizado') {
            $ordenTaller->equipo->update(['estado' => 'activo']);
        } else {
            $ordenTaller->equipo->update(['estado' => 'en_reparacion']);
        }

        return redirect()->route('ordenes-taller.index')
            ->with('success', 'Orden de taller actualizada correctamente.');
    }

    public function destroy(OrdenTaller $ordenTaller)
    {
        $ordenTaller->deleted_by = auth()->id();
        $ordenTaller->save();
        $ordenTaller->delete(); // soft delete

        return redirect()->route('ordenes-taller.index')
            ->with('success', 'Orden de taller eliminada correctamente.');
    }
}
