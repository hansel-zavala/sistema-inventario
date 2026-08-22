<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\InsumoHerramienta;
use App\Models\OrdenTaller;
use App\Models\Movimiento;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEquipos = Equipo::count();
        $equiposActivos = Equipo::where('estado', 'activo')->count();
        $equiposEnReparacion = Equipo::where('estado', 'en_reparacion')->count();
        $equiposDeBaja = Equipo::where('estado', 'de_baja')->count();

        $insumosBajoStock = InsumoHerramienta::where('activo', true)
            ->whereColumn('cantidad_disponible', '<=', 'cantidad_minima')
            ->count();

        $ordenesEnEspera = OrdenTaller::where('estado', 'en_espera')->count();
        $ordenesEnReparacion = OrdenTaller::where('estado', 'en_reparacion')->count();

        $ultimosMovimientos = Movimiento::with(['equipo', 'usuario'])
            ->latest('created_at')
            ->take(5)
            ->get();

        $ultimasOrdenes = OrdenTaller::with('equipo')
            ->whereIn('estado', ['en_espera', 'en_reparacion'])
            ->latest('fecha_ingreso')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalEquipos',
            'equiposActivos',
            'equiposEnReparacion',
            'equiposDeBaja',
            'insumosBajoStock',
            'ordenesEnEspera',
            'ordenesEnReparacion',
            'ultimosMovimientos',
            'ultimasOrdenes'
        ));
    }
}