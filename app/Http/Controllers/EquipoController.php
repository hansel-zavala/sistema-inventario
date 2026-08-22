<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Categoria;
use App\Models\Ubicacion;
use App\Models\Empleado;
use App\Models\Movimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EquipoController extends Controller
{
    public function index(Request $request)
    {
        $query = Equipo::with(['categoria', 'ubicacion', 'empleado']);

        // Filtros simples (categoría, ubicación, estado)
        if ($request->filled('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }

        if ($request->filled('ubicacion_id')) {
            $query->where('ubicacion_id', $request->ubicacion_id);
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('buscar')) {
            $query->where(function ($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->buscar . '%')
                  ->orWhere('numero_serie', 'like', '%' . $request->buscar . '%')
                  ->orWhere('marca', 'like', '%' . $request->buscar . '%')
                  ->orWhere('modelo', 'like', '%' . $request->buscar . '%');
            });
        }

        $equipos = $query->orderBy('nombre')->paginate(10)->withQueryString();

        $categorias = Categoria::where('activo', true)->where('tipo', 'equipo')->orderBy('nombre')->get();
        $ubicaciones = Ubicacion::where('activo', true)->orderBy('nombre')->get();

        return view('equipos.index', compact('equipos', 'categorias', 'ubicaciones'));
    }

    public function create()
    {
        $categorias = Categoria::where('activo', true)->where('tipo', 'equipo')->orderBy('nombre')->get();
        $ubicaciones = Ubicacion::where('activo', true)->orderBy('nombre')->get();
        $empleados = Empleado::where('activo', true)->orderBy('nombre')->get();

        return view('equipos.create', compact('categorias', 'ubicaciones', 'empleados'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'categoria_id' => 'required|exists:categorias,id',
            'ubicacion_id' => 'required|exists:ubicaciones,id',
            'empleado_id' => 'nullable|exists:empleados,id',
            'marca' => 'nullable|string|max:60',
            'modelo' => 'nullable|string|max:60',
            'numero_serie' => 'nullable|string|max:100|unique:equipos,numero_serie',
            'fecha_adquisicion' => 'nullable|date',
            'observaciones' => 'nullable|string',
        ]);

        // El estado siempre inicia como 'activo' al crear un equipo nuevo
        $validated['estado'] = 'activo';

        Equipo::create($validated);

        return redirect()->route('equipos.index')
            ->with('success', 'Equipo registrado correctamente.');
    }

    public function edit(Equipo $equipo)
    {
        $categorias = Categoria::where('activo', true)->where('tipo', 'equipo')->orderBy('nombre')->get();
        $ubicaciones = Ubicacion::where('activo', true)->orderBy('nombre')->get();
        $empleados = Empleado::where('activo', true)->orderBy('nombre')->get();

        return view('equipos.edit', compact('equipo', 'categorias', 'ubicaciones', 'empleados'));
    }

    public function update(Request $request, Equipo $equipo)
{
    $validated = $request->validate([
        'nombre' => 'required|string|max:100',
        'categoria_id' => 'required|exists:categorias,id',
        'ubicacion_id' => 'required|exists:ubicaciones,id',
        'empleado_id' => 'nullable|exists:empleados,id',
        'marca' => 'nullable|string|max:60',
        'modelo' => 'nullable|string|max:60',
        'numero_serie' => 'nullable|string|max:100|unique:equipos,numero_serie,' . $equipo->id,
        'fecha_adquisicion' => 'nullable|date',
        'estado' => 'required|in:activo,en_reparacion,de_baja',
        'observaciones' => 'nullable|string',
    ]);

    // Guardamos los valores ANTES de actualizar, para comparar después
    $ubicacionAnteriorId = $equipo->ubicacion_id;
    $empleadoAnteriorId = $equipo->empleado_id;

    $equipo->update($validated);

    // Si cambió la ubicación o el responsable, registramos el movimiento
    $huboCambioUbicacion = $ubicacionAnteriorId != $equipo->ubicacion_id;
    $huboCambioEmpleado = $empleadoAnteriorId != $equipo->empleado_id;

    if ($huboCambioUbicacion || $huboCambioEmpleado) {
        Movimiento::create([
            'equipo_id' => $equipo->id,
            'ubicacion_anterior_id' => $huboCambioUbicacion ? $ubicacionAnteriorId : null,
            'ubicacion_nueva_id' => $huboCambioUbicacion ? $equipo->ubicacion_id : null,
            'empleado_anterior_id' => $huboCambioEmpleado ? $empleadoAnteriorId : null,
            'empleado_nuevo_id' => $huboCambioEmpleado ? $equipo->empleado_id : null,
            'usuario_id' => Auth::id(),
            'comentario' => $request->input('comentario_movimiento'),
        ]);
    }

    return redirect()->route('equipos.index')
        ->with('success', 'Equipo actualizado correctamente.');
}

    public function destroy(Equipo $equipo)
    {
        $equipo->deleted_by = Auth::id();
        $equipo->save();
        $equipo->delete(); // soft delete

        return redirect()->route('equipos.index')
            ->with('success', 'Equipo eliminado correctamente.');
    }
}
