<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Historial de movimientos
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto">
        <form method="GET" class="bg-white shadow rounded p-4 mb-4 flex gap-3">
            <select name="equipo_id" class="rounded border-gray-300 shadow-sm text-sm flex-1">
                <option value="">Todos los equipos</option>
                @foreach ($equipos as $equipo)
                    <option value="{{ $equipo->id }}" {{ request('equipo_id') == $equipo->id ? 'selected' : '' }}>
                        {{ $equipo->nombre }} @if($equipo->numero_serie) ({{ $equipo->numero_serie }}) @endif
                    </option>
                @endforeach
            </select>
            <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded text-sm hover:bg-gray-800">
                Filtrar
            </button>
            <a href="{{ route('movimientos.index') }}" class="text-sm text-gray-600 self-center">Limpiar</a>
        </form>

        <div class="bg-white shadow rounded overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-left">
                    <tr>
                        <th class="px-4 py-2">Fecha</th>
                        <th class="px-4 py-2">Equipo</th>
                        <th class="px-4 py-2">Ubicación</th>
                        <th class="px-4 py-2">Responsable</th>
                        <th class="px-4 py-2">Comentario</th>
                        <th class="px-4 py-2">Registrado por</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($movimientos as $movimiento)
                        <tr class="border-t align-top">
                            <td class="px-4 py-2 whitespace-nowrap">{{ $movimiento->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-2">{{ $movimiento->equipo->nombre ?? 'Equipo eliminado' }}</td>
                            <td class="px-4 py-2">
                                @if ($movimiento->ubicacion_anterior_id || $movimiento->ubicacion_nueva_id)
                                    <span class="text-gray-500">{{ $movimiento->ubicacionAnterior->nombre ?? '—' }}</span>
                                    →
                                    <span class="font-medium">{{ $movimiento->ubicacionNueva->nombre ?? '—' }}</span>
                                @else
                                    <span class="text-gray-400">Sin cambio</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                @if ($movimiento->empleado_anterior_id || $movimiento->empleado_nuevo_id)
                                    <span class="text-gray-500">{{ $movimiento->empleadoAnterior->nombre ?? 'Sin asignar' }}</span>
                                    →
                                    <span class="font-medium">{{ $movimiento->empleadoNuevo->nombre ?? 'Sin asignar' }}</span>
                                @else
                                    <span class="text-gray-400">Sin cambio</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">{{ $movimiento->comentario ?? '—' }}</td>
                            <td class="px-4 py-2">{{ $movimiento->usuario->name ?? 'Usuario eliminado' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                                No hay movimientos registrados todavía.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $movimientos->links() }}
        </div>
    </div>
</x-app-layout>