<?php

namespace App\Http\Controllers;

use App\Models\Movimiento;
use Illuminate\Http\Request;
use App\Models\Equipo;

class MovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Movimiento::with(['equipo', 'ubicacionAnterior', 'ubicacionNueva', 'empleadoAnterior', 'empleadoNuevo', 'usuario']);

        if ($request->filled('equipo_id')) {
            $query->where('equipo_id', $request->equipo_id);
        }

        $movimientos = $query->latest('created_at')->paginate(15)->withQueryString();

        $equipos = Equipo::orderBy('nombre')->get();

        return view('movimientos.index', compact('movimientos', 'equipos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Movimiento $movimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movimiento $movimiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movimiento $movimiento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movimiento $movimiento)
    {
        //
    }
}
