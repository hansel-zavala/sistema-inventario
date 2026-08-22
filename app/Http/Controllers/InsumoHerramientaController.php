<?php

namespace App\Http\Controllers;

use App\Models\InsumoHerramienta;
use App\Models\MovimientoInsumo;
use App\Models\Categoria;
use App\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InsumoHerramientaController extends Controller
{
    public function index(Request $request)
    {
        $query = InsumoHerramienta::with(['categoria', 'ubicacion'])->where('activo', true);

        if ($request->filled('buscar')) {
            $query->where('nombre', 'like', '%' . $request->buscar . '%');
        }

        if ($request->boolean('bajo_stock')) {
            $query->whereColumn('cantidad_disponible', '<=', 'cantidad_minima');
        }

        $insumos = $query->orderBy('nombre')->paginate(10)->withQueryString();

        return view('insumos-herramientas.index', compact('insumos'));
    }

    public function create()
    {
        $categorias = Categoria::where('activo', true)->where('tipo', 'insumo')->orderBy('nombre')->get();
        $ubicaciones = Ubicacion::where('activo', true)->orderBy('nombre')->get();

        return view('insumos-herramientas.create', compact('categorias', 'ubicaciones'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'categoria_id' => 'required|exists:categorias,id',
            'ubicacion_id' => 'required|exists:ubicaciones,id',
            'cantidad_disponible' => 'required|integer|min:0',
            'cantidad_minima' => 'required|integer|min:0',
            'unidad_medida' => 'required|string|max:20',
        ]);

        $insumo = InsumoHerramienta::create($validated);

        // Si se registró con cantidad inicial mayor a 0, dejamos constancia como "entrada inicial"
        if ($validated['cantidad_disponible'] > 0) {
            MovimientoInsumo::create([
                'insumo_id' => $insumo->id,
                'tipo' => 'entrada',
                'cantidad' => $validated['cantidad_disponible'],
                'motivo' => 'Registro inicial de inventario',
                'usuario_id' => Auth::id(),
            ]);
        }

        return redirect()->route('insumos-herramientas.index')
            ->with('success', 'Insumo/herramienta registrado correctamente.');
    }

    public function edit(InsumoHerramienta $insumoHerramienta)
    {
        $categorias = Categoria::where('activo', true)->where('tipo', 'insumo')->orderBy('nombre')->get();
        $ubicaciones = Ubicacion::where('activo', true)->orderBy('nombre')->get();

        return view('insumos-herramientas.edit', [
            'insumo' => $insumoHerramienta,
            'categorias' => $categorias,
            'ubicaciones' => $ubicaciones,
        ]);
    }

    public function update(Request $request, InsumoHerramienta $insumoHerramienta)
    {
        // Nota: aquí NO se edita cantidad_disponible directamente.
        // Los cambios de cantidad se hacen solo a través de "registrarMovimiento".
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'categoria_id' => 'required|exists:categorias,id',
            'ubicacion_id' => 'required|exists:ubicaciones,id',
            'cantidad_minima' => 'required|integer|min:0',
            'unidad_medida' => 'required|string|max:20',
        ]);

        $insumoHerramienta->update($validated);

        return redirect()->route('insumos-herramientas.index')
            ->with('success', 'Insumo/herramienta actualizado correctamente.');
    }

    public function destroy(InsumoHerramienta $insumoHerramienta)
    {
        $insumoHerramienta->update(['activo' => false]);

        return redirect()->route('insumos-herramientas.index')
            ->with('success', 'Insumo/herramienta desactivado correctamente.');
    }

    public function registrarMovimiento(Request $request, InsumoHerramienta $insumoHerramienta)
    {
        $validated = $request->validate([
            'tipo' => 'required|in:entrada,salida',
            'cantidad' => 'required|integer|min:1',
            'motivo' => 'nullable|string|max:255',
        ]);

        // Si es salida, no permitir dejar el stock en negativo
        if ($validated['tipo'] === 'salida' && $validated['cantidad'] > $insumoHerramienta->cantidad_disponible) {
            return redirect()->back()
                ->withErrors(['cantidad' => 'No hay suficiente stock disponible para esta salida.']);
        }

        MovimientoInsumo::create([
            'insumo_id' => $insumoHerramienta->id,
            'tipo' => $validated['tipo'],
            'cantidad' => $validated['cantidad'],
            'motivo' => $validated['motivo'],
            'usuario_id' => Auth::id(),
        ]);

        if ($validated['tipo'] === 'entrada') {
            $insumoHerramienta->increment('cantidad_disponible', $validated['cantidad']);
        } else {
            $insumoHerramienta->decrement('cantidad_disponible', $validated['cantidad']);
        }

        return redirect()->route('insumos-herramientas.index')
            ->with('success', 'Movimiento de stock registrado correctamente.');
    }
}