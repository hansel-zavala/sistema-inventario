<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel general
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto space-y-6">

        <!-- Tarjetas de resumen -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white shadow rounded p-4">
                <p class="text-sm text-gray-500">Total equipos</p>
                <p class="text-2xl font-semibold">{{ $totalEquipos }}</p>
            </div>
            <div class="bg-white shadow rounded p-4">
                <p class="text-sm text-gray-500">Activos</p>
                <p class="text-2xl font-semibold text-green-700">{{ $equiposActivos }}</p>
            </div>
            <div class="bg-white shadow rounded p-4">
                <p class="text-sm text-gray-500">En reparación</p>
                <p class="text-2xl font-semibold text-yellow-700">{{ $equiposEnReparacion }}</p>
            </div>
            <div class="bg-white shadow rounded p-4">
                <p class="text-sm text-gray-500">De baja</p>
                <p class="text-2xl font-semibold text-gray-500">{{ $equiposDeBaja }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white shadow rounded p-4">
                <p class="text-sm text-gray-500">Insumos bajo stock</p>
                <p class="text-2xl font-semibold {{ $insumosBajoStock > 0 ? 'text-red-600' : '' }}">
                    {{ $insumosBajoStock }}
                </p>
                @if ($insumosBajoStock > 0)
                    <a href="{{ route('insumos-herramientas.index', ['bajo_stock' => 1]) }}"
                       class="text-xs text-indigo-600 hover:underline">Ver detalle</a>
                @endif
            </div>
            <div class="bg-white shadow rounded p-4">
                <p class="text-sm text-gray-500">Órdenes en espera</p>
                <p class="text-2xl font-semibold">{{ $ordenesEnEspera }}</p>
            </div>
            <div class="bg-white shadow rounded p-4">
                <p class="text-sm text-gray-500">Órdenes en reparación</p>
                <p class="text-2xl font-semibold">{{ $ordenesEnReparacion }}</p>
            </div>
        </div>

        <!-- Últimos movimientos y órdenes activas -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white shadow rounded overflow-hidden">
                <div class="px-4 py-3 border-b font-medium text-sm">Últimos movimientos</div>
                <table class="w-full text-sm">
                    <tbody>
                        @forelse ($ultimosMovimientos as $mov)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $mov->equipo->nombre ?? '—' }}</td>
                                <td class="px-4 py-2 text-gray-500">{{ $mov->created_at->format('d/m/Y') }}</td>
                            </tr>
                        @empty
                            <tr><td class="px-4 py-3 text-gray-500">Sin movimientos registrados.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="px-4 py-2 border-t">
                    <a href="{{ route('movimientos.index') }}" class="text-xs text-indigo-600 hover:underline">Ver todos</a>
                </div>
            </div>

            <div class="bg-white shadow rounded overflow-hidden">
                <div class="px-4 py-3 border-b font-medium text-sm">Órdenes de taller activas</div>
                <table class="w-full text-sm">
                    <tbody>
                        @forelse ($ultimasOrdenes as $orden)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $orden->equipo->nombre ?? '—' }}</td>
                                <td class="px-4 py-2 text-gray-500">{{ $orden->motivo }}</td>
                            </tr>
                        @empty
                            <tr><td class="px-4 py-3 text-gray-500">No hay órdenes activas.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="px-4 py-2 border-t">
                    <a href="{{ route('ordenes-taller.index') }}" class="text-xs text-indigo-600 hover:underline">Ver todas</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>